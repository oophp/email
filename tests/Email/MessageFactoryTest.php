<?php

namespace Tests\Email;

use OOPHP\Email\Message;
use OOPHP\Email\MessageFactory;

class MessageFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testMessageFromPath()
    {
        $messageFactory = new MessageFactory();
        $messageObject = $messageFactory->fromPath(TEST_DIR.'/examples/rfc5322_a.1.1_.txt');
        $this->assertInstanceOf(Message::class, $messageObject);
    }
}
