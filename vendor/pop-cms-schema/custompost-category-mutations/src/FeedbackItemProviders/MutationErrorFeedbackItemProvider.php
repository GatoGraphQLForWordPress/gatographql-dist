<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;
/** @internal */
class MutationErrorFeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const E1 = 'e1';
    public const E4 = 'e4';
    public const E6 = 'e6';
    public const E7 = 'e7';
    public const E8 = 'e8';
    public const E9 = 'e9';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::E1, self::E4, self::E6, self::E7, self::E8, self::E9];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::E1:
                return $this->__('You must be logged in to set categories on custom posts', 'custompost-category-mutations');
            case self::E4:
                return $this->__('Category taxonomy \'%s\' (for terms with ID(s) \'%s\') is not registered for custom post type \'%s\'', 'custompost-category-mutations');
            case self::E6:
                return $this->__('There is no category with ID \'%s\'', 'custompost-category-mutations');
            case self::E7:
                return $this->__('On taxonomy \'%s\', there is no category with ID \'%s\'', 'custompost-category-mutations');
            case self::E8:
                return $this->__('There is no category with slug \'%s\'', 'custompost-category-mutations');
            case self::E9:
                return $this->__('On taxonomy \'%s\', there is no category with slug \'%s\'', 'custompost-category-mutations');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        return FeedbackCategories::ERROR;
    }
}
