<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Constants;

class PluginSetupDataEntrySlugs
{
    /**
     * @gatographql-note: Do not rename this slug, as it's referenced when installing the testing webservers
     */
    public const SCHEMA_CONFIGURATION_NESTED_MUTATIONS = 'nested-mutations';
    /**
     * @gatographql-note: Do not rename this slug, as it's referenced when installing the testing webservers
     */
    public const SCHEMA_CONFIGURATION_BULK_MUTATIONS = 'bulk-mutations';

    public const CUSTOM_ENDPOINT_INTERNAL = 'internal';
    public const CUSTOM_ENDPOINT_NESTED_MUTATIONS = 'nested-mutations';
    public const CUSTOM_ENDPOINT_BULK_MUTATIONS = 'bulk-mutations';

    public const PERSISTED_QUERY_ADD_COMMENTS_BLOCK_TO_POST = 'add-comments-block-to-post';
    public const PERSISTED_QUERY_ADD_MISSING_LINKS_IN_POST = 'add-missing-links-in-post';
    public const PERSISTED_QUERY_CREATE_MISSING_TRANSLATION_POSTS_FOR_POLYLANG = 'create-missing-translation-posts-for-polylang';
    public const PERSISTED_QUERY_DUPLICATE_POST = 'duplicate-post';
    public const PERSISTED_QUERY_DUPLICATE_POSTS = 'duplicate-posts';
    public const PERSISTED_QUERY_EXPORT_POST_TO_WORDPRESS_SITE = 'export-post-to-wordpress-site';
    public const PERSISTED_QUERY_FETCH_COMMENTS_BY_PERIOD = 'fetch-comments-by-period';
    public const PERSISTED_QUERY_FETCH_IMAGE_URLS_IN_BLOCKS = 'fetch-image-urls-in-blocks';
    public const PERSISTED_QUERY_FETCH_POST_LINKS = 'fetch-post-links';
    public const PERSISTED_QUERY_FETCH_POSTS_BY_THUMBNAIL = 'fetch-posts-by-thumbnail';
    public const PERSISTED_QUERY_FETCH_USERS_BY_LOCALE = 'fetch-users-by-locale';
    public const PERSISTED_QUERY_GENERATE_A_POSTS_FEATURED_IMAGE_USING_AI_AND_OPTIMIZE_IT = 'generate-a-posts-featured-image-using-ai-and-optimize-it';
    public const PERSISTED_QUERY_IMPORT_POST_FROM_WORDPRESS_RSS_FEED = 'import-post-from-wordpress-rss-feed';
    public const PERSISTED_QUERY_IMPORT_POST_FROM_WORDPRESS_SITE = 'import-post-from-wordpress-site';
    public const PERSISTED_QUERY_IMPORT_POSTS_FROM_CSV = 'import-posts-from-csv';
    public const PERSISTED_QUERY_INSERT_BLOCK_IN_POST = 'insert-block-in-post';
    public const PERSISTED_QUERY_INSERT_BLOCK_IN_POSTS = 'insert-block-in-posts';
    public const PERSISTED_QUERY_REGEX_REPLACE_STRINGS_IN_POST = 'regex-replace-strings-in-post';
    public const PERSISTED_QUERY_REGEX_REPLACE_STRINGS_IN_POSTS = 'regex-replace-strings-in-posts';
    public const PERSISTED_QUERY_REGISTER_A_NEWSLETTER_SUBSCRIBER_FROM_INSTAWP_TO_MAILCHIMP = 'register-a-newsletter-subscriber-from-instawp-to-mailchimp';
    public const PERSISTED_QUERY_REMOVE_BLOCK_FROM_POSTS = 'remove-block-from-posts';
    public const PERSISTED_QUERY_REPLACE_DOMAIN_IN_POSTS = 'replace-domain-in-posts';
    public const PERSISTED_QUERY_REPLACE_HTTP_WITH_HTTPS_IN_IMAGE_SOURCES_IN_POST = 'replace-http-with-https-in-image-sources-in-post';
    public const PERSISTED_QUERY_REPLACE_POST_SLUG_IN_POSTS = 'replace-post-slug-in-posts';
    public const PERSISTED_QUERY_REPLACE_STRINGS_IN_POST = 'replace-strings-in-post';
    public const PERSISTED_QUERY_REPLACE_STRINGS_IN_POSTS = 'replace-strings-in-posts';
    public const PERSISTED_QUERY_SEND_EMAIL_TO_ADMIN_ABOUT_POST = 'send-email-to-admin-about-post';
    public const PERSISTED_QUERY_SEND_EMAIL_TO_USERS_ABOUT_POST = 'send-email-to-users-about-post';
    public const PERSISTED_QUERY_SYNC_FEATUREDIMAGE_FOR_POLYLANG = 'sync-featuredimage-for-polylang';
    public const PERSISTED_QUERY_SYNC_TAGS_AND_CATEGORIES_FOR_POLYLANG = 'sync-tags-and-categories-for-polylang';
    public const PERSISTED_QUERY_TRANSLATE_AND_CREATE_ALL_PAGES_FOR_MULTILINGUAL_WORDPRESS_SITE_CLASSIC_EDITOR = 'translate-and-create-all-pages-for-multilingual-wordpress-site-classic-editor';
    public const PERSISTED_QUERY_TRANSLATE_AND_CREATE_ALL_PAGES_FOR_MULTILINGUAL_WORDPRESS_SITE_GUTENBERG = 'translate-and-create-all-pages-for-multilingual-wordpress-site-gutenberg';
    public const PERSISTED_QUERY_TRANSLATE_CONTENT_FROM_URL = 'translate-content-from-url';
    public const PERSISTED_QUERY_TRANSLATE_POEDIT_FILE_CONTENT = 'translate-poedit-file-content';
    public const PERSISTED_QUERY_TRANSLATE_POST_CLASSIC_EDITOR = 'translate-post-classic-editor';
    public const PERSISTED_QUERY_TRANSLATE_POST_GUTENBERG = 'translate-post-gutenberg';
    public const PERSISTED_QUERY_TRANSLATE_POSTS_CLASSIC_EDITOR = 'translate-posts-classic-editor';
    public const PERSISTED_QUERY_TRANSLATE_POSTS_GUTENBERG = 'translate-posts-gutenberg';
    public const PERSISTED_QUERY_TRANSLATE_POSTS_FOR_POLYLANG_CLASSIC_EDITOR = 'translate-posts-for-polylang-classic-editor';
    public const PERSISTED_QUERY_TRANSLATE_POSTS_FOR_POLYLANG_GUTENBERG = 'translate-posts-for-polylang-gutenberg';
    public const PERSISTED_QUERY_TRANSLATE_POSTS_FOR_MULTILINGUALPRESS_CLASSIC_EDITOR = 'translate-posts-for-multilingualpress-classic-editor';
    public const PERSISTED_QUERY_TRANSLATE_POSTS_FOR_MULTILINGUALPRESS_GUTENBERG = 'translate-posts-for-multilingualpress-gutenberg';
}
