<?php

declare (strict_types=1);
namespace PoP\Root\Feedback;

use PoP\Root\Facades\Instances\InstanceManagerFacade;
use PoP\Root\FeedbackItemProviders\FeedbackItemProviderInterface;
use PoP\Root\Services\StandaloneServiceTrait;
/** @internal */
class FeedbackItemResolution
{
    /**
     * @var string
     */
    protected $feedbackProviderServiceClass;
    /**
     * @var string
     */
    protected $code;
    /**
     * @var array<(string | int | float | bool)>
     */
    protected $messageParams = [];
    use StandaloneServiceTrait;
    /**
     * @phpstan-param class-string<FeedbackItemProviderInterface> $feedbackProviderServiceClass
     * @param array<string|int|float|bool> $messageParams
     */
    public function __construct(string $feedbackProviderServiceClass, string $code, array $messageParams = [])
    {
        $this->feedbackProviderServiceClass = $feedbackProviderServiceClass;
        $this->code = $code;
        /** @var array<string|int|float|bool> */
        $this->messageParams = $messageParams;
    }
    /**
     * @return class-string<FeedbackItemProviderInterface>
     */
    public function getFeedbackProviderServiceClass() : string
    {
        return $this->feedbackProviderServiceClass;
    }
    public function getCode() : string
    {
        return $this->code;
    }
    /**
     * @return array<string|int|float|bool>
     */
    public function getMessageParams() : array
    {
        return $this->messageParams;
    }
    public final function getFeedbackItemProvider() : FeedbackItemProviderInterface
    {
        /** @var FeedbackItemProviderInterface */
        return InstanceManagerFacade::getInstance()->getInstance($this->feedbackProviderServiceClass);
    }
    public final function getMessage() : string
    {
        $feedbackItemProvider = $this->getFeedbackItemProvider();
        return $feedbackItemProvider->getMessage($this->code, ...$this->messageParams);
    }
    public final function getNamespacedCode() : string
    {
        $feedbackItemProvider = $this->getFeedbackItemProvider();
        return $feedbackItemProvider->getNamespacedCode($this->code);
    }
    public final function getSpecifiedByURL() : ?string
    {
        $feedbackItemProvider = $this->getFeedbackItemProvider();
        return $feedbackItemProvider->getSpecifiedByURL($this->code);
    }
}
