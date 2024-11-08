<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ModuleResolvers;

use GatoGraphQL\GatoGraphQL\ContentProcessors\MarkdownContentParserInterface;
use GatoGraphQL\GatoGraphQL\ModuleSettings\Properties;
use GatoGraphQL\GatoGraphQL\Plugin;

class MutationSchemaTypeModuleResolver extends AbstractModuleResolver
{
    use ModuleResolverTrait {
        ModuleResolverTrait::hasDocumentation as upstreamHasDocumentation;
    }
    use SchemaTypeModuleResolverTrait {
        getPriority as getUpstreamPriority;
    }

    public const SCHEMA_USER_STATE_MUTATIONS = Plugin::NAMESPACE . '\schema-user-state-mutations';
    public const SCHEMA_CUSTOMPOST_MUTATIONS = Plugin::NAMESPACE . '\schema-custompost-mutations';
    public const SCHEMA_PAGE_MUTATIONS = Plugin::NAMESPACE . '\schema-page-mutations';
    public const SCHEMA_POST_MUTATIONS = Plugin::NAMESPACE . '\schema-post-mutations';
    public const SCHEMA_MEDIA_MUTATIONS = Plugin::NAMESPACE . '\schema-media-mutations';
    public const SCHEMA_CUSTOMPOSTMEDIA_MUTATIONS = Plugin::NAMESPACE . '\schema-custompostmedia-mutations';
    public const SCHEMA_PAGEMEDIA_MUTATIONS = Plugin::NAMESPACE . '\schema-pagemedia-mutations';
    public const SCHEMA_POSTMEDIA_MUTATIONS = Plugin::NAMESPACE . '\schema-postmedia-mutations';
    public const SCHEMA_CUSTOMPOST_USER_MUTATIONS = Plugin::NAMESPACE . '\schema-custompost-user-mutations';
    public const SCHEMA_TAG_MUTATIONS = Plugin::NAMESPACE . '\schema-tag-mutations';
    public const SCHEMA_CUSTOMPOST_TAG_MUTATIONS = Plugin::NAMESPACE . '\schema-custompost-tag-mutations';
    public const SCHEMA_POST_TAG_MUTATIONS = Plugin::NAMESPACE . '\schema-post-tag-mutations';
    public const SCHEMA_CATEGORY_MUTATIONS = Plugin::NAMESPACE . '\schema-category-mutations';
    public const SCHEMA_CUSTOMPOST_CATEGORY_MUTATIONS = Plugin::NAMESPACE . '\schema-custompost-category-mutations';
    public const SCHEMA_POST_CATEGORY_MUTATIONS = Plugin::NAMESPACE . '\schema-post-category-mutations';
    public const SCHEMA_COMMENT_MUTATIONS = Plugin::NAMESPACE . '\schema-comment-mutations';

    /**
     * Setting options
     */
    public const OPTION_TREAT_AUTHOR_INPUT_IN_CUSTOMPOST_MUTATION_AS_SENSITIVE_DATA = 'treat-author-input-in-custompost-mutation-as-sensitive-data';

    /**
     * @var \GatoGraphQL\GatoGraphQL\ContentProcessors\MarkdownContentParserInterface|null
     */
    private $markdownContentParser;

    final protected function getMarkdownContentParser(): MarkdownContentParserInterface
    {
        if ($this->markdownContentParser === null) {
            /** @var MarkdownContentParserInterface */
            $markdownContentParser = $this->instanceManager->getInstance(MarkdownContentParserInterface::class);
            $this->markdownContentParser = $markdownContentParser;
        }
        return $this->markdownContentParser;
    }

    /**
     * @return string[]
     */
    public function getModulesToResolve(): array
    {
        return [
            self::SCHEMA_USER_STATE_MUTATIONS,
            self::SCHEMA_CUSTOMPOST_MUTATIONS,
            self::SCHEMA_PAGE_MUTATIONS,
            self::SCHEMA_POST_MUTATIONS,
            self::SCHEMA_MEDIA_MUTATIONS,
            self::SCHEMA_CUSTOMPOSTMEDIA_MUTATIONS,
            self::SCHEMA_PAGEMEDIA_MUTATIONS,
            self::SCHEMA_POSTMEDIA_MUTATIONS,
            self::SCHEMA_CUSTOMPOST_USER_MUTATIONS,
            self::SCHEMA_TAG_MUTATIONS,
            self::SCHEMA_CUSTOMPOST_TAG_MUTATIONS,
            self::SCHEMA_POST_TAG_MUTATIONS,
            self::SCHEMA_CATEGORY_MUTATIONS,
            self::SCHEMA_CUSTOMPOST_CATEGORY_MUTATIONS,
            self::SCHEMA_POST_CATEGORY_MUTATIONS,
            self::SCHEMA_COMMENT_MUTATIONS,
        ];
    }

