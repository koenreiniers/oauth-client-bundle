<?php
namespace Kr\OAuthClientBundle\Security;

use Doctrine\ORM\EntityManagerInterface;
use Kr\OAuthClient\Factory\ClassMap\ClassMapInterface;
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
    public function __construct(EntityManagerInterface $em, ClassMapInterface $classMap)
    {
        $this->em = $em;
        $this->classMap = $classMap;
    }

    /**
     * @inheritdoc
     */
    public function setToken(TokenInterface $token)
    {
        $this->em->persist($token);
        $this->em->flush();
    }

    /**
     * @inheritdoc
     */
    public function getToken($type)
    {
        $className = $this->classMap->getClass($type);
        return $this->em->getRepository($className)->findOneBy([], ["id" => "DESC"]);
    }

    /**
     * @inheritdoc
     */
    public function removeToken(TokenInterface $token)
    {
        $this->em->remove($token);
        $this->em->flush();
    }
}