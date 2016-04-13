<?php
namespace Kr\OAuthClientBundle\Security;

use Doctrine\ORM\EntityManagerInterface;
use Kr\OAuthClient\Credentials\Client;
use Kr\OAuthClient\Credentials\CredentialsInterface;
use Kr\OAuthClient\Credentials\Provider\CredentialsProviderInterface;
use Kr\OAuthClient\Factory\ClassMap\ClassMapInterface;

class CredentialsProvider implements CredentialsProviderInterface
{
    /** @var EntityManagerInterface  */
    protected $em;

    /** @var ClassMapInterface */
    protected $classMap;

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
     * @return CredentialsInterface
     */
    public function getCredentials($type)
    {
        $className = $this->classMap->getClass($type);
        $repo = $this->em->getRepository($className);
        return $repo->findOneBy([]);
    }

    /**
     * @return CredentialsInterface
     */
    public function getServerCredentials()
    {
        return $this->getCredentials("server");
    }

    /**
     * @return Client
     */
    public function getClientCredentials()
    {
        return $this->getCredentials("client_credentials");
    }
}