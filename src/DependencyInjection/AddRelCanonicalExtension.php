<?php

declare(strict_types=1);

namespace Codesache\AddRelCanonicalBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Exception;

class AddRelCanonicalExtension extends Extension
{
    /**
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../config')
        );
        $loader->load('services.yaml');

        if (in_array('ContaoGlossaryBundle', array_keys($container->getParameter('kernel.bundles')), true)) {

            // Add the
            //
            //     # unset the original service definition
            //     Oveleon\ContaoGlossaryBundle\Controller\FrontendModule\GlossaryReaderController: ~
            //
            //     # replace the old definition with the new one
            //     # (the old definition is lost -- which does not matter in our use case)
            //     Oveleon\ContaoGlossaryBundle\Controller\FrontendModule\GlossaryReaderController:
            //       class: Codesache\AddRelCanonicalBundle\Controller\FrontendModule\GlossaryReaderController
            //
            // part of services.yaml here:
            $loader->load('glossaryreader.services.yaml');

        }
    }

}