Orientdb-php
========
Author: Sumit Patil <sgpatil.2803@gmail.com>  
Copyright (c) 2014-2015

PHP Wrapper for the Orientdb graph database REST interface

 - [Installation](#installation)
 - [Database Connection](#connection)

## Installation

Add the package to your `composer.json` 

```json
{
    "require": {
        "sgpatil/orientdb-php": "dev-master"
    }
}
```
## Connection

```php

$client = new Sgpatil\Orientphp\Client(<server>, <port>, <database_name>);

$client->getTransport()
       ->setAuth(<database_user_name>, <database_password>);
```

If you are using default configuration then the code should be

```php

$client = new Sgpatil\Orientphp\Client("localhost", 2480, <database_name>);

$client->getTransport()
       ->setAuth('root', 'root');
```

To check database connection.

```php
print_r($client->getServerInfo());
```
This will display server information.
