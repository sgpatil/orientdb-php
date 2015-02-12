<?php
namespace Everyman\Neo4j\Command;

use Everyman\Neo4j\Command,
	Everyman\Neo4j\Client,
	Everyman\Neo4j\Classes;

/**
 * Create a class
 */
class CreateClass extends Command
{
	protected $node = null;

	/**
	 * Set the node to drive the command
	 *
	 * @param Client $client
	 * @param Node $node
	 */
	public function __construct(Client $client, Classes $node)
	{
		parent::__construct($client);
		$this->node = $node;
	}

	/**
	 * Return the data to pass
	 *
	 * @return mixed
	 */
	protected function getData()
	{
		return $this->node->getProperties() ?: null;
	}
        
        /**
	 * Return the data to pass
	 *
	 * @return mixed
	 */
	protected function getName()
	{
		return $this->node->getName();
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
		return '/class/graphdb2/'.$this->getName();
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
			$this->throwError('Unable to create Class', $code, $headers, $data);
		}

		//$nodeId = $this->getEntityMapper()->getIdFromUri($headers['Location']);
		//$this->node->setId($nodeId);
		//$this->getEntityCache()->setCachedEntity($this->node);
		return true;
	}
}
