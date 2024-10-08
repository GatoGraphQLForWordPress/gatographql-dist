<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\Constants;

/** @internal */
class MutationInputProperties
{
    /**
     * Call it "id" instead of "customPostID" because this input
     * will be exposed in the GraphQL schema, for any CPT
     * (post, event, etc)
     */
    public const CUSTOMPOST_ID = 'id';
    public const TAGS_BY = 'tagsBy';
    public const APPEND = 'append';
    public const TAXONOMY = 'taxonomy';
    public const IDS = 'ids';
    public const SLUGS = 'slugs';
}
