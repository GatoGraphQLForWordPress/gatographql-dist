<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ModuleResolvers;

use GatoGraphQL\GatoGraphQL\ContentProcessors\MarkdownContentParserInterface;
use GatoGraphQL\GatoGraphQL\Plugin;

/**
 * Deprecated because the GraphiQL Explorer options are not displayed anymore.
 *
 * This module will be removed once GraphiQL v3.0, with the GraphiQL Explorer
 * already integrated, is released.
 *
 * @see https://github.com/GatoGraphQL/GatoGraphQL/issues/1902
 */
class DeprecatedClientFunctionalityModuleResolver extends AbstractFunctionalityModuleResolver
{
    use ModuleResolverTrait;
    use ClientFunctionalityModuleResolverTrait;

    public const GRAPHIQL_EXPLORER = Plugin::NAMESPACE . '\graphiql-explorer';

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
            self::GRAPHIQL_EXPLORER,
        ];
    }

    /**
     * @return array<string[]> List of entries that must be satisfied, each entry is an array where at least 1 module must be satisfied
     */
    public function getDependedModuleLists(string $module): array
    {
        switch ($module) {
            case self::GRAPHIQL_EXPLORER:
                return [];
        }
        return parent::getDependedModuleLists($module);
    }

    public function getName(string $module): string
    {
        switch ($module) {
            case self::GRAPHIQL_EXPLORER:
                return \__('GraphiQL Explorer', 'gatographql');
            default:
                return $module;
        }
    }

    public function getDescription(string $module): string
    {
        switch ($module) {
            case self::GRAPHIQL_EXPLORER:
                return \__('Add the Explorer widget to the GraphiQL client, to simplify coding the query (by point-and-clicking on the fields)', 'gatographql');
            default:
                return parent::getDescription($module);
        }
    }

    /**
     * Because GraphiQL v2.0 (yet to be integrated) has the
     * Explorer already built-in, there's no need to have a
     * separate module for it.
     *
     * Since this functionality is already built and working,
     * simply hide it.
     *
     * @see https://github.com/GatoGraphQL/GatoGraphQL/issues/1902
     */
    public function isHidden(string $module): bool
    {
        switch ($module) {
            case self::GRAPHIQL_EXPLORER:
                return true;
            default:
                return parent::isHidden($module);
        }
    }

    /**
     * Because GraphiQL v2.0 (yet to be integrated) has the
     * Explorer already built-in, there's no need to have a
     * separate module for it.
     *
     * Since this functionality is already built and working,
     * simply hide it.
     *
     * @see https://github.com/GatoGraphQL/GatoGraphQL/issues/1902
     */
    public function areSettingsHidden(string $module): bool
    {
        switch ($module) {
            case self::GRAPHIQL_EXPLORER:
                return true;
            default:
                return parent::areSettingsHidden($module);
        }
    }
}
