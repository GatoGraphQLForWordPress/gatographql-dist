<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\UserMutations\ObjectModels\LoggedInUserHasNoPermissionToEditUserErrorPayload;
use PoPCMSSchema\UserMutations\TypeResolvers\ObjectType\LoggedInUserHasNoPermissionToEditUserErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractLoggedInUserHasNoPermissionToEditUserErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    private ?LoggedInUserHasNoPermissionToEditUserErrorPayloadObjectTypeResolver $loggedInUserHasNoPermissionToEditUser = null;
    protected final function getLoggedInUserHasNoPermissionToEditUserErrorPayloadObjectTypeResolver() : LoggedInUserHasNoPermissionToEditUserErrorPayloadObjectTypeResolver
    {
        if ($this->loggedInUserHasNoPermissionToEditUser === null) {
            /** @var LoggedInUserHasNoPermissionToEditUserErrorPayloadObjectTypeResolver */
            $loggedInUserHasNoPermissionToEditUser = $this->instanceManager->getInstance(LoggedInUserHasNoPermissionToEditUserErrorPayloadObjectTypeResolver::class);
            $this->loggedInUserHasNoPermissionToEditUser = $loggedInUserHasNoPermissionToEditUser;
        }
        return $this->loggedInUserHasNoPermissionToEditUser;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getLoggedInUserHasNoPermissionToEditUserErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return LoggedInUserHasNoPermissionToEditUserErrorPayload::class;
    }
}
