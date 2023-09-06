<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\Hooks;

use PoPCMSSchema\CustomPostTagMutations\Hooks\AbstractMutationResolverHookSet;
use PoPCMSSchema\CustomPostTagMutations\TypeAPIs\CustomPostTagTypeMutationAPIInterface;
use PoPCMSSchema\PostTagMutations\TypeAPIs\PostTagTypeMutationAPIInterface;
use PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface;
use PoPCMSSchema\Posts\TypeAPIs\PostTypeAPIInterface;
use PoPCMSSchema\Tags\TypeAPIs\TagTypeAPIInterface;
class MutationResolverHookSet extends AbstractMutationResolverHookSet
{
    /**
     * @var \PoPCMSSchema\Posts\TypeAPIs\PostTypeAPIInterface|null
     */
    private $postTypeAPI;
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeAPIs\PostTagTypeMutationAPIInterface|null
     */
    private $postTagTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface|null
     */
    private $postTagTypeAPI;
    public final function setPostTypeAPI(PostTypeAPIInterface $postTypeAPI) : void
    {
        $this->postTypeAPI = $postTypeAPI;
    }
    protected final function getPostTypeAPI() : PostTypeAPIInterface
    {
        if ($this->postTypeAPI === null) {
            /** @var PostTypeAPIInterface */
            $postTypeAPI = $this->instanceManager->getInstance(PostTypeAPIInterface::class);
            $this->postTypeAPI = $postTypeAPI;
        }
        return $this->postTypeAPI;
    }
    public final function setPostTagTypeMutationAPI(PostTagTypeMutationAPIInterface $postTagTypeMutationAPI) : void
    {
        $this->postTagTypeMutationAPI = $postTagTypeMutationAPI;
    }
    protected final function getPostTagTypeMutationAPI() : PostTagTypeMutationAPIInterface
    {
        if ($this->postTagTypeMutationAPI === null) {
            /** @var PostTagTypeMutationAPIInterface */
            $postTagTypeMutationAPI = $this->instanceManager->getInstance(PostTagTypeMutationAPIInterface::class);
            $this->postTagTypeMutationAPI = $postTagTypeMutationAPI;
        }
        return $this->postTagTypeMutationAPI;
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
    protected function getCustomPostType() : string
    {
        return $this->getPostTypeAPI()->getPostCustomPostType();
    }
    protected function getCustomPostTagTypeMutationAPI() : CustomPostTagTypeMutationAPIInterface
    {
        return $this->getPostTagTypeMutationAPI();
    }
    protected function getTagTypeAPI() : TagTypeAPIInterface
    {
        return $this->getPostTagTypeAPI();
    }
}
