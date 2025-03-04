<?php

declare(strict_types=1);

namespace PoPWPSchema\Blocks\ObjectTypeResolverPickers;

use PoPWPSchema\Blocks\ObjectModels\GeneralBlock;
use PoPWPSchema\Blocks\TypeResolvers\ObjectType\GeneralBlockObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;

class GeneralBlockObjectTypeResolverPicker extends AbstractBlockObjectTypeResolverPicker
{
    /**
     * @var \PoPWPSchema\Blocks\TypeResolvers\ObjectType\GeneralBlockObjectTypeResolver|null
     */
    private $generalBlockObjectTypeResolver;

    final protected function getGeneralBlockObjectTypeResolver(): GeneralBlockObjectTypeResolver
    {
        if ($this->generalBlockObjectTypeResolver === null) {
            /** @var GeneralBlockObjectTypeResolver */
            $generalBlockObjectTypeResolver = $this->instanceManager->getInstance(GeneralBlockObjectTypeResolver::class);
            $this->generalBlockObjectTypeResolver = $generalBlockObjectTypeResolver;
        }
        return $this->generalBlockObjectTypeResolver;
    }

    public function getObjectTypeResolver(): ObjectTypeResolverInterface
    {
        return $this->getGeneralBlockObjectTypeResolver();
    }

    protected function getTargetObjectClass(): string
    {
        return GeneralBlock::class;
    }
}
