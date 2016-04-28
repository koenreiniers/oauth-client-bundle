<?php
namespace Kr\OAuthClientBundle\OAuth\Grant;

use Doctrine\ORM\EntityRepository;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use Kr\OAuthClientBundle\Entity\Client;
use Kr\OAuthClientBundle\Entity\RefreshToken;
use Psr\Http\Message\ResponseInterface;

class RefreshTokenGrant implements GrantInterface
{
    /** @var ClientInterface */
    protected $httpClient;

    /** @var EntityRepository */
    protected $refreshTokenRepository;

    public function __construct(ClientInterface $httpClient, EntityRepository $refreshTokenRepository)
    {
        $this->httpClient = $httpClient;
        $this->refreshTokenRepository = $refreshTokenRepository;
    }

    /**
     * Tries to grant client a new access token through the refresh_token grant type
     *
     * @param Client $client
     *
     * @return ResponseInterface
     */
    public function request(Client $client)
    {
        $tokenUrl = $client->getTokenUrl();

        $refreshToken = $this->getLatestRefreshToken($client);

        $queryData = [
            "client_id"     => $client->getClientId(),
            "client_secret" => $client->getClientSecret(),
            "refresh_token" => $refreshToken->getToken(),
            "grant_type"    => "refresh_token",
        ];

        $url = $tokenUrl . "?" . http_build_query($queryData);

        $request = new Request("GET", $url);

        $response = $this->httpClient->send($request);

        return $response;
    }

    /**
     * @param Client $client
     *
     * @return RefreshToken|null
     */
    protected function getLatestRefreshToken(Client $client)
    {
        $refreshToken = $this->refreshTokenRepository->findOneBy(["client" => $client], ["expiresAt" => "DESC"]);
        return $refreshToken;
    }

    /**
     * Returns whether or not the grant supports the client
     *
     * @param Client $client
     *
     * @return bool
     */
    public function supports(Client $client)
    {
        $isAllowed = in_array("refresh_token", $client->getAllowedGrantTypes());
        if(!$isAllowed) {
            return false;
        }
        $refreshToken = $this->getLatestRefreshToken($client);
        return $refreshToken !== null && !$refreshToken->isExpired();
    }
}