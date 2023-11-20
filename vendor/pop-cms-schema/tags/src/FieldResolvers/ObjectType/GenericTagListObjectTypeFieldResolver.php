<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPosts\FieldResolvers\ObjectType\AbstractCustomPostListObjectTypeFieldResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\InputObjectType\AbstractCustomPostsFilterInputObjectTypeResolver;
use PoPCMSSchema\Tags\TypeResolvers\ObjectType\GenericTagObjectTypeResolver;
use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface;
use PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\TaxonomyCustomPostsFilterInputObjectTypeResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class GenericTagListObjectTypeFieldResolver extends AbstractCustomPostListObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\TaxonomyCustomPostsFilterInputObjectTypeResolver|null
     */
    private $taxonomyCustomPostsFilterInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface|null
     */
    private $taxonomyTermTypeAPI;
    public final function setTaxonomyCustomPostsFilterInputObjectTypeResolver(TaxonomyCustomPostsFilterInputObjectTypeResolver $taxonomyCustomPostsFilterInputObjectTypeResolver) : void
    {
        $this->taxonomyCustomPostsFilterInputObjectTypeResolver = $taxonomyCustomPostsFilterInputObjectTypeResolver;
    }
    protected final function getTaxonomyCustomPostsFilterInputObjectTypeResolver() : TaxonomyCustomPostsFilterInputObjectTypeResolver
    {
        if ($this->taxonomyCustomPostsFilterInputObjectTypeResolver === null) {
            /** @var TaxonomyCustomPostsFilterInputObjectTypeResolver */
            $taxonomyCustomPostsFilterInputObjectTypeResolver = $this->instanceManager->getInstance(TaxonomyCustomPostsFilterInputObjectTypeResolver::class);
            $this->taxonomyCustomPostsFilterInputObjectTypeResolver = $taxonomyCustomPostsFilterInputObjectTypeResolver;
        }
        return $this->taxonomyCustomPostsFilterInputObjectTypeResolver;
    }
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
    protected function getCustomPostsFilterInputObjectTypeResolver() : AbstractCustomPostsFilterInputObjectTypeResolver
    {
        return $this->getTaxonomyCustomPostsFilterInputObjectTypeResolver();
    }
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
            case 'customPosts':
                return $this->__('Custom posts which contain this tag', 'pop-taxonomies');
            case 'customPostCount':
                return $this->__('Number of custom posts which contain this tag', 'pop-taxonomies');
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
        $tag = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'customPosts':
            case 'customPostCount':
                $query['tag-ids'] = [$objectTypeResolver->getID($tag)];
                $query['tag-taxonomy'] = $this->getTaxonomyTermTypeAPI()->getTermTaxonomyName($tag);
                break;
        }
        return $query;
    }
}
