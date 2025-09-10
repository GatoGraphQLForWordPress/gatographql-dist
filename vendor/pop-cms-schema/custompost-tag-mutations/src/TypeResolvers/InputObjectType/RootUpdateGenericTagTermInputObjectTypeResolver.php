<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\RootUpdateTagTermInputObjectTypeResolverTrait;
/** @internal */
class RootUpdateGenericTagTermInputObjectTypeResolver extends \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateGenericTagTermInputObjectTypeResolver implements \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\UpdateGenericTagTermInputObjectTypeResolverInterface
{
    use RootUpdateTagTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootUpdateGenericTagInput';
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \false;
    }
}
