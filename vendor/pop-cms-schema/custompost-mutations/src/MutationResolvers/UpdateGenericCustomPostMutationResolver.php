<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

/** @internal */
class UpdateGenericCustomPostMutationResolver extends \PoPCMSSchema\CustomPostMutations\MutationResolvers\AbstractCreateOrUpdateGenericCustomPostMutationResolver
{
    use \PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateCustomPostMutationResolverTrait;
}
