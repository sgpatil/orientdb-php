<?php
namespace Sgpatil\Orientphp\Command;

use Sgpatil\Orientphp\Command\SetLabels,
	Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Node,
	Sgpatil\Orientphp\Label;

/**
 * Remove a set of labels from a node
 */
class RemoveLabels extends SetLabels
{
	/**
	 * Set the labels to remove
	 *
	 * @param Client $client
	 * @param Node   $node
	 * @param array  $labels
	 */
	public function __construct(Client $client, Node $node, $labels)
	{
		parent::__construct($client, $node, $labels, true);
	}
}
