<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\AbstractCustomPostUpdateMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\AbstractRootCreateCustomPostMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostMutations\TypeResolvers\UnionType\AbstractRootUpdateCustomPostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class LoggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\CustomPostMutations\ObjectTypeResolverPickers\AbstractLoggedInUserHasNoPermissionToEditCustomPostErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractRootCreateCustomPostMutationErrorPayloadUnionTypeResolver::class, AbstractRootUpdateCustomPostMutationErrorPayloadUnionTypeResolver::class, AbstractCustomPostUpdateMutationErrorPayloadUnionTypeResolver::class];
    }
}
