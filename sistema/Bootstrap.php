<?php
/**
 * PHP - 03/11/2012
 * @filesource bootstrap.php
 * @package ares
 * @author victor
 * @version 1.0.0
 *
 */

class Bootstrap 
{
	
	
	private $modulo;
	private $submodulo;
	private $action;
	private $request;
	

	private $uri_trace = array();
	
	function __construct()
	{
		$this->setURI();
		
		if(Control::config()->getParam('url_mode')=='fancy')
			$this->traceFancy();
		else
			$this->traceNormal();
		
		$this->request = new Params();
		$this->setRequest($_POST);
	}

	public function getModulo()
	{
		return $this->modulo;
	}
	
	public function getSubmodulo()
	{
		return $this->submodulo;
	}
	
	public function getAction()
	{
		return $this->action;
	}
	
	private function setURI() {
		if($_SERVER['REQUEST_URI'])
			$this->uri_trace = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
	}
	
	public function is_an_admin_call() 
	{
		if($this->uri_trace[0] == ADM_URI)
			return TRUE;
		return FALSE;
	}
	
	private function traceNormal()
	{
		if(isset($_REQUEST['modulo']))
			$this->modulo = $_REQUEST['modulo'];
		else
			$this->modulo  = Control::config()->getParam('modulo_default');

		if(isset($_REQUEST['submodulo']))
			$this->submodulo = $_REQUEST['submodulo'];
		else
			$this->submodulo = Control::config()->getParam('submodulo_default');
			
		if(isset($_REQUEST['action']))
			$this->action = $_REQUEST['action'];

	}
	
	private function traceFancy()
	{
		
		
		$arr = $this->uri_trace;
		
		if($this->is_an_admin_call()){
			array_shift($arr);
		}
		
		
		if(count($arr) == 0){
			$this->modulo  = Control::config()->getParam('modulo_default');
			$this->submodulo = Control::config()->getParam('submodulo_default');
		}
		elseif(count($arr) == 1){
			$this->modulo  = ucfirst($arr[0]);
			$this->submodulo = Control::config()->getParam('submodulo_default');
		}
		elseif(count($arr) >= 2){
			$this->modulo  = ucfirst($arr[0]);
			$this->submodulo = ucfirst($arr[1]);
		}
		
		if(isset($_REQUEST['action'])){
			$this->action = $_REQUEST['action'];
		}
		
	}
	
	/**
	 * Metodo que trata os parametros recebidos em uma lista de parametros
	 * @param Recebe um array $arr
	 */
	private function setRequest($arr){
		
		foreach ($arr as $key => $value) {
			
			if($key == 'action') continue;
			
			$this->request->setParam(addslashes($key), addslashes($value));
			
		}
		
		
	}
	
	public function getRequest(){
		return $this->request;
	}
	
}