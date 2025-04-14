<?php

declare(strict_types=1);

namespace Codesache\AddRelCanonicalBundle\Helper;

use Contao\CoreBundle\Routing\ResponseContext\HtmlHeadBag\HtmlHeadBag;
use Contao\CoreBundle\Routing\ResponseContext\ResponseContext;
use Contao\PageModel;
use Contao\System;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;

class HeadBagHelper
{
    public static function setRelCanonical(array $data): void
    {
        /** @var ResponseContext $responseContext */
        $responseContext = System::getContainer()->get('contao.routing.response_context_accessor')->getResponseContext();

        if ($responseContext && $responseContext->has(HtmlHeadBag::class))
        {
            /** @var HtmlHeadBag $headBag */
            $headBag = $responseContext->get(HtmlHeadBag::class);

            switch ($data['canonicalType']) {
                case DcaHelper::RELCANONICAL_EXTERNAL:
                    $headBag->setCanonicalUri($data['canonicalWebsite']);
                    break;
                case DcaHelper::RELCANONICAL_INTERNAL:
                    $contaoPageId = $data['canonicalJumpTo'];
                    $pageModel = PageModel::findById($contaoPageId);
                    //dump($pageModel?->getFrontendUrl());
                    //dd($pageModel?->getAbsoluteUrl());
                    $headBag->setCanonicalUri($pageModel?->getAbsoluteUrl() ?? 'page_'.$contaoPageId);
                    break;
                case DcaHelper::RELCANONICAL_SELF:
                    // Passing an empty string to setCanonicalUri() will make it generate a link to the current page
                    $headBag->setCanonicalUri('');
                    break;
                case DcaHelper::RELCANONICAL_DONOTSET:
                case DcaHelper::RELCANONICAL_NO_VALUE_SET: // if nothing is set, i.e. the blank option is selected (BC for existing data)
                    // do not set anything (the rel="canonical" attribute will be set by contao then!
                    break;
                default:
                    throw new RuntimeException(sprintf("unexpected canonical type '%s'", $data['canonicalType']));
            }

        }
    }

}