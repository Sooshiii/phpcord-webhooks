# PHPCord Webhooks

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

This is a small WIP library for using discord webhooks.

## Install

`composer require noynac/phpcord-webhooks`

## Usage

``` php
require_once "vendor/autoload.php";

use DiscordWebhook\Message;
use DiscordWebhook\Embed;

$webhook = 'YOUR-WEBHOOK-URL-HERE';

$message = new Message();
$message->setWebhook($webhook)
    ->setMessage("some message")
    ->setUsername("username here");

$newEmbed = new Embed();
$newEmbed->setColor('1000')
	->setTitle('Some title')
	->setURL('https://github.com/Sooshiii/phpcord-webhooks')
	->setAuthor('Some name', 'https://i.imgur.com/EJOjIMC.jpg')
	->setDescription('Some description here')
	->setThumbnail('https://i.imgur.com/EJOjIMC.jpg')
	->addField('Inline field title', 'Some value here', true)
	->setImage('https://i.imgur.com/EJOjIMC.jpg')
	->setTimestamp()
	->setFooter('Some footer text here', 'https://i.imgur.com/EJOjIMC.jpg');
      
$message->addEmbed($newEmbed);

$message->send();
```

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/Sooshiii/phpcord-webhooks/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Gavin](https://github.com/Sooshiii)
- [All Contributors](https://github.com/Sooshiii/phpcord-webhooks/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
