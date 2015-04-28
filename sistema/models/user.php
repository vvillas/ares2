<?php
/**
 * Classe de controle de usuario
 * @author Victor
 */
class User extends Pessoa
{
	
	protected $usr_in_id = NULL; 
	protected $usr_st_login = NULL; 
	protected $usr_st_password = NULL;
	protected $usr_st_status = NULL;
	protected $usr_bo_status = NULL;
	protected $usr_ts_alter = NULL;
	
	
	/**
	 * Retorna usr_in_id
	 * @return integer
	 */
	public function getUserId() {
		return $this->usr_in_id;
	}
	 
	/**
	 * Set usr_in_id
	 * @param integer $usr_in_id
	 */
	public function setUserId($usr_in_id) {
		$this->usr_in_id = $usr_in_id;
	}
	
	/**
	 * Retorna usr_st_login
	 * @return string
	 */
	public function getLogin() {
		return $this->usr_st_login;
	}
	 
	/**
	 * Set usr_st_login
	 * @param string $usr_st_login
	 */
	public function setLogin($usr_st_login) {
		$this->usr_st_login = $usr_st_login;
	}
	
	
	/**
	 * Retorna usr_st_password
	 * @return string
	 */
	public function getPassword() {
		return $this->usr_st_password;
	}
	 
	/**
	 * Set usr_st_password
	 * @param string $usr_st_password
	 */
	public function setPassword($usr_st_password) {
		$this->usr_st_password = $usr_st_password;
	}
	
	
	public function setStatus($usr_bo_status){
		$this->usr_bo_status = $usr_bo_status;	
	}
	
	
	public function getStatus(){
		return $this->usr_bo_status;
	}
	
	
	/**
	 * @param String $st_md5_pwd
	 * @return boolean (TRUE if Match)
	 */
	public function checkPasword($st_md5_pwd){
		if(!is_null($this->usr_st_password))
			if($this->usr_st_password == $st_md5_pwd)
				return TRUE;
		return FALSE;
	}
	
}

