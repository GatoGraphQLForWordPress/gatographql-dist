<?php

declare (strict_types=1);
namespace PoPSchema\DirectiveCommons\FeedbackItemProviders;

use PoP\Root\FeedbackItemProviders\AbstractFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackCategories;
/** @internal */
class FeedbackItemProvider extends AbstractFeedbackItemProvider
{
    public const E1 = 'e1';
    public const E2 = 'e2';
    public const E3 = 'e3';
    public const E4 = 'e4';
    public const E5 = 'e5';
    public const E6 = 'e6';
    public const E7 = 'e7';
    public const W1 = 'w1';
    public const W2 = 'w2';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::E1, self::E2, self::E3, self::E4, self::E5, self::E6, self::E7, self::W1, self::W2];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::E1:
                return $this->__('Directive \'%s\' from field \'%s\' cannot be applied on object with ID \'%s\' because it is not of a supported type', 'directives-commons');
            case self::E2:
                return $this->__('Directive \'%s\' from field \'%s\' cannot be applied on object with ID \'%s\' because it is not a string', 'directives-commons');
            case self::E3:
                return $this->__('Directive \'%s\' from field \'%s\' cannot be applied on object with ID \'%s\' because it is not a bool', 'directives-commons');
            case self::E4:
                return $this->__('Directive \'%s\' from field \'%s\' cannot be applied on object with ID \'%s\' because it is not an integer', 'directives-commons');
            case self::E5:
                return $this->__('Directive \'%s\' from field \'%s\' cannot be applied on object with ID \'%s\' because it is not a float', 'directives-commons');
            case self::E6:
                return $this->__('Directive \'%s\' from field \'%s\' cannot be applied on object with ID \'%s\' because it is not a JSON object', 'directives-commons');
            case self::E7:
                return $this->__('Directive \'%s\' from field \'%s\' cannot be applied on object with ID \'%s\' because it is not an array', 'directives-commons');
            case self::W1:
                return $this->__('Dynamic variable with name \'%s\' had already been set, had its value overridden', 'export-directive');
            case self::W2:
                return $this->__('Dynamic variable with name \'%s\' had already been set for object with ID \'%s\', had its value overridden', 'export-directive');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        switch ($code) {
            case self::E1:
            case self::E2:
            case self::E3:
            case self::E4:
            case self::E5:
            case self::E6:
            case self::E7:
                return FeedbackCategories::ERROR;
            case self::W1:
            case self::W2:
                return FeedbackCategories::WARNING;
            default:
                return parent::getCategory($code);
        }
    }
}
