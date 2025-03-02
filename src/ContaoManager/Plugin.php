<?php

declare(strict_types=1);

namespace Codesache\AddRelCanonicalBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\FaqBundle\ContaoFaqBundle;
use Contao\NewsBundle\ContaoNewsBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Codesache\AddRelCanonicalBundle\AddRelCanonicalBundle;
use Oveleon\ContaoGlossaryBundle\ContaoGlossaryBundle;
use Contao\CalendarBundle\ContaoCalendarBundle;


class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(AddRelCanonicalBundle::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    ContaoNewsBundle::class,
                    ContaoCalendarBundle::class,
                    ContaoFaqBundle::class,
                    ContaoGlossaryBundle::class
                ])
        ];
    }

}