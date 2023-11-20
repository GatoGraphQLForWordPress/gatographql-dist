<?php

declare (strict_types=1);
namespace PoPSchema\DirectiveCommons\ObjectModels;

use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
/** @internal */
class TypedDataValidationPayload
{
    /**
     * @readonly
     * @var \PoP\ComponentModel\Feedback\FeedbackItemResolution
     */
    public $feedbackItemResolution;
    /**
     * @readonly
     * @var \PoP\GraphQLParser\Spec\Parser\Ast\AstInterface|null
     */
    public $astNode;
    public function __construct(FeedbackItemResolution $feedbackItemResolution, ?AstInterface $astNode = null)
    {
        $this->feedbackItemResolution = $feedbackItemResolution;
        $this->astNode = $astNode;
    }
}
