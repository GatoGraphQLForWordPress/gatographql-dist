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
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\ObjectType\GenericCategoryObjectTypeResolver|null
     */
    private $genericCategoryObjectTypeResolver;
    public final function setGenericCategoryObjectTypeResolver(GenericCategoryObjectTypeResolver $genericCategoryObjectTypeResolver) : void
    {
        $this->genericCategoryObjectTypeResolver = $genericCategoryObjectTypeResolver;
    }
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
