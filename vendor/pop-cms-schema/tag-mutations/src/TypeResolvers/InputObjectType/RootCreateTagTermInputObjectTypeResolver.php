<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootCreateTagTermInputObjectTypeResolver extends \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateTagTermInputObjectTypeResolver implements \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\CreateTagTermInputObjectTypeResolverInterface
{
    use \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\RootCreateTagTermInputObjectTypeResolverTrait;
    public function getTypeName() : string
    {
        return 'RootCreateTagInput';
    }
}
