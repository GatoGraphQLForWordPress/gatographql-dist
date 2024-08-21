<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

/** @internal */
class DeleteGenericTagTermMutationResolver extends \PoPCMSSchema\TagMutations\MutationResolvers\AbstractMutateGenericTagTermMutationResolver
{
    use \PoPCMSSchema\TagMutations\MutationResolvers\DeleteTagTermMutationResolverTrait;
}
