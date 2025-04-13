<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\UserMutations\ObjectModels\UserDoesNotExistErrorPayload;
use PoPCMSSchema\UserMutations\TypeResolvers\ObjectType\UserDoesNotExistErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractUserDoesNotExistErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\UserMutations\TypeResolvers\ObjectType\UserDoesNotExistErrorPayloadObjectTypeResolver|null
     */
    private $userDoesNotExistErrorPayloadObjectTypeResolver;
    protected final function getUserDoesNotExistErrorPayloadObjectTypeResolver() : UserDoesNotExistErrorPayloadObjectTypeResolver
    {
        if ($this->userDoesNotExistErrorPayloadObjectTypeResolver === null) {
            /** @var UserDoesNotExistErrorPayloadObjectTypeResolver */
            $userDoesNotExistErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(UserDoesNotExistErrorPayloadObjectTypeResolver::class);
            $this->userDoesNotExistErrorPayloadObjectTypeResolver = $userDoesNotExistErrorPayloadObjectTypeResolver;
        }
        return $this->userDoesNotExistErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getUserDoesNotExistErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return UserDoesNotExistErrorPayload::class;
    }
}
