<?php

namespace OOPHP\Email;

class Header implements HeaderInterface, \JsonSerializable
{
    protected $name;

    protected $value;

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return [
            'name'  => $this->getName(),
            'value' => $this->getValue(),
        ];
    }

    public function __toString()
    {
        return ucwords($this->getName()).': '.$this->getValue();
    }
}
