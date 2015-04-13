<?php
namespace Sgpatil\Orientphp\Command;

use Sgpatil\Orientphp\Command,
	Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Classes;

/**
 * Create a class
 */
class CreateProperty extends Command
{
	protected $classes = null;

	/**
	 * Set the classes to drive the command
	 *
	 * @param Client $client
	 * @param Node $classes
	 */
	public function __construct(Client $client, Classes $classes)
	{
		parent::__construct($client);
		$this->classes = $classes;
	}

	/**
	 * Return the data to pass
	 *
	 * @return mixed
	 */
	protected function getData()
	{
            return $this->classes->getProperties() ?: null;
	}
        
        /**
	 * Return the class name
	 *
	 * @return mixed
	 */
	protected function getName()
	{
		return $this->classes->getName();
	}

	/**
	 * Return the transport method to call
	 *
	 * @return string
	 */
	protected function getMethod()
	{
		return 'post';
	}

	/**
	 * Return the path to use
	 *
	 * @return string
	 */
	protected function getPath()
	{
		return '/'.$this->getName();
	}
        
        /**
	 * Return the path to use
	 *
	 * @return string
	 */
	protected function getCommand()
	{
		return '/property'.$this->client->getTransport()->getDatabaseName();
	}

	/**
	 * Use the results
	 *
	 * @param integer $code
	 * @param array   $headers
	 * @param array   $data
	 * @return boolean true on success
	 * @throws Exception on failure
	 */
	protected function handleResult($code, $headers, $data)
	{      
            
		if ((int)($code / 100) != 2) {
			$this->throwError('Unable to create Property', $code, $headers, $data);
		}

		//$classesId = $this->getEntityMapper()->getIdFromUri($headers['Location']);
		//$this->classes->setId($classesId);
		//$this->getEntityCache()->setCachedEntity($this->classes);
		return true;
	}
}
