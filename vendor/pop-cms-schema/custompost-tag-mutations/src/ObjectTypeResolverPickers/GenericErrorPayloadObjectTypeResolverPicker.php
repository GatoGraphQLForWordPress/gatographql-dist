<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\AbstractGenericTagsMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\GenericTagDeleteMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\GenericTagUpdateMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\RootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractGenericErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericErrorPayloadObjectTypeResolverPicker extends AbstractGenericErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        return [AbstractGenericTagsMutationErrorPayloadUnionTypeResolver::class, RootCreateGenericTagTermMutationErrorPayloadUnionTypeResolver::class, RootDeleteGenericTagTermMutationErrorPayloadUnionTypeResolver::class, RootUpdateGenericTagTermMutationErrorPayloadUnionTypeResolver::class, GenericTagDeleteMutationErrorPayloadUnionTypeResolver::class, GenericTagUpdateMutationErrorPayloadUnionTypeResolver::class];
    }
}