<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Loader;

/**
 * DirectoryLoader is a recursive loader to go through directories.
 *
 * @author Sebastien Lavoie <seb@wemakecustom.com>
 * @internal
 */
class DirectoryLoader extends FileLoader
{
    /**
     * @param mixed $file
     * @return mixed
     */
    public function load($file, ?string $type = null)
    {
        $file = \rtrim($file, '/');
        $path = $this->locator->locate($file);
        $this->container->fileExists($path, \false);
        foreach (\scandir($path) as $dir) {
            if ('.' !== $dir[0]) {
                if (\is_dir($path . '/' . $dir)) {
                    $dir .= '/';
                    // append / to allow recursion
                }
                $this->setCurrentDir($path);
                $this->import($dir, null, \false, $path);
            }
        }
        return null;
    }
    /**
     * @param mixed $resource
     */
    public function supports($resource, ?string $type = null) : bool
    {
        if ('directory' === $type) {
            return \true;
        }
        return null === $type && \is_string($resource) && \substr_compare($resource, '/', -\strlen('/')) === 0;
    }
}
