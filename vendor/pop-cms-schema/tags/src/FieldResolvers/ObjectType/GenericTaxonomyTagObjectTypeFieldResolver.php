<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\FieldResolvers\ObjectType;

use PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver;
use PoPCMSSchema\Taxonomies\FieldResolvers\ObjectType\AbstractGenericTaxonomyObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericTaxonomyTagObjectTypeFieldResolver extends AbstractGenericTaxonomyObjectTypeFieldResolver
{
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [GenericTagObjectTypeResolver::class];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'taxonomy':
                return $this->__('Tag taxonomy', 'tags');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
}
