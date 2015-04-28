<?php
class DBConfig
{
	private $DataBases = array();

	function __construct()
	{
		
		//System DB Setup
		$this->DataBases['ares'] = new DDConnectSettings();
		$this->DataBases['ares']->setApplication(DDConnectSettings::MYSQL);
		$this->DataBases['ares']->setHost('localhost');
		$this->DataBases['ares']->setPort(5432);
		$this->DataBases['ares']->setDatabase('ares');
		$this->DataBases['ares']->setUser('root');
		$this->DataBases['ares']->setPassword('z010203');
	}
	
	public function listDBConfig()
	{
		return $this->DataBases;
	}
	
	/**
	 * @param unknown $dbName
	 * @return DDConnectSettings
	 */
	public function getDBConfig($dbName)
	{
		return $this->DataBases[$dbName];
	}
	
}