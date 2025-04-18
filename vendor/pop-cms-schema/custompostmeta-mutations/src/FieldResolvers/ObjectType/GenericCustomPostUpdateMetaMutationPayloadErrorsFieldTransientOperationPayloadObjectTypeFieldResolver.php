<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\GenericCustomPostUpdateMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericCustomPostUpdateMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getGenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver() : GenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver */
            $genericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver = $genericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericCustomPostUpdateMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getGenericCustomPostUpdateMetaMutationErrorPayloadUnionTypeResolver();
    }
}
