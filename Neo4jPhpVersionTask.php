<?php
require_once __DIR__.'/lib/Everyman/Neo4j/Version.php';

class Neo4jPhpVersionTask extends Task
{
	protected $property;

	public function init(){}

	public function setProperty($name)
	{
		$this->property = $name;
	}

	public function main()
	{
		$version = \Sgpatil\Orientphp\Version::CURRENT;
		$this->log("neo4jphp version: $version");
		$this->project->setProperty($this->property, $version);
	}
}