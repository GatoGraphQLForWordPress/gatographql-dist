<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\ObjectModels;

/** @internal */
abstract class AbstractWrappingType implements \GraphQLByPoP\GraphQLServer\ObjectModels\WrappingTypeInterface
{
    public function __construct(protected \GraphQLByPoP\GraphQLServer\ObjectModels\TypeInterface $wrappedType)
    {
    }
    public function getWrappedType() : \GraphQLByPoP\GraphQLServer\ObjectModels\TypeInterface
    {
        return $this->wrappedType;
    }
    public function getWrappedTypeID() : string
    {
        return $this->wrappedType->getID();
    }
    public function getDescription() : ?string
    {
        return null;
    }
}
