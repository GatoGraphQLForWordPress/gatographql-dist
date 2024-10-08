<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;

class ErrorFeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const E1 = 'e1';

    /**
     * @return string[]
     */
    public function getCodes(): array
    {
        return [
            self::E1,
        ];
    }

    public function getMessagePlaceholder(string $code): string
    {
        switch ($code) {
            case self::E1:
                return $this->__('Application Password authentication error: %s', 'gatographql');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }

    public function getCategory(string $code): string
    {
        return FeedbackCategories::ERROR;
    }
}
