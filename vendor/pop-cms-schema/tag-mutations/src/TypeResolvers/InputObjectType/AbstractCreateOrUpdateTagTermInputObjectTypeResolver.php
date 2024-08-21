<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TaxonomyMutations\Constants\MutationInputProperties;
use PoPCMSSchema\TaxonomyMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateTaxonomyTermInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractCreateOrUpdateTagTermInputObjectTypeResolver extends AbstractCreateOrUpdateTaxonomyTermInputObjectTypeResolver implements \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\UpdateTagTermInputObjectTypeResolverInterface, \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\CreateTagTermInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\TagByOneofInputObjectTypeResolver|null
     */
    private $parentTagByOneofInputObjectTypeResolver;
    public final function setTagByOneofInputObjectTypeResolver(\PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\TagByOneofInputObjectTypeResolver $parentTagByOneofInputObjectTypeResolver) : void
    {
        $this->parentTagByOneofInputObjectTypeResolver = $parentTagByOneofInputObjectTypeResolver;
    }
    protected final function getTagByOneofInputObjectTypeResolver() : \PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\TagByOneofInputObjectTypeResolver
    {
        if ($this->parentTagByOneofInputObjectTypeResolver === null) {
            /** @var TagByOneofInputObjectTypeResolver */
            $parentTagByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMutations\TypeResolvers\InputObjectType\TagByOneofInputObjectTypeResolver::class);
            $this->parentTagByOneofInputObjectTypeResolver = $parentTagByOneofInputObjectTypeResolver;
        }
        return $this->parentTagByOneofInputObjectTypeResolver;
    }
    protected function getTaxonomyTermParentInputObjectTypeResolver() : InputTypeResolverInterface
    {
        return $this->getTagByOneofInputObjectTypeResolver();
    }
    protected function addParentIDInputField() : bool
    {
        return \true;
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to create or update a tag term', 'tag-mutations');
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the tag to update', 'tag-mutations');
            case MutationInputProperties::NAME:
                return $this->__('The name of the tag', 'tag-mutations');
            case MutationInputProperties::DESCRIPTION:
                return $this->__('The description of the tag', 'tag-mutations');
            case MutationInputProperties::SLUG:
                return $this->__('The slug of the tag', 'tag-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
