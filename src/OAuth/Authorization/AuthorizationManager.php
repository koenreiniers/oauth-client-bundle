<?php
namespace Kr\OAuthClientBundle\OAuth\Authorization;

use Kr\OAuthClientBundle\Entity\Client;

class AuthorizationManager
{
    public function authorize(Client $client)
    {
        $authUrl = $client->getAuthUrl();
        header("Location: $authUrl");
        exit;
    }
}