<?php

declare(strict_types=1);

namespace PoPCMSSchema\CustomPostsWP\Overrides\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostsWP\ObjectTypeResolverPickers\CustomPostObjectTypeResolverPickerInterface;
use PoPCMSSchema\CustomPostsWP\ObjectTypeResolverPickers\NoCastCustomPostTypeResolverPickerTrait;
use PoPCMSSchema\CustomPosts\ObjectTypeResolverPickers\CustomPostUnionGenericCustomPostObjectTypeResolverPicker as UpstreamCustomPostUnionGenericCustomPostObjectTypeResolverPicker;

class CustomPostUnionGenericCustomPostObjectTypeResolverPicker extends UpstreamCustomPostUnionGenericCustomPostObjectTypeResolverPicker implements CustomPostObjectTypeResolverPickerInterface
{
    use NoCastCustomPostTypeResolverPickerTrait;
}
