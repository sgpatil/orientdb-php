<?php
namespace Sgpatil\Orientphp\Batch;

use Sgpatil\Orientphp\Batch,
	Sgpatil\Orientphp\Command\Batch as Command,
	Sgpatil\Orientphp\Node,
	Sgpatil\Orientphp\Relationship,
	Sgpatil\Orientphp\PropertyContainer;

/**
 * A delete operation
 */
class Delete extends Operation
{
	protected $command = null;

	/**
	 * Build the operation
	 *
	 * @param Batch $batch
	 * @param PropertyContainer $entity
	 * @param integer $opId
	 */
	public function __construct(Batch $batch, PropertyContainer $entity, $opId)
	{
		parent::__construct($batch, 'delete', $entity, $opId);
	}

	/**
	 * Get the command that represents this operation
	 *
	 * @return Batch\Command
	 */
	public function getCommand()
	{
		if (!$this->command) {
			$entity = $this->entity;
			$command = null;
			if ($entity instanceof Node) {
				$command = new Command\DeleteNode($this->batch->getClient(), $entity, $this->opId);
			} else if ($entity instanceof Relationship) {
				$command = new Command\DeleteRelationship($this->batch->getClient(), $entity, $this->opId);
			}

			$this->command = $command;
		}
		return $this->command;
	}
}
