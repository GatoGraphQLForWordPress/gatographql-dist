<?php

declare(strict_types=1);

namespace PoP\RootWP\Exception;

use PoP\Root\Exception\AbstractClientException;
use stdClass;
use Throwable;
use WP_Error;

/**
 * Abstract class to pass the error information
 * contained in class WP_Error
 */
abstract class AbstractWPErrorClientException extends AbstractClientException
{
    use WPErrorDataProcessorTrait;

    /**
     * @var int|string|null
     */
    public $errorCode;
    /**
     * @var \stdClass|null
     */
    public $data;

    public function __construct(
        WP_Error $wpError,
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        $this->errorCode = empty($wpError->get_error_code()) ? null : $wpError->get_error_code();
        $this->data = $this->getWPErrorData($wpError);
        parent::__construct($wpError->get_error_message(), $code, $previous);
    }

    /**
     * @return int|string|null
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getData(): ?stdClass
    {
        return $this->data;
    }
}
