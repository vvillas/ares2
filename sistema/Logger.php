<?php 

/**
 * Singleton class
 *
 */
class Logger
{
	
	/*** Declare instance ***/
    private static $instance = NULL;
    private static $logFile = NULL;
    

    /**
     *
     * @Constructor is set to private to stop instantion
     *
     */
    private function __construct()
    {
    }
    
    

    /**
     *
     * @write to the logfile
     *
     * @access public
     *
     * @param string $message
     *
     * @param string $file The filename that caused the error
     *
     * @param int $line The line that the error occurred on
     *
     * @return number of bytes written, false other wise
     *
     */
    public static function write($message, $file=null, $line=null)
    {
    	
    	self::getInstance();
    	 
    	$message = date("Y-m-d h:i:sa") .' | '.$message;
    	$message .= is_null($file) ? '' : " in $file";
    	$message .= is_null($line) ? '' : " on line $line";
    	$message .= "\n";
    	
    	if(AMBIENT != "dev")
    	{
	        return file_put_contents( self::$logFile, $message, FILE_APPEND );
    	}
    	
    }

    /**
    *
    * Return logger instance or create new instance
    *
    * @return object (PDO)
    *
    * @access public
    *
    */
    public static function getInstance()
    {
    	
    	
    	
        if (!self::$instance)
        {
        	
        	$error_log_file = SYS_PATH.E_LOG;
        	
        	try {
        		
        		if(!file_exists($error_log_file))
        			$file = fopen($error_log_file, "w");
        		        		 
        		if(!is_writeable($error_log_file))
        			throw new Exception($this->logFile ." is not a writeable file");
        		
        	} catch (Exception $e) {
        		throw new Exception($this->logFile ." is not a writeable file");
        	}
        	
        	
            self::$instance = new Logger();
            
            self::$logFile = $error_log_file;
            
        }
        return self::$instance;
    }


    /**
     * Clone is set to private to stop cloning
     *
     */
    private function __clone()
    {
    }
    
}
?>