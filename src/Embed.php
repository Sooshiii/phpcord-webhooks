<?php

namespace DiscordWebhook\EmbedBuilder;

class Embed
{

    public $title, $color, $url, $description, $timestamp;
    public $type = 'rich';
    // arrays below
    public $thumbnail;
    public $image;
    public $footer;
    public $author;
    public $fields;

    public function __construct()
    {
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }
    
    public function setURL($url) {
        $this->url = $url;
        return $this;
    }

    public function setColor($color) {
        $this->color = $color;
        return $this;
    }

    public function setAuthor($name, $url = '') {
        $this->author['name'] = $name;
        $this->author['url'] = $url;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setThumbnail($thumbnail) {
        $this->thumbnail['url'] = $thumbnail;
        return $this;
    }

    public function setImage($image) {
        $this->image['url'] = $image;
        return $this;
    }

    public function setTimestamp() {
        $this->timestamp = date("c", strtotime("now"));
        return $this;
    }

    public function setFooter($text, $iconURL = '') {
        $this->footer['text'] = $text;
        $this->footer['icon_url'] = $iconURL;
        return $this;
    }

    public function addField($title, $value, $inline = false) {
        $this->fields[] = ['name'=>$title, 'value'=>$value, 'inline'=>$inline];
        $this->fields = array_values($this->fields);
        return $this;
    }
}