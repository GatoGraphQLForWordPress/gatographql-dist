<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ObjectModels;

class ActiveLicenseCommercialExtensionData
{
    /**
     * @readonly
     * @var string
     */
    public $productName;
    /**
     * @readonly
     * @var string
     */
    public $name;
    /**
     * @readonly
     * @var string
     */
    public $slug;
    /**
     * @readonly
     * @var string
     */
    public $baseName;
    /**
     * @readonly
     * @var string
     */
    public $version;
    /**
     * @readonly
     * @var string
     */
    public $changelogURL;
    public function __construct(string $productName, string $name, string $slug, string $baseName, string $version, string $changelogURL)
    {
        $this->productName = $productName;
        $this->name = $name;
        $this->slug = $slug;
        $this->baseName = $baseName;
        $this->version = $version;
        $this->changelogURL = $changelogURL;
    }
}
