<?php

use Contao\System;
use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Codesache\AddRelCanonicalBundle\Helper\DcaHelper;

if (in_array('ContaoFaqBundle', array_keys(System::getContainer()->getParameter('kernel.bundles')), true)) {

    PaletteManipulator::create()
        ->addLegend('rel_canonical_legend', 'publish_legend', PaletteManipulator::POSITION_BEFORE)
        ->addField('canonicalType', 'rel_canonical_legend', PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('default', 'tl_faq');

    $GLOBALS['TL_DCA']['tl_faq']['palettes']['__selector__'][] = 'canonicalType';
    $GLOBALS['TL_DCA']['tl_faq']['subpalettes']['canonicalType_'.DcaHelper::RELCANONICAL_INTERNAL] = 'canonicalJumpTo';
    $GLOBALS['TL_DCA']['tl_faq']['subpalettes']['canonicalType_'.DcaHelper::RELCANONICAL_EXTERNAL] = 'canonicalWebsite';

    $GLOBALS['TL_DCA']['tl_faq']['fields']['canonicalType'] = [
        'exclude' => true,
        'inputType' => 'select',
        'options' => [DcaHelper::RELCANONICAL_DONOTSET, DcaHelper::RELCANONICAL_INTERNAL, DcaHelper::RELCANONICAL_EXTERNAL, DcaHelper::RELCANONICAL_SELF],
        'reference' => &$GLOBALS['TL_LANG']['RelCanonical'],
        'eval' => ['submitOnChange' => true],
        'sql' => "varchar(32) NOT NULL default ''",
    ];

    $GLOBALS['TL_DCA']['tl_faq']['fields']['canonicalJumpTo'] = [
        'exclude' => true,
        'inputType' => 'pageTree',
        'eval' => ['fieldType' => 'radio'],
        'sql' => "int(10) unsigned NOT NULL default '0'",
        'save_callback' => [
            [DcaHelper::class, 'checkJumpTo']
        ],
    ];

    $GLOBALS['TL_DCA']['tl_faq']['fields']['canonicalWebsite'] = [
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'tl_class' => 'long'],
        'sql' => "varchar(255) NOT NULL default ''",
    ];

}