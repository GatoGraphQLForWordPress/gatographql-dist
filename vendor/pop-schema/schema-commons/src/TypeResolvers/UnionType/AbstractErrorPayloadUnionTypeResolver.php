<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\TypeResolvers\UnionType;

use PoPSchema\SchemaCommons\TypeResolvers\InterfaceType\ErrorPayloadInterfaceTypeResolver;
use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\UnionType\AbstractUnionTypeResolver;
abstract class AbstractErrorPayloadUnionTypeResolver extends AbstractUnionTypeResolver
{
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\InterfaceType\ErrorPayloadInterfaceTypeResolver|null
     */
    private $errorPayloadInterfaceTypeResolver;
    public final function setErrorPayloadInterfaceTypeResolver(ErrorPayloadInterfaceTypeResolver $errorPayloadInterfaceTypeResolver) : void
    {
        $this->errorPayloadInterfaceTypeResolver = $errorPayloadInterfaceTypeResolver;
    }
    protected final function getErrorPayloadInterfaceTypeResolver() : ErrorPayloadInterfaceTypeResolver
    {
        if ($this->errorPayloadInterfaceTypeResolver === null) {
            /** @var ErrorPayloadInterfaceTypeResolver */
            $errorPayloadInterfaceTypeResolver = $this->instanceManager->getInstance(ErrorPayloadInterfaceTypeResolver::class);
            $this->errorPayloadInterfaceTypeResolver = $errorPayloadInterfaceTypeResolver;
        }
        return $this->errorPayloadInterfaceTypeResolver;
    }
    /**
     * @return InterfaceTypeResolverInterface[]
     */
    public function getUnionTypeInterfaceTypeResolvers() : array
    {
        return [$this->getErrorPayloadInterfaceTypeResolver()];
    }
}
