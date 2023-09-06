<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategories\Hooks;

use PoP\Root\App;
use PoP\ComponentModel\ModelInstance\ModelInstance;
use PoP\Root\Hooks\AbstractHookSet;
use PoPCMSSchema\CustomPosts\Routing\RequestNature;
use PoPCMSSchema\PostCategories\TypeAPIs\PostCategoryTypeAPIInterface;
use PoPCMSSchema\Posts\TypeAPIs\PostTypeAPIInterface;
class ModelInstanceHookSet extends AbstractHookSet
{
    public const HOOK_VARY_MODEL_INSTANCE_BY_CATEGORY = __CLASS__ . ':vary-model-instance-by-category';
    /**
     * @var \PoPCMSSchema\Posts\TypeAPIs\PostTypeAPIInterface|null
     */
    private $postTypeAPI;
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
    protected function init() : void
    {
        App::addFilter(ModelInstance::HOOK_ELEMENTS_RESULT, \Closure::fromCallable([$this, 'getModelInstanceElementsFromAppState']));
    }
    /**
     * @return string[]
     * @param string[] $elements
     */
    public function getModelInstanceElementsFromAppState(array $elements) : array
    {
        $nature = App::getState('nature');
        // Properties specific to each nature
        if ($nature === RequestNature::CUSTOMPOST && App::getState(['routing', 'queried-object-post-type']) === $this->getPostTypeAPI()->getPostCustomPostType()) {
            // Single may depend on its post_type and category
            // Post and Event may be different
            // Announcements and Articles (Posts), or Past Event and (Upcoming) Event may be different
            // By default, we check for post type but not for categories
            if (App::applyFilters(self::HOOK_VARY_MODEL_INSTANCE_BY_CATEGORY, \false)) {
                $postCategoryTypeAPI = $this->getPostCategoryTypeAPI();
                $postID = App::getState(['routing', 'queried-object-id']);
                $categories = [];
                foreach ($postCategoryTypeAPI->getCustomPostCategories($postID) as $cat) {
                    $categoryID = \is_object($cat) ? $postCategoryTypeAPI->getCategoryID($cat) : $cat;
                    /** @var string */
                    $slug = $postCategoryTypeAPI->getCategorySlug($cat);
                    $categories[] = $slug . $categoryID;
                }
                $elements[] = $this->__('categories:', 'post-categories') . \implode('.', $categories);
            }
        }
        return $elements;
    }
}
