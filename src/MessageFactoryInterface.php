<?php

namespace OOPHP\Email;

use OOPHP\Charset\CharsetInterface;

interface MessageFactoryInterface
{
    /**
     * ParserInterface constructor.
     *
     * @param CharsetInterface $charset
     */
    public function __construct(CharsetInterface $charset);

    /**
     * @param string $path
     *
     * @return MessageInterface
     */
    public function fromPath(string $path): MessageInterface;

    /**
     * @param resource $stream
     *
     * @return MessageInterface
     */
    public function fromStream($stream): MessageInterface;

    /**
     * @param string $text
     *
     * @return MessageInterface
     */
    public function fromText(string $text): MessageInterface;
}
