<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\AbstractPostCategoryDeleteMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\AbstractRootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\TaxonomyMutations\ObjectTypeResolverPickers\AbstractLoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class LoggedInUserHasNoDeletingTaxonomyTermCapabilityMutationErrorPayloadObjectTypeResolverPicker extends AbstractLoggedInUserHasNoEditingTaxonomyTermsCapabilityErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractRootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver::class, AbstractPostCategoryDeleteMutationErrorPayloadUnionTypeResolver::class];
    }
}
