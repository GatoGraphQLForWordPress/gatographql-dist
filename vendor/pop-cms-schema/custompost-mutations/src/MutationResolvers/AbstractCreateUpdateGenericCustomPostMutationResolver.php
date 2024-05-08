<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\AbstractCreateOrUpdateCustomPostMutationResolver;
/** @internal */
abstract class AbstractCreateUpdateGenericCustomPostMutationResolver extends AbstractCreateOrUpdateCustomPostMutationResolver
{
    public function getCustomPostType() : string
    {
        return '';
    }
}
