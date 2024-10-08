<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\PageMutations\TypeResolvers\UnionType\AbstractPageUpdateMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PageMutations\TypeResolvers\UnionType\AbstractRootCreatePageMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PageMutations\TypeResolvers\UnionType\AbstractRootUpdatePageMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class LoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\PageMutations\ObjectTypeResolverPickers\AbstractLoggedInUserHasNoEditingPageCapabilityErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractPageUpdateMutationErrorPayloadUnionTypeResolver::class, AbstractRootCreatePageMutationErrorPayloadUnionTypeResolver::class, AbstractRootUpdatePageMutationErrorPayloadUnionTypeResolver::class];
    }
}
