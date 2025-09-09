<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\TaxonomyMutations\ObjectModels\TaxonomyTermDoesNotExistErrorPayload;
use PoPCMSSchema\TaxonomyMutations\TypeResolvers\ObjectType\TaxonomyTermDoesNotExistErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractTaxonomyTermDoesNotExistErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    private ?TaxonomyTermDoesNotExistErrorPayloadObjectTypeResolver $taxonomyTermDoesNotExistErrorPayloadObjectTypeResolver = null;
    protected final function getTaxonomyTermDoesNotExistErrorPayloadObjectTypeResolver() : TaxonomyTermDoesNotExistErrorPayloadObjectTypeResolver
    {
        if ($this->taxonomyTermDoesNotExistErrorPayloadObjectTypeResolver === null) {
            /** @var TaxonomyTermDoesNotExistErrorPayloadObjectTypeResolver */
            $taxonomyTermDoesNotExistErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(TaxonomyTermDoesNotExistErrorPayloadObjectTypeResolver::class);
            $this->taxonomyTermDoesNotExistErrorPayloadObjectTypeResolver = $taxonomyTermDoesNotExistErrorPayloadObjectTypeResolver;
        }
        return $this->taxonomyTermDoesNotExistErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getTaxonomyTermDoesNotExistErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return TaxonomyTermDoesNotExistErrorPayload::class;
    }
}
