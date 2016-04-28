<?php
namespace Kr\OAuthClientBundle\Model;

interface ClientInterface
{
    /**
     * @return string
     */
    public function getClientId();

    /**
     * @param string $clientId
     */
    public function setClientId($clientId);

    /**
     * @return string
     */
    public function getClientSecret();

    /**
     * @param string $clientSecret
     */
    public function setClientSecret($clientSecret);

    /**
     * @return array
     */
    public function getAllowedGrantTypes();

    /**
     * @param array $allowedGrantTypes
     */
    public function setAllowedGrantTypes($allowedGrantTypes);

    /**
     * @return string
     */
    public function getRedirectUri();

    /**
     * @param string $redirectUri
     */
    public function setRedirectUri($redirectUri);

    /**
     * @return string
     */
    public function getResourceUrl();

    /**
     * @param string $resourceUrl
     */
    public function setResourceUrl($resourceUrl);

    /**
     * @return string
     */
    public function getTokenUrl();

    /**
     * @param string $tokenUrl
     */
    public function setTokenUrl($tokenUrl);

    /**
     * @return string
     */
    public function getAuthUrl();

    /**
     * @param string $authUrl
     */
    public function setAuthUrl($authUrl);


}