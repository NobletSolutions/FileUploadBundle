<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 5:13 PM
 */

namespace NS\FileUploadBundle\DependencyInjection\CompilerPass;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ConfigCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        // always first check if the primary service is defined
        if (!$container->has('ns_file.upload_handler') || !$container->has('ns_file.url_generator.default')) {
            return;
        }


        // find all service IDs with the app.mail_transport tag
        $taggedServices = $container->findTaggedServiceIds('ns_file.config');

        if(!empty($taggedServices)) {
            $uploadDefinition = $container->findDefinition('ns_file.upload_handler');
            $urlGeneratorDefinition = $container->findDefinition('ns_file.url_generator.default');

            foreach ($taggedServices as $id => $tags) {
                $uploadDefinition->addMethodCall('addConfig', [new Reference($id)]);
                $urlGeneratorDefinition->addMethodCall('addConfig', [new Reference($id)]);
            }
        }
    }
}
