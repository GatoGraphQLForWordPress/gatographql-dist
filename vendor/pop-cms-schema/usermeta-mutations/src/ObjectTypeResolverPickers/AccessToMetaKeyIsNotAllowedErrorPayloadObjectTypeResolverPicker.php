<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\AbstractUserMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\MetaMutations\ObjectTypeResolverPickers\AbstractAccessToMetaKeyIsNotAllowedErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class AccessToMetaKeyIsNotAllowedErrorPayloadObjectTypeResolverPicker extends AbstractAccessToMetaKeyIsNotAllowedErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractUserMetaMutationErrorPayloadUnionTypeResolver::class];
    }
}
