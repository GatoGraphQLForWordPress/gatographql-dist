<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\SchemaHooks;

use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\CustomPostObjectTypeResolverInterface;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\GenericCustomPostObjectTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\SchemaHooks\AbstractCustomPostMutationResolverHookSet;
/** @internal */
class GenericCustomPostMutationResolverHookSet extends AbstractCustomPostMutationResolverHookSet
{
    use \PoPCMSSchema\CustomPostMetaMutations\SchemaHooks\GenericCustomPostMutationResolverHookSetTrait;
    private ?GenericCustomPostObjectTypeResolver $genericCustomPostObjectTypeResolver = null;
    protected final function getGenericCustomPostObjectTypeResolver() : GenericCustomPostObjectTypeResolver
    {
        if ($this->genericCustomPostObjectTypeResolver === null) {
            /** @var GenericCustomPostObjectTypeResolver */
            $genericCustomPostObjectTypeResolver = $this->instanceManager->getInstance(GenericCustomPostObjectTypeResolver::class);
            $this->genericCustomPostObjectTypeResolver = $genericCustomPostObjectTypeResolver;
        }
        return $this->genericCustomPostObjectTypeResolver;
    }
    protected function getCustomPostTypeResolver() : CustomPostObjectTypeResolverInterface
    {
        return $this->getGenericCustomPostObjectTypeResolver();
    }
}
