# Pili Streaming Cloud Server-Side Library For PHP

## Features

- App
    - [x] 创建房间: room->createRoom()
    - [x] 查看房间: room->getRoom()
    - [x] 删除房间: room->deleteRoom()
    - [x] 生成房间token: room->roomToken()



## Contents

- [Installation](#installation)
- [Usage](#usage)
    - [Configuration](#configuration)
    - [URL](#url)
        - [Generate RTMP publish URL](#generate-rtmp-publish-url)
        - [Generate RTMP play URL](#generate-rtmp-play-url)
        - [Generate HLS play URL](#generate-hls-play-url)
        - [Generate HDL play URL](#generate-hdl-play-url)
        - [Generate snapshot play URL](#generate-snapshot-play-url)
    - [Hub](#hub)
        - [Instantiate a pili hub object](#instantiate-a-pili-hub-object)
        - [Create a new stream](#create-a-new-stream)
        - [Get a stream](#get-a-stream)
        - [List streams](#list-streams)
        - [List live streams](#list-live-streams)
    - [Stream](#stream)
        - [Get stream info](#get-stream-info)
        - [Disable a stream](#disable-a-stream)
        - [Enable a stream](#enable-a-stream)
        - [Get stream live status](#get-stream-live-status)
        - [Get stream history activity](#get-stream-history-activity)
        - [Save stream live playback](#save-stream-live-playback)
    - [Room](#room)
        - [Create a room](#create-a-room)
        - [Get a room](#get-a-room)
        - [Delete a room](#delete-a-room)
        - [Generate a room token](#generate-a-room-token)


## Installation

### Requirements

- PHP >= 5.3.0

### Install with Composer

If you're using [Composer](http://getcomposer.org) to manage dependencies, you can add pili-sdk-php with it.

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

You can add Pili as a dependency using the `composer.phar` CLI:

```bash
php composer.phar require pili-engineering/pili-sdk-php.v2:dev-master
```

Alternatively, you can specify pili-sdk-php as a dependency in your project's
existing `composer.json` file:

```js
{
    "require": {
        "pili-engineering/pili-sdk-php.v2": "dev-master"
    }
}
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

You can find out more on how to install Composer, configure autoloading, and
other best-practices for defining dependencies at <http://getcomposer.org>.

### Install source from GitHub

The `pili-sdk-php` requires PHP `v5.3+`. Download the PHP library from Github, and require in your script like so:

To install the source code:

```bash
$ git clone https://github.com/pili-engineering/pili-sdk-php.v2.git
```

And include it in your scripts:

```php
require_once '/path/to/pili-sdk-php/lib/Pili_v2.php';
```

### Install source from zip/tarball

Alternatively, you can fetch a [tarball](https://github.com/pili-engineering/pili-sdk-php/tarball/master) or [zipball](https://github.com/pili-engineering/pili-sdk-php/zipball/master):

```bash
$ curl -L https://github.com/pili-engineering/pili-sdk-php.v2/tarball/master | tar xzv

(or)

$ wget https://github.com/pili-engineering/pili-sdk-php.v2/tarball/master -O - | tar xzv
```

And include it in your scripts:

```php
require_once '/path/to/pili-sdk-php/lib/Pili_v2.php';
```


## Usage

### Configuration

```php
    // Change API host as necessary
    //
    // pili.qiniuapi.com as default
    // pili-lte.qiniuapi.com is the latest RC version
    //
    // $cfg = \Pili\Config::getInstance();
    // $cfg->API_HOST = 'pili.qiniuapi.com'; // default
```

### Room

#### Create a room

```php
$ak = "Tn8WCjE_6SU7q8CO3-BD-yF4R4IZbHBHeL8Q9t";
$sk = "vLZNvZDojo1F-bYOjOqQ43-NYqlKAej0e9OweInh";
$mac = new Qiniu\Pili\Mac($ak, $sk);
$client = new Qiniu\Pili\RoomClient($mac);
$resp=$client->createRoom("901","testroom");
print_r($resp);
```

#### Get a room

```php
$ak = "Tn8WCjE_6SU7q8CO3-BD-yF4R4IZbHBHeL8Q9t";
$sk = "vLZNvZDojo1F-bYOjOqQ43-NYqlKAej0e9OweInh";
$mac = new Qiniu\Pili\Mac($ak, $sk);
$client = new Qiniu\Pili\RoomClient($mac);
$resp=$client->getRoom("testroom");
print_r($resp);
```

#### Delete a room

```php
$ak = "Tn8WCjE_6SU7q8CO3-BD-yF4R4IZbHBHeL8Q9t";
$sk = "vLZNvZDojo1F-bYOjOqQ43-NYqlKAej0e9OweInh";
$mac = new Qiniu\Pili\Mac($ak, $sk);
$client = new Qiniu\Pili\RoomClient($mac);
$resp=$client->deleteRoom("testroom");
print_r($resp);
```

#### Generate a room token

```php
$ak = "Tn8WCjE_6SU7q8CO3-BD-yF4R4IZbHBHeL8Q9t";
$sk = "vLZNvZDojo1F-bYOjOqQ43-NYqlKAej0e9OweInh";
$mac = new Qiniu\Pili\Mac($ak, $sk);
$client = new Qiniu\Pili\RoomClient($mac);
$resp=$client->roomToken("testroom","123",'admin',1785600000000);
print_r($resp);
```