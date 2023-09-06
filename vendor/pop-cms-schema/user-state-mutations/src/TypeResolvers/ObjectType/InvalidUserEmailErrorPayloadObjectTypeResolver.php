<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\UserStateMutations\RelationalTypeDataLoaders\ObjectType\InvalidUserEmailErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
class InvalidUserEmailErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\UserStateMutations\RelationalTypeDataLoaders\ObjectType\InvalidUserEmailErrorPayloadObjectTypeDataLoader|null
     */
    private $invalidUserEmailErrorPayloadObjectTypeDataLoader;
    public final function setInvalidUserEmailErrorPayloadObjectTypeDataLoader(InvalidUserEmailErrorPayloadObjectTypeDataLoader $invalidUserEmailErrorPayloadObjectTypeDataLoader) : void
    {
        $this->invalidUserEmailErrorPayloadObjectTypeDataLoader = $invalidUserEmailErrorPayloadObjectTypeDataLoader;
    }
    protected final function getInvalidUserEmailErrorPayloadObjectTypeDataLoader() : InvalidUserEmailErrorPayloadObjectTypeDataLoader
    {
        if ($this->invalidUserEmailErrorPayloadObjectTypeDataLoader === null) {
            /** @var InvalidUserEmailErrorPayloadObjectTypeDataLoader */
            $invalidUserEmailErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(InvalidUserEmailErrorPayloadObjectTypeDataLoader::class);
            $this->invalidUserEmailErrorPayloadObjectTypeDataLoader = $invalidUserEmailErrorPayloadObjectTypeDataLoader;
        }
        return $this->invalidUserEmailErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'InvalidUserEmailErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "No user is registered with the provided email"', 'user-state-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getInvalidUserEmailErrorPayloadObjectTypeDataLoader();
    }
}
