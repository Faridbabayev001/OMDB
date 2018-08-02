<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * OMDB PHP API class - API 'http://www.omdbapi.com/'
 * API Documentation: http://www.omdbapi.com/
 * Documentation and usage in README file
 *
 * @author Farid Babayev
 * @copyright Farid Babayev
 * @version 1.0
 */

class Omdb
{

	const GET = 'get0';
	const API_URL = "http://www.omdbapi.com/";
	const POSTER_API_URL = "http://img.omdbapi.com/";
	const VERSION = '1.5.1';

	/**
	 * CI Singleton
	 *
	 * @var object
	 */
	protected $CI;

	/**
	 *  The API-key
	 * @var string
	 */
	protected $api_key;

	/**
	 * Omdb constructor.
	 * @throws OmdbException
	 * @return void
	 */
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->config('omdb');
		$this->setApiKey();
	}

	/**
	 * @param array $params
	 * @throws OmdbException
	 * @return mixed
	 */
	public function getMovie(array $params)
	{
		$this->_sendRequest($params);
	}

	/**
	 *  Set API-key from config file
	 * @throws OmdbException
	 */
	public function setApiKey()
	{
		$apiKey = $this->CI->config->item('omdbapi');
		if (!empty($apiKey))
		{
			$this->api_key = $apiKey;
		}
		else
		{
			throw new OmdbException('API key is required');
		}
	}

	/**
	 *  Send request request to url (http://www.omdbapi.com/) with query string
	 * @param null $params
	 * @return mixed
	 * @throws OmdbException
	 */
	private function _sendRequest($params = null)
	{
		$params = (!is_array($params)) ? array() : $params;
		$params['apikey'] = $this->api_key;
		$query = http_build_query($params,'', '&');
		$url = Omdb::API_URL . "?" . $query;
		if (extension_loaded('curl'))
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			$json = curl_exec($ch);
			curl_close($ch);
			$result = json_decode($json);
			return $result;
		}
		else
		{
			throw  new OmdbException('CURL-extension not loaded');
		}
	}
}

/**
 * Omdb Exception class
 * @author  Farid Babayev
 */
class OmdbException extends Exception
{

}
