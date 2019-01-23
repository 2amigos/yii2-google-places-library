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

use Da\Google\Places\Client\PlaceClient;

/**
 * Inherited methods from PlaceClient
 *
 * @see PlaceClient
 *
 * @method details(string $placeid, string $language, array $params) Returns the details of a place.
 * @method photo(string $reference, array $params) Returns a photo content.
 * @method add(array $location, string $name, array $types, string $accuracy, string $language, array $params)
 * @method delete(string $reference)
 */
class Places extends AbstractComponent
{
    /**
     * @return PlaceClient
     */
    public function getClient()
    {
        if (null === $this->client) {
            $this->client = new PlaceClient($this->key, $this->format);
        }

        $this->client->forceJsonArrayResponse($this->forceJsonArrayResponse);

        return $this->client;
    }
}
