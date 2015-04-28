<?php
class Inicio extends MModule {
	
	
	
	public function __inicio() {
		
		if(Control::session ()->isLogged ())
			Control::view ()->redirectTo ( ADM_URI."/dashboard/" );
		
	}
	
	
	public function action_acessar() {
		
		if(Control::session ()->isLogged ())
			Router::execute(Control::config()->getParam("modulo_default"), Control::config()->getParam("submodulo_default"));
		
		if(is_null($this->params))
			throw new Exception("Parâmetros não informados");
		
		$login = $this->params->getParam ( "st_username" );
		$pass = $this->params->getParam ( "st_password" );

		$msg = NULL;

		if(strlen($login) == 0 && strlen($pass) == 0){
			Control::view()->addUserMessage("Informe o usuário e a senha", E_USER_ERROR);
			return;
		}
			
		if(is_null($login)){
			Control::view()->addUserMessage("Informe o usuário", E_USER_ERROR);
			return;
		}
			$msg = "";
		
		
		if(is_null($pass)){
			Control::view()->addUserMessage("Informe a senha", E_USER_ERROR);
			return;
		}
			
		
		
		if(strlen(trim($login)) < 4){
			Control::view()->addUserMessage("Usuário inválido", E_USER_ERROR);
			return;
		}
		
		
		if(strlen(trim($pass)) < 4){
			Control::view()->addUserMessage("Senha inválida", E_USER_ERROR);
			return;
		}
			
			
				
		// Abre a conexão com o banco
		$db = new DDDatabase ();
		$db->setConnectSettings ( "ares", Control::dbConfig ()->getDBConfig ( "ares" ) );
		
		
		// Se usuario autenticado
		 
		// Objeto de Controle de Autenticação
		$auth = new Auth ( $this->db );
		
		$user = $auth->login ($login, $pass);
		
		var_dump($user->getStatus());
		
		//if($user->getStatus());
			
		
	}
	
	public function action_logout()
	{
		Control::session()->unsetSession();
		Control::view ()->redirectTo ( ADM_URI );
	}
}