Google Places API Library for Yii2
==================================

Extension library to interact with [Google Places API](https://developers.google.com/places/documentation/index)

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require "2amigos/yii2-google-places-library" "*"
```
or add

```json
"2amigos/yii2-google-places-library" : "*"
```

to the require section of your application's `composer.json` file.

Usage
-----

Using `Search` class:

```
$search = new Search(['key' => '{YOURGOOGLEAPIKEY}']);

// $this->format = 'xml'; // if you wish to handle XML responses (JSON is highly recommended)


// If you setup the format in 'xml', the returned value will be an array.
// The library will decode the response automatically
var_dump($search->text('restaurants in Inca Mallorca'));

```

Using `Place` class:

```
$place = new Place(['key' => '{YOURGOOGLEAPIKEY}']);

// $this->format = 'xml'; // if you wish to handle XML responses (JSON is highly recommended)


$place->details('{REFERENCEIDOFPLACE}'));

```

Further Information
-------------------

For further information regarding the multiple parameters of Google Places please visit
[its API reference](https://developers.google.com/places/documentation/index)


> [![2amigOS!](http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png)](http://www.2amigos.us)

<i>Web development has never been so fun!</i>
[www.2amigos.us](http://www.2amigos.us)