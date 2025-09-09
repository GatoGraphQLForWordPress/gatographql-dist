<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\TaxonomyMutations\ObjectModels\TaxonomyIsNotValidErrorPayload;
use PoPCMSSchema\TaxonomyMutations\TypeResolvers\ObjectType\TaxonomyIsNotValidErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractTaxonomyIsNotValidErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    private ?TaxonomyIsNotValidErrorPayloadObjectTypeResolver $taxonomyIsNotValidErrorPayloadObjectTypeResolver = null;
    protected final function getTaxonomyIsNotValidErrorPayloadObjectTypeResolver() : TaxonomyIsNotValidErrorPayloadObjectTypeResolver
    {
        if ($this->taxonomyIsNotValidErrorPayloadObjectTypeResolver === null) {
            /** @var TaxonomyIsNotValidErrorPayloadObjectTypeResolver */
            $taxonomyIsNotValidErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(TaxonomyIsNotValidErrorPayloadObjectTypeResolver::class);
            $this->taxonomyIsNotValidErrorPayloadObjectTypeResolver = $taxonomyIsNotValidErrorPayloadObjectTypeResolver;
        }
        return $this->taxonomyIsNotValidErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getTaxonomyIsNotValidErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return TaxonomyIsNotValidErrorPayload::class;
    }
}
