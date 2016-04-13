<?php
namespace Kr\OAuthClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kr\OAuthClient\Token\State as BaseToken;

/**
 * @ORM\Entity(repositoryClass="Kr\OAuthClientBundle\Repository\StateRepository")
 * @ORM\Table(name="oauthclient_state")
 */
class State extends BaseToken
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
     * @return State
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
     * @return State
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}
