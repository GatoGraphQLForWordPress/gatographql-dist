<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\RootCreateTagTermInputObjectTypeResolverTrait;
/** @internal */
class RootCreateGenericTagTermInputObjectTypeResolver extends \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateGenericTagTermInputObjectTypeResolver implements \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\InputObjectType\CreateGenericTagTermInputObjectTypeResolverInterface
{
    use RootCreateTagTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootCreateGenericTagInput';
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \true;
    }
}
