<?php

declare(strict_types=1);

namespace PoPWPSchema\Media\SchemaHooks;

use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\TypeResolvers\InputObjectType\HookNames;
use PoP\ComponentModel\TypeResolvers\InputObjectType\InputObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
use PoPCMSSchema\Media\TypeResolvers\InputObjectType\MediaItemByOneofInputObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\FilterInputs\SlugFilterInput;

class InputObjectTypeHookSet extends AbstractHookSet
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\SlugFilterInput|null
     */
    private $slugFilterInput;

    final protected function getStringScalarTypeResolver(): StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    final protected function getSlugFilterInput(): SlugFilterInput
    {
        if ($this->slugFilterInput === null) {
            /** @var SlugFilterInput */
            $slugFilterInput = $this->instanceManager->getInstance(SlugFilterInput::class);
            $this->slugFilterInput = $slugFilterInput;
        }
        return $this->slugFilterInput;
    }

    protected function init(): void
    {
        App::addFilter(
            HookNames::INPUT_FIELD_NAME_TYPE_RESOLVERS,
            \Closure::fromCallable([$this, 'getInputFieldNameTypeResolvers']),
            10,
            2
        );
        App::addFilter(
            HookNames::INPUT_FIELD_DESCRIPTION,
            \Closure::fromCallable([$this, 'getInputFieldDescription']),
            10,
            3
        );
        App::addFilter(
            HookNames::INPUT_FIELD_FILTER_INPUT,
            \Closure::fromCallable([$this, 'getInputFieldFilterInput']),
            10,
            3
        );
    }

    /**
     * @param array<string,InputTypeResolverInterface> $inputFieldNameTypeResolvers
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers(array $inputFieldNameTypeResolvers, InputObjectTypeResolverInterface $inputObjectTypeResolver): array
    {
        if (!($inputObjectTypeResolver instanceof MediaItemByOneofInputObjectTypeResolver)) {
            return $inputFieldNameTypeResolvers;
        }
        return array_merge(
            $inputFieldNameTypeResolvers,
            [
                'slug' => $this->getStringScalarTypeResolver(),
            ]
        );
    }

    public function getInputFieldDescription(
        ?string $inputFieldDescription,
        InputObjectTypeResolverInterface $inputObjectTypeResolver,
        string $inputFieldName
    ): ?string {
        if (!($inputObjectTypeResolver instanceof MediaItemByOneofInputObjectTypeResolver)) {
            return $inputFieldDescription;
        }
        switch ($inputFieldName) {
            case 'slug':
                return $this->__('Query media item by slug', 'media');
            default:
                return $inputFieldDescription;
        }
    }

    public function getInputFieldFilterInput(?FilterInputInterface $inputFieldFilterInput, InputObjectTypeResolverInterface $inputObjectTypeResolver, string $inputFieldName): ?FilterInputInterface
    {
        if (!($inputObjectTypeResolver instanceof MediaItemByOneofInputObjectTypeResolver)) {
            return $inputFieldFilterInput;
        }
        switch ($inputFieldName) {
            case 'slug':
                return $this->getSlugFilterInput();
            default:
                return $inputFieldFilterInput;
        }
    }
}
