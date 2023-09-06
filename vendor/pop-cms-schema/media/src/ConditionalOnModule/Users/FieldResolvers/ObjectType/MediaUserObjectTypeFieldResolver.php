<?php

declare (strict_types=1);
namespace PoPCMSSchema\Media\ConditionalOnModule\Users\FieldResolvers\ObjectType;

use PoPCMSSchema\Media\ConditionalOnModule\Users\TypeAPIs\UserMediaTypeAPIInterface;
use PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver;
use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
class MediaUserObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Media\ConditionalOnModule\Users\TypeAPIs\UserMediaTypeAPIInterface|null
     */
    private $userMediaTypeAPI;
    /**
     * @var \PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver|null
     */
    private $userObjectTypeResolver;
    public final function setUserMediaTypeAPI(UserMediaTypeAPIInterface $userMediaTypeAPI) : void
    {
        $this->userMediaTypeAPI = $userMediaTypeAPI;
    }
    protected final function getUserMediaTypeAPI() : UserMediaTypeAPIInterface
    {
        if ($this->userMediaTypeAPI === null) {
            /** @var UserMediaTypeAPIInterface */
            $userMediaTypeAPI = $this->instanceManager->getInstance(UserMediaTypeAPIInterface::class);
            $this->userMediaTypeAPI = $userMediaTypeAPI;
        }
        return $this->userMediaTypeAPI;
    }
    public final function setUserObjectTypeResolver(UserObjectTypeResolver $userObjectTypeResolver) : void
    {
        $this->userObjectTypeResolver = $userObjectTypeResolver;
    }
    protected final function getUserObjectTypeResolver() : UserObjectTypeResolver
    {
        if ($this->userObjectTypeResolver === null) {
            /** @var UserObjectTypeResolver */
            $userObjectTypeResolver = $this->instanceManager->getInstance(UserObjectTypeResolver::class);
            $this->userObjectTypeResolver = $userObjectTypeResolver;
        }
        return $this->userObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [MediaObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['author'];
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'author':
                return $this->__('Media element\'s author', 'pop-media');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $media = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'author':
                return $this->getUserMediaTypeAPI()->getMediaAuthorID($media);
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
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'author':
                return $this->getUserObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
