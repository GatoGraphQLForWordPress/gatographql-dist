<?php

declare (strict_types=1);
namespace PoP\Engine\DirectiveResolvers;

use PoP\ComponentModel\Checkpoints\CheckpointInterface;
use PoP\ComponentModel\Engine\EngineInterface;
use PoP\ComponentModel\Engine\EngineIterationFieldSet;
use PoP\ComponentModel\Feedback\EngineIterationFeedbackStore;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use SplObjectStorage;
/** @internal */
abstract class AbstractCheckpointValidateConditionFieldDirectiveResolver extends \PoP\Engine\DirectiveResolvers\AbstractValidateConditionFieldDirectiveResolver
{
    /**
     * @var \PoP\ComponentModel\Engine\EngineInterface|null
     */
    private $engine;
    public final function setEngine(EngineInterface $engine) : void
    {
        $this->engine = $engine;
    }
    protected final function getEngine() : EngineInterface
    {
        if ($this->engine === null) {
            /** @var EngineInterface */
            $engine = $this->instanceManager->getInstance(EngineInterface::class);
            $this->engine = $engine;
        }
        return $this->engine;
    }
    /**
     * @param array<string|int,EngineIterationFieldSet> $idFieldSet
     * @param array<string|int,SplObjectStorage<FieldInterface,mixed>> $resolvedIDFieldValues
     * @param array<array<string|int,EngineIterationFieldSet>> $succeedingPipelineIDFieldSet
     */
    protected function isValidationSuccessful(RelationalTypeResolverInterface $relationalTypeResolver, array $idFieldSet, array &$succeedingPipelineIDFieldSet, array &$resolvedIDFieldValues, EngineIterationFeedbackStore $engineIterationFeedbackStore) : bool
    {
        $checkpoints = $this->getValidationCheckpoints($relationalTypeResolver);
        $feedbackItemResolution = $this->getEngine()->validateCheckpoints($checkpoints);
        return $feedbackItemResolution === null;
    }
    /**
     * Provide the checkpoint to validate
     *
     * @return CheckpointInterface[]
     */
    protected abstract function getValidationCheckpoints(RelationalTypeResolverInterface $relationalTypeResolver) : array;
}
