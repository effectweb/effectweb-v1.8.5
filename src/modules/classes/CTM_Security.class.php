<?php
//*******************************************//
// -> Effect Web                             //
// -> Security Inject System                 //
// -> Powered By: Erick-Master               //
// -> CTM TeaM Softwares                     //
// -> www.ctmts.com.br                       //
//*******************************************//

$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	exit("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>CTM-Error: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}

if(IN_EFFECTWEB != "47e5098c88cc5f67543414ff1af32efc")
	exit("<!-- CTM.Error(x); -->");
	
if(!class_exists("CTM_Security")) :

class CTM_Security
{
	private $badwords = array("'", ";", "--");
	
	public function __construct()
	{
		//$this->loadSessionProtect();
		
		$GLOBALS["_POST"] = $this->AntiInject($GLOBALS["_POST"]);
		$GLOBALS["_GET"] = $this->AntiInject($GLOBALS["_GET"]);
		$GLOBALS["_COOKIE"] = $this->AntiInject($GLOBALS["_COOKIE"]);
		//$GLOBALS["_REQUEST"] = $this->AntiInject($GLOBALS["_REQUEST"]);
	}
	private function AntiInject($variable)
	{
		$return = array();
		
		foreach($variable as $key => $value)
			$return[$key] = $this->RemoveCharacters($value);
			
		return $return;
	}
	private function InjectSystem($Command)
	{
		/* Disabled */
		@mkdir("modules/Logs");
		if(!file_exists("modules/Logs/CTM_Injects.htm"))
		{
			$Creat = @fopen("modules/Logs/CTM_Injects.htm", "a+");
			@fwrite($Creat, "*******************************************<br />\n -> Effect Web ".base64_decode(Web_Version)."<br />\n -> Security Inject System<br />\n -> Powered by Erick-Master<br />\n -> CTM Team Softwares<br />\n -> www.ctmts.com.br<br />\n*******************************************<br />\n\n");
			@fclose($Creat);
		}
		$Date = date("d/m/Y");
		$Time = date("H:i:s");
		$Browser = $_SERVER["HTTP_USER_AGENT"];
		$Requested = $_SERVER["REQUEST_URI"];
		$Method = $_SERVER["REQUEST_METHOD"];
		$Addr = $_SERVER["REMOTE_ADDR"];
		$HostAddr = gethostbyaddr($Addr);
		$LogInject = "&bull; IP do usuario: <b>".$Addr."</b><br />\n";
		$LogInject .= "&bull; IP Reverso: <b>".$HostAddr."</b><br />\n";
		$LogInject .= "&bull; Data: <b>".$Date."</b><br />\n";
		$LogInject .= "&bull; Hora: <b>".$Time."</b><br />\n";
		$LogInject .= "&bull; Navegador: <b>".$Browser."</b><br />\n";
		$LogInject .= "&bull; Pagina: <b>".$Requested."</b><br />\n";
		$LogInject .= "&bull; Metodo usado: <b>".$Method."</b><br />\n";
		$LogInject .= "&bull; Comando efetuado: <b>".$Command."</b><br />\n";
		$LogInject .="==============================================================================================================<br />\n";
		$FileLog = @fopen("modules/Logs/CTM_Injects.htm", "a");
		@fwrite($FileLog, $LogInject);
		@fclose($FileLog);
		exit("<script>window.alert('CTM-Error: Limpe os cookies ou retire os caracteres invalidos.'); history.go(-1);</script>");
	}
	private function CheckValues($String)
	{
		/* Disabled */
		if(substr_count($String, "'") > 0)
		{
			$this->InjectSystem($String);
		}
		if(substr_count($String, "--") > 0)
		{
			$this->InjectSystem($String);
		}
		if(substr_count($String, ";") > 0)
		{
			$this->InjectSystem($String);
		}
		/*if(0 < substr_count($String, "\"") > 0)
		{
			$this->InjectSystem($String);
		}*/
		/*if(0 < substr_count($String, "<?") > 0)
		{
			$this->InjectSystem($String);
		}
		if(0 < substr_count($String, "?>") > 0)
		{
			$this->InjectSystem($String);
		}
		if(0 < substr_count($String, "mssql_") > 0)
		{
			$this->InjectSystem($String);
		}
		if(0 < substr_count($String, "_query") > 0)
		{
			$this->InjectSystem($String);
		}*/
		return $String;
	}
	private function RemoveCharacters($string)
	{
		return str_ireplace($this->badwords, NULL, $string);
	}
	private function loadSessionProtect()
	{
		//session_regenerate_id();
		
		if(array_key_exists("HTTP_USER_AGENT", $GLOBALS['_SESSION']))
		{
			if($GLOBALS['_SESSION']['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))
			{
				session_destroy();
				exit("<script>location.href='?'</script>");
			}
		}
		else
		{
			$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
		}
	}
}
endif;
?>