<?php
namespace GRCR\KastenhuberTheme\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 FluidTYPO3 user <info@fluidtypo3.org>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use FluidTYPO3\Fluidpages\Controller\PageController as AbstractController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$pdfFile = ExtensionManagementUtility::extPath('kastenhuber_theme').'vendor/autoload.php';

require_once($pdfFile);

/**
 * Ajax Controller
 *
 * @route off
 */
class AjaxController extends AbstractController
{
    /**
     * Get saved records
     *
     * @return Void
     */
    public function getSavedAction()
    {
        $savedArticle = GeneralUtility::_GP('savedArticle');
        if (isset($savedArticle)) {
            $savedArticleArr = explode(',', $savedArticle);
            $returnArray = array();
            if (count($savedArticleArr)) {
                foreach ($savedArticleArr as $savedArticleEle) {
                    if ($savedArticleEle) {
                        $returnArray[] = array(
                            'uid' => substr($savedArticleEle, 2)
                        );
                    }
                }
                $objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
                $scrollRepository = $objectManager->get('Kreatika\KreatikaAnchorscroll\Domain\Repository\ScrollRepository');

                $emailView = $objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
                $configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');

                $extbaseFrameworkConfiguration = $configurationManager->getConfiguration(
                    \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
                );
                $templateRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPaths'][0]);
                $templatePathAndFilename = $templateRootPath . 'Ajax/Index.html';

                $emailView->setTemplatePathAndFilename($templatePathAndFilename);
                $viewArray = array(
                    'returnArray' => $returnArray
                );
                $emailView->assignMultiple($viewArray);
                $emailBody = $emailView->render();
                echo $emailBody;
            }
        }
        exit;
    }

    /**
     * Get saved records
     *
     * @return Void
     */
    public function savePdfAction()
    {
        $mpdf=new \Mpdf\Mpdf();

        /// USE ANOTHER PDF AS TEMPLATE IN BACKGROUND
        $mpdf->SetImportUse();
        $mpdf->SetDocTemplate('fileadmin/ui/beringer-pdf-template.pdf',true);
        $mpdf->AddPage();
        /// END

        $footer = '<div style="border-top: 1px solid #c00303; font-size: 9pt; text-align: left; padding-top: 3mm; ">
        <!-- Seite {PAGENO} von {nb} -->
        MOST GmbH | Roadshow Experts  -  Beratung: +49 911 6000 29 99  -  info@roadshow-experts.com
        </div>';

        $mpdf->SetHTMLFooter($footer);


        // $pdf = GeneralUtility::makeInstance(
        //     'GRCR\\KastenhuberTheme\\Service\\Pdf',
        //     array(
        //         PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false
        //     )
        // );
        // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        // $pdf->SetFont('dejavusans', '', 12);

        $savedArticle = GeneralUtility::_GP('savedHidden');
        $emailBody = '';
        if (isset($savedArticle)) {
            $savedArticleArr = explode(',', $savedArticle);
            $returnArray = array();
            if (count($savedArticleArr)) {
                foreach ($savedArticleArr as $savedArticleEle) {
                    $returnArray[] = array(
                        'uid' => substr($savedArticleEle, 2)
                    );
                }
            }
            $objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
            //$scrollRepository = $objectManager->get('Kreatika\KreatikaAnchorscroll\Domain\Repository\ScrollRepository');

            $emailView = $objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
            $configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');

            $extbaseFrameworkConfiguration = $configurationManager->getConfiguration(
                \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
            );
            $templateRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPaths'][0]);
            $templatePathAndFilename = $templateRootPath . 'Ajax/Pdf.html';

            $emailView->setTemplatePathAndFilename($templatePathAndFilename);

            $viewArray = array(
                'returnArray' => $returnArray
            );
            $emailView->assignMultiple($viewArray);
            $emailBody = $emailView->render();
        }

        // $pdf->AddPage();
        // $pdf->writeHTML($emailBody, true, false, true, false, '');


        $email = GeneralUtility::_GP('email');
        if (isset($email)) {
            $mpdf->WriteHTML($emailBody);
            $templatePathAndFilename = $templateRootPath . 'Ajax/Email.html';
            $emailView->setTemplatePathAndFilename($templatePathAndFilename);
            $viewArray = array(
                'returnArray' => $returnArray
            );
            $emailView->assignMultiple($viewArray);
            $emailBody = $emailView->render();
            $sessId = $_COOKIE['PHPSESSID'];
            $filePath = PATH_site . 'fileadmin/user_upload/Beringer-Artikel-'.$sessId.'.pdf';
            $mpdf->Output($filePath, 'F');

            $emailVal = GeneralUtility::_GP('emailVal');
            $mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
            $mail->setFrom(array($this->settings['emailFrom'] => $this->settings['emailName']))
                ->setTo(array($emailVal => strstr($emailVal, '@', true)))
                ->setSubject($this->settings['emailSubject'])
                ->setBody($emailBody)
                ->setContentType('text/html')
                ->attach(\Swift_Attachment::fromPath(PATH_site . 'fileadmin/user_upload/Beringer-Artikel-'.$sessId.'.pdf'))
                ->send();


            $templatePathAndFilename = $templateRootPath . 'Ajax/AdminEmail.html';
            $emailView->setTemplatePathAndFilename($templatePathAndFilename);
            $viewArray = array(
                'returnArray' => $returnArray,
                'userEmail' => $emailVal
            );
            $emailView->assignMultiple($viewArray);
            $emailBody = $emailView->render();

            echo $this->settings['emailToAdmin'] = 'grimm@roadshow-experts.com';
            if ($this->validateEmail($this->settings['emailToAdmin'])) {
                $mail->setFrom(array($this->settings['emailFromAdmin'] => $this->settings['emailNameAdmin']))
                    ->setTo(array($this->settings['emailToAdmin'] => strstr($this->settings['emailToAdmin'], '@', true)))
                    ->setSubject($this->settings['emailSubjectAdmin'])
                    ->setBody($emailBody)
                    ->setContentType('text/html')
                    ->attach(\Swift_Attachment::fromPath(PATH_site . 'fileadmin/user_upload/Beringer-Artikel-'.$sessId.'.pdf'))
                    ->send();
            }
        } else {
            //echo $emailBody;exit;
            $mpdf->WriteHTML($emailBody);
            $mpdf->Output('Beringer-Artikel.pdf', 'D');
            // $pdf->Output('saved-vehicles.pdf', 'I');
        }
        exit;
    }

