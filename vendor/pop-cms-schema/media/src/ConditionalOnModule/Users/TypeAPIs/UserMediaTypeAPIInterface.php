<?php

declare (strict_types=1);
namespace PoPCMSSchema\Media\ConditionalOnModule\Users\TypeAPIs;

/** @internal */
interface UserMediaTypeAPIInterface
{
    public function getMediaAuthorID(string|int|object $mediaObjectOrID) : string|int|null;
}
