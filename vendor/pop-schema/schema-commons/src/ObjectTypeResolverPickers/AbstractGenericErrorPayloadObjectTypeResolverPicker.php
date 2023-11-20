<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\ObjectTypeResolverPickers;

use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\GenericErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoPSchema\SchemaCommons\ObjectModels\GenericErrorPayload;
/** @internal */
abstract class AbstractGenericErrorPayloadObjectTypeResolverPicker extends \PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker implements \PoPSchema\SchemaCommons\ObjectTypeResolverPickers\GenericErrorPayloadObjectTypeResolverPickerInterface
{
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ObjectType\GenericErrorPayloadObjectTypeResolver|null
     */
    private $genericErrorPayloadObjectTypeResolver;
    public final function setGenericErrorPayloadObjectTypeResolver(GenericErrorPayloadObjectTypeResolver $genericErrorPayloadObjectTypeResolver) : void
    {
        $this->genericErrorPayloadObjectTypeResolver = $genericErrorPayloadObjectTypeResolver;
    }
    protected final function getGenericErrorPayloadObjectTypeResolver() : GenericErrorPayloadObjectTypeResolver
    {
        if ($this->genericErrorPayloadObjectTypeResolver === null) {
            /** @var GenericErrorPayloadObjectTypeResolver */
            $genericErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(GenericErrorPayloadObjectTypeResolver::class);
            $this->genericErrorPayloadObjectTypeResolver = $genericErrorPayloadObjectTypeResolver;
        }
        return $this->genericErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getGenericErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return GenericErrorPayload::class;
    }
}
