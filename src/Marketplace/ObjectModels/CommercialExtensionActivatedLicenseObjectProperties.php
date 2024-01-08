<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Marketplace\ObjectModels;

class CommercialExtensionActivatedLicenseObjectProperties
{
    /**
     * @readonly
     * @var string
     */
    public $licenseKey;
    /**
     * @var array<string, mixed>
     * @readonly
     */
    public $apiResponsePayload;
    /**
     * @readonly
     * @var string
     */
    public $status;
    /**
     * @var string|null
     * @readonly
     */
    public $instanceID;
    /**
     * @var string|null
     * @readonly
     */
    public $instanceName;
    /**
     * @readonly
     * @var int
     */
    public $activationUsage;
    /**
     * @readonly
     * @var int
     */
    public $activationLimit;
    /**
     * @readonly
     * @var string
     */
    public $productName;
    /**
     * @readonly
     * @var string
     */
    public $customerName;
    /**
     * @readonly
     * @var string
     */
    public $customerEmail;
    /**
     * @param array<string,mixed> $apiResponsePayload
     * @param string|null $instanceID `null` for /deactivate, with value otherwise
     * @param string|null $instanceName `null` for /deactivate, with value otherwise
     */
    public function __construct(string $licenseKey, array $apiResponsePayload, string $status, ?string $instanceID, ?string $instanceName, int $activationUsage, int $activationLimit, string $productName, string $customerName, string $customerEmail)
    {
        $this->licenseKey = $licenseKey;
        $this->apiResponsePayload = $apiResponsePayload;
        $this->status = $status;
        $this->instanceID = $instanceID;
        $this->instanceName = $instanceName;
        $this->activationUsage = $activationUsage;
        $this->activationLimit = $activationLimit;
        $this->productName = $productName;
        $this->customerName = $customerName;
        $this->customerEmail = $customerEmail;
    }
}
