<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\TaxonomyMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class LoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\TaxonomyMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader|null
     */
    private $loggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader;
    protected final function getLoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader() : LoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader
    {
        if ($this->loggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader === null) {
            /** @var LoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader */
            $loggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(LoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader::class);
            $this->loggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader = $loggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader;
        }
        return $this->loggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'LoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The logged-in user has no permission to edit taxonomy terms"', 'taxonomy-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getLoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeDataLoader();
    }
}
