<?php

require_once 'includes.php';

/**
 * @author victor
 * 
 */
class Control {
	
	private static $config;
	private static $dbConfig;
	private static $DDDatabase;
	private static $bootstrap;
	private static $session;
	private static $controller;
	private static $tree;
	private static $view;
	private static $params;
	
	
	/**
	 * * Declare instance **
	 */
	private static $instance = NULL;
	public static function getInstance() {
		if (! self::$instance)
			self::$instance = new Control ();
		
		return self::$instance;
		
	}
	
	
	private function __construct(){}
	
	
	/**
	 * Executando o sistema
	 */
	public static function run() {
		
		
		
		try {
			
			
			
			// Verifica se é uma chamada de administração
			if (! self::bootstrap ()->is_an_admin_call ())
			{	
				// Chama o metodo de execução de Front
				self::frontController ();
			}
			else
			{
				// Chama o metodo de execução de Back
				self::backController ();
			}
			
			
			
			
			
		} catch ( Exception $e ) {
			
			if (AMBIENT != "dev"){
				Logger::write ( $e, __FILE__, __LINE__ );
				//self::view()->redirectTo(self::config()->getParam("error_page"));
			}
			else{
				throw $e;
			}
		}
		finally {

			print self::view()->render();
			self::getInstance ()->__destruct ();
			
		}
		
	}
	
	
	public static function frontController() {
		require_once 'sistema/FrontController.php';
		self::$controller = new FrontController ();
	}
	
	
	public static function backController() {
		require_once 'sistema/BackController.php';
		self::$controller = new BackController ();
	}
	
	
	

	/**
	 * @return ConfigGlobal
	 */
	public static function config() {
		if (! is_a ( self::$config, 'SystemConfig' )) {
			self::$config = new SystemConfig();
		}
		
		return self::$config;
	}
	
	//Executa a classe de configuração e carrega os parametros de banco de dados
	 
	
	/**
	 * @return DBConfig
	 */
	public static function dbConfig() {
		if (! is_a ( self::$dbConfig, 'DBConfig' )) {
			self::$dbConfig = new DBConfig ();
		}
	
		return self::$dbConfig;
	}
	
	
	/**
	 * @return DDDatabase
	 */
	public static function DDDatabase(){
		if (! is_a ( self::$DDDatabase, 'DDDatabase' )) {
			self::$DDDatabase = new DDDatabase ();
		}
		
		return self::$DDDatabase;
	}
	
	
	/**
	 * Inicia a sessão, caso a mesma ainda não esteja iniciada
	 *
	 * @return Session
	 */
	public static function session() {
		if (! is_a ( self::$session, 'Session' )) {
			self::$session = new Session ();
		}
		return self::$session;
	}

	
	/**
	 * Metodo para receber o usuário
	 *
	 * @param User $user        	
	 */
	public function user() {
		return $this->getUser ();
	}
	public function setUser($user) {
		$this->user = $user;
	}
	public function getUser() {
		return $this->user;
	}
	
	/**
	 * Metodo de chamada do obj Log
	 *
	 * @return Log
	 */
	public function log() {
		if (! is_a ( $this->log, 'Log' )) {
			$this->log = new Log ( $this );
		}
		return $this->log;
	}
	
	/**
	 * Metodo de chamada do obj Bootstrap
	 *
	 * @return Bootstrap
	 */
	public static function bootstrap() {
		if (! is_a ( self::$bootstrap, 'Bootstrap' )) {
			self::$bootstrap = new Bootstrap ();
		}
		
		return self::$bootstrap;
	}
	

	
	/**
	 * Metodo para chamada do obj Tree
	 *
	 * @return Tree
	 */
	public function tree() {
		if (! is_a ( self::$tree, 'Tree' )) {
			self::$tree = new Tree ();
		}
		
		return self::$tree;
	}
	
	/**
	 * Metodo para chamada do obj View
	 *
	 * @return View
	 */
	public static function view() {
		if (! is_a ( self::$view, 'View' )) {
			self::$view = new View ();
		}
		return self::$view;
	}
	
	/**
	 * Enter description here .
	 *
	 *
	 *
	 *
	 *
	 * ..
	 *
	 * @param unknown_type $st_mensagem        	
	 */
	public static function output($st_mensagem) {
		// if($this->config->getParam('bdebug_mode') == TRUE)
		self::view ()->addException ( $st_mensagem );
		
		self::view ()->setView ( 'modulo_inicio/view/erro.php', 'Erro' );
		
		// header("HTTP/1.0 404 Not Found");
		// header("Status: 404 Not Found");
	}
	
	/**
	 * Show the Output AND Kill da funcking sistem
	 */
	function __destruct() {
		
		if (AMBIENT == 'dev'){
			var_dump ( $_COOKIE );
			var_dump(self::bootstrap());
		}
		
		
		exit ();
	}
}

