<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\RootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\RootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootDeletePostCategoryTermMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\RootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver() : RootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver */
            $rootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver = $rootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootDeletePostCategoryTermMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootDeletePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver();
    }
}
