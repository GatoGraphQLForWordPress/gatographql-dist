<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostMutations\TypeResolvers\UnionType\RootCreatePostMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostMutations\TypeResolvers\ObjectType\RootCreatePostMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
class RootCreatePostMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostMutations\TypeResolvers\UnionType\RootCreatePostMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootCreatePostMutationErrorPayloadUnionTypeResolver;
    public final function setRootCreatePostMutationErrorPayloadUnionTypeResolver(RootCreatePostMutationErrorPayloadUnionTypeResolver $rootCreatePostMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootCreatePostMutationErrorPayloadUnionTypeResolver = $rootCreatePostMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootCreatePostMutationErrorPayloadUnionTypeResolver() : RootCreatePostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreatePostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreatePostMutationErrorPayloadUnionTypeResolver */
            $rootCreatePostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreatePostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreatePostMutationErrorPayloadUnionTypeResolver = $rootCreatePostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreatePostMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootCreatePostMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootCreatePostMutationErrorPayloadUnionTypeResolver();
    }
}
