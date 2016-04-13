<?php
namespace Kr\OAuthClientBundle\Security;

use Doctrine\ORM\EntityManagerInterface;
use Kr\OAuthClient\Credentials\Client;
use Kr\OAuthClient\Credentials\CredentialsInterface;
use Kr\OAuthClient\Credentials\Provider\CredentialsProviderInterface;

class CredentialsProvider implements CredentialsProviderInterface
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
     * @return CredentialsInterface
     */
    public function getCredentials($type)
    {
        $repo = $this->em->getRepository($type);
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