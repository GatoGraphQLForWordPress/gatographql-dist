<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTags\FieldResolvers\ObjectType;

use PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver;
use PoPCMSSchema\Posts\FieldResolvers\ObjectType\AbstractPostObjectTypeFieldResolver;
use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PostTagListObjectTypeFieldResolver extends AbstractPostObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface|null
     */
    private $taxonomyTermTypeAPI;
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
        return [PostTagObjectTypeResolver::class];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'posts':
                return $this->__('Posts which contain this tag', 'pop-taxonomies');
            case 'postCount':
                return $this->__('Number of posts which contain this tag', 'pop-taxonomies');
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
            case 'posts':
            case 'postCount':
                $query['tag-ids'] = [$objectTypeResolver->getID($tag)];
                $query['tag-taxonomy'] = $this->getTaxonomyTermTypeAPI()->getTermTaxonomyName($tag);
                break;
        }
        return $query;
    }
}
