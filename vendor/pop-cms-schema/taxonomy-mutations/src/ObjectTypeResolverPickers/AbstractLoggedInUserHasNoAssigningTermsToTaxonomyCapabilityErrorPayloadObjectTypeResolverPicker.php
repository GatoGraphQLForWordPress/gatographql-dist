<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\TaxonomyMutations\ObjectModels\LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayload;
use PoPCMSSchema\TaxonomyMutations\TypeResolvers\ObjectType\LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractLoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\TaxonomyMutations\TypeResolvers\ObjectType\LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver|null
     */
    private $loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver;
    public final function setLoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver(LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver $loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver) : void
    {
        $this->loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver = $loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver;
    }
    protected final function getLoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver() : LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver
    {
        if ($this->loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver === null) {
            /** @var LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver */
            $loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver::class);
            $this->loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver = $loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver;
        }
        return $this->loggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getLoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return LoggedInUserHasNoAssigningTermsToTaxonomyCapabilityErrorPayload::class;
    }
}
