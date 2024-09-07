<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\TypeResolvers\EnumType;

/** @internal */
class TagTaxonomyEnumStringScalarTypeResolver extends \PoPCMSSchema\Tags\TypeResolvers\EnumType\AbstractTagTaxonomyEnumStringScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'TagTaxonomyEnumString';
    }
    protected function getRegisteredCustomPostTagTaxonomyNames() : ?array
    {
        return null;
    }
}
