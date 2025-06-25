<?php

declare (strict_types=1);
namespace PoPCMSSchema\MetaMutations\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;
/** @internal */
class MutationErrorFeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const E1 = 'e1';
    public const E2 = 'e2';
    public const E3 = 'e3';
    public const E4 = 'e4';
    public const E5 = 'e5';
    public const E6 = 'e6';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::E1, self::E2, self::E3, self::E4, self::E5, self::E6];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::E1:
                return $this->__('The entity with ID \'%s\' already has meta entry for key \'%s\'', 'taxonomymeta-mutations');
            case self::E2:
                return $this->__('Meta key \'%s\' is not allowed', 'taxonomymeta-mutations');
            case self::E3:
                return $this->__('Meta keys \'%s\' are not allowed', 'taxonomymeta-mutations');
            case self::E4:
                return $this->__('The entity with ID \'%s\' has no entry with meta key \'%s\'', 'taxonomymeta-mutations');
            case self::E5:
                return $this->__('The entity with ID \'%s\' has no entry with meta key \'%s\' and value \'%s\'', 'taxonomymeta-mutations');
            case self::E6:
                return $this->__('The entity with ID \'%s\' already has entry with meta key \'%s\' and value \'%s\'', 'taxonomymeta-mutations');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        return FeedbackCategories::ERROR;
    }
}
