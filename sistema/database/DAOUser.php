<?php

/**
 * PHP - 03/11/2012
 * @filesource User.php
 * @package project
 * @author victor
 * @version $Id$
 *
 */

class DAOUser implements IDAO
{
	
	private $o_db;
	
	function __construct($db){
		$this->o_db = &$db;
	}
	

	/**
	 * Metodo para adicionar um usuario a base
	 * @see User::create()
	 */
	public function create(IEntity $obj) {
		
		$st_query = "INSERT INTO fds.tbl_person (per_st_name, per_st_shortname, per_st_email)
						VALUES ( 'Usuário Administrador', 'Admin', 'admin@admin.net');
					 INSERT INTO fds.tbl_user (usr_st_login, usr_st_password, per_in_id)
						VALUES ( 'admin', md5('admin123'), LAST_INSERT_ID());
					";
	}
	
	/** Metodo para ler um usario na base
	 * @see User::read()
	 */
	public function read(IEntity $obj) {
		
		$st_query = 'SELECT  usr_in_id, usr_st_login, usr_st_password,
						     per.per_in_id, per_st_name, per_st_shortname, per_st_email
						FROM fds.tbl_user AS usr
						INNER JOIN fds.tbl_person AS per ON per_bo_status = 1 AND per.per_in_id = usr.per_in_id
						WHERE usr_bo_status = 1';
		
		if($this->getUserId())
			$st_query .= " AND usr_in_id ='".$this->getUserId()."'";
		else if($this->getLogin())
			$st_query .= " AND usr_st_login = '".$this->getLogin()."'";
		else
			return FALSE;
		
		
		$st_query .= ' LIMIT 1';
		
		
		try	{
			$data = $this->o_db->execQuery('sys',$st_query)->getData();
		}
		catch (Exception $e){
			return $e;
		}
		
		
		if(count($data) > 0)
		{	
			$this->setPersonId($data[0]->per_in_id);
			$this->setName($data[0]->per_st_name);
			$this->setShortname($data[0]->per_st_shortname);
			$this->setEmail($data[0]->per_st_email);
			
			$this->setUserId($data[0]->usr_in_id);
			$this->setLogin($data[0]->usr_st_login);
			$this->setPassword($data[0]->usr_st_password);
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	/** Metodo para atualizar um usuario na base
	 * @see User::update()
	 */
	public function update(IEntity $obj) {
		
		$st_query = "UPDATE fds.tbl_person SET 
						    per_st_name = '',
						    per_st_shortname = '',
						    per_st_email = '',
						    per_bo_status = 1
						WHERE per_in_id = 1;
							
					UPDATE fds.tbl_user SET
							usr_st_login = '',
							usr_st_password = '',
							usr_bo_status = 1,
						WHERE usr_in_id = 1;";
	}
	
	public function delete(IEntity $obj) {
		;
	}
	
	
	/** Metodo para encontrar um user pelo login
	 */
	public function findByLogin($login){
		
		
		
		$usr = new User();
	
		$st_query = "SELECT  usr_in_id, usr_st_login, usr_st_password, usr_bo_status,";
		$st_query .= " per.per_in_id, per_st_name, per_st_shortname, per_st_email";
		$st_query .= " FROM fds.tbl_user AS usr";
		$st_query .= " INNER JOIN fds.tbl_person AS per ON per_bo_status = 1 AND per.per_in_id = usr.per_in_id";
		$st_query .= " WHERE usr_st_login = '".$login."'";
		$st_query .= " AND usr_bo_status > 0";
		$st_query .= " LIMIT 1";
	
		
		try	{
			$data = $this->o_db->execQuery('ares',$st_query)->getData();
		}
		catch (Exception $e){
			throw $e;
		}
	
	
		if(count($data) > 0)
		{
			
			$usr->setPersonId($data[0]->per_in_id);
			$usr->setName($data[0]->per_st_name);
			$usr->setShortname($data[0]->per_st_shortname);
			$usr->setEmail($data[0]->per_st_email);
				
			$usr->setUserId($data[0]->usr_in_id);
			$usr->setLogin($data[0]->usr_st_login);
			$usr->setPassword($data[0]->usr_st_password);
			
			$usr->setStatus(($data[0]->usr_bo_status = "1") ? TRUE: FALSE);
			
			
		}
	
		return $usr;
	}
	
	
}



