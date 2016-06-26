<?php

namespace OOPHP\Email\Message\Header;

use OOPHP\Email\HeaderField;

class None extends HeaderField
{
    public function addValue($value)
    {
        return $this;
    }
}
