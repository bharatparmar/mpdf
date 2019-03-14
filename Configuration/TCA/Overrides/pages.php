<?php

/***************
 * Temporary variables
 */
$extensionKey = 'kastenhuber_theme';

/***************
 * Register PageTS
 */

// AdminPanel
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/admPanel.txt',
    'Kastenhuber Theme: Admin Panel'
);

// TCEMAIN
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/TCEMAIN.txt',
    'Kastenhuber Theme: TCEMAIN'
);

// TCEFORM
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/TCEFORM.txt',
    'Kastenhuber Theme: TCEFORM'
);

// RTE
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/RTE.txt',
    'Kastenhuber Theme: RTE'
);

// TtContent Previews
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/Mod/WebLayout/TtContent/preview.txt',
    'Kastenhuber Theme: Content Previews'
);

// New Content element wizards
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/Mod/Wizards/newContentElement.txt',
    'Kastenhuber Theme: New Content Element Wizards'
);
