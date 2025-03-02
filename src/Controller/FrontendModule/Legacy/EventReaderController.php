<?php

declare(strict_types=1);

namespace Codesache\AddRelCanonicalBundle\Controller\FrontendModule\Legacy;

//use Codesache\AddRelCanonicalBundle\Controller\FrontendModule\FragmentTemplate;
use Codesache\AddRelCanonicalBundle\Helper\HeadBagHelper;
use Contao\CalendarEventsModel;
use Contao\Input;
use Contao\ModuleEventReader;

class EventReaderController extends ModuleEventReader
{
    // public const TYPE = 'eventreader';

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

        $model = CalendarEventsModel::findByAlias($alias);

        if (null === $model) {
            return;
        }
        HeadBagHelper::setRelCanonical($model->row());
    }

}