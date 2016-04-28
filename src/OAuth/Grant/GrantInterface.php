<?php
namespace Kr\OAuthClientBundle\OAuth\Grant;

use Kr\OAuthClientBundle\Entity\Client;
use Kr\OAuthClientBundle\Entity\RefreshToken;
use Psr\Http\Message\ResponseInterface;

interface GrantInterface
{
    /**
     * Tries to grant client a new access token
     *
     * @param Client $client
     *
     * @return ResponseInterface
     */
    public function request(Client $client);

    /**
     * Returns whether or not the grant supports the client
     *
     * @param Client $client
     *
     * @return bool
     */
    public function supports(Client $client);
}