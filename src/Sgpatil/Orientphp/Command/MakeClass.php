<?php
namespace Sgpatil\Orientphp\Command;

use Sgpatil\Orientphp\Command,
	Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Node;

/**
 * Create a node
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
	public function __construct(Client $client, Node $node)
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
		return '/class/graphdb2/test4';
	}
	
        /**
	 * Return the command
	 *
	 * @return string
	 */
	protected function getCommand()
	{
		return '/class'.$this->client->getTransport()->getDatabaseName();
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
			$this->throwException('Unable to make class', $data);
		}

		$nodeId = $this->getEntityMapper()->getIdFromUri($headers['Location']);
		$this->node->setId($nodeId);
		$this->getEntityCache()->setCachedEntity($this->node);
		return true;
	}
}
