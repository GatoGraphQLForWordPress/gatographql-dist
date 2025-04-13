<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;
/** @internal */
class MutationErrorFeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const E1 = 'e1';
    public const E2 = 'e2';
    public const E3 = 'e3';
    public const E4 = 'e4';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::E1, self::E2, self::E3, self::E4];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::E1:
                return $this->__('There is no user with ID \'%s\'', 'user-mutations');
            case self::E2:
                return $this->__('There is no user with username \'%s\'', 'user-mutations');
            case self::E3:
                return $this->__('There is no user with email \'%s\'', 'user-mutations');
            case self::E4:
                return $this->__('The logged-in user doesn\'t have the ability to edit user with ID \'%s\'', 'user-mutations');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        return FeedbackCategories::ERROR;
    }
}
