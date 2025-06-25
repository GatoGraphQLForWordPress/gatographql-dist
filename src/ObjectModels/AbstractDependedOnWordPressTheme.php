<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ObjectModels;

abstract class AbstractDependedOnWordPressTheme
{
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
     * @var string[]
     * @readonly
     */
    public $alternativeSlugs = [];
    /**
     * @readonly
     * @var string
     */
    public $url;

    /**
     * @param string[] $alternativeSlugs
     */
    public function __construct(string $name, string $slug, array $alternativeSlugs = [], ?string $url = null)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->alternativeSlugs = $alternativeSlugs;
        $this->url = $this->calculateURL($url, $slug);
    }

    /**
     * Passing a `null` URL, it builds the URL pointing to the WP repo.
     * To avoid building this URL, instantiate it with empty string.
     */
    protected function calculateURL(?string $url, string $slug): string
    {
        if ($url !== null) {
            return $url;
        }
        return sprintf(
            'https://wordpress.org/themes/%s/',
            $slug
        );
    }
}
