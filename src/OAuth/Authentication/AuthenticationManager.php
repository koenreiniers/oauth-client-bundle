<?php
namespace Kr\OAuthClientBundle\OAuth\Authentication;

use Doctrine\ORM\EntityRepository;
use Kr\OAuthClientBundle\Entity\AccessToken;
use Kr\OAuthClientBundle\Entity\Client;
use Kr\OAuthClientBundle\Entity\RefreshToken;
use Kr\OAuthClientBundle\Manager\AccessTokenManager;
use Kr\OAuthClientBundle\Manager\RefreshTokenManager;
use Kr\OAuthClientBundle\OAuth\Grant\GrantInterface;
use Psr\Http\Message\RequestInterface;

class AuthenticationManager
{
    /** @var EntityRepository */
    protected $accessTokenRepository;

    /** @var GrantInterface[] */
    protected $grants;

    /** @var AccessTokenManager */
    protected $accessTokenManager;

    /** @var RefreshTokenManager */
    protected $refreshTokenManager;

    public function __construct(EntityRepository $accessTokenRepository, AccessTokenManager $accessTokenManager, RefreshTokenManager $refreshTokenManager)
    {
        $this->accessTokenRepository = $accessTokenRepository;
        $this->grants = [];
        $this->accessTokenManager = $accessTokenManager;
        $this->refreshTokenManager = $refreshTokenManager;
    }

    public function addGrant(GrantInterface $grant)
    {
        $this->grants[] = $grant;
    }

    /**
     * @param Client $client
     *
     * @return GrantInterface|null
     */
    protected function getAvailableGrant(Client $client)
    {
        foreach($this->grants as $grant)
        {
            if($grant->supports($client)) {
                return $grant;
            }
        }
        return null;
    }

    protected function requestAccessToken(Client $client)
    {
        $grant = $this->getAvailableGrant($client);
        if($grant === null) {
            throw new \Exception("No grant available. Client possibly needs to be authorized.");
        }
        $response = $grant->request($client);

        $body = (string)$response->getBody();

        $body = json_decode($body, true);

        if(!isset($body['access_token'])) {
            throw new \Exception("Access token missing from response body");
        }

        /** @var AccessToken $accessToken */
        $expiresIn = $body['expires_in'];
        $expiresAt = (new \DateTime())->modify("+$expiresIn seconds");
        $accessToken = $this->accessTokenManager->create();
        $accessToken->setToken($body['access_token']);
        $accessToken->setType($body['token_type']);
        $accessToken->setExpiresAt($expiresAt);
        $accessToken->setClient($client);
        $this->accessTokenManager->save($accessToken);

        if(isset($body['refresh_token'])) {
            /** @var RefreshToken $refreshToken */
            $refreshToken = $this->refreshTokenManager->create();
            $refreshToken->setToken($body['refresh_token']);
            $refreshToken->setClient($client);
            $this->refreshTokenManager->save($refreshToken);
        }

        return $accessToken;
    }

    public function authenticate(RequestInterface $request, Client $client)
    {
        $accessToken = $this->accessTokenRepository->findOneBy(["client" => $client], ["expiresAt" => "DESC"]);
        if($accessToken === null || $accessToken->isExpired()) {
            $accessToken = $this->requestAccessToken($client);
        }
        if($accessToken->getType() === "bearer") {
            $token = $accessToken->getToken();
            $request = $request->withAddedHeader("Authorization", "Bearer $token");
        }
        return $request;
    }
}