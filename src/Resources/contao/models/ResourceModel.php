<?php

namespace Oveleon\ContaoResourceInsertTag;

use Contao\Model;

/**
 * Reads and writes resources
 *
 * @property integer $id
 * @property string  $title
 * @property string  $alias
 * @property string  $source
 * @property string  $dataType
 * @property string  $method
 *
 * @method static ResourceModel|null findById($id, array $opt=array())
 * @method static ResourceModel|null findByPk($id, array $opt=array())
 * @method static ResourceModel|null findOneBy($col, $val, array $opt=array())
 * @method static ResourceModel|null findByTitle($val, array $opt=array())
 *
 * @method static Collection|ResourceModel[]|ResourceModel|null findMultipleByIds($val, array $opt=array())
 * @method static Collection|ResourceModel[]|ResourceModel|null findBy($col, $val, array $opt=array())
 * @method static Collection|ResourceModel[]|ResourceModel|null findAll(array $opt=array())
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class ResourceModel extends Model
{
	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_resource';

}
