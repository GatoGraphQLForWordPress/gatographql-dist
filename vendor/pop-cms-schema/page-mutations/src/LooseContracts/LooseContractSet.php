<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\LooseContracts;

use PoP\LooseContracts\AbstractLooseContractSet;
/** @internal */
class LooseContractSet extends AbstractLooseContractSet
{
    public const NAME_EDIT_PAGES_CAPABILITY = 'popcms:capability:editPages';
    public const NAME_PUBLISH_PAGES_CAPABILITY = 'popcms:capability:publishPages';
    /**
     * @return string[]
     */
    public function getRequiredNames() : array
    {
        return [self::NAME_EDIT_PAGES_CAPABILITY, self::NAME_PUBLISH_PAGES_CAPABILITY];
    }
}
