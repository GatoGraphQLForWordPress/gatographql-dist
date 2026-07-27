<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\UserMutations\RelationalTypeDataLoaders\ObjectType\UsernameAlreadyExistsErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class UsernameAlreadyExistsErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    private ?UsernameAlreadyExistsErrorPayloadObjectTypeDataLoader $usernameAlreadyExistsErrorPayloadObjectTypeDataLoader = null;
    protected final function getUsernameAlreadyExistsErrorPayloadObjectTypeDataLoader() : UsernameAlreadyExistsErrorPayloadObjectTypeDataLoader
    {
        if ($this->usernameAlreadyExistsErrorPayloadObjectTypeDataLoader === null) {
            /** @var UsernameAlreadyExistsErrorPayloadObjectTypeDataLoader */
            $usernameAlreadyExistsErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(UsernameAlreadyExistsErrorPayloadObjectTypeDataLoader::class);
            $this->usernameAlreadyExistsErrorPayloadObjectTypeDataLoader = $usernameAlreadyExistsErrorPayloadObjectTypeDataLoader;
        }
        return $this->usernameAlreadyExistsErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'UsernameAlreadyExistsErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The username already exists"', 'gatographql');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getUsernameAlreadyExistsErrorPayloadObjectTypeDataLoader();
    }
}
