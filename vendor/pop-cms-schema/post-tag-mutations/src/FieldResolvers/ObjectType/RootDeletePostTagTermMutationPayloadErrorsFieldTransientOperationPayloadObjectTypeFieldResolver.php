<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\RootDeletePostTagTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\RootDeletePostTagTermMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootDeletePostTagTermMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\RootDeletePostTagTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver;
    public final function setRootDeletePostTagTermMutationErrorPayloadUnionTypeResolver(RootDeletePostTagTermMutationErrorPayloadUnionTypeResolver $rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver = $rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootDeletePostTagTermMutationErrorPayloadUnionTypeResolver() : RootDeletePostTagTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeletePostTagTermMutationErrorPayloadUnionTypeResolver */
            $rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeletePostTagTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver = $rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootDeletePostTagTermMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootDeletePostTagTermMutationErrorPayloadUnionTypeResolver();
    }
}