<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ConditionalOnModule\CustomPostMutations\SchemaHooks;

use PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\RootCreateMediaItemInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputObjectType\InputObjectTypeResolverInterface;
/** @internal */
class AddCustomPostInputFieldsInputObjectTypeHookSet extends \PoPCMSSchema\MediaMutations\ConditionalOnModule\CustomPostMutations\SchemaHooks\AbstractAddCustomPostInputFieldsInputObjectTypeHookSet
{
    protected function isInputObjectTypeResolver(InputObjectTypeResolverInterface $inputObjectTypeResolver) : bool
    {
        return $inputObjectTypeResolver instanceof RootCreateMediaItemInputObjectTypeResolver;
    }
}
