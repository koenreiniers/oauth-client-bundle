<?php
namespace Kr\OAuthClientBundle\OAuth;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Kr\OAuthClientBundle\Entity\Client;
use Kr\OAuthClientBundle\OAuth\Authentication\AuthenticationManager;
use Psr\Http\Message\RequestInterface;

class OAuth
{
    /** @var ClientInterface  */
    protected $httpClient;

    /** @var AuthenticationManager */
    protected $authenticationManager;

    /** @var Client */
    protected $client;

    public function __construct(ClientInterface $httpClient, AuthenticationManager $authenticationManager, Client $client)
    {
        $this->httpClient   = $httpClient;
        $this->authenticationManager = $authenticationManager;
        $this->client = $client;
    }

    public function send(RequestInterface $request)
    {
        $request = $this->authenticationManager->authenticate($request, $this->client);

        $uri = (string)$request->getUri();
        if(strpos($uri, $this->client->getResourceUrl()) !== 0) {
            $uri = new Uri($this->client->getResourceUrl() . $uri);
        }
        $request = $request->withUri($uri);

        return $this->httpClient->send($request);
    }

    public function request($method, $uri = null, array $options = [])
    {
        $headers = isset($options['headers']) ? $options['headers'] : [];
        $body = isset($options['body']) ? $options['body'] : null;
        $protocolVersion = isset($options['protocol_version']) ? $options['protocol_version'] : "1.1";

        $request = new Request($method, $uri, $headers, $body, $protocolVersion);
        return $this->send($request);
    }
}