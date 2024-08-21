<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
/** @internal */
trait MutateCategoryTermMutationResolverTrait
{
    protected function getUserNotLoggedInError() : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E1);
    }
    protected function getTaxonomyDoesNotExistError(string $taxonomyName) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E5, [$taxonomyName]);
    }
    /**
     * @param string|int $taxonomyTermID
     */
    protected function getTaxonomyTermDoesNotExistError(?string $taxonomyName, $taxonomyTermID) : FeedbackItemResolution
    {
        if ($taxonomyName !== null && $taxonomyName !== '') {
            return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E7, [$taxonomyName, $taxonomyTermID]);
        }
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E6, [$taxonomyTermID]);
    }
    /**
     * @param string|int $taxonomyTermSlug
     */
    protected function getTaxonomyTermBySlugDoesNotExistError(?string $taxonomyName, $taxonomyTermSlug) : FeedbackItemResolution
    {
        if ($taxonomyName !== null && $taxonomyName !== '') {
            return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E9, [$taxonomyName, $taxonomyTermSlug]);
        }
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E8, [$taxonomyTermSlug]);
    }
}
