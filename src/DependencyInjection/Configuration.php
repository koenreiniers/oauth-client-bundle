<?php
namespace Kr\OAuthClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kr_oauth_client');

        $rootNode->children()
            ->arrayNode("clients")
                ->useAttributeAsKey("alias")
                ->prototype("array")
                    ->children()
                        ->scalarNode("client_id")->isRequired()->end()
                        ->scalarNode("client_secret")->isRequired()->end()
                        ->scalarNode("redirect_uri")->isRequired()->end()
                        ->scalarNode("resource_url")->isRequired()->end()
                        ->scalarNode("token_url")->isRequired()->end()
                        ->scalarNode("auth_url")->isRequired()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
