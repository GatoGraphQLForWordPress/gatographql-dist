<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\FeedbackItemProviders;

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
    public const E7 = 'e7';
    public const E8 = 'e8';
    public const E9 = 'e9';
    public const E10 = 'e10';
    public const E11 = 'e11';
    public const E12 = 'e12';
    /**
     * @return string[]
     */
    public function getCodes() : array
    {
        return [self::E1, self::E2, self::E3, self::E4, self::E5, self::E6, self::E7, self::E8, self::E9, self::E10, self::E11, self::E12];
    }
    public function getMessagePlaceholder(string $code) : string
    {
        switch ($code) {
            case self::E1:
                return $this->__('You must be logged in to mutate taxonomy terms', 'taxonomy-mutations');
            case self::E2:
                return $this->__('Your user doesn\'t have permission for editing taxonomy \'%s\'.', 'taxonomy-mutations');
            case self::E3:
                return $this->__('Your user doesn\'t have permission for deleting taxonomy term with ID \'%s\'.', 'taxonomy-mutations');
            case self::E4:
                return $this->__('The taxonomy ID is missing', 'taxonomy-mutations');
            case self::E5:
                return $this->__('There is no taxonomy with name \'%s\'', 'taxonomy-mutations');
            case self::E6:
                return $this->__('There is no term with ID \'%s\'', 'taxonomy-mutations');
            case self::E7:
                return $this->__('On taxonomy \'%s\', there is no term with ID \'%s\'', 'taxonomy-mutations');
            case self::E8:
                return $this->__('There is no term with slug \'%s\'', 'taxonomy-mutations');
            case self::E9:
                return $this->__('On taxonomy \'%s\', there is no term with slug \'%s\'', 'taxonomy-mutations');
            case self::E10:
                return $this->__('Your user doesn\'t have permission to assign terms to taxonomy \'%s\'.', 'taxonomy-mutations');
            case self::E11:
                return $this->__('There is no custom post type registered for ID \'%s\'.', 'taxonomy-mutations');
            case self::E12:
                return $this->__('Taxonomy \'%s\' (for terms with ID(s) \'%s\') is not valid for custom post type \'%s\'', 'taxonomy-mutations');
            default:
                return parent::getMessagePlaceholder($code);
        }
    }
    public function getCategory(string $code) : string
    {
        return FeedbackCategories::ERROR;
    }
}
