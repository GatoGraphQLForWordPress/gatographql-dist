<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeAPIs;

/** @internal */
interface CustomPostCategoryTypeMutationAPIInterface
{
    /**
     * @param array<string|int> $categoryIDs
     * @param int|string $customPostID
     */
    public function setCategoriesByID(string $taxonomyName, $customPostID, array $categoryIDs, bool $append = \false) : void;
    /**
     * @param string[] $categorySlugs
     * @param int|string $customPostID
     */
    public function setCategoriesBySlug(string $taxonomyName, $customPostID, array $categorySlugs, bool $append = \false) : void;
}
