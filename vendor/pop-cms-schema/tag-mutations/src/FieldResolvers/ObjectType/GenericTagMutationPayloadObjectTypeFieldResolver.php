<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver;
use PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\GenericTagUpdateMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractObjectMutationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\RootCreateGenericTagTermMutationPayloadObjectTypeResolver;
use PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\RootUpdateGenericTagTermMutationPayloadObjectTypeResolver;
/** @internal */
class GenericTagMutationPayloadObjectTypeFieldResolver extends AbstractObjectMutationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver|null
     */
    private $genericTagObjectTypeResolver;
    public final function setPostObjectTypeResolver(GenericTagObjectTypeResolver $genericTagObjectTypeResolver) : void
    {
        $this->genericTagObjectTypeResolver = $genericTagObjectTypeResolver;
    }
    protected final function getPostObjectTypeResolver() : GenericTagObjectTypeResolver
    {
        if ($this->genericTagObjectTypeResolver === null) {
            /** @var GenericTagObjectTypeResolver */
            $genericTagObjectTypeResolver = $this->instanceManager->getInstance(GenericTagObjectTypeResolver::class);
            $this->genericTagObjectTypeResolver = $genericTagObjectTypeResolver;
        }
        return $this->genericTagObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericTagUpdateMutationPayloadObjectTypeResolver::class, RootCreateGenericTagTermMutationPayloadObjectTypeResolver::class, RootUpdateGenericTagTermMutationPayloadObjectTypeResolver::class];
    }
    protected function getObjectFieldName() : string
    {
        return 'tag';
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case $this->getObjectFieldName():
                return $this->getPostObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
