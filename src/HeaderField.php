<?php

namespace OOPHP\Email;

use OOPHP\Email\Exception\EmptyHeaderValueException;

class HeaderField implements HeaderFieldInterface
{
    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string[] $headerLines
     */
    protected $headerLines = [];

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->setValue($value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue($default = null)
    {
        if (empty($this->headerLines)) {
            return (new static($this->name, $default))->getValue();
        }

        if ($this->hasMultipleValues()) {
            return $this->headerLines;
        } else {
            return reset($this->headerLines);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($values)
    {
        $this->headerLines = [];
        foreach ((array)$values as $value) {
            $this->addValue($value);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addValue($value)
    {
        if (empty($value)) {
            throw new EmptyHeaderValueException();
        }

        $this->headerLines[] = (string)$value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasMultipleValues()
    {
        return $this->count() > 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->headerLines);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->headerLines);
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->headerLines;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $headerLines = $this->headerLines;
        array_walk(
            $headerLines,
            function (&$value, $key, $name) {
                $value = ucfirst($name).': '.$value;
            },
            $this->name
        );
        $str = implode("\r\n", $headerLines);

        return $str;
    }
}
