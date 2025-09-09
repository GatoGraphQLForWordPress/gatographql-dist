<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\RootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\RootUpdatePostTagTermMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootUpdatePostTagTermMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    private ?RootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver $rootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver() : RootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver */
            $rootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver = $rootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootUpdatePostTagTermMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootUpdatePostTagTermMutationErrorPayloadUnionTypeResolver();
    }
}
