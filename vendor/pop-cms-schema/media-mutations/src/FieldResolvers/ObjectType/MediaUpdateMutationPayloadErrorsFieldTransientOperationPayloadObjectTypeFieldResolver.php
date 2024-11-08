<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\MediaUpdateMutationPayloadObjectTypeResolver;
use PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\MediaUpdateMutationErrorPayloadUnionTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class MediaUpdateMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\MediaUpdateMutationErrorPayloadUnionTypeResolver|null
     */
    private $mediaUpdateMutationErrorPayloadUnionTypeResolver;
    protected final function getMediaUpdateMutationErrorPayloadUnionTypeResolver() : MediaUpdateMutationErrorPayloadUnionTypeResolver
    {
        if ($this->mediaUpdateMutationErrorPayloadUnionTypeResolver === null) {
            /** @var MediaUpdateMutationErrorPayloadUnionTypeResolver */
            $mediaUpdateMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(MediaUpdateMutationErrorPayloadUnionTypeResolver::class);
            $this->mediaUpdateMutationErrorPayloadUnionTypeResolver = $mediaUpdateMutationErrorPayloadUnionTypeResolver;
        }
        return $this->mediaUpdateMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [MediaUpdateMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getMediaUpdateMutationErrorPayloadUnionTypeResolver();
    }
}
