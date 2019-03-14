<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "GRCR.KastenhuberTheme".
 *
 * Auto generated 14-04-2016 15:02
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'KASTENHUBER THEME',
	'description' => 'Theme Extension für den KREATIKA KERN',
	'category' => 'misc',
	'shy' => 0,
	'version' => '7.6.5',
	'dependencies' => 'cms,extbase,fluid,flux,fluidpages,fluidcontent,vhs',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'author' => 'Maximilian Grimm',
	'author_email' => 'grimm@grimmcreative.com',
	'author_company' => 'GRIMMCREATIVE',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.5-7.6.99',
			'extbase' => '',
			'fluid' => '',
			'flux' => '',
			'fluidpages' => '',
			'fluidcontent' => '',
			'vhs' => '',
			'kreatika_kern' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'autoload' =>
		array (
			'psr-4' =>
				array (
					'GRCR\\KastenhuberTheme\\' => 'Classes',
				),
		),

	'_md5_values_when_last_written' => 'a:0:{}',
	'suggests' => array(
	),
);
