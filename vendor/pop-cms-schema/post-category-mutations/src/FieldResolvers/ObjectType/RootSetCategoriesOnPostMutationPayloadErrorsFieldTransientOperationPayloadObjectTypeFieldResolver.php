<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\RootSetCategoriesOnPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\RootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootSetCategoriesOnPostMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\RootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver;
    public final function setRootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver(RootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver $rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver = $rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver() : RootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver */
            $rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver = $rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootSetCategoriesOnPostMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootSetCategoriesOnPostMutationErrorPayloadUnionTypeResolver();
    }
}
