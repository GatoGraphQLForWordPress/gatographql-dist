<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeAPIs;

/** @internal */
interface CustomPostTagTypeMutationAPIInterface
{
    /**
     * @param array<string|int> $tags List of tags by ID, slug, or a combination of them
     * @param int|string $postID
     */
    public function setTags($postID, array $tags, bool $append = \false) : void;
}
