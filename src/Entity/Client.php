<?php
namespace Kr\OAuthClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kr\OAuthClientBundle\Model\Client as BaseClient;

/**
 * @ORM\Entity(repositoryClass="Kr\OAuthClientBundle\Repository\ClientRepository")
 * @ORM\Table(name="kr_oauthclient_client")
 */
class Client extends BaseClient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $alias;

    /**
     * @ORM\Column(type="string")
     */
    protected $clientId;

    /**
     * @ORM\Column(type="string")
     */
    protected $clientSecret;

    /**
     * @ORM\Column(type="array")
     */
    protected $allowedGrantTypes;

    /**
     * @ORM\Column(type="string")
     */
    protected $redirectUri;

    /**
     * @ORM\Column(type="string")
     */
    protected $resourceUrl;

    /**
     * @ORM\Column(type="string")
     */
    protected $tokenUrl;

    /**
     * @ORM\Column(type="string")
     */
    protected $authUrl;

    /**
     * @ORM\OneToMany(targetEntity="AccessToken", mappedBy="client")
     */
    protected $accessTokens;

    /**
     * @ORM\OneToMany(targetEntity="RefreshToken", mappedBy="client")
     */
    protected $refreshTokens;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Client
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->accessTokens = new \Doctrine\Common\Collections\ArrayCollection();
        $this->refreshTokens = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add accessToken
     *
     * @param \Kr\OAuthClientBundle\Entity\AccessToken $accessToken
     *
     * @return Client
     */
    public function addAccessToken(\Kr\OAuthClientBundle\Entity\AccessToken $accessToken)
    {
        $this->accessTokens[] = $accessToken;

        return $this;
    }

    /**
     * Remove accessToken
     *
     * @param \Kr\OAuthClientBundle\Entity\AccessToken $accessToken
     */
    public function removeAccessToken(\Kr\OAuthClientBundle\Entity\AccessToken $accessToken)
    {
        $this->accessTokens->removeElement($accessToken);
    }

    /**
     * Get accessTokens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccessTokens()
    {
        return $this->accessTokens;
    }

    /**
     * Add refreshToken
     *
     * @param \Kr\OAuthClientBundle\Entity\RefreshToken $refreshToken
     *
     * @return Client
     */
    public function addRefreshToken(\Kr\OAuthClientBundle\Entity\RefreshToken $refreshToken)
    {
        $this->refreshTokens[] = $refreshToken;

        return $this;
    }

    /**
     * Remove refreshToken
     *
     * @param \Kr\OAuthClientBundle\Entity\RefreshToken $refreshToken
     */
    public function removeRefreshToken(\Kr\OAuthClientBundle\Entity\RefreshToken $refreshToken)
    {
        $this->refreshTokens->removeElement($refreshToken);
    }

    /**
     * Get refreshTokens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefreshTokens()
    {
        return $this->refreshTokens;
    }
}
