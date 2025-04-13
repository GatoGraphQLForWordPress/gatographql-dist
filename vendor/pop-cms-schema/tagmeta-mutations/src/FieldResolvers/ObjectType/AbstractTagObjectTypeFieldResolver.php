<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\TagMetaMutations\Module;
use PoPCMSSchema\TagMetaMutations\ModuleConfiguration;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\AddTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\DeleteTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableAddTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableDeleteTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableSetTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableUpdateTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\SetTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\MutationResolvers\UpdateTagTermMetaMutationResolver;
use PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\TagTermAddMetaInputObjectTypeResolver;
use PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\TagTermDeleteMetaInputObjectTypeResolver;
use PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\TagTermSetMetaInputObjectTypeResolver;
use PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\TagTermUpdateMetaInputObjectTypeResolver;
use PoPCMSSchema\MetaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
abstract class AbstractTagObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\TagTermAddMetaInputObjectTypeResolver|null
     */
    private $tagTermAddMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\TagTermDeleteMetaInputObjectTypeResolver|null
     */
    private $tagTermDeleteMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\TagTermSetMetaInputObjectTypeResolver|null
     */
    private $tagTermSetMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\TypeResolvers\InputObjectType\TagTermUpdateMetaInputObjectTypeResolver|null
     */
    private $tagTermUpdateMetaInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\AddTagTermMetaMutationResolver|null
     */
    private $addTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\DeleteTagTermMetaMutationResolver|null
     */
    private $deleteTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\SetTagTermMetaMutationResolver|null
     */
    private $setTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\UpdateTagTermMetaMutationResolver|null
     */
    private $updateTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableDeleteTagTermMetaMutationResolver|null
     */
    private $payloadableDeleteTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableSetTagTermMetaMutationResolver|null
     */
    private $payloadableSetTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableUpdateTagTermMetaMutationResolver|null
     */
    private $payloadableUpdateTagTermMetaMutationResolver;
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableAddTagTermMetaMutationResolver|null
     */
    private $payloadableAddTagTermMetaMutationResolver;
    protected final function getUserLoggedInCheckpoint() : UserLoggedInCheckpoint
    {
        if ($this->userLoggedInCheckpoint === null) {
            /** @var UserLoggedInCheckpoint */
            $userLoggedInCheckpoint = $this->instanceManager->getInstance(UserLoggedInCheckpoint::class);
            $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
        }
        return $this->userLoggedInCheckpoint;
    }
    protected final function getTagTermAddMetaInputObjectTypeResolver() : TagTermAddMetaInputObjectTypeResolver
    {
        if ($this->tagTermAddMetaInputObjectTypeResolver === null) {
            /** @var TagTermAddMetaInputObjectTypeResolver */
            $tagTermAddMetaInputObjectTypeResolver = $this->instanceManager->getInstance(TagTermAddMetaInputObjectTypeResolver::class);
            $this->tagTermAddMetaInputObjectTypeResolver = $tagTermAddMetaInputObjectTypeResolver;
        }
        return $this->tagTermAddMetaInputObjectTypeResolver;
    }
    protected final function getTagTermDeleteMetaInputObjectTypeResolver() : TagTermDeleteMetaInputObjectTypeResolver
    {
        if ($this->tagTermDeleteMetaInputObjectTypeResolver === null) {
            /** @var TagTermDeleteMetaInputObjectTypeResolver */
            $tagTermDeleteMetaInputObjectTypeResolver = $this->instanceManager->getInstance(TagTermDeleteMetaInputObjectTypeResolver::class);
            $this->tagTermDeleteMetaInputObjectTypeResolver = $tagTermDeleteMetaInputObjectTypeResolver;
        }
        return $this->tagTermDeleteMetaInputObjectTypeResolver;
    }
    protected final function getTagTermSetMetaInputObjectTypeResolver() : TagTermSetMetaInputObjectTypeResolver
    {
        if ($this->tagTermSetMetaInputObjectTypeResolver === null) {
            /** @var TagTermSetMetaInputObjectTypeResolver */
            $tagTermSetMetaInputObjectTypeResolver = $this->instanceManager->getInstance(TagTermSetMetaInputObjectTypeResolver::class);
            $this->tagTermSetMetaInputObjectTypeResolver = $tagTermSetMetaInputObjectTypeResolver;
        }
        return $this->tagTermSetMetaInputObjectTypeResolver;
    }
    protected final function getTagTermUpdateMetaInputObjectTypeResolver() : TagTermUpdateMetaInputObjectTypeResolver
    {
        if ($this->tagTermUpdateMetaInputObjectTypeResolver === null) {
            /** @var TagTermUpdateMetaInputObjectTypeResolver */
            $tagTermUpdateMetaInputObjectTypeResolver = $this->instanceManager->getInstance(TagTermUpdateMetaInputObjectTypeResolver::class);
            $this->tagTermUpdateMetaInputObjectTypeResolver = $tagTermUpdateMetaInputObjectTypeResolver;
        }
        return $this->tagTermUpdateMetaInputObjectTypeResolver;
    }
    protected final function getAddTagTermMetaMutationResolver() : AddTagTermMetaMutationResolver
    {
        if ($this->addTagTermMetaMutationResolver === null) {
            /** @var AddTagTermMetaMutationResolver */
            $addTagTermMetaMutationResolver = $this->instanceManager->getInstance(AddTagTermMetaMutationResolver::class);
            $this->addTagTermMetaMutationResolver = $addTagTermMetaMutationResolver;
        }
        return $this->addTagTermMetaMutationResolver;
    }
    protected final function getDeleteTagTermMetaMutationResolver() : DeleteTagTermMetaMutationResolver
    {
        if ($this->deleteTagTermMetaMutationResolver === null) {
            /** @var DeleteTagTermMetaMutationResolver */
            $deleteTagTermMetaMutationResolver = $this->instanceManager->getInstance(DeleteTagTermMetaMutationResolver::class);
            $this->deleteTagTermMetaMutationResolver = $deleteTagTermMetaMutationResolver;
        }
        return $this->deleteTagTermMetaMutationResolver;
    }
    protected final function getSetTagTermMetaMutationResolver() : SetTagTermMetaMutationResolver
    {
        if ($this->setTagTermMetaMutationResolver === null) {
            /** @var SetTagTermMetaMutationResolver */
            $setTagTermMetaMutationResolver = $this->instanceManager->getInstance(SetTagTermMetaMutationResolver::class);
            $this->setTagTermMetaMutationResolver = $setTagTermMetaMutationResolver;
        }
        return $this->setTagTermMetaMutationResolver;
    }
    protected final function getUpdateTagTermMetaMutationResolver() : UpdateTagTermMetaMutationResolver
    {
        if ($this->updateTagTermMetaMutationResolver === null) {
            /** @var UpdateTagTermMetaMutationResolver */
            $updateTagTermMetaMutationResolver = $this->instanceManager->getInstance(UpdateTagTermMetaMutationResolver::class);
            $this->updateTagTermMetaMutationResolver = $updateTagTermMetaMutationResolver;
        }
        return $this->updateTagTermMetaMutationResolver;
    }
    protected final function getPayloadableDeleteTagTermMetaMutationResolver() : PayloadableDeleteTagTermMetaMutationResolver
    {
        if ($this->payloadableDeleteTagTermMetaMutationResolver === null) {
            /** @var PayloadableDeleteTagTermMetaMutationResolver */
            $payloadableDeleteTagTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableDeleteTagTermMetaMutationResolver::class);
            $this->payloadableDeleteTagTermMetaMutationResolver = $payloadableDeleteTagTermMetaMutationResolver;
        }
        return $this->payloadableDeleteTagTermMetaMutationResolver;
    }
    protected final function getPayloadableSetTagTermMetaMutationResolver() : PayloadableSetTagTermMetaMutationResolver
    {
        if ($this->payloadableSetTagTermMetaMutationResolver === null) {
            /** @var PayloadableSetTagTermMetaMutationResolver */
            $payloadableSetTagTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableSetTagTermMetaMutationResolver::class);
            $this->payloadableSetTagTermMetaMutationResolver = $payloadableSetTagTermMetaMutationResolver;
        }
        return $this->payloadableSetTagTermMetaMutationResolver;
    }
    protected final function getPayloadableUpdateTagTermMetaMutationResolver() : PayloadableUpdateTagTermMetaMutationResolver
    {
        if ($this->payloadableUpdateTagTermMetaMutationResolver === null) {
            /** @var PayloadableUpdateTagTermMetaMutationResolver */
            $payloadableUpdateTagTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableUpdateTagTermMetaMutationResolver::class);
            $this->payloadableUpdateTagTermMetaMutationResolver = $payloadableUpdateTagTermMetaMutationResolver;
        }
        return $this->payloadableUpdateTagTermMetaMutationResolver;
    }
    protected final function getPayloadableAddTagTermMetaMutationResolver() : PayloadableAddTagTermMetaMutationResolver
    {
        if ($this->payloadableAddTagTermMetaMutationResolver === null) {
            /** @var PayloadableAddTagTermMetaMutationResolver */
            $payloadableAddTagTermMetaMutationResolver = $this->instanceManager->getInstance(PayloadableAddTagTermMetaMutationResolver::class);
            $this->payloadableAddTagTermMetaMutationResolver = $payloadableAddTagTermMetaMutationResolver;
        }
        return $this->payloadableAddTagTermMetaMutationResolver;
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['addMeta', 'deleteMeta', 'setMeta', 'updateMeta'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'addMeta':
                return $this->__('Add a tag term meta entry', 'tagmeta-mutations');
            case 'deleteMeta':
                return $this->__('Delete a tag term meta entry', 'tagmeta-mutations');
            case 'setMeta':
                return $this->__('Set meta entries to a a tag term', 'tagmeta-mutations');
            case 'updateMeta':
                return $this->__('Update a tag term meta entry', 'tagmeta-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMetaMutations = $moduleConfiguration->usePayloadableTagMetaMutations();
        if (!$usePayloadableTagMetaMutations) {
            switch ($fieldName) {
                case 'addMeta':
                case 'deleteMeta':
                case 'setMeta':
                case 'updateMeta':
                    return SchemaTypeModifiers::NONE;
                default:
                    return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addMeta':
            case 'deleteMeta':
            case 'setMeta':
            case 'updateMeta':
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
            case 'addMeta':
                return ['input' => $this->getTagTermAddMetaInputObjectTypeResolver()];
            case 'deleteMeta':
                return ['input' => $this->getTagTermDeleteMetaInputObjectTypeResolver()];
            case 'setMeta':
                return ['input' => $this->getTagTermSetMetaInputObjectTypeResolver()];
            case 'updateMeta':
                return ['input' => $this->getTagTermUpdateMetaInputObjectTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['addMeta' => 'input']:
            case ['deleteMeta' => 'input']:
            case ['setMeta' => 'input']:
            case ['updateMeta' => 'input']:
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
            case 'addMeta':
            case 'deleteMeta':
            case 'setMeta':
            case 'updateMeta':
                return \true;
        }
        return parent::validateMutationOnObject($objectTypeResolver, $fieldName);
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
            case 'addMeta':
            case 'deleteMeta':
            case 'setMeta':
            case 'updateMeta':
                $fieldArgsForMutationForObject['input']->{MutationInputProperties::ID} = $objectTypeResolver->getID($tag);
                break;
        }
        return $fieldArgsForMutationForObject;
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableTagMetaMutations = $moduleConfiguration->usePayloadableTagMetaMutations();
        switch ($fieldName) {
            case 'addMeta':
                return $usePayloadableTagMetaMutations ? $this->getPayloadableAddTagTermMetaMutationResolver() : $this->getAddTagTermMetaMutationResolver();
            case 'updateMeta':
                return $usePayloadableTagMetaMutations ? $this->getPayloadableUpdateTagTermMetaMutationResolver() : $this->getUpdateTagTermMetaMutationResolver();
            case 'deleteMeta':
                return $usePayloadableTagMetaMutations ? $this->getPayloadableDeleteTagTermMetaMutationResolver() : $this->getDeleteTagTermMetaMutationResolver();
            case 'setMeta':
                return $usePayloadableTagMetaMutations ? $this->getPayloadableSetTagTermMetaMutationResolver() : $this->getSetTagTermMetaMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
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
        $usePayloadableTagMetaMutations = $moduleConfiguration->usePayloadableTagMetaMutations();
        if ($usePayloadableTagMetaMutations) {
            return $validationCheckpoints;
        }
        switch ($fieldDataAccessor->getFieldName()) {
            case 'addMeta':
            case 'deleteMeta':
            case 'setMeta':
            case 'updateMeta':
                $validationCheckpoints[] = $this->getUserLoggedInCheckpoint();
                break;
        }
        return $validationCheckpoints;
    }
}