    /**
     * Get saved records
     *
     * @return Void
     */
    public function sendEmailAction()
    {
        $formData = GeneralUtility::_GP('form');
        if ($formData[4]) {
            $mpdf=new \Mpdf\Mpdf();

            /// USE ANOTHER PDF AS TEMPLATE IN BACKGROUND
            $mpdf->SetImportUse();
            $mpdf->SetDocTemplate('fileadmin/ui/beringer-pdf-template.pdf',true);
            $mpdf->AddPage();
            $savedArticleArr = explode(',', $formData[4]);
            $returnArray = array();
            if (count($savedArticleArr)) {
                foreach ($savedArticleArr as $savedArticleEle) {
                    $returnArray[] = array(
                        'uid' => substr($savedArticleEle, 2)
                    );
                }
            }
            $objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
            $scrollRepository = $objectManager->get('Kreatika\KreatikaAnchorscroll\Domain\Repository\ScrollRepository');

            $emailView = $objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
            $configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');

            $extbaseFrameworkConfiguration = $configurationManager->getConfiguration(
                \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
            );
            $templateRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPaths'][0]);
            $templatePathAndFilename = $templateRootPath . 'Ajax/Pdf.html';

            $emailView->setTemplatePathAndFilename($templatePathAndFilename);

            $viewArray = array(
                'returnArray' => $returnArray
            );
            $emailView->assignMultiple($viewArray);
            $emailBody = $emailView->render();
            $mpdf->WriteHTML($emailBody);
            $templatePathAndFilename = $templateRootPath . 'Ajax/Email.html';
            $emailView->setTemplatePathAndFilename($templatePathAndFilename);
            $viewArray = array(
                'returnArray' => $returnArray
            );
            $emailView->assignMultiple($viewArray);
            $emailBody = $emailView->render();
            $sessId = $_COOKIE['PHPSESSID'];
            $filePath = PATH_site . 'fileadmin/user_upload/Beringer-Artikel-'.$sessId.'.pdf';
            $mpdf->Output($filePath, 'F');
        }

        $toArray = array($this->settings['queryToAdmin'] => $this->settings['queryNameAdmin']);
        $admindetail[$formData[2]] = $formData[1];
        $mail = $this->sendMail($admindetail, $toArray, 'admin', $formData, $filePath);
        if ($this->settings['sendEmailtouser']) {
            $admindetail = array($this->settings['queryToAdmin'] => $this->settings['queryNameAdmin']);
            $toArray[$formData[2]] = $toArray[1];
            $mail = $this->sendMail($admindetail, $toArray, 'user', $formData, $filePath);
        }
        if ($mail) {
            return '1';
        }
    }

