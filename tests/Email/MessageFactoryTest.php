<?php

namespace Tests\Email;

use OOPHP\Email\Message;
use OOPHP\Email\MessageFactory;

class MessageFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getRFC5322Fixtures
     */
    public function testMessageFromPath($path)
    {
        $messageFactory = new MessageFactory();
        $messageObject = $messageFactory->fromPath($path);
        $this->assertInstanceOf(Message::class, $messageObject);
    }

    /**
     * @dataProvider getRFC5322Fixtures
     */
    public function testMessageFromStream($path)
    {
        $handle = @fopen($path, 'r');
        $messageFactory = new MessageFactory();
        $messageObject = $messageFactory->fromStream($handle);
        $this->assertInstanceOf(Message::class, $messageObject);
    }

    /**
     * @dataProvider getRFC5322Fixtures
     */
    public function testMessageFromText($path)
    {
        $text = @file_get_contents($path);
        $messageFactory = new MessageFactory();
        $messageObject = $messageFactory->fromText($text);
        $this->assertInstanceOf(Message::class, $messageObject);
    }

    /**
     * Provides a list of files, each containing an rfc5322 Internet Message examples
     *
     * @return array
     */
    public function getRFC5322Fixtures()
    {
        $tests = [];
        $rfc5322FileList = array_filter(glob(__DIR__.'/Fixtures/rfc5322_*_.txt'), 'is_file');

        foreach ($rfc5322FileList as $file) {
            $tests[] = [$file];
        }

        return $tests;
    }
}
