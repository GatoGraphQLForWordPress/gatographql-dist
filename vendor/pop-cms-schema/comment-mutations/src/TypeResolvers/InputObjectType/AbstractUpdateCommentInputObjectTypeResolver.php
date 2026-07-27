<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\CommentMutations\Constants\MutationInputProperties;
use PoPCMSSchema\Comments\TypeResolvers\EnumType\CommentStatusEnumTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\EmailScalarTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
/** @internal */
abstract class AbstractUpdateCommentInputObjectTypeResolver extends AbstractInputObjectTypeResolver implements \PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\UpdateCommentInputObjectTypeResolverInterface
{
    private ?IDScalarTypeResolver $idScalarTypeResolver = null;
    private ?StringScalarTypeResolver $stringScalarTypeResolver = null;
    private ?EmailScalarTypeResolver $emailScalarTypeResolver = null;
    private ?URLScalarTypeResolver $urlScalarTypeResolver = null;
    private ?CommentStatusEnumTypeResolver $commentStatusEnumTypeResolver = null;
    private ?\PoPCMSSchema\CommentMutations\TypeResolvers\InputObjectType\CommentAsOneofInputObjectTypeResolver $commentAsOneofInputObjectTypeResolver = null;
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
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
    protected final function getCommentStatusEnumTypeResolver() : CommentStatusEnumTypeResolver
    {
        if ($this->commentStatusEnumTypeResolver === null) {
            /** @var CommentStatusEnumTypeResolver */
            $commentStatusEnumTypeResolver = $this->instanceManager->getInstance(CommentStatusEnumTypeResolver::class);
            $this->commentStatusEnumTypeResolver = $commentStatusEnumTypeResolver;
        }
        return $this->commentStatusEnumTypeResolver;
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
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to update a comment', 'gatographql');
    }
    /**
     * All input fields are optional: only the provided ones are updated.
     *
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge($this->addIDInputField() ? [MutationInputProperties::ID => $this->getIDScalarTypeResolver()] : [], [MutationInputProperties::COMMENT_AS => $this->getCommentAsOneofInputObjectTypeResolver(), MutationInputProperties::STATUS => $this->getCommentStatusEnumTypeResolver(), MutationInputProperties::AUTHOR_NAME => $this->getStringScalarTypeResolver(), MutationInputProperties::AUTHOR_EMAIL => $this->getEmailScalarTypeResolver(), MutationInputProperties::AUTHOR_URL => $this->getURLScalarTypeResolver()]);
    }
    protected abstract function addIDInputField() : bool;
    /**
     * Do not initialize the "commentAs" oneof input object when it was not
     * provided: an empty oneof input object fails its own validation
     * ("No input value was provided to the oneof input object"), and here
     * providing the content is optional, as only the provided input fields
     * are updated.
     */
    protected function initializeInputFieldInputObjectValue() : bool
    {
        return \false;
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        return match ($inputFieldName) {
            MutationInputProperties::ID => $this->__('The ID of the comment to update', 'gatographql'),
            MutationInputProperties::COMMENT_AS => $this->__('The new content for the comment', 'gatographql'),
            MutationInputProperties::STATUS => $this->__('Moderate the comment: approve it, hold it for moderation, mark it as spam, or send it to the trash', 'gatographql'),
            MutationInputProperties::AUTHOR_NAME => $this->__('The comment author\'s name', 'gatographql'),
            MutationInputProperties::AUTHOR_EMAIL => $this->__('The comment author\'s email', 'gatographql'),
            MutationInputProperties::AUTHOR_URL => $this->__('The comment author\'s site URL', 'gatographql'),
            default => parent::getInputFieldDescription($inputFieldName),
        };
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        return match ($inputFieldName) {
            MutationInputProperties::ID => SchemaTypeModifiers::MANDATORY,
            default => parent::getInputFieldTypeModifiers($inputFieldName),
        };
    }
}
