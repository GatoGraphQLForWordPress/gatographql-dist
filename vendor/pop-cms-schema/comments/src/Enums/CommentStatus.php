<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\Enums;

/** @internal */
enum CommentStatus : string
{
    case APPROVE = 'approve';
    case HOLD = 'hold';
    case SPAM = 'spam';
    case TRASH = 'trash';
}
