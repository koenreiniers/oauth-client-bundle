<?php
namespace Kr\OAuthClientBundle\Manager;

use Doctrine\ORM\Decorator\EntityManagerDecorator;
use Doctrine\ORM\EntityManagerInterface;
use Kr\OAuthClientBundle\Exception\InvalidEntityAliasException;
use Kr\OAuthClientBundle\Manager\AliasResolverInterface;

class AliasedEntityManager extends EntityManagerDecorator
{
    /** @var AliasResolverInterface */
    protected $aliasResolver;

    /**
     * AliasedEntityManager constructor.
     *
     * @param EntityManagerInterface $wrapped
     * @param AliasResolverInterface $aliasResolver
     */
    public function __construct(EntityManagerInterface $wrapped, AliasResolverInterface $aliasResolver)
    {
        $this->aliasResolver = $aliasResolver;
        parent::__construct($wrapped);
    }

    /**
     * Converts alias to actual entity name
     *
     * @param string $alias
     *
     * @return string
     *
     * @throws InvalidEntityAliasException     When the type does not exist
     */
    protected function resolveEntityName($alias)
    {
        $entityName = $this->aliasResolver->resolve($alias);
        if($entityName === null) {
            throw new InvalidEntityAliasException($alias);
        }
        return $entityName;
    }

    /**
     * @inheritdoc
     */
    public function getRepository($alias)
    {
        $entityName = $this->resolveEntityName($alias);
        return $this->wrapped->getRepository($entityName);
    }

    /**
     * @inheritdoc
     */
    public function find($alias, $id)
    {
        $entityName = $this->resolveEntityName($alias);
        return $this->wrapped->find($entityName, $id);
    }

    /**
     * @inheritdoc
     */
    public function getReference($alias, $id)
    {
        $entityName = $this->resolveEntityName($alias);
        return $this->wrapped->getReference($entityName, $id);
    }

    /**
     * @inheritdoc
     */
    public function getPartialReference($alias, $identifier)
    {
        $entityName = $this->resolveEntityName($alias);
        return $this->wrapped->getPartialReference($entityName, $identifier);
    }
}