<?php

namespace OOPHP\Email\Message;

use OOPHP\Email\HeaderFieldInterface;

interface PartInterface extends \JsonSerializable
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
     * Using this provides support for using a class implementing PartInterface
     *
     * @param string $partClass
     *
     * @return PartInterface
     */
    public function setPartClass(string $partClass);

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
     * @return PartInterface[]
     */
    public function getBodies();

    /**
     * @return PartInterface
     */
    public function getBody();

    /**
     * @return string
     */
    public function __toString();
}
