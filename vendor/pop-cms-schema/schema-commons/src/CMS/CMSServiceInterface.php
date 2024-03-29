<?php

declare (strict_types=1);
namespace PoPCMSSchema\SchemaCommons\CMS;

/** @internal */
interface CMSServiceInterface
{
    /**
     * @param mixed $default
     * @return mixed
     */
    public function getOption(string $option, $default = \false);
    public function getHomeURL(string $path = '') : string;
    public function getSiteURL() : string;
}
