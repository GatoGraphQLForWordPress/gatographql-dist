<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\MutationResolvers;

use PoPCMSSchema\TagMutations\MutationResolvers\DeleteTagTermMutationResolverTrait;
/** @internal */
class DeleteGenericTagTermMutationResolver extends \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\AbstractMutateGenericTagTermMutationResolver
{
    use DeleteTagTermMutationResolverTrait;
}
