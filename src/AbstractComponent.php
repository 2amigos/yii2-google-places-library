<?php

/*
 * This file is part of the 2amigos/yii2-google-places-library project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace dosamigos\google\places;

use Da\Google\Places\Client\AbstractClient;
use Da\Google\Places\Client\PlaceClient;
use Da\Google\Places\Client\SearchClient;
use yii\base\Component;
use yii\base\InvalidConfigException;

abstract class AbstractComponent extends Component
{
    /**
     * @var string response format. Can be json or xml.
     */
    public $format = 'json';
    /**
     * @var string your API key
     */
    public $key;
    /**
     * @var return json results as arrays instead of objects
     */
    public $forceJsonArrayResponse = false;
    /**
     * @var AbstractClient|PlaceClient|SearchClient
     */
    protected $client;

    /**
     * Wraps PlaceClient methods.
     *
     * @param string $name
     * @param array  $params
     *
     * @return mixed
     */
    public function __call($name, $params)
    {
        if (method_exists($this->getClient(), $name)) {
            return call_user_func_array([$this->getClient(), $name], $params);
        }

        return parent::__call($name, $params);
    }

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (empty($this->key) || empty($this->format)) {
            throw new InvalidConfigException('"key" and/or "format" cannot be empty.');
        }

        parent::init();
    }

    /**
     * @return AbstractClient|PlaceClient|SearchClient
     */
    abstract public function getClient();
}
