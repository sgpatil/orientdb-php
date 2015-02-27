<?php

namespace Sgpatil\Orientphp\Command;

use Sgpatil\Orientphp\Exception,
    Sgpatil\Orientphp\EntityMapper,
    Sgpatil\Orientphp\Command,
    Sgpatil\Orientphp\Client,
    Sgpatil\Orientphp\Batch\Query,
    Sgpatil\Orientphp\Query\ResultSet;

/**
 * Perform a query using the Cypher query language and return the results
 */
class ExecuteBatchQuery extends Command {

    protected $query = null;

    /**
     * Set the query to execute
     *
     * @param Client $client
     * @param Query $query
     */
    public function __construct(Client $client, Query $query) {
        parent::__construct($client);
        $this->query = $query;
    }

    /**
     * Return the data to pass
     *
     * @return mixed
     */
    protected function getData() {


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
        $url = $this->query->getQuery();
        return preg_replace("/[\s_]/", "%20", $url);
        //$params = $this->query->getParameters();
        //return preg_replace('|class|', $params['idn'], $url);
    }

}
