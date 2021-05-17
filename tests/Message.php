<?php

namespace DiscordWebhook\Test;

use DiscordWebhook\Message;

class MessageTest extends \PHPUnit_Framework_TestCase
{


    /**
     * Test that the message is only created using only the needed values
     */
    public function testMessageJson()
    {
        $message = new Message();
        $message->setWebhook('https://www.discord.com')
            ->setMessage("some message")
            ->setUsername("username here")
            ->setAvatar('https://www.discord.com');
        
        $json = $message->buildJSON();

        $array = json_decode($json, true);

        $this->assertArrayNotHasKey('webhook', $array);
        $this->assertArrayHasKey('content', $array);
        $this->assertArrayHasKey('username', $array);
        $this->assertArrayHasKey('tts', $array);

        $this->assertFalse($array['tts']);

        $message->enableTTS();

        $json = $message->buildJSON();

        $array = json_decode($json, true);

        $this->assertTrue($array['tts']);
    }
}
