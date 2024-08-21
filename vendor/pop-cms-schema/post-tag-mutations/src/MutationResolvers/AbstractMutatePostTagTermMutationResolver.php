<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\AbstractMutateTagTermMutationResolver;
use PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface;
/** @internal */
abstract class AbstractMutatePostTagTermMutationResolver extends AbstractMutateTagTermMutationResolver
{
    /**
     * @var \PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface|null
     */
    private $postTagTypeAPI;
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
    public function getTaxonomyName() : string
    {
        return $this->getPostTagTypeAPI()->getPostTagTaxonomyName();
    }
}
