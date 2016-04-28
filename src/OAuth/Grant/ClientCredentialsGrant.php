<?php
namespace Kr\OAuthClientBundle\OAuth\Grant;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use Kr\OAuthClientBundle\Entity\Client;
use Kr\OAuthClientBundle\Entity\RefreshToken;

class ClientCredentialsGrant implements GrantInterface
{
    /** @var ClientInterface */
    protected $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @inheritdoc
     */
    public function request(Client $client)
    {
        $tokenUrl = $client->getTokenUrl();

        $queryData = [
            "client_id"     => $client->getClientId(),
            "client_secret" => $client->getClientSecret(),
            "grant_type"    => "client_credentials",
        ];

        $url = $tokenUrl . "?" . http_build_query($queryData);

        $request = new Request("GET", $url);

        $response = $this->httpClient->send($request);

        return $response;
    }

    /**
     * @inheritdoc
     */
    public function supports(Client $client)
    {
        return in_array("client_credentials", $client->getAllowedGrantTypes());
    }
}