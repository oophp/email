<?php

namespace OOPHP\Email;

use Countable;
use IteratorAggregate;
use JsonSerializable;

interface HeaderFieldListInterface extends Countable, IteratorAggregate, JsonSerializable
{
    /**
     * @param string          $name
     * @param string|string[] $default
     *
     * @return HeaderField
     */
    public function getField(string $name, $default = null);

    /**
     * @param string          $name
     * @param string|string[] $value
     *
     * @return $this
     */
    public function setField(string $name, $value);

    /**
     * @return string
     */
    public function __toString();
}
