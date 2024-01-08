<?php

declare (strict_types=1);
namespace PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractQueryableInputObjectTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\DateScalarTypeResolver;
use stdClass;
/** @internal */
class DateQueryInputObjectTypeResolver extends AbstractQueryableInputObjectTypeResolver
{
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\DateScalarTypeResolver|null
     */
    private $dateScalarTypeResolver;
    public final function setDateScalarTypeResolver(DateScalarTypeResolver $dateScalarTypeResolver) : void
    {
        $this->dateScalarTypeResolver = $dateScalarTypeResolver;
    }
    protected final function getDateScalarTypeResolver() : DateScalarTypeResolver
    {
        if ($this->dateScalarTypeResolver === null) {
            /** @var DateScalarTypeResolver */
            $dateScalarTypeResolver = $this->instanceManager->getInstance(DateScalarTypeResolver::class);
            $this->dateScalarTypeResolver = $dateScalarTypeResolver;
        }
        return $this->dateScalarTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'DateQueryInput';
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return ['after' => $this->getDateScalarTypeResolver(), 'before' => $this->getDateScalarTypeResolver()];
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'after':
                return $this->__('Retrieve entities from after this date', 'schema-commons');
            case 'before':
                return $this->__('Retrieve entities from before this date', 'schema-commons');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    /**
     * Integrate parameters into the "date_query" WP_Query arg
     *
     * @see https://developer.wordpress.org/reference/classes/wp_query/#date-parameters
     *
     * @param array<string,mixed> $query
     * @param stdClass|stdClass[]|array<stdClass[]> $inputValue
     */
    public function integrateInputValueToFilteringQueryArgs(array &$query, $inputValue) : void
    {
        if (\is_array($inputValue)) {
            parent::integrateInputValueToFilteringQueryArgs($query, $inputValue);
            return;
        }
        if (isset($inputValue->before)) {
            $query['date-to'] = $this->getDateScalarTypeResolver()->serialize($inputValue->before);
        }
        if (isset($inputValue->after)) {
            $query['date-from'] = $this->getDateScalarTypeResolver()->serialize($inputValue->after);
        }
    }
}
