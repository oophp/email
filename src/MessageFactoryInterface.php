<?php

namespace OOPHP\Email;

use OOPHP\Charset\CharsetInterface;
use OOPHP\Mailparse\Mailparse;

interface MessageFactoryInterface
{
    /**
     * ParserInterface constructor.
     *
     * @param CharsetInterface $charset
     * @param string           $messageClass
     */
    public function __construct(CharsetInterface $charset, string $messageClass = Message::class);

    /**
     * @param string $path
     * @param string $mailparseClass
     *
     * @return MessageInterface
     */
    public function fromPath(string $path, string $mailparseClass = Mailparse::class): MessageInterface;

    /**
     * @param resource $stream
     * @param string   $mailparseClass
     *
     * @return MessageInterface
     */
    public function fromStream($stream, string $mailparseClass = Mailparse::class): MessageInterface;

    /**
     * @param string $text
     * @param string $mailparseClass
     *
     * @return MessageInterface
     */
    public function fromText(string $text, string $mailparseClass = Mailparse::class): MessageInterface;
}
