<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\RootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\RootDeletePostTagTermMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootDeletePostTagTermMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    private ?RootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver $rootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver() : RootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver */
            $rootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver = $rootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootDeletePostTagTermMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootDeletePostTagTermMetaMutationErrorPayloadUnionTypeResolver();
    }
}
