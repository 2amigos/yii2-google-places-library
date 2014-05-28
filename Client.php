<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\google\places;

use GuzzleHttp\Client as HttpClient;
use Guzzle\Http\Exception\RequestException;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class Client is the base class of all objects in library. Handles common requests and Guzzle PHP client initialization.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\places
 */
class Client extends Component
{
	/**
	 * @var string response format. Can be json or xml.
	 */
	public $format = 'json';
	/**
	 * @var string API endpoint
	 */
	public $api = 'https://maps.googleapis.com/maps/api/place/{cmd}/{format}';
	/**
	 * @var string your API key
	 */
	public $key;
	/**
	 * @var \Guzzle\Http\Client a client to make requests to the API
	 */
	private $_guzzle;

	/**
	 * Initializes the object.
	 * This method is invoked at the end of the constructor after the object is initialized with the
	 * given configuration.
	 * @throws \yii\base\InvalidConfigException
	 */
	public function init()
	{
		if (empty($this->key) || empty($this->format)) {
			throw new InvalidConfigException('"key" and "format" cannot be empty.');
		}
	}

	/**
	 * Required for child classes
	 * @param string $cmd the command
	 * @return string
	 */
	public function getUrl($cmd)
	{
		return strtr($this->api, ['{cmd}' => $cmd, '{format}' => $this->format]);
	}

	/**
	 * Makes a Url request and returns its response
	 * @param string $cmd the command
	 * @param array $params the parameters to be bound to the call
	 * @param array $options the options to be attached to the client
	 * @return mixed|null
	 */
	protected function request($cmd, $params = [], $options = [])
	{
		try {

			$params = ArrayHelper::merge($params, ['key' => $this->key]);

			$response = $this->getGuzzleClient()->get($this->getUrl($cmd), ArrayHelper::merge(['query' => $params], $options));

			return $this->format == 'xml'
				? $response->xml()
				: $response->json();

		} catch (RequestException $e) {
			return null;
		}
	}

	/**
	 * Returns the guzzle client
	 * @return \GuzzleHttp\Client
	 */
	protected function getGuzzleClient()
	{
		if ($this->_guzzle == null) {
			$this->_guzzle = new HttpClient();
		}
		return $this->_guzzle;
	}

} 