<?php
namespace Sgpatil\Orientphp\Command\Batch;

use Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Relationship,
	Sgpatil\Orientphp\Command\DeleteRelationship as SingleDeleteRelationship;

/**
 * Delete a relationship in a batch
 */
class DeleteRelationship extends Command
{
	/**
	 * Set the operation to drive the command
	 *
	 * @param Client $client
	 * @param Relationship $rel
	 * @param integer $opId
	 */
	public function __construct(Client $client, Relationship $rel, $opId)
	{
		parent::__construct($client, new SingleDeleteRelationship($client, $rel), $opId);
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
