<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\MenuMutations\TypeResolvers\ObjectType\RootCreateMenuMutationPayloadObjectTypeResolver;
use PoPCMSSchema\MenuMutations\TypeResolvers\UnionType\RootCreateMenuMutationErrorPayloadUnionTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootCreateMenuMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    private ?RootCreateMenuMutationErrorPayloadUnionTypeResolver $rootCreateMenuMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootCreateMenuMutationErrorPayloadUnionTypeResolver() : RootCreateMenuMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreateMenuMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreateMenuMutationErrorPayloadUnionTypeResolver */
            $rootCreateMenuMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreateMenuMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreateMenuMutationErrorPayloadUnionTypeResolver = $rootCreateMenuMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreateMenuMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootCreateMenuMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootCreateMenuMutationErrorPayloadUnionTypeResolver();
    }
}
