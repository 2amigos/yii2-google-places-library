Google Places API Library for Yii2
==================================

[![Packagist Version](https://img.shields.io/packagist/v/2amigos/yii2-google-places-library.svg?style=flat-square)](https://packagist.org/packages/2amigos/yii2-google-places-library)
[![Latest Stable Version](https://poser.pugx.org/2amigos/yii2-usuario/version)](https://packagist.org/packages/2amigos/yii2-google-places-library)
[![Total Downloads](https://poser.pugx.org/2amigos/yii2-google-places-library/downloads)](https://packagist.org/packages/2amigos/yii2-google-places-library)
[![Latest Unstable Version](https://poser.pugx.org/2amigos/yii2-google-places-library/v/unstable)](//packagist.org/packages/2amigos/yii2-google-places-library)  
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/2amigos/yii2-google-places-library/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/2amigos/yii2-google-places-library/?branch=master)

Extension library to interact with [Google Places API](https://developers.google.com/places/documentation/index) by 
wrapping the methods of our [2amigos/google-places-library](https://github.com/2amigos/google-places-library) into Yii2 
components. 

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

The preferred way is to setup the components into our Application's configuration array: 

```php 
'components' => [
    'places' => [
         'class' => '\dosamigos\google\places\Places',
         'key' => '{your-google-api-key-with-places-activated}',
         'format' => 'json', // or 'xml'
         'forceJsonArrayResponse' => true // for decoding responses to arrays instead of objects
     ],
     'placesSearch' => [
         'class' => '\dosamigos\google\places\Search',
         'key' => '{your-google-api-key-with-places-activated}',
         'format' => 'json' // or 'xml'
     ]

]

```

That's it, you are ready to use them as Yii2 components. 


**Using Search Component**

```php
// If you setup the format in 'json', the returned value will be an array. If 'xml', it will return a SimpleXmlElement.
var_dump(Yii::$app->search->text('restaurants in Inca Mallorca'));

```

**Using Places component**

```php
var_dump(Yii::$app->place->details('{REFERENCEIDOFPLACE}'));

```

Further Information
-------------------

For further information regarding the multiple parameters of Google Places please visit
[its API reference](https://developers.google.com/places/documentation/index) and our standalone library 
[2amigos/google-places-library](https://github.com/2amigos/google-places-library)

<blockquote>
    <a href="http://www.2amigos.us"><img src="http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png"></a><br>
    <i>Custom Software Development | Web & Mobile Development Software</i><br> 
    <a href="http://www.2amigos.us">www.2amigos.us</a>
</blockquote>
