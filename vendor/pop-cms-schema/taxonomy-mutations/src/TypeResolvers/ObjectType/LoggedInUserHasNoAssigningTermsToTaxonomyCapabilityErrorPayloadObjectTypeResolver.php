<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\TaxonomyMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\TaxonomyMutations\RelationalTypeDataLoaders\ObjectType\LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader|null
     */
    private $loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader;
    public final function setLoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader(LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader $loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader) : void
    {
        $this->loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader = $loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader;
    }
    protected final function getLoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader() : LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader
    {
        if ($this->loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader === null) {
            /** @var LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader */
            $loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader::class);
            $this->loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader = $loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader;
        }
        return $this->loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The logged-in user has no permission to assign terms to a taxonomy"', 'taxonomy-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getLoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeDataLoader();
    }
}
