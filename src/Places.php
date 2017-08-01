<?php

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

        return $this->client;
    }
}
