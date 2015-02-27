<?php
namespace Sgpatil\Orientphp\Index;

use Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Index\NodeIndex;

/**
 * Represents a fulltext node index in the database
 */
class NodeFulltextIndex extends NodeIndex
{
	/**
	 * Initialize the index
	 *
	 * @param Client $client
	 * @param string $name
	 * @param array  $config
	 */
	public function __construct(Client $client, $name, $config=array())
	{
		if (empty($config['type'])) {
			$config['type'] = 'fulltext';
		}
		if (empty($config['provider'])) {
			$config['provider'] = 'lucene';
		}

		parent::__construct($client, $name, $config);
	}
}
