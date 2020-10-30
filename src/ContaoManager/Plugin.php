<?php

declare(strict_types=1);

namespace Oveleon\ContaoResourceInsertTag\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Oveleon\ContaoResourceInsertTag\ContaoResourceInsertTag;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoResourceInsertTag::class)
                ->setLoadAfter([ContaoCoreBundle::class])
                ->setReplace(['resource-insert-tags']),
        ];
    }
}
