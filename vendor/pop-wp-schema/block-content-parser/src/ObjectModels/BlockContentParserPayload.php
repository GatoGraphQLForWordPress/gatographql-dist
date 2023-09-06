<?php

declare(strict_types=1);

namespace PoPWPSchema\BlockContentParser\ObjectModels;

use stdClass;

class BlockContentParserPayload
{
    /**
     * @var array<stdClass>
     * @readonly
     */
    public $blocks;
    /**
     * @var string[]|null
     * @readonly
     */
    public $warnings;
    /**
     * @param array<stdClass> $blocks
     * @param string[]|null $warnings
     */
    public function __construct(array $blocks, ?array $warnings)
    {
        $this->blocks = $blocks;
        $this->warnings = $warnings;
    }
}
