<?php
namespace Kr\OAuthClientBundle\Manager;

interface AliasResolverInterface
{
    /**
     * Returns actual entity name, null when the alias is invalid
     *
     * @param string $alias
     *
     * @return string|null
     */
    public function resolve($alias);
}