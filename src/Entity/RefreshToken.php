<?php
namespace Kr\OAuthClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kr\OAuthClient\Token\RefreshToken as BaseToken;

/**
 * @ORM\Entity(repositoryClass="Kr\OAuthClientBundle\Repository\RefreshTokenRepository")
 * @ORM\Table(name="oauthclient_refresh_token")
 */
class RefreshToken extends BaseToken
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $expiresAt;

    /**
     * @ORM\Column(type="text")
     */
    protected $token;

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
     * Set expiresAt
     *
     * @param \DateTime $expiresAt
     *
     * @return RefreshToken
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return RefreshToken
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}
