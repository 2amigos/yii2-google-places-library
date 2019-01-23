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

use Da\Google\Places\Client\SearchClient;

/**
 * Inherited methods from SearchClient
 *
 * @see SearchClient
 *
 * @method nearby(string $location, array $params)
 * @method text(string $query, array $params)
 * @method radar(string $location, string $radius, array $params)
 * @method autoComplete(string $input, string $language, array $params)
 */
class Search extends AbstractComponent
{
    /**
     * @return SearchClient
     */
    public function getClient()
    {
        if (null === $this->client) {
            $this->client = new SearchClient($this->key, $this->format);
        }

        $this->client->forceJsonArrayResponse($this->forceJsonArrayResponse);

        return $this->client;
    }
}
