<?php

declare (strict_types=1);
namespace PoP\ComponentModel\GraphQLParser\ExtendedSpec\Parser;

use PoP\ComponentModel\DirectiveResolvers\FieldDirectiveResolverInterface;
use PoP\ComponentModel\DirectiveResolvers\DynamicVariableDefinerFieldDirectiveResolverInterface;
use PoP\ComponentModel\DirectiveResolvers\MetaFieldDirectiveResolverInterface;
use PoP\ComponentModel\ExtendedSpec\Parser\Ast\Document;
use PoP\ComponentModel\Registries\FieldDirectiveResolverRegistryInterface;
use PoP\ComponentModel\Registries\DynamicVariableDefinerDirectiveRegistryInterface;
use PoP\ComponentModel\Registries\MetaDirectiveRegistryInterface;
use PoP\GraphQLParser\ExtendedSpec\Parser\AbstractParser;
use PoP\GraphQLParser\ExtendedSpec\Parser\Ast\AbstractDocument;
use PoP\GraphQLParser\Spec\Parser\Ast\Argument;
use PoP\GraphQLParser\Spec\Parser\Ast\Directive;
use PoP\GraphQLParser\Spec\Parser\Ast\Fragment;
use PoP\GraphQLParser\Spec\Parser\Ast\OperationInterface;
use PoP\Root\Facades\Instances\InstanceManagerFacade;
/** @internal */
class Parser extends AbstractParser
{
    /**
     * @var \PoP\ComponentModel\Registries\MetaDirectiveRegistryInterface|null
     */
    private $metaDirectiveRegistry;
    /**
     * @var \PoP\ComponentModel\Registries\DynamicVariableDefinerDirectiveRegistryInterface|null
     */
    private $dynamicVariableDefinerDirectiveRegistry;
    /**
     * @var \PoP\ComponentModel\Registries\FieldDirectiveResolverRegistryInterface|null
     */
    private $fieldDirectiveResolverRegistry;
    protected final function getMetaDirectiveRegistry() : MetaDirectiveRegistryInterface
    {
        if ($this->metaDirectiveRegistry === null) {
            /** @var MetaDirectiveRegistryInterface */
            $metaDirectiveRegistry = InstanceManagerFacade::getInstance()->getInstance(MetaDirectiveRegistryInterface::class);
            $this->metaDirectiveRegistry = $metaDirectiveRegistry;
        }
        return $this->metaDirectiveRegistry;
    }
    protected final function getDynamicVariableDefinerDirectiveRegistry() : DynamicVariableDefinerDirectiveRegistryInterface
    {
        if ($this->dynamicVariableDefinerDirectiveRegistry === null) {
            /** @var DynamicVariableDefinerDirectiveRegistryInterface */
            $dynamicVariableDefinerDirectiveRegistry = InstanceManagerFacade::getInstance()->getInstance(DynamicVariableDefinerDirectiveRegistryInterface::class);
            $this->dynamicVariableDefinerDirectiveRegistry = $dynamicVariableDefinerDirectiveRegistry;
        }
        return $this->dynamicVariableDefinerDirectiveRegistry;
    }
    protected final function getFieldDirectiveResolverRegistry() : FieldDirectiveResolverRegistryInterface
    {
        if ($this->fieldDirectiveResolverRegistry === null) {
            /** @var FieldDirectiveResolverRegistryInterface */
            $fieldDirectiveResolverRegistry = InstanceManagerFacade::getInstance()->getInstance(FieldDirectiveResolverRegistryInterface::class);
            $this->fieldDirectiveResolverRegistry = $fieldDirectiveResolverRegistry;
        }
        return $this->fieldDirectiveResolverRegistry;
    }
    protected function isMetaDirective(string $directiveName) : bool
    {
        $metaFieldDirectiveResolver = $this->getMetaFieldDirectiveResolver($directiveName);
        return $metaFieldDirectiveResolver !== null;
    }
    protected function getMetaFieldDirectiveResolver(string $directiveName) : ?MetaFieldDirectiveResolverInterface
    {
        return $this->getMetaDirectiveRegistry()->getMetaFieldDirectiveResolver($directiveName);
    }
    protected function getAffectDirectivesUnderPosArgument(Directive $directive) : ?Argument
    {
        /** @var MetaFieldDirectiveResolverInterface */
        $metaFieldDirectiveResolver = $this->getMetaFieldDirectiveResolver($directive->getName());
        $affectDirectivesUnderPosArgumentName = $metaFieldDirectiveResolver->getAffectDirectivesUnderPosArgumentName();
        foreach ($directive->getArguments() as $argument) {
            if ($argument->getName() !== $affectDirectivesUnderPosArgumentName) {
                continue;
            }
            return $argument;
        }
        return null;
    }
    /**
     * @return int[]
     */
    protected function getAffectDirectivesUnderPosArgumentDefaultValue(Directive $directive) : array
    {
        /** @var MetaFieldDirectiveResolverInterface */
        $metaFieldDirectiveResolver = $this->getMetaFieldDirectiveResolver($directive->getName());
        return $metaFieldDirectiveResolver->getAffectDirectivesUnderPosArgumentDefaultValue();
    }
    /**
     * @param OperationInterface[] $operations
     * @param Fragment[] $fragments
     */
    protected function createDocumentInstance(array $operations, array $fragments) : AbstractDocument
    {
        return new Document($operations, $fragments);
    }
    protected function getFieldDirectiveResolver(string $directiveName) : ?FieldDirectiveResolverInterface
    {
        return $this->getFieldDirectiveResolverRegistry()->getFieldDirectiveResolver($directiveName);
    }
    protected function isDynamicVariableDefinerDirective(Directive $directive) : bool
    {
        return $this->getDynamicVariableDefinerFieldDirectiveResolver($directive) !== null;
    }
    protected function getDynamicVariableDefinerFieldDirectiveResolver(Directive $directive) : ?DynamicVariableDefinerFieldDirectiveResolverInterface
    {
        return $this->getDynamicVariableDefinerDirectiveRegistry()->getDynamicVariableDefinerFieldDirectiveResolver($directive->getName());
    }
    /**
     * @return Argument[]|null
     */
    protected function getExportUnderVariableNameArguments(Directive $directive) : ?array
    {
        $dynamicVariableDefinerFieldDirectiveResolver = $this->getDynamicVariableDefinerFieldDirectiveResolver($directive);
        if ($dynamicVariableDefinerFieldDirectiveResolver === null) {
            return null;
        }
        $exportUnderVariableNameArgumentNames = $dynamicVariableDefinerFieldDirectiveResolver->getExportUnderVariableNameArgumentNames();
        return \array_values(\array_filter(\array_map(function (string $exportUnderVariableNameArgumentName) use($directive) {
            return $directive->getArgument($exportUnderVariableNameArgumentName);
        }, $exportUnderVariableNameArgumentNames)));
    }
    protected function getAffectAdditionalFieldsUnderPosArgumentName(Directive $directive) : ?string
    {
        $directiveResolver = $this->getFieldDirectiveResolver($directive->getName());
        if ($directiveResolver === null) {
            return null;
        }
        return $directiveResolver->getAffectAdditionalFieldsUnderPosArgumentName();
    }
    protected function mustResolveDynamicVariableOnObject(Directive $directive) : ?bool
    {
        $dynamicVariableDefinerFieldDirectiveResolver = $this->getDynamicVariableDefinerFieldDirectiveResolver($directive);
        if ($dynamicVariableDefinerFieldDirectiveResolver === null) {
            return null;
        }
        return $dynamicVariableDefinerFieldDirectiveResolver->mustResolveDynamicVariableOnObject();
    }
}
