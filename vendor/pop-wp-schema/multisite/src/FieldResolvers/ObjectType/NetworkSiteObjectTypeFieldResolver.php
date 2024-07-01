<?php

declare(strict_types=1);

namespace PoPWPSchema\Multisite\FieldResolvers\ObjectType;

use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver;
use PoPWPSchema\Multisite\TypeResolvers\ObjectType\NetworkSiteObjectTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use WP_Site;

use function get_option;

class NetworkSiteObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver|null
     */
    private $urlScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;

    final public function setStringScalarTypeResolver(StringScalarTypeResolver $stringScalarTypeResolver): void
    {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
    }
    final protected function getStringScalarTypeResolver(): StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    final public function setURLScalarTypeResolver(URLScalarTypeResolver $urlScalarTypeResolver): void
    {
        $this->urlScalarTypeResolver = $urlScalarTypeResolver;
    }
    final protected function getURLScalarTypeResolver(): URLScalarTypeResolver
    {
        if ($this->urlScalarTypeResolver === null) {
            /** @var URLScalarTypeResolver */
            $urlScalarTypeResolver = $this->instanceManager->getInstance(URLScalarTypeResolver::class);
            $this->urlScalarTypeResolver = $urlScalarTypeResolver;
        }
        return $this->urlScalarTypeResolver;
    }
    final public function setIDScalarTypeResolver(IDScalarTypeResolver $idScalarTypeResolver): void
    {
        $this->idScalarTypeResolver = $idScalarTypeResolver;
    }
    final protected function getIDScalarTypeResolver(): IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
    }

    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            NetworkSiteObjectTypeResolver::class,
        ];
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'id',
            'name',
            'url',
            'locale',
            'language',
        ];
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        switch ($fieldName) {
            case 'id':
                return $this->__('Site\'s ID (within the multisite)', 'multisite');
            case 'name':
                return $this->__('Site\'s name', 'multisite');
            case 'url':
                return $this->__('Site\'s URL', 'multisite');
            case 'locale':
                return $this->__('Site\'s locale', 'multisite');
            case 'language':
                return $this->__('Site\'s language', 'multisite');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'id':
                return $this->getIDScalarTypeResolver();
            case 'name':
            case 'locale':
            case 'language':
                return $this->getStringScalarTypeResolver();
            case 'url':
                return $this->getURLScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }

    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): int
    {
        switch ($fieldName) {
            case 'id':
            case 'name':
            case 'url':
            case 'locale':
            case 'language':
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
        /** @var WP_Site */
        $site = $object;
        $siteID = (int) $site->blog_id;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'id':
                return $siteID;

            case 'name':
                return $site->blogname;

            case 'url':
                return $site->siteurl;

            case 'locale':
                return $this->getSiteLocale($siteID);

            case 'language':
                $locale = $this->getSiteLocale($siteID);
                $localeParts = explode('_', $locale);
                return $localeParts[0];
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }

    protected function getSiteLocale(int $siteID): string
    {
        switch_to_blog($siteID);

        /**
         * Calling `get_locale` doesn't work when switching blog,
         * hence reproduce its logic, reading option WPLANG which
         * does work.
         *
         * @see wp-includes/l10n.php
         */
        // $locale = get_locale();
        $locale = get_option('WPLANG');
        if (empty($locale)) {
            $locale = 'en_US';
        }

        restore_current_blog();
        return $locale;
    }

    /**
     * Since the return type is known for all the fields in this
     * FieldResolver, there's no need to validate them
     */
    public function validateResolvedFieldType(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field): bool
    {
        return false;
    }
}
