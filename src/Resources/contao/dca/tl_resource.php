<?php

/*
 * This file is part of Oveleon Isotope Product License.
 *
 * (c) https://www.oveleon.de/
 */
$GLOBALS['TL_DCA']['tl_resource'] = [
	// Config
	'config' => [
		'dataContainer'               => 'Table',
        'ctable'                      => ['tl_resource_tag'],
        'enableVersioning'            => true,
		'sql' => [
			'keys' => [
				'id' => 'primary'
            ]
        ]
    ],

	// List
	'list' => [
		'sorting' => [
			'mode'                    => 2,
			'fields'                  => ['title'],
			'panelLayout'             => 'sort,limit'
        ],
		'label' => [
            'fields'                  => ['title'],
            'showColumns'             => true
        ],
		'global_operations' => [
			'all' => [
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            ]
        ],
		'operations' => [
            'edit' => [
                'href'                => 'table=tl_resource_tag',
                'icon'                => 'edit.svg',
            ],
            'editheader' => [
                'href'                => 'act=edit',
                'icon'                => 'header.svg',
            ],
			'delete' => [
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null). '\'))return false;Backend.getScrollOffset()"'
            ],
			'show' => [
				'href'                => 'act=show',
				'icon'                => 'show.svg'
            ]
        ]
    ],

	// Palettes
	'palettes' => [
		'default'                     => '{title_legend},title,alias;{resource_legend},source,method,dataType;',
    ],

	// Fields
	'fields' => [
		'id' => [
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' => [
            'sql'                     => "int(10) unsigned NOT NULL default 0"
        ],
        'alias' => [
            'exclude'                 => true,
            'inputType'               => 'text',
            'search'                  => true,
            'eval'                    => ['rgxp'=>'alias', 'mandatory'=>true, 'doNotCopy'=>true, 'maxlength'=>255, 'tl_class'=>'w50'],
            'sql'                     => "varchar(255) BINARY NOT NULL default ''"
        ],
		'title' => [
			'exclude'                 => true,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => ['mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'],
			'sql'                     => "varchar(255) NOT NULL default ''"
        ],
		'source' => [
			'inputType'               => 'text',
			'eval'                    => ['mandatory'=>true, 'tl_class'=>'w50'],
			'sql'                     => "varchar(255) NOT NULL default ''"
        ],
		'dataType' => [
			'inputType'               => 'select',
            'options'                 => ['json' => 'JSON'],
			'eval'                    => ['mandatory'=>true, 'tl_class'=>'w50'],
			'sql'                     => "varchar(255) NOT NULL default ''"
        ],
        'method' => [
            'inputType'               => 'select',
			'options'                 => ['GET', 'POST'],
			'eval'                    => ['tl_class'=>'w50'],
			'sql'                     => "varchar(255) NOT NULL default ''"
        ]
    ]
];
