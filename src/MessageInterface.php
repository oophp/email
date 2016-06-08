<?php

namespace OOPHP\Email;

use OOPHP\Email\Message\PartInterface;

interface MessageInterface extends PartInterface
{
    /**
     * @return PartInterface[]
     */
    public function getBodies();

    /**
     * @param string $format
     *
     * @return PartInterface
     */
    public function getBody(string $format);
}
