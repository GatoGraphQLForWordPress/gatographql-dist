<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\SchemaHooks;

use PoPCMSSchema\Categories\TypeResolvers\ObjectType\CategoryObjectTypeResolverInterface;
use PoPCMSSchema\Categories\TypeResolvers\ObjectType\GenericCategoryObjectTypeResolver;
use PoPCMSSchema\CustomPostCategoryMutations\SchemaHooks\AbstractCustomPostMutationResolverHookSet;
use PoPCMSSchema\CustomPostMutations\SchemaHooks\GenericCustomPostMutationResolverHookSetTrait;
/** @internal */
class GenericCustomPostMutationResolverHookSet extends AbstractCustomPostMutationResolverHookSet
{
    use GenericCustomPostMutationResolverHookSetTrait;
    private ?GenericCategoryObjectTypeResolver $genericCategoryObjectTypeResolver = null;
    protected final function getGenericCategoryObjectTypeResolver() : GenericCategoryObjectTypeResolver
    {
        if ($this->genericCategoryObjectTypeResolver === null) {
            /** @var GenericCategoryObjectTypeResolver */
            $genericCategoryObjectTypeResolver = $this->instanceManager->getInstance(GenericCategoryObjectTypeResolver::class);
            $this->genericCategoryObjectTypeResolver = $genericCategoryObjectTypeResolver;
        }
        return $this->genericCategoryObjectTypeResolver;
    }
    protected function getCategoryTypeResolver() : CategoryObjectTypeResolverInterface
    {
        return $this->getGenericCategoryObjectTypeResolver();
    }
}
