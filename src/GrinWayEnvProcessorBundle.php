<?php

namespace GrinWay\EnvProcessor;

use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * @final
 *
 * @author Grigory Koblitskiy <grin180898@outlook.com>
 */
class GrinWayEnvProcessorBundle extends AbstractBundle
{
    public const EXTENSION_ALIAS = 'grinway_env';
    public const ENV_PROCESSOR_PREFIX = self::EXTENSION_ALIAS . '_';
    public const BUNDLE_PREFIX = self::EXTENSION_ALIAS . '.';
    public const COMMAND_PREFIX = self::EXTENSION_ALIAS . ':';

    public const EXTENSION_ALIAS_KEBAB = 'grinway-env-processor';
    public const TWIG_PREFIX_KEBAB = self::EXTENSION_ALIAS_KEBAB . ':';

    public const GENERIC_CACHE_TAG = self::EXTENSION_ALIAS;

    protected string $extensionAlias = self::EXTENSION_ALIAS;

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()//

            //...

            ->end()//
        ;
    }

    /**
     * Helper
     */
    private function setServiceContainerParameters(array $config, ContainerConfigurator $container): void
    {
        $env = $container->env();
        $parameters = $container->parameters();

        $parameters//            ->set(self::bundlePrefixed(''), $config[''])//
        ;
    }

    /**
     * use loadExtension method instead
     */
//    public function getContainerExtension(): ?ExtensionInterface
//    {
//        return new GrinWayTelegramExtension();
//    }

    /**
     * Before service container compiled
     */
    public function build(ContainerBuilder $builder): void
    {
        parent::build($builder);
        $this->registerCompilerPasses($builder);
    }

    /**
     * Before service container compiled (late for registering compiler pass here)
     */
    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $this->importOtherBundleConfigurations($container, $builder);
        $this->registerForAutoconfiguration($container, $builder);
    }

    /**
     * After service container compiled
     *
     * Too late for registering compiler pass here
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $this->setServiceContainerParameters($config, $container);
        $this->setServiceContainerServices($config, $container);
    }

    /**
     * Root directory of this bundle
     */
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    /**
     * Helper
     */
    public static function bundlePrefixed(string $name): string
    {
        return \sprintf(
            '%s%s',
            self::BUNDLE_PREFIX,
            \ltrim($name, '._:'),
        );
    }

    /**
     * Helper
     */
    public function absPath(string $path): string
    {
        return \sprintf(
            '%s/%s',
            \rtrim($this->getPath(), '/\\'),
            \ltrim($path, '/\\'),
        );
    }

    /**
     * Helper
     */
    private function telegramUpdateHandlerPass(ContainerBuilder $builder): void
    {
    }

    /**
     * Helper
     */
    private function registerCompilerPasses(ContainerBuilder $builder): void
    {
        $this->telegramUpdateHandlerPass($builder);
        $this->hideServices($builder);
    }

    /**
     * Helper
     */
    private function setServiceContainerServices(array $config, ContainerConfigurator $container): void
    {
        $container->import($this->absPath('config/services.yaml'));
    }

    /**
     * Helper
     */
    private function isAssetMapperAvailable(ContainerBuilder $builder): bool
    {
        if (!\interface_exists(AssetMapperInterface::class)) {
            return false;
        }

        // check that FrameworkBundle 6.3 or higher is installed
        $bundlesMetadata = $builder->getParameter('kernel.bundles_metadata');
        if (!isset($bundlesMetadata['FrameworkBundle'])) {
            return false;
        }

        return \is_file($bundlesMetadata['FrameworkBundle']['path'] . '/Resources/config/asset_mapper.php');
    }

    /**
     * Helper
     */
    private function assetMapperEnable(ContainerBuilder $builder): void
    {
        if (!$this->isAssetMapperAvailable($builder)) {
            return;
        }

        $builder->prependExtensionConfig('framework', [
            'asset_mapper' => [
                'paths' => [
                    __DIR__ . '/../assets/dist' => '@grinway/env-processor-bundle',
                ],
            ],
        ]);
    }

    /**
     * Helper
     *
     *  Use %env(default:<parameter_name>:)%
     *  to access bundle parameters, that haven't been set yet
     */
    private function importOtherBundleConfigurations(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
//        $this->assetMapperEnable($builder);
        $container->import($this->absPath('config/packages/framework_translator.yaml'));
        $container->import($this->absPath('config/packages/framework_validation.yaml'));
        $container->import($this->absPath('config/packages/framework_test.yaml'));
    }

    /**
     * Helper
     */
    private function hideServices(ContainerBuilder $builder): void
    {
    }

    /**
     * Helper
     */
    private function registerForAutoconfiguration(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
    }
}
