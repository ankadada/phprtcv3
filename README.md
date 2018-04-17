# Pili Streaming Cloud Server-Side Library For PHP

## Features

- Room
    - [x] 创建房间: room->createRoom()
    - [x] 查看房间: room->getRoom()
    - [x] 删除房间: room->deleteRoom()
    - [x] 生成房间token: room->roomToken()



## Contents

- [Installation](#installation)
- [Usage](#usage)
    - [Configuration](#configuration)
    - [Room](#room)
        - [Create a room](#create-a-room)
        - [Get a room](#get-a-room)
        - [Delete a room](#delete-a-room)
        - [Generate a room token](#generate-a-room-token)


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