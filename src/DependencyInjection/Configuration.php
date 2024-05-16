<?php

namespace NS\FileUploadBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $builder = new TreeBuilder('ns_file_upload');
        $root = $builder->getRootNode();
        $root->children()
                ->scalarNode('web_directory')->end()
                ->scalarNode('uploads_directory')->end()
            ->end();

        return $builder;
    }
}
