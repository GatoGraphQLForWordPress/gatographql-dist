<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\CommentMutations\Module;
use PoPCMSSchema\CommentMutations\ModuleConfiguration;
use PoPCMSSchema\CommentMutations\TypeResolvers\UnionType\AbstractCommentMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class CommentAuthorNameIsMissingErrorPayloadObjectTypeResolverPicker extends \PoPCMSSchema\CommentMutations\ObjectTypeResolverPickers\AbstractCommentAuthorNameIsMissingErrorPayloadObjectTypeResolverPicker
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo() : array
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if ($moduleConfiguration->mustUserBeLoggedInToAddComment()) {
            return [];
        }
        return [AbstractCommentMutationErrorPayloadUnionTypeResolver::class];
    }
}
