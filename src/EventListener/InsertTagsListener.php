<?php

declare(strict_types=1);

namespace Oveleon\ContaoResourceInsertTag\EventListener;

use Contao\CoreBundle\Framework\ContaoFramework;
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
        $elements = explode('::', $tag);
        $key = strtolower($elements[0]);
        $tok = strtolower($elements[1]);
        $objResource = ResourceModel::findByIdOrAlias($key);

        if(null !== $objResource)
        {
            $httpClient = HttpClient::create();
            $response = $httpClient->request('GET', $objResource->source);

            // ToDo: Caching
            #$store = new Store('/path/to/cache/storage/');
            #$client = HttpClient::create();
            #$client = new CachingHttpClient($client, $store);
            #$response = $client->request('GET', 'https://example.com/cacheable-resource');

            if(200 === $response->getStatusCode())
            {
                $content = $response->getContent();
                $objInsertTag = ResourceTagModel::findByIdOrAlias($tok);

                if(null !== $objInsertTag)
                {
                    switch($objResource->dataType)
                    {
                        case 'json':
                            return $this->replaceFromJSON($objInsertTag, $content);
                        default:
                            // ToDo: Hook
                            return '';
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
