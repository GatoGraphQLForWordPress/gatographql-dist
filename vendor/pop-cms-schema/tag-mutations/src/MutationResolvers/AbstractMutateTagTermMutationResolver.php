<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\Exception\TagTermCRUDMutationException;
use PoPCMSSchema\TagMutations\TypeAPIs\TagTypeMutationAPIInterface;
use PoPCMSSchema\TaxonomyMutations\MutationResolvers\AbstractMutateTaxonomyTermMutationResolver;
/** @internal */
abstract class AbstractMutateTagTermMutationResolver extends AbstractMutateTaxonomyTermMutationResolver implements \PoPCMSSchema\TagMutations\MutationResolvers\TagTermMutationResolverInterface
{
    use \PoPCMSSchema\TagMutations\MutationResolvers\MutateTagTermMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\TagMutations\TypeAPIs\TagTypeMutationAPIInterface|null
     */
    private $tagTypeMutationAPI;
    protected final function getTagTypeMutationAPI() : TagTypeMutationAPIInterface
    {
        if ($this->tagTypeMutationAPI === null) {
            /** @var TagTypeMutationAPIInterface */
            $tagTypeMutationAPI = $this->instanceManager->getInstance(TagTypeMutationAPIInterface::class);
            $this->tagTypeMutationAPI = $tagTypeMutationAPI;
        }
        return $this->tagTypeMutationAPI;
    }
    /**
     * @param array<string,mixed> $taxonomyData
     * @return string|int the ID of the updated taxonomy
     * @throws TagTermCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     */
    protected function executeUpdateTaxonomyTerm($taxonomyTermID, string $taxonomyName, array $taxonomyData)
    {
        return $this->getTagTypeMutationAPI()->updateTagTerm($taxonomyTermID, $taxonomyName, $taxonomyData);
    }
    /**
     * @param array<string,mixed> $taxonomyData
     * @return string|int the ID of the created taxonomy
     * @throws TagTermCRUDMutationException If there was an error (eg: some taxonomy term creation validation failed)
     */
    protected function executeCreateTaxonomyTerm(string $taxonomyName, array $taxonomyData)
    {
        return $this->getTagTypeMutationAPI()->createTagTerm($taxonomyName, $taxonomyData);
    }
    /**
     * @return bool `true` if the operation successful, `false` if the term does not exist
     * @throws TagTermCRUDMutationException If there was an error (eg: some taxonomy term creation validation failed)
     * @param string|int $taxonomyTermID
     */
    protected function executeDeleteTaxonomyTerm($taxonomyTermID, string $taxonomyName) : bool
    {
        return $this->getTagTypeMutationAPI()->deleteTagTerm($taxonomyTermID, $taxonomyName);
    }
    protected function isHierarchical() : bool
    {
        return \false;
    }
}
