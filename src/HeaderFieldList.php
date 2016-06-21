<?php

namespace OOPHP\Email;

use OOPHP\Email\Message\Header\Address;
use OOPHP\Email\Message\Header\Date;

class HeaderFieldList implements HeaderFieldListInterface
{
    /**
     * @var HeaderFieldInterface[]
     */
    protected $headerFields;

    protected $headerClassMap = [
        'from'        => Address::class,
        'to'          => Address::class,
        'reply-to'    => Address::class,
        'cc'          => Address::class,
        'bcc'         => Address::class,
        'return-path' => Address::class,
        'date'        => Date::class,
    ];

    /**
     * HeaderFieldList constructor.
     *
     * @param array $headers
     */
    public function __construct(array $headers = null)
    {
        $this->headerFields = [];
        foreach ($headers as $name => $value) {
            $this->setField($name, $value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getField(string $name, $default = null)
    {
        if (empty($this->headerFields[$name])) {
            if (is_object($default)) {
                return $default;
            }

            return $this->createField($name, $default);
        }

        return $this->headerFields[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function setField(string $name, $value)
    {
        $this->headerFields[$name] = $this->createField($name, $value);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->headerFields);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this->headerFields;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->headerFields;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $str = implode("\r\n", array_map('strval', $this->headerFields));

        return $str;
    }

    /**
     * @param string          $name
     * @param string|string[] $value
     *
     * @return HeaderFieldInterface
     */
    protected function createField(string $name, $value): HeaderFieldInterface
    {
        $className = $this->headerClassMap[$name] ?? HeaderField::class;

        return new $className($name, $value);
    }
}
