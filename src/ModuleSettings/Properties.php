<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ModuleSettings;

class Properties
{
    public const NAME = 'name';
    public const INPUT = 'input';
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';
    public const POSSIBLE_VALUES = 'possibleValues';
    public const CAN_BE_EMPTY = 'canBeEmpty';
    // Used for Property Array
    public const KEY_LABELS = 'keyLabels';
    // Used for Select inputs
    public const IS_MULTIPLE = 'isMultiple';
    // Used for Strings
    public const USE_TEXTAREA = 'useTextarea';
    // Used for Integers
    public const MIN_NUMBER = 'minNumber';
    public const TYPE = 'type';
    public const SUBTYPE = 'subtype';
    public const TYPE_STRING = 'string';
    public const TYPE_BOOL = 'bool';
    public const TYPE_INT = 'int';
    public const TYPE_ARRAY = 'array';
    public const TYPE_PROPERTY_ARRAY = 'propertyArray';
    public const TYPE_NULL = 'null';
    public const TYPE_HIDDEN = 'hidden';
    public const CSS_STYLE = 'css-style';
}
