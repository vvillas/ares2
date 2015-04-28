<?php
/**
 * Controle de Autenticação
 * @author Victor
 *
 */
Class Auth 
{
	private $in_session_id;
	private $db;
	
	function __construct(DDDatabase $db){
		$this->db = $db;
	}

	/**
	 * @param String $login
	 * @param String $pass
	 * @return User
	 */
	public function login($login, $pass)
	{	
			
		$daoUser = new DAOUser($this->db);
		$user = $daoUser->findByLogin($login);
		
		
		if (is_null($user->getUserId())) {
			Control::view()->addUserMessage('Usuário não encontrado');
			return $user;
		}
		
		if(!$user->getStatus() > 0){
			Control::view()->addUserMessage('Usuário inválido');
			return $user;
		}
			
		if(!$user->checkPasword(md5($pass))){
			Control::view()->addUserMessage('Usuário e Senha não conferem');
			return $user;
		}
		
			
		Control::session()->setUserSession($user);
		Control::view()->redirectTo(ADM_URI."/dashboard");
		Router::execute('Inicio', 'dashboard');
		
		return $user;
	}


	private function logout()
	{
		if(Control::session()->isLogged())
		{
			Control::session()->unsetSession();
		}
	}
}