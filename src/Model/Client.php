<?php
namespace Kr\OAuthClientBundle\Model;

class Client implements ClientInterface
{
    /** @var string */
    protected $clientId;

    /** @var string */
    protected $clientSecret;

    /** @var array */
    protected $allowedGrantTypes;

    /** @var string */
    protected $redirectUri;

    /** @var string */
    protected $resourceUrl;

    /** @var string */
    protected $tokenUrl;

    /** @var string */
    protected $authUrl;

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return array
     */
    public function getAllowedGrantTypes()
    {
        return $this->allowedGrantTypes;
    }

    /**
     * @inheritdoc
     */
    public function allowGrantType($grantType)
    {
        if(!in_array($grantType, $this->getAllowedGrantTypes())) {
            $this->allowedGrantTypes[] = $grantType;
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function disallowGrantType($grantType)
    {
        $this->allowedGrantTypes = array_diff($this->getAllowedGrantTypes(), [$grantType]);
    }

    /**
     * @param array $allowedGrantTypes
     */
    public function setAllowedGrantTypes($allowedGrantTypes)
    {
        $this->allowedGrantTypes = $allowedGrantTypes;
    }

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @param string $redirectUri
     */
    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }

    /**
     * @return string
     */
    public function getResourceUrl()
    {
        return $this->resourceUrl;
    }

    /**
     * @param string $resourceUrl
     */
    public function setResourceUrl($resourceUrl)
    {
        $this->resourceUrl = $resourceUrl;
    }

    /**
     * @return string
     */
    public function getTokenUrl()
    {
        return $this->tokenUrl;
    }

    /**
     * @param string $tokenUrl
     */
    public function setTokenUrl($tokenUrl)
    {
        $this->tokenUrl = $tokenUrl;
    }

    /**
     * @return string
     */
    public function getAuthUrl()
    {
        return $this->authUrl;
    }

    /**
     * @param string $authUrl
     */
    public function setAuthUrl($authUrl)
    {
        $this->authUrl = $authUrl;
    }


}