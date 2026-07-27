<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

/** @internal */
class PayloadableDeleteGenericCustomPostMutationResolver extends \PoPCMSSchema\CustomPostMutations\MutationResolvers\DeleteGenericCustomPostMutationResolver
{
    use \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableDeleteCustomPostMutationResolverTrait;
}
