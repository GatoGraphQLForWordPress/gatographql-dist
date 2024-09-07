<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\GenericTagUpdateMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\RootCreateGenericTagTermMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\RootUpdateGenericTagTermMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractObjectMutationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericTagMutationPayloadObjectTypeFieldResolver extends AbstractObjectMutationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver|null
     */
    private $genericTagObjectTypeResolver;
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
                return $this->getGenericTagObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
