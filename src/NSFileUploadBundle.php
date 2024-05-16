<?php

namespace NS\FileUploadBundle;

use NS\FileUploadBundle\DependencyInjection\CompilerPass\ConfigCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class NSFileUploadBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new ConfigCompilerPass());
    }

}
