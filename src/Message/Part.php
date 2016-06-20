<?php

namespace OOPHP\Email\Message;

class Part implements PartInterface
{
    use PartTrait;

    /**
     * @var string $partClass
     */
    protected $partClass = Part::class;
}
