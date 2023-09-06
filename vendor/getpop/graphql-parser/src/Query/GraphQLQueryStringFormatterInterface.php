<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\Query;

use stdClass;
interface GraphQLQueryStringFormatterInterface
{
    /**
     * @param null|integer|float|boolean|string|mixed[]|stdClass $elem
     */
    public function getElementAsQueryString($elem) : string;
    /**
     * @param mixed[] $list
     */
    public function getListAsQueryString(array $list) : string;
    public function getObjectAsQueryString(stdClass $object) : string;
    /**
     * @param null|int|float|bool|string $literal
     */
    public function getLiteralAsQueryString($literal) : string;
}
