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

if(!class_exists("CTM_Ajax")) :

class CTM_Ajax extends CTM_MSSQL
{
	public function Set_Panel()
	{
		global $CTM_General;
		
		if($CTM_General->Check_Logged(false) == FALSE)
		{
			$this->Login_Command();
			$this->Login_Form(false);
		}
		else
		{
			$this->Panel($_SESSION["Hash_Account"]);
		}
	}
	private function Login_Form($Message)
	{
		global $CTM_Template;
		
		$CTM_Template->Set("Account", $_POST["Log_Account"]);
		$CTM_Template->Set("Password", $_POST["Log_Password"]);
		$CTM_Template->Set("Message", $Message);
		
		$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/panel[LOGIN].ajax.php");
	}
	private function Panel($Account)
	{
		global $CTM_General, $CTM_Template, $CTM, $_PmSystem;
		
		if(isset($_SESSION["Hash_Account"]) == FALSE && isset($_SESSION["Hash_Password"]) == FALSE)
		{
			echo("<script>CTM_Load('?ajax=panel','Panel','GET');</script>
			<script>CTM_Load('?pag=home','conteudo','GET');</script>");
		}
		else
		{
			$Query = $this->Query("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}'");
			$Staff = $this->FetchQuery("SELECT type FROM {$CTM[0]} WHERE account='{$Account}'");
			$Type_Acc = $this->FetchQuery("SELECT ".VIP_Column." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='{$Account}'");
			$Golds = $this->FetchQuery("SELECT ".GL_Column_1.",".GL_Column_2.",".GL_Column_3." FROM ".GL_DB.".dbo.".GL_Table." WHERE ".GL_Login."='{$Account}'");
			$Load_Acc = $this->FetchArray($Query);
			$VIP_Type = $CTM_General->Memb_Type($Type_Acc[0]);
			
			/*************************************
				@ Private Message System
				@ Notifications
				@ By: Erick-Master
			**************************************/
			/*if($_PmSystem["Enable"] == TRUE)
			{
				if($_PmSystem["Mode"] == 0)
				{
					$Query_Chars = $this->Query("SELECT Name FROM ".MuGen_DB.".dbo.Character WHERE AccountID='".$_SESSION["Hash_Account"]."'");
					while($PM_Chars = $this->Fetch($Query_Chars))
					{
						$Check_PM = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.".$_PmSystem["Main"]." WHERE Name='{$PM_Chars[0]}'");
						if($Check_PM > 0)
						{
							$GUID = $this->FetchQuery("SELECT GUID FROM ".MuGen_DB.".dbo.".$_PmSystem["Main"]." WHERE Name='{$PM_Chars[0]}'");
							$Count_PM = $this->FetchQuery("SELECT count(*) FROM ".MuGen_DB.".dbo.".$_PmSystem["Table"]." WHERE GUID={$GUID[0]} and bRead=0");
						}
					}
				}
			}*/
			
			/*if($_PmSystem["Enable"] == TRUE)
			{
				if($_PmSystem["Mode"] == 0)
				{
					if($Count_PM[0] > 0)
					{
						$PM_Panel = "<li><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=paneluser&option=PM_ENTER','conteudo','GET');\"><b>&raquo; Notifica&ccedil;&otilde;es <span class=\"colr\">(".$Count_PM[0].")</span></b></a></li>";
					}
					else
					{
						$PM_Panel = "<li><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=paneluser&option=PM_ENTER','conteudo','GET');\">&raquo; Notifica&ccedil;&otilde;es (0)</a></li>";
					}
				}
			}*/
			$CTM_Template->Set("Memb_Name", $Load_Acc["memb_name"]);
			$CTM_Template->Set("Memb_Type", $VIP_Type);
			$CTM_Template->Set("Memb_Amount[1]", $Golds[0]);
			$CTM_Template->Set("Memb_Amount[2]", $Golds[1]);
			$CTM_Template->Set("Memb_Amount[3]", $Golds[2]);
			$CTM_Template->Set("PanelAdmin_Link", $Staff[0] > 0 ? "<li><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=paneladmin','conteudo','GET');\">&raquo; Painel Administrativo</a></li>" : NULL);
			//$CTM_Template->Set("PM_System#Notifications", $PM_Panel == TRUE ? $PM_Panel : NULL);
			
			$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/panel[LOGGED].ajax.php");
					
		}
	}
	private function Login_Command()
	{
		global $CTM_Crypt;
		
		if($_GET["cmd"] == "login")
		{
			$Account = $_POST["Log_Account"];
			$Password = $_POST["Log_Password"];
			$Check = $this->FetchQuery("exec dbo.CTM_CheckLogin '".$Account."','".$Password."',".USE_MD5."");
			$Find = $this->FetchQuery("SELECT bloc_code,mail_chek FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}'");
			
			if(empty($Account))
			{
				$this->Login_Form("<div class=\"min-warning\">Digite seu Login</div>");
			}
			elseif(empty($Password))
			{
				$this->Login_Form("<div class=\"min-warning\">Digite sua Senha</div>");
			}
			elseif($Check[0] !== 1)
			{
				$this->Login_Form("<div class=\"min-error\">Login ou Senha Incorreto</div>");
			}
			elseif($Find[0] == 1)
			{
				$this->Login_Form("<div class=\"min-error\">Sua conta est&aacute; Bloqueada</div>");
			}
			elseif($Find[1] == 0)
			{
				$this->Login_Form("<div class=\"min-error\">Sua conta n&atilde;o esta confirmada.</div>");
			}
			else
			{
				$_SESSION["Hash_Account"] = utf8_encode($Account);
				$_SESSION["Hash_Password"] = $CTM_Crypt->Pwd($Password);
				
				$this->Login_Form("<script>setTimeout(\"count()\", 1000);</script>
				<div class=\"min-success\">&raquo; Logado com Sucesso.<br />&raquo; Aguarde...</div>
				<span id=\"time\" style=\"display: none;\">2</span>");
			}
		}
	}
	public function ServerList()
	{
		if(constant("Server_List") == TRUE)
		{
			global $_ServerList;
			$CTM_ConnectServer = new CTM_ConnectServer(true);
			
			for($GS = 0; $GS < count($_ServerList); $GS++)
			{
				$Count = ceil($CTM_ConnectServer->ServerCount(true, $_ServerList[$GS][1]) * 100 / $_ServerList[$GS][2]);
				echo("<li>&raquo; ".$_ServerList[$GS][0]." : <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=online&gs=".urlencode($_ServerList[$GS][1])."','conteudo','GET');\"><strong id=\"".$_ServerList[$GS][1]."_ID\">".$Count."%</strong></a>
				<div class=\"OnlineCount\" id=\"ServerID".$_ServerList[$GS][1]."\">
				 <div class=\"ServerCount\" style=\"width: ".$Count."%\"></div>
				</div></li>");
			}
			echo("<li>Total: <strong id=\"TotalServers\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=online','conteudo','GET');\">".$CTM_ConnectServer->ServerCount(false, false)."</a></strong> <a href=\"javascript: void(EffectWeb);\" onClick=\"CTM_Load('?ajax=check&cmd=servers', 'ServerRefresh', 'GET');\"><img src=\"images/icons/refresh.png\" width=\"10\" height=\"10\" border=\"0\"></a></li>");
		}
		else
		{
			$CTM_ConnectServer = new CTM_ConnectServer(false);
			echo("<li>Total: <strong id=\"TotalServers\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=online','conteudo','GET')\">".$CTM_ConnectServer->ServerCount(false, false)."</a></strong> <a href=\"javascript: void(EffectWeb);\" onClick=\"CTM_Load('?ajax=check&cmd=servers', 'ServerRefresh', 'GET');\"><img src=\"images/icons/refresh.png\" width=\"10\" height=\"10\" border=\"0\"></a></li>");
		}
	}
	public function StaffList($Code)
	{
		$Query = $this->Query("SELECT Name,AccountID FROM ".MuGen_DB.".dbo.Character WHERE CtlCode={$Code} ORDER BY Name");
		$Check = $this->NumRow($Query);
		
		if($Check < 1)
		{
			exit("<div class=\"min-info\">Nenhum ADM/GM Cadastrados</div>");
		}
		for($WzAG = 0; $WzAG < $this->NumRow($Query); $WzAG++)
		{
			$Member = $this->Fetch($Query);
			$Status = $this->FetchQuery("SELECT ConnectStat FROM ".MuGen_DB.".dbo.MEMB_STAT WHERE memb___id='{$Member[1]}'");
			switch($Status[0])
			{
				case 0 : $Stat = "<span style=\"color: red;\">Offline</span>"; break;
				case 1 : $Stat = "<span style=\"color: green;\">Online</span>"; break;
			}
			echo("<li>&raquo; {$Member[0]} - {$Stat}</li>");
		}
	}
	public function RefreshServers()
	{
		global $_ServerList;
		$CTM_ConnectServer = new CTM_ConnectServer(true);
			
		echo "<script>document.getElementById('TotalServers').innerHTML = '<a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load(\'?pag=online\',\'conteudo\',\'GET\');\">".$CTM_ConnectServer->ServerCount(false, false)."</a>';</script>";
		for($GS = 0; $GS < count($_ServerList); $GS++)
		{
			$Count = ceil($CTM_ConnectServer->ServerCount(true, $_ServerList[$GS][1]) * 100 / $_ServerList[$GS][2]);
			echo "<script>document.getElementById('".$_ServerList[$GS][1]."_ID').innerHTML = '{$Count}%';
document.getElementById('ServerID".$_ServerList[$GS][1]."').innerHTML = '<div class=\"ServerCount\" style=\"width: {$Count}%\"></div>';</script>";
		}
		exit();
	}
}
endif;
?>