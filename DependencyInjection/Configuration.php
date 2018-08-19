<?php
namespace BrainDiminished\SchemaVersionControl\Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('schema_version_control');

        $rootNode
            ->children()
            ->variableNode('connection')->end()
            ->scalarNode('schema_file')->defaultValue('etc/database/schema.yaml')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
