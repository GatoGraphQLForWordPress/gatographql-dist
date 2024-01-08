<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ObjectModels;

abstract class AbstractDependedOnWordPressPlugin
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
    public $file;
    /**
     * @readonly
     * @var string
     */
    public $slug;
    /**
     * @readonly
     * @var string
     */
    public $url;

    public function __construct(string $name, string $file, ?string $url = null)
    {
        $this->name = $name;
        $this->file = $file;
        $this->slug = $this->extractSlugFromPluginFile($file);
        $this->url = $this->calculateURL($url, $this->slug);
    }

    protected function extractSlugFromPluginFile(string $pluginFile): string
    {
        $pos = strpos($pluginFile, '/');
        if ($pos === false) {
            return $pluginFile;
        }
        return substr($pluginFile, 0, $pos);
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
            'https://wordpress.org/plugins/%s/',
            $slug
        );
    }
}
