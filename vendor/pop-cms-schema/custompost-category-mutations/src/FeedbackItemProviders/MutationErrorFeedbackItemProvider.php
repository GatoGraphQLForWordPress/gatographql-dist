<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;
/** @internal */
class MutationErrorFeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const E1 = 'e1';
    public const E2 = 'e2';
    public const E3 = 'e3';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::E1, self::E2, self::E3];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::E1:
                return $this->__('You must be logged in to set categories on custom posts', 'custompost-category-mutations');
            case self::E2:
                return $this->__('There are no categories with ID(s) \'%s\'', 'custompost-category-mutations');
            case self::E3:
                return $this->__('There are no categories with slug(s) \'%s\'', 'custompost-category-mutations');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        return FeedbackCategories::ERROR;
    }
}
