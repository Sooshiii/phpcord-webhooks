<?php

namespace DiscordWebhook\EmbedBuilder;

class Embed
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var int
     */
    public $color;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string ISO8601 timestamp
     */
    public $timestamp;

    /** 
     * Webhook embeds will always be rich according to Discord API docs.
     * 
     * @var string
     */
    public $type = 'rich';

    /**
     * @var array $thumbnail Array containing the necessary params.
     *    $thumbnail = [
     *      'url' => (string) image url
     *    ]
     */
    public $thumbnail;

    /**
     * @var array $image Array containing the necessary params.
     *    $image = [
     *      'url' => (string) image url
     *    ]
     */
    public $image;

    /**
     * @var array $footer Array containing the necessary params.
     *    $footer = [
     *      'text' => (string) body text
     *      'url'  => (string) image url
     *    ]
     */
    public $footer;

    /**
     * @var array $author Array containing the necessary params.
     *    $author = [
     *      'name' => (string) author name
     *      'url'  => (string) image url
     *    ]
     */
    public $author;

    /**
     * @var array $fields Array containing the necessary params.
     *    $fields = [
     *      [
     *          'name'   => (string) title text
     *          'value'  => (string) body text
     *          'inline' => (bool)   decide if field is inline
     *      ]
     *    ]
     */
    public $fields;

    /**
     * Set embed title
     *
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Set embed url
     *
     * @param string $url
     */
    public function setURL(string $url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Set embed color
     *
     * @param int $color
     */
    public function setColor(int $color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Set embed author
     *
     * @param string $name
     * @param string $url
     */
    public function setAuthor($name, $url = '')
    {
        $this->author['name'] = $name;
        $this->author['url'] = $url;
        return $this;
    }

    /**
     * Set embed description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set embed thumbnail
     *
     * @param string $url
     */
    public function setThumbnail($url)
    {
        $this->thumbnail['url'] = $url;
        return $this;
    }

    /**
     * Set embed image
     *
     * @param string $url
     */
    public function setImage($url)
    {
        $this->image['url'] = $url;
        return $this;
    }

    /**
     * Set embed timestamp
     */
    public function setTimestamp()
    {
        $this->timestamp = date("c", strtotime("now"));
        return $this;
    }

    /**
     * Set embed footer
     *
     * @param string $text
     * @param string $iconURL
     */
    public function setFooter($text, $iconURL = '')
    {
        $this->footer['text'] = $text;
        $this->footer['icon_url'] = $iconURL;
        return $this;
    }

    /**
     * Create new embed field
     *
     * @param string $title
     * @param string $text
     * @param bool $inline
     */
    public function addField($title, $text, $inline = false)
    {
        $this->fields[] = ['name' => $title, 'value' => $text, 'inline' => $inline];
        $this->fields = array_values($this->fields);
        return $this;
    }
}
