<?php
namespace Sgpatil\Orientphp\Query;

use Sgpatil\Orientphp\Client;

/**
 * This is what you get when you execute a query. Looping
 * over this will give you {@link Row} instances.
 */
class ResultSet implements \Iterator, \Countable, \ArrayAccess
{
	protected $client = null;

	protected $rows = array();
	protected $data = array();
	protected $columns = array();
	protected $position = 0;
        protected $result = true;

        
        /**
	 * Set the array of results to represent
	 *
	 * @param Client $client
	 * @param array $result
	 */
	public function __construct(Client $client, $result)
	{
		$this->client = $client;
		if (is_array($result) && array_key_exists('result', $result)) {
			$this->data = $result['result'];
			//$this->columns = $result['columns'];
                }else{
                    $this->result = false;
                }
	}
        
        public function result()
	{
		return $this->result;
	}
        

	/**
	 * Return the list of column names
	 *
	 * @return array
	 */
	public function getColumns()
	{
		return $this->columns;
	}
        
        /**
	 * Return the data
	 *
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

	// ArrayAccess API

	public function offsetExists($offset)
	{
		return isset($this->data[$offset]);
	}

	public function offsetGet($offset)
	{
		if (!isset($this->rows[$offset])) {
			$this->rows[$offset] = new Row($this->client, $this->columns, $this->data[$offset]);
		}
		return $this->rows[$offset];
	}

	public function offsetSet($offset, $value)
	{
		throw new \BadMethodCallException("You cannot modify a query result.");
	}

	public function offsetUnset($offset)
	{
		throw new \BadMethodCallException("You cannot modify a query result.");
	}


	// Countable API

	public function count()
	{
		return count($this->data);
	}


	// Iterator API

	public function rewind()
	{
		$this->position = 0;
	}

	public function current()
	{
		return $this[$this->position];
	}

	public function key()
	{
		return $this->position;
	}

	public function next()
	{
		++$this->position;
	}

	public function valid()
	{
		return isset($this->data[$this->position]);
	}
}
