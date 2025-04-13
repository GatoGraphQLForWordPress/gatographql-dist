<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\RootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\ObjectType\RootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootUpdatePostCategoryTermMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMetaMutations\TypeResolvers\UnionType\RootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver() : RootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver */
            $rootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver = $rootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootUpdatePostCategoryTermMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootUpdatePostCategoryTermMetaMutationErrorPayloadUnionTypeResolver();
    }
}
