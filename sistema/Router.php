<?php
class Router{
	
	private function __construct(){}
	
	
	/**
	 * Metodo que executa a chamada
	 *
	 * @param string $modulo
	 * @param string $comando
	 * @param string $method
	 */
	public static function execute($modulo, $submodulo, $method = NULL) {
		
		$pasta = SYS_PATH . '_' . $modulo; // recebe o nome da pasta onde esta a classe que sera executada
		$arquivo = $pasta . '/' . $modulo . '.php';
		$classe = $modulo; // recebe o nome da classe que sera executada
	
		
	
		if (! is_dir ( $pasta ))
			throw new Exception ( 'Pasta ['.$pasta.'] não encontrada' . E_ERROR . __FILE__ . __LINE__ );
			
		// Verifica se a pasta chamada contem o arquivo com o nome do submodulo
		if (! file_exists ( $arquivo ))
			throw new Exception ( "Arquivo [" . $arquivo . "] arquivo não encontrado " . E_ERROR . __FILE__ . __LINE__ );
			
		// recebe o arquivo do submodulo
		require_once $arquivo;
	
		// verifica se a classe existe
		if (! class_exists ( $classe ))
			throw new Exception ( 'Classe ['.$classe.'] não encontrada' . E_ERROR . __FILE__ . __LINE__ );
			
		// ### MUDAR DAQUI
			
		// Abre a conexão com o banco
		$db = new DDDatabase ();
		$db->setConnectSettings ( "ares", Control::dbConfig ()->getDBConfig ( "ares" ) );
	
		// ### MUDAR DAQUI
	
		// constroi o submodulo
		$o_classe = new $modulo ( Control::bootstrap ()->getRequest (), $db );
			
		// verifica se o metodo com o nome do comando existe
		//if (!is_null($method))
		{
				
			if (! method_exists ( $o_classe, $method ))
				throw new Exception ( 'Action [' . $method . '] não pode ser encontrado' . E_ERROR . __FILE__ . __LINE__ );
	
			// confere as permissões do usuário antes de executar a operação
			// $this->tree()->checkUserRights();
	
			// verifica se houve a chamada de alguma ação
			// $st_action = Control::bootstrap ()->getAction ();
				
			
			$o_classe->$method ();
			
		}
		
		
		
	}
	
}