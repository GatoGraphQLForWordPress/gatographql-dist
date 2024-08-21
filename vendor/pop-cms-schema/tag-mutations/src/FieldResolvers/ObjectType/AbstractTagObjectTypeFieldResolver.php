<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\FieldResolvers\ObjectType;

use PoP\ComponentModel\App;
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoPCMSSchema\TagMutations\Module;
use PoPCMSSchema\TagMutations\ModuleConfiguration;
use PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\TagTermUpdateInputObjectTypeResolver;
use PoPCMSSchema\TaxonomyMutations\Constants\MutationInputProperties;
use PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint;
/** @internal */
abstract class AbstractTagObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\TagTermUpdateInputObjectTypeResolver|null
     */
    private $tagTermUpdateInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    public final function setTagTermUpdateInputObjectTypeResolver(TagTermUpdateInputObjectTypeResolver $tagTermUpdateInputObjectTypeResolver) : void
    {
        $this->tagTermUpdateInputObjectTypeResolver = $tagTermUpdateInputObjectTypeResolver;
    }
    protected final function getTagTermUpdateInputObjectTypeResolver() : TagTermUpdateInputObjectTypeResolver
    {
        if ($this->tagTermUpdateInputObjectTypeResolver === null) {
            /** @var TagTermUpdateInputObjectTypeResolver */
            $tagTermUpdateInputObjectTypeResolver = $this->instanceManager->getInstance(TagTermUpdateInputObjectTypeResolver::class);
            $this->tagTermUpdateInputObjectTypeResolver = $tagTermUpdateInputObjectTypeResolver;
        }
        return $this->tagTermUpdateInputObjectTypeResolver;
    }
    public final function setUserLoggedInCheckpoint(UserLoggedInCheckpoint $userLoggedInCheckpoint) : void
    {
        $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
    }
    protected final function getUserLoggedInCheckpoint() : UserLoggedInCheckpoint
    {
        if ($this->userLoggedInCheckpoint === null) {
            /** @var UserLoggedInCheckpoint */
            $userLoggedInCheckpoint = $this->instanceManager->getInstance(UserLoggedInCheckpoint::class);
            $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
        }
        return $this->userLoggedInCheckpoint;
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['update', 'delete'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'update':
                return $this->__('Update the tag', 'tag-mutations');
            case 'delete':
                return $this->__('Delete the tag', 'tag-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        if (!$usePayloadableTagMutations) {
            switch ($fieldName) {
                case 'update':
                case 'delete':
                    return SchemaTypeModifiers::NONE;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'update':
            case 'delete':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'update':
                return ['input' => $this->getTagTermUpdateInputObjectTypeResolver()];
            case 'delete':
                return [];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['update' => 'input']:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * Validated the mutation on the object because the ID
     * is obtained from the same object, so it's not originally
     * present in the field argument in the query
     */
    public function validateMutationOnObject(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : bool
    {
        switch ($fieldName) {
            case 'update':
            case 'delete':
                return \true;
        }
        return parent::validateMutationOnObject($objectTypeResolver, $fieldName);
    }
    /**
     * Because "delete" receives no arguments, it doesn't
     * know it needs to pass the "input" entry to the MutationResolver,
     * so explicitly set it up then.
     */
    public function getFieldArgsInputObjectSubpropertyName(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field) : ?string
    {
        switch ($field->getName()) {
            case 'delete':
                return 'input';
            default:
                return parent::getFieldArgsInputObjectSubpropertyName($objectTypeResolver, $field);
        }
    }
    /**
     * @param array<string,mixed> $fieldArgsForMutationForObject
     * @return array<string,mixed>
     */
    public function prepareFieldArgsForMutationForObject(array $fieldArgsForMutationForObject, ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field, object $object) : array
    {
        $fieldArgsForMutationForObject = parent::prepareFieldArgsForMutationForObject($fieldArgsForMutationForObject, $objectTypeResolver, $field, $object);
        $tag = $object;
        switch ($field->getName()) {
            case 'update':
                $fieldArgsForMutationForObject['input']->{MutationInputProperties::ID} = $objectTypeResolver->getID($tag);
                break;
            case 'delete':
                // This mutation receives no input! Hence create it
                $fieldArgsForMutationForObject['input'] = (object) [MutationInputProperties::ID => $objectTypeResolver->getID($tag)];
                break;
        }
        return $fieldArgsForMutationForObject;
    }
    /**
     * @return CheckpointInterface[]
     */
    public function getValidationCheckpoints(ObjectTypeResolverInterface $objectTypeResolver, FieldDataAccessorInterface $fieldDataAccessor, object $object) : array
    {
        $validationCheckpoints = parent::getValidationCheckpoints($objectTypeResolver, $fieldDataAccessor, $object);
        /**
         * For Payloadable: The "User Logged-in" checkpoint validation is not added,
         * instead this validation is executed inside the mutation, so the error
         * shows up in the Payload
         *
         * @var ModuleConfiguration
         */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMutations = $moduleConfiguration->usePayloadableTagMutations();
        if ($usePayloadableTagMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'update':
            case 'delete':
                $validationCheckpoints[] = $this->getUserLoggedInCheckpoint();
                break;
        }
        return $validationCheckpoints;
    }
}