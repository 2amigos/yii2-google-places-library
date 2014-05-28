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
 * Class Event handles events actions.
 *
 * From Google Places doc:
 *
 * The Google Places API includes support for events, which are defined as any type of public or private gathering,
 * performance, or promotion that occurs at a location listed in the Places service.
 * The events service is intended to provide notice and information about events that are happening currently, so that
 * users can find or bump them. Events are included in place search results as soon as they are added, and expire after
 * their set duration has elapsed. Results will include events added by your application.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\places
 */
class Event extends Client
{

	/**
	 * Adds and event. Format will be superseded by 'json'.
	 * @see https://developers.google.com/places/documentation/actions#event_add
	 * @param string $reference The reference value of the place where the event is happening.
	 * @param string $duration The duration of the event, in seconds. The event's start time is considered to be the
	 * time at which it was added. Once the duration has elapsed, the event is removed from the search results
	 * (though it is still accessible with a details search).
	 * @param string $summary A textual description of the event. This property accepts a string (up to 255 characters),
	 * the contents of which are not sanitized by the server. Your application should be prepared to prevent or deal
	 * with attempted exploits, if necessary.
	 * @param array $params
	 * @return array
	 * @throws \yii\base\InvalidParamException
	 */
	public function add($reference, $duration, $summary, $params = [])
	{
		if (strlen($summary) > 255) {
			throw new InvalidParamException('"$summary" cannot be larger than 255 chars.');
		}
		$data['reference'] = $reference;
		$data['duration'] = $duration;
		$data['summary'] = $summary;
		$data['language'] = ArrayHelper::getValue($params, 'language', 'en');
		$data['url'] = ArrayHelper::getValue($params, 'url');

		$url = str_replace('{format}', 'json', $this->api);
		$url = str_replace('{cmd}', 'event/add', $url);

		$response = $this->getGuzzleClient()->post($url, [
			'query' => [
				'key' => $this->key,
				'sensor' => ArrayHelper::getValue($params, 'sensor', 'false'),
			],
			'body' => Json::encode(array_filter($data))
		]);

		return $response->json();
	}

	/**
	 * Deletes an event. Format will be superseded by 'json'.
	 * @see https://developers.google.com/places/documentation/actions#event_delete
	 * @param string $event_id The unique event_id for the event.
	 * @param string $reference The reference value of the Place to which the event is attached.
	 * @param bool $sensor Indicates whether or not the request came from a device using a location sensor (e.g. a GPS).
	 * This value must be either true or false.
	 * @return array
	 */
	public function delete($event_id, $reference, $sensor = false)
	{
		$data['event_id'] = $event_id;
		$data['reference'] = $reference;

		$url = strtr($this->api, ['{format}' => 'json', '{cmd}' => 'event/delete']);

		$response = $this->getGuzzleClient()->post($url, [
			'query' => [
				'key' => $this->key,
				'sensor' => $sensor ? 'true' : 'false'
			],
			'body' => Json::encode($data)
		]);

		return $response->json();
	}


	/**
	 * Returns the details of an event.
	 * @see https://developers.google.com/places/documentation/actions#event_details
	 * @param string $event_id The unique event_id for the event.
	 * @param string $reference The reference value of the Place to which the event is attached.
	 * @return mixed|null
	 */
	public function details($event_id, $reference)
	{
		$params['event_id'] = $event_id;
		$params['reference'] = $reference;

		return $this->request('event/details', $params);
	}

	/**
	 * Bumps an event. Format is superseded by 'json'.
	 * @see https://developers.google.com/places/documentation/actions#event_bump
	 * @param string $event_id The unique event_id for the event.
	 * @param string $reference The reference value of the Place to which the event is attached.
	 * @param bool $sensor Indicates whether or not the request came from a device using a location sensor (e.g. a GPS).
	 * This value must be either true or false.
	 * @return array
	 */
	public function bump($event_id, $reference, $sensor = false)
	{
		$data['event_id'] = $event_id;
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