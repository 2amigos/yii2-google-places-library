<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\google\places;

use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class Place handles place details requests and common actions.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\places
 */
class Place extends Client
{

	/**
	 * Returns the details of a place.
	 * @see https://developers.google.com/places/documentation/details
	 * @see https://spreadsheets.google.com/pub?key=p9pdwsai2hDMsLkXsoM05KQ&gid=1
	 * @param string $reference the place reference
	 * @param string $language the language to return the results. Defaults to 'en' (english).
	 * @param array $params optional parameters
	 * @return mixed|null
	 */
	public function details($reference, $language = 'en', $params = [])
	{
		$params['reference'] = $reference;
		$params['language'] = $language;
		$params['sensor'] = ArrayHelper::getValue($params, 'sensor', 'false');

		return $this->request('details', $params);
	}

	/**
	 * Returns a photo content.
	 * @see https://developers.google.com/places/documentation/photos#place_photo_requests
	 * @param string $reference string identifier that uniquely identifies a photo. Photo references are returned from
	 * either a [[Search::text]], [[Search::nearby]], [[Search::radar]] or [[Place::details]] request.
	 * @param array $params optional parameters.
	 * @throws \yii\base\InvalidParamException
	 * @return mixed|null
	 */
	public function photo($reference, $params = [])
	{
		if (!isset($params['maxheight']) && !isset($params['maxwidth'])) {
			throw new InvalidParamException('You must set "maxheight" or "maxwidth".');
		}
		$params['photoreference'] = $reference;
		$params['sensor'] = ArrayHelper::getValue($params, 'sensor', 'false');
		$params['key'] = $this->key;
		$url = str_replace('/{format}', '', $this->api);
		$url = str_replace('{cmd}', 'photo', $url);
		$response = $this->getGuzzleClient()->get($url, ['query' => $params]);

		return $response->getBody();
	}

	/**
	 * Adds a place on Google's places database for your application. This function only works with JSON formats, that
	 * means that no matter what you set the [[$format]] to work with, it will be superseded by 'json' type.
	 * @see https://developers.google.com/places/documentation/actions#adding_a_place
	 * @param string $location The textual latitude/longitude value from which you wish to add new place information.
	 * @param string $name The full text name of the place. Limited to 255 characters.
	 * @param array $types The category in which this place belongs.
	 * @param string $accuracy The accuracy of the location signal on which this request is based, expressed in meters.
	 * @param string $language The language in which the place's name is being reported.
	 * @param bool $sensor Indicates whether or not the place request came from a device using a location sensor
	 * (e.g. a GPS) to determine the location sent in this request. This value must be either true or false.
	 * @return array
	 * @throws \yii\base\InvalidParamException
	 */
	public function add($location, $name, $types, $accuracy, $language = 'en', $sensor = false)
	{
		if (strlen($name) > 255) {
			throw new InvalidParamException('"$name" cannot be larger than 255 chars');
		}
		$types = (array)$types;
		$data = [];
		$data['location'] = $location;
		$data['name'] = $name;
		$data['types'] = $types;
		$data['accuracy'] = $accuracy;
		$data['language'] = $language;

		$url = str_replace('{format}', 'json', $this->api);
		$url = str_replace('{cmd}', 'add', $url);

		$response = $this->getGuzzleClient()->post($url, [
			'query' => [
				'key' => $this->key,
				'sensor' => $sensor ? 'true' : 'false',
			],
			'body' => Json::encode($data)
		]);

		return $response->json();
	}

	/**
	 * Deletes a place. A place can only be deleted if:
	 * - It was added by the same application as is requesting its deletion.
	 * - It has not successfully passed through the Google Maps moderation process, and and is therefore not visible to
	 * all applications.
	 * @param string $reference The textual identifier that uniquely identifies this place
	 * @param bool $sensor Indicates whether or not the place request came from a device using a location sensor
	 * (e.g. a GPS) to determine the location sent in this request. This value must be either true or false.
	 * @return array
	 */
	public function delete($reference, $sensor = false)
	{
		$url = str_replace('{format}', 'json', $this->api);
		$url = str_replace('{cmd}', 'delete', $url);

		$response = $this->getGuzzleClient()->post($url, [
			'query' => [
				'key' => $this->key,
				'sensor' => $sensor ? 'true' : 'false',
			],
			'body' => Json::encode(['reference' => $reference])
		]);

		return $response->json();
	}

	/**
	 * Bumps an event. Format is superseded by 'json'.
	 * @see https://developers.google.com/places/documentation/actions#BumpRequests
	 * @param string $reference The reference value of the Place to which the event is attached.
	 * @param bool $sensor Indicates whether or not the request came from a device using a location sensor (e.g. a GPS).
	 * This value must be either true or false.
	 * @return array
	 */
	public function bump($reference, $sensor = false)
	{
		$data['reference'] = $reference;

		$url = strtr($this->api, ['{format}' => 'json', '{cmd}' => 'bump']);

		$response = $this->getGuzzleClient()->post($url, [
			'query' => [
				'key' => $this->key,
				'sensor' => $sensor ? 'true' : 'false'
			],
			'body' => Json::encode($data)
		]);

		return $response->json();
	}

} 