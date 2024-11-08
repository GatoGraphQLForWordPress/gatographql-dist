<?php

declare(strict_types=1);

namespace PoPWPSchema\Blocks\RelationalTypeDataLoaders\UnionType;

use PoPWPSchema\Blocks\TypeResolvers\UnionType\BlockUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;

class BlockUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPWPSchema\Blocks\TypeResolvers\UnionType\BlockUnionTypeResolver|null
     */
    private $blockUnionTypeResolver;

    final protected function getBlockUnionTypeResolver(): BlockUnionTypeResolver
    {
        if ($this->blockUnionTypeResolver === null) {
            /** @var BlockUnionTypeResolver */
            $blockUnionTypeResolver = $this->instanceManager->getInstance(BlockUnionTypeResolver::class);
            $this->blockUnionTypeResolver = $blockUnionTypeResolver;
        }
        return $this->blockUnionTypeResolver;
    }

    protected function getUnionTypeResolver(): UnionTypeResolverInterface
    {
        return $this->getBlockUnionTypeResolver();
    }
}
