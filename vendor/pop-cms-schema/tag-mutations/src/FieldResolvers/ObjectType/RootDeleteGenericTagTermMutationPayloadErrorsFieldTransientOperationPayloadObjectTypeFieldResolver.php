<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\RootDeleteGenericTagTermMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootDeleteGenericTagTermMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\UnionType\RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver;
    public final function setRootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver(RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver = $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver() : RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver */
            $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver = $rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootDeleteGenericTagTermMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver();
    }
}
