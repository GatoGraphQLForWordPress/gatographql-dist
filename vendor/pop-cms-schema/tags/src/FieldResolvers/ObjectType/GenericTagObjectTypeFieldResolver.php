<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\FieldResolvers\ObjectType;

use PoPCMSSchema\Tags\FieldResolvers\ObjectType\AbstractTagObjectTypeFieldResolver;
use PoPCMSSchema\Tags\TypeAPIs\QueryableTagTypeAPIInterface;
use PoPCMSSchema\Tags\TypeAPIs\TagTypeAPIInterface;
use PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\ObjectType\TagObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
class GenericTagObjectTypeFieldResolver extends AbstractTagObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Tags\TypeAPIs\QueryableTagTypeAPIInterface|null
     */
    private $queryableTagTypeAPI;
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver|null
     */
    private $genericTagObjectTypeResolver;
    public final function setQueryableTagTypeAPI(QueryableTagTypeAPIInterface $queryableTagTypeAPI) : void
    {
        $this->queryableTagTypeAPI = $queryableTagTypeAPI;
    }
    protected final function getQueryableTagTypeAPI() : QueryableTagTypeAPIInterface
    {
        if ($this->queryableTagTypeAPI === null) {
            /** @var QueryableTagTypeAPIInterface */
            $queryableTagTypeAPI = $this->instanceManager->getInstance(QueryableTagTypeAPIInterface::class);
            $this->queryableTagTypeAPI = $queryableTagTypeAPI;
        }
        return $this->queryableTagTypeAPI;
    }
    public final function setGenericTagObjectTypeResolver(GenericTagObjectTypeResolver $genericTagObjectTypeResolver) : void
    {
        $this->genericTagObjectTypeResolver = $genericTagObjectTypeResolver;
    }
    protected final function getGenericTagObjectTypeResolver() : GenericTagObjectTypeResolver
    {
        if ($this->genericTagObjectTypeResolver === null) {
            /** @var GenericTagObjectTypeResolver */
            $genericTagObjectTypeResolver = $this->instanceManager->getInstance(GenericTagObjectTypeResolver::class);
            $this->genericTagObjectTypeResolver = $genericTagObjectTypeResolver;
        }
        return $this->genericTagObjectTypeResolver;
    }
    public function getTagTypeAPI() : TagTypeAPIInterface
    {
        return $this->getQueryableTagTypeAPI();
    }
    public function getTagTypeResolver() : TagObjectTypeResolverInterface
    {
        return $this->getGenericTagObjectTypeResolver();
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericTagObjectTypeResolver::class];
    }
}
