<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostMediaMutations\ObjectModels\FeaturedImageIsNotSupportedByCustomPostTypeErrorPayload;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\FeaturedImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractFeaturedImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\FeaturedImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver|null
     */
    private $featuredImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver;
    public final function setFeaturedImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver(FeaturedImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver $featuredImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver) : void
    {
        $this->featuredImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver = $featuredImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver;
    }
    protected final function getFeaturedImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver() : FeaturedImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver
    {
        if ($this->featuredImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver === null) {
            /** @var FeaturedImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver */
            $featuredImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(FeaturedImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver::class);
            $this->featuredImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver = $featuredImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver;
        }
        return $this->featuredImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getFeaturedImageIsNotSupportedByCustomPostTypeErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return FeaturedImageIsNotSupportedByCustomPostTypeErrorPayload::class;
    }
}
