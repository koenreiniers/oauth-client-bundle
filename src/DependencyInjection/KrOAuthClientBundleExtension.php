<?php
namespace Kr\OAuthClientBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class KrOAuthClientBundleExtension extends Extension
{
    public function getAlias()
    {
        return "kr_oauth_client";
    }

    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load("services.yml");
        $loader->load("managers.yml");
        $loader->load("repositories.yml");
        $loader->load("security.yml");
        $loader->load("grants.yml");
    }
}
