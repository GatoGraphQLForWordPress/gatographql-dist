<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\RootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\RootCreateGenericCustomPostMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootCreateGenericCustomPostMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\RootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
    protected final function getRootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver() : RootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver */
            $rootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver = $rootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootCreateGenericCustomPostMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootCreateGenericCustomPostMutationErrorPayloadUnionTypeResolver();
    }
}
