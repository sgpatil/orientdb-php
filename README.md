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

---

## Create Class
```php
 $user = $client->makeClass("User", function($property){
        $property->string("name");
        $property->integer("age");
        $property->timestamp("datetime");
    })->save();
```
### Supporting Datatype
| Commands  |
|-----------|
|$property->short('&lt;field_name&gt;'); 	
|$property->integer('&lt;field_name&gt;'); 	
|$property->long('&lt;field_name&gt;'); 	
|
|$property->byte('&lt;field_name&gt;'); 	
|$property->boolean('&lt;field_name&gt;'); 
|
|$property->float('&lt;field_name&gt;'); 	
|$property->double('&lt;field_name&gt;'); 	
|
|$property->datetime('&lt;field_name&gt;'); 	
|$property->date('&lt;field_name&gt;'); 
|$property->timestamp('&lt;field_name&gt;');	
|
|$property->string('&lt;field_name&gt;'); 
|$property->binary('&lt;field_name&gt;'); 
|
|$property->embedded('&lt;field_name&gt;');
|$property->embeddedlist('&lt;field_name&gt;');
|$property->embeddedset('&lt;field_name&gt;');
|
|$property->link('&lt;field_name&gt;');
|$property->linklist('&lt;field_name&gt;');
|$property->linkset('&lt;field_name&gt;');
|$property->linkmap('&lt;field_name&gt;');
|$property->linkbag('&lt;field_name&gt;');
|
|$property->custom('&lt;field_name&gt;');
|$property->any('&lt;field_name&gt;');
