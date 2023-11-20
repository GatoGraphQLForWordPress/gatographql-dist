<?php

declare (strict_types=1);
namespace PoPSchema\ExtendedSchemaCommons\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;
/** @internal */
class InputValueCoercionErrorFeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const E1 = 'e1';
    public const E2 = 'e2';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::E1, self::E2];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::E1:
                return $this->__('The format for type \'%s\' is not correct: it must be satisfied via regex /(\\+{1}[0-9]{1,3}[0-9]{8,9})/', 'extended-schema-commons');
            case self::E2:
                return $this->__('The format for type \'%s\' is not correct: it must be satisfied via regex /^{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}}?$/', 'extended-schema-commons');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        return FeedbackCategories::ERROR;
    }
}
