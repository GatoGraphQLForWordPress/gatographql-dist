<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\Session\Storage\Handler;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\Cache\Marshaller\MarshallerInterface;
/**
 * @author Ahmed TAILOULOUTE <ahmed.tailouloute@gmail.com>
 * @internal
 */
class IdentityMarshaller implements MarshallerInterface
{
    public function marshall(array $values, ?array &$failed) : array
    {
        foreach ($values as $key => $value) {
            if (!\is_string($value)) {
                throw new \LogicException(\sprintf('%s accepts only string as data.', __METHOD__));
            }
        }
        return $values;
    }
    public function unmarshall(string $value) : string
    {
        return $value;
    }
}
