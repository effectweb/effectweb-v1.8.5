<?php
//**********************************************//
// -> Effect Web                                //
// -> Powered By: Erick-Master                  //
// -> CTM TeaM Softwares                        //
// -> www.ctmts.com.br                          //
//**********************************************//

$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	exit("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>CTM-Error: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}

if(IN_EFFECTWEB != "47e5098c88cc5f67543414ff1af32efc")
	exit("<!-- CTM.Error(x); -->");

if(!class_exists("CTM_MySQL")) :

class CTM_MySQL
{
	public $MySQL_Host = NULL;
	public $MySQL_User = NULL;
	public $MySQL_Pass = NULL;
	public $MySQL_Data = NULL;
	private $Connect = FALSE;
	private $DataBase = FALSE;
	
	public function __construct()
	{
		if(connection_aborted() == TRUE)
		{
			//@mysql_close($this->Connect);
		}
	}
	public function Connect()
	{	
		$this->Connect = @mysql_connect($this->MySQL_Host, $this->MySQL_User, $this->MySQL_Pass);
		$this->DataBase = @mysql_select_db($this->MySQL_Data, $this->Connect);
		if($this->Connect == FALSE || $this->DataBase == FALSE)
		{
			exit("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>CTM-Error #1: N&atilde;o foi Possivel Conectar-se ao Servidor MySQL.</strong></span>");
			return false;
		}
		return true;
	}
	private function MySQL_Log($SQL_Log, $Command)
	{
		@mkdir("modules/Logs");
		if(!file_exists("modules/Logs/CTM_MySQL.htm"))
		{
			$Creat = @fopen("modules/Logs/CTM_MySQL.htm", "a+");
			@fwrite($Creat, "*******************************************<br />\n -> Effect Web ".base64_decode(Web_Version)."<br />\n -> MySQL Security Log<br />\n -> Powered by Erick-Master<br />\n -> CTM Team Softwares<br />\n -> www.ctmts.com.br<br />\n*******************************************<br />\n\n");
			@fclose($Creat);
		}
		
		$Log .= "&bull; Date: <strong>".date("d/m/Y")."</strong><br />\n";
		$Log .= "&bull; Hour: <strong>".date("H:i:s")."</strong><br />\n";
		$Log .= "&bull; Time: <strong>".time()."</strong><br />\n";
		$Log .= "&bull; Recent IP Detected: <strong>".$_SERVER["REMOTE_ADDR"]."</strong><br />\n";
		$Log .= "&bull; File Error: <strong>".__FILE__."</strong><br />\n";
		$Log .= "&bull; Request: <strong>".$_SERVER["REQUEST_URI"]."</strong><br />\n";
		$Log .= "&bull; Command Fail: <strong>".$Command."</strong><br />\n";
		$Log .= "&bull; Exec: <strong>".$SQL_Log."</strong><br />\n";
		$Log .= "==============================================================================================================<br />\n";
		
		$Log_File = @fopen("modules/Logs/CTM_MySQL.htm", "a");
		@fwrite($Log_File, $Log);
		@fclose($Log_File);
	}
	public function Query($CTM_MySQL)
	{
		$Query = @mysql_query($CTM_MySQL);
		if($Query == FALSE)
		{
			if(constant("MySQL_Security_Log") == TRUE)
			{
				$this->MySQL_Log($CTM_MySQL, "Query");
			}
			exit("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\">CTM-Error #2: Erro ao executar Query : <strong>\"{$CTM_MySQL}\"</strong></span>");
		}
		return $Query;
	}
	public function Fetch($CTM_MySQL)
	{
		return @mysql_fetch_row($CTM_MySQL);
	}
	public function NumRow($CTM_MySQL)
	{
		return @mysql_num_rows($CTM_MySQL);
	}
	public function FetchArray($CTM_MySQL)
	{
		return @mysql_fetch_array($CTM_MySQL);
	}
	public function FetchObject($CTM_MySQL)
	{
		return @mysql_fetch_object($CTM_MySQL);
	}
	public function NumQuery($CTM_MySQL)
	{
		return @mysql_num_rows($this->Query($CTM_MySQL));
	}
	public function FetchQuery($CTM_MySQL)
	{
		return @mysql_fetch_row($this->Query($CTM_MySQL));
	}
}
endif;
?>