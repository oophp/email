<?php

namespace OOPHP\Email\Message\Header;

use DateTime;
use OOPHP\Email\Exception\EmptyHeaderValueException;
use OOPHP\Email\HeaderField;

class Date extends HeaderField
{
    public function addValue($value)
    {
        if (empty($value)) {
            throw new EmptyHeaderValueException();
        }

        $this->headerLines[] = new DateTime((string)$value);

        return $this;
    }
}
