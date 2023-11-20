<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\Hooks;

use PoPCMSSchema\Categories\TypeAPIs\CategoryTypeAPIInterface;
use PoPCMSSchema\CustomPostCategoryMutations\Hooks\AbstractMutationResolverHookSet;
use PoPCMSSchema\CustomPostCategoryMutations\TypeAPIs\CustomPostCategoryTypeMutationAPIInterface;
use PoPCMSSchema\PostCategories\TypeAPIs\PostCategoryTypeAPIInterface;
use PoPCMSSchema\PostCategoryMutations\TypeAPIs\PostCategoryTypeMutationAPIInterface;
use PoPCMSSchema\Posts\TypeAPIs\PostTypeAPIInterface;
/** @internal */
class MutationResolverHookSet extends AbstractMutationResolverHookSet
{
    /**
     * @var \PoPCMSSchema\Posts\TypeAPIs\PostTypeAPIInterface|null
     */
    private $postTypeAPI;
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeAPIs\PostCategoryTypeMutationAPIInterface|null
     */
    private $postCategoryTypeMutationAPIInterface;
    /**
     * @var \PoPCMSSchema\PostCategories\TypeAPIs\PostCategoryTypeAPIInterface|null
     */
    private $postCategoryTypeAPI;
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
    public final function setPostCategoryTypeMutationAPI(PostCategoryTypeMutationAPIInterface $postCategoryTypeMutationAPIInterface) : void
    {
        $this->postCategoryTypeMutationAPIInterface = $postCategoryTypeMutationAPIInterface;
    }
    protected final function getPostCategoryTypeMutationAPI() : PostCategoryTypeMutationAPIInterface
    {
        if ($this->postCategoryTypeMutationAPIInterface === null) {
            /** @var PostCategoryTypeMutationAPIInterface */
            $postCategoryTypeMutationAPIInterface = $this->instanceManager->getInstance(PostCategoryTypeMutationAPIInterface::class);
            $this->postCategoryTypeMutationAPIInterface = $postCategoryTypeMutationAPIInterface;
        }
        return $this->postCategoryTypeMutationAPIInterface;
    }
    public final function setPostCategoryTypeAPI(PostCategoryTypeAPIInterface $postCategoryTypeAPI) : void
    {
        $this->postCategoryTypeAPI = $postCategoryTypeAPI;
    }
    protected final function getPostCategoryTypeAPI() : PostCategoryTypeAPIInterface
    {
        if ($this->postCategoryTypeAPI === null) {
            /** @var PostCategoryTypeAPIInterface */
            $postCategoryTypeAPI = $this->instanceManager->getInstance(PostCategoryTypeAPIInterface::class);
            $this->postCategoryTypeAPI = $postCategoryTypeAPI;
        }
        return $this->postCategoryTypeAPI;
    }
    protected function getCustomPostType() : string
    {
        return $this->getPostTypeAPI()->getPostCustomPostType();
    }
    protected function getCustomPostCategoryTypeMutationAPI() : CustomPostCategoryTypeMutationAPIInterface
    {
        return $this->getPostCategoryTypeMutationAPI();
    }
    protected function getCategoryTypeAPI() : CategoryTypeAPIInterface
    {
        return $this->getPostCategoryTypeAPI();
    }
}
