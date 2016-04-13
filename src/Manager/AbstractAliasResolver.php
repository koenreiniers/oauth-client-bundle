<?php
namespace Kr\OAuthClientBundle\Manager;

abstract class AbstractAliasResolver implements AliasResolverInterface
{

    /**
     * Returns the alias map with key=alias and value=entityName
     *
     * @return array
     */
    abstract protected function registerAliasMap();

    /**
     * @inheritdoc
     */
    public function resolve($alias)
    {
        $aliasMap = $this->registerAliasMap();
        if(!isset($aliasMap[$alias])) {
            return null;
        }

        return $aliasMap[$alias];
    }
}