<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\FieldResolvers\ObjectType;

use PoPCMSSchema\QueriedObject\FieldResolvers\InterfaceType\QueryableInterfaceTypeFieldResolver;
use PoPCMSSchema\Tags\FieldResolvers\InterfaceType\TagInterfaceTypeFieldResolver;
use PoPCMSSchema\Tags\ModuleContracts\TagAPIRequestedContractObjectTypeFieldResolverInterface;
use PoPCMSSchema\Tags\TypeAPIs\UniversalTagTypeAPIInterface;
use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\InterfaceType\InterfaceTypeFieldResolverInterface;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
abstract class AbstractTagObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver implements TagAPIRequestedContractObjectTypeFieldResolverInterface
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\QueriedObject\FieldResolvers\InterfaceType\QueryableInterfaceTypeFieldResolver|null
     */
    private $queryableInterfaceTypeFieldResolver;
    /**
     * @var \PoPCMSSchema\Tags\FieldResolvers\InterfaceType\TagInterfaceTypeFieldResolver|null
     */
    private $tagInterfaceTypeFieldResolver;
    /**
     * @var \PoPCMSSchema\Tags\TypeAPIs\UniversalTagTypeAPIInterface|null
     */
    private $universalTagTypeAPI;
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface|null
     */
    private $taxonomyTermTypeAPI;
    public final function setIntScalarTypeResolver(IntScalarTypeResolver $intScalarTypeResolver) : void
    {
        $this->intScalarTypeResolver = $intScalarTypeResolver;
    }
    protected final function getIntScalarTypeResolver() : IntScalarTypeResolver
    {
        if ($this->intScalarTypeResolver === null) {
            /** @var IntScalarTypeResolver */
            $intScalarTypeResolver = $this->instanceManager->getInstance(IntScalarTypeResolver::class);
            $this->intScalarTypeResolver = $intScalarTypeResolver;
        }
        return $this->intScalarTypeResolver;
    }
    public final function setStringScalarTypeResolver(StringScalarTypeResolver $stringScalarTypeResolver) : void
    {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
    }
    protected final function getStringScalarTypeResolver() : StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    public final function setQueryableInterfaceTypeFieldResolver(QueryableInterfaceTypeFieldResolver $queryableInterfaceTypeFieldResolver) : void
    {
        $this->queryableInterfaceTypeFieldResolver = $queryableInterfaceTypeFieldResolver;
    }
    protected final function getQueryableInterfaceTypeFieldResolver() : QueryableInterfaceTypeFieldResolver
    {
        if ($this->queryableInterfaceTypeFieldResolver === null) {
            /** @var QueryableInterfaceTypeFieldResolver */
            $queryableInterfaceTypeFieldResolver = $this->instanceManager->getInstance(QueryableInterfaceTypeFieldResolver::class);
            $this->queryableInterfaceTypeFieldResolver = $queryableInterfaceTypeFieldResolver;
        }
        return $this->queryableInterfaceTypeFieldResolver;
    }
    public final function setTagInterfaceTypeFieldResolver(TagInterfaceTypeFieldResolver $tagInterfaceTypeFieldResolver) : void
    {
        $this->tagInterfaceTypeFieldResolver = $tagInterfaceTypeFieldResolver;
    }
    protected final function getTagInterfaceTypeFieldResolver() : TagInterfaceTypeFieldResolver
    {
        if ($this->tagInterfaceTypeFieldResolver === null) {
            /** @var TagInterfaceTypeFieldResolver */
            $tagInterfaceTypeFieldResolver = $this->instanceManager->getInstance(TagInterfaceTypeFieldResolver::class);
            $this->tagInterfaceTypeFieldResolver = $tagInterfaceTypeFieldResolver;
        }
        return $this->tagInterfaceTypeFieldResolver;
    }
    public final function setUniversalTagTypeAPI(UniversalTagTypeAPIInterface $universalTagTypeAPI) : void
    {
        $this->universalTagTypeAPI = $universalTagTypeAPI;
    }
    protected final function getUniversalTagTypeAPI() : UniversalTagTypeAPIInterface
    {
        if ($this->universalTagTypeAPI === null) {
            /** @var UniversalTagTypeAPIInterface */
            $universalTagTypeAPI = $this->instanceManager->getInstance(UniversalTagTypeAPIInterface::class);
            $this->universalTagTypeAPI = $universalTagTypeAPI;
        }
        return $this->universalTagTypeAPI;
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
    /**
     * @return array<InterfaceTypeFieldResolverInterface>
     */
    public function getImplementedInterfaceTypeFieldResolvers() : array
    {
        return [$this->getQueryableInterfaceTypeFieldResolver(), $this->getTagInterfaceTypeFieldResolver()];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return [
            // Queryable interface
            'url',
            'urlPath',
            'slug',
            // Tag interface
            'name',
            'description',
            'count',
            // Own
            'taxonomy',
        ];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'taxonomy':
                return $this->getTaxonomyFieldTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    protected abstract function getTaxonomyFieldTypeResolver() : ConcreteTypeResolverInterface;
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'url':
                return $this->__('Tag URL', 'pop-tags');
            case 'urlPath':
                return $this->__('Tag URL path', 'pop-tags');
            case 'slug':
                return $this->__('Tag slug', 'pop-tags');
            case 'taxonomy':
                return $this->__('Tag taxonomy', 'pop-tags');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'taxonomy':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $tag = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'taxonomy':
                return $this->getTaxonomyTermTypeAPI()->getTermTaxonomyName($tag);
            case 'url':
                /** @var string */
                return $this->getUniversalTagTypeAPI()->getTagURL($tag);
            case 'urlPath':
                /** @var string */
                return $this->getUniversalTagTypeAPI()->getTagURLPath($tag);
            case 'name':
                /** @var string */
                return $this->getUniversalTagTypeAPI()->getTagName($tag);
            case 'slug':
                /** @var string */
                return $this->getUniversalTagTypeAPI()->getTagSlug($tag);
            case 'description':
                /** @var string */
                return $this->getUniversalTagTypeAPI()->getTagDescription($tag);
            case 'count':
                /** @var int */
                return $this->getUniversalTagTypeAPI()->getTagItemCount($tag);
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * Since the return type is known for all the fields in this
     * FieldResolver, there's no need to validate them
     */
    public function validateResolvedFieldType(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field) : bool
    {
        return \false;
    }
}
