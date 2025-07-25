<?php

declare(strict_types=1);

namespace PoPWPSchema\Blocks\FieldResolvers\ObjectType;

use GatoGraphQL\GatoGraphQL\App;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FeedbackItemProviders\GenericFeedbackItemProvider;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\TypeResolvers\ScalarType\JSONObjectScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\AbstractCustomPostObjectTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\InputObjectType\IncludeExcludeFilterInputObjectTypeResolver;
use PoPWPSchema\BlockContentParser\BlockContentParserInterface;
use PoPWPSchema\BlockContentParser\Exception\BlockContentParserException;
use PoPWPSchema\Blocks\Constants\HookNames;
use PoPWPSchema\Blocks\ObjectModels\BlockInterface;
use PoPWPSchema\Blocks\ObjectModels\GeneralBlock;
use PoPWPSchema\Blocks\TypeHelpers\BlockUnionTypeHelpers;
use stdClass;
use WP_Post;

class CustomPostObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    /**
     * @var \PoPWPSchema\BlockContentParser\BlockContentParserInterface|null
     */
    private $blockContentParser;
    /**
     * @var \PoP\Engine\TypeResolvers\ScalarType\JSONObjectScalarTypeResolver|null
     */
    private $jsonObjectScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\InputObjectType\IncludeExcludeFilterInputObjectTypeResolver|null
     */
    private $includeExcludeFilterInputObjectTypeResolver;

    final protected function getBlockContentParser(): BlockContentParserInterface
    {
        if ($this->blockContentParser === null) {
            /** @var BlockContentParserInterface */
            $blockContentParser = $this->instanceManager->getInstance(BlockContentParserInterface::class);
            $this->blockContentParser = $blockContentParser;
        }
        return $this->blockContentParser;
    }
    final protected function getJSONObjectScalarTypeResolver(): JSONObjectScalarTypeResolver
    {
        if ($this->jsonObjectScalarTypeResolver === null) {
            /** @var JSONObjectScalarTypeResolver */
            $jsonObjectScalarTypeResolver = $this->instanceManager->getInstance(JSONObjectScalarTypeResolver::class);
            $this->jsonObjectScalarTypeResolver = $jsonObjectScalarTypeResolver;
        }
        return $this->jsonObjectScalarTypeResolver;
    }
    final protected function getIncludeExcludeFilterInputObjectTypeResolver(): IncludeExcludeFilterInputObjectTypeResolver
    {
        if ($this->includeExcludeFilterInputObjectTypeResolver === null) {
            /** @var IncludeExcludeFilterInputObjectTypeResolver */
            $includeExcludeFilterInputObjectTypeResolver = $this->instanceManager->getInstance(IncludeExcludeFilterInputObjectTypeResolver::class);
            $this->includeExcludeFilterInputObjectTypeResolver = $includeExcludeFilterInputObjectTypeResolver;
        }
        return $this->includeExcludeFilterInputObjectTypeResolver;
    }

    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            AbstractCustomPostObjectTypeResolver::class,
        ];
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'blocks',
            'blockDataItems',
            'blockFlattenedDataItems',
        ];
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        switch ($fieldName) {
            case 'blocks':
                return $this->__('(Gutenberg) Blocks in a custom post', 'blocks');
            case 'blockDataItems':
                return $this->__('(Gutenberg) Block data items (as JSON objects) in a custom post', 'blocks');
            case 'blockFlattenedDataItems':
                return $this->__('(Gutenberg) Flattened array containing the block data items (as JSON objects) in a custom post, and replacing property \'innerBlocks\' with \'innerBlockPositions\', indicating the position of the inner blocks in the array (starting from 0)', 'blocks');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'blocks':
                return BlockUnionTypeHelpers::getBlockUnionOrTargetObjectTypeResolver();
            case 'blockDataItems':
            case 'blockFlattenedDataItems':
                return $this->getJSONObjectScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }

    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): int
    {
        switch ($fieldName) {
            case 'blocks':
            case 'blockDataItems':
            case 'blockFlattenedDataItems':
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }

    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): array
    {
        $fieldArgNameTypeResolvers = parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        switch ($fieldName) {
            case 'blocks':
            case 'blockDataItems':
            case 'blockFlattenedDataItems':
                return array_merge(
                    $fieldArgNameTypeResolvers,
                    [
                        'filterBy' => $this->getIncludeExcludeFilterInputObjectTypeResolver(),
                    ]
                );
            default:
                return $fieldArgNameTypeResolvers;
        }
    }

    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        /** @var WP_Post */
        $customPost = $object;
        $fieldName = $fieldDataAccessor->getFieldName();
        switch ($fieldName) {
            case 'blocks':
            case 'blockDataItems':
            case 'blockFlattenedDataItems':
                /** @var stdClass|null */
                $filterBy = $fieldDataAccessor->getValue('filterBy');

                $options = [];

                /**
                 * Add the filtering options.
                 *
                 * Field "blockFlattenedDataItems" will do its own filtering
                 * at the end, as to retrieve all blocks all the way down
                 * to the last level.
                 *
                 * i.e. When filtering by "core/heading":
                 *
                 *   - "blocks" and "blockDataItems" will exclude these blocks
                 *     if they are innerBlocks inside "core/column"
                 *   - "blockFlattenedDataItems" will retrieve all blocks, flatten them,
                 *     and only then apply the filtering, hence innerBlocks in inside
                 *     "core/column" will also show up
                 */
                if (
                    in_array($fieldName, [
                    'blocks',
                    'blockDataItems'
                    ])
                ) {
                    $filterOptions = [];
                    if (isset($filterBy->include)) {
                        $filterOptions['include'] = $filterBy->include;
                    } elseif (isset($filterBy->exclude)) {
                        $filterOptions['exclude'] = $filterBy->exclude;
                    }
                    $options['filter'] = $filterOptions;

                    if ($fieldName === 'blocks') {
                        $options['include-inner-content'] = true;
                    }
                }

                $blockContentParserPayload = null;
                try {
                    $blockContentParserPayload = $this->getBlockContentParser()->parseCustomPostIntoBlockDataItems($customPost, $options);
                } catch (BlockContentParserException $e) {
                    $objectTypeFieldResolutionFeedbackStore->addError(
                        new ObjectTypeFieldResolutionFeedback(
                            new FeedbackItemResolution(
                                GenericFeedbackItemProvider::class,
                                GenericFeedbackItemProvider::E1,
                                [
                                    $e->getMessage(),
                                ]
                            ),
                            $fieldDataAccessor->getField(),
                        )
                    );
                    return null;
                }

                if ($blockContentParserPayload === null) {
                    return $blockContentParserPayload;
                }

                if ($blockContentParserPayload->warnings !== null) {
                    foreach ($blockContentParserPayload->warnings as $warning) {
                        $objectTypeFieldResolutionFeedbackStore->addWarning(
                            new ObjectTypeFieldResolutionFeedback(
                                new FeedbackItemResolution(
                                    GenericFeedbackItemProvider::class,
                                    GenericFeedbackItemProvider::W1,
                                    [
                                        $warning,
                                    ]
                                ),
                                $fieldDataAccessor->getField(),
                            )
                        );
                    }
                }

                if ($fieldName === 'blocks') {
                    /** @var BlockInterface[] */
                    $blocks = array_map(
                        \Closure::fromCallable([$this, 'createBlock']),
                        $blockContentParserPayload->blocks
                    );
                    return array_map(
                        function (BlockInterface $block) {
                            return $block->getID();
                        },
                        $blocks
                    );
                }

                if ($fieldName === 'blockDataItems') {
                    return $blockContentParserPayload->blocks;
                }

                /**
                 * $fieldName = 'blockFlattenedDataItems'
                 *
                 * Traverse the "innerBlocks" property in each block, and:
                 *
                 *   - Bring those Blocks upward
                 *   - Replace property "innerBlocks" with a corresponding
                 *     "innerBlockPositions" one, indicating where those blocks
                 *     are placed in the resulting array.
                 *   - Add property "parentBlockPosition", with value `null`
                 *     for the first level of Blocks, or the position in the array
                 *     otherwise
                 *
                 * @var stdClass[]
                 */
                $stack = $blockContentParserPayload->blocks;
                /**
                 * @var stdClass[]
                 */
                $blockDataItems = [];
                $pos = 0;
                while ($stack !== []) {
                    $blockDataItem = array_shift($stack);

                    /** @var stdClass[]|null */
                    $blockDataItemInnerBlocks = $blockDataItem->innerBlocks ?? null;
                    unset($blockDataItem->innerBlocks);

                    if ($blockDataItemInnerBlocks !== null) {
                        /**
                         * Initialize the property, it will be filled by the
                         * children when they know their position in the array
                         */
                        $blockDataItem->innerBlockPositions = [];

                        /**
                         * Set the "parentBlockPosition" on all innerBlocks
                         */
                        foreach ($blockDataItemInnerBlocks as &$innerBlockDataItem) {
                            $innerBlockDataItem->parentBlockPosition = $pos;
                        }
                    } else {
                        $blockDataItem->innerBlockPositions = null;
                    }

                    /**
                     * The first level of Blocks will set "parentBlockPosition" as `null`.
                     * If it is an innerBlock, it will have the "parentBlockPosition"
                     * already set.
                     */
                    if (isset($blockDataItem->parentBlockPosition)) {
                        $blockDataItems[$blockDataItem->parentBlockPosition]->innerBlockPositions[] = $pos;
                    } else {
                        $blockDataItem->parentBlockPosition = null;
                    }

                    /**
                     * Add the innerBlocks to the stack
                     */
                    if ($blockDataItemInnerBlocks !== null) {
                        $stack = array_merge(
                            // First place the innerBlocks in the stack, so they are all together
                            $blockDataItemInnerBlocks,
                            $stack,
                        );
                    }

                    // Add the block to the response, and keep iterating
                    $blockDataItems[] = $blockDataItem;
                    $pos++;
                }

                /**
                 * The filtering is done only now, as to retrieve all
                 * blocks all the way down to the last level (see PHPDoc above)
                 */
                if (isset($filterBy->include) || isset($filterBy->exclude)) {
                    if (isset($filterBy->include)) {
                        /** @var string[] */
                        $includeBlockNames = $filterBy->include;
                        $blockDataItems = array_values(array_filter(
                            $blockDataItems,
                            function (stdClass $blockDataItemItem) use ($includeBlockNames) {
                                return in_array($blockDataItemItem->name, $includeBlockNames);
                            }
                        ));
                    } elseif (isset($filterBy->exclude)) {
                        /** @var string[] */
                        $excludeBlockNames = $filterBy->exclude;
                        $blockDataItems = array_values(array_filter(
                            $blockDataItems,
                            function (stdClass $blockDataItemItem) use ($excludeBlockNames) {
                                return !in_array($blockDataItemItem->name, $excludeBlockNames);
                            }
                        ));
                    }

                    /**
                     * Remove the "parentBlockPosition" and "innerBlockPositions" properties,
                     * as they make no sense anymore (they might point to a position that does
                     * not exist, or is now occupied by a different block)
                     */
                    foreach ($blockDataItems as &$blockDataItem) {
                        unset($blockDataItem->parentBlockPosition);
                        unset($blockDataItem->innerBlockPositions);
                    }
                }

                return $blockDataItems;
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }

    /**
     * Given the name, attributes, and inner block data for a block,
     * create a Block object.
     */
    protected function createBlock(stdClass $blockItem): BlockInterface
    {
        /** @var string */
        $name = $blockItem->name;
        /** @var stdClass|null */
        $attributes = $blockItem->attributes ?? null;
        /** @var array<string|null> */
        $innerContent = $blockItem->innerContent;

        /** @var BlockInterface[]|null */
        $innerBlocks = null;
        if (isset($blockItem->innerBlocks)) {
            /** @var array<stdClass> */
            $blockInnerBlocks = $blockItem->innerBlocks;
            $innerBlocks = array_map(
                \Closure::fromCallable([$this, 'createBlock']),
                $blockInnerBlocks
            );
        }

        return $this->createBlockObject(
            $name,
            $attributes,
            $innerBlocks,
            $innerContent,
            $blockItem,
        );
    }

    /**
     * Allow to inject more specific blocks:
     *
     * - CoreParagraphBlock
     * - CoreMediaBlock
     * - CoreHeadingBlock
     * - etc
     *
     * By default, it creates a `GeneralBlock`.
     *
     * @param array<string|null> $innerContent
     * @param BlockInterface[]|null $innerBlocks
     */
    protected function createBlockObject(string $name, ?stdClass $attributes, ?array $innerBlocks, array $innerContent, stdClass $blockItem): BlockInterface
    {
        /** @var BlockInterface|null */
        $injectedBlockObject = App::applyFilters(
            HookNames::BLOCK_TYPE,
            null,
            $name,
            $attributes,
            $innerBlocks,
            $innerContent,
            $blockItem,
        );
        if ($injectedBlockObject !== null) {
            return $injectedBlockObject;
        }
        return new GeneralBlock(
            $name,
            $attributes,
            $innerBlocks,
            $innerContent,
            $blockItem,
        );
    }

    /**
     * Since the return type is known for all the fields in this
     * FieldResolver, there's no need to validate them
     */
    public function validateResolvedFieldType(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field): bool
    {
        return false;
    }
}
