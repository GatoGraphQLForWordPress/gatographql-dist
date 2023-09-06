<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeAPIs;

interface CustomPostCategoryTypeMutationAPIInterface
{
    /**
     * @param array<string|int> $categoryIDs
     * @param int|string $postID
     */
    public function setCategoriesByID($postID, array $categoryIDs, bool $append = \false) : void;
    /**
     * @param string[] $categorySlugs
     * @param int|string $postID
     */
    public function setCategoriesBySlug($postID, array $categorySlugs, bool $append = \false) : void;
}
