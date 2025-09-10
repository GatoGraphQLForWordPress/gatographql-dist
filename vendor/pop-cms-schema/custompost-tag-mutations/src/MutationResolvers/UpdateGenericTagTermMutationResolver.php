<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\UpdateTagTermMutationResolverTrait;
/** @internal */
class UpdateGenericTagTermMutationResolver extends \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\AbstractMutateGenericTagTermMutationResolver
{
    use UpdateTagTermMutationResolverTrait;
}
