<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\TagTermUpdateInputObjectTypeResolverTrait;
/** @internal */
class GenericTagTermUpdateInputObjectTypeResolver extends \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateGenericTagTermInputObjectTypeResolver implements \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\UpdateGenericTagTermInputObjectTypeResolverInterface
{
    use TagTermUpdateInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'GenericTagUpdateInput';
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \false;
    }
}
