<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategories\FieldResolvers\ObjectType;

use PoPCMSSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver;
use PoPCMSSchema\Posts\FieldResolvers\ObjectType\AbstractPostObjectTypeFieldResolver;
use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PostCategoryListObjectTypeFieldResolver extends AbstractPostObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface|null
     */
    private $taxonomyTermTypeAPI;
    public final function setTaxonomyTermTypeAPI(TaxonomyTermTypeAPIInterface $taxonomyTermTypeAPI) : void
    {
        $this->taxonomyTermTypeAPI = $taxonomyTermTypeAPI;
    }
    protected final function getTaxonomyTermTypeAPI() : TaxonomyTermTypeAPIInterface
    {
        if ($this->taxonomyTermTypeAPI === null) {
            /** @var TaxonomyTermTypeAPIInterface */
            $taxonomyTermTypeAPI = $this->instanceManager->getInstance(TaxonomyTermTypeAPIInterface::class);
            $this->taxonomyTermTypeAPI = $taxonomyTermTypeAPI;
        }
        return $this->taxonomyTermTypeAPI;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostCategoryObjectTypeResolver::class];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'posts':
                return $this->__('Posts which contain this category', 'post-categories');
            case 'postCount':
                return $this->__('Number of posts which contain this category', 'post-categories');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,mixed>
     */
    protected function getQuery(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $query = parent::getQuery($objectTypeResolver, $object, $fieldDataAccessor);
        $category = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'posts':
            case 'postCount':
                $query['category-ids'] = [$objectTypeResolver->getID($category)];
                $query['category-taxonomy'] = $this->getTaxonomyTermTypeAPI()->getTermTaxonomyName($category);
                break;
        }
        return $query;
    }
}
