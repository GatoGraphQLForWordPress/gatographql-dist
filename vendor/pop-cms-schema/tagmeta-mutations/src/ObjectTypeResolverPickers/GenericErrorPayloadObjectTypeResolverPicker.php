<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\TagMetaMutations\TypeResolvers\UnionType\AbstractTagMetaMutationErrorPayloadUnionTypeResolver;
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
        return [AbstractTagMetaMutationErrorPayloadUnionTypeResolver::class];
    }
}