    public function getPriority(): int
    {
        return $this->getUpstreamPriority() - 3;
    }

    /**
     * @return array<string[]> List of entries that must be satisfied, each entry is an array where at least 1 module must be satisfied
     */
    public function getDependedModuleLists(string $module): array
    {
        switch ($module) {
            case self::SCHEMA_USER_STATE_MUTATIONS:
                return [
                    [
                        SchemaConfigurationFunctionalityModuleResolver::MUTATIONS,
                    ],
                ];
            case self::SCHEMA_CUSTOMPOST_MUTATIONS:
                return [
                    [
                        self::SCHEMA_USER_STATE_MUTATIONS,
                    ],
                    [
                        SchemaTypeModuleResolver::SCHEMA_CUSTOMPOSTS,
                    ],
                ];
            case self::SCHEMA_PAGE_MUTATIONS:
                return [
                    [
                        SchemaTypeModuleResolver::SCHEMA_PAGES,
                    ],
                    [
                        self::SCHEMA_CUSTOMPOST_MUTATIONS,
                    ],
                ];
            case self::SCHEMA_POST_MUTATIONS:
                return [
                    [
                        SchemaTypeModuleResolver::SCHEMA_POSTS,
                    ],
                    [
                        self::SCHEMA_CUSTOMPOST_MUTATIONS,
                    ],
                ];
            case self::SCHEMA_MEDIA_MUTATIONS:
                return [
                    [
                        SchemaTypeModuleResolver::SCHEMA_MEDIA,
                    ],
                    [
                        self::SCHEMA_USER_STATE_MUTATIONS,
                    ],
                ];
            case self::SCHEMA_CUSTOMPOSTMEDIA_MUTATIONS:
                return [
                    [
                        SchemaTypeModuleResolver::SCHEMA_MEDIA,
                    ],
                    [
                        self::SCHEMA_CUSTOMPOST_MUTATIONS,
                    ],
                ];
            case self::SCHEMA_PAGEMEDIA_MUTATIONS:
                return [
                    [
                        self::SCHEMA_CUSTOMPOSTMEDIA_MUTATIONS,
                    ],
                    [
                        self::SCHEMA_PAGE_MUTATIONS,
                    ],
                ];
            case self::SCHEMA_POSTMEDIA_MUTATIONS:
                return [
                    [
                        self::SCHEMA_CUSTOMPOSTMEDIA_MUTATIONS,
                    ],
                    [
                        self::SCHEMA_POST_MUTATIONS,
                    ],
                ];
            case self::SCHEMA_CUSTOMPOST_USER_MUTATIONS:
                return [
                    [
                        self::SCHEMA_CUSTOMPOST_MUTATIONS,
                    ],
                ];
            case self::SCHEMA_CUSTOMPOST_TAG_MUTATIONS:
                return [
                    [
                        SchemaTypeModuleResolver::SCHEMA_TAGS,
                    ],
                    [
                        self::SCHEMA_CUSTOMPOST_MUTATIONS,
                    ],
                    [
                        self::SCHEMA_TAG_MUTATIONS,
                    ],
                ];
            case self::SCHEMA_POST_TAG_MUTATIONS:
                return [
                    [
                        SchemaTypeModuleResolver::SCHEMA_POST_TAGS,
                    ],
                    [
                        self::SCHEMA_POST_MUTATIONS,
                    ],
                    [
                        self::SCHEMA_TAG_MUTATIONS,
                    ],
                ];
            case self::SCHEMA_CUSTOMPOST_CATEGORY_MUTATIONS:
                return [
                    [
                        SchemaTypeModuleResolver::SCHEMA_CATEGORIES,
                    ],
                    [
                        self::SCHEMA_CUSTOMPOST_MUTATIONS,
                    ],
                    [
                        self::SCHEMA_CATEGORY_MUTATIONS,
                    ],
                ];
            case self::SCHEMA_POST_CATEGORY_MUTATIONS:
                return [
                    [
                        SchemaTypeModuleResolver::SCHEMA_POST_CATEGORIES,
                    ],
                    [
                        self::SCHEMA_POST_MUTATIONS,
                    ],
                    [
                        self::SCHEMA_CATEGORY_MUTATIONS,
                    ],
                ];
            case self::SCHEMA_COMMENT_MUTATIONS:
                return [
                    [
                        self::SCHEMA_USER_STATE_MUTATIONS,
                    ],
                    [
                        SchemaTypeModuleResolver::SCHEMA_COMMENTS,
                    ],
                ];
        }
        return parent::getDependedModuleLists($module);
    }

