<?php

namespace OOPHP\Email;

use Countable;
use IteratorAggregate;
use JsonSerializable;

interface HeaderFieldInterface extends Countable, IteratorAggregate, JsonSerializable
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string|string[] $default
     *
     * @return string|string[]
     */
    public function getValue($default = null);

    /**
     * @param string|string[] $value
     *
     * @return $this
     */
    public function setValue($value);

    /**
     * @param string|string[] $value
     *
     * @return $this
     */
    public function addValue($value);

    /**
     * @return bool
     */
    public function hasMultipleValues();

    /**
     * @return string
     */
    public function __toString();
}
