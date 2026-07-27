<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostMutations\ObjectModels\CustomPostDoesNotSupportTrashErrorPayload;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\CustomPostDoesNotSupportTrashErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractCustomPostDoesNotSupportTrashErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    private ?CustomPostDoesNotSupportTrashErrorPayloadObjectTypeResolver $customPostDoesNotSupportTrashErrorPayloadObjectTypeResolver = null;
    protected final function getCustomPostDoesNotSupportTrashErrorPayloadObjectTypeResolver() : CustomPostDoesNotSupportTrashErrorPayloadObjectTypeResolver
    {
        if ($this->customPostDoesNotSupportTrashErrorPayloadObjectTypeResolver === null) {
            /** @var CustomPostDoesNotSupportTrashErrorPayloadObjectTypeResolver */
            $customPostDoesNotSupportTrashErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(CustomPostDoesNotSupportTrashErrorPayloadObjectTypeResolver::class);
            $this->customPostDoesNotSupportTrashErrorPayloadObjectTypeResolver = $customPostDoesNotSupportTrashErrorPayloadObjectTypeResolver;
        }
        return $this->customPostDoesNotSupportTrashErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getCustomPostDoesNotSupportTrashErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return CustomPostDoesNotSupportTrashErrorPayload::class;
    }
}