    public function getName(string $module): string
    {
        switch ($module) {
            case self::SCHEMA_USER_STATE_MUTATIONS:
                return \__('User State Mutations', 'gatographql');
            case self::SCHEMA_CUSTOMPOST_MUTATIONS:
                return \__('Custom Post Mutations', 'gatographql');
            case self::SCHEMA_PAGE_MUTATIONS:
                return \__('Page Mutations', 'gatographql');
            case self::SCHEMA_POST_MUTATIONS:
                return \__('Post Mutations', 'gatographql');
            case self::SCHEMA_MEDIA_MUTATIONS:
                return \__('Media Mutations', 'gatographql');
            case self::SCHEMA_CUSTOMPOSTMEDIA_MUTATIONS:
                return \__('Custom Post Media Mutations', 'gatographql');
            case self::SCHEMA_PAGEMEDIA_MUTATIONS:
                return \__('Page Media Mutations', 'gatographql');
            case self::SCHEMA_POSTMEDIA_MUTATIONS:
                return \__('Post Media Mutations', 'gatographql');
            case self::SCHEMA_CUSTOMPOST_USER_MUTATIONS:
                return \__('Custom Post User Mutations', 'gatographql');
            case self::SCHEMA_TAG_MUTATIONS:
                return \__('Tag Mutations', 'gatographql');
            case self::SCHEMA_CUSTOMPOST_TAG_MUTATIONS:
                return \__('Custom Post Tag Mutations', 'gatographql');
            case self::SCHEMA_POST_TAG_MUTATIONS:
                return \__('Post Tag Mutations', 'gatographql');
            case self::SCHEMA_CATEGORY_MUTATIONS:
                return \__('Category Mutations', 'gatographql');
            case self::SCHEMA_CUSTOMPOST_CATEGORY_MUTATIONS:
                return \__('Custom Post Category Mutations', 'gatographql');
            case self::SCHEMA_POST_CATEGORY_MUTATIONS:
                return \__('Post Category Mutations', 'gatographql');
            case self::SCHEMA_COMMENT_MUTATIONS:
                return \__('Comment Mutations', 'gatographql');
            default:
                return $module;
        }
    }

    public function getDescription(string $module): string
    {
        switch ($module) {
            case self::SCHEMA_USER_STATE_MUTATIONS:
                return \__('Have the user log-in, and be able to perform mutations', 'gatographql');
            case self::SCHEMA_CUSTOMPOST_MUTATIONS:
                return \__('Base functionality to mutate custom posts', 'gatographql');
            case self::SCHEMA_PAGE_MUTATIONS:
                return \__('Execute mutations on pages', 'gatographql');
            case self::SCHEMA_POST_MUTATIONS:
                return \__('Execute mutations on posts', 'gatographql');
            case self::SCHEMA_MEDIA_MUTATIONS:
                return \__('Execute mutations concerning media items', 'gatographql');
            case self::SCHEMA_CUSTOMPOSTMEDIA_MUTATIONS:
                return \__('Execute mutations concerning media items on custom posts', 'gatographql');
            case self::SCHEMA_PAGEMEDIA_MUTATIONS:
                return \__('Execute mutations concerning media items on pages', 'gatographql');
            case self::SCHEMA_POSTMEDIA_MUTATIONS:
                return \__('Execute mutations concerning media items on posts', 'gatographql');
            case self::SCHEMA_CUSTOMPOST_USER_MUTATIONS:
                return \__('Input user data when creating/updating custom posts', 'gatographql');
            case self::SCHEMA_TAG_MUTATIONS:
                return \__('Add tags', 'gatographql');
            case self::SCHEMA_CUSTOMPOST_TAG_MUTATIONS:
                return \__('Add tags to custom posts', 'gatographql');
            case self::SCHEMA_POST_TAG_MUTATIONS:
                return \__('Add tags to posts', 'gatographql');
            case self::SCHEMA_CATEGORY_MUTATIONS:
                return \__('Add categories', 'gatographql');
            case self::SCHEMA_CUSTOMPOST_CATEGORY_MUTATIONS:
                return \__('Add categories to custom posts', 'gatographql');
            case self::SCHEMA_POST_CATEGORY_MUTATIONS:
                return \__('Add categories to posts', 'gatographql');
            case self::SCHEMA_COMMENT_MUTATIONS:
                return \__('Create comments', 'gatographql');
            default:
                return parent::getDescription($module);
        }
    }

