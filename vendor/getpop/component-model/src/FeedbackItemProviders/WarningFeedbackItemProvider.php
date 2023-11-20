<?php

declare (strict_types=1);
namespace PoP\ComponentModel\FeedbackItemProviders;

use PoP\ComponentModel\Constants\Constants;
use PoP\ComponentModel\Constants\Params;
use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;
/** @internal */
class WarningFeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const W1 = 'w1';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::W1];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::W1:
                return \sprintf($this->__('URL param \'%s\' expects the type and field name separated by \'%s\' (eg: \'%s\'), so the following value has been ignored: ', 'component-model'), Params::VERSION_CONSTRAINT_FOR_FIELDS, Constants::TYPE_FIELD_SEPARATOR, '?' . Params::VERSION_CONSTRAINT_FOR_FIELDS . '[Post' . Constants::TYPE_FIELD_SEPARATOR . 'title]=^0.1') . '\'%s\'';
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        return FeedbackCategories::WARNING;
    }
}
