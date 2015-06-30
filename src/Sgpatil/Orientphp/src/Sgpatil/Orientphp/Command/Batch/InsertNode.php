<?php
namespace Sgpatil\Orientphp\Command\Batch;

use Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Node,
	Sgpatil\Orientphp\Command\CreateNode as SingleCreateNode,
        Sgpatil\Orientphp\Classes;

/**
 * Insert record into class in a batch
 */
class InsertNode extends Command
{
	/**
	 * Set the operation to drive the command
	 *
	 * @param Client $client
	 * @param Node $node
	 * @param integer $opId
	 */
	public function __construct(Client $client, Classes $node, $opId)
	{
		parent::__construct($client, new SingleCreateNode($client, $node), $opId);
	}

        /**
	 * Return the type to preform
	 *
	 * @return string
	 */
	protected function getType()
	{
		return 'c';
	}
        /**
	 * Return the record data
	 *
	 * @return string
	 */
	protected function getRecord()
	{
		return 'post';
	}
       

	protected function getMethod()
	{
		return 'post';
	}
	/**
	 * Return the data to pass
	 *
	 * @return array
	 */
	protected function getData()
	{
		$opData = array(array(
			'method' => strtoupper($this->base->getMethod()),
			'to' => $this->base->getPath(),
			'body' => $this->base->getData(),
			'id' => $this->opId,
		));
		return $opData;
	}

    protected function getCommand() {
        
    }

}
