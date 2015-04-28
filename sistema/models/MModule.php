<?php
abstract class MModule{
	
	protected $params;
	protected $db;
	
	function __construct(Params $params = NULL, DDDatabase $db = NULL) {

		$this->setParams($params);
		$this->db = $db;
		
	}
	
	private function setParams(Params $arr)
	{
		$this->params = $arr;
	}
	
}