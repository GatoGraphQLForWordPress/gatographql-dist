<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\GenericCategorySetMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\UnionType\GenericCategorySetMetaMutationErrorPayloadUnionTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericCategorySetMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\UnionType\GenericCategorySetMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericCategorySetMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getGenericCategorySetMetaMutationErrorPayloadUnionTypeResolver() : GenericCategorySetMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCategorySetMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCategorySetMetaMutationErrorPayloadUnionTypeResolver */
            $genericCategorySetMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCategorySetMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCategorySetMetaMutationErrorPayloadUnionTypeResolver = $genericCategorySetMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCategorySetMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericCategorySetMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getGenericCategorySetMetaMutationErrorPayloadUnionTypeResolver();
    }
}
