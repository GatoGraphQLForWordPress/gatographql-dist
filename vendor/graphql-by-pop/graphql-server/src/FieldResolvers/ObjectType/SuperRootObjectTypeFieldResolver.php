<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\FieldResolvers\ObjectType;

use GraphQLByPoP\GraphQLServer\ObjectModels\MutationRoot;
use GraphQLByPoP\GraphQLServer\ObjectModels\QueryRoot;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\MutationRootObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\QueryRootObjectTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\ObjectModels\Root;
use PoP\Engine\ObjectModels\SuperRoot;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\Engine\TypeResolvers\ObjectType\SuperRootObjectTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
class SuperRootObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver|null
     */
    private $rootObjectTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\QueryRootObjectTypeResolver|null
     */
    private $queryRootObjectTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\MutationRootObjectTypeResolver|null
     */
    private $mutationRootObjectTypeResolver;
    public final function setRootObjectTypeResolver(RootObjectTypeResolver $rootObjectTypeResolver) : void
    {
        $this->rootObjectTypeResolver = $rootObjectTypeResolver;
    }
    protected final function getRootObjectTypeResolver() : RootObjectTypeResolver
    {
        if ($this->rootObjectTypeResolver === null) {
            /** @var RootObjectTypeResolver */
            $rootObjectTypeResolver = $this->instanceManager->getInstance(RootObjectTypeResolver::class);
            $this->rootObjectTypeResolver = $rootObjectTypeResolver;
        }
        return $this->rootObjectTypeResolver;
    }
    public final function setQueryRootObjectTypeResolver(QueryRootObjectTypeResolver $queryRootObjectTypeResolver) : void
    {
        $this->queryRootObjectTypeResolver = $queryRootObjectTypeResolver;
    }
    protected final function getQueryRootObjectTypeResolver() : QueryRootObjectTypeResolver
    {
        if ($this->queryRootObjectTypeResolver === null) {
            /** @var QueryRootObjectTypeResolver */
            $queryRootObjectTypeResolver = $this->instanceManager->getInstance(QueryRootObjectTypeResolver::class);
            $this->queryRootObjectTypeResolver = $queryRootObjectTypeResolver;
        }
        return $this->queryRootObjectTypeResolver;
    }
    public final function setMutationRootObjectTypeResolver(MutationRootObjectTypeResolver $mutationRootObjectTypeResolver) : void
    {
        $this->mutationRootObjectTypeResolver = $mutationRootObjectTypeResolver;
    }
    protected final function getMutationRootObjectTypeResolver() : MutationRootObjectTypeResolver
    {
        if ($this->mutationRootObjectTypeResolver === null) {
            /** @var MutationRootObjectTypeResolver */
            $mutationRootObjectTypeResolver = $this->instanceManager->getInstance(MutationRootObjectTypeResolver::class);
            $this->mutationRootObjectTypeResolver = $mutationRootObjectTypeResolver;
        }
        return $this->mutationRootObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [SuperRootObjectTypeResolver::class];
    }
    public function getFieldNamesToResolve() : array
    {
        return [
            /**
             * Have 2 fields to retrieve the Root when Nested Mutations
             * are enabled (instead of a single one `_root`) because then
             * we can define Access Control validations on the `query`
             * or `mutation` operation:
             *
             * The corresponding `@validate...` directives will be added
             * to either field `_rootForQueryRoot` or `_rootForMutationRoot`
             * on the SuperRoot object.
             */
            '_rootForQueryRoot',
            '_rootForMutationRoot',
            '_queryRoot',
            '_mutationRoot',
        ];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case '_rootForQueryRoot':
                return $this->__('Get the Root type (as requested by a query operation)', 'engine');
            case '_rootForMutationRoot':
                return $this->__('Get the Root type (as requested by a mutation operation)', 'engine');
            case '_queryRoot':
                return $this->__('Get the Query Root type', 'engine');
            case '_mutationRoot':
                return $this->__('Get the Mutation Root type', 'engine');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case '_rootForQueryRoot':
            case '_rootForMutationRoot':
                return $this->getRootObjectTypeResolver();
            case '_queryRoot':
                return $this->getQueryRootObjectTypeResolver();
            case '_mutationRoot':
                return $this->getMutationRootObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        /** @var SuperRoot */
        $superRoot = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case '_rootForQueryRoot':
            case '_rootForMutationRoot':
                return Root::ID;
            case '_queryRoot':
                return QueryRoot::ID;
            case '_mutationRoot':
                return MutationRoot::ID;
            default:
                return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        }
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
