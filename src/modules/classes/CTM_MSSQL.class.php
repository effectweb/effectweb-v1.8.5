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

if(!class_exists("CTM_MSSQL")) :

class CTM_MSSQL
{
	private $Connect = FALSE;
	private $DataBase = FALSE;
	
	public function __construct()
	{
		$this->Connect();
		
		if(connection_aborted() == TRUE)
		{
			//@mssql_close($this->Connect);
		}
	}
	
	private function Connect()
	{
		if(extension_loaded("mssql") == FALSE)
		{
			if(strtoupper(substr(PHP_OS, 0, 3)) === "WIN")
			{
				dl("php_mssql.dll");
			}
			else
			{
				dl("mssql.so");
			}
		}
		
		$this->Connect = @mssql_connect(MSSQL_Host, MSSQL_User, MSSQL_Pass);
		$this->DataBase = @mssql_select_db(MSSQL_DB, $this->Connect);
		if($this->Connect == false || $this->DataBase == false)
		{
			exit("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>CTM-Error #1: N&atilde;o foi Possivel Conectar-se ao Servidor MSSQL.</strong></span>");
			return false;
		}
		return true;
	}
	private function MSSQL_Log($SQL_Log, $Command)
	{
		@mkdir("modules/Logs");
		if(!file_exists("modules/Logs/CTM_MSSQL.htm"))
		{
			$Creat = @fopen("modules/Logs/CTM_MSSQL.htm", "a+");
			@fwrite($Creat, "*******************************************<br />\n -> Effect Web ".base64_decode(Web_Version)."<br />\n -> MSSQL Security Log<br />\n -> Powered by Erick-Master<br />\n -> CTM Team Softwares<br />\n -> www.ctmts.com.br<br />\n*******************************************<br />\n\n");
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
		
		$Log_File = @fopen("modules/Logs/CTM_MSSQL.htm", "a");
		@fwrite($Log_File, $Log);
		@fclose($Log_File);
	}
	public function Query($CTM_MSSQL)
	{
		$Query = @mssql_query($CTM_MSSQL);
		if($Query == FALSE)
		{
			if(constant("MSSQL_Security_Log") == TRUE)
			{
				$this->MSSQL_Log($CTM_MSSQL, "Query");
			}
			exit("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\">CTM-Error #2: Erro ao executar Query : <strong>\"{$CTM_MSSQL}\"</strong></span>");
		}
		return $Query;
	}
	public function Fetch($CTM_MSSQL)
	{
		return @mssql_fetch_row($CTM_MSSQL);
	}
	public function NumRow($CTM_MSSQL)
	{
		return @mssql_num_rows($CTM_MSSQL);
	}
	public function FetchArray($CTM_MSSQL)
	{
		return @mssql_fetch_array($CTM_MSSQL);
	}
	public function FetchObject($CTM_MSSQL)
	{
		return @mssql_fetch_object($CTM_MSSQL);
	}
	public function NumQuery($CTM_MSSQL)
	{
		return @mssql_num_rows($this->Query($CTM_MSSQL));
	}
	public function FetchQuery($CTM_MSSQL)
	{
		return @mssql_fetch_row($this->Query($CTM_MSSQL));
	}
}
endif;
?>