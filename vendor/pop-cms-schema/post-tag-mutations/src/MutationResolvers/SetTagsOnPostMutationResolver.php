<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\CustomPostTagMutations\MutationResolvers\AbstractSetTagsOnCustomPostMutationResolver;
use PoPCMSSchema\CustomPostTagMutations\TypeAPIs\CustomPostTagTypeMutationAPIInterface;
use PoPCMSSchema\PostTagMutations\TypeAPIs\PostTagTypeMutationAPIInterface;
use PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface;
use PoPCMSSchema\Tags\TypeAPIs\TagTypeAPIInterface;
use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface;
/** @internal */
class SetTagsOnPostMutationResolver extends AbstractSetTagsOnCustomPostMutationResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeAPIs\PostTagTypeMutationAPIInterface|null
     */
    private $postTagTypeMutationAPIInterface;
    /**
     * @var \PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface|null
     */
    private $postTagTypeAPI;
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface|null
     */
    private $taxonomyTermTypeAPI;
    public final function setPostTagTypeMutationAPI(PostTagTypeMutationAPIInterface $postTagTypeMutationAPIInterface) : void
    {
        $this->postTagTypeMutationAPIInterface = $postTagTypeMutationAPIInterface;
    }
    protected final function getPostTagTypeMutationAPI() : PostTagTypeMutationAPIInterface
    {
        if ($this->postTagTypeMutationAPIInterface === null) {
            /** @var PostTagTypeMutationAPIInterface */
            $postTagTypeMutationAPIInterface = $this->instanceManager->getInstance(PostTagTypeMutationAPIInterface::class);
            $this->postTagTypeMutationAPIInterface = $postTagTypeMutationAPIInterface;
        }
        return $this->postTagTypeMutationAPIInterface;
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
    public final function setTaxonomyTermTypeAPI(TaxonomyTermTypeAPIInterface $taxonomyTermTypeAPI) : void
    {
        $this->taxonomyTermTypeAPI = $taxonomyTermTypeAPI;
    }
    protected final function getTaxonomyTermTypeAPI() : TaxonomyTermTypeAPIInterface
    {
        if ($this->taxonomyTermTypeAPI === null) {
            /** @var TaxonomyTermTypeAPIInterface */
            $taxonomyTermTypeAPI = $this->instanceManager->getInstance(TaxonomyTermTypeAPIInterface::class);
            $this->taxonomyTermTypeAPI = $taxonomyTermTypeAPI;
        }
        return $this->taxonomyTermTypeAPI;
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
    protected function getTagTaxonomyName() : string
    {
        return $this->getPostTagTypeAPI()->getPostTagTaxonomyName();
    }
}
