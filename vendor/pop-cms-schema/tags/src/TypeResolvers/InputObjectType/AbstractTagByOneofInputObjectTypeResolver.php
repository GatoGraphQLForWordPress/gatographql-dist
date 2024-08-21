<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\TypeResolvers\InputObjectType;

use PoPCMSSchema\Taxonomies\Constants\InputProperties;
use PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\AbstractTaxonomyByInputObjectTypeResolver;
/** @internal */
abstract class AbstractTagByOneofInputObjectTypeResolver extends AbstractTaxonomyByInputObjectTypeResolver
{
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case InputProperties::ID:
                return $this->__('Query by tag ID', 'tags');
            case InputProperties::SLUG:
                return $this->__('Query by tag slug', 'tags');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    protected function getTypeDescriptionTaxonomyEntity() : string
    {
        return $this->__('a tag', 'tags');
    }
}
