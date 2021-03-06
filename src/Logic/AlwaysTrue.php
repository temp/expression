<?php

/*
 * This file is part of the webmozart/expression package.
 *
 * (c) Bernhard Schussek <bschussek@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webmozart\Expression\Logic;

use Webmozart\Expression\Expression;

/**
 * Always true (tautology).
 *
 * @since  1.0
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
final class AlwaysTrue extends Literal
{
    /**
     * {@inheritdoc}
     */
    public function evaluate($value)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function equivalentTo(Expression $other)
    {
        // Since this class is final, we can check with instanceof
        return $other instanceof $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toString()
    {
        return 'true';
    }

    /**
     * {@inheritdoc}
     */
    public function andX(Expression $expr)
    {
        return $expr;
    }

    /**
     * {@inheritdoc}
     */
    public function orX(Expression $expr)
    {
        return $this;
    }
}
