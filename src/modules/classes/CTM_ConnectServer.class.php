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

if(!class_exists("CTM_ConnectServer")) :

class CTM_ConnectServer extends CTM_MSSQL
{
	private $CS_Socket = NULL;
	
	public function __construct($Enable)
	{
		if($Enable == TRUE)
		{
			new CTM_Cache();
			
			if(CTM_Cache::Check_Cache(2) == TRUE)
			{
				set_time_limit(0);
				$this->CS_Socket = @fsockopen(CS_Host, CS_Port, $error, $msg, 5);
				if($this->CS_Socket == FALSE)
				{
					@fclose($this->CS_Socket);
					exit("<div class=\"min-error\">Servidores Offline</div>\n");
					break;
				}
				else
				{
					@fclose($this->CS_Socket);
					CTM_Cache::Update_Cache("CS");
				}
			}
		}
	}
	public function ServerCount($GS_Count, $ServerName)
	{
		$Query = $GS_Count == TRUE ? "SELECT * FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE ConnectStat=1 and ServerName='{$ServerName}'" : "SELECT * FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE ConnectStat=1";
		return $this->NumQuery($Query);
	}
}
endif;
?>