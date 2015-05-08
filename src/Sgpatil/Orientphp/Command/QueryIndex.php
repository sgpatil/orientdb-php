<?php
namespace Sgpatil\Orientphp\Command;

use Sgpatil\Orientphp\Command,
	Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Exception,
	Sgpatil\Orientphp\Relationship,
	Sgpatil\Orientphp\Node,
	Sgpatil\Orientphp\Index;

/**
 * Queries for entities in an index
 */
class QueryIndex extends SearchIndex
{
	/**
	 * Set the index to drive the command
	 *
	 * @param Client $client
	 * @param Index $index
	 * @param string $query
	 */
	public function __construct(Client $client, Index $index, $query)
	{
		parent::__construct($client, $index, $query, null);
	}

	/**
	 * Return the path to use
	 *
	 * @return string
	 */
	protected function getPath()
	{
		$path = parent::getPath();
		$path = join('/', array_slice(explode('/', $path), 0, 4));
		$query = rawurlencode($this->key);
		return $path . '?query=' . $query;
	}
}
