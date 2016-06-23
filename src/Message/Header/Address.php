<?php

namespace OOPHP\Email\Message\Header;

use OOPHP\Email\Exception\EmptyHeaderValueException;
use OOPHP\Email\HeaderField;
use OOPHP\Mailparse\Utils;

class Address extends HeaderField
{
    public function addValue($value)
    {
        if (empty($value)) {
            throw new EmptyHeaderValueException();
        }

        $this->headerLines = array_merge($this->headerLines, Utils::parseRFC822Addresses((string)$value));

        return $this;
    }
}
