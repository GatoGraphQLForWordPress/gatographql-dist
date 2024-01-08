<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\FieldResolvers\InterfaceType;

use PoPCMSSchema\Categories\TypeResolvers\InterfaceType\CategoryInterfaceTypeResolver;
use PoPCMSSchema\Taxonomies\FieldResolvers\InterfaceType\AbstractIsTaxonomyInterfaceTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
/** @internal */
class CategoryInterfaceTypeFieldResolver extends AbstractIsTaxonomyInterfaceTypeFieldResolver
{
    /**
     * @return array<class-string<InterfaceTypeResolverInterface>>
     */
    public function getInterfaceTypeResolverClassesToAttachTo() : array
    {
        return [CategoryInterfaceTypeResolver::class];
    }
    public function getFieldDescription(string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'name':
                return $this->__('Category', 'categories');
            case 'description':
                return $this->__('Category description', 'categories');
            case 'count':
                return $this->__('Number of custom posts containing this category', 'categories');
            case 'slugPath':
                return $this->__('Full category slug, from the root ancestor all the way down, separated by \'/\', and not including \'/\' at either end', 'categories');
            default:
                return parent::getFieldDescription($fieldName);
        }
    }
}
