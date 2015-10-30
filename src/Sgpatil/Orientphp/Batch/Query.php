<?php
namespace Sgpatil\Orientphp\Batch;

use Sgpatil\Orientphp;
use Sgpatil\Orientphp\PropertyContainer;
/**
 * Represents a Cypher query string and variables
 * Query the database using Cypher. For query syntax, please refer
 * to the Cypher documentation for your server version.
 */
class Query  extends PropertyContainer implements Orientphp\Query
{
	protected $client = null;
	protected $template = null;
	protected $vars = array();

	protected $result = null;

	/**
	 * Set the template to use
	 *
	 * @param Neo4j\Client $client
	 * @param string $template A Cypher query string or template
	 * @param array $vars Replacement vars to inject into the query
	 */
	public function __construct(\Sgpatil\Orientphp\Client $client, $template, $vars=array())
	{
		$this->client = $client;
		$this->template = $template;
		$this->vars = $vars;
	}

	/**
	 * Get the query script
	 *
	 * @return string
	 */
	public function getQuery()
	{
		return $this->template;
	}

	/**
	 * Get the template parameters
	 *
	 * @return array
	 */
	public function getParameters()
	{
		return $this->vars;
	}

	/**
	 * Retrieve the query results
	 *
	 * @return Neo4j\Query\ResultSet
	 */
	public function getResultSet()
	{
		if ($this->result === null) {
			$this->result = $this->client->executeBatchQuery($this);
		}

		return $this->result;
	}
        
        /**
	 * Get the first relationship of this node that matches the given criteria
	 *
	 * @param mixed  $types string or array of strings
	 * @param string $dir
	 * @return Relationship
	 */
	public function getFirstRelationship($types=array(), $dir=null)
	{
		$rels = $this->client->getNodeRelationships($this, $types, $dir);
		if (count($rels) < 1) {
			return null;
		}
		return $rels[0];
	}

    public function delete() {
        
    }

    public function load() {
        
    }

    public function save() {
        
    }

}
