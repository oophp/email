<?php

namespace OOPHP\Email;

class HeaderFieldList implements HeaderFieldListInterface
{
    /**
     * @var HeaderFieldInterface[]
     */
    protected $headerFields;

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
            return new HeaderField($name, $default);
        }

        return $this->headerFields[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function setField(string $name, $value)
    {
        $this->headerFields[$name] = new HeaderField($name, $value);

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
}
