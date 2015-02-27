<?php
namespace Sgpatil\Orientphp\Command;

use Sgpatil\Orientphp\Command,
	Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Node;

/**
 * Create record into class
 */
class InsertRecord extends Command
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
            $data = array('name' => array("propertyType" => "STRING"));
            
            return $data;
	}
        
        /**
	 * Return the class name
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
		return '/'.$this->getName();
	}
        
        /**
	 * Return the path to use
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
			$this->throwError('Unable to create Class', $code, $headers, $data);
		}

		return true;
	}
}
