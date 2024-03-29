<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeAPIs;

use PoPCMSSchema\MediaMutations\Exception\MediaItemCRUDMutationException;
/** @internal */
interface MediaTypeMutationAPIInterface
{
    /**
     * @throws MediaItemCRUDMutationException In case of error
     * @param string|null $filename Override the filename from the URL, or pass `null` to use filename from URL
     * @param array<string,mixed> $mediaItemData
     * @return string|int
     */
    public function createMediaItemFromURL(string $url, ?string $filename, array $mediaItemData);
    /**
     * @throws MediaItemCRUDMutationException In case of error
     * @param array<string,mixed> $mediaItemData
     * @return string|int
     */
    public function createMediaItemFromContents(string $body, string $filename, array $mediaItemData);
}
