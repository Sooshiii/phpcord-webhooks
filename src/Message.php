<?php

namespace DiscordWebhook\MessageBuilder;

use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * @ExclusionPolicy("none")
 */
class Message
{
    /**
     * @Exclude
     */
    private $webhook;

    public $content, $username, $avatar_url = 'https://i.imgur.com/wSTFkRM.png';
    public $tts = false;
    // array
    public $embeds;

    public function __construct()
    {
    }

    public function setWebhook($url) {
        $this->webhook = $url;
        return $this;
    }

    public function setMessage($message) {
        $this->content = $message;
        return $this;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function enableTTS() {
        $this->tts = true;
        return $this;
    }

    public function setAvatar($url) {
        $this->avatar_url = $url;
        return $this;
    }

    public function addEmbed($embed) {
        $this->embeds[] = $embed;
        $this->embeds = (array)array_values($this->embeds);
        return $this;
    }

    public function buildJSON() {
        $serializer = SerializerBuilder::create()->build();
        $json = $serializer->serialize($this, 'json', SerializationContext::create()->setSerializeNull(false));
        return $json;
    }

    public function send($json = null) {
        if($json == null) {
            $json = $this->buildJSON();
        }

        $client = new Client(['verify' => false]);
        $response = $client->request('POST', $this->webhook, [
            'body' => $json,
            'headers' => [
                'Content-Type' => 'application/json',
                'Content-Length' => strlen($json),
            ]
        ]);

        return $response->getBody()->getContents();
    }
}