<?php
namespace Kr\OAuthClientBundle\Security;

use Kr\OAuthClientBundle\Manager\AbstractAliasResolver;

class TokenAliasResolver extends AbstractAliasResolver
{
    /**
     * @inheritdoc
     */
    protected function registerAliasMap()
    {
        return [
            "access_token" => "KrOAuthClientBundle:BearerToken",
            "Bearer" => "KrOAuthClientBundle:BearerToken",
            "refresh_token" => "KrOAuthClientBundle:RefreshToken",
            "authorization_code" => "KrOAuthClientBundle:AuthorizationCode",
            "state" => "KrOAuthClientBundle:State",
        ];
    }
}