Iridium Components Http Stack
===========================

[![Build Status](https://travis-ci.org/awakenweb/Iridium-components-httpstack.png?branch=master)](https://travis-ci.org/awakenweb/Iridium-components-httpstack)

HTTP Stack for Iridium Framework. Work as a standalone library but best used with full stack framework

This component contains 4 main elements:
- Request: the request sent by the client
- Response: the response sent by your application
- Header: headers sent alongside the response
- Cookie: cookies sent alongside the response

This allows you to have an abstraction layer to manipulate data from the client and the response you send to answer it.

The class is unit tested using [Atoum](https://github.com/atoum/atoum).
Installation
------------

### Prerequisites

***Iridium requires at least PHP 5.4+ to work.***

Some of Iridium components may work on PHP5.3 but no support will be provided for this version.

### Using Composer
First, install [Composer](http://getcomposer.org/ "Composer").
Create a composer.json file at the root of your project. This file must at least contain :
```json
    {
        "require": {
            "awakenweb/iridium-components-httpstack": "dev-master"
            }
    }
```
and then run

    ~$ composer install

Request
-------
### Usage

```php
<?php
include('path/to/vendor/autoload.php');
use Iridium\Components\HttpStack;

$request = new HttpStack\Request();

// The following method will return the request URI or the Path Info if
// it has been defined in the php.ini
$request->getPathInfo();

// This method will return corresponding values from the $_SERVER superglobal
$request->getRequestTime();
$request->getReferer();
$request->getUserAgent();
$request->getLanguage();
 
// the following methods are used to get the IP address of
// the client. If a proxy is detected via the HTTP_X_FORWARDED_FOR
// header, getIp() will return the true IP, and Proxy IP will be
// available through the getProxyIp() method
$request->getIp();
$request->hasProxy();
$request->getProxyIp();


// let you know specific informations about the way the request was sent.
// detecs if SSL has been used, if the request has been sent through Ajax
// or flash
$request->isHttps();
$request->isXmlHttpRequest();
$request->isFlash();

// HTTP Verbs related methods, see next paragraph for more informations
$request->getRequestMethod();
$request->isPost();
$request->post( 'test', 'I am defining a value' ); // setter
$request->post('test'); // getter. Will return the string 'I am defining a value'

// alias for $_COOKIE[$name]
$request->cookie( $name );

```
HttpStack recognizes the following HTTP Verbs that you can use with 
- **get**:      `isGet()` and `get()`
- **put**:      `isPut()` and `put()`
- **post**:     `isPost()` and `post()`
- **patch**:    `isPatch()` and `patch()`
- **delete**:   `isDelete()` and `delete()`
- **head**:     `isHead()` and `head()`
- **trace**:    `isTrace()` and `trace()`
- **options**:  `isOptions()` and `options()`

Response
--------
### Usage

This class is the main reason the Header and Cookie class exists: it allows you to centralize every header, cookie and content you want to send, and send it all at the same time to avoid _"headers already sent"_ conflicts.

Be sure to avoid using "echo" before using the `send()` method.

```php
<?php
include('path/to/vendor/autoload.php');
use Iridium\Components\HttpStack;

$response = new HttpStack\Response();

$head = new HttpStack\Header( 'HTTP/1.1 200 OK' );
$cookie = new HttpStack\Cookie( 'hello Cookie', 'cookie content');
$content =
      '<!doctype html>'
    . '<html lang="en">'
    . '<head>'
    . '<title>This is an example</title>
    . '</head>'
    . '<body>'
    . '<h1>This is the content!</h1>'
    . '<p>Lorem Ipsum Sit Amet...</p>'
    . '</body>'
    . '</html>';
$response->addHeader( $head )
         ->addCookie( $cookie )
         ->addToBody($content);
$response->send();

```