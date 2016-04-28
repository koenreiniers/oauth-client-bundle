<?php
namespace Kr\OAuthClientBundle\Model;

interface TokenInterface
{
    /**
     * @return string
     */
    public function getToken();

    /**
     * @param string $token
     */
    public function setToken($token);

    /**
     * @return \DateTime
     */
    public function getExpiresAt();

    /**
     * @param \DateTime $expiresAt
     */
    public function setExpiresAt($expiresAt);

    /**
     * Returns whether or not the token is expired
     *
     * @return bool
     */
    public function isExpired();
}