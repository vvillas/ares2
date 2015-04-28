<?php

/**
 * Objeto de Operação da Sessão
 * @author Victor
 */
class Session
{
	private $in_id;
	private $bo_logged;
		
	function __construct()
	{

		if(isset($_COOKIE[SYS_TTL])){
			$cookie = unserialize($_COOKIE[SYS_TTL]);
			$this->in_id = $cookie['sess_id'];
			$this->bo_logged = $cookie['bo_logged'];
		}
		else{
			$this->in_id = NULL;
			$this->bo_logged = FALSE;
		}
	}
	
	public function getId(){
		return $this->in_id;
	}
	
	public function isLogged(){
		return $this->bo_logged;
	}
	
		
	/**
	 * Metodo que vincula o usuario autenticado a sessao
	 * @param User $user
	 */
	public function setUserSession(User $user)
	{
		
		/*
		$this->in_id = $this->verifySession($usr_in_id);
		
		if(is_numeric($this->in_id)){
			if($this->updateSession($this->in_id, Control::$o_config->getParam('in_session_time'))){
				$this->bo_logged = $_SESSION['logged'] = true;
			}
		}
		else
		{
			if($this->in_id = $this->insertSession(Control::$o_config->getParam('in_session_time'), $usr_in_id)){
				$_SESSION['ID'] = $this->in_id;
				$this->bo_logged = $_SESSION['logged'] = true;
				$_SESSION['USER_ID'] = $usr_in_id;
			}
		}
		*/
		
		//var_dump($user);
		
		if($user->getStatus())
			$this->bo_logged = TRUE;
		
		if($this->isLogged()){
			$cookie['sess_id'] = $this->getId();
			$cookie['bo_logged'] = $this->isLogged();
			
			setcookie(SYS_TTL, serialize($cookie));
			
		}
		
	}
	
	
	/**
	 * Metodo que encerra a sessão
	 */
	public function unsetSession()
	{
				
		if (is_integer($this->in_id)) {
			$this->updateSession($this->in_id,0);
		}

		setcookie(SYS_TTL, "", time()-3600);
	} 
}