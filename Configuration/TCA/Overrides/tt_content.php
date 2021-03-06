<?php

/***************
 * Add Palettes for Generic usage
 */
$GLOBALS['TCA']['tt_content']['palettes']['imageblock'] = [
    'showitem' => '
        imageorient,
        imagecols'
];
$GLOBALS['TCA']['tt_content']['palettes']['mediablock'] = [
    'showitem' => '
        imageorient,
        imagecols'
];
$GLOBALS['TCA']['tt_content']['palettes']['header'] = [
    'showitem' => '
        header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
        --linebreak--,
        subheader;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:subheader_formlabel,
        --linebreak--,
        header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,
        header_position;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_position_formlabel,
        --linebreak--,
        header_link;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel,
        --linebreak--'
];
$GLOBALS['TCA']['tt_content']['palettes']['frames'] = [
    'showitem' => '
        layout,
        section_frame',
];
$GLOBALS['TCA']['tt_content']['palettes']['tablelayout'] = [
    'showitem' => '
        table_header_position,
        table_tfoot',
];

/***************
 * Adjust columns for generic usage
 */
$GLOBALS['TCA']['tt_content']['columns']['header_position'] = [
    'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.header_position',
    'exclude' => true,
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.header_position.default',''],
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.header_position.center','center'],
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.header_position.right','right'],
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.header_position.left','left']
        ],
        'default' => ''
    ]
];
$GLOBALS['TCA']['tt_content']['columns']['section_frame'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.section_frame',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.section_frame.default','0'],
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.section_frame.invisible','1'],
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.section_frame.rulerbefore','5'],
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.section_frame.rulerafter','6'],
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.section_frame.indentcenter','10'],
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.section_frame.indentleft','11'],
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.section_frame.indentright','12'],
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.section_frame.well','20'],
            ['LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.section_frame.jumbotron','21']
        ],
        'default' => '0'
    ]
];
$GLOBALS['TCA']['tt_content']['columns']['imageorient']['config']['items'] = [
    ['LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.0', 0, 'content-beside-text-img-above-center'],
    ['LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.3', 8, 'content-beside-text-img-below-center'],
    ['LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.9', 25, 'content-beside-text-img-left'],
    ['LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.10', 26, 'content-beside-text-img-right']
];
$GLOBALS['TCA']['tt_content']['columns']['assets'] = [
    'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.assets',
    'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
        'assets',
        [
            'foreign_types' => $GLOBALS['TCA']['tt_content']['columns']['image']['config']['foreign_types']
        ],
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext']
    )
];

