<?php
namespace Sgpatil\Orientphp;

/**
 * Class for communicating with an HTTP JSON endpoint
 */
abstract class Transport
{
	const GET    = 'GET';
	const POST   = 'POST';
	const PUT    = 'PUT';
	const DELETE = 'DELETE';

	protected $scheme = 'http';
	protected $host = 'localhost';
	protected $port = 2480;
        protected $database = null;
        protected $command = '';
	protected $path = '';
	protected $username = null;
	protected $password = null;

	protected $handle = null;

	/**
	 * Set the host and port of the endpoint
	 *
	 * @param string $host
	 * @param integer $port
	 */
	public function __construct($host='localhost', $port=2480, $database=null)
	{
		$this->host = $host;
		$this->port = $port;
                $this->setDatabaseName($database);
	}

        public function getDatabaseName()
	{
		return $this->database; 
	}
        
        public function setDatabaseName($dbname=null)
	{
            if($dbname==null){
                $this->database = "";
            }else{
		$this->database = "/{$dbname}";
            }
	}
        
	/**
	 * Return the Neo4j REST endpoint
	 *
	 * @return string
	 */
	public function getEndpoint()
	{
		return "{$this->scheme}://{$this->host}:{$this->port}{$this->command}{$this->path}";
	}
        


	/**
	 * Encode data for transport
	 *
	 * @param mixed $data
	 * @return string
	 */
	public function encodeData($data)
	{
		$encoded = '';
		if (!is_scalar($data)) {
			if ($data) {
				$keys = array_keys($data);
				$nonNumeric = array_filter($keys, function ($var) {
					return !is_int($var);
				});
				if ($nonNumeric) {
					$data = (object)$data;
				}
			} else {
				$data = (object)$data;
			}
		}

		$encoded = json_encode($data);
		return $encoded;
	}

	/**
	 * Make a request against the endpoint
	 * Returned array has the following elements:
	 *   'code' => the HTTP status code returned
	 *   'headers' => array of HTTP headers, indexed by header name
	 *   'data' => array return data
	 *
	 * @param string $method
	 * @param string $path
	 * @param array  $data
	 * @return array
	 */
	abstract public function makeRequest($method, $path, $data=array());

	/**
	 * Make a GET request
	 *
	 * @param $path
	 * @param $data
	 * @return array see 'makeRequest'
	 */
	public function get($path, $data=array())
	{
		return $this->makeRequest(self::GET, $path, $data);
	}

	/**
	 * Make a POST request
	 *
	 * @param $path
	 * @param $data
	 * @return array see 'makeRequest'
	 */
	public function post($path, $data=array())
	{
		return $this->makeRequest(self::POST, $path, $data);
	}

	/**
	 * Make a PUT request
	 *
	 * @param $path
	 * @param $data
	 * @return array see 'makeRequest'
	 */
	public function put($path, $data=array())
	{
		return $this->makeRequest(self::PUT, $path, $data);
	}

	/**
	 * Make a DELETE request
	 *
	 * @param $path
	 * @return array see 'makeRequest'
	 */
	public function delete($path)
	{
		return $this->makeRequest(self::DELETE, $path);
	}

	/**
	 * Set username and password to use with HTTP Basic Auth
	 *
	 * Returns this Trnasport object
	 *
	 * @param string $username
	 * @param string $password
	 * @return Transport
	 */
	public function setAuth($username=null, $password=null)
	{
		$this->username = $username;
		$this->password = $password;
		return $this;
	}

	/**
	 * Turn HTTPS on or off
	 *
	 * Returns this Trnasport object
	 *
	 * @param boolean $useHttps
	 * @return Transport
	 */
	public function useHttps($useHttps=true)
	{
		$this->scheme = $useHttps ? 'https' : 'http';
		return $this;
	}
        
        /**
	 * Set username and password to use with HTTP Basic Auth
	 *
	 * Returns this Trnasport object
	 *
	 * @param string $username
	 * @param string $password
	 * @return Transport
	 */
	public function setCommand($command)
	{
		$this->command = $command;
		return $this;
	}
}
