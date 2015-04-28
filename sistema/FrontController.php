<?php
class FrontController {
	
	public function __construct()
	{
		
		
		//BackController
		Control::view ()->setView ( 'Front' );
		
		// Conectando com os bancos
		Control::connectDB ();
		
		// Objeto de Controle de Autenticação
		Control::auth ();
		
		// Redireciona para o metodo de Login caso não esteja logado
		if (Control::session ()->isLogged ()) {
		
			// Inicializando o Objeto Log
			Control::log ();
		
			// Inicializando a Arvore do Sistema
			Control::tree ();
		
		}
		
		
		
		// Front Controller
		// Verifica se a pasta chamada como modulo exite
		if (! is_dir ( APP_PATH . 'modulo_' . Control::bootstrap ()->getModulo () ))
			throw new Exception ( 'Módulo ' . APP_PATH . 'modulo_' . $this->o_bootstrap->GetModulo () . ' não encontrado' );
		else {
			// Verifica se a pasta chamada contem o arquivo com o nome do submodulo
			$st_submodulo = Control::bootstrap ()->getSubmodulo ();
			$st_arquivo = 'modulo_' . Control::bootstrap ()->getModulo () . '/' . $st_submodulo . '.php';
		
			if (! file_exists ( APP_PATH . $st_arquivo ))
				Control::view ()->addException ( "Submódulo '$st_arquivo' não encontrado" );
			else {
					
				// recebe o arquivo do submodulo
				require_once APP_PATH . $st_arquivo;
					
				// verifica se a classe existe
				if (! class_exists ( $st_submodulo ))
					Control::view ()->addException ( "Classe '$st_submodulo' não encontrada" );
				else {
					// constroi o submodulo
					$o_classe = new $st_submodulo ();
		
					// verifica se o metodo com o nome do comando existe
					$st_comando = Control::bootstrap ()->getComando ();
					if (! method_exists ( $o_classe, $st_comando ))
						Control::view ()->addException ( "Comando '$st_comando' não pode ser encontrado" );
					else {
						// confere as permissões do usuário antes de executar a operação
						// $this->tree()->checkUserRights();
							
						// verifica se houve a chamada de alguma ação
						$st_action = Control::bootstrap ()->getAction ();
						if (! is_null ( $st_action ))
							if (! method_exists ( $o_classe, $st_action ))
								Control::view ()->addException ( "A ação '$st_action' não pode ser encontrada" );
							else
								$o_classe->$st_action ();
		
							// executa o comando
							$o_classe->$st_comando ();
					}
				}
			}
		}
		
	}
	
}