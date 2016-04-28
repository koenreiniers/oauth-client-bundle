<?php
namespace Kr\OAuthClientBundle\Model;

abstract class AbstractToken implements TokenInterface
{
    /** @var string */
    protected $token;

    /** @var \DateTime */
    protected $expiresAt;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param \DateTime $expiresAt
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * Returns whether or not the token is expired
     *
     * @return bool
     */
    public function isExpired()
    {
        if($this->expiresAt === null) {
            return false;
        }
        return $this->expiresAt < new \DateTime();
    }
}