<?php
$GLOBALS['TL_DCA']['tl_resource_tag'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
        'ptable'                      => 'tl_resource',
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
        'sorting' => array
        (
            'mode'                    => 4,
            'fields'                  => array('alias','tstamp'),
            'panelLayout'             => 'limit',
            'headerFields'            => array('title', 'alias'),
            'child_record_callback'   => array('tl_resource_tag', 'listTags'),
            'disableGrouping'         => true
        ),
		'label' => array
		(
            'fields'                  => array('title', 'product'),
            'showColumns'             => true
		),
		'global_operations' => array
		(
			'all' => array
			(
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'href'                => 'act=edit',
				'icon'                => 'edit.svg'
			),
			'delete' => array
			(
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'href'                => 'act=show',
				'icon'                => 'show.svg'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
	    '__selector__'                => ['published'],
		'default'                     => '{settings_legend},alias,path',
	),

	// Subpalettes
	'subpalettes' => array
	(
		'published'                     => 'member',
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
        'pid' => array
        (
            'foreignKey'              => 'tl_license.title',
            'sql'                     => "int(10) unsigned NOT NULL default 0",
            'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default 0"
        ),
        'alias' => array
        (
            'exclude'                 => true,
            'inputType'               => 'text',
            'search'                  => true,
            'eval'                    => array('rgxp'=>'alias', 'mandatory'=>true, 'doNotCopy'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) BINARY NOT NULL default ''"
        ),
        'path' => array
        (
            'exclude'                 => true,
            'inputType'               => 'text',
            'search'                  => true,
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) BINARY NOT NULL default ''" // ToDo: Increase
        )
	)
);

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
