<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\FieldResolvers\InterfaceType;

use PoPCMSSchema\Tags\TypeResolvers\InterfaceType\TagInterfaceTypeResolver;
use PoPCMSSchema\Taxonomies\FieldResolvers\InterfaceType\AbstractIsTaxonomyInterfaceTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
class TagInterfaceTypeFieldResolver extends AbstractIsTaxonomyInterfaceTypeFieldResolver
{
    /**
     * @return array<class-string<InterfaceTypeResolverInterface>>
     */
    public function getInterfaceTypeResolverClassesToAttachTo() : array
    {
        return [TagInterfaceTypeResolver::class];
    }
    public function getFieldDescription(string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'name':
                return $this->__('Tag', 'tags');
            case 'description':
                return $this->__('Tag description', 'tags');
            case 'count':
                return $this->__('Number of custom posts containing this tag', 'tags');
            default:
                return parent::getFieldDescription($fieldName);
        }
    }
}
