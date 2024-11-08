<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CommentMutations\Constants\MutationInputProperties;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\HTMLScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractOneofInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/**
 * @todo In addition to "html", support additional oneof properties for the mutation (eg: provide "blocks" for Gutenberg)
 * @internal
 */
class CommentAsOneofInputObjectTypeResolver extends AbstractOneofInputObjectTypeResolver
{
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\HTMLScalarTypeResolver|null
     */
    private $htmlScalarTypeResolver;
    protected final function getHTMLScalarTypeResolver() : HTMLScalarTypeResolver
    {
        if ($this->htmlScalarTypeResolver === null) {
            /** @var HTMLScalarTypeResolver */
            $htmlScalarTypeResolver = $this->instanceManager->getInstance(HTMLScalarTypeResolver::class);
            $this->htmlScalarTypeResolver = $htmlScalarTypeResolver;
        }
        return $this->htmlScalarTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'CommentContentInput';
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return [MutationInputProperties::HTML => $this->getHTMLScalarTypeResolver()];
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::HTML:
                return $this->__('Use HTML as content for the comment', 'comment-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
}
