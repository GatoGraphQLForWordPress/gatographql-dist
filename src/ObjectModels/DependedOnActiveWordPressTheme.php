<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ObjectModels;

final class DependedOnActiveWordPressTheme extends AbstractDependedOnWordPressTheme
{
    /**
     * @readonly
     * @var string|null
     */
    public $versionConstraint;
    /**
     * @param string[] $alternativeSlugs
     */
    public function __construct(string $name, string $slug, ?string $versionConstraint = null, array $alternativeSlugs = [], ?string $url = null)
    {
        $this->versionConstraint = $versionConstraint;
        parent::__construct(
            $name,
            $slug,
            $alternativeSlugs,
            $url,
        );
    }
}
