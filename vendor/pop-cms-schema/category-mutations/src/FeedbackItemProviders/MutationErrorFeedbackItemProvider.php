<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;
/** @internal */
class MutationErrorFeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const E1 = 'e1';
    public const E5 = 'e5';
    public const E6 = 'e6';
    public const E7 = 'e7';
    public const E8 = 'e8';
    public const E9 = 'e9';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::E1, self::E5, self::E6, self::E7, self::E8, self::E9];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::E1:
                return $this->__('You must be logged in to mutate category terms', 'category-mutations');
            case self::E5:
                return $this->__('There is no category taxonomy with name \'%s\'', 'category-mutations');
            case self::E6:
                return $this->__('There is no category term with ID \'%s\'', 'category-mutations');
            case self::E7:
                return $this->__('On category \'%s\', there is no term with ID \'%s\'', 'category-mutations');
            case self::E8:
                return $this->__('There is no category term with slug \'%s\'', 'category-mutations');
            case self::E9:
                return $this->__('On category \'%s\', there is no term with slug \'%s\'', 'category-mutations');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        return FeedbackCategories::ERROR;
    }
}
