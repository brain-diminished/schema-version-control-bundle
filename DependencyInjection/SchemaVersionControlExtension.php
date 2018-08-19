<?php
namespace BrainDiminished\SchemaVersionControl\Bundle\DependencyInjection;

use BrainDiminished\SchemaVersionControl\SchemaVersionControlService;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class SchemaVersionControlExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        //$config = $this->processConfiguration($this->getConfiguration($config, $container), $config);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/container'));
        $loader->load('schema-version-control.xml');

        $definition = $container->getDefinition(SchemaVersionControlService::class);
        $definition->replaceArgument(0, $config['connection']);

        $schemaFileLocator = new FileLocator(__DIR__.'/../../..');
        $definition->replaceArgument(1, $schemaFileLocator->locate($config['schema_file']));

    }
}
