<?php

namespace NS\FileUploadBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $builder = $this->getBuilder();
        $root = $builder->getRootNode();
        $root->children()
                ->scalarNode('web_directory')->end()
                ->scalarNode('uploads_directory')->end()
            ->end();

        return $builder;
    }

    private function getBuilder(): TreeBuilder
    {
        // Instantiating a new TreeBuilder without a constructor arg is deprecated in SF4 and removed in SF5
        if (method_exists(TreeBuilder::class, '__construct')) {
            return new TreeBuilder('ns_file_upload');
        }

        // Included for backward-compatibility with SF3
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('ns_file_upload');
        return $treeBuilder;
    }
}
