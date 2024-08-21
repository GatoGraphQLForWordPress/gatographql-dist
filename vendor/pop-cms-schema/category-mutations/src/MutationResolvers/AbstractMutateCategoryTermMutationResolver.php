<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\Exception\CategoryTermCRUDMutationException;
use PoPCMSSchema\CategoryMutations\TypeAPIs\CategoryTypeMutationAPIInterface;
use PoPCMSSchema\TaxonomyMutations\MutationResolvers\AbstractMutateTaxonomyTermMutationResolver;
/** @internal */
abstract class AbstractMutateCategoryTermMutationResolver extends AbstractMutateTaxonomyTermMutationResolver implements \PoPCMSSchema\CategoryMutations\MutationResolvers\CategoryTermMutationResolverInterface
{
    use \PoPCMSSchema\CategoryMutations\MutationResolvers\MutateCategoryTermMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\CategoryMutations\TypeAPIs\CategoryTypeMutationAPIInterface|null
     */
    private $categoryTypeMutationAPI;
    public final function setCategoryTypeMutationAPI(CategoryTypeMutationAPIInterface $categoryTypeMutationAPI) : void
    {
        $this->categoryTypeMutationAPI = $categoryTypeMutationAPI;
    }
    protected final function getCategoryTypeMutationAPI() : CategoryTypeMutationAPIInterface
    {
        if ($this->categoryTypeMutationAPI === null) {
            /** @var CategoryTypeMutationAPIInterface */
            $categoryTypeMutationAPI = $this->instanceManager->getInstance(CategoryTypeMutationAPIInterface::class);
            $this->categoryTypeMutationAPI = $categoryTypeMutationAPI;
        }
        return $this->categoryTypeMutationAPI;
    }
    /**
     * @param array<string,mixed> $taxonomyData
     * @return string|int the ID of the updated taxonomy
     * @throws CategoryTermCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     */
    protected function executeUpdateTaxonomyTerm($taxonomyTermID, string $taxonomyName, array $taxonomyData)
    {
        return $this->getCategoryTypeMutationAPI()->updateCategoryTerm($taxonomyTermID, $taxonomyName, $taxonomyData);
    }
    /**
     * @param array<string,mixed> $taxonomyData
     * @return string|int the ID of the created taxonomy
     * @throws CategoryTermCRUDMutationException If there was an error (eg: some taxonomy term creation validation failed)
     */
    protected function executeCreateTaxonomyTerm(string $taxonomyName, array $taxonomyData)
    {
        return $this->getCategoryTypeMutationAPI()->createCategoryTerm($taxonomyName, $taxonomyData);
    }
    /**
     * @return bool `true` if the operation successful, `false` if the term does not exist
     * @throws CategoryTermCRUDMutationException If there was an error (eg: some taxonomy term creation validation failed)
     * @param string|int $taxonomyTermID
     */
    protected function executeDeleteTaxonomyTerm($taxonomyTermID, string $taxonomyName) : bool
    {
        return $this->getCategoryTypeMutationAPI()->deleteCategoryTerm($taxonomyTermID, $taxonomyName);
    }
    protected function isHierarchical() : bool
    {
        return \true;
    }
}
