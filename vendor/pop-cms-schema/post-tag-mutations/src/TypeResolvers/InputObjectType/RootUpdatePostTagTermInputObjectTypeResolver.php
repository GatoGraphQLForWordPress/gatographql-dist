<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\RootUpdateTagTermInputObjectTypeResolverTrait;
/** @internal */
class RootUpdatePostTagTermInputObjectTypeResolver extends \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdatePostTagTermInputObjectTypeResolver implements \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\UpdatePostTagTermInputObjectTypeResolverInterface
{
    use RootUpdateTagTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootUpdatePostTagInput';
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \false;
    }
}
