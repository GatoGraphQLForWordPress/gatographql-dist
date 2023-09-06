<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\AbstractSetTagsOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeAPIs\CustomPostTagTypeMutationAPIInterface;
use PoPCMSSchema\PostTagMutations\TypeAPIs\PostTagTypeMutationAPIInterface;
use PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface;
use PoPCMSSchema\Tags\TypeAPIs\TagTypeAPIInterface;
class SetTagsOnPostMutationResolver extends AbstractSetTagsOnCustomPostMutationResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeAPIs\PostTagTypeMutationAPIInterface|null
     */
    private $postCategoryTypeMutationAPIInterface;
    /**
     * @var \PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface|null
     */
    private $postTagTypeAPI;
    public final function setPostTagTypeMutationAPI(PostTagTypeMutationAPIInterface $postCategoryTypeMutationAPIInterface) : void
    {
        $this->postCategoryTypeMutationAPIInterface = $postCategoryTypeMutationAPIInterface;
    }
    protected final function getPostTagTypeMutationAPI() : PostTagTypeMutationAPIInterface
    {
        if ($this->postCategoryTypeMutationAPIInterface === null) {
            /** @var PostTagTypeMutationAPIInterface */
            $postCategoryTypeMutationAPIInterface = $this->instanceManager->getInstance(PostTagTypeMutationAPIInterface::class);
            $this->postCategoryTypeMutationAPIInterface = $postCategoryTypeMutationAPIInterface;
        }
        return $this->postCategoryTypeMutationAPIInterface;
    }
    public final function setPostTagTypeAPI(PostTagTypeAPIInterface $postTagTypeAPI) : void
    {
        $this->postTagTypeAPI = $postTagTypeAPI;
    }
    protected final function getPostTagTypeAPI() : PostTagTypeAPIInterface
    {
        if ($this->postTagTypeAPI === null) {
            /** @var PostTagTypeAPIInterface */
            $postTagTypeAPI = $this->instanceManager->getInstance(PostTagTypeAPIInterface::class);
            $this->postTagTypeAPI = $postTagTypeAPI;
        }
        return $this->postTagTypeAPI;
    }
    protected function getCustomPostTagTypeMutationAPI() : CustomPostTagTypeMutationAPIInterface
    {
        return $this->getPostTagTypeMutationAPI();
    }
    protected function getTagTypeAPI() : TagTypeAPIInterface
    {
        return $this->getPostTagTypeAPI();
    }
    protected function getEntityName() : string
    {
        return $this->__('post', 'post-tag-mutations');
    }
}
