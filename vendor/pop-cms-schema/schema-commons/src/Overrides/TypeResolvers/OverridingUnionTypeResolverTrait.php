<?php

declare (strict_types=1);
namespace PoPCMSSchema\SchemaCommons\Overrides\TypeResolvers;

/** @internal */
trait OverridingUnionTypeResolverTrait
{
    use \PoPCMSSchema\SchemaCommons\Overrides\TypeResolvers\OverridingTypeResolverTrait;
    use \PoPCMSSchema\SchemaCommons\Overrides\TypeResolvers\SingleCallUnionTypeResolverTrait;
}
