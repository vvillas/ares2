<?php
class Inicio
{
	private $o_control;
	private $o_db;
	
	function __construct()
	{
		Control::view()->addJavaScript(SYS_PATH."sistema/js/functions.js");
	}
	
	public function inicio()
	{
		$params = new Params();
		
		Control::view()->setParams($params);
		Control::view()->setView('Inicio', 'Início');
		
	}

}