/***************
 * Add Content Element: Header
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['header'])) {
    $GLOBALS['TCA']['tt_content']['types']['header'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['header'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['header'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);

/***************
 * Add Content Element: Text
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['text'] = 'content-text';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:CType.I.1',
        'text',
        'content-text'
    ],
    'header',
    'after'
);
if (!is_array($GLOBALS['TCA']['tt_content']['types']['text'])) {
    $GLOBALS['TCA']['tt_content']['types']['text'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['text'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['text'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            bodytext,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription',
        'columnsOverrides' => [
            'bodytext' => [
                'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
            ]

        ]
    ]
);

/***************
 * Add Content Element: Textpic
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['textpic'] = 'content-textpic';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:CType.I.2',
        'textpic',
        'content-textpic'
    ],
    'text',
    'after'
);
if (!is_array($GLOBALS['TCA']['tt_content']['types']['textpic'])) {
    $GLOBALS['TCA']['tt_content']['types']['textpic'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['textpic'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['textpic'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            bodytext,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.images,
            image,
            --palette--;LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:palette.alignment;imageblock,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.imagelinks;imagelinks,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription',
        'columnsOverrides' => [
            'bodytext' => [
                'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
            ]

        ]
    ]
);

/***************
 * Add Content Element: Textmedia
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['textmedia'] = 'content-textpic';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:content_element.textmedia',
        'textmedia',
        'content-textpic'
    ],
    'textpic',
    'after'
);
if (!is_array($GLOBALS['TCA']['tt_content']['types']['textmedia'])) {
    $GLOBALS['TCA']['tt_content']['types']['textmedia'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['textmedia'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['textmedia'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            bodytext,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,
            assets,
            --palette--;LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:palette.alignment;mediablock,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.imagelinks;imagelinks,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription',
        'columnsOverrides' => [
            'bodytext' => [
                'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
            ]

        ]
    ]
);

/***************
 * Add Content Element: Image
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['image'] = 'content-image';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:CType.I.3',
        'image',
        'content-image'
    ],
    'textmedia',
    'after'
);
if (!is_array($GLOBALS['TCA']['tt_content']['types']['image'])) {
    $GLOBALS['TCA']['tt_content']['types']['image'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['image'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['image'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.images,
            image,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.imagelinks;imagelinks,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.imageblock;imageblock,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);

/***************
 * Add Content Element: Bullet List
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['bullets'])) {
    $GLOBALS['TCA']['tt_content']['types']['bullets'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['bullets'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['bullets'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            bodytext,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);

/***************
 * Add Content Element: Table
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['table'])) {
    $GLOBALS['TCA']['tt_content']['types']['table'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['table'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['table'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            table_caption,
            bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.table.bodytext,
            --palette--;;tableconfiguration,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.table_layout;tablelayout,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);

/***************
 * Add Content Element: HTML
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['html'])) {
    $GLOBALS['TCA']['tt_content']['types']['html'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['html'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['html'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.div_formlabel,
            bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext.ALT.html_formlabel,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);

/***************
 * Add Content Element: Uploads
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['uploads'])) {
    $GLOBALS['TCA']['tt_content']['types']['uploads'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['uploads'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['uploads'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media;uploads,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.uploads_layout;uploadslayout,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.default.hidden,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);

/***************
 * Add Content Element: Div
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['div'])) {
    $GLOBALS['TCA']['tt_content']['types']['div'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['div'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['div'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.div_formlabel,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);

/***************
 * Add Content Element: Menu
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['menu'])) {
    $GLOBALS['TCA']['tt_content']['types']['menu'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['menu'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['menu'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.menu;menu,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.menu_accessibility;menu_accessibility,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.default.hidden,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);

/***************
 * Add Content Element: Shortcut
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['shortcut'])) {
    $GLOBALS['TCA']['tt_content']['types']['shortcut'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['shortcut'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['shortcut'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.shortcut_formlabel,
            records;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:records_formlabel,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.default.hidden,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);

/***************
 * Add Content Element: List
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['list'])) {
    $GLOBALS['TCA']['tt_content']['types']['list'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['list'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['list'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            list_type;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:list_type_formlabel,
            select_key;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:select_key_formlabel,
            pages;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:pages.ALT.list_formlabel,
            recursive,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.default.hidden,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);

/***************
 * Add Content Element: Mailform
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['mailform'])) {
    $GLOBALS['TCA']['tt_content']['types']['mailform'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['mailform'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['mailform'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.script_formlabel,
            bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext.ALT.mailform,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.default.hidden,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);

/***************
 * Add Content Elements to List
 */
$backupCTypeItems = $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'];
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'] = array(
    array(
        'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:theme_name',
        '--div--'
    ),

    array(
        'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:content_element.listgroup',
        'kastenhuber_theme_listgroup',
        'content-kastenhubertheme-listgroup'
    ),
    array(
        'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:content_element.external_media',
        'kastenhuber_theme_external_media',
        'content-kastenhubertheme-externalmedia'
    ),
);
foreach ($backupCTypeItems as $key => $value) {
    $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][] = $value;
}
unset($key);
unset($value);
unset($backupCTypeItems);



/***************
 * Modify the tt_content TCA
 */
