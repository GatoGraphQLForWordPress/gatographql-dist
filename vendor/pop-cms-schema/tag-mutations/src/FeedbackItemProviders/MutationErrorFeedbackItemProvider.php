<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\FeedbackItemProviders;

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
                return $this->__('You must be logged in to mutate tag terms', 'tag-mutations');
            case self::E5:
                return $this->__('There is no tag taxonomy with name \'%s\'', 'tag-mutations');
            case self::E6:
                return $this->__('There is no tag term with ID \'%s\'', 'tag-mutations');
            case self::E7:
                return $this->__('On tag \'%s\', there is no term with ID \'%s\'', 'tag-mutations');
            case self::E8:
                return $this->__('There is no tag term with slug \'%s\'', 'tag-mutations');
            case self::E9:
                return $this->__('On tag \'%s\', there is no term with slug \'%s\'', 'tag-mutations');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getTag(string $code) : string
    {
        return FeedbackCategories::ERROR;
    }
}
