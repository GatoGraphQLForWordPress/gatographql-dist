<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ObjectModels;

final class DependedOnActiveWordPressPlugin extends AbstractDependedOnWordPressPlugin
{
    /**
     * @readonly
     * @var string|null
     */
    public $versionConstraint;
    public function __construct(string $name, string $file, ?string $versionConstraint = null, ?string $url = null)
    {
        $this->versionConstraint = $versionConstraint;
        parent::__construct($name, $file, $url);
    }
}
