<?php
/**
* Debug
*
* Class for debugging
* Use the singleton instantiator class to make sure only one instance is created
*
* @copyright	Copyright &copy; 2005, The Motion Studio multimedia productions
* @author 		Wouter Tengeler
* @package		Webshop
* @version		$Revision: 1.2 $
* Platform:		PHP 5
* Date created : 20-feb-2004
* Date changed : 14-dec-2007
*
* History
* 01-oct-2004	: converted to PHP 5
* 10-may-2005 : added PHPdoc control elements
* 03-nov-2005 : removed external singleton class
* 14-dec-2007 : Changed defines to class constants 
*/
/**
* Debug
* Class for writing debug information to screen or file
* @access public
* uses optional singleton pattern
*/
class Debug {
	const LEVEL_OFF = 0;
	const LEVEL_INFO = 1;
	const LEVEL_WARNING = 2;
	const LEVEL_ERROR = 3;
	const LEVEL_ALL = 5;
	
	const OUTPUT_FILE = 1;
	const OUTPUT_SCREEN = 2;
	
	/**
	* @var clsDebug singleton container
	* @access private
	*/
	private static $s_oInstance;

	private $m_nLevel;
	private $m_nPrevLevel;
	private $m_nOutputType;
	private $m_sLogFile;
	
	// Contructor
	// @access public
	public function __construct() {
		$this->m_nLevel = self::LEVEL_ALL;
		$this->m_nPrevLevel = self::LEVEL_ALL;
		$this->m_nOutputType = self::OUTPUT_FILE;
		$this->m_sLogfile = "debug.txt";
	}
	
	/**
	* instantiate return a singleton object for the Debug class
	*
	* The method return a new object if it does not exist, otherwise return the existing object
	* @access public
	* @return Debug
	*/
  public static function instantiate()  {
    if (self::$s_oInstance === null) {
      self::$s_oInstance = new Debug();
    }

    return self::$s_oInstance;
  }
   
	// Destructor
	// @access public
	function __destruct() {
		// nothing to destruct
	}

  /**
  * clearLog: Clear the current log
  *
  * @access public
  * @return boolean True if log is cleared
  * @todo implement clearlog for database type
  * @throws IOException, Exception
  */
  public function clearLog() {
    $bResult = false;
    if ($this->m_nOutputType == self::OUTPUT_FILE) {
			$sDebugString = strftime("%d-%m-%Y %H:%M:%S")." - Log cleared";
			try {
				$fd = @fopen ($this->m_sLogfile, "w");
				if($fd) {
					$chars = fwrite($fd, $sDebugString."\n");
					if ($chars === false) {
						throw new IOException(get_class($this)."::".__FUNCTION__." - write failed: ".$this->m_sLogfile."\n");
					}
					fclose($fd);
          $bResult = true;
				} else {
					throw new IOException(get_class($this)."::".__FUNCTION__." - open failed: ".$this->m_sLogfile."\n");
				}
			} catch (Exception $e) {
				throw new Exception(get_class($this)."::".__FUNCTION__."\n".$e->getMessage(), $e->getCode());
			}
    }
    return $bResult;
  }
  
	//*******************************************************
	// SET FUNCTIONS
	//*******************************************************
	
	/**
	* setLevel
	* 
	* @access public
	* @param numeric p_nLevel
	* @return numeric the previous debug level
	*/
	public function setLevel($p_nLevel) {
		$this->m_nPrevLevel = $this->m_nLevel;
		$this->m_nLevel = $p_nLevel;
		return $this->m_nPrevLevel;
	}

	/**
	* getLevel
	*
	* @access public
	* @return numeric the current debug level
	*/
	public function getLevel() {
		return $this->m_nLevel;
	}

	/**
	* restoreLevel
	*	Restore the previous debuglevel 
	*
	* @access public
	* @param number p_nLevel
	* @return boolean
	*/
	public function restoreLevel() {
		$nLevel = $this->m_nLevel;
		$this->m_nLevel = $this->m_nPrevLevel;
		$this->m_nPrevLevel = $nLevel;
		return true;
	}
	
	/**
	* setOutput
	* 
	* @access public
	* @param number p_nOutput
	* @return boolean
	*/
	public function setOutput($p_nOutput) {
		$this->m_nOutputType = $p_nOutput;
		return true;
	}
	
	/**
	* getOutput
	*
	* @access public
	* @return numeric the output type
	*/
	public function getOutput() {
		return $this->m_nOutputType;
	}

	/**
	* setLogFile sets the path and name of the logfile to write to
	* 
	* @access public
	* @param string p_sFile
	* @return boolean
	* @throws IOException
	*/
	public function setLogfile($p_sFile) {
		if ($fp = @fopen($p_sFile, 'a+')) { 
			if ($fp !== false) {
				fclose($fp);
			} else {
				throw new IOException(get_class($this)."::".__FUNCTION__." - cannot write to logfile : ".$p_sFile."\n");
			}
		}
		$this->m_sLogfile = $p_sFile;
		return true;
	}

	/**
	* getLogfile
	*
	* @access public
	* @return string the current logfile
	*/
	public function getLogfile() {
		return $this->m_sLogfile;
	}

	//*******************************************************
	// PUBLIC FUNCTIONS
	//*******************************************************
	
	/**
	* logDebug
	* Logs a debug message to the current output
	* if an error occurs while writing the debugfile, an exception is thrown
	* 
	* @access public
	* @param number p_nLevel
	* @param string p_sMessage
	* @return boolean
	*/
	public function logDebug($p_nLevel, $p_sMessage) {
		try {
   		$sDebugString = "";
   		if ($p_nLevel <= $this->m_nLevel) {
         list($nMicroSec, $nTimestamp) = explode(" ", microtime());
         $sDebugString = strftime("%d-%m-%Y %H:%M:%S", floatval($nTimestamp)).".".sprintf("%03d", (floatval($nMicroSec)*1000))." - ";
   			switch ($p_nLevel) {
   				case self::LEVEL_INFO : $sDebugString .= "INFO : ";
   				break;
   				case self::LEVEL_WARNING : $sDebugString .= "WARNING : ";
   				break;
   				case self::LEVEL_ERROR : $sDebugString .= "ERROR : ";
   				break;
   			}
   			$sDebugString .= $p_sMessage;
   			switch ($this->m_nOutputType) {
   				case self::OUTPUT_FILE :
   				try {
   					$fd = @fopen ($this->m_sLogfile, "a");
   					if ($fd !== false) {
   						$chars = fwrite($fd, $sDebugString."\n");
   						if ($chars === false) {
   							throw new IOException(get_class($this)."::".__FUNCTION__." - write failed: ".$this->m_sLogfile."\n");
   						}	
   						@fclose($fd);
   					} else {
   						throw new IOException(get_class($this)."::".__FUNCTION__." - open failed: ".$this->m_sLogfile."\n");
   					}
   				} catch (Exception $e) {
   					throw new Exception(get_class($this)."::".__FUNCTION__."\n".$e->getMessage(), $e->getCode());
   				}
   				break;
   				case self::OUTPUT_SCREEN :
   				echo($sDebugString."<br/>");
   				break;
   				default : // default is output to screen (HTML)
   				echo($sDebugString."<br/>");
   			}
   		}
   	} catch (Exception $e) {
   	   // error in logging. echo it to screen (development time only).
			echo("Exception in logger: ".$sDebugString." [".$e->getMessage()."]");
    }
		return true;
	}
}
?>
