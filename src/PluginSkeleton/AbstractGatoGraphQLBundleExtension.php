<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\PluginSkeleton;

abstract class AbstractGatoGraphQLBundleExtension extends AbstractBundleExtension
{
    use GatoGraphQLExtensionTrait;

    /**
     * @param string[] $extensionSlugs
     * @return string[]
     */
    protected function getExtensionPluginFilenames(array $extensionSlugs): array
    {
        return array_map(
            function (string $extensionSlug) {
                return 'gatographql-' . $extensionSlug . '/gatographql-' . $extensionSlug . '.php';
            },
            $extensionSlugs
        );
    }
}
