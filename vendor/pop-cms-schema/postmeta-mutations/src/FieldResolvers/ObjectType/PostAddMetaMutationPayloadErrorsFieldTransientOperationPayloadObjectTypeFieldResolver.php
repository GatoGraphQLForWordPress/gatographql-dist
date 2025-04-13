<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\PostAddMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\PostAddMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class PostAddMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostMetaMutations\TypeResolvers\UnionType\PostAddMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $postAddMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getPostAddMetaMutationErrorPayloadUnionTypeResolver() : PostAddMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->postAddMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var PostAddMetaMutationErrorPayloadUnionTypeResolver */
            $postAddMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(PostAddMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->postAddMetaMutationErrorPayloadUnionTypeResolver = $postAddMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->postAddMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [PostAddMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getPostAddMetaMutationErrorPayloadUnionTypeResolver();
    }
}
