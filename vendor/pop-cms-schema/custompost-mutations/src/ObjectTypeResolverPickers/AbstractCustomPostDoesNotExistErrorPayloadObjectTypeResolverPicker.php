<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostMutations\ObjectModels\CustomPostDoesNotExistErrorPayload;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\CustomPostDoesNotExistErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
abstract class AbstractCustomPostDoesNotExistErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\CustomPostDoesNotExistErrorPayloadObjectTypeResolver|null
     */
    private $customPostDoesNotExistErrorPayloadObjectTypeResolver;
    public final function setCustomPostDoesNotExistErrorPayloadObjectTypeResolver(CustomPostDoesNotExistErrorPayloadObjectTypeResolver $customPostDoesNotExistErrorPayloadObjectTypeResolver) : void
    {
        $this->customPostDoesNotExistErrorPayloadObjectTypeResolver = $customPostDoesNotExistErrorPayloadObjectTypeResolver;
    }
    protected final function getCustomPostDoesNotExistErrorPayloadObjectTypeResolver() : CustomPostDoesNotExistErrorPayloadObjectTypeResolver
    {
        if ($this->customPostDoesNotExistErrorPayloadObjectTypeResolver === null) {
            /** @var CustomPostDoesNotExistErrorPayloadObjectTypeResolver */
            $customPostDoesNotExistErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(CustomPostDoesNotExistErrorPayloadObjectTypeResolver::class);
            $this->customPostDoesNotExistErrorPayloadObjectTypeResolver = $customPostDoesNotExistErrorPayloadObjectTypeResolver;
        }
        return $this->customPostDoesNotExistErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getCustomPostDoesNotExistErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return CustomPostDoesNotExistErrorPayload::class;
    }
}
