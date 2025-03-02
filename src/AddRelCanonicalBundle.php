<?php

declare(strict_types=1);

namespace Codesache\AddRelCanonicalBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use function dirname;

class AddRelCanonicalBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}