    /**
     * Get sendQuotes
     *
     * @return Void
     */
    public function sendQuoteAction()
    {
        $strArray = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP("params");
        $returnData= [];
        foreach($strArray as $item) {
            $array = explode("=", $item);
            $returnData[$item['name']] = $item['value'];
        }
        $userData = $returnData;


        $name = $returnData["firstName"].' '.$returnData["lastName"];
        $email = $returnData["email"];

		$agent = $_SERVER["HTTP_USER_AGENT"];
		if( preg_match('/Edge\/\d+/', $agent) ) {
			$itemArray = json_decode(utf8_encode($_COOKIE['cartArticle']));
		} else {
			$itemArray = json_decode($_COOKIE['cartArticle']);
		}
        //$itemArray = json_decode($_COOKIE['cartArticle']);

        if ($email) {
            $mpdf=new \Mpdf\Mpdf();

            /// USE ANOTHER PDF AS TEMPLATE IN BACKGROUND
            $mpdf->SetImportUse();
            $mpdf->SetDocTemplate('fileadmin/ui/beringer-pdf-template.pdf',true);
            $mpdf->AddPage();
            $mpdf->setAutoTopMargin = '200';
            $mpdf->setAutoBottomMargin = 'stretch';

            $returnArray = array();
            $totalPrice = 0;
            if (count($itemArray)) {

                foreach ($itemArray as $item) {
                    $itemArray = json_decode( json_encode($item), true);
                    $price = filter_var(str_replace(',','.',$itemArray['price']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $price = rtrim($price,".");

                    $itemArray['total'] = $itemArray['items']*$price;
                    $totalPrice += $itemArray['total'];
                    $returnArray[] = $itemArray;
                }
            }

            $objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');

            $emailView = $objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
            $configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
            $extbaseFrameworkConfiguration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);

            $templateRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['plugin.']['tx_kastenhubertheme.']['view.']['templateRootPaths.'][0]);

            $templatePathAndFilename = $templateRootPath . 'Ajax/QuotePdf.html';

            $emailView->setTemplatePathAndFilename($templatePathAndFilename);

            $viewArray = array(
                'itemArray' => $returnArray,
                'totalPrice' =>$totalPrice
            );
            $emailView->assignMultiple($viewArray);
            $emailBody = $emailView->render();

            $mpdf->WriteHTML($emailBody);

            $templatePathAndFilename = $templateRootPath . 'Ajax/Email.html';
            $emailView->setTemplatePathAndFilename($templatePathAndFilename);
            $viewArray = array(
                'returnArray' => $returnArray

            );
            $emailView->assignMultiple($viewArray);
            $emailBody = $emailView->render();
            $sessId = $_COOKIE['PHPSESSID'];

            $filePath = PATH_site . 'fileadmin/user_upload/Beringer-Artikel-'.$sessId.'.pdf';
            $mpdf->Output($filePath, 'F');
        }

        $toArray = array($this->settings['Quote']['adminEmail'] => $this->settings['Quote']['adminName']);

        $admindetail[$email] = $name;

        $mail = $this->sendQuoteMail($admindetail, $toArray, 'admin', $userData, $filePath);

        if ($this->settings['Quote']['sendEmailtouser']==1) {
            $admindetail = [];
            $toArray = [];
            $admindetail = array($this->settings['Quote']['adminEmail'] => $this->settings['Quote']['adminName']);
            $toArray[$email] = $name;
            $mail = $this->sendQuoteMail($admindetail, $toArray, 'user', [], $filePath);
        }
        if ($mail) {
            return '1';
        }

    }

