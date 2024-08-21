<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\RootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CategoryMutations\TypeResolvers\ObjectType\RootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootDeleteGenericCategoryTermMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\RootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
    public final function setRootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver(RootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver $rootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver = $rootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver() : RootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver */
            $rootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver = $rootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootDeleteGenericCategoryTermMutationErrorPayloadUnionTypeResolver();
    }
}
