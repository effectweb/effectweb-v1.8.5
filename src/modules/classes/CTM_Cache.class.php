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

if(!class_exists("CTM_Cache")) :

class CTM_Cache
{
	private static $Cache_File = "modules/core/Core_Cache.ini";
	private static $Open_Cache = NULL;
	private static $Explode = NULL;
	private static $CS_Cache = 2;
	
	public function __construct()
	{
		global $CTM_Crypt;
		
		if(file_exists(self::$Cache_File) == FALSE)
		{
			$Write .= "[CTM_Cache]\n\r\n\r\n\r";
			$Write .= "CTM_ConnectServer = \"".base64_encode(bin2hex($CTM_Crypt->EncodeKey(time())))."\"";
			$Open = fopen(self::$Cache_File, "a+");
			fwrite($Open, $Write);
			@fclose($Open);
			unset($Write);
		}
	}
	public static function Check_Cache($Line)
	{
		global $CTM_Crypt;
		
		self::$Open_Cache = file(self::$Cache_File);
		
		self::$Explode = explode(" = \"", self::$Open_Cache[$Line]);
		self::$Explode = explode("\"", self::$Explode[1]);
		
		if(time() >= base64_decode($CTM_Crypt->DecodeKey(pack("H*", self::$Explode[0]))))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public static function Update_Cache($Line)
	{
		global $CTM_Crypt;
		
		self::$Open_Cache = fopen(self::$Cache_File, "w");
		
		if($Line == "CS")
		{
			$New_Cache = strtotime("+ ".self::$CS_Cache." hours");
			$Write .= "[CTM_Cache]\n\r\n\r\n\r";
			$Write .= "CTM_ConnectServer = \"".base64_encode(bin2hex($CTM_Crypt->EncodeKey($New_Cache)))."\"";
			fwrite(self::$Open_Cache, $Write);
			@fclose(self::$Open_Cache);
			unset($Write);
		}
	}
}
endif;
?>