    /**
     * Does the module have HTML Documentation?
     */
    public function hasDocumentation(string $module): bool
    {
        switch ($module) {
            case self::SCHEMA_CUSTOMPOST_MUTATIONS:
            case self::SCHEMA_PAGE_MUTATIONS:
            case self::SCHEMA_POST_MUTATIONS:
            case self::SCHEMA_MEDIA_MUTATIONS:
            case self::SCHEMA_CUSTOMPOSTMEDIA_MUTATIONS:
            case self::SCHEMA_PAGEMEDIA_MUTATIONS:
            case self::SCHEMA_POSTMEDIA_MUTATIONS:
            case self::SCHEMA_CUSTOMPOST_USER_MUTATIONS:
            case self::SCHEMA_TAG_MUTATIONS:
            case self::SCHEMA_CUSTOMPOST_TAG_MUTATIONS:
            case self::SCHEMA_POST_TAG_MUTATIONS:
            case self::SCHEMA_CATEGORY_MUTATIONS:
            case self::SCHEMA_CUSTOMPOST_CATEGORY_MUTATIONS:
            case self::SCHEMA_POST_CATEGORY_MUTATIONS:
            case self::SCHEMA_COMMENT_MUTATIONS:
                return false;
        }
        return $this->upstreamHasDocumentation($module);
    }

    /**
     * Default value for an option set by the module
     * @return mixed
     */
    public function getSettingsDefaultValue(string $module, string $option)
    {
        $defaultValues = [
            self::SCHEMA_CUSTOMPOST_USER_MUTATIONS => [
                self::OPTION_TREAT_AUTHOR_INPUT_IN_CUSTOMPOST_MUTATION_AS_SENSITIVE_DATA => true,
            ],
        ];
        return $defaultValues[$module][$option] ?? null;
    }

    /**
     * Array with the inputs to show as settings for the module
     *
     * @return array<array<string,mixed>> List of settings for the module, each entry is an array with property => value
     */
    public function getSettings(string $module): array
    {
        $moduleSettings = parent::getSettings($module);
        $sensitiveDataTitlePlaceholder = \__('Treat the %s as “sensitive” data', 'gatographql');
        $sensitiveDataDescPlaceholder = \__('If checked, the <strong>%s</strong> is exposed in the schema only if the Schema Configuration has option <code>Expose Sensitive Data in the Schema</code> enabled', 'gatographql');
        if ($module === self::SCHEMA_CUSTOMPOST_USER_MUTATIONS) {
            $option = self::OPTION_TREAT_AUTHOR_INPUT_IN_CUSTOMPOST_MUTATION_AS_SENSITIVE_DATA;
            $moduleSettings[] = [
                Properties::INPUT => $option,
                Properties::NAME => $this->getSettingOptionName(
                    $module,
                    $option
                ),
                Properties::TITLE => sprintf(
                    $sensitiveDataTitlePlaceholder,
                    \__('<code>authorID</code> input (when creating/updating custom posts)', 'gatographql'),
                ),
                Properties::DESCRIPTION => sprintf(
                    $sensitiveDataDescPlaceholder,
                    \__('<code>authorID</code> input (when creating/updating custom posts)', 'gatographql'),
                ),
                Properties::TYPE => Properties::TYPE_BOOL,
            ];
        }

        return $moduleSettings;
    }
}
