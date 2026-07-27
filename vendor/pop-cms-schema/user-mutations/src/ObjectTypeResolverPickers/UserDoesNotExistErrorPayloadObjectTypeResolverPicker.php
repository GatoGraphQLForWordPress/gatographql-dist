<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\UserMutations\TypeResolvers\UnionType\AbstractUpdateUserMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\UserMutations\TypeResolvers\UnionType\AbstractDeleteUserMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class UserDoesNotExistErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\UserMutations\ObjectTypeResolverPickers\AbstractUserDoesNotExistErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractUpdateUserMutationErrorPayloadUnionTypeResolver::class, AbstractDeleteUserMutationErrorPayloadUnionTypeResolver::class];
    }
}
