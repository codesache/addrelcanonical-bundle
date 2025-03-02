<?php

declare(strict_types=1);

namespace Codesache\AddRelCanonicalBundle\Controller\FrontendModule;

use Codesache\AddRelCanonicalBundle\Helper\HeadBagHelper;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\Input;
use Contao\ModuleModel;
use Contao\StringUtil;
use Contao\Template;
use Oveleon\ContaoGlossaryBundle\Model\GlossaryItemModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;
use Oveleon\ContaoGlossaryBundle\Controller\FrontendModule\GlossaryReaderController as OveleonGlossaryReaderController;

#[AsFrontendModule(OveleonGlossaryReaderController::TYPE, category: 'glossaries', template: 'mod_'.OveleonGlossaryReaderController::TYPE, priority: 1)]
class GlossaryReaderController extends OveleonGlossaryReaderController
{
    //public const TYPE = 'glossaryreadercanonical';

    public function __construct(
        private readonly ScopeMatcher $scopeMatcher,
        private readonly TranslatorInterface $translator,
    ) {
        parent::__construct($this->scopeMatcher, $this->translator);
    }

    protected function getResponse(FragmentTemplate|Template $template, ModuleModel $model, Request $request): Response
    {
        if (!$this->scopeMatcher->isBackendRequest($request)) {
            /** @noinspection PhpUndefinedFieldInspection */
            $archiveIds = StringUtil::deserialize($model->glossary_archives, true);
            $glossaryModel = GlossaryItemModel::findPublishedByParentAndIdOrAlias(Input::get('auto_item'), $archiveIds);
            if (null !== $glossaryModel) {
                HeadBagHelper::setRelCanonical($glossaryModel->row());
            }
        }
        return parent::getResponse($template, $model, $request);
    }

//    protected function setRelCanonical(array $data): void
//    {
//
//        $responseContext = System::getContainer()->get('contao.routing.response_context_accessor')->getResponseContext();
//
//        if ($responseContext && $responseContext->has(HtmlHeadBag::class))
//        {
//            /** @var HtmlHeadBag $headBag */
//            $headBag = $responseContext->get(HtmlHeadBag::class);
//
//            switch ($data['canonicalType']) {
//                case 'external':
//                    $headBag->setCanonicalUri($data['canonicalWebsite']);
//                    break;
//                case 'internal':
//                    $contaoPageId = $data['canonicalJumpTo'];
//                    $pageModel = PageModel::findById($contaoPageId);
//                    $headBag->setCanonicalUri($pageModel?->getFrontendUrl() ?? 'page_'.$contaoPageId);
//                    break;
//                case 'self':
//                    // Passing an empty string to setCanonicalUri() will make it generate a link to the current page
//                    $headBag->setCanonicalUri('');
//                    break;
//                case 'donotset':
//                    // do not set anything (the rel="canonical" attribute will be set by contao then!
//                    break;
//                default:
//                    throw new RuntimeException(sprintf("unexpected glossary item canonical type '%s'", $data['canonicalType']));
//            }
//        }
//    }
}

