<?php declare(strict_types=1);

namespace NS\FileUploadBundle\DependencyInjection\CompilerPass;


use NS\FileUploadBundle\Exceptions\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ConfigCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        // always first check if the primary service is defined
        if (!$container->has('ns_file.upload_handler') || !$container->has('ns_file.url_generator.default')) {
            return;
        }

        // find all service IDs with the app.mail_transport tag
        $taggedServices = $container->findTaggedServiceIds('ns_file.config');

        if (!empty($taggedServices)) {
            $uploadDefinition = $container->findDefinition('ns_file.upload_handler');
            $urlGeneratorDefinition = $container->findDefinition('ns_file.url_generator.default');

            foreach ($taggedServices as $id => $tags) {
                if (!isset($tags[0]['config_name'])) {
                    throw new InvalidConfigurationException("Missing config_name");
                }

                $uploadDefinition->addMethodCall('addConfig', [$tags[0]['config_name'], new Reference($id)]);
                $urlGeneratorDefinition->addMethodCall('addConfig', [$tags[0]['config_name'], new Reference($id)]);
            }
        }
    }
}
