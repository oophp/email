<?php

namespace OOPHP\Email\Message;

use OOPHP\Email\HeaderFieldInterface;

interface PartInterface
{
    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @param string $name
     *
     * @return HeaderFieldInterface
     */
    public function getHeader(string $name);

    /**
     * @return bool
     */
    public function isMultipart();

    /**
     * @return PartInterface[]
     */
    public function getParts();

    /**
     * @param string $partId
     *
     * @return PartInterface
     */
    public function getPart(string $partId);

    /**
     * @return string
     */
    public function __toString();
}
