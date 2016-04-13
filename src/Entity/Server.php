<?php
namespace Kr\OAuthClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Kr\OAuthClient\Credentials\Server as BaseServer;

/**
 * @ORM\Entity(repositoryClass="Kr\OAuthClientBundle\Repository\ServerRepository")
 * @ORM\Table(name="oauthclient_server")
 */
class Server extends BaseServer
{
    public function __construct($authUrl, $tokenUrl, $resourceUrl, array $grantTypes)
    {
        $grantTypes = serialize($grantTypes);
        parent::__construct($authUrl, $tokenUrl, $resourceUrl, $grantTypes);
    }

    /**
     * @inheritdoc
     */
    public function supports($grantType)
    {
        $grantTypes = unserialize($this->grantTypes);
        return in_array($grantType, $grantTypes);
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $authUrl;

    /**
     * @ORM\Column(type="string")
     */
    protected $tokenUrl;

    /**
     * @ORM\Column(type="string")
     */
    protected $resourceUrl;

    /**
     * @ORM\Column(type="string")
     */
    protected $grantTypes;

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
     * Set authUrl
     *
     * @param string $authUrl
     *
     * @return Server
     */
    public function setAuthUrl($authUrl)
    {
        $this->authUrl = $authUrl;

        return $this;
    }

    /**
     * Set tokenUrl
     *
     * @param string $tokenUrl
     *
     * @return Server
     */
    public function setTokenUrl($tokenUrl)
    {
        $this->tokenUrl = $tokenUrl;

        return $this;
    }

    /**
     * Set resourceUrl
     *
     * @param string $resourceUrl
     *
     * @return Server
     */
    public function setResourceUrl($resourceUrl)
    {
        $this->resourceUrl = $resourceUrl;

        return $this;
    }

    /**
     * Set grantTypes
     *
     * @param string $grantTypes
     *
     * @return Server
     */
    public function setGrantTypes($grantTypes)
    {
        $this->grantTypes = $grantTypes;

        return $this;
    }

    /**
     * Get grantTypes
     *
     * @return string
     */
    public function getGrantTypes()
    {
        return $this->grantTypes;
    }
}