$tca = array(
    'ctrl' => array(
        'requestUpdate' => $GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] . ',icon_type',
        'typeicons' => array(
            'kastenhuber_theme_listgroup' => 'tt_content_header.gif',
        ),
        'typeicon_classes' => array(
            'kastenhuber_theme_external_media' => 'content-kastenhubertheme-externalmedia',
            'kastenhuber_theme_listgroup' => 'content-kastenhubertheme-listgroup',
        ),
    ),
    'palettes' => array(
        'kastenhuber_theme_header' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
                --linebreak--,
                subheader;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:subheader_formlabel,
                --linebreak--,
                header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,
                --linebreak--,
                header_link;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel
			'
        ),
        'kastenhuber_theme_headersimple' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
                --linebreak--,
                header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel
			'
        ),
        'kastenhuber_theme_icons' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                icon_position, icon_type, icon_size, --linebreak--,
                icon_color, icon_background, --linebreak--,
                icon
			'
        ),
        'kastenhuber_theme_external_media' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                external_media_source, --linebreak--,
                external_media_ratio
			'
        ),
    ),
    'types' => array(
        'menu' => array(
            'subtypes_excludelist' => array(
                'news' => 'selected_categories, category_field',
            ),
        ),
        'kastenhuber_theme_panel' => array(
            'columnsOverrides' => array(
                'bodytext' => array(
                    'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
                ),
            ),
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;kastenhuber_theme_headersimple,
                bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
                rte_enabled;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:rte_enabled_formlabel,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
                --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
                categories
			'
        ),
        'kastenhuber_theme_listgroup' => array(
            'columnsOverrides' => array(
                'bodytext' => array(
                    'defaultExtras' => 'nowrap'
                ),
            ),
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;kastenhuber_theme_header,
                bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext.ALT.bulletlist_formlabel,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
                --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
                categories
			'
        ),
        'kastenhuber_theme_accordion' => array(
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;kastenhuber_theme_header,
                tx_kastenhubertheme_accordion_item,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
                --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
                categories
			'
        ),
        'kastenhuber_theme_tab' => array(
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;kastenhuber_theme_header,
                tx_kastenhubertheme_tab_item,
                --div--;LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:tab.options,
                pi_flexform;LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:advanced,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
                --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
                categories
			'
        ),
        'kastenhuber_theme_carousel' => array(
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;kastenhuber_theme_header,
                tx_kastenhubertheme_carousel_item,
                --div--;LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:carousel.options,
                pi_flexform;LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:advanced,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
                --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
                categories
			'
        ),
        'kastenhuber_theme_texticon' => array(
            'columnsOverrides' => array(
                'bodytext' => array(
                    'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
                ),
            ),
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
                --palette--;LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.icon;kastenhuber_theme_icons,
                bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
                rte_enabled;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:rte_enabled_formlabel,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
                --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
                categories
			'
        ),
        'kastenhuber_theme_external_media' => array(
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
                --palette--;LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.palette.external_media;kastenhuber_theme_external_media,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
                --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
                categories
			'
        ),
    ),
    'columns' => array(
        'tx_kastenhubertheme_accordion_item' => array(
            'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:accordion_item',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_kastenhubertheme_accordion_item',
                'foreign_field' => 'tt_content',
                'appearance' => array(
                    'useSortable' => true,
                    'showSynchronizationLink' => true,
                    'showAllLocalizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => false,
                    'expandSingle' => true,
                    'enabledControls' => array(
                        'localize' => true,
                    ),
                ),
                'behaviour' => array(
                    'localizationMode' => 'select',
                    'mode' => 'select',
                    'localizeChildrenAtParentLocalization' => true,
                ),
            ),
        ),
        'tx_kastenhubertheme_tab_item' => array(
            'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:tab_item',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_kastenhubertheme_tab_item',
                'foreign_field' => 'tt_content',
                'appearance' => array(
                    'useSortable' => true,
                    'showSynchronizationLink' => true,
                    'showAllLocalizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => false,
                    'expandSingle' => true,
                    'enabledControls' => array(
                        'localize' => true,
                    ),
                ),
                'behaviour' => array(
                    'localizationMode' => 'select',
                    'mode' => 'select',
                    'localizeChildrenAtParentLocalization' => true,
                ),
            ),
        ),
        'tx_kastenhubertheme_carousel_item' => array(
            'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:carousel_item',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_kastenhubertheme_carousel_item',
                'foreign_field' => 'tt_content',
                'appearance' => array(
                    'useSortable' => true,
                    'showSynchronizationLink' => true,
                    'showAllLocalizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => false,
                    'expandSingle' => true,
                    'enabledControls' => array(
                        'localize' => true,
                    ),
                ),
                'behaviour' => array(
                    'localizationMode' => 'select',
                    'mode' => 'select',
                    'localizeChildrenAtParentLocalization' => true,
                ),
            ),
        ),
        'icon' => array(
            'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.icon',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'showIconTable' => true,
                'selicon_cols' => 14,
                'items' => array(
                    array(
                        'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:option.none',
                        0,
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/none.jpg'
                    ),
                    array(
                        'asterisk',
                        'asterisk',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0000_asterisk.jpg'
                    ),
                    array(
                        'plus',
                        'plus',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0001_plus.jpg'
                    ),
                    array(
                        'euro',
                        'euro',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0002_euro.jpg'
                    ),
                    array(
                        'minus',
                        'minus',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0003_minus.jpg'
                    ),
                    array(
                        'cloud',
                        'cloud',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0004_cloud.jpg'
                    ),
                    array(
                        'envelope',
                        'envelope',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0005_envelope.jpg'
                    ),
                    array(
                        'pencil',
                        'pencil',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0006_pencil.jpg'
                    ),
                    array(
                        'glass',
                        'glass',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0007_glass.jpg'
                    ),
                    array(
                        'music',
                        'music',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0008_music.jpg'
                    ),
                    array(
                        'search',
                        'search',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0009_search.jpg'
                    ),
                    array(
                        'heart',
                        'heart',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0010_heart.jpg'
                    ),
                    array(
                        'star',
                        'star',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0011_star.jpg'
                    ),
                    array(
                        'star-empty',
                        'star-empty',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0012_star-empty.jpg'
                    ),
                    array(
                        'user',
                        'user',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0013_user.jpg'
                    ),
                    array(
                        'film',
                        'film',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0014_film.jpg'
                    ),
                    array(
                        'th-large',
                        'th-large',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0015_th-large.jpg'
                    ),
                    array('th', 'th', 'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0016_th.jpg'),
                    array(
                        'th-list',
                        'th-list',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0017_th-list.jpg'
                    ),
                    array('ok', 'ok', 'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0018_ok.jpg'),
                    array(
                        'remove',
                        'remove',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0019_remove.jpg'
                    ),
                    array(
                        'zoom-in',
                        'zoom-in',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0020_zoom-in.jpg'
                    ),
                    array(
                        'zoom-out',
                        'zoom-out',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0021_zoom-out.jpg'
                    ),
                    array('off', 'off', 'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0022_off.jpg'),
                    array(
                        'signal',
                        'signal',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0023_signal.jpg'
                    ),
                    array('cog', 'cog', 'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0024_cog.jpg'),
                    array(
                        'trash',
                        'trash',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0025_trash.jpg'
                    ),
                    array(
                        'home',
                        'home',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0026_home.jpg'
                    ),
                    array(
                        'file',
                        'file',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0027_file.jpg'
                    ),
                    array(
                        'time',
                        'time',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0028_time.jpg'
                    ),
                    array(
                        'road',
                        'road',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0029_road.jpg'
                    ),
                    array(
                        'download-alt',
                        'download-alt',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0030_download-alt.jpg'
                    ),
                    array(
                        'download',
                        'download',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0031_download.jpg'
                    ),
                    array(
                        'upload',
                        'upload',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0032_upload.jpg'
                    ),
                    array(
                        'inbox',
                        'inbox',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0033_inbox.jpg'
                    ),
                    array(
                        'play-circle',
                        'play-circle',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0034_play-circle.jpg'
                    ),
                    array(
                        'repeat',
                        'repeat',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0035_repeat.jpg'
                    ),
                    array(
                        'refresh',
                        'refresh',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0036_refresh.jpg'
                    ),
                    array(
                        'list-alt',
                        'list-alt',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0037_list-alt.jpg'
                    ),
                    array(
                        'lock',
                        'lock',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0038_lock.jpg'
                    ),
                    array(
                        'flag',
                        'flag',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0039_flag.jpg'
                    ),
                    array(
                        'headphones',
                        'headphones',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0040_headphones.jpg'
                    ),
                    array(
                        'volume-off',
                        'volume-off',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0041_volume-off.jpg'
                    ),
                    array(
                        'volume-down',
                        'volume-down',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0042_volume-down.jpg'
                    ),
                    array(
                        'volume-up',
                        'volume-up',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0043_volume-up.jpg'
                    ),
                    array(
                        'qrcode',
                        'qrcode',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0044_qrcode.jpg'
                    ),
                    array(
                        'barcode',
                        'barcode',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0045_barcode.jpg'
                    ),
                    array('tag', 'tag', 'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0046_tag.jpg'),
                    array(
                        'tags',
                        'tags',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0047_tags.jpg'
                    ),
                    array(
                        'book',
                        'book',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0048_book.jpg'
                    ),
                    array(
                        'bookmark',
                        'bookmark',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0049_bookmark.jpg'
                    ),
                    array(
                        'print',
                        'print',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0050_print.jpg'
                    ),
                    array(
                        'camera',
                        'camera',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0051_camera.jpg'
                    ),
                    array(
                        'font',
                        'font',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0052_font.jpg'
                    ),
                    array(
                        'bold',
                        'bold',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0053_bold.jpg'
                    ),
                    array(
                        'italic',
                        'italic',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0054_italic.jpg'
                    ),
                    array(
                        'text-height',
                        'text-height',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0055_text-height.jpg'
                    ),
                    array(
                        'text-width',
                        'text-width',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0056_text-width.jpg'
                    ),
                    array(
                        'align-left',
                        'align-left',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0057_align-left.jpg'
                    ),
                    array(
                        'align-center',
                        'align-center',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0058_align-center.jpg'
                    ),
                    array(
                        'align-right',
                        'align-right',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0059_align-right.jpg'
                    ),
                    array(
                        'align-justify',
                        'align-justify',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0060_align-justify.jpg'
                    ),
                    array(
                        'list',
                        'list',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0061_list.jpg'
                    ),
                    array(
                        'indent-left',
                        'indent-left',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0062_indent-left.jpg'
                    ),
                    array(
                        'indent-right',
                        'indent-right',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0063_indent-right.jpg'
                    ),
                    array(
                        'facetime-video',
                        'facetime-video',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0064_facetime-video.jpg'
                    ),
                    array(
                        'picture',
                        'picture',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0065_picture.jpg'
                    ),
                    array(
                        'map-marker',
                        'map-marker',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0066_map-marker.jpg'
                    ),
                    array(
                        'adjust',
                        'adjust',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0067_adjust.jpg'
                    ),
                    array(
                        'tint',
                        'tint',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0068_tint.jpg'
                    ),
                    array(
                        'edit',
                        'edit',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0069_edit.jpg'
                    ),
                    array(
                        'share',
                        'share',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0070_share.jpg'
                    ),
                    array(
                        'check',
                        'check',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0071_check.jpg'
                    ),
                    array(
                        'move',
                        'move',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0072_move.jpg'
                    ),
                    array(
                        'step-backward',
                        'step-backward',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0073_step-backward.jpg'
                    ),
                    array(
                        'fast-backward',
                        'fast-backward',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0074_fast-backward.jpg'
                    ),
                    array(
                        'backward',
                        'backward',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0075_backward.jpg'
                    ),
                    array(
                        'play',
                        'play',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0076_play.jpg'
                    ),
                    array(
                        'pause',
                        'pause',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0077_pause.jpg'
                    ),
                    array(
                        'stop',
                        'stop',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0078_stop.jpg'
                    ),
                    array(
                        'forward',
                        'forward',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0079_forward.jpg'
                    ),
                    array(
                        'fast-forward',
                        'fast-forward',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0080_fast-forward.jpg'
                    ),
                    array(
                        'step-forward',
                        'step-forward',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0081_step-forward.jpg'
                    ),
                    array(
                        'eject',
                        'eject',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0082_eject.jpg'
                    ),
                    array(
                        'chevron-left',
                        'chevron-left',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0083_chevron-left.jpg'
                    ),
                    array(
                        'chevron-right',
                        'chevron-right',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0084_chevron-right.jpg'
                    ),
                    array(
                        'plus-sign',
                        'plus-sign',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0085_plus-sign.jpg'
                    ),
                    array(
                        'minus-sign',
                        'minus-sign',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0086_minus-sign.jpg'
                    ),
                    array(
                        'remove-sign',
                        'remove-sign',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0087_remove-sign.jpg'
                    ),
                    array(
                        'ok-sign',
                        'ok-sign',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0088_ok-sign.jpg'
                    ),
                    array(
                        'question-sign',
                        'question-sign',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0089_question-sign.jpg'
                    ),
                    array(
                        'info-sign',
                        'info-sign',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0090_info-sign.jpg'
                    ),
                    array(
                        'screenshot',
                        'screenshot',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0091_screenshot.jpg'
                    ),
                    array(
                        'remove-circle',
                        'remove-circle',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0092_remove-circle.jpg'
                    ),
                    array(
                        'ok-circle',
                        'ok-circle',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0093_ok-circle.jpg'
                    ),
                    array(
                        'ban-circle',
                        'ban-circle',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0094_ban-circle.jpg'
                    ),
                    array(
                        'arrow-left',
                        'arrow-left',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0095_arrow-left.jpg'
                    ),
                    array(
                        'arrow-right',
                        'arrow-right',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0096_arrow-right.jpg'
                    ),
                    array(
                        'arrow-up',
                        'arrow-up',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0097_arrow-up.jpg'
                    ),
                    array(
                        'arrow-down',
                        'arrow-down',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0098_arrow-down.jpg'
                    ),
                    array(
                        'share-alt',
                        'share-alt',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0099_share-alt.jpg'
                    ),
                    array(
                        'resize-full',
                        'resize-full',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0100_resize-full.jpg'
                    ),
                    array(
                        'resize-small',
                        'resize-small',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0101_resize-small.jpg'
                    ),
                    array(
                        'exclamation-sign',
                        'exclamation-sign',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0102_exclamation-sign.jpg'
                    ),
                    array(
                        'gift',
                        'gift',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0103_gift.jpg'
                    ),
                    array(
                        'leaf',
                        'leaf',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0104_leaf.jpg'
                    ),
                    array(
                        'fire',
                        'fire',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0105_fire.jpg'
                    ),
                    array(
                        'eye-open',
                        'eye-open',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0106_eye-open.jpg'
                    ),
                    array(
                        'eye-close',
                        'eye-close',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0107_eye-close.jpg'
                    ),
                    array(
                        'warning-sign',
                        'warning-sign',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0108_warning-sign.jpg'
                    ),
                    array(
                        'plane',
                        'plane',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0109_plane.jpg'
                    ),
                    array(
                        'calendar',
                        'calendar',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0110_calendar.jpg'
                    ),
                    array(
                        'random',
                        'random',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0111_random.jpg'
                    ),
                    array(
                        'comment',
                        'comment',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0112_comment.jpg'
                    ),
                    array(
                        'magnet',
                        'magnet',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0113_magnet.jpg'
                    ),
                    array(
                        'chevron-up',
                        'chevron-up',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0114_chevron-up.jpg'
                    ),
                    array(
                        'chevron-down',
                        'chevron-down',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0115_chevron-down.jpg'
                    ),
                    array(
                        'retweet',
                        'retweet',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0116_retweet.jpg'
                    ),
                    array(
                        'shopping-cart',
                        'shopping-cart',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0117_shopping-cart.jpg'
                    ),
                    array(
                        'folder-close',
                        'folder-close',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0118_folder-close.jpg'
                    ),
                    array(
                        'folder-open',
                        'folder-open',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0119_folder-open.jpg'
                    ),
                    array(
                        'resize-vertical',
                        'resize-vertical',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0120_resize-vertical.jpg'
                    ),
                    array(
                        'resize-horizontal',
                        'resize-horizontal',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0121_resize-horizontal.jpg'
                    ),
                    array('hdd', 'hdd', 'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0122_hdd.jpg'),
                    array(
                        'bullhorn',
                        'bullhorn',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0123_bullhorn.jpg'
                    ),
                    array(
                        'bell',
                        'bell',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0124_bell.jpg'
                    ),
                    array(
                        'certificate',
                        'certificate',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0125_certificate.jpg'
                    ),
                    array(
                        'thumbs-up',
                        'thumbs-up',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0126_thumbs-up.jpg'
                    ),
                    array(
                        'thumbs-down',
                        'thumbs-down',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0127_thumbs-down.jpg'
                    ),
                    array(
                        'hand-right',
                        'hand-right',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0128_hand-right.jpg'
                    ),
                    array(
                        'hand-left',
                        'hand-left',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0129_hand-left.jpg'
                    ),
                    array(
                        'hand-up',
                        'hand-up',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0130_hand-up.jpg'
                    ),
                    array(
                        'hand-down',
                        'hand-down',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0131_hand-down.jpg'
                    ),
                    array(
                        'circle-arrow-right',
                        'circle-arrow-right',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0132_circle-arrow-right.jpg'
                    ),
                    array(
                        'circle-arrow-left',
                        'circle-arrow-left',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0133_circle-arrow-left.jpg'
                    ),
                    array(
                        'circle-arrow-up',
                        'circle-arrow-up',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0134_circle-arrow-up.jpg'
                    ),
                    array(
                        'circle-arrow-down',
                        'circle-arrow-down',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0135_circle-arrow-down.jpg'
                    ),
                    array(
                        'globe',
                        'globe',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0136_globe.jpg'
                    ),
                    array(
                        'wrench',
                        'wrench',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0137_wrench.jpg'
                    ),
                    array(
                        'tasks',
                        'tasks',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0138_tasks.jpg'
                    ),
                    array(
                        'filter',
                        'filter',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0139_filter.jpg'
                    ),
                    array(
                        'briefcase',
                        'briefcase',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0140_briefcase.jpg'
                    ),
                    array(
                        'fullscreen',
                        'fullscreen',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0141_fullscreen.jpg'
                    ),
                    array(
                        'dashboard',
                        'dashboard',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0142_dashboard.jpg'
                    ),
                    array(
                        'paperclip',
                        'paperclip',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0143_paperclip.jpg'
                    ),
                    array(
                        'heart-empty',
                        'heart-empty',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0144_heart-empty.jpg'
                    ),
                    array(
                        'link',
                        'link',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0145_link.jpg'
                    ),
                    array(
                        'phone',
                        'phone',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0146_phone.jpg'
                    ),
                    array(
                        'pushpin',
                        'pushpin',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0147_pushpin.jpg'
                    ),
                    array('usd', 'usd', 'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0148_usd.jpg'),
                    array('gbp', 'gbp', 'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0149_gbp.jpg'),
                    array(
                        'sort',
                        'sort',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0150_sort.jpg'
                    ),
                    array(
                        'sort-by-alphabet',
                        'sort-by-alphabet',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0151_sort-by-alphabet.jpg'
                    ),
                    array(
                        'sort-by-alphabet-alt',
                        'sort-by-alphabet-alt',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0152_sort-by-alphabet-alt.jpg'
                    ),
                    array(
                        'sort-by-order',
                        'sort-by-order',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0153_sort-by-order.jpg'
                    ),
                    array(
                        'sort-by-order-alt',
                        'sort-by-order-alt',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0154_sort-by-order-alt.jpg'
                    ),
                    array(
                        'sort-by-attributes',
                        'sort-by-attributes',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0155_sort-by-attributes.jpg'
                    ),
                    array(
                        'sort-by-attributes-alt',
                        'sort-by-attributes-alt',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0156_sort-by-attributes-alt.jpg'
                    ),
                    array(
                        'unchecked',
                        'unchecked',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0157_unchecked.jpg'
                    ),
                    array(
                        'expand',
                        'expand',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0158_expand.jpg'
                    ),
                    array(
                        'collapse-down',
                        'collapse-down',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0159_collapse-down.jpg'
                    ),
                    array(
                        'collapse-up',
                        'collapse-up',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0160_collapse-up.jpg'
                    ),
                    array(
                        'log-in',
                        'log-in',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0161_log-in.jpg'
                    ),
                    array(
                        'flash',
                        'flash',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0162_flash.jpg'
                    ),
                    array(
                        'log-out',
                        'log-out',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0163_log-out.jpg'
                    ),
                    array(
                        'new-window',
                        'new-window',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0164_new-window.jpg'
                    ),
                    array(
                        'record',
                        'record',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0165_record.jpg'
                    ),
                    array(
                        'save',
                        'save',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0166_save.jpg'
                    ),
                    array(
                        'open',
                        'open',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0167_open.jpg'
                    ),
                    array(
                        'saved',
                        'saved',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0168_saved.jpg'
                    ),
                    array(
                        'import',
                        'import',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0169_import.jpg'
                    ),
                    array(
                        'export',
                        'export',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0170_export.jpg'
                    ),
                    array(
                        'send',
                        'send',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0171_send.jpg'
                    ),
                    array(
                        'floppy-disk',
                        'floppy-disk',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0172_floppy-disk.jpg'
                    ),
                    array(
                        'floppy-saved',
                        'floppy-saved',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0173_floppy-saved.jpg'
                    ),
                    array(
                        'floppy-remove',
                        'floppy-remove',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0174_floppy-remove.jpg'
                    ),
                    array(
                        'floppy-save',
                        'floppy-save',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0175_floppy-save.jpg'
                    ),
                    array(
                        'floppy-open',
                        'floppy-open',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0176_floppy-open.jpg'
                    ),
                    array(
                        'credit-card',
                        'credit-card',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0177_credit-card.jpg'
                    ),
                    array(
                        'transfer',
                        'transfer',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0178_transfer.jpg'
                    ),
                    array(
                        'cutlery',
                        'cutlery',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0179_cutlery.jpg'
                    ),
                    array(
                        'header',
                        'header',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0180_header.jpg'
                    ),
                    array(
                        'compressed',
                        'compressed',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0181_compressed.jpg'
                    ),
                    array(
                        'earphone',
                        'earphone',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0182_earphone.jpg'
                    ),
                    array(
                        'phone-alt',
                        'phone-alt',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0183_phone-alt.jpg'
                    ),
                    array(
                        'tower',
                        'tower',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0184_tower.jpg'
                    ),
                    array(
                        'stats',
                        'stats',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0185_stats.jpg'
                    ),
                    array(
                        'sd-video',
                        'sd-video',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0186_sd-video.jpg'
                    ),
                    array(
                        'hd-video',
                        'hd-video',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0187_hd-video.jpg'
                    ),
                    array(
                        'subtitles',
                        'subtitles',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0188_subtitles.jpg'
                    ),
                    array(
                        'sound-stereo',
                        'sound-stereo',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0189_sound-stereo.jpg'
                    ),
                    array(
                        'sound-dolby',
                        'sound-dolby',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0190_sound-dolby.jpg'
                    ),
                    array(
                        'sound-5-1',
                        'sound-5-1',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0191_sound-5-1.jpg'
                    ),
                    array(
                        'sound-6-1',
                        'sound-6-1',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0192_sound-6-1.jpg'
                    ),
                    array(
                        'sound-7-1',
                        'sound-7-1',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0193_sound-7-1.jpg'
                    ),
                    array(
                        'copyright-mark',
                        'copyright-mark',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0194_copyright-mark.jpg'
                    ),
                    array(
                        'registration-mark',
                        'registration-mark',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0195_registration-mark.jpg'
                    ),
                    array(
                        'cloud-download',
                        'cloud-download',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0196_cloud-download.jpg'
                    ),
                    array(
                        'cloud-upload',
                        'cloud-upload',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0197_cloud-upload.jpg'
                    ),
                    array(
                        'tree-conifer',
                        'tree-conifer',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0198_tree-conifer.jpg'
                    ),
                    array(
                        'tree-deciduous',
                        'tree-deciduous',
                        'EXT:kastenhuber_theme/Resources/Public/Images/Icons/icon-shapes_0199_tree-deciduous.jpg'
                    ),
                ),
            ),
        ),
        'icon_position' => array(
            'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.icon_position',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array('LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:option.left', 'left'),
                    array('LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:option.right', 'right'),
                    array('LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:option.top', 'top'),
                ),
            ),
        ),
        'icon_type' => array(
            'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.icon_type',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => '0',
                'items' => array(
                    array('LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:option.default', 0),
                    array('LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:option.square', 1),
                    array('LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:option.circle', 2),
                ),
            ),
        ),
        'icon_size' => array(
            'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.icon_size',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array('LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:option.default', 0),
                    array('LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:option.medium', 1),
                    array('LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:option.large', 2),
                    array('LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:option.awesome', 3),
                ),
            ),
        ),
        'icon_color' => array(
            'displayCond' => 'FIELD:icon_type:!=:0',
            'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.icon_color',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim',
                'default' => '#FFFFFF',
                'wizards' => array(
                    'colorChoice' => array(
                        'type' => 'colorbox',
                        'title' => 'LLL:EXT:lang/locallang_wizards:colorpicker_title',
                        'module' => array(
                            'name' => 'wizard_colorpicker'
                        ),
                        'dim' => '20x20',
                        'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
                    ),
                ),
            ),
        ),
        'icon_background' => array(
            'displayCond' => 'FIELD:icon_type:!=:0',
            'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.icon_background',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim',
                'default' => '#333333',
                'wizards' => array(
                    'colorChoice' => array(
                        'type' => 'colorbox',
                        'title' => 'LLL:EXT:lang/locallang_wizards:colorpicker_title',
                        'module' => array(
                            'name' => 'wizard_colorpicker'
                        ),
                        'dim' => '20x20',
                        'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
                    ),
                ),
            ),
        ),
        'external_media_source' => array(
            'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.external_media_source',
            'config' => array(
                'type' => 'input',
                'size' => 50,
                'eval' => 'trim',
                'max' => 1024,
            ),
        ),
        'external_media_ratio' => array(
            'label' => 'LLL:EXT:kastenhuber_theme/Resources/Private/Language/Backend.xlf:field.external_media_ratio',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array('16:9', '16by9'),
                    array('4:3', '4by3'),
                ),
            ),
        ),
    ),
);
$GLOBALS['TCA']['tt_content'] = array_replace_recursive($GLOBALS['TCA']['tt_content'], $tca);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable('kastenhuber_theme', 'tt_content', 'categories', array(), true);
