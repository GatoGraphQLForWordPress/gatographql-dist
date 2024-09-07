<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeAPIs;

/** @internal */
interface CustomPostTagTypeMutationAPIInterface
{
    /**
     * @param array<string|int> $tagIDs
     * @param int|string $customPostID
     */
    public function setTagsByID(string $taxonomyName, $customPostID, array $tagIDs, bool $append = \false) : void;
    /**
     * @param array<string|int> $tagSlugs
     * @param int|string $customPostID
     */
    public function setTagsBySlug(string $taxonomyName, $customPostID, array $tagSlugs, bool $append = \false) : void;
}
