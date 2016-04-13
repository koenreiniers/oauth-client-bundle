<?php
namespace Kr\OAuthClientBundle\Security;

use Kr\OAuthClientBundle\Manager\AbstractAliasResolver;

class CredentialsAliasResolver extends AbstractAliasResolver
{
    /**
     * @inheritdoc
     */
    protected function registerAliasMap()
    {
        return [
            "client_credentials"    => "KrOAuthClientBundle:Client",
            "server"                => "KrOAuthClientBundle:Server",
            "password"              => "KrOAuthClientBundle:Password"
        ];
    }
}