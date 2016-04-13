<?php
namespace Kr\OAuthClientBundle\Security;

use Doctrine\ORM\EntityManagerInterface;
use Kr\OAuthClient\Token\Storage\TokenStorageInterface;
use Kr\OAuthClient\Token\TokenInterface;
use Kr\OAuthClient\Token\State as OriginalState;
use Kr\OAuthClient\Token\BearerToken as OriginalBearerToken;
use Kr\OAuthClient\Token\RefreshToken as OriginalRefreshToken;
use Kr\OAuthClient\Token\AuthorizationCode as OriginalAuthorizationCode;
use Kr\OAuthClientBundle\Entity\AuthorizationCode;
use Kr\OAuthClientBundle\Entity\BearerToken;
use Kr\OAuthClientBundle\Entity\RefreshToken;
use Kr\OAuthClientBundle\Entity\State;

class TokenStorage implements TokenStorageInterface
{
    /** @var EntityManagerInterface  */
    protected $em;

    /**
     * TokenStorage constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Stores the token in the token storage
     *
     * @param TokenInterface $token
     */
    public function setToken(TokenInterface $token)
    {
        // TODO: Remove temp fix
        if($token instanceof OriginalState) {
            $token = new State($token->getToken(), $token->getExpiresAt());
        } else if($token instanceof OriginalBearerToken) {
            $token = new BearerToken($token->getToken(), $token->getExpiresAt());
        } else if($token instanceof OriginalRefreshToken) {
            $token = new RefreshToken($token->getToken(), $token->getExpiresAt());
        } else if($token instanceof OriginalAuthorizationCode) {
            $token = new AuthorizationCode($token->getToken(), $token->getExpiresAt());
        }
        $this->em->persist($token);
        $this->em->flush();
    }

    /**
     * Returns token of specified type, null when it does not exist
     *
     * @param string $type
     *
     * @return TokenInterface|null
     */
    public function getToken($type)
    {
        return $this->em->getRepository($type)->findOneBy([], ["id" => "DESC"]);
    }

    /**
     * Returns the current access token, null when it does not exist
     *
     * @return TokenInterface
     */
    public function getAccessToken()
    {
        return $this->getToken("access_token");
    }

    /**
     * Stores the access token
     *
     * @param TokenInterface $token
     */
    public function setAccessToken(TokenInterface $token)
    {
        $this->setToken($token);
    }

    /**
     * Unsets the token of specified type
     *
     * @param string $type
     */
    public function unsetToken($type)
    {
        $token = $this->getToken($type);
        $this->em->remove($token);
        $this->em->flush();
    }
}