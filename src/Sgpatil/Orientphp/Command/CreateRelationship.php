<?php
namespace Sgpatil\Orientphp\Command;

use 	Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Relationship,
        Sgpatil\Orientphp\Command\Batch\Command;

/**
 * Create a relationship
 */
class CreateRelationship extends Command
{
	protected $rel = null;

	/**
	 * Set the relationship to drive the command
	 *
	 * @param Client $client
	 * @param Relationship $rel
	 */
	public function __construct(Client $client, Relationship $rel)
	{
		parent::__construct($client, $this, null);
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
            $arr = $this->rel->getProperties() ?: null;
            return $arr;
	}

    protected function getCommand() {
        
    }

    protected function getPath() {
        
    }

    protected function handleResult($code, $headers, $data) {
        
    }

}
