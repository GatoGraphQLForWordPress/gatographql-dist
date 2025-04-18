<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\FieldResolvers\ObjectType;

use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\RootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\RootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\FieldResolvers\ObjectType\AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
class RootDeleteGenericCustomPostMetaMutationPayloadErrorsFieldTransientOperationPayloadObjectTypeFieldResolver extends AbstractErrorsFieldTransientOperationPayloadObjectTypeFieldResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\UnionType\RootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver() : RootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver */
            $rootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver = $rootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [RootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver::class];
    }
    protected function getErrorsFieldFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        return $this->getRootDeleteGenericCustomPostMetaMutationErrorPayloadUnionTypeResolver();
    }
}
