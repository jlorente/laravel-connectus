Connectus SDK for Laravel
=======================
Laravel integration for the [Connectus SDK](https://github.com/jlorente/connectus-php-sdk) including a notification channel.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

With Composer installed, you can then install the extension using the following commands:

```bash
$ php composer.phar require jlorente/laravel-connectus
```

or add 

```json
...
    "require": {
        "jlorente/laravel-connectus": "*"
    }
```

to the ```require``` section of your `composer.json` file.

## Configuration

1. Register the ServiceProvider in your config/app.php service provider list.

config/app.php
```php
return [
    //other stuff
    'providers' => [
        //other stuff
        \Jlorente\Laravel\Connectus\ConnectusServiceProvider::class,
    ];
];
```

2. Add the following facade to the $aliases section.

config/app.php
```php
return [
    //other stuff
    'aliases' => [
        //other stuff
        'Connectus' => \Jlorente\Laravel\Connectus\Facades\Connectus::class,
    ];
];
```

3. Publish the package configuration file.

```bash
$ php artisan vendor:publish --provider='Jlorente\Laravel\Connectus\ConnectusServiceProvider'
```

4. Set the api_key and api_secret in the config/connectus.php file or use the predefined env 
variables.

config/connectus.php
```php
return [
    'api_key' => 'YOUR_API_KEY',
    'account_id' => 'YOUR_ACCOUNT_ID',
    //other configuration
];
```
or 
.env
```
//other configurations
CONNECTUS_API_KEY=<YOUR_API_KEY>
CONNECTUS_ACCOUNT_ID=<YOUR_ACCOUNT_ID>
```

## Usage

You can use the facade alias Connectus to execute api calls. The authentication 
params will be automaticaly injected.

```php
Connectus::api()->checkSmsBalance();
```

## Notification Channels

A notification channel is included in this package and allow you to integrate 
the Connectus send SMS service.

You can find more info about Laravel notifications in [this page](https://laravel.com/docs/5.6/notifications).

### ConnectusSmsChannel

If you want to send an SMS through Connectus, you should define a toConnectusSms method 
on the notification class. This method will receive a $notifiable entity and 
should return a string with the message to be sent on the SMS:

```php
/**
 * Get the SMS message.
 *
 * @param  mixed  $notifiable
 * @return string
 */
public function toConnectusSms($notifiable)
{
    return 'Hello, this is an SMS sent through Connectus API';
}
```

Once done, you must add the notification channel in the array of the via() method 
of the notification:

```php
/**
 * Get the notification channels.
 *
 * @param  mixed  $notifiable
 * @return array|string
 */
public function via($notifiable)
{
    return [ConnectusSmsChannel::class];
}
```

### Routing the Notifications

When sending notifications via Connectus channel, the notification system will 
automatically look for a phone_number attribute on the notifiable entity. If 
you would like to customize the number you should define a routeNotificationForConnectusSms
method on the entity:

```php
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the Connectus SMS channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForConnectusSms($notification)
    {
        return $this->phone;
    }
}
```

## License 
Copyright &copy; 2021 José Lorente Martín <jose.lorente.martin@gmail.com>.

Licensed under the BSD 3-Clause License. See LICENSE.txt for details.
