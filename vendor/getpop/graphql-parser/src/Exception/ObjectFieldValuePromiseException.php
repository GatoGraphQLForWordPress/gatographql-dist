<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\Exception;

use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\Root\Feedback\FeedbackItemResolution;
/** @internal */
final class ObjectFieldValuePromiseException extends \PoP\GraphQLParser\Exception\AbstractValueResolutionPromiseException
{
    public function __construct(FeedbackItemResolution $feedbackItemResolution, private readonly FieldInterface $field)
    {
        parent::__construct($feedbackItemResolution, $field);
    }
    public function getField() : FieldInterface
    {
        return $this->field;
    }
}
