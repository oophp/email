<?php

namespace OOPHP\Email;

use OOPHP\Email\Message\Part;

class Message extends Part implements MessageInterface
{
    use MessageTrait;
}
