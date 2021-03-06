<?php
namespace Sgpatil\Orientphp\Command;

use Sgpatil\Orientphp\Command,
	Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Exception,
	Sgpatil\Orientphp\Relationship,
	Sgpatil\Orientphp\Node;

/**
 * Get and populate a relationship
 */
class GetRelationship extends Command
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
		parent::__construct($client);
		$this->rel = $rel;
	}

	/**
	 * Return the data to pass
	 *
	 * @return mixed
	 */
	protected function getData()
	{
		return null;
	}

	/**
	 * Return the transport method to call
	 *
	 * @return string
	 */
	protected function getMethod()
	{
		return 'get';
	}

	/**
	 * Return the path to use
	 *
	 * @return string
	 */
	protected function getPath()
	{
		if (!$this->rel->hasId()) {
			throw new Exception('No relationship id specified');
		}
		return '/relationship/'.$this->rel->getId();
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
		if ((int)($code / 100) == 2) {
			$this->rel = $this->getEntityMapper()->populateRelationship($this->rel, $data);
			$this->getEntityCache()->setCachedEntity($this->rel);
			return true;
		} else {
			$this->throwException('Unable to retrieve relationship', $code, $headers, $data);
		}
	}
}
