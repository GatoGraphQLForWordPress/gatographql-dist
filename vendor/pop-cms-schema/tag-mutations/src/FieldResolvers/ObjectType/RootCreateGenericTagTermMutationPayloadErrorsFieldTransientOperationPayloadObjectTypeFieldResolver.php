<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\RootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\RootCreateGenericTagTermMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootCreateGenericTagTermMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\UnionType\RootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver;
    public final function setRootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver(RootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver $rootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver = $rootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver() : RootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver */
            $rootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver = $rootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootCreateGenericTagTermMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver();
    }
}
