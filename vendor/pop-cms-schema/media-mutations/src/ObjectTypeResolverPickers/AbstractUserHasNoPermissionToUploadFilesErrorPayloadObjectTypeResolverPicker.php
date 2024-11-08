<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\MediaMutations\ObjectModels\UserHasNoPermissionToUploadFilesErrorPayload;
use PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\UserHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractUserHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\UserHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver|null
     */
    private $userHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver;
    protected final function getUserHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver() : UserHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver
    {
        if ($this->userHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver === null) {
            /** @var UserHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver */
            $userHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(UserHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver::class);
            $this->userHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver = $userHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver;
        }
        return $this->userHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getUserHasNoPermissionToUploadFilesErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return UserHasNoPermissionToUploadFilesErrorPayload::class;
    }
}
