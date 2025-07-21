<?php

declare (strict_types=1);
namespace PoPCMSSchema\Media\FieldResolvers\ObjectType;

use DateTime;
use PoPCMSSchema\Media\TypeAPIs\MediaTypeAPIInterface;
use PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\ComponentProcessors\CommonFilterInputContainerComponentProcessor;
use PoPCMSSchema\SchemaCommons\Formatters\DateFormatterInterface;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\DateTimeScalarTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLAbsolutePathScalarTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver;
use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
class MediaObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Media\TypeAPIs\MediaTypeAPIInterface|null
     */
    private $mediaTypeAPI;
    /**
     * @var \PoPCMSSchema\SchemaCommons\Formatters\DateFormatterInterface|null
     */
    private $dateFormatter;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver|null
     */
    private $urlScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\DateTimeScalarTypeResolver|null
     */
    private $dateTimeScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLAbsolutePathScalarTypeResolver|null
     */
    private $urlAbsolutePathScalarTypeResolver;
    protected final function getMediaTypeAPI() : MediaTypeAPIInterface
    {
        if ($this->mediaTypeAPI === null) {
            /** @var MediaTypeAPIInterface */
            $mediaTypeAPI = $this->instanceManager->getInstance(MediaTypeAPIInterface::class);
            $this->mediaTypeAPI = $mediaTypeAPI;
        }
        return $this->mediaTypeAPI;
    }
    protected final function getDateFormatter() : DateFormatterInterface
    {
        if ($this->dateFormatter === null) {
            /** @var DateFormatterInterface */
            $dateFormatter = $this->instanceManager->getInstance(DateFormatterInterface::class);
            $this->dateFormatter = $dateFormatter;
        }
        return $this->dateFormatter;
    }
    protected final function getURLScalarTypeResolver() : URLScalarTypeResolver
    {
        if ($this->urlScalarTypeResolver === null) {
            /** @var URLScalarTypeResolver */
            $urlScalarTypeResolver = $this->instanceManager->getInstance(URLScalarTypeResolver::class);
            $this->urlScalarTypeResolver = $urlScalarTypeResolver;
        }
        return $this->urlScalarTypeResolver;
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
    protected final function getStringScalarTypeResolver() : StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    protected final function getDateTimeScalarTypeResolver() : DateTimeScalarTypeResolver
    {
        if ($this->dateTimeScalarTypeResolver === null) {
            /** @var DateTimeScalarTypeResolver */
            $dateTimeScalarTypeResolver = $this->instanceManager->getInstance(DateTimeScalarTypeResolver::class);
            $this->dateTimeScalarTypeResolver = $dateTimeScalarTypeResolver;
        }
        return $this->dateTimeScalarTypeResolver;
    }
    protected final function getURLAbsolutePathScalarTypeResolver() : URLAbsolutePathScalarTypeResolver
    {
        if ($this->urlAbsolutePathScalarTypeResolver === null) {
            /** @var URLAbsolutePathScalarTypeResolver */
            $urlAbsolutePathScalarTypeResolver = $this->instanceManager->getInstance(URLAbsolutePathScalarTypeResolver::class);
            $this->urlAbsolutePathScalarTypeResolver = $urlAbsolutePathScalarTypeResolver;
        }
        return $this->urlAbsolutePathScalarTypeResolver;
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
        return ['src', 'srcs', 'srcPath', 'srcSet', 'width', 'widths', 'height', 'heights', 'sizes', 'title', 'caption', 'altText', 'description', 'date', 'dateStr', 'modifiedDate', 'modifiedDateStr', 'mimeType'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'src':
                return $this->getURLScalarTypeResolver();
            case 'srcs':
                return $this->getURLScalarTypeResolver();
            case 'srcPath':
                return $this->getURLAbsolutePathScalarTypeResolver();
            case 'srcSet':
                return $this->getStringScalarTypeResolver();
            case 'width':
                return $this->getIntScalarTypeResolver();
            case 'widths':
                return $this->getIntScalarTypeResolver();
            case 'height':
                return $this->getIntScalarTypeResolver();
            case 'heights':
                return $this->getIntScalarTypeResolver();
            case 'sizes':
                return $this->getStringScalarTypeResolver();
            case 'title':
                return $this->getStringScalarTypeResolver();
            case 'caption':
                return $this->getStringScalarTypeResolver();
            case 'altText':
                return $this->getStringScalarTypeResolver();
            case 'description':
                return $this->getStringScalarTypeResolver();
            case 'date':
                return $this->getDateTimeScalarTypeResolver();
            case 'dateStr':
                return $this->getStringScalarTypeResolver();
            case 'modifiedDate':
                return $this->getDateTimeScalarTypeResolver();
            case 'modifiedDateStr':
                return $this->getStringScalarTypeResolver();
            case 'mimeType':
                return $this->getStringScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'src':
            case 'srcPath':
            case 'date':
            case 'dateStr':
            case 'modifiedDate':
            case 'modifiedDateStr':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'srcs':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            case 'widths':
            case 'heights':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'src':
                return $this->__('Media item URL source', 'pop-media');
            case 'srcs':
                return $this->__('Media item URL sources for several sizes (returned in the same order as the sizes)', 'pop-media');
            case 'srcPath':
                return $this->__('Media item URL source path', 'pop-media');
            case 'srcSet':
                return $this->__('Media item URL srcset', 'pop-media');
            case 'width':
                return $this->__('Media item\'s width', 'pop-media');
            case 'widths':
                return $this->__('Media item\'s width for several sizes (returned in the same order as the sizes)', 'pop-media');
            case 'height':
                return $this->__('Media item\'s height', 'pop-media');
            case 'heights':
                return $this->__('Media item\'s height for several sizes (returned in the same order as the sizes)', 'pop-media');
            case 'sizes':
                return $this->__('Media item\'s ‘sizes’ attribute value for an image', 'pop-media');
            case 'title':
                return $this->__('Media item title', 'pop-media');
            case 'caption':
                return $this->__('Media item caption', 'pop-media');
            case 'altText':
                return $this->__('Media item alt text', 'pop-media');
            case 'description':
                return $this->__('Media item description', 'pop-media');
            case 'date':
                return $this->__('Media item\'s published date', 'pop-media');
            case 'dateStr':
                return $this->__('Media item\'s published date, in String format', 'pop-media');
            case 'modifiedDate':
                return $this->__('Media item\'s modified date', 'pop-media');
            case 'modifiedDateStr':
                return $this->__('Media item\'s modified date, in String format', 'pop-media');
            case 'mimeType':
                return $this->__('Media item\'s mime type', 'pop-media');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'src':
            case 'srcPath':
            case 'srcSet':
            case 'width':
            case 'height':
            case 'sizes':
                return ['size' => $this->getStringScalarTypeResolver()];
            case 'srcs':
            case 'widths':
            case 'heights':
                return ['sizes' => $this->getStringScalarTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string
    {
        switch ($fieldArgName) {
            case 'size':
                return $this->__('Size of the image', 'pop-media');
            case 'sizes':
                return $this->__('Sizes of the image', 'pop-media');
            default:
                return parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['srcs' => 'sizes']:
            case ['widths' => 'sizes']:
            case ['heights' => 'sizes']:
                return SchemaTypeModifiers::MANDATORY | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldFilterInputContainerComponent(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?Component
    {
        switch ($fieldName) {
            case 'date':
                return new Component(CommonFilterInputContainerComponentProcessor::class, CommonFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_GMTDATE);
            case 'dateStr':
                return new Component(CommonFilterInputContainerComponentProcessor::class, CommonFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_GMTDATE_AS_STRING);
            case 'modifiedDate':
                return new Component(CommonFilterInputContainerComponentProcessor::class, CommonFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_GMTDATE);
            case 'modifiedDateStr':
                return new Component(CommonFilterInputContainerComponentProcessor::class, CommonFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_GMTDATE_AS_STRING);
            default:
                return parent::getFieldFilterInputContainerComponent($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $media = $object;
        $fieldName = $fieldDataAccessor->getFieldName();
        switch ($fieldName) {
            case 'src':
                // The media item may be an image, or a video or audio.
                // If image, $imgSrc will have a value. Otherwise, get the URL
                $size = $this->obtainImageSizeFromParameters($fieldDataAccessor);
                $imgSrc = $this->getMediaTypeAPI()->getImageSrc($media, $size);
                if ($imgSrc !== null) {
                    return $imgSrc;
                }
                return $this->getMediaTypeAPI()->getMediaItemSrc($media);
            case 'srcs':
                /** @var string[] */
                $sizes = $fieldDataAccessor->getValue('sizes');
                $srcs = [];
                foreach ($sizes as $size) {
                    $imgSrc = $this->getMediaTypeAPI()->getImageSrc($media, $size);
                    if ($imgSrc !== null) {
                        $srcs[] = $imgSrc;
                        continue;
                    }
                    $srcs[] = $this->getMediaTypeAPI()->getMediaItemSrc($media);
                }
                return $srcs;
            case 'srcPath':
                // The media item may be an image, or a video or audio.
                // If image, $imgSrc will have a value. Otherwise, get the URL
                $size = $this->obtainImageSizeFromParameters($fieldDataAccessor);
                $imgSrcPath = $this->getMediaTypeAPI()->getImageSrcPath($media, $size);
                if ($imgSrcPath !== null) {
                    return $imgSrcPath;
                }
                return $this->getMediaTypeAPI()->getMediaItemSrcPath($media);
            case 'width':
            case 'height':
                $size = $this->obtainImageSizeFromParameters($fieldDataAccessor);
                $imageProperties = $this->getMediaTypeAPI()->getImageProperties($media, $size);
                return $imageProperties[$fieldName] ?? null;
            case 'widths':
            case 'heights':
                /** @var string[] */
                $sizes = $fieldDataAccessor->getValue('sizes');
                $properties = [];
                $propertyNames = ['widths' => 'width', 'heights' => 'height'];
                foreach ($sizes as $size) {
                    $imageProperties = $this->getMediaTypeAPI()->getImageProperties($media, $size);
                    $properties[] = $imageProperties[$propertyNames[$fieldName]] ?? null;
                }
                return $properties;
            case 'srcSet':
                $size = $this->obtainImageSizeFromParameters($fieldDataAccessor);
                return $this->getMediaTypeAPI()->getImageSrcSet($media, $size);
            case 'sizes':
                $size = $this->obtainImageSizeFromParameters($fieldDataAccessor);
                return $this->getMediaTypeAPI()->getImageSizes($media, $size);
            case 'title':
                return $this->getMediaTypeAPI()->getTitle($media);
            case 'caption':
                return $this->getMediaTypeAPI()->getCaption($media);
            case 'altText':
                return $this->getMediaTypeAPI()->getAltText($media);
            case 'description':
                return $this->getMediaTypeAPI()->getDescription($media);
            case 'date':
                /** @var string */
                $date = $this->getMediaTypeAPI()->getDate($media, $fieldDataAccessor->getValue('gmt'));
                return new DateTime($date);
            case 'dateStr':
                /** @var string */
                $date = $this->getMediaTypeAPI()->getDate($media, $fieldDataAccessor->getValue('gmt'));
                return $this->getDateFormatter()->format($fieldDataAccessor->getValue('format'), $date);
            case 'modifiedDate':
                /** @var string */
                $modifiedDate = $this->getMediaTypeAPI()->getModified($media, $fieldDataAccessor->getValue('gmt'));
                return new DateTime($modifiedDate);
            case 'modifiedDateStr':
                /** @var string */
                $modifiedDate = $this->getMediaTypeAPI()->getModified($media, $fieldDataAccessor->getValue('gmt'));
                return $this->getDateFormatter()->format($fieldDataAccessor->getValue('format'), $modifiedDate);
            case 'mimeType':
                return $this->getMediaTypeAPI()->getMimeType($media);
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
    protected function obtainImageSizeFromParameters(FieldDataAccessorInterface $fieldDataAccessor) : ?string
    {
        return $fieldDataAccessor->getValue('size');
    }
}
