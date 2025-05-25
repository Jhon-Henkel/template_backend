<?php

declare(strict_types=1);

namespace App\Infra\Rules;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @codeCoverageIgnore
 */
class NoPrivateMethodsRule implements Rule
{
    public function getNodeType(): string
    {
        return ClassMethod::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node instanceof ClassMethod) {
            return [];
        }

        if ($node->isPrivate()) {
            /** @phpstan-ignore return.type */
            return [
                RuleErrorBuilder::message(sprintf('Método privado "%s" não é permitido. Considere torná-lo público ou protegido.', $node->name->toString()))
                    ->line($node->getLine())
                    ->build(),
            ];
        }

        return [];
    }
}
