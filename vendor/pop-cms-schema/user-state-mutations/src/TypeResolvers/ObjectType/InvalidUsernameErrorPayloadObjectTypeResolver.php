<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\UserStateMutations\RelationalTypeDataLoaders\ObjectType\InvalidUsernameErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class InvalidUsernameErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\UserStateMutations\RelationalTypeDataLoaders\ObjectType\InvalidUsernameErrorPayloadObjectTypeDataLoader|null
     */
    private $invalidUsernameErrorPayloadObjectTypeDataLoader;
    public final function setInvalidUsernameErrorPayloadObjectTypeDataLoader(InvalidUsernameErrorPayloadObjectTypeDataLoader $invalidUsernameErrorPayloadObjectTypeDataLoader) : void
    {
        $this->invalidUsernameErrorPayloadObjectTypeDataLoader = $invalidUsernameErrorPayloadObjectTypeDataLoader;
    }
    protected final function getInvalidUsernameErrorPayloadObjectTypeDataLoader() : InvalidUsernameErrorPayloadObjectTypeDataLoader
    {
        if ($this->invalidUsernameErrorPayloadObjectTypeDataLoader === null) {
            /** @var InvalidUsernameErrorPayloadObjectTypeDataLoader */
            $invalidUsernameErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(InvalidUsernameErrorPayloadObjectTypeDataLoader::class);
            $this->invalidUsernameErrorPayloadObjectTypeDataLoader = $invalidUsernameErrorPayloadObjectTypeDataLoader;
        }
        return $this->invalidUsernameErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'InvalidUsernameErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "No user is registered with the provided username"', 'user-state-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getInvalidUsernameErrorPayloadObjectTypeDataLoader();
    }
}
