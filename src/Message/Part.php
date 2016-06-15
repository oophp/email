<?php

namespace OOPHP\Email\Message;

use OOPHP\Charset\Charset;
use OOPHP\Charset\CharsetInterface;
use OOPHP\Email\HeaderFieldList;
use OOPHP\Email\HeaderFieldListInterface;
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
     * @var HeaderFieldListInterface $headers
     */
    protected $headers;

    /**
     * @var Part[] $parts
     */
    protected $parts = [];

    /**
     * Part constructor.
     *
     * @param CharsetInterface $charset
     * @param Mailparse        $mailparse
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
            $this->headers = new HeaderFieldList($this->data['headers'] ?? []);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeader(string $name, $default = null)
    {
        return $this->headers->getField(strtolower($name), $default);
    }

    /**
     * {@inheritdoc}
     */
    public function isMultipart()
    {
        static $isMultipart;
        if (!isset($isMultipart)) {
            $isMultipart = false;
        }
        // TODO: Implement isMultipart() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getParts()
    {
        $structure = $this->mailparse->getStructure();
        foreach ($structure as $partId) {
            $this->getPart($partId);
        }

        return $this->parts;
    }

    /**
     * @param string           $partId
     * @param CharsetInterface $charset
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

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->mailparse->getText();
    }

    protected function getData()
    {
        if (empty($this->data) && $this->mailparse instanceof Mailparse) {
            $this->data = $this->mailparse->getPartData();
            $this->headers = new HeaderFieldList($this->data['headers'] ?? []);
        }

        return $this->data;
    }
}
