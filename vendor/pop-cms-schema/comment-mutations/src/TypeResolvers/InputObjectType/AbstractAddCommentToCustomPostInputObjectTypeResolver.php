<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\Root\App;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPCMSSchema\CommentMutations\Module;
use PoPCMSSchema\CommentMutations\ModuleConfiguration;
use PoPCMSSchema\CommentMutations\Constants\MutationInputProperties;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\EmailScalarTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver;
/** @internal */
abstract class AbstractAddCommentToCustomPostInputObjectTypeResolver extends AbstractInputObjectTypeResolver implements \PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\AddCommentToCustomPostInputObjectTypeResolverInterface
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\EmailScalarTypeResolver|null
     */
    private $emailScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver|null
     */
    private $urlScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\CommentAsOneofInputObjectTypeResolver|null
     */
    private $commentAsOneofInputObjectTypeResolver;
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
    }
    protected final function getEmailScalarTypeResolver() : EmailScalarTypeResolver
    {
        if ($this->emailScalarTypeResolver === null) {
            /** @var EmailScalarTypeResolver */
            $emailScalarTypeResolver = $this->instanceManager->getInstance(EmailScalarTypeResolver::class);
            $this->emailScalarTypeResolver = $emailScalarTypeResolver;
        }
        return $this->emailScalarTypeResolver;
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
    protected final function getStringScalarTypeResolver() : StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    protected final function getCommentAsOneofInputObjectTypeResolver() : \PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\CommentAsOneofInputObjectTypeResolver
    {
        if ($this->commentAsOneofInputObjectTypeResolver === null) {
            /** @var CommentAsOneofInputObjectTypeResolver */
            $commentAsOneofInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\CommentAsOneofInputObjectTypeResolver::class);
            $this->commentAsOneofInputObjectTypeResolver = $commentAsOneofInputObjectTypeResolver;
        }
        return $this->commentAsOneofInputObjectTypeResolver;
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return \array_merge([MutationInputProperties::COMMENT_AS => $this->getCommentAsOneofInputObjectTypeResolver()], $this->addCustomPostInputField() ? [MutationInputProperties::CUSTOMPOST_ID => $this->getIDScalarTypeResolver()] : [], $this->addParentCommentInputField() ? [MutationInputProperties::PARENT_COMMENT_ID => $this->getIDScalarTypeResolver()] : [], !$moduleConfiguration->mustUserBeLoggedInToAddComment() ? [MutationInputProperties::AUTHOR_NAME => $this->getStringScalarTypeResolver(), MutationInputProperties::AUTHOR_EMAIL => $this->getEmailScalarTypeResolver(), MutationInputProperties::AUTHOR_URL => $this->getURLScalarTypeResolver()] : []);
    }
    protected abstract function addCustomPostInputField() : bool;
    protected abstract function addParentCommentInputField() : bool;
    protected abstract function isParentCommentInputFieldMandatory() : bool;
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::COMMENT_AS:
                return $this->__('The comment to add', 'comment-mutations');
            case MutationInputProperties::PARENT_COMMENT_ID:
                return $this->__('The ID of the parent comment', 'comment-mutations');
            case MutationInputProperties::CUSTOMPOST_ID:
                return $this->__('The ID of the custom post to add a comment to', 'comment-mutations');
            case MutationInputProperties::AUTHOR_NAME:
                return $this->__('The comment author\'s name', 'comment-mutations');
            case MutationInputProperties::AUTHOR_EMAIL:
                return $this->__('The comment author\'s email', 'comment-mutations');
            case MutationInputProperties::AUTHOR_URL:
                return $this->__('The comment author\'s site URL', 'comment-mutations');
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case MutationInputProperties::COMMENT_AS:
                return SchemaTypeModifiers::MANDATORY;
            case MutationInputProperties::PARENT_COMMENT_ID:
                return $this->isParentCommentInputFieldMandatory() ? SchemaTypeModifiers::MANDATORY : SchemaTypeModifiers::NONE;
            case MutationInputProperties::CUSTOMPOST_ID:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
}
