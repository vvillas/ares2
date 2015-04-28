<?php

//phpinfo();





/**
 * PHP - 03/11/2012
 * @filesource index.php
 * @package ares
 * @author victor
 * @version 1.0.0
 * 
 */



/**
 * Setup de Parametros
 *  
 */
define('SYS_DIR', 'sistema');
define('APP_DIR', 'application');
define('ADM_URI', 'ares');

define('SYS_TTL', 'ARES');
define('APP_TTL', 'ARES - Sistema de Gerenciamento de Conteúdo');


/**
 *	Definição da Raiz do Sistema
 *	@var string BASE_PATH
 */
$this_path_info = pathinfo(__FILE__);
$base_path = $this_path_info['dirname'].'/';
define('BASE_PATH', $base_path);


/**
 *	Definição da Pasta do Sistema
 *	@var string SYS_PATH
 */
if(is_dir(BASE_PATH.SYS_DIR))
	define('SYS_PATH', BASE_PATH.SYS_DIR.'/');
else 
	exit('A pasta do sistema não foi configurada corretamente: ' . $sis_folder);


/**
 *	Definição da Pasta da Aplicação
 *	@var string APP_PATH
 */
if(is_dir(BASE_PATH.APP_DIR))
	define('APP_PATH', BASE_PATH.APP_DIR.'/');
else
	exit('A pasta da aplicação não foi configurada corretamente: ' . $sis_folder);


/**
 * Definição do Caminho Raiz do Servidor
 * @var string HTTP_PATH
 */
define('HTTP_PATH', 	'http://'.$_SERVER['HTTP_HOST']);



/**
 * Definição do Ambiente de Execução
 * @var string $ambient
 */

define('AMBIENT', 'dev');



switch (AMBIENT) {
	case 'dev':
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		break;
	case 'hom':
		ini_set('display_errors',1);
		error_reporting(E_ERROR);
		break;
	case 'prod':
	default:
		error_reporting(0);
		break;
}



define('E_LOG', 'log/error.log');


/**
 * Chamada do Controler e Inicialização
 */
require_once SYS_PATH.'/Control.php';
Control::run();

