<?php
namespace Sgpatil\Orientphp\Command;

use Sgpatil\Orientphp\Command,
	Sgpatil\Orientphp\Client,
	Sgpatil\Orientphp\Exception,
	Sgpatil\Orientphp\Relationship,
	Sgpatil\Orientphp\Node,
    //Sgpatil\Orientphp\Batch\Query,
    Sgpatil\Orientphp\Query\ResultSet;
/**
 * Find relationships on a node
 */
class GetNodeRelationships extends Command
{
	
    protected $query = null;

    /**
     * Set the query to execute
     *
     * @param Client $client
     * @param Query $query
     */
    public function __construct(Client $client, Node $query) {
        parent::__construct($client);
        $this->query = $query;
    }

    /**
     * Return the data to pass
     *
     * @return mixed
     */
    protected function getData() {

        $data = array("transaction" => true, 
              "operations" => array(
                  array(
                      "type"        => $this->getType(), 
                      "language"    => $this->getLanguage(), 
                      "script"     => [$this->getQuery() ]
                  ) 
               ) 
             );

//$data = array("transaction" => true, 
//              "operations" => array(
//                  array(
//                      "type" => "c", 
//                      "record" => array("@class" => "users",
//                                        "name" => "test")
//                  ) 
//               ) 
//             );

        return $data;
    }

    protected function getTransaction() {
        return $this->transaction;
    }
    
     protected function getType() {
        return "script";
    }
    
     protected function getLanguage() {
        return "sql";
    }
    
    /**
     * Return the transport method to call
     *
     * @return string
     */
    protected function getMethod() {
        return 'post';
    }

    /**
     * Return the path to use
     *
     * @return string
     */
    protected function getPath() {
        $url = $this->client->hasCapability(Client::CapabilityCypher);
//		if (!$url) {
//			throw new Exception('Cypher unavailable');
//		}
//              return preg_replace('/^.+\/db\/data/', '', $url);

        return '';
    }

    /**
     * Use the results
     *
     * @param integer $code
     * @param array   $headers
     * @param array   $data
     * @return integer on failure
     */
    protected function handleResult($code, $headers, $data) {
//		if ((int)($code / 100) != 2) {
//			$this->throwException('Unable to execute query', $code, $headers, $data);
//		}
        //return $data; // this line is added to return  array for migration select
        return new ResultSet($this->client, $data);
    }

    protected function getCommand() {
        return '/batch' . $this->client->getTransport()->getDatabaseName();
    }

    /**
     * Return the query to pass
     *
     * @return mixed
     */
    protected function getQuery() {
        ///$url = $this->query->getQuery();
        return "test";
    }


}