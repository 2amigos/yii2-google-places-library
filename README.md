Google Places API Library for Yii2
==================================

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
        'format' => 'json' // or 'xml'
    ],
    'placesSearch' => [
        'class' => '\dosamigos\google\places\Search',
        'key' => '{your-google-api-key-with-places-activated}',
        'format' => 'json' // or 'xml'
    ]

]

```

That's it, you are ready to use them as Yii2 components. 


###Using `Search` Component

```
// If you setup the format in 'json', the returned value will be an array. If 'xml', it will return a SimpleXmlElement.
var_dump(Yii::$app->search->text('restaurants in Inca Mallorca'));

```

###Using `Places` component:

```
var_dump(Yii::$app->place->details('{REFERENCEIDOFPLACE}'));

```

Further Information
-------------------

For further information regarding the multiple parameters of Google Places please visit
[its API reference](https://developers.google.com/places/documentation/index) and our standalong library 
[2amigos/google-places-library](https://github.com/2amigos/google-places-library)

<blockquote>
    <a href="http://www.2amigos.us"><img src="http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png"></a><br>
    <i>Custom Software Development | Web & Mobile Development Software</i><br> 
    <a href="http://www.2amigos.us">www.2amigos.us</a>
</blockquote>
