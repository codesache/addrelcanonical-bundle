<?php

declare(strict_types=1);

namespace Codesache\AddRelCanonicalBundle\Controller\FrontendModule\Legacy;

//use Codesache\AddRelCanonicalBundle\Controller\FrontendModule\FragmentTemplate;
use Codesache\AddRelCanonicalBundle\Helper\HeadBagHelper;
use Contao\Input;
use Contao\ModuleNewsReader;
use Contao\NewsModel;

class NewsReaderController extends ModuleNewsReader
{
    //public const TYPE = 'newsreader';

    /** @noinspection PhpMissingReturnTypeInspection */
    public function generate()
    {
        $result = parent::generate();
        $this->setRelCanonical(Input::get('auto_item'));

        return $result;
    }

    protected function setRelCanonical(?string $alias): void
    {
        if (null === $alias) {
            return;
        }

        $model = NewsModel::findByAlias($alias);

        if (null === $model) {
            return;
        }
        HeadBagHelper::setRelCanonical($model->row());
    }

}