<?php
namespace Kr\OAuthClientBundle\DependencyInjection\Factory;

use Doctrine\ORM\EntityRepository;
use GuzzleHttp\ClientInterface;
use Kr\OAuthClientBundle\OAuth\Authentication\AuthenticationManager;
use Kr\OAuthClientBundle\OAuth\OAuth;

class OAuthFactory
{
    protected $httpClient;
    protected $authenticationManager;
    protected $clientRepository;

    public function __construct(ClientInterface $httpClient, AuthenticationManager $authenticationManager, EntityRepository $clientRepository)
    {
        $this->httpClient = $httpClient;
        $this->authenticationManager = $authenticationManager;
        $this->clientRepository = $clientRepository;
    }

    public function getClient($clientAlias)
    {
        $client = $this->clientRepository->findOneBy(["alias" => $clientAlias]);

        $oauth = new OAuth($this->httpClient, $this->authenticationManager, $client);

        return $oauth;
    }
}