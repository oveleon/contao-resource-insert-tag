<?php

use Contao\ArrayUtil;

ArrayUtil::arrayInsert($GLOBALS['BE_MOD']['content']['resource_insert_tags'], 0, [
    'tables' => ['tl_resource', 'tl_resource_tag']
]);

// Register Models
$GLOBALS['TL_MODELS']['tl_resource']     = 'Oveleon\ContaoResourceInsertTag\ResourceModel';
$GLOBALS['TL_MODELS']['tl_resource_tag'] = 'Oveleon\ContaoResourceInsertTag\ResourceTagModel';

// Register hooks
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = ['contao_resource_insert_tag.listener.insert_tags', 'onReplaceInsertTags'];
