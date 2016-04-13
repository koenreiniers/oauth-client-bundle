<?php
namespace Kr\OAuthClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Kr\OAuthClient\Credentials\Client as BaseClient;

/**
 * @ORM\Entity(repositoryClass="Kr\OAuthClientBundle\Repository\ClientRepository")
 * @ORM\Table(name="oauthclient_client")
 */
class Client extends BaseClient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $clientId;

    /**
     * @ORM\Column(type="string")
     */
    protected $clientSecret;

    /**
     * @ORM\Column(type="string")
     */
    protected $redirectUri;

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
     * Set clientId
     *
     * @param string $clientId
     *
     * @return Client
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Set clientSecret
     *
     * @param string $clientSecret
     *
     * @return Client
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * Set redirectUri
     *
     * @param string $redirectUri
     *
     * @return Client
     */
    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;

        return $this;
    }
}
