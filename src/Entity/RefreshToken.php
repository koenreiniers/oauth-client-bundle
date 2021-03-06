<?php
namespace Kr\OAuthClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kr\OAuthClientBundle\Model\RefreshToken as BaseRefreshToken;

/**
 * @ORM\Entity(repositoryClass="Kr\OAuthClientBundle\Repository\RefreshTokenRepository")
 * @ORM\Table(name="kr_oauthclient_refresh_token")
 */
class RefreshToken extends BaseRefreshToken
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $token;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $expiresAt;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="refreshTokens")
     */
    protected $client;

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
     * Set client
     *
     * @param \Kr\OAuthClientBundle\Entity\Client $client
     *
     * @return RefreshToken
     */
    public function setClient(\Kr\OAuthClientBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Kr\OAuthClientBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
