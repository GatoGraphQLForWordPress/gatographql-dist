<?php

declare (strict_types=1);
namespace PoPCMSSchema\Media\TypeAPIs;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
interface MediaTypeAPIInterface
{
    /**
     * Indicates if the passed object is of type Media
     */
    public function isInstanceOfMediaType(object $object) : bool;
    /**
     * @param string|int|object $mediaItemObjectOrID
     */
    public function getMediaItemSrc($mediaItemObjectOrID) : ?string;
    /**
     * @param string|int|object $mediaItemObjectOrID
     */
    public function getMediaItemSrcPath($mediaItemObjectOrID) : ?string;
    /**
     * @param string|int|object $mediaItemObjectOrID
     */
    public function getImageSrc($mediaItemObjectOrID, ?string $size = null) : ?string;
    /**
     * @param string|int|object $mediaItemObjectOrID
     */
    public function getImageSrcPath($mediaItemObjectOrID, ?string $size = null) : ?string;
    /**
     * @param string|int|object $mediaItemObjectOrID
     */
    public function getImageSrcSet($mediaItemObjectOrID, ?string $size = null) : ?string;
    /**
     * @param string|int|object $mediaItemObjectOrID
     */
    public function getImageSizes($mediaItemObjectOrID, ?string $size = null) : ?string;
    /**
     * @return array{src:string,width:?int,height:?int}
     * @param string|int|object $mediaItemObjectOrID
     */
    public function getImageProperties($mediaItemObjectOrID, ?string $size = null) : ?array;
    /**
     * Get the media item with provided ID or, if it doesn't exist, null
     * @param int|string $id
     */
    public function getMediaItemByID($id) : ?object;
    /**
     * Get the media item with provided slug or, if it doesn't exist, null
     */
    public function getMediaItemBySlug(string $slug) : ?object;
    /**
     * @return array<string|int>|object[]
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getMediaItems(array $query, array $options = []) : array;
    /**
     * @param int|string $id
     */
    public function mediaItemByIDExists($id) : bool;
    public function mediaItemBySlugExists(string $slug) : bool;
    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getMediaItemCount(array $query, array $options = []) : int;
    /**
     * @return string|int
     */
    public function getMediaItemID(object $media);
    /**
     * @param string|int|object $mediaObjectOrID
     */
    public function getTitle($mediaObjectOrID) : ?string;
    /**
     * @param string|int|object $mediaObjectOrID
     */
    public function getCaption($mediaObjectOrID) : ?string;
    /**
     * @param string|int|object $mediaObjectOrID
     */
    public function getAltText($mediaObjectOrID) : ?string;
    /**
     * @param string|int|object $mediaObjectOrID
     */
    public function getDescription($mediaObjectOrID) : ?string;
    /**
     * @param string|int|object $mediaObjectOrID
     */
    public function getDate($mediaObjectOrID, bool $gmt = \false) : ?string;
    /**
     * @param string|int|object $mediaObjectOrID
     */
    public function getModified($mediaObjectOrID, bool $gmt = \false) : ?string;
    /**
     * @param string|int|object $mediaObjectOrID
     */
    public function getMimeType($mediaObjectOrID) : ?string;
}
