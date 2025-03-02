<?php

use Codesache\AddRelCanonicalBundle\Controller\FrontendModule\Legacy\EventReaderController;
use Codesache\AddRelCanonicalBundle\Controller\FrontendModule\Legacy\FaqReaderController;
use Codesache\AddRelCanonicalBundle\Controller\FrontendModule\Legacy\NewsReaderController;
use Contao\System;

$bundles = array_keys(System::getContainer()->getParameter('kernel.bundles'));

if (in_array('ContaoNewsBundle', $bundles, true)) {
    $GLOBALS['FE_MOD']['news']['newsreader'] = NewsReaderController::class;
}

if (in_array('ContaoFaqBundle', $bundles, true)) {
    $GLOBALS['FE_MOD']['faq']['faqreader'] = FaqReaderController::class;
}

if (in_array('ContaoCalendarBundle', $bundles, true)) {
    $GLOBALS['FE_MOD']['events']['eventreader'] = EventReaderController::class;
}
