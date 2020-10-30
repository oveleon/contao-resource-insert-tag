<?php

namespace Oveleon\ContaoResourceInsertTag;

use Contao\Model;

/**
 * Reads and writes resource tags
 *
 * @property integer $id
 * @property integer $pid
 * @property string  $published
 *
 * @method static ResourceTagModel|null findById($id, array $opt=array())
 * @method static ResourceTagModel|null findByPk($id, array $opt=array())
 * @method static ResourceTagModel|null findOneBy($col, $val, array $opt=array())
 * @method static ResourceTagModel|null findOneByPid($val, array $opt=array())
 * @method static ResourceTagModel|null findOneByPublished($val, array $opt=array())
 *
 * @method static Collection|ResourceTagModel[]|ResourceTagModel|null findByPid($val, array $opt=array())
 * @method static Collection|ResourceTagModel[]|ResourceTagModel|null findByTstamp($val, array $opt=array())
 * @method static Collection|ResourceTagModel[]|ResourceTagModel|null findMultipleByIds($val, array $opt=array())
 * @method static Collection|ResourceTagModel[]|ResourceTagModel|null findBy($col, $val, array $opt=array())
 * @method static Collection|ResourceTagModel[]|ResourceTagModel|null findByPublished($val, array $opt=array())
 * @method static Collection|ResourceTagModel[]|ResourceTagModel|null findAll(array $opt=array())
 *
 * @method static integer countById($id, array $opt=array())
 * @method static integer countByPid($val, array $opt=array())
 * @method static integer countByTstamp($val, array $opt=array())
 * @method static integer countByMember($val, array $opt=array())
 * @method static integer countByPublished($val, array $opt=array())
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class ResourceTagModel extends Model
{
	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_resource_tag';

}
