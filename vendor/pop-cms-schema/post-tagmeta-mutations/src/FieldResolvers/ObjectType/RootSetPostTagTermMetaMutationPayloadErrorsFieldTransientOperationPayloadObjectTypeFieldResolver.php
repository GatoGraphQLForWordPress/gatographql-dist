<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\RootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\RootSetPostTagTermMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootSetPostTagTermMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\UnionType\RootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver() : RootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver */
            $rootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver = $rootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootSetPostTagTermMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootSetPostTagTermMetaMutationErrorPayloadUnionTypeResolver();
    }
}
