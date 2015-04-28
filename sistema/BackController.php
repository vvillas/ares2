<?php
/**
 * Classe de controle de fluxo do sistema de administração de conteúdo
 * @author victor
 */
class BackController {
	public function __construct() {
		
		// BackController
		
		// Caso não esteja logado
		if (! Control::session ()->isLogged ()) {
			// Caso não esteja na página de login
			if (Control::bootstrap ()->getModulo () != Control::config()->getParam('modulo_default')) {
				Control::view ()->redirectTo ( ADM_URI );
			}
		} 
		// Caso esteja logado
		else {
			
			/**
			 * @todo
			 * Caso ja tenha o cookie - Verifica sessao
			 */ 
			
			//Control::session ()->updateSession(Control::session()->getId(), 1000*Control::config()->getParam('in_session_time'));
			
			/*
			 * // Conecta no banco
			 * $this->bkDB = new DDDatabase ();
			 * try {
			 * $this->bkDB->tryConnect ( "ares" );
			 * } catch ( Exception $e ) {
			 * throw $e;
			 * }
			 *
			 * // Inicializando o Objeto Log
			 * Control::log ();
			 *
			 * // Inicializando a Arvore do Sistema
			 * Control::tree ();
			 *
			 */
		}
		
		// Verifica se a pasta chamada como modulo exite
		$modulo = Control::bootstrap ()->getModulo ();
		
		// verifica se o metodo com o nome do submodulo existe
		$submodulo = Control::bootstrap ()->getSubmodulo();
		
		// verifica se houve a chamada de alguma ação
		$action = Control::bootstrap ()->getAction ();
		
		
		Control::view()->setView(SYS_PATH."_".Control::bootstrap()->getModulo()."/view/".Control::bootstrap()->getSubmodulo().".php");
		
		
		// Executa a action
		if($action)
			Router::execute ( $modulo, $submodulo, "action_".$action );
		
		// Executa o metodo 
		Router::execute ( $modulo, $submodulo, '__'.$submodulo );
				
				
	}
	
}