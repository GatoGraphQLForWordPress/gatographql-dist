<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\TagMutations\TypeResolvers\UnionType\AbstractTagMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\UserStateMutations\ObjectTypeResolverPickers\AbstractUserIsNotLoggedInErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class UserIsNotLoggedInMutationErrorPayloadObjectTypeResolverPicker extends AbstractUserIsNotLoggedInErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractTagMutationErrorPayloadUnionTypeResolver::class];
    }
}
