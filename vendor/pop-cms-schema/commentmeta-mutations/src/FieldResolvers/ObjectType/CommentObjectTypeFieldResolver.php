<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CommentMetaMutations\FieldResolvers\ObjectType\AbstractCommentObjectTypeFieldResolver;
use PoPCMSSchema\CommentMetaMutations\Module as CommentMetaMutationsModule;
use PoPCMSSchema\CommentMetaMutations\ModuleConfiguration as CommentMetaMutationsModuleConfiguration;
use PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\CommentAddMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\CommentDeleteMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\CommentSetMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\CommentUpdateMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class CommentObjectTypeFieldResolver extends AbstractCommentObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver|null
     */
    private $commentObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\CommentDeleteMetaMutationPayloadObjectTypeResolver|null
     */
    private $commentDeleteMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\CommentAddMetaMutationPayloadObjectTypeResolver|null
     */
    private $commentCreateMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\CommentUpdateMetaMutationPayloadObjectTypeResolver|null
     */
    private $commentUpdateMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\CommentSetMetaMutationPayloadObjectTypeResolver|null
     */
    private $commentSetMetaMutationPayloadObjectTypeResolver;
    protected final function getCommentObjectTypeResolver() : CommentObjectTypeResolver
    {
        if ($this->commentObjectTypeResolver === null) {
            /** @var CommentObjectTypeResolver */
            $commentObjectTypeResolver = $this->instanceManager->getInstance(CommentObjectTypeResolver::class);
            $this->commentObjectTypeResolver = $commentObjectTypeResolver;
        }
        return $this->commentObjectTypeResolver;
    }
    protected final function getCommentDeleteMetaMutationPayloadObjectTypeResolver() : CommentDeleteMetaMutationPayloadObjectTypeResolver
    {
        if ($this->commentDeleteMetaMutationPayloadObjectTypeResolver === null) {
            /** @var CommentDeleteMetaMutationPayloadObjectTypeResolver */
            $commentDeleteMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(CommentDeleteMetaMutationPayloadObjectTypeResolver::class);
            $this->commentDeleteMetaMutationPayloadObjectTypeResolver = $commentDeleteMetaMutationPayloadObjectTypeResolver;
        }
        return $this->commentDeleteMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getCommentAddMetaMutationPayloadObjectTypeResolver() : CommentAddMetaMutationPayloadObjectTypeResolver
    {
        if ($this->commentCreateMutationPayloadObjectTypeResolver === null) {
            /** @var CommentAddMetaMutationPayloadObjectTypeResolver */
            $commentCreateMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(CommentAddMetaMutationPayloadObjectTypeResolver::class);
            $this->commentCreateMutationPayloadObjectTypeResolver = $commentCreateMutationPayloadObjectTypeResolver;
        }
        return $this->commentCreateMutationPayloadObjectTypeResolver;
    }
    protected final function getCommentUpdateMetaMutationPayloadObjectTypeResolver() : CommentUpdateMetaMutationPayloadObjectTypeResolver
    {
        if ($this->commentUpdateMetaMutationPayloadObjectTypeResolver === null) {
            /** @var CommentUpdateMetaMutationPayloadObjectTypeResolver */
            $commentUpdateMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(CommentUpdateMetaMutationPayloadObjectTypeResolver::class);
            $this->commentUpdateMetaMutationPayloadObjectTypeResolver = $commentUpdateMetaMutationPayloadObjectTypeResolver;
        }
        return $this->commentUpdateMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getCommentSetMetaMutationPayloadObjectTypeResolver() : CommentSetMetaMutationPayloadObjectTypeResolver
    {
        if ($this->commentSetMetaMutationPayloadObjectTypeResolver === null) {
            /** @var CommentSetMetaMutationPayloadObjectTypeResolver */
            $commentSetMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(CommentSetMetaMutationPayloadObjectTypeResolver::class);
            $this->commentSetMetaMutationPayloadObjectTypeResolver = $commentSetMetaMutationPayloadObjectTypeResolver;
        }
        return $this->commentSetMetaMutationPayloadObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [CommentObjectTypeResolver::class];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var CommentMetaMutationsModuleConfiguration */
        $moduleConfiguration = App::getModule(CommentMetaMutationsModule::class)->getConfiguration();
        $usePayloadableCommentMetaMutations = $moduleConfiguration->usePayloadableCommentMetaMutations();
        if (!$usePayloadableCommentMetaMutations) {
            switch ($fieldName) {
                case 'addMeta':
                case 'deleteMeta':
                case 'setMeta':
                case 'updateMeta':
                    return $this->getCommentObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addMeta':
                return $this->getCommentAddMetaMutationPayloadObjectTypeResolver();
            case 'deleteMeta':
                return $this->getCommentDeleteMetaMutationPayloadObjectTypeResolver();
            case 'setMeta':
                return $this->getCommentSetMetaMutationPayloadObjectTypeResolver();
            case 'updateMeta':
                return $this->getCommentUpdateMetaMutationPayloadObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
