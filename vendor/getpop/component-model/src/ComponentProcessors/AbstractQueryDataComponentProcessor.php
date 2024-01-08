<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ComponentProcessors;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\QueryInputOutputHandlers\ActionExecutionQueryInputOutputHandler;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
/** @internal */
abstract class AbstractQueryDataComponentProcessor extends \PoP\ComponentModel\ComponentProcessors\AbstractFilterDataComponentProcessor implements \PoP\ComponentModel\ComponentProcessors\QueryDataComponentProcessorInterface
{
    use \PoP\ComponentModel\ComponentProcessors\QueryDataComponentProcessorTrait;
    /**
     * @var \PoP\ComponentModel\QueryInputOutputHandlers\ActionExecutionQueryInputOutputHandler|null
     */
    private $actionExecutionQueryInputOutputHandler;
    public final function setActionExecutionQueryInputOutputHandler(ActionExecutionQueryInputOutputHandler $actionExecutionQueryInputOutputHandler) : void
    {
        $this->actionExecutionQueryInputOutputHandler = $actionExecutionQueryInputOutputHandler;
    }
    protected final function getActionExecutionQueryInputOutputHandler() : ActionExecutionQueryInputOutputHandler
    {
        if ($this->actionExecutionQueryInputOutputHandler === null) {
            /** @var ActionExecutionQueryInputOutputHandler */
            $actionExecutionQueryInputOutputHandler = $this->instanceManager->getInstance(ActionExecutionQueryInputOutputHandler::class);
            $this->actionExecutionQueryInputOutputHandler = $actionExecutionQueryInputOutputHandler;
        }
        return $this->actionExecutionQueryInputOutputHandler;
    }
    /**
     * @param array<string,mixed> $props
     * @param array<string,mixed> $data_properties
     * @param string|int|array<string|int> $objectIDOrIDs
     * @param array<string,mixed>|null $executed
     * @return array<string,mixed>
     */
    public function getDatasetmeta(Component $component, array &$props, array $data_properties, ?FeedbackItemResolution $dataaccess_checkpoint_validation, ?FeedbackItemResolution $actionexecution_checkpoint_validation, ?array $executed, $objectIDOrIDs) : array
    {
        $ret = parent::getDatasetmeta($component, $props, $data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $objectIDOrIDs);
        $ret = $this->addQueryHandlerDatasetmeta($ret, $component, $props, $data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $objectIDOrIDs);
        return $ret;
    }
}
