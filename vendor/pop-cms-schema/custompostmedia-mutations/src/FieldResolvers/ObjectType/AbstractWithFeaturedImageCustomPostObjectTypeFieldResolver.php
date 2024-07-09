<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMediaMutations\Module;
use PoPCMSSchema\CustomPostMediaMutations\ModuleConfiguration;
use PoPCMSSchema\CustomPostMediaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableRemoveFeaturedImageFromCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableSetFeaturedImageOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\RemoveFeaturedImageFromCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType\CustomPostSetFeaturedImageInputObjectTypeResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\CustomPostRemoveFeaturedImageMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\CustomPostSetFeaturedImageMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\UnionType\CustomPostUnionTypeResolver;
use PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoPCMSSchema\CustomPostMedia\FieldResolvers\ObjectType\MaybeWithFeaturedImageCustomPostObjectTypeFieldResolverTrait;
use PoPCMSSchema\CustomPostMedia\TypeAPIs\CustomPostMediaTypeAPIInterface;
use stdClass;
/** @internal */
abstract class AbstractWithFeaturedImageCustomPostObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use MaybeWithFeaturedImageCustomPostObjectTypeFieldResolverTrait;
    /**
     * @var \PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver|null
     */
    private $mediaObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\UnionType\CustomPostUnionTypeResolver|null
     */
    private $customPostUnionTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostMutationResolver|null
     */
    private $setFeaturedImageOnCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\RemoveFeaturedImageFromCustomPostMutationResolver|null
     */
    private $removeFeaturedImageFromCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\InputObjectType\CustomPostSetFeaturedImageInputObjectTypeResolver|null
     */
    private $customPostSetFeaturedImageInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableSetFeaturedImageOnCustomPostMutationResolver|null
     */
    private $payloadableSetFeaturedImageOnCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableRemoveFeaturedImageFromCustomPostMutationResolver|null
     */
    private $payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\CustomPostSetFeaturedImageMutationPayloadObjectTypeResolver|null
     */
    private $customPostSetFeaturedImageMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\ObjectType\CustomPostRemoveFeaturedImageMutationPayloadObjectTypeResolver|null
     */
    private $customPostRemoveFeaturedImageMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostMedia\TypeAPIs\CustomPostMediaTypeAPIInterface|null
     */
    private $customPostMediaTypeAPI;
    public final function setMediaObjectTypeResolver(MediaObjectTypeResolver $mediaObjectTypeResolver) : void
    {
        $this->mediaObjectTypeResolver = $mediaObjectTypeResolver;
    }
    protected final function getMediaObjectTypeResolver() : MediaObjectTypeResolver
    {
        if ($this->mediaObjectTypeResolver === null) {
            /** @var MediaObjectTypeResolver */
            $mediaObjectTypeResolver = $this->instanceManager->getInstance(MediaObjectTypeResolver::class);
            $this->mediaObjectTypeResolver = $mediaObjectTypeResolver;
        }
        return $this->mediaObjectTypeResolver;
    }
    public final function setCustomPostUnionTypeResolver(CustomPostUnionTypeResolver $customPostUnionTypeResolver) : void
    {
        $this->customPostUnionTypeResolver = $customPostUnionTypeResolver;
    }
    protected final function getCustomPostUnionTypeResolver() : CustomPostUnionTypeResolver
    {
        if ($this->customPostUnionTypeResolver === null) {
            /** @var CustomPostUnionTypeResolver */
            $customPostUnionTypeResolver = $this->instanceManager->getInstance(CustomPostUnionTypeResolver::class);
            $this->customPostUnionTypeResolver = $customPostUnionTypeResolver;
        }
        return $this->customPostUnionTypeResolver;
    }
    public final function setSetFeaturedImageOnCustomPostMutationResolver(SetFeaturedImageOnCustomPostMutationResolver $setFeaturedImageOnCustomPostMutationResolver) : void
    {
        $this->setFeaturedImageOnCustomPostMutationResolver = $setFeaturedImageOnCustomPostMutationResolver;
    }
    protected final function getSetFeaturedImageOnCustomPostMutationResolver() : SetFeaturedImageOnCustomPostMutationResolver
    {
        if ($this->setFeaturedImageOnCustomPostMutationResolver === null) {
            /** @var SetFeaturedImageOnCustomPostMutationResolver */
            $setFeaturedImageOnCustomPostMutationResolver = $this->instanceManager->getInstance(SetFeaturedImageOnCustomPostMutationResolver::class);
            $this->setFeaturedImageOnCustomPostMutationResolver = $setFeaturedImageOnCustomPostMutationResolver;
        }
        return $this->setFeaturedImageOnCustomPostMutationResolver;
    }
    public final function setRemoveFeaturedImageFromCustomPostMutationResolver(RemoveFeaturedImageFromCustomPostMutationResolver $removeFeaturedImageFromCustomPostMutationResolver) : void
    {
        $this->removeFeaturedImageFromCustomPostMutationResolver = $removeFeaturedImageFromCustomPostMutationResolver;
    }
    protected final function getRemoveFeaturedImageFromCustomPostMutationResolver() : RemoveFeaturedImageFromCustomPostMutationResolver
    {
        if ($this->removeFeaturedImageFromCustomPostMutationResolver === null) {
            /** @var RemoveFeaturedImageFromCustomPostMutationResolver */
            $removeFeaturedImageFromCustomPostMutationResolver = $this->instanceManager->getInstance(RemoveFeaturedImageFromCustomPostMutationResolver::class);
            $this->removeFeaturedImageFromCustomPostMutationResolver = $removeFeaturedImageFromCustomPostMutationResolver;
        }
        return $this->removeFeaturedImageFromCustomPostMutationResolver;
    }
    public final function setCustomPostSetFeaturedImageInputObjectTypeResolver(CustomPostSetFeaturedImageInputObjectTypeResolver $customPostSetFeaturedImageInputObjectTypeResolver) : void
    {
        $this->customPostSetFeaturedImageInputObjectTypeResolver = $customPostSetFeaturedImageInputObjectTypeResolver;
    }
    protected final function getCustomPostSetFeaturedImageInputObjectTypeResolver() : CustomPostSetFeaturedImageInputObjectTypeResolver
    {
        if ($this->customPostSetFeaturedImageInputObjectTypeResolver === null) {
            /** @var CustomPostSetFeaturedImageInputObjectTypeResolver */
            $customPostSetFeaturedImageInputObjectTypeResolver = $this->instanceManager->getInstance(CustomPostSetFeaturedImageInputObjectTypeResolver::class);
            $this->customPostSetFeaturedImageInputObjectTypeResolver = $customPostSetFeaturedImageInputObjectTypeResolver;
        }
        return $this->customPostSetFeaturedImageInputObjectTypeResolver;
    }
    public final function setPayloadableSetFeaturedImageOnCustomPostMutationResolver(PayloadableSetFeaturedImageOnCustomPostMutationResolver $payloadableSetFeaturedImageOnCustomPostMutationResolver) : void
    {
        $this->payloadableSetFeaturedImageOnCustomPostMutationResolver = $payloadableSetFeaturedImageOnCustomPostMutationResolver;
    }
    protected final function getPayloadableSetFeaturedImageOnCustomPostMutationResolver() : PayloadableSetFeaturedImageOnCustomPostMutationResolver
    {
        if ($this->payloadableSetFeaturedImageOnCustomPostMutationResolver === null) {
            /** @var PayloadableSetFeaturedImageOnCustomPostMutationResolver */
            $payloadableSetFeaturedImageOnCustomPostMutationResolver = $this->instanceManager->getInstance(PayloadableSetFeaturedImageOnCustomPostMutationResolver::class);
            $this->payloadableSetFeaturedImageOnCustomPostMutationResolver = $payloadableSetFeaturedImageOnCustomPostMutationResolver;
        }
        return $this->payloadableSetFeaturedImageOnCustomPostMutationResolver;
    }
    public final function setPayloadableRemoveFeaturedImageFromCustomPostMutationResolver(PayloadableRemoveFeaturedImageFromCustomPostMutationResolver $payloadableRemoveFeaturedImageFromCustomPostMutationResolver) : void
    {
        $this->payloadableRemoveFeaturedImageFromCustomPostMutationResolver = $payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
    }
    protected final function getPayloadableRemoveFeaturedImageFromCustomPostMutationResolver() : PayloadableRemoveFeaturedImageFromCustomPostMutationResolver
    {
        if ($this->payloadableRemoveFeaturedImageFromCustomPostMutationResolver === null) {
            /** @var PayloadableRemoveFeaturedImageFromCustomPostMutationResolver */
            $payloadableRemoveFeaturedImageFromCustomPostMutationResolver = $this->instanceManager->getInstance(PayloadableRemoveFeaturedImageFromCustomPostMutationResolver::class);
            $this->payloadableRemoveFeaturedImageFromCustomPostMutationResolver = $payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
        }
        return $this->payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
    }
    public final function setCustomPostSetFeaturedImageMutationPayloadObjectTypeResolver(CustomPostSetFeaturedImageMutationPayloadObjectTypeResolver $customPostSetFeaturedImageMutationPayloadObjectTypeResolver) : void
    {
        $this->customPostSetFeaturedImageMutationPayloadObjectTypeResolver = $customPostSetFeaturedImageMutationPayloadObjectTypeResolver;
    }
    protected final function getCustomPostSetFeaturedImageMutationPayloadObjectTypeResolver() : CustomPostSetFeaturedImageMutationPayloadObjectTypeResolver
    {
        if ($this->customPostSetFeaturedImageMutationPayloadObjectTypeResolver === null) {
            /** @var CustomPostSetFeaturedImageMutationPayloadObjectTypeResolver */
            $customPostSetFeaturedImageMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(CustomPostSetFeaturedImageMutationPayloadObjectTypeResolver::class);
            $this->customPostSetFeaturedImageMutationPayloadObjectTypeResolver = $customPostSetFeaturedImageMutationPayloadObjectTypeResolver;
        }
        return $this->customPostSetFeaturedImageMutationPayloadObjectTypeResolver;
    }
    public final function setCustomPostRemoveFeaturedImageMutationPayloadObjectTypeResolver(CustomPostRemoveFeaturedImageMutationPayloadObjectTypeResolver $customPostRemoveFeaturedImageMutationPayloadObjectTypeResolver) : void
    {
        $this->customPostRemoveFeaturedImageMutationPayloadObjectTypeResolver = $customPostRemoveFeaturedImageMutationPayloadObjectTypeResolver;
    }
    protected final function getCustomPostRemoveFeaturedImageMutationPayloadObjectTypeResolver() : CustomPostRemoveFeaturedImageMutationPayloadObjectTypeResolver
    {
        if ($this->customPostRemoveFeaturedImageMutationPayloadObjectTypeResolver === null) {
            /** @var CustomPostRemoveFeaturedImageMutationPayloadObjectTypeResolver */
            $customPostRemoveFeaturedImageMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(CustomPostRemoveFeaturedImageMutationPayloadObjectTypeResolver::class);
            $this->customPostRemoveFeaturedImageMutationPayloadObjectTypeResolver = $customPostRemoveFeaturedImageMutationPayloadObjectTypeResolver;
        }
        return $this->customPostRemoveFeaturedImageMutationPayloadObjectTypeResolver;
    }
    public final function setCustomPostMediaTypeAPI(CustomPostMediaTypeAPIInterface $customPostMediaTypeAPI) : void
    {
        $this->customPostMediaTypeAPI = $customPostMediaTypeAPI;
    }
    protected final function getCustomPostMediaTypeAPI() : CustomPostMediaTypeAPIInterface
    {
        if ($this->customPostMediaTypeAPI === null) {
            /** @var CustomPostMediaTypeAPIInterface */
            $customPostMediaTypeAPI = $this->instanceManager->getInstance(CustomPostMediaTypeAPIInterface::class);
            $this->customPostMediaTypeAPI = $customPostMediaTypeAPI;
        }
        return $this->customPostMediaTypeAPI;
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['setFeaturedImage', 'removeFeaturedImage'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'setFeaturedImage':
                return $this->__('Set the featured image on the custom post', 'custompostmedia-mutations');
            case 'removeFeaturedImage':
                return $this->__('Remove the featured image on the custom post', 'custompostmedia-mutations');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'setFeaturedImage':
            case 'removeFeaturedImage':
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
            case 'setFeaturedImage':
                return ['input' => $this->getCustomPostSetFeaturedImageInputObjectTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['setFeaturedImage' => 'input']:
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
            case 'setFeaturedImage':
            case 'removeFeaturedImage':
                return \true;
            default:
                return parent::validateMutationOnObject($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @param array<string,mixed> $fieldArgsForMutationForObject
     * @return array<string,mixed>
     */
    public function prepareFieldArgsForMutationForObject(array $fieldArgsForMutationForObject, ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field, object $object) : array
    {
        $fieldArgsForMutationForObject = parent::prepareFieldArgsForMutationForObject($fieldArgsForMutationForObject, $objectTypeResolver, $field, $object);
        $customPost = $object;
        switch ($field->getName()) {
            case 'removeFeaturedImage':
                $fieldArgsForMutationForObject['input'] = $fieldArgsForMutationForObject['input'] ?? new stdClass();
                break;
        }
        switch ($field->getName()) {
            case 'setFeaturedImage':
            case 'removeFeaturedImage':
                $fieldArgsForMutationForObject['input']->{MutationInputProperties::CUSTOMPOST_ID} = $objectTypeResolver->getID($customPost);
                break;
        }
        return $fieldArgsForMutationForObject;
    }
    /**
     * Because "removeFeaturedImage" receives no arguments, it doesn't
     * know it needs to pass the "input" entry to the MutationResolver,
     * so explicitly set it up then.
     */
    public function getFieldArgsInputObjectSubpropertyName(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field) : ?string
    {
        switch ($field->getName()) {
            case 'removeFeaturedImage':
                return 'input';
            default:
                return parent::getFieldArgsInputObjectSubpropertyName($objectTypeResolver, $field);
        }
    }
    public function getFieldMutationResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?MutationResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMediaMutations = $moduleConfiguration->usePayloadableCustomPostMediaMutations();
        switch ($fieldName) {
            case 'setFeaturedImage':
                return $usePayloadableCustomPostMediaMutations ? $this->getPayloadableSetFeaturedImageOnCustomPostMutationResolver() : $this->getSetFeaturedImageOnCustomPostMutationResolver();
            case 'removeFeaturedImage':
                return $usePayloadableCustomPostMediaMutations ? $this->getPayloadableRemoveFeaturedImageFromCustomPostMutationResolver() : $this->getRemoveFeaturedImageFromCustomPostMutationResolver();
            default:
                return parent::getFieldMutationResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCustomPostMediaMutations = $moduleConfiguration->usePayloadableCustomPostMediaMutations();
        if ($usePayloadableCustomPostMediaMutations) {
            switch ($fieldName) {
                case 'setFeaturedImage':
                    return $this->getCustomPostSetFeaturedImageMutationPayloadObjectTypeResolver();
                case 'removeFeaturedImage':
                    return $this->getCustomPostRemoveFeaturedImageMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'setFeaturedImage':
            case 'removeFeaturedImage':
                return $this->getCustomPostUnionTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
