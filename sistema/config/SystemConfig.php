<?php
class SystemConfig extends Params
{
	function __construct()
	{
		
		$this->setParam('fl_default_output' , Output::HTML);
		
		$this->setParam('modulo_default', 'Inicio');		//define o modulo inicial do software
		$this->setParam('submodulo_default', 'inicio');		//define o comando inicial para cada modulo
		
		$this->setParam('SystemDB', 'ares');		//define modo de tratamento da url
		$this->setParam('url_mode', 'fancy');		//define modo de tratamento da url
		
		$this->setParam('in_session_time',10);//minutos
		
		//Nome do Template
		$this->setParam('st_default_template','ares_one');
		define('TPL_PATH', 	HTTP_PATH.'/'.SYS_DIR.'/templates/'.$this->getParam('st_default_template'));

		//Lista de Widgets
		$widgets = array ('sis_controls', 'sis_breadcrumb', 'usr_menu', 'usr_toolbar');
		$this->setParam('widgets', serialize($widgets));
		
		
		$this->setParam('error_page', HTTP_PATH.'/erro');
		
	}
	
	public function getConfigs()
	{
		return $this->o_Params;
	}
	
}
?>