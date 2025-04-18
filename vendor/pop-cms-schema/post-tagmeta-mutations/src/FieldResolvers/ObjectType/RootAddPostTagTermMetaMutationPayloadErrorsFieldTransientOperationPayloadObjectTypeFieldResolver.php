<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\RootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\RootAddPostTagTermMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootAddPostTagTermMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\RootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver() : RootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver */
            $rootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver = $rootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootAddPostTagTermMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootAddPostTagTermMetaMutationErrorPayloadUnionTypeResolver();
    }
}
