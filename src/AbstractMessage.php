<?php

namespace OOPHP\Email;

use OOPHP\Email\Message\AbstractPart;

abstract class AbstractMessage extends AbstractPart implements MessageInterface
{
    use MessageTrait;
}
