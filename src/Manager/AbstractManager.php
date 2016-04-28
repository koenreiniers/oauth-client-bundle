<?php
namespace Kr\OAuthClientBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class AbstractManager
{
    /** @var EntityManager  */
    protected $em;

    /** @var string */
    protected $className;

    /** @var EntityRepository */
    protected $repository;

    public function __construct(EntityManager $em, $className)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($className);
        $this->className = $className;
    }

    public function create()
    {
        $class = $this->getClassName();
        return new $class();
    }

    public function save($token)
    {
        $this->em->persist($token);
        $this->em->flush();
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }
}