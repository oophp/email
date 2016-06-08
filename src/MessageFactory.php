<?php

namespace OOPHP\Email;

use OOPHP\Charset\Charset;
use OOPHP\Charset\CharsetInterface;
use OOPHP\Mailparse\Mailparse;

/**
 * Class MessageFactory
 *
 * A simple class with factory methods to create Message instances from various source types
 *
 * @package OOPHP\Email
 */
class MessageFactory implements MessageFactoryInterface
{
    /**
     * @var CharsetInterface $charset
     */
    protected $charset;

    /**
     * @var string $messageClass
     */
    protected $messageClass;

    /**
     * Parser constructor.
     *
     * @param CharsetInterface $charset
     * @param string           $messageClass
     */
    public function __construct(CharsetInterface $charset = null, string $messageClass = Message::class)
    {
        if ($charset === null) {
            $charset = new Charset();
        }
        $this->charset = $charset;
        $this->messageClass = $messageClass;
    }

    /**
     * @param string $path
     *
     * @return MessageInterface
     */
    public function fromPath(string $path): MessageInterface
    {
        $mailparse = (new Mailparse())->setPath($path);

        return $this->createMessage($mailparse);
    }

    /**
     * @param resource $stream
     *
     * @return MessageInterface
     * @throws \OOPHP\Mailparse\Exception\NonReadableStream
     */
    public function fromStream($stream): MessageInterface
    {
        $mailparse = (new Mailparse())->setStream($stream);

        return $this->createMessage($mailparse);
    }

    /**
     * @param string $text
     *
     * @return MessageInterface
     */
    public function fromText(string $text): MessageInterface
    {
        $mailparse = (new Mailparse())->setText($text);

        return $this->createMessage($mailparse);
    }

    /**
     * @param $mailparse
     *
     * @return MessageInterface
     */
    protected function createMessage($mailparse): MessageInterface
    {
        $messageClass = $this->messageClass;
        $message = new $messageClass($this->charset, $mailparse);

        return $message;
    }
}
