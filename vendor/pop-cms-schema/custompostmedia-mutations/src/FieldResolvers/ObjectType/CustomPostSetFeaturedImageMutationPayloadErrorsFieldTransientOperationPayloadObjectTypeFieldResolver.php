<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\CustomPostSetFeaturedImageMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType\CustomPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class CustomPostSetFeaturedImageMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType\CustomPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver|null
     */
    private $customPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver;
    public final function setCustomPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver(CustomPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver $customPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->customPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver = $customPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getCustomPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver() : CustomPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver
    {
        if ($this->customPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver === null) {
            /** @var CustomPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver */
            $customPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(CustomPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver::class);
            $this->customPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver = $customPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver;
        }
        return $this->customPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [CustomPostSetFeaturedImageMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getCustomPostSetFeaturedImageMutationErrorPayloadUnionTypeResolver();
    }
}
