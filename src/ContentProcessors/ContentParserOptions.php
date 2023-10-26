<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ContentProcessors;

class ContentParserOptions
{
    public const APPEND_PATH_URL_TO_IMAGES = 'appendPathURLToImages';
    public const SUPPORT_MARKDOWN_LINKS = 'supportMarkdownLinks';
    public const OPEN_EXTERNAL_LINKS_IN_NEW_TAB = 'openExternalLinksInNewTab';
    public const ADD_EXTERNAL_LINK_ICON = 'addExternalLinkIcon';
    public const APPEND_PATH_URL_TO_ANCHORS = 'appendPathURLToAnchors';
    public const ADD_CLASSES = 'addClasses';
    public const EMBED_VIDEOS = 'embedVideos';
    public const HIGHLIGHT_CODE = 'highlightCode';
    public const TAB_CONTENT = 'tabContent';
    public const REPLACEMENTS = 'replacements';
}
