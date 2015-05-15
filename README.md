# Google Places API Library for Yii2

[![Latest Version](https://img.shields.io/github/tag/2amigos/yii2-google-places-library.svg?style=flat-square&label=release)](https://github.com/2amigos/yii2-google-places-library/tags)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/2amigos/yii2-google-places-library/master.svg?style=flat-square)](https://travis-ci.org/2amigos/yii2-google-places-library)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/2amigos/yii2-google-places-library.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-google-places-library/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/2amigos/yii2-google-places-library.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-google-places-library)
[![Total Downloads](https://img.shields.io/packagist/dt/2amigos/yii2-google-places-library.svg?style=flat-square)](https://packagist.org/packages/2amigos/yii2-google-places-library)

Extension library to interact with [Google Places API](https://developers.google.com/places/documentation/index)

Hey! We are on TutsPlus, check out its [tutorial about geolocation and google places](http://code.tutsplus.com/tutorials/building-your-startup-with-php-geolocation-and-google-places--cms-22729)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require 2amigos/yii2-google-places-library:~1.0
```

or add

```
"2amigos/yii2-google-places-library": "~1.0"
```

to the `require` section of your `composer.json` file.

## Usage

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

## Testing

```bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Antonio Ramirez](https://github.com/tonydspaniard)
- [Alexander Kochetov](https://github.com/creocoder)
- [All Contributors](https://github.com/2amigos/yii2-google-places-library/graphs/contributors)

## License

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.

<blockquote>
    <a href="http://www.2amigos.us"><img src="http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png"></a><br>
    <i>web development has never been so fun</i><br>
    <a href="http://www.2amigos.us">www.2amigos.us</a>
</blockquote>
