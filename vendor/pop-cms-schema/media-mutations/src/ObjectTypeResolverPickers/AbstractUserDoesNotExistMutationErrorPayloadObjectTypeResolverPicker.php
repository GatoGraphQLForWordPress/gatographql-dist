<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\MediaMutations\ObjectModels\UserDoesNotExistErrorPayload;
use PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\UserDoesNotExistErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractUserDoesNotExistMutationErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\UserDoesNotExistErrorPayloadObjectTypeResolver|null
     */
    private $userDoesNotExistErrorPayloadObjectTypeResolver;
    public final function setUserDoesNotExistErrorPayloadObjectTypeResolver(UserDoesNotExistErrorPayloadObjectTypeResolver $userDoesNotExistErrorPayloadObjectTypeResolver) : void
    {
        $this->userDoesNotExistErrorPayloadObjectTypeResolver = $userDoesNotExistErrorPayloadObjectTypeResolver;
    }
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
