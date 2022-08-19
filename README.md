# CakePHP Queue Example

## Features
- Docker config with 5 containers
    - MySQL
    - Nginx
    - PHP
        - Dockerfile for CakePHP 4 with Node & Composer
    - Redis
    - Mailhog
- Seeding database with faker
- Testing Mail System Function with a Command
- Installation & configuration of Cake/Queue plugin
    - 2 Queue configurations 
    - Mailer Action and Command Job queuing 
- Overriding default form widget templates

## Getting started
Clone this repo

Copy dotenv.example to .env
```
cp dotenv.example .env
```
Build Docker images
```
docker-compose build
```

Start Docker Containers
```
# start in background
docker-compose up -d 
```
Attach to the PHP container and install PHP dependencies
```
composer install
```

### Edit `app_local.php`
Mailhog setup

```php
// config/app_local.php
    'EmailTransport' => [
        'default' => [
            'className' => SmtpTransport::class,
            'host' => 'mailhog',
            'port' => 1025,
            'timeout' => 30,
            'client' => null,
            'tls' => false,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],
    'Email' => [
        'default' => [
            'transport' => 'default',
            'from' => ['james@toggen.com.au' => 'James McDonald'],
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
        ],
    ],
```

Add Cake/Queue queue configurations

```php
// config/app_local.php

  'Queue' => [
        'default' => [
            // A DSN for your configured backend. default: null
            'url' => 'redis://redis',

            // The queue that will be used for sending messages. default: default
            // This can be overriden when queuing or processing messages
            'queue' => 'default',

            // The name of a configured logger, default: null
            'logger' => 'stdout',

            // The name of an event listener class to associate with the worker
            'listener' => \App\Listener\WorkerListener::class,

            // The amount of time in milliseconds to sleep if no jobs are currently available. default: 10000
            'receiveTimeout' => 10000,
        ],
        'add_user' => [
            // A DSN for your configured backend. default: null
            'url' => 'redis://redis',

            // The queue that will be used for sending messages. default: default
            // This can be overriden when queuing or processing messages
            'queue' => 'add_user',

            // The name of a configured logger, default: null
            'logger' => 'stdout',

            // The name of an event listener class to associate with the worker
            'listener' => \App\Listener\AddUserWorkerListener::class,

            // The amount of time in milliseconds to sleep if no jobs are currently available. default: 10000
            'receiveTimeout' => 10000,
        ]
    ],
```

MySQL

```php
// config/app_local.php
 'Datasources' => [
        'default' => [
            'host' => 'mysql',
            'username' => 'devtest',
            'password' => 'devtest',
            'database' => 'devtest',
            'url' => env('DATABASE_URL', null),
        ],
```

## References
[https://book.cakephp.org/queue/1/en/index.html](https://book.cakephp.org/queue/1/en/index.html)\
[https://book.cakephp.org/4/en/core-libraries/email.html](https://book.cakephp.org/4/en/core-libraries/email.html)\
[https://book.cakephp.org/4/en/views/helpers/form.html](https://book.cakephp.org/4/en/views/helpers/form.html)\
[https://fakerphp.github.io/](https://fakerphp.github.io/)
[https://book.cakephp.org/4/en/core-libraries/email.html#sending-emails-without-using-mailer](https://book.cakephp.org/4/en/core-libraries/email.html#sending-emails-without-using-mailer)