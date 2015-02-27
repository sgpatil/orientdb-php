<?php
namespace Sgpatil\Orientphp\Command\Batch;

use Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Node,
	Sgpatil\Orientphp\Command\DeleteNode as SingleDeleteNode;

/**
 * Delete a node in a batch
 */
class DeleteNode extends Command
{
	/**
	 * Set the operation to drive the command
	 *
	 * @param Client $client
	 * @param Node $node
	 * @param integer $opId
	 */
	public function __construct(Client $client, Node $node, $opId)
	{
		parent::__construct($client, new SingleDeleteNode($client, $node), $opId);
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
			'id' => $this->opId,
		));
		return $opData;
	}
}
