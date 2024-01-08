<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\Exception\Parser;

use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use PoP\Root\Feedback\FeedbackItemResolution;
/** @internal */
abstract class AbstractASTNodeParserException extends \PoP\GraphQLParser\Exception\Parser\AbstractParserException
{
    /**
     * @readonly
     * @var \PoP\GraphQLParser\Spec\Parser\Ast\AstInterface
     */
    private $astNode;
    public function __construct(FeedbackItemResolution $feedbackItemResolution, AstInterface $astNode)
    {
        $this->astNode = $astNode;
        parent::__construct($feedbackItemResolution, $astNode->getLocation());
    }
    public function getAstNode() : AstInterface
    {
        return $this->astNode;
    }
}
