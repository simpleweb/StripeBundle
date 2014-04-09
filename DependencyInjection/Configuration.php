<?php

namespace Simpleweb\StripeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('simpleweb_stripe');

        $rootNode->children()
            ->scalarNode('secret_key')
                ->isRequired()
                ->cannotBeEmpty()
            ->end()
            ->scalarNode('publishable_key')
                ->isRequired()
                ->cannotBeEmpty()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
