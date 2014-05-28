<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\google\places;

use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;

/**
 * Class Search handles places searching requests.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\places
 */
class Search extends Client
{
	/**
	 * Returns places within a specific area.
	 * @see https://developers.google.com/places/documentation/search
	 * @see https://developers.google.com/places/documentation/supported_types
	 * @see https://spreadsheets.google.com/pub?key=p9pdwsai2hDMsLkXsoM05KQ&gid=1
	 * @param string $location The latitude/longitude around which to retrieve Place information.
	 * This must be specified as latitude,longitude.
	 * @param array $params optional parameters
	 * @return mixed|null
	 * @throws \yii\base\InvalidParamException
	 */
	public function nearby($location, $params = [])
	{
		$rankBy = trim(strtolower(ArrayHelper::getValue($params, 'rankby', 'prominence')));
		if (!in_array($rankBy, ['distance', 'prominence'])) {
			throw new InvalidParamException("Unrecognized rank '$rankBy'");
		}
		if ($rankBy == 'distance') {
			if (!isset($params['keyword']) && !isset($params['name']) && !isset($params['types'])) {
				throw new InvalidParamException(
					'When using "rankby":"distance", you must specify at least one of the following: keyword, name, types.');
			}
			ArrayHelper::remove($params, 'radius');
		}
		if ($rankBy == 'prominence' && !isset($params['radius'])) {
			throw new InvalidParamException('When using "rankby":"prominence" you must specify a radius.');
		}

		$params['location'] = $location;
		$params['sensor'] = ArrayHelper::getValue($params, 'sensor', 'false');

		return $this->request('nearbysearch', $params);
	}

	/**
	 * Returns places based on a string.
	 * @see https://developers.google.com/places/documentation/search#TextSearchRequests
	 * @param string $query The text string on which to search, for example: "restaurant". The Place service will return
	 * candidate matches based on this string and order the results based on their perceived relevance.
	 * @param array $params optional parameters
	 * @return mixed|null
	 */
	public function text($query, $params = [])
	{
		$params['query'] = $query;
		$params['sensor'] = ArrayHelper::getValue($params, 'sensor', 'false');

		return $this->request('textsearch', $params);
	}

	/**
	 * Returns places of a specific area.
	 * @param string $location The latitude/longitude around which to retrieve Place information. This must be specified
	 * as latitude,longitude.
	 * @param string $radius Defines the distance (in meters) within which to return Place results. The maximum allowed
	 * radius is 50 000 meters.
	 * @param array $params optional parameters
	 * @return mixed|null
	 * @throws \yii\base\InvalidParamException
	 */
	public function radar($location, $radius, $params = [])
	{
		if (!isset($params['keyword']) && !isset($params['name']) && !isset($params['types'])) {
			throw new InvalidParamException('When using radar you must include at least one of keyword, name, or types.');
		}
		$params['location'] = $location;
		$params['radius'] = $radius;
		$params['sensor'] = ArrayHelper::getValue($params, 'sensor', 'false');

		return $this->request('radarsearch', $params);
	}

	/**
	 * Returns place predictions based on specific text and optional geographic bounds.
	 * @see https://developers.google.com/places/documentation/autocomplete#place_autocomplete_requests
	 * @see https://developers.google.com/places/documentation/autocomplete#example_autocomplete_requests
	 * @param string $input The text string on which to search. The Place Autocomplete service will return candidate
	 * matches based on this string and order results based on their perceived relevance.
	 * @param string $language The language in which to return results.
	 * @param array $params optional parameters
	 * @return mixed|null
	 */
	public function autoComplete($input, $language = 'en', $params = [])
	{
		$params['input'] = $input;
		$params['sensor'] = ArrayHelper::getValue($params, 'sensor', 'false');
		$params['language'] = $language;

		return $this->request('autocomplete', $params);
	}
} 