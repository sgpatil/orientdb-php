<?php
namespace Sgpatil\Orientphp\Index;

use Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Index;

/**
 * Represents a relationship index in the database
 */
class RelationshipIndex extends Index
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
		parent::__construct($client, Index::TypeRelationship, $name, $config);
	}
}
