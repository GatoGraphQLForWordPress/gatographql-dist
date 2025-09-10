<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeAPIs;

/** @internal */
interface CustomPostCategoryTypeMutationAPIInterface
{
    /**
     * @param array<string|int> $categoryIDs
     */
    public function setCategoriesByID(string $taxonomyName, int|string $customPostID, array $categoryIDs, bool $append = \false) : void;
    /**
     * @param string[] $categorySlugs
     */
    public function setCategoriesBySlug(string $taxonomyName, int|string $customPostID, array $categorySlugs, bool $append = \false) : void;
}
