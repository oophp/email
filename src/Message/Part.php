<?php

namespace OOPHP\Email\Message;

use OOPHP\Charset\Charset;
use OOPHP\Charset\CharsetInterface;
use OOPHP\Mailparse\Mailparse;

class Part implements PartInterface
{
    /**
     * @var Mailparse $mailparse An instance of Mailparse
     */
    protected $mailparse;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var CharsetInterface $charset
     */
    protected $charset;

    /**
     * @var array $headers
     */
    protected $headers = [];

    /**
     * @var Part[] $parts
     */
    protected $parts = [];

    /**
     * Part constructor.
     *
     * @param CharsetInterface|null $charset
     * @param Mailparse|null        $mailparse
     */
    public function __construct(CharsetInterface $charset = null, Mailparse $mailparse = null)
    {
        if ($charset === null) {
            $this->charset = new Charset();
        } else {
            $this->charset = $charset;
        }

        if ($mailparse !== null) {
            $this->mailparse = $mailparse;
            $this->data = $mailparse->getPartData();
        }
    }

    public function getHeaders()
    {
        return $this->getData()['headers'] ?? [];
    }

    public function getHeader(string $name, $default = null)
    {
        return $this->getHeaders()[strtolower($name)] ?? $default;
    }

    public function isMultipart()
    {
        // TODO: Implement isMultipart() method.
    }

    public function getParts()
    {
        // TODO: Implement getParts() method.
    }

    /**
     * @param string                $partId
     * @param CharsetInterface|null $charset
     *
     * @return Part|bool
     */
    public function getPart(string $partId, CharsetInterface $charset = null)
    {
        if (!isset($this->parts[$partId])) {
            if ($charset === null) {
                $charset = $this->charset;
            }
            $part = $this->mailparse->getPartObject($partId);
            $this->parts[$partId] = new Part($charset, $part);
        }

        return $this->parts[$partId] ?? false;
    }

    public function __toString()
    {
        return $this->mailparse->getText();
    }

    protected function getData()
    {
        if (empty($this->data) && $this->mailparse instanceof Mailparse) {
            $this->data = $this->mailparse->getPartData();
            $this->headers = $this->data['headers'] ?? [];
        }

        return $this->data;
    }
}
