<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\TypeResolvers\ObjectType;

use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\AbstractObjectTypeResolver;
use PoPCMSSchema\Users\RelationalTypeDataLoaders\ObjectType\UserObjectTypeDataLoader;
use PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface;
/** @internal */
class UserObjectTypeResolver extends AbstractObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface|null
     */
    private $userTypeAPI;
    /**
     * @var \PoPCMSSchema\Users\RelationalTypeDataLoaders\ObjectType\UserObjectTypeDataLoader|null
     */
    private $userObjectTypeDataLoader;
    protected final function getUserTypeAPI() : UserTypeAPIInterface
    {
        if ($this->userTypeAPI === null) {
            /** @var UserTypeAPIInterface */
            $userTypeAPI = $this->instanceManager->getInstance(UserTypeAPIInterface::class);
            $this->userTypeAPI = $userTypeAPI;
        }
        return $this->userTypeAPI;
    }
    protected final function getUserObjectTypeDataLoader() : UserObjectTypeDataLoader
    {
        if ($this->userObjectTypeDataLoader === null) {
            /** @var UserObjectTypeDataLoader */
            $userObjectTypeDataLoader = $this->instanceManager->getInstance(UserObjectTypeDataLoader::class);
            $this->userObjectTypeDataLoader = $userObjectTypeDataLoader;
        }
        return $this->userObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'User';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Representation of a user', 'users');
    }
    /**
     * @return string|int|null
     */
    public function getID(object $object)
    {
        $user = $object;
        return $this->getUserTypeAPI()->getUserID($user);
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getUserObjectTypeDataLoader();
    }
}
