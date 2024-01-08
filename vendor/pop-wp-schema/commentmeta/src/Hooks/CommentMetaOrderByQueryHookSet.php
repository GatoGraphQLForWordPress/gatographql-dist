<?php

declare(strict_types=1);

namespace PoPWPSchema\CommentMeta\Hooks;

use PoPCMSSchema\CommentsWP\TypeAPIs\CommentTypeAPI;
use PoPWPSchema\Meta\Constants\MetaOrderBy;
use PoPWPSchema\Meta\Hooks\AbstractMetaOrderByQueryHookSet;

class CommentMetaOrderByQueryHookSet extends AbstractMetaOrderByQueryHookSet
{
    protected function getHookName(): string
    {
        return CommentTypeAPI::HOOK_ORDERBY_QUERY_ARG_VALUE;
    }

    public function getOrderByQueryArgValue(string $orderBy): string
    {
        switch ($orderBy) {
            case MetaOrderBy::META_VALUE:
                return 'comment_meta_value';
            default:
                return parent::getOrderByQueryArgValue($orderBy);
        }
    }
}
