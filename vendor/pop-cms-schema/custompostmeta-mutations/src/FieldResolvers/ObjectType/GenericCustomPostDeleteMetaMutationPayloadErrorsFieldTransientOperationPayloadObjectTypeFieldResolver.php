<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\GenericCustomPostDeleteMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericCustomPostDeleteMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getGenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver() : GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver */
            $genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver = $genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericCustomPostDeleteMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getGenericCustomPostDeleteMetaMutationErrorPayloadUnionTypeResolver();
    }
}
