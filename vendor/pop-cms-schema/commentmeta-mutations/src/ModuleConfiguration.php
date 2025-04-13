<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations;

use PoP\Root\Module\AbstractModuleConfiguration;
use PoP\Root\Module\EnvironmentValueHelpers;
/** @internal */
class ModuleConfiguration extends AbstractModuleConfiguration
{
    /**
     * Indicate if to return the errors in an ObjectMutationPayload
     * object in the response, or if to use the top-level errors.
     */
    public function usePayloadableCommentMetaMutations() : bool
    {
        $envVariable = \PoPCMSSchema\CommentMetaMutations\Environment::USE_PAYLOADABLE_COMMENT_META_MUTATIONS;
        $defaultValue = \true;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
    public function addFieldsToQueryPayloadableCommentMetaMutations() : bool
    {
        if (!$this->usePayloadableCommentMetaMutations()) {
            return \false;
        }
        $envVariable = \PoPCMSSchema\CommentMetaMutations\Environment::ADD_FIELDS_TO_QUERY_PAYLOADABLE_COMMENT_META_MUTATIONS;
        $defaultValue = \false;
        $callback = \Closure::fromCallable([EnvironmentValueHelpers::class, 'toBool']);
        return $this->retrieveConfigurationValueOrUseDefault($envVariable, $defaultValue, $callback);
    }
}
