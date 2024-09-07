<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\TagTermUpdateInputObjectTypeResolverTrait;
/** @internal */
class PostTagTermUpdateInputObjectTypeResolver extends \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdatePostTagTermInputObjectTypeResolver implements \PoPCMSSchema\PostTagMutations\TypeResolvers\InputObjectType\UpdatePostTagTermInputObjectTypeResolverInterface
{
    use TagTermUpdateInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'PostTagUpdateInput';
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \false;
    }
}
