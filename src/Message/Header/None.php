<?php

namespace OOPHP\Email\Message\Header;

use OOPHP\Email\HeaderField;

class None extends HeaderField
{
    public function __construct($name = '', $value = '')
    {
        parent::__construct($name, $value);
    }

    public function addValue($value)
    {
        return $this;
    }
}
