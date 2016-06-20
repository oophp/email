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
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function fromPath(string $path, string $mailparseClass = Mailparse::class): MessageInterface
    {
        $mailparse = (new $mailparseClass())->setPath($path);

        return $this->createMessage($mailparse);
    }

    /**
     * {@inheritdoc}
     * @throws \OOPHP\Mailparse\Exception\NonReadableStreamException
     */
    public function fromStream($stream, string $mailparseClass = Mailparse::class): MessageInterface
    {
        $mailparse = (new $mailparseClass())->setStream($stream, true);

        return $this->createMessage($mailparse);
    }

    /**
     * {@inheritdoc}
     */
    public function fromText(string $text, string $mailparseClass = Mailparse::class): MessageInterface
    {
        $mailparse = (new $mailparseClass())->setText($text);

        return $this->createMessage($mailparse);
    }

    /**
     * @param Mailparse $mailparse
     *
     * @return MessageInterface
     */
    protected function createMessage(Mailparse $mailparse): MessageInterface
    {
        return new $this->messageClass($this->charset, $mailparse);
    }
}
