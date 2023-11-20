<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\ConditionalOnModule\Users\TypeAPIs;

/** @internal */
interface CommentTypeAPIInterface
{
    /**
     * @return string|int|null
     */
    public function getCommentUserID(object $comment);
}
