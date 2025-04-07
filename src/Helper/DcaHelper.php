<?php

namespace Codesache\AddRelCanonicalBundle\Helper;

use Contao\DataContainer;
use Exception;

class DcaHelper
{
    public const string RELCANONICAL_NO_VALUE_SET = '';
    public const string RELCANONICAL_DONOTSET = 'rc_donotset';
    public const string RELCANONICAL_INTERNAL = 'rc_internal';
    public const string RELCANONICAL_EXTERNAL = 'rc_external';
    public const string RELCANONICAL_SELF = 'rc_self';

    /**
     * @throws Exception
     * @noinspection PhpMissingReturnTypeInspection
     */
    public static function checkJumpTo(int|string $id, DataContainer $dc)
    {
        if ($id == $dc->id) {
            throw new Exception($GLOBALS['TL_LANG']['ERR']['circularReference']);
        }

        return $id;
    }

}