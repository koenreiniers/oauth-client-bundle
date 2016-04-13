<?php
namespace Kr\OAuthClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Kr\OAuthClient\Token\AuthorizationCode as BaseToken;

/**
 * @ORM\Entity(repositoryClass="Kr\OAuthClientBundle\Repository\AuthorizationCodeRepository")
 * @ORM\Table(name="oauthclient_authorization_code")
 */
class AuthorizationCode extends BaseToken
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
     * @return AuthorizationCode
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
     * @return AuthorizationCode
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}
