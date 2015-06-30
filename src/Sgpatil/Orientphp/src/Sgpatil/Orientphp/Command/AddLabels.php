<?php
namespace Sgpatil\Orientphp\Command;

use Sgpatil\Orientphp\Command\SetLabels,
	Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Node,
	Sgpatil\Orientphp\Label;

/**
 * Add a set of labels to a node
 */
class AddLabels extends SetLabels
{
	/**
	 * Set the labels to add
	 *
	 * @param Client $client
	 * @param Node   $node
	 * @param array  $labels
	 */
	public function __construct(Client $client, Node $node, $labels)
	{
		parent::__construct($client, $node, $labels, false);
	}
}
