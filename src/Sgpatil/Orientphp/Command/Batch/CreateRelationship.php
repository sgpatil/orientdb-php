<?php
namespace Sgpatil\Orientphp\Command\Batch;

use Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Batch,
	Sgpatil\Orientphp\Relationship,
	Sgpatil\Orientphp\Command\CreateRelationship as SingleCreateRelationship;

/**
 * Create a relationship in a batch
 * Also creates the endpoint nodes if necessary
 */
class CreateRelationship extends Command
{
	protected $batch = null;
	protected $rel = null;

	/**
	 * Set the operation to drive the command
	 *
	 * @param Client $client
	 * @param Relationship $rel
	 * @param integer $opId
	 * @param Batch $batch
	 */
	public function __construct(Client $client, Relationship $rel, $opId, Batch $batch)
	{
		parent::__construct($client, new SingleCreateRelationship($client, $rel), $opId);
		$this->batch = $batch;
		$this->rel = $rel;
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