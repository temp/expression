<?php

/*
 * This file is part of the webmozart/expression package.
 *
 * (c) Bernhard Schussek <bschussek@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webmozart\Expression\Selector;

use Webmozart\Expression\Expression;
use Webmozart\Expression\Logic\Conjunction;
use Webmozart\Expression\Logic\Disjunction;

/**
 * Checks whether an array key matches an expression.
 *
 * @since  1.0
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
final class Key extends Selector
{
    /**
     * @var string
     */
    private $key;

    /**
     * Creates the expression.
     *
     * @param string|int $key  The array key.
     * @param Expression $expr The expression to evaluate for the key.
     */
    public function __construct($key, Expression $expr)
    {
        parent::__construct($expr);

        $this->key = $key;
    }

    /**
     * Returns the array key.
     *
     * @return string|int The array key.
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate($value)
    {
        if (!is_array($value)) {
            return false;
        }

        if (!array_key_exists($this->key, $value)) {
            return false;
        }

        return $this->expr->evaluate($value[$this->key]);
    }

    /**
     * {@inheritdoc}
     */
    public function equivalentTo(Expression $other)
    {
        if (!parent::equivalentTo($other)) {
            return false;
        }

        /** @var static $other */
        return $this->key == $other->key;
    }

    /**
     * {@inheritdoc}
     */
    public function toString()
    {
        $exprString = $this->expr->toString();

        if ($this->expr instanceof Conjunction || $this->expr instanceof Disjunction) {
            return $this->key.'('.$exprString.')';
        }

        // Append "functions" with "."
        if (isset($exprString[0]) && ctype_alpha($exprString[0])) {
            return $this->key.'.'.$exprString;
        }

        return $this->key.$exprString;
    }
}
