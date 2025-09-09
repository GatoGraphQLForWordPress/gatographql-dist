<?php

declare (strict_types=1);
namespace PoP\GraphQLParser\Spec\Parser;

use PoP\GraphQLParser\Exception\FeatureNotSupportedException;
use PoP\GraphQLParser\Exception\Parser\SyntaxErrorParserException;
use PoP\GraphQLParser\Exception\Parser\UnsupportedSyntaxErrorParserException;
use PoP\GraphQLParser\FeedbackItemProviders\GraphQLParserErrorFeedbackItemProvider;
use PoP\GraphQLParser\FeedbackItemProviders\GraphQLSpecErrorFeedbackItemProvider;
use PoP\GraphQLParser\FeedbackItemProviders\GraphQLUnsupportedFeatureErrorFeedbackItemProvider;
use PoP\GraphQLParser\Spec\Parser\Ast\Argument;
use PoP\GraphQLParser\Spec\Parser\Ast\ArgumentValue\Enum;
use PoP\GraphQLParser\Spec\Parser\Ast\ArgumentValue\InputList;
use PoP\GraphQLParser\Spec\Parser\Ast\ArgumentValue\InputObject;
use PoP\GraphQLParser\Spec\Parser\Ast\ArgumentValue\Literal;
use PoP\GraphQLParser\Spec\Parser\Ast\ArgumentValue\VariableReference;
use PoP\GraphQLParser\Spec\Parser\Ast\Directive;
use PoP\GraphQLParser\Spec\Parser\Ast\Document;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\Fragment;
use PoP\GraphQLParser\Spec\Parser\Ast\FragmentBondInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FragmentReference;
use PoP\GraphQLParser\Spec\Parser\Ast\InlineFragment;
use PoP\GraphQLParser\Spec\Parser\Ast\LeafField;
use PoP\GraphQLParser\Spec\Parser\Ast\MutationOperation;
use PoP\GraphQLParser\Spec\Parser\Ast\OperationInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\QueryOperation;
use PoP\GraphQLParser\Spec\Parser\Ast\RelationalField;
use PoP\GraphQLParser\Spec\Parser\Ast\SubscriptionOperation;
use PoP\GraphQLParser\Spec\Parser\Ast\Variable;
use PoP\GraphQLParser\Spec\Parser\Ast\WithValueInterface;
use PoP\Root\Feedback\FeedbackItemResolution;
use stdClass;
/** @internal */
class Parser extends \PoP\GraphQLParser\Spec\Parser\Tokenizer implements \PoP\GraphQLParser\Spec\Parser\ParserInterface
{
    /** @var OperationInterface[] */
    protected array $operations;
    /** @var Fragment[] */
    protected array $fragments;
    /** @var Variable[] */
    protected array $variables;
    /**
     * @throws SyntaxErrorParserException
     * @throws FeatureNotSupportedException
     * @throws UnsupportedSyntaxErrorParserException
     */
    public function parse(string $source) : Document
    {
        $this->init($source);
        while (!$this->end()) {
            $token = $this->peek();
            $tokenType = $token->getType();
            switch ($tokenType) {
                case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_LBRACE:
                case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_QUERY:
                case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_MUTATION:
                case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_SUBSCRIPTION:
                    $this->operations[] = $this->parseOperation($tokenType);
                    break;
                case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_FRAGMENT:
                    $this->fragments[] = $this->parseFragment();
                    break;
                default:
                    throw new SyntaxErrorParserException(new FeedbackItemResolution(GraphQLParserErrorFeedbackItemProvider::class, GraphQLParserErrorFeedbackItemProvider::E_1, [$this->lookAhead->getData()]), $this->getLocation());
            }
        }
        return $this->createDocument($this->operations, $this->fragments);
    }
    /**
     * @param OperationInterface[] $operations
     * @param Fragment[] $fragments
     */
    protected function createDocument(array $operations, array $fragments) : Document
    {
        return new Document($operations, $fragments);
    }
    protected function init(string $source) : void
    {
        $this->initTokenizer($source);
        $this->resetState();
    }
    protected function resetState() : void
    {
        $this->operations = [];
        $this->fragments = [];
        $this->variables = [];
    }
    /**
     * @throws UnsupportedSyntaxErrorParserException
     */
    protected function parseOperation(string $type) : OperationInterface
    {
        $directives = [];
        $variables = [];
        $this->variables = [];
        $this->beforeParsingOperation();
        $isShorthandQuery = $this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LBRACE);
        if ($isShorthandQuery) {
            $lbraceToken = $this->lex();
            /**
             * Query shorthand: it has no name, variables or directives
             * @see https://spec.graphql.org/draft/#sec-Language.Operations.Query-shorthand
             */
            $operationName = '';
            $operationLocation = $this->getTokenLocation($lbraceToken);
        } else {
            // Eat: $this->matchMulti([Token::TYPE_QUERY, Token::TYPE_MUTATION, Token::TYPE_SUBSCRIPTION])
            $this->lex();
            $operationToken = $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_IDENTIFIER);
            if ($operationToken !== null) {
                $operationName = (string) $operationToken->getData();
                $operationLocation = $this->getTokenLocation($operationToken);
            } else {
                $operationName = '';
                $operationLocation = $this->getLocation();
            }
            if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LPAREN)) {
                $variables = $this->parseVariables();
            }
            if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_AT)) {
                $directives = $this->parseDirectiveList();
            }
            $lbraceToken = $this->lex();
        }
        $this->afterParsingOperation();
        $fieldsOrFragmentBonds = [];
        $this->beforeParsingFieldsOrFragmentBonds();
        while (!$this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RBRACE) && !$this->end()) {
            $this->eatMulti([\PoP\GraphQLParser\Spec\Parser\Token::TYPE_COMMA]);
            $fieldOrFragmentBond = $this->parseBodyItem($type);
            $fieldsOrFragmentBonds[] = $fieldOrFragmentBond;
        }
        $this->afterParsingFieldsOrFragmentBonds();
        $this->expect(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RBRACE);
        if ($type === \PoP\GraphQLParser\Spec\Parser\Token::TYPE_MUTATION) {
            return $this->createMutationOperation($operationName, $variables, $directives, $fieldsOrFragmentBonds, $operationLocation);
        }
        if ($type === \PoP\GraphQLParser\Spec\Parser\Token::TYPE_SUBSCRIPTION) {
            return $this->createSubscriptionOperation($operationName, $variables, $directives, $fieldsOrFragmentBonds, $operationLocation);
        }
        return $this->createQueryOperation($operationName, $variables, $directives, $fieldsOrFragmentBonds, $operationLocation);
    }
    /**
     * @param Variable[] $variables
     * @param Directive[] $directives
     * @param array<FieldInterface|FragmentBondInterface> $fieldsOrFragmentBonds
     */
    protected function createQueryOperation(string $name, array $variables, array $directives, array $fieldsOrFragmentBonds, \PoP\GraphQLParser\Spec\Parser\Location $location) : QueryOperation
    {
        return new QueryOperation($name, $variables, $directives, $fieldsOrFragmentBonds, $location);
    }
    /**
     * @param Variable[] $variables
     * @param Directive[] $directives
     * @param array<FieldInterface|FragmentBondInterface> $fieldsOrFragmentBonds
     */
    protected function createMutationOperation(string $name, array $variables, array $directives, array $fieldsOrFragmentBonds, \PoP\GraphQLParser\Spec\Parser\Location $location) : MutationOperation
    {
        return new MutationOperation($name, $variables, $directives, $fieldsOrFragmentBonds, $location);
    }
    /**
     * @param Variable[] $variables
     * @param Directive[] $directives
     * @param array<FieldInterface|FragmentBondInterface> $fieldsOrFragmentBonds
     */
    protected function createSubscriptionOperation(string $name, array $variables, array $directives, array $fieldsOrFragmentBonds, \PoP\GraphQLParser\Spec\Parser\Location $location) : SubscriptionOperation
    {
        return new SubscriptionOperation($name, $variables, $directives, $fieldsOrFragmentBonds, $location);
    }
    /**
     * @return array<FieldInterface|FragmentBondInterface>
     */
    protected function parseBody(string $token) : array
    {
        $fieldsOrFragmentBonds = [];
        $this->lex();
        while (!$this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RBRACE) && !$this->end()) {
            $this->eatMulti([\PoP\GraphQLParser\Spec\Parser\Token::TYPE_COMMA]);
            if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_FRAGMENT_REFERENCE)) {
                $this->lex();
                if ($this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_ON)) {
                    $fieldsOrFragmentBonds[] = $this->parseBodyItem(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_INLINE_FRAGMENT);
                } else {
                    $fieldsOrFragmentBonds[] = $this->parseFragmentReference();
                }
            } else {
                $fieldsOrFragmentBonds[] = $this->parseBodyItem($token);
            }
        }
        $this->expect(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RBRACE);
        return $fieldsOrFragmentBonds;
    }
    /**
     * @return Variable[]
     * @throws UnsupportedSyntaxErrorParserException
     */
    protected function parseVariables() : array
    {
        $variables = [];
        $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LPAREN);
        while (!$this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RPAREN) && !$this->end()) {
            $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_COMMA);
            /** @var Token|null */
            $variableToken = $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_VARIABLE);
            if ($variableToken === null) {
                // If the variable doesn't start with "$" => syntax error
                throw $this->createUnexpectedException($this->peek());
            }
            $nameToken = $this->eatIdentifierToken();
            $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_COLON);
            $isArray = \false;
            $isArrayElementRequired = \false;
            $isArrayOfArrays = \false;
            $isArrayOfArraysElementRequired = \false;
            if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LSQUARE_BRACE)) {
                $isArray = \true;
                $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LSQUARE_BRACE);
                if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LSQUARE_BRACE)) {
                    $isArrayOfArrays = \true;
                    $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LSQUARE_BRACE);
                    /**
                     * The GraphQL server currently supports receiving up to
                     * 2 levels of List cardinality (eg: [[String]]), so if any
                     * variable is defined surpassing this (eg: [[[String]]]),
                     * then return an error
                     */
                    if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LSQUARE_BRACE)) {
                        throw new UnsupportedSyntaxErrorParserException(new FeedbackItemResolution(GraphQLUnsupportedFeatureErrorFeedbackItemProvider::class, GraphQLUnsupportedFeatureErrorFeedbackItemProvider::E_4), $this->getTokenLocation($variableToken));
                    }
                    $type = $this->eatIdentifierToken()->getData();
                    if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_REQUIRED)) {
                        $isArrayOfArraysElementRequired = \true;
                        $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_REQUIRED);
                    }
                    $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RSQUARE_BRACE);
                } else {
                    $type = $this->eatIdentifierToken()->getData();
                }
                if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_REQUIRED)) {
                    $isArrayElementRequired = \true;
                    $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_REQUIRED);
                }
                $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RSQUARE_BRACE);
            } else {
                $type = $this->eatIdentifierToken()->getData();
            }
            $isRequired = \false;
            if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_REQUIRED)) {
                $isRequired = \true;
                $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_REQUIRED);
            }
            $directives = [];
            if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_AT)) {
                $directives = $this->parseDirectiveList();
            }
            $variable = $this->createVariable((string) $nameToken->getData(), (string) $type, $isRequired, $isArray, $isArrayElementRequired, $isArrayOfArrays, $isArrayOfArraysElementRequired, $directives, $this->getTokenLocation($variableToken));
            if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_EQUAL)) {
                $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_EQUAL);
                /** @var InputList|InputObject|Literal|Enum */
                $defaultValueAst = $this->parseValue();
                $variable->setDefaultValueAST($defaultValueAst);
            }
            $this->variables[] = $variable;
            $variables[] = $variable;
        }
        $this->expect(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RPAREN);
        return $variables;
    }
    protected function getTokenLocation(\PoP\GraphQLParser\Spec\Parser\Token $token) : \PoP\GraphQLParser\Spec\Parser\Location
    {
        return new \PoP\GraphQLParser\Spec\Parser\Location($token->getLine(), $token->getColumn());
    }
    /**
     * @param Directive[] $directives
     */
    protected function createVariable(string $name, string $type, bool $isRequired, bool $isArray, bool $isArrayElementRequired, bool $isArrayOfArrays, bool $isArrayOfArraysElementRequired, array $directives, \PoP\GraphQLParser\Spec\Parser\Location $location) : Variable
    {
        return new Variable($name, $type, $isRequired, $isArray, $isArrayElementRequired, $isArrayOfArrays, $isArrayOfArraysElementRequired, $directives, $location);
    }
    /**
     * @param string[] $types
     * @throws SyntaxErrorParserException
     */
    protected function expectMulti(array $types) : \PoP\GraphQLParser\Spec\Parser\Token
    {
        if ($this->matchMulti($types)) {
            return $this->lex();
        }
        throw $this->createUnexpectedException($this->peek());
    }
    /**
     * @throws SyntaxErrorParserException
     */
    protected function parseVariableReference() : VariableReference
    {
        $startToken = $this->expectMulti([\PoP\GraphQLParser\Spec\Parser\Token::TYPE_VARIABLE]);
        if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_IDENTIFIER) || $this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_QUERY)) {
            $name = $this->lex()->getData();
            $variable = $this->findVariable($name);
            return $this->createVariableReference($name, $variable, $this->getTokenLocation($startToken));
        }
        throw $this->createUnexpectedException($this->peek());
    }
    protected function createVariableReference(string $name, ?Variable $variable, \PoP\GraphQLParser\Spec\Parser\Location $location) : VariableReference
    {
        return new VariableReference($name, $variable, $location);
    }
    protected function findVariable(string $name) : ?Variable
    {
        foreach ($this->variables as $variable) {
            if ($variable->getName() === $name) {
                return $variable;
            }
        }
        return null;
    }
    /**
     * @throws SyntaxErrorParserException
     */
    protected function parseFragmentReference() : FragmentReference
    {
        $nameToken = $this->eatIdentifierToken();
        return $this->createFragmentReference($nameToken->getData(), $this->getTokenLocation($nameToken));
    }
    protected function createFragmentReference(string $name, \PoP\GraphQLParser\Spec\Parser\Location $location) : FragmentReference
    {
        return new FragmentReference($name, $location);
    }
    /**
     * @throws SyntaxErrorParserException
     */
    protected function eatIdentifierToken() : \PoP\GraphQLParser\Spec\Parser\Token
    {
        return $this->expectMulti([
            \PoP\GraphQLParser\Spec\Parser\Token::TYPE_IDENTIFIER,
            // Accept also field/directive arguments "query", "on", etc
            \PoP\GraphQLParser\Spec\Parser\Token::TYPE_QUERY,
            \PoP\GraphQLParser\Spec\Parser\Token::TYPE_MUTATION,
            \PoP\GraphQLParser\Spec\Parser\Token::TYPE_SUBSCRIPTION,
            \PoP\GraphQLParser\Spec\Parser\Token::TYPE_FRAGMENT,
            \PoP\GraphQLParser\Spec\Parser\Token::TYPE_ON,
        ]);
    }
    /**
     * @throws SyntaxErrorParserException
     */
    protected function parseBodyItem(string $type) : FieldInterface|FragmentBondInterface
    {
        $nameToken = $this->eatIdentifierToken();
        $alias = null;
        if ($this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_COLON)) {
            $alias = $nameToken->getData();
            $nameToken = $this->eatIdentifierToken();
        }
        $bodyLocation = $this->getTokenLocation($nameToken);
        $arguments = $this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LPAREN) ? $this->parseArgumentList() : [];
        $directives = $this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_AT) ? $this->parseDirectiveList() : [];
        if ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LBRACE)) {
            $this->beforeParsingFieldsOrFragmentBonds();
            /** @var array<FieldInterface|FragmentBondInterface> */
            $fieldsOrFragmentBonds = $this->parseBody($type === \PoP\GraphQLParser\Spec\Parser\Token::TYPE_INLINE_FRAGMENT ? \PoP\GraphQLParser\Spec\Parser\Token::TYPE_QUERY : $type);
            $this->afterParsingFieldsOrFragmentBonds();
            if (!$fieldsOrFragmentBonds) {
                throw $this->createUnexpectedTokenTypeException($this->lookAhead->getType());
            }
            if ($type === \PoP\GraphQLParser\Spec\Parser\Token::TYPE_INLINE_FRAGMENT) {
                return $this->createInlineFragment($nameToken->getData(), $fieldsOrFragmentBonds, $directives, $bodyLocation);
            }
            return $this->createRelationalField($nameToken->getData(), $alias, $arguments, $fieldsOrFragmentBonds, $directives, $bodyLocation);
        }
        return $this->createLeafField($nameToken->getData(), $alias, $arguments, $directives, $bodyLocation);
    }
    /**
     * Allow to override, to support ObjectResolvedFieldValueReferences
     */
    protected function beforeParsingOperation() : void
    {
    }
    /**
     * Allow to override, to support ObjectResolvedFieldValueReferences
     */
    protected function afterParsingOperation() : void
    {
    }
    /**
     * Allow to override, to support ObjectResolvedFieldValueReferences
     */
    protected function beforeParsingFieldsOrFragmentBonds() : void
    {
    }
    /**
     * Allow to override, to support ObjectResolvedFieldValueReferences
     */
    protected function afterParsingFieldsOrFragmentBonds() : void
    {
    }
    /**
     * @param Argument[] $arguments
     * @param array<FieldInterface|FragmentBondInterface> $fieldsOrFragmentBonds
     * @param Directive[] $directives
     */
    protected function createRelationalField(string $name, ?string $alias, array $arguments, array $fieldsOrFragmentBonds, array $directives, \PoP\GraphQLParser\Spec\Parser\Location $location) : RelationalField
    {
        return new RelationalField($name, $alias, $arguments, $fieldsOrFragmentBonds, $directives, $location);
    }
    /**
     * @param array<FieldInterface|FragmentBondInterface> $fieldsOrFragmentBonds
     * @param Directive[] $directives
     */
    protected function createInlineFragment(string $typeName, array $fieldsOrFragmentBonds, array $directives, \PoP\GraphQLParser\Spec\Parser\Location $location) : InlineFragment
    {
        return new InlineFragment($typeName, $fieldsOrFragmentBonds, $directives, $location);
    }
    /**
     * @param Argument[] $arguments
     * @param Directive[] $directives
     */
    protected function createLeafField(string $name, ?string $alias, array $arguments, array $directives, \PoP\GraphQLParser\Spec\Parser\Location $location) : LeafField
    {
        return new LeafField($name, $alias, $arguments, $directives, $location);
    }
    /**
     * @return Argument[]
     */
    protected function parseArgumentList() : array
    {
        $args = [];
        $this->expect(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LPAREN);
        while (!$this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RPAREN) && !$this->end()) {
            $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_COMMA);
            $args[] = $this->parseArgument();
        }
        $this->expect(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RPAREN);
        return $args;
    }
    protected function parseArgument() : Argument
    {
        $nameToken = $this->eatIdentifierToken();
        $this->expect(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_COLON);
        $value = $this->parseValue();
        return $this->createArgument($nameToken->getData(), $value, $this->getTokenLocation($nameToken));
    }
    protected function createArgument(string $name, WithValueInterface $value, \PoP\GraphQLParser\Spec\Parser\Location $location) : Argument
    {
        return new Argument($name, $value, $location);
    }
    /**
     * @return Directive[]
     */
    protected function parseDirectiveList() : array
    {
        $directives = [];
        while ($this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_AT)) {
            $directives[] = $this->parseDirective();
            $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_COMMA);
        }
        return $directives;
    }
    protected function parseDirective() : Directive
    {
        $this->expect(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_AT);
        $this->beforeParsingDirectiveArgumentList();
        $nameToken = $this->eatIdentifierToken();
        $args = $this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LPAREN) ? $this->parseArgumentList() : [];
        $this->afterParsingDirectiveArgumentList();
        return $this->createDirective($nameToken->getData(), $args, $this->getTokenLocation($nameToken));
    }
    /**
     * Allow to override, to support ObjectResolvedFieldValueReferences
     */
    protected function beforeParsingDirectiveArgumentList() : void
    {
    }
    /**
     * Allow to override, to support ObjectResolvedFieldValueReferences
     */
    protected function afterParsingDirectiveArgumentList() : void
    {
    }
    /**
     * @param Argument[] $arguments
     */
    protected function createDirective(string $name, array $arguments, \PoP\GraphQLParser\Spec\Parser\Location $location) : Directive
    {
        return new Directive($name, $arguments, $location);
    }
    /**
     * @throws SyntaxErrorParserException
     */
    protected function parseValue() : InputList|InputObject|Literal|Enum|VariableReference
    {
        switch ($this->lookAhead->getType()) {
            case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_LSQUARE_BRACE:
                return $this->parseList();
            case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_LBRACE:
                return $this->parseObject();
            case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_VARIABLE:
                return $this->parseVariableReference();
            case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_NUMBER:
            case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_BLOCK_STRING:
            case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_STRING:
            case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_NULL:
            case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_TRUE:
            case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_FALSE:
                $token = $this->lex();
                return $this->createLiteral($token->getData(), $this->getTokenLocation($token));
            case \PoP\GraphQLParser\Spec\Parser\Token::TYPE_IDENTIFIER:
                $token = $this->lex();
                return $this->createEnum($token->getData(), $this->getTokenLocation($token));
        }
        throw $this->createUnexpectedException($this->lookAhead);
    }
    public function createLiteral(string|int|float|bool|null $value, \PoP\GraphQLParser\Spec\Parser\Location $location) : Literal
    {
        return new Literal($value, $location);
    }
    public function createEnum(string $enumValue, \PoP\GraphQLParser\Spec\Parser\Location $location) : Enum
    {
        return new Enum($enumValue, $location);
    }
    protected function parseList() : InputList
    {
        /** @var Token */
        $startToken = $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LSQUARE_BRACE);
        $list = [];
        while (!$this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RSQUARE_BRACE) && !$this->end()) {
            $list[] = $this->parseValue();
            $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_COMMA);
        }
        $this->expect(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RSQUARE_BRACE);
        return $this->createInputList($list, $this->getTokenLocation($startToken));
    }
    /**
     * @param mixed[] $list
     */
    protected function createInputList(array $list, \PoP\GraphQLParser\Spec\Parser\Location $location) : InputList
    {
        return new InputList($list, $location);
    }
    /**
     * @throws SyntaxErrorParserException
     */
    protected function parseObject() : InputObject
    {
        /** @var Token */
        $startToken = $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_LBRACE);
        // Use stdClass instead of array
        $object = new stdClass();
        while (!$this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RBRACE) && !$this->end()) {
            $keyToken = $this->expectMulti([
                \PoP\GraphQLParser\Spec\Parser\Token::TYPE_STRING,
                \PoP\GraphQLParser\Spec\Parser\Token::TYPE_IDENTIFIER,
                // Accept also object keys "query", "on", etc
                \PoP\GraphQLParser\Spec\Parser\Token::TYPE_QUERY,
                \PoP\GraphQLParser\Spec\Parser\Token::TYPE_MUTATION,
                \PoP\GraphQLParser\Spec\Parser\Token::TYPE_SUBSCRIPTION,
                \PoP\GraphQLParser\Spec\Parser\Token::TYPE_FRAGMENT,
                \PoP\GraphQLParser\Spec\Parser\Token::TYPE_ON,
            ]);
            $key = $keyToken->getData();
            $this->expect(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_COLON);
            $value = $this->parseValue();
            $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_COMMA);
            // Validate no duplicated keys in InputObject
            if (\property_exists($object, $key)) {
                throw new SyntaxErrorParserException(new FeedbackItemResolution(GraphQLSpecErrorFeedbackItemProvider::class, GraphQLSpecErrorFeedbackItemProvider::E_5_6_3, [$key]), $this->getTokenLocation($keyToken));
            }
            $object->{$key} = $value;
        }
        $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_RBRACE);
        return $this->createInputObject($object, $this->getTokenLocation($startToken));
    }
    protected function createInputObject(stdClass $object, \PoP\GraphQLParser\Spec\Parser\Location $location) : InputObject
    {
        return new InputObject($object, $location);
    }
    /**
     * @throws SyntaxErrorParserException
     */
    protected function parseFragment() : Fragment
    {
        $this->lex();
        $nameToken = $this->eatIdentifierToken();
        $this->eat(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_ON);
        $model = $this->eatIdentifierToken();
        $directives = $this->match(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_AT) ? $this->parseDirectiveList() : [];
        $this->beforeParsingFieldsOrFragmentBonds();
        $fieldsOrFragmentBonds = $this->parseBody(\PoP\GraphQLParser\Spec\Parser\Token::TYPE_QUERY);
        $this->afterParsingFieldsOrFragmentBonds();
        return $this->createFragment($nameToken->getData(), $model->getData(), $directives, $fieldsOrFragmentBonds, $this->getTokenLocation($nameToken));
    }
    /**
     * @param Directive[] $directives
     * @param array<FieldInterface|FragmentBondInterface> $fieldsOrFragmentBonds
     */
    protected function createFragment(string $name, string $model, array $directives, array $fieldsOrFragmentBonds, \PoP\GraphQLParser\Spec\Parser\Location $location) : Fragment
    {
        return new Fragment($name, $model, $directives, $fieldsOrFragmentBonds, $location);
    }
    protected function eat(string $type) : ?\PoP\GraphQLParser\Spec\Parser\Token
    {
        if ($this->match($type)) {
            return $this->lex();
        }
        return null;
    }
    /**
     * @param string[] $types
     */
    protected function eatMulti(array $types) : ?\PoP\GraphQLParser\Spec\Parser\Token
    {
        if ($this->matchMulti($types)) {
            return $this->lex();
        }
        return null;
    }
    /**
     * @param string[] $types
     */
    protected function matchMulti(array $types) : bool
    {
        foreach ($types as $type) {
            if ($this->peek()->getType() === $type) {
                return \true;
            }
        }
        return \false;
    }
}
