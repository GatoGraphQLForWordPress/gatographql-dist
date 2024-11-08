<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\MediaMutations\ObjectModels\UserHasNoPermissionToUploadFilesForOtherUsersErrorPayload;
use PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\UserHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractUserHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\UserHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver|null
     */
    private $userHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver;
    protected final function getUserHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver() : UserHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver
    {
        if ($this->userHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver === null) {
            /** @var UserHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver */
            $userHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(UserHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver::class);
            $this->userHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver = $userHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver;
        }
        return $this->userHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getUserHasNoPermissionToUploadFilesForOtherUsersErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return UserHasNoPermissionToUploadFilesForOtherUsersErrorPayload::class;
    }
}
