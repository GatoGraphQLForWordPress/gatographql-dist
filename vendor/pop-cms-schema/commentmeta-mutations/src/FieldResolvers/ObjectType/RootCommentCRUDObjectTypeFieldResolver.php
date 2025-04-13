<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\FieldResolvers\ObjectType\AbstractRootCommentCRUDObjectTypeFieldResolver;
use PoPCMSSchema\CommentMetaMutations\Module;
use PoPCMSSchema\CommentMetaMutations\ModuleConfiguration;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\RootAddCommentMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\RootDeleteCommentMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\RootSetCommentMetaMutationPayloadObjectTypeResolver;
use PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\RootUpdateCommentMetaMutationPayloadObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\App;
/** @internal */
class RootCommentCRUDObjectTypeFieldResolver extends AbstractRootCommentCRUDObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\Comments\TypeResolvers\ObjectType\CommentObjectTypeResolver|null
     */
    private $commentObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\RootDeleteCommentMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootDeleteCommentMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\RootSetCommentMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootSetCommentMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\RootUpdateCommentMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootUpdateCommentMetaMutationPayloadObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\TypeResolvers\ObjectType\RootAddCommentMetaMutationPayloadObjectTypeResolver|null
     */
    private $rootAddCommentMetaMutationPayloadObjectTypeResolver;
    protected final function getCommentObjectTypeResolver() : CommentObjectTypeResolver
    {
        if ($this->commentObjectTypeResolver === null) {
            /** @var CommentObjectTypeResolver */
            $commentObjectTypeResolver = $this->instanceManager->getInstance(CommentObjectTypeResolver::class);
            $this->commentObjectTypeResolver = $commentObjectTypeResolver;
        }
        return $this->commentObjectTypeResolver;
    }
    protected final function getRootDeleteCommentMetaMutationPayloadObjectTypeResolver() : RootDeleteCommentMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootDeleteCommentMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootDeleteCommentMetaMutationPayloadObjectTypeResolver */
            $rootDeleteCommentMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootDeleteCommentMetaMutationPayloadObjectTypeResolver::class);
            $this->rootDeleteCommentMetaMutationPayloadObjectTypeResolver = $rootDeleteCommentMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootDeleteCommentMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootSetCommentMetaMutationPayloadObjectTypeResolver() : RootSetCommentMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootSetCommentMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootSetCommentMetaMutationPayloadObjectTypeResolver */
            $rootSetCommentMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootSetCommentMetaMutationPayloadObjectTypeResolver::class);
            $this->rootSetCommentMetaMutationPayloadObjectTypeResolver = $rootSetCommentMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootSetCommentMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootUpdateCommentMetaMutationPayloadObjectTypeResolver() : RootUpdateCommentMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootUpdateCommentMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootUpdateCommentMetaMutationPayloadObjectTypeResolver */
            $rootUpdateCommentMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootUpdateCommentMetaMutationPayloadObjectTypeResolver::class);
            $this->rootUpdateCommentMetaMutationPayloadObjectTypeResolver = $rootUpdateCommentMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootUpdateCommentMetaMutationPayloadObjectTypeResolver;
    }
    protected final function getRootAddCommentMetaMutationPayloadObjectTypeResolver() : RootAddCommentMetaMutationPayloadObjectTypeResolver
    {
        if ($this->rootAddCommentMetaMutationPayloadObjectTypeResolver === null) {
            /** @var RootAddCommentMetaMutationPayloadObjectTypeResolver */
            $rootAddCommentMetaMutationPayloadObjectTypeResolver = $this->instanceManager->getInstance(RootAddCommentMetaMutationPayloadObjectTypeResolver::class);
            $this->rootAddCommentMetaMutationPayloadObjectTypeResolver = $rootAddCommentMetaMutationPayloadObjectTypeResolver;
        }
        return $this->rootAddCommentMetaMutationPayloadObjectTypeResolver;
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        $usePayloadableCommentMetaMutations = $moduleConfiguration->usePayloadableCommentMetaMutations();
        if ($usePayloadableCommentMetaMutations) {
            switch ($fieldName) {
                case 'addCommentMeta':
                case 'addCommentMetas':
                case 'addCommentMetaMutationPayloadObjects':
                    return $this->getRootAddCommentMetaMutationPayloadObjectTypeResolver();
                case 'updateCommentMeta':
                case 'updateCommentMetas':
                case 'updateCommentMetaMutationPayloadObjects':
                    return $this->getRootUpdateCommentMetaMutationPayloadObjectTypeResolver();
                case 'deleteCommentMeta':
                case 'deleteCommentMetas':
                case 'deleteCommentMetaMutationPayloadObjects':
                    return $this->getRootDeleteCommentMetaMutationPayloadObjectTypeResolver();
                case 'setCommentMeta':
                case 'setCommentMetas':
                case 'setCommentMetaMutationPayloadObjects':
                    return $this->getRootSetCommentMetaMutationPayloadObjectTypeResolver();
                default:
                    return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
            }
        }
        switch ($fieldName) {
            case 'addCommentMeta':
            case 'addCommentMetas':
            case 'updateCommentMeta':
            case 'updateCommentMetas':
            case 'deleteCommentMeta':
            case 'deleteCommentMetas':
            case 'setCommentMeta':
            case 'setCommentMetas':
                return $this->getCommentObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