    /**
     * Get Cart
     *
     * @return Void
     */
    public function getCartAction()
    {
		$agent = $_SERVER["HTTP_USER_AGENT"];
		if( preg_match('/Edge\/\d+/', $agent) ) {
			$itemArray = json_decode(utf8_encode($_COOKIE['cartArticle']));
		} else {
			$itemArray = json_decode($_COOKIE['cartArticle']);
		}

        if ($itemArray) {
            $returnArray = array();
            $totalPrice = 0;
            if (count($itemArray)) {
                foreach ($itemArray as $item) {
                    $itemArray = json_decode( json_encode($item), true);
                    $price = filter_var(str_replace(',','.',$itemArray['price']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $price = rtrim($price,".");

                    $itemArray['total'] = $itemArray['items']*$price;
                    $totalPrice += $itemArray['total'];
                    $returnArray[] = $itemArray;
                }
            }
            $variables = array(
                'itemArray'=>$returnArray,
                'totalPrice' =>$totalPrice
            );
            $tempView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

            $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(
                \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
            );
            $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
                $extbaseFrameworkConfiguration['view']['templateRootPaths'][0]
            );

            $templatePathAndFilename = $templateRootPath . '/Ajax/Cart.html';
            $tempView->setTemplatePathAndFilename($templatePathAndFilename);
            $variables['site_root'] = PATH_site;
            $tempView->assignMultiple($variables);
            $tempHtml = $tempView->render();
            return $tempHtml;
        }
        return '';
    }

    /**
     * Get Form
     *
     * @return Void
     */
    public function getFormAction()
    {
        $variables = [];
        $tempView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(
            \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
        );
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            $extbaseFrameworkConfiguration['view']['templateRootPaths'][0]
        );

        $templatePathAndFilename = $templateRootPath . '/Ajax/Form.html';
        $tempView->setTemplatePathAndFilename($templatePathAndFilename);
        $variables['site_root'] = PATH_site;
        $tempView->assignMultiple($variables);
        $tempHtml = $tempView->render();
        return $tempHtml;
    }

    /**
     * Get Form
     *
     * @return Void
     */
    public function getTHanksMsgAction()
    {
        $variables = [];
        $tempView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(
            \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
        );
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            $extbaseFrameworkConfiguration['view']['templateRootPaths'][0]
        );

        $templatePathAndFilename = $templateRootPath . '/Ajax/ThanksMsg.html';
        $tempView->setTemplatePathAndFilename($templatePathAndFilename);
        $variables['site_root'] = PATH_site;
        $tempView->assignMultiple($variables);
        $tempHtml = $tempView->render();
        return $tempHtml;
    }

    /**
     * Function getTemplateHtml
     *
     * @param string $controllerName controllerName
     * @param string $templateName templateName
     * @param string $variables variables
     *
     * @return string
     */
    public function getTemplateHtml($controllerName, $templateName, $variables = array())
    {
        $tempView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(
            \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
        );
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            $extbaseFrameworkConfiguration['view']['templateRootPaths'][0]
        );

        $templatePathAndFilename = $templateRootPath . '/Email/' . $templateName . '.html';
        $tempView->setTemplatePathAndFilename($templatePathAndFilename);
        $variables['site_root'] = PATH_site;
        $tempView->assignMultiple($variables);
        $tempHtml = $tempView->render();
        return $tempHtml;
    }

    /**
     * Function sendMail
     *
     * @param string $from from
     * @param string $to to
     * @param string $notification notification
     * @param array $templateVariables templateVariables
     * @param string $attachements attachements
     *
     * @return void
     */
    public function sendMail($from, $to, $notification = 0, array $templateVariables = array(), $attachements = 0)
    {

        if ($notification == 'admin') {
            $subject = $this->settings['querySubjectAdmin'];

            $body = $this->getTemplateHtml('', 'SendContactDataForAdmin', $templateVariables);

        }
        if ($notification == 'user') {
            $subject = $this->settings['querySubjectUser'];
            $body = $this->getTemplateHtml('', 'SendContactDataForUser', $templateVariables);
        }
        $mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
        return $mail->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body, 'text/html')
            ->setContentType('text/html')
            ->attach(\Swift_Attachment::fromPath($attachements))
            ->send();


    }

    /**
     * Function sendQuoteMail
     *
     * @param string $from from
     * @param string $to to
     * @param string $notification notification
     * @param array $templateVariables templateVariables
     * @param string $attachements attachements
     *
     * @return void
     */
    public function sendQuoteMail($from, $to, $notification = 0, array $templateVariables = array(), $attachements = 0)
    {

        if ($notification == 'admin') {
            $subject = $this->settings['Quote']['subjectAdmin'];
            $body = $this->getTemplateHtml('', 'QuoteAdminEmail', $templateVariables);
        }
        if ($notification == 'user') {
            $subject = $this->settings['Quote']['subjectUser'];
            $body = $this->getTemplateHtml('', 'QuoteUserMail', $templateVariables);
        }
        $mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
        return $mail->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body, 'text/html')
            ->setContentType('text/html')
            ->attach(\Swift_Attachment::fromPath($attachements))
            ->send();


    }
    /**
     * Validate Email
     *
     * @param String $email Email
     *
     * @return bool
     */
    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
}
