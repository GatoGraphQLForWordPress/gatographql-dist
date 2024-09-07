<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\PageMutations\TypeResolvers\UnionType\AbstractPageUpdateMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PageMutations\TypeResolvers\UnionType\AbstractRootCreatePageMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PageMutations\TypeResolvers\UnionType\AbstractRootUpdatePageMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class LoggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\PageMutations\ObjectTypeResolverPickers\AbstractLoggedInUserHasNoPublishingPageCapabilityErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractPageUpdateMutationErrorPayloadUnionTypeResolver::class, AbstractRootCreatePageMutationErrorPayloadUnionTypeResolver::class, AbstractRootUpdatePageMutationErrorPayloadUnionTypeResolver::class];
    }
}
