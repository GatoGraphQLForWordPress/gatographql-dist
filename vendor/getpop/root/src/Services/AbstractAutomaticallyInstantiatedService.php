<?php

declare (strict_types=1);
namespace PoP\Root\Services;

/**
 * A service which must always be instantiated,
 * so it's done automatically by the application.
 * Eg: hooks.
 * @internal
 */
abstract class AbstractAutomaticallyInstantiatedService extends \PoP\Root\Services\AbstractBasicService implements \PoP\Root\Services\AutomaticallyInstantiatedServiceInterface
{
    use \PoP\Root\Services\AutomaticallyInstantiatedServiceTrait;
}
