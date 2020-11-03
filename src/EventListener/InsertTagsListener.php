<?php

declare(strict_types=1);

namespace Oveleon\ContaoResourceInsertTag\EventListener;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\System;
use Oveleon\ContaoResourceInsertTag\ResourceModel;
use Oveleon\ContaoResourceInsertTag\ResourceTagModel;
use Symfony\Component\HttpClient\CachingHttpClient;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Handles insert tags for resources.
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class InsertTagsListener
{
    /**
     * @var ContaoFramework
     */
    private $framework;

    /**
     * Constructor.
     *
     * @param ContaoFramework $framework
     */
    public function __construct(ContaoFramework $framework)
    {
        $this->framework = $framework;
    }

    /**
     * Replaces license insert tags.
     *
     * @param string $tag
     *
     * @return string|false
     */
    public function onReplaceInsertTags(string $tag)
    {
        $strValue = '';
        $elements = explode('::', $tag);
        $key = strtolower($elements[0]);
        $tok = strtolower($elements[1]);
        $objResource = ResourceModel::findByIdOrAlias($key);

        if(null !== $objResource)
        {
            $store = new Store(System::getContainer()->getParameter('kernel.cache_dir'));
            $client = new CachingHttpClient(HttpClient::create(), $store);
            $response = $client->request($objResource->method, $objResource->source);

            if(200 === $response->getStatusCode())
            {
                $content = $response->getContent();
                $objInsertTag = ResourceTagModel::findByIdOrAlias($tok);

                if(null !== $objInsertTag)
                {
                    switch($objResource->dataType)
                    {
                        case 'json':
                            $strValue = $this->replaceFromJSON($objInsertTag, $content);
                            break;
                        default:
                            // HOOK: custom data type
                            if (isset($GLOBALS['TL_HOOKS']['replaceResourceInsertTag']) && \is_array($GLOBALS['TL_HOOKS']['replaceResourceInsertTag']))
                            {
                                foreach ($GLOBALS['TL_HOOKS']['replaceResourceInsertTag'] as $callback)
                                {
                                    $strValue = System::importStatic($callback[0])->{$callback[1]}($objInsertTag, $content, $this);
                                }
                            }
                    }

                    if(!$strValue)
                    {
                        if($objInsertTag->default){
                            $strValue = $objInsertTag->default;
                        }

                        return $strValue;
                    }
                    elseif($objInsertTag->placeholder)
                    {
                        return sprintf($objInsertTag->placeholderText, $strValue);
                    }
                    else
                    {
                        return $strValue;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Replaces from json
     *
     * @param $objInsertTag
     * @param $content
     *
     * @return string
     */
    private function replaceFromJSON($objInsertTag, $content)
    {
        $arrContent = json_decode($content, true);

        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        return $propertyAccessor->getValue($arrContent, $objInsertTag->path);
    }
}
