<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\RootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\RootDeletePostCategoryTermMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootDeletePostCategoryTermMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\RootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver;
    public final function setRootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver(RootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver $rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver = $rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver() : RootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver */
            $rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver = $rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootDeletePostCategoryTermMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver();
    }
}
