<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ObjectModels;

class GraphQLQueryPostAttributesEntry
{
    /**
     * @readonly
     * @var string
     */
    public $query;
    /**
     * @var array<string, mixed>
     * @readonly
     */
    public $variables = [];
    /**
     * @param array<string,mixed> $variables
     */
    public function __construct(string $query, array $variables = [])
    {
        $this->query = $query;
        $this->variables = $variables;
    }
}
