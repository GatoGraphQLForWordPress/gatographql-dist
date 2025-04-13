<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\GenericCustomPostAddMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericCustomPostAddMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getGenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver() : GenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver */
            $genericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver = $genericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericCustomPostAddMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getGenericCustomPostAddMetaMutationErrorPayloadUnionTypeResolver();
    }
}
