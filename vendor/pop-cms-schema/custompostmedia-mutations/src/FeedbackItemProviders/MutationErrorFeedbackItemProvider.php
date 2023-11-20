<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\FeedbackItemProviders;

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
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::E1, self::E2, self::E3, self::E4, self::E5];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::E1:
                return $this->__('The media item is missing', 'custompostmedia-mutations');
            case self::E2:
                return $this->__('There is no media item with ID \'%s\'', 'custompostmedia-mutations');
            case self::E3:
                return $this->__('You must be logged in to set or remove the featured image on custom posts', 'custompost-mutations');
            case self::E4:
                return $this->__('Setting a featured image is not supported for custom post type \'%s\'', 'custompostmedia-mutations');
            case self::E5:
                return $this->__('There is no media item with slug \'%s\'', 'custompostmedia-mutations');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        return FeedbackCategories::ERROR;
    }
}
