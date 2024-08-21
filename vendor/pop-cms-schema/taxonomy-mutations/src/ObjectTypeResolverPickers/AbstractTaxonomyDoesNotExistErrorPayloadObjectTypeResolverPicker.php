<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\TaxonomyMutations\ObjectModels\TaxonomyDoesNotExistErrorPayload;
use PoPCMSSchema\TaxonomyMutations\TypeResolvers\ObjectType\TaxonomyDoesNotExistErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractTaxonomyDoesNotExistErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\TaxonomyMutations\TypeResolvers\ObjectType\TaxonomyDoesNotExistErrorPayloadObjectTypeResolver|null
     */
    private $categoryDoesNotExistErrorPayloadObjectTypeResolver;
    public final function setTaxonomyDoesNotExistErrorPayloadObjectTypeResolver(TaxonomyDoesNotExistErrorPayloadObjectTypeResolver $categoryDoesNotExistErrorPayloadObjectTypeResolver) : void
    {
        $this->categoryDoesNotExistErrorPayloadObjectTypeResolver = $categoryDoesNotExistErrorPayloadObjectTypeResolver;
    }
    protected final function getTaxonomyDoesNotExistErrorPayloadObjectTypeResolver() : TaxonomyDoesNotExistErrorPayloadObjectTypeResolver
    {
        if ($this->categoryDoesNotExistErrorPayloadObjectTypeResolver === null) {
            /** @var TaxonomyDoesNotExistErrorPayloadObjectTypeResolver */
            $categoryDoesNotExistErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(TaxonomyDoesNotExistErrorPayloadObjectTypeResolver::class);
            $this->categoryDoesNotExistErrorPayloadObjectTypeResolver = $categoryDoesNotExistErrorPayloadObjectTypeResolver;
        }
        return $this->categoryDoesNotExistErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getTaxonomyDoesNotExistErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return TaxonomyDoesNotExistErrorPayload::class;
    }
}
