<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\RootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType\RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootSetFeaturedImageOnCustomPostMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType\RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver;
    public final function setRootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver(RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver $rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver = $rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver() : RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver */
            $rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver = $rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootSetFeaturedImageOnCustomPostMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver();
    }
}
