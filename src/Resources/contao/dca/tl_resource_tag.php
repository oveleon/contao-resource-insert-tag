<?php

$GLOBALS['TL_DCA']['tl_resource_tag'] = [
	// Config
	'config' => [
		'dataContainer'               => 'Table',
        'ptable'                      => 'tl_resource',
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
            'mode'                    => 4,
            'fields'                  => ['alias','tstamp'],
            'panelLayout'             => 'limit',
            'headerFields'            => ['title', 'alias'],
            'child_record_callback'   => ['tl_resource_tag', 'listTags'],
            'disableGrouping'         => true
        ],
		'label' => [
            'fields'                  => ['title', 'product'],
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
				'href'                => 'act=edit',
				'icon'                => 'edit.svg'
            ],
			'delete' => [
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\'))return false;Backend.getScrollOffset()"'
            ],
			'show' => [
				'href'                => 'act=show',
				'icon'                => 'show.svg'
            ]
        ]
    ],

	// Palettes
	'palettes' => [
	    '__selector__'                => ['placeholder'],
		'default'                     => '{settings_legend},alias,path;{config_legend},default,placeholder',
    ],

	// Subpalettes
	'subpalettes' => [
		'placeholder'                 => 'placeholderText',
    ],

	// Fields
	'fields' => [
		'id' => [
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ],
        'pid' => [
            'foreignKey'              => 'tl_license.title',
            'sql'                     => "int(10) unsigned NOT NULL default 0",
            'relation'                => ['type'=>'belongsTo', 'load'=>'lazy']
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
        'path' => [
            'exclude'                 => true,
            'inputType'               => 'text',
            'search'                  => true,
            'eval'                    => ['mandatory'=>true, 'maxlength'=>255, 'preserveTags'=>true, 'tl_class'=>'w50'],
            'sql'                     => "text NULL"
        ],
        'default' => [
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['maxlength'=>255, 'tl_class'=>'w50'],
            'sql'                     => "varchar(255) BINARY NOT NULL default ''"
        ],
        'placeholder' => [
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class'=>'w50 m12', 'submitOnChange'=>true],
            'sql'                     => "char(1) NOT NULL default ''"
        ],
        'placeholderText' => [
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'textarea',
            'eval'                    => ['mandatory'=>true, 'allowHtml'=>true],
            'sql'                     => "mediumtext NULL"
        ]
    ]
];

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class tl_resource_tag extends \Contao\Backend
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('Contao\BackendUser', 'User');
	}

    /**
     * List a single licence
     *
     * @param array $row
     *
     * @return string
     */
    public function listTags(array $row)
    {
        $resource = \Oveleon\ContaoResourceInsertTag\ResourceModel::findById($row['pid']);

        return '<div class="tl_content_left"><span class="tl_gray">{{' . $resource->alias . '::</span>' . $row['alias'] . '<span class="tl_gray">}}</span></div>';
    }
}
