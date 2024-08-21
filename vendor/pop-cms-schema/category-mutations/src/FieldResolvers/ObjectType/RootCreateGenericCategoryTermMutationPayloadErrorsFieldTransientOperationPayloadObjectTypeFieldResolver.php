<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CategoryMutations\TypeResolvers\ObjectType\RootCreateGenericCategoryTermMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootCreateGenericCategoryTermMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
    public final function setRootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver(RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver = $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver() : RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver */
            $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver = $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootCreateGenericCategoryTermMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver();
    }
}
