<?php
namespace Kr\OAuthClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kr\OAuthClientBundle\Model\AccessToken as BaseAccessToken;

/**
 * @ORM\Entity(repositoryClass="Kr\OAuthClientBundle\Repository\AccessTokenRepository")
 * @ORM\Table(name="kr_oauthclient_access_token")
 */
class AccessToken extends BaseAccessToken
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $token;

    /**
     * @ORM\Column(type="string")
     */
    protected $type;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $expiresAt;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="accessTokens")
     */
    protected $client;

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
     * Set client
     *
     * @param \Kr\OAuthClientBundle\Entity\Client $client
     *
     * @return AccessToken
     */
    public function setClient(\Kr\OAuthClientBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Kr\OAuthClientBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return AccessToken
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
