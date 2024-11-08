<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType;

use GraphQLByPoP\GraphQLServer\Helpers\TypeResolverHelperInterface;
use GraphQLByPoP\GraphQLServer\ObjectModels\MutationRoot;
use GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType\MutationRootObjectTypeDataLoader;
use PoP\ComponentModel\FieldResolvers\InterfaceType\InterfaceTypeFieldResolverInterface;
use PoP\ComponentModel\FieldResolvers\ObjectType\ObjectTypeFieldResolverInterface;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoP\ComponentModel\TypeResolvers\CanonicalTypeNameTypeResolverTrait;
use PoP\ComponentModel\TypeResolvers\ObjectType\RemoveIdentifiableObjectInterfaceObjectTypeResolverTrait;
/** @internal */
class MutationRootObjectTypeResolver extends \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\AbstractUseRootAsSourceForSchemaObjectTypeResolver
{
    use CanonicalTypeNameTypeResolverTrait;
    use RemoveIdentifiableObjectInterfaceObjectTypeResolverTrait;
    /**
     * @var \GraphQLByPoP\GraphQLServer\Helpers\TypeResolverHelperInterface|null
     */
    private $typeResolverHelper;
    /**
     * @var \GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType\MutationRootObjectTypeDataLoader|null
     */
    private $mutationRootObjectTypeDataLoader;
    protected final function getTypeResolverHelper() : TypeResolverHelperInterface
    {
        if ($this->typeResolverHelper === null) {
            /** @var TypeResolverHelperInterface */
            $typeResolverHelper = $this->instanceManager->getInstance(TypeResolverHelperInterface::class);
            $this->typeResolverHelper = $typeResolverHelper;
        }
        return $this->typeResolverHelper;
    }
    protected final function getMutationRootObjectTypeDataLoader() : MutationRootObjectTypeDataLoader
    {
        if ($this->mutationRootObjectTypeDataLoader === null) {
            /** @var MutationRootObjectTypeDataLoader */
            $mutationRootObjectTypeDataLoader = $this->instanceManager->getInstance(MutationRootObjectTypeDataLoader::class);
            $this->mutationRootObjectTypeDataLoader = $mutationRootObjectTypeDataLoader;
        }
        return $this->mutationRootObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'MutationRoot';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Mutation type, starting from which mutations are executed', 'graphql-server');
    }
    /**
     * @return string|int|null
     */
    public function getID(object $object)
    {
        /** @var MutationRoot */
        $mutationRoot = $object;
        return $mutationRoot->getID();
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getMutationRootObjectTypeDataLoader();
    }
    public function isFieldNameConditionSatisfiedForSchema(ObjectTypeFieldResolverInterface $objectTypeFieldResolver, string $fieldName) : bool
    {
        $objectTypeResolverMandatoryFields = $this->getTypeResolverHelper()->getObjectTypeResolverMandatoryFields();
        return \in_array($fieldName, $objectTypeResolverMandatoryFields) || $objectTypeFieldResolver->getFieldMutationResolver($this, $fieldName) !== null;
    }
    /**
     * Remove the IdentifiableObject interface
     *
     * @param InterfaceTypeFieldResolverInterface[] $interfaceTypeFieldResolvers
     * @return InterfaceTypeFieldResolverInterface[]
     */
    protected final function consolidateAllImplementedInterfaceTypeFieldResolvers(array $interfaceTypeFieldResolvers) : array
    {
        return $this->removeIdentifiableObjectInterfaceTypeFieldResolver(parent::consolidateAllImplementedInterfaceTypeFieldResolvers($interfaceTypeFieldResolvers));
    }
}
