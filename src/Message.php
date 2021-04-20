<?php

namespace DiscordWebhook\MessageBuilder;

use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;

use GuzzleHttp\Client;

/**
 * @ExclusionPolicy("none")
 */
class Message
{
    /**
     * @var string 
     * @Exclude
     */
    private $webhook;

    /**
     * @var string message body
     */
    public $content;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $avatar_url;

    /**
     * @var bool
     */
    public $tts = false;

    /**
     * @var array $embeds Array of Embeds from \EmbedBuilder
     *    $footer = [
     *      [
     *          'name'   => (string) title text
     *          'value'  => (string) body text
     *          'inline' => (bool)   decide if field is inline
     *      ]
     *    ]
     */
    public $embeds;

    /**
     * Set webhook URL
     *
     * @param string $url
     */
    public function setWebhook($url)
    {
        $this->webhook = $url;
        return $this;
    }

    /**
     * Set message body
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->content = $message;
        return $this;
    }

    /**
     * Set username 
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Enable TTS
     */
    public function enableTTS()
    {
        $this->tts = true;
        return $this;
    }

    /**
     * Set avatar image
     *
     * @param string $url
     */
    public function setAvatar($url)
    {
        $this->avatar_url = $url;
        return $this;
    }

    /**
     * Add embed to message
     *
     * @param object $embed
     */
    public function addEmbed($embed)
    {
        $this->embeds[] = (array) $embed;
        return $this;
    }

    /**
     * Create JSON from class
     */
    public function buildJSON()
    {
        $serializer = SerializerBuilder::create()->build();
        $json = $serializer->serialize($this, 'json', SerializationContext::create()->setSerializeNull(false));
        return $json;
    }


    /**
     * Send request to discord
     *
     * @param string $json null by default
     * @return string response from webhook
     */
    public function send($json = null)
    {
        if ($json == null) {
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
