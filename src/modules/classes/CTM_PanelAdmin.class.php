<?php
//*******************************************//
// -> Effect Web                             //
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

if(!class_exists("CTM_PanelAdmin")) :

class CTM_PanelAdmin extends CTM_MSSQL
{
	private $Error = FALSE;
	private $Message = FALSE;
	
	public function __construct()
	{
		global $CTM_Template, $_PanelAdmin, $CTM_General, $CTM;
		$this->Login = $_SESSION["Hash_Account"];
		
		$CTMT = "templates/".$CTM_Template->Open()."/pages/";
		switch(strtoupper($_GET["str"]))
		{
			case "HOME" :
			$this->Home();
			$CTM_Template->Load($CTMT."paneladmin[HOME].pag.php");
			break;
			case "SYNCHRONIZE" :
			$this->Privilegy($_PanelAdmin["Manage"]["Synchronize"]);
			$this->Synchronize_DB();
			$CTM_Template->Load($CTMT."paneladmin[SYNCHRONIZE].pag.php");
			break;
			case "ADD_CRONTAB" :
			$CTM_General->License_Limit(2);
			$this->Add_CronbTab();
			$CTM_Template->Load($CTMT."paneladmin[ADD_CRONTAB].pag.php");
			break;
			case "MANAGE_CRONTAB" :
			$CTM_General->License_Limit(2);
			$this->List_CronTab();
			$CTM_Template->Load($CTMT."paneladmin[MANAGE_CRONTAB].pag.php");
			break;
			case "EDIT_CRONTAB" :
			$CTM_General->License_Limit(2);
			$this->Manage_CronTab();
			$CTM_Template->Load($CTMT."paneladmin[EDIT_CRONTAB].pag.php");
			break;
			case "SEND_MAIL" :
			$this->Privilegy($_PanelAdmin["Mail"]);
			$this->Send_Mail();
			$CTM_Template->Load($CTMT."paneladmin[SEND_MAIL].pag.php");
			break;
			case "MANAGE_WARNING" :
			$this->Privilegy($_PanelAdmin["Warning"]);
			$this->Manage_Warning();
			$CTM_Template->Load($CTMT."paneladmin[MANAGE_WARNING].pag.php");
			break;
			case "ADD_NEWS" :
			$this->Privilegy($_PanelAdmin["News"]);
			$this->Add_News();
			$CTM_Template->Load($CTMT."paneladmin[ADD_NEWS].pag.php");
			break;
			case "MANAGE_NEWS" :
			$this->Privilegy($_PanelAdmin["News"]);
			$this->List_News();
			$CTM_Template->Load($CTMT."paneladmin[MANAGE_NEWS].pag.php");
			break;
			case "EDIT_NEWS" :
			$this->Privilegy($_PanelAdmin["News"]);
			$this->Manage_News();
			$CTM_Template->Load($CTMT."paneladmin[EDIT_NEWS].pag.php");
			break;
			case "MANAGE_SCREENSHOTS" :
			$this->Privilegy($_PanelAdmin["ScreenShots"]);
			$this->Manage_ScreenShots();
			$CTM_Template->Load($CTMT."paneladmin[MANAGE_SCREENSHOTS].pag.php");
			break;
			case "ADD_FILE" :
			$this->Privilegy($_PanelAdmin["Downloads"]);
			$this->Add_File();
			$CTM_Template->Load($CTMT."paneladmin[ADD_FILE].pag.php");
			break;
			case "MANAGE_FILES" :
			$this->Privilegy($_PanelAdmin["Downloads"]);
			$this->File_List();
			$CTM_Template->Load($CTMT."paneladmin[MANAGE_FILES].pag.php");
			break;
			case "EDIT_FILE" :
			$this->Privilegy($_PanelAdmin["Downloads"]);
			$this->Manage_File();
			$CTM_Template->Load($CTMT."paneladmin[EDIT_FILE].pag.php");
			break;
			case "ADD_MEMBER" :
			$this->Privilegy($_PanelAdmin["Staff"]);
			$this->Add_Member();
			$CTM_Template->Load($CTMT."paneladmin[ADD_MEMBER].pag.php");
			break;
			case "MANAGE_MEMBER" :
			$this->Privilegy($_PanelAdmin["Staff"]);
			$this->List_Members();
			$CTM_Template->Load($CTMT."paneladmin[MANAGE_MEMBER].pag.php");
			break;
			case "EDIT_MEMBER" :
			$this->Privilegy($_PanelAdmin["Staff"]);
			$this->Manage_Member();
			$CTM_Template->Load($CTMT."paneladmin[EDIT_MEMBER].pag.php");
			break;
			case "POLL_OPT" :
			$this->Privilegy($_PanelAdmin["Poll"]);
			$CTM_Template->Load($CTMT."paneladmin[POLL_OPT].pag.php");
			break;
			case "ADD_POLL" :
			$this->Privilegy($_PanelAdmin["Poll"]);
			$this->Add_Poll();
			$CTM_Template->Load($CTMT."paneladmin[ADD_POLL].pag.php");
			break;
			case "MANAGE_POLL" :
			$this->Privilegy($_PanelAdmin["Poll"]);
			$this->Load_Poll();
			$CTM_Template->Load($CTMT."paneladmin[MANAGE_POLL].pag.php");
			break;
			case "EDIT_POLL" :
			$this->Privilegy($_PanelAdmin["Poll"]);
			$this->Manage_Poll();
			$CTM_Template->Load($CTMT."paneladmin[EDIT_POLL].pag.php");
			break;
			case "MANAGE_ACC" :
			$this->Privilegy($_PanelAdmin["Accounts"]["Manage"]);
			$CTM_Template->Load($CTMT."paneladmin[MANAGE_ACC].pag.php");
			break;
			case "EDIT_ACC" :
			$this->Privilegy($_PanelAdmin["Accounts"]["Manage"]);
			$this->Manage_Account();
			$CTM_Template->Load($CTMT."paneladmin[EDIT_ACC].pag.php");
			break;
			case "BAN_ACC" :
			$this->Privilegy($_PanelAdmin["Account"]);
			$this->Ban_Acc();
			$CTM_Template->Load($CTMT."paneladmin[BAN_ACC].pag.php");
			break;
			case "UNBAN_ACC" :
			$this->Privilegy($_PanelAdmin["Account"]);
			$this->Unban_Acc();
			$CTM_Template->Load($CTMT."paneladmin[UNBAN_ACC].pag.php");
			break;
			case "DELETE_ACC" :
			$this->Master_Admin();
			$this->Privilegy($_PanelAdmin["Account"]);
			$this->Delete_Account();
			$CTM_Template->Load($CTMT."paneladmin[DELETE_ACC].pag.php");
			break;
			case "CREATE_CHAR" :
			$this->Privilegy($_PanelAdmin["Characters"]["Create"]);
			$this->Create_Character();
			$CTM_Template->Load($CTMT."paneladmin[CREATE_CHAR].pag.php");
			break;
			case "MANAGE_CHAR" :
			$this->Privilegy($_PanelAdmin["Characters"]["Manage"]);
			$CTM_Template->Load($CTMT."paneladmin[MANAGE_CHAR].pag.php");
			break;
			case "EDIT_CHAR" :
			$this->Privilegy($_PanelAdmin["Characters"]["Manage"]);
			$this->Manage_Char();
			$CTM_Template->Load($CTMT."paneladmin[EDIT_CHAR].pag.php");
			break;
			case "BAN_CHAR" :
			$this->Privilegy($_PanelAdmin["Character"]);
			$this->Ban_Char();
			$CTM_Template->Load($CTMT."paneladmin[BAN_CHAR].pag.php");
			break;
			case "UNBAN_CHAR" :
			$this->Privilegy($_PanelAdmin["Character"]);
			$this->Unban_Char();
			$CTM_Template->Load($CTMT."paneladmin[UNBAN_CHAR].pag.php");
			break;
			case "DELETE_CHAR" :
			$this->Master_Admin();
			$this->Privilegy($_PanelAdmin["Character"]);
			$this->Delete_Character();
			$CTM_Template->Load($CTMT."paneladmin[DELETE_CHAR].pag.php");
			break;
			case "SHOW_REFERENCE" :
			$this->Privilegy($_PanelAdmin["Refrence"]);
			$this->Show_Reference();
			$CTM_Template->Load($CTMT."paneladmin[SHOW_REFERENCE].pag.php");
			break;
			case "RESET_REFERENCE" :
			$this->Privilegy($_PanelAdmin["Refrence"]);
			$this->Reset_Reference();
			$CTM_Template->Load($CTMT."paneladmin[RESET_REFERENCE].pag.php");
			break;
			case "TICKETS" :
			$CTM_General->License_Limit(2);
			$this->Privilegy($_PanelAdmin["Tickets"]);
			$this->List_Tickets();
			$CTM_Template->Load($CTMT."paneladmin[TICKETS].pag.php");
			break;
			case "VIEW_TICKET" :
			$CTM_General->License_Limit(2);
			$this->Privilegy($_PanelAdmin["Tickets"]);
			$this->Suportt_Tickets();
			$CTM_Template->Load($CTMT."paneladmin[VIEW_TICKET].pag.php");
			break;
			case "PAYMENTS" :
			$this->Privilegy($_PanelAdmin["Payments"]);
			$this->Payments();
			$CTM_Template->Load($CTMT."paneladmin[PAYMENTS].pag.php");
			break;
			case "VIEW_PAYMENT" :
			$this->Privilegy($_PanelAdmin["Payments"]);
			$this->Manage_Payment();
			$CTM_Template->Load($CTMT."paneladmin[VIEW_PAYMENT].pag.php");
			break;
			case "ADD_VIP" :
			$this->Privilegy($_PanelAdmin["VIP"]);
			$this->Add_VIP();
			$CTM_Template->Load($CTMT."paneladmin[ADD_VIP].pag.php");
			break;
			case "TRANSFORM_VIP" :
			$this->Privilegy($_PanelAdmin["VIP"]);
			$this->Transform_VIP();
			$CTM_Template->Load($CTMT."paneladmin[TRANSFORM_VIP].pag.php");
			break;
			case "DELETE_VIP" :
			$this->Privilegy($_PanelAdmin["VIP"]);
			$this->Delete_VIP();
			$CTM_Template->Load($CTMT."paneladmin[DELETE_VIP].pag.php");
			break;
			case "ADD_VIP_ALL" :
			$this->Privilegy($_PanelAdmin["VIP"]);
			$this->Privilegy($_PanelAdmin["VIPs"]["All"]);
			$this->Add_VIP_All_Accounts();
			$CTM_Template->Load($CTMT."paneladmin[ADD_VIP_ALL].pag.php");
			break;
			case "ADD_CASH" :
			$this->Privilegy($_PanelAdmin["Cash"]);
			$this->Add_Cash();
			$CTM_Template->Load($CTMT."paneladmin[ADD_CASH].pag.php");
			break;
			case "DELETE_CASH" :
			$this->Privilegy($_PanelAdmin["Cash"]);
			$this->Delete_Cash();
			$CTM_Template->Load($CTMT."paneladmin[DELETE_CASH].pag.php");
			break;
			case "SQL_BACKUP" :
			$CTM_General->License_Limit(2);
			$this->Privilegy($_PanelAdmin["SQL"]);
			$this->SQL_Backup();
			$CTM_Template->Load($CTMT."paneladmin[SQL_BACKUP].pag.php");
			break;
			case "CHECK_UPDATE" :
			$this->Privilegy($_PanelAdmin["ManageX"]);
			$this->Check_Name("Manage", "EffectWeb");
			$this->EffectWeb_CheckUpdate();
			$CTM_Template->Load($CTMT."paneladmin[CHECK_UPDATE].pag.php");
			break;
			/**********************************
				@ Raffle System
			***********************************/
			case "RAFFLE_PLAYER" :
			//$CTM_Template->Set("Award_Coin", constant("Coin_".$GLOBALS["_RaffleSystem"]["Coin"]));
			new CTM_RaffleSystem(1);
			$CTM_Template->Load($CTMT."paneladmin[RAFFLE_PLAYER].pag.php");
			break;
			case "CLEAR_RAFFLES" :
			new CTM_RaffleSystem(3);
			$CTM_Template->Load($CTMT."paneladmin[CLEAR_RAFFLES].pag.php");
			break;
			default :
			if($_GET["cmd"] == "warning")
			{
				$this->Query("DELETE dbo.{$CTM[5]}");
				exit("<div class=\"success-box\"> Aviso removido com Sucesso!</div>");
			}
			if(strtoupper($_GET["option"]) == TRUE)
			{
				$Navigator = $_GET["option"];
			}
			else
			{
				$Navigator = "HOME";	
			}
			$CTM_Template->Set("Panel_Navigator", "<script>CTM_Load('?pag=paneladmin&str=".$Navigator."','Panel_Nav','GET');</script>");
			$CTM_Template->Load($CTMT."paneladmin.pag.php"); 
			break;
		}
	}
	private function Privilegy($Privilegy, $String = 2)
	{
		global $CTM;
		
		$Check_Exists = $this->NumQuery("SELECT * FROM dbo.{$CTM[0]} WHERE account='{$this->Login}'");
		$Check = $this->FetchQuery("SELECT type FROM dbo.{$CTM[0]} WHERE account='{$this->Login}'");
		
		
		if($String == 1)
		{
			if($Check[0] < $Privilegy || $Check_Exists < 1)
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			if($Check[0] < $Privilegy || $Check_Exists < 1)
			{
				exit("<div class=\"info-box\"> Voc&ecirc; n&atilde;o tem privilegio para acessar esta op&ccedil;&atilde;o</div>");
			}
		}
	}
	private function Master_Admin()
	{
		global $_PanelAdmin;
		
		if(in_array($this->Login, $_PanelAdmin["General"]["Master"]) == FALSE)
		{
			exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o tem privilegio para usar est&aacute; op&ccedil;&atilde;o.</div>");
		}
	}
	private function Check_Name($String, $Value)
	{
		global $_PanelAdmin;
		
		if(in_array($this->Login, $_PanelAdmin[$String][$Value]) == FALSE)
		{
			exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o tem privilegio para usar est&aacute; op&ccedil;&atilde;o.</div>");
		}
	}
	private function Home()
	{
		global $CTM_General, $CTM_Template, $controller;
		echo("<script type=\"text/javascript\" src=\"modules/javascripts/SpryTabbedPanels.js\"></script>
		<script type=\"text/javascript\">
		function Serial() 
		{
			Sexy.info('<span class=\"h1\"> Serial de Licen&ccedil;a</span><br /><br />".$CTM_General->WebSite_Information(2)."');
		}
		</script>
		<style type=\"text/css\"> @import url('modules/css/SpryTabbedPanels.css'); </style>\n\r");
		
		if(@Status_Enable == true)
		{
			$Connect_GS = @fsockopen(GS_Host, GS_Port, $error, $msg, 1);
		}
		$Info["Accounts"] = $CTM_General->ServerInfo(1, MuAcc_DB, "MEMB_INFO", false, false, false);
		$Info["Characters"] = $CTM_General->ServerInfo(1, MuGen_DB, "Character", false, false, false);
		$Info["Guilds"] = $CTM_General->ServerInfo(1, MuGen_DB, "Guild", false, false, false);
		$Info["VIP-1"] = $CTM_General->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 1, false);
		$Info["VIP-2"] = $CTM_General->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 2, false);
		$Info["Acc_Ban"] = $CTM_General->ServerInfo(2, MuAcc_DB, "MEMB_INFO", "bloc_code", 1, false);
		$Info["Char_Ban"] = $CTM_General->ServerInfo(2, MuGen_DB, "Character", "CtlCode", 1, false);
		$Info["Status"] = Status_Enable == 1 ? $Connect_GS == true ? "<span style=\"color: green;\">Online</span>" : "<span style=\"color: red;\">Offline</span>" : "<span style=\"color: red;\">Manuten&ccedil;&atilde;o</span>";
		
		$CTM_Template->Set("Operation_System", $_ENV["OS"]);
		$CTM_Template->Set("Computer_Name", $_ENV["COMPUTERNAME"]);
		$CTM_Template->Set("Server_Software", $_SERVER["SERVER_SOFTWARE"]);
		$CTM_Template->Set("Server_Admin", $_SERVER["SERVER_ADMIN"]);
		$CTM_Template->Set("Server_Addr", $_SERVER["SERVER_ADDR"]);
		$CTM_Template->Set("Server_Port", $_SERVER["SERVER_PORT"]);
		$CTM_Template->Set("Info_Accounts", $Info["Accounts"][0]);
		$CTM_Template->Set("Info_VIP-1", $Info["VIP-1"][0]);
		$CTM_Template->Set("Info_VIP-2", $Info["VIP-2"][0]);
		$CTM_Template->Set("Info_Characters", $Info["Characters"][0]);
		$CTM_Template->Set("Info_Char-Ban", $Info["Char_Ban"][0]);
		$CTM_Template->Set("Info_Acc-Ban", $Info["Acc_Ban"][0]);
		$CTM_Template->Set("Info_Status", $Info["Status"]);
		$CTM_Template->Set("EffectWeb_Name", constant("Product"));
		$CTM_Template->Set("EffectWeb_Version", $controller->version->getVersion("full"));
		$CTM_Template->Set("EffectWeb_Update", $CTM_General->WebSite_Information(4));
		$CTM_Template->Set("EffectWeb_Holder",$CTM_General->WebSite_Information(5));
		$CTM_Template->Set("EffectWeb_Domain", $controller->getServerInfo("address"));
		$CTM_Template->Set("EffectWeb_License", $CTM_General->WebSite_Information(3));
		$CTM_Template->Set("EffectWeb_Expiration", $CTM_General->WebSite_Information(1));
		$CTM_Template->Set("Developer_Name", "Erick-Master");
		$CTM_Template->Set("Developer_Mail", "erick-master@ctmts.com.br");
		$CTM_Template->Set("Developer_Skype", "erick-master.am");
		$CTM_Template->Set("Developer_Phone", "(31) 9702-2076");
		$CTM_Template->Set("Developer_Page", "www.ctmts.com.br");
	}
	private function Synchronize_DB()
	{
		global $CTM_Template;
		
		switch($_GET["syntax"])
		{
			case "VIP" : $Syntax = "Contas ".VIP_1."/".VIP_2; break;
			case "CHAR" : $Syntax = "Chars Banidos"; break;
			case "ACC" : $Syntax = "Contas Banidas"; break;
		}
		$CTM_Template->Set("Syntax", $Syntax);
		$CTM_Template->Set("Synchronize_Result", $this->Synchronize($_GET["syntax"]));
	}
	private function Synchronize($Syntax)
	{
		global $CTM_General, $CTM;
		
		if($Syntax == "VIP")
		{
			$Query = $this->Query("SELECT ".VIP_Time.",".VIP_Credits.",".VIP_Login.",".VIP_Column." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Column." > 0");
			while($Synchronizing = $this->Fetch($Query))
			{
				if(time() >= $Synchronizing[0] || $Synchronizing[1] < 1)
				{
					$this->Query("UPDATE ".VIP_DB.".dbo.".VIP_Table." SET ".VIP_Column."=0,".VIP_Begin."=0,".VIP_Time."=0,".VIP_Credits."=0 WHERE ".VIP_Login."='".$Synchronizing[2]."'");
					$Operation .= "&raquo; <strong>".$Synchronizing[2]."</strong> - <strong class=\"colr\">".$CTM_General->Memb_Type($Synchronizing[3])."</strong> vencido <strong class=\"red\">[".date("d/m/Y", $Synchronizing[0])." as ".date("H:i", $Synchronizing[0])."]</strong><br />\n";
				}
			}
			$Count = count($Operation);
			return $Count < 1 ? "<div class=\"info-box\"> Nenhum VIP vencido</div>" : $Operation;
		}
		if($Syntax == "CHAR")
		{
			$Query = $this->Query("SELECT Time,Character FROM dbo.{$CTM[8]}");
			while($Synchronizing = $this->Fetch($Query))
			{
				if(time() >= $Synchronizing[0])
				{
					$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET CtlCode=0 WHERE Name='{$Synchronizing[1]}'");
					$this->Query("DELETE dbo.{$CTM[8]} WHERE Character='{$Synchronizing[1]}'");
					$Operation .= "&raquo; Char <strong class=\"colr\">".$Synchronizing[1]."</strong> desbanido <strong class=\"red\">[".date("d/m/Y", $Synchronizing[0])." as ".date("H:i", $Synchronizing[0])."]</strong><br />\n";
				}
			}
			$Count = count($Operation);
			return $Count < 1 ? "<div class=\"info-box\"> Nenhum personagem desbanido</div>" : $Operation;
		}
		if($Syntax == "ACC")
		{
			$Query = $this->Query("SELECT Time,Account FROM dbo.{$CTM[7]}");
			while($Synchronizing = $this->Fetch($Query))
			{
				if(time() >= $Synchronizing[0])
				{
					$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET bloc_code=0 WHERE memb___id='{$Synchronizing[1]}'");
					$this->Query("DELETE dbo.{$CTM[7]} WHERE Account='{$Synchronizing[1]}'");
					$Operation .= "&raquo; Conta <strong class=\"colr\">".$Synchronizing[1]."</strong> desbanida <strong class=\"red\">[".date("d/m/Y", $Synchronizing[0])." as ".date("H:i", $Synchronizing[0])."]</strong><br />\n";
				}
			}
			$Count = count($Operation);
			return $Count < 1 ? "<div class=\"info-box\"> Nenhuma conta desbanida</div>" : $Operation;
		}
	}
	private function Send_Mail()
	{
		global $_Mailer;
		$CTM_BBCode = new CTM_BBCode();
		
		if($_GET["cmd"] == TRUE)
		{
			$Account = $_POST["Account_Mail"];
			$Subject = base64_encode($_POST["Subject"]);
			$Text = base64_encode(str_replace("\\", NULL, $_POST["Text"]));
			
			$Check = $this->NumQuery("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}' or mail_addr='{$Account}'");
			$Find = $this->FetchQuery("SELECT memb_name,mail_addr,memb___id FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}' or mail_addr='{$Account}'");
			
			if(empty($Account) || empty($Subject) || empty($Text))
			{
				exit("<div class=\"warning-box\"> Preencha todos os campos.</div>");
			}
			elseif($Check < 1)
			{
				exit("<div class=\"error-box\"> Esta conta/e-mail n&atilde;o existe!");
			}
			else
			{
				$Text = str_replace("{Memb_Name}", $Find[0], base64_decode($Text));
				$Text = str_replace("{Memb_Mail}", $Find[1], $Text);
				$Text = str_replace("{Memb_Login}", $Find[2], $Text);
				$Text = base64_encode(str_replace("\n", "<br />", $Text));
				
				/***************************** Send Mail ******************************/
				$CTM_Mailer = new CTM_Mailer();
				$CTM_Mailer->SMTP_Server = $_Mailer["SMTP"]["Server"];
				$CTM_Mailer->SMTP_Port = $_Mailer["SMTP"]["Port"];
				$CTM_Mailer->SMTP_User = $_Mailer["SMTP"]["User"];
				$CTM_Mailer->SMTP_Pass = $_Mailer["SMTP"]["Pass"];
				$CTM_Mailer->Mail_From = $_Mailer["SMTP"]["Mail"];
				$CTM_Mailer->SMTP_Debug = $_Mailer["SMTP"]["Debug"];
				$CTM_Mailer->Mail_To = $Find[1];
				$CTM_Mailer->Mail_Sender = "Suporte ".constant("Server_Name");
				$CTM_Mailer->Mail_Recipient = $Find[0];
				$CTM_Mailer->Mail_Subject = utf8_decode(base64_decode($Subject)." - ".constant("Server_Name"));
				$CTM_Mailer->Mail_Message = utf8_decode($CTM_BBCode->Replace(base64_decode($Text)));
				
				if($CTM_Mailer->Send_Mail() == FALSE)
				{
					exit("<div class=\"error-box\"> Erro ao enviar o E-Mail!</div>");
				}
				else
				{
					exit("<div class=\"success-box\"> E-Mail enviado com Sucesso ao Jogador!");
				}
			}
		}
	}
	private function Add_CronbTab()
	{
		global $CTM, $_PanelAdmin;
		
		if($_GET["cmd"] == TRUE)
		{
			$Moeda = (int)$_POST['Moeda'];
			$Number = (int)$_POST["Number"];
			$CronTab = (int)$_POST["CronTab"];
			//$Day = (int)$_POST["Cron_Day"];
			//$Month = $_POST["Cron_Month"];
			//$Year = (int)$_POST["Cron_Year"];
			$Hours = (int)$_POST["Hours"];
			$Minutes = (int)$_POST["Minutes"];
			
			//$Cron_Date = strtotime($Day." ".$Month." ".$Year);
			$Time = $Hours.":".$Minutes;
			
			//if(empty($Day)) { $Error[0] .= "&raquo; Dia para o termino do CronTab<br />\n"; }
			//if(empty($Month)) { $Error[0] .= "&raquo; M&ecirc;s para o termino do CronTab<br />\n"; }
			//if(empty($Year)) { $Error[0] .= "&raquo; Ano para o termino do CronTab<br />\n"; }
			if(strlen($Hours) < 1) { $Error[0] .= "&raquo; Horas para executar o CronTab<br />\n"; }
			if(strlen($Minutes) < 1) { $Error[0] .= "&raquo; Minutos para executar o CronTab<br />\n"; }
			if($CronTab == 4 && (empty($Moeda) || $Moeda < 1 || $Moeda > 3)) { $Error[0] .= "&raquo; Selecione uma moeda v&aacute;lida<br />\n"; }
			if($CronTab == 4 && $Number == NULL) { $Error[0] .= "&raquo; Quantidade a Receber<br />\n"; }
			
			$Number = $CronTab < 4 ? 0 : $Number;
			$Moeda = $CronTab < 4 ? 0 : $Moeda;
			
			if($Error[0] == TRUE)
			{
				exit("<div class=\"warning-box\"> Preencha os seguintes campos:<br /><br />{$Error[0]}</div>");
			}
			else
			{
				//$this->Query("INSERT INTO dbo.{$CTM[13]} (CronTab,Cron_Runing,Cron_Date,Cron_Time,Number) VALUES ({$CronTab},0,{$Cron_Date},'{$Time}',{$Number})");
				$this->Query("INSERT INTO dbo.{$CTM[13]} (CronTab,Cron_Time,Coin,Number) VALUES ({$CronTab},'{$Time}',{$Moeda},{$Number})");
				exit("<div class=\"success-box\"> CronTab Adicionado com Sucesso.</div>");
			}
		}
		echo("<script type=\"text/javascript\">
				function Check_CronTab()
				{
					var CronTab = document.getElementById('CronTab').value; 
					if(CronTab < 4)
					{
						document.getElementById(\"Number\").disabled = true;
						document.getElementById(\"Moeda\").disabled = true;
					}
					else if(CronTab == 4)
					{
						document.getElementById(\"Number\").disabled = false;
						document.getElementById(\"Moeda\").disabled = false;
					}
				}
				</script>\n\r");
		if(in_array($_SESSION["Hash_Account"], $_PanelAdmin["CronbJob"]["Security"]) == FALSE)
		{
			exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o para usar esta op&ccedil;&atilde;o.</div>");
		}
	}
	private function List_CronTab()
	{
		global $CTM_Template, $CTM, $_PanelAdmin;
		
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[13]}");

		if($_GET["cmd"] == "delete")
		{
			$Check_Delete = $this->NumQuery("SELECT * FROM dbo.{$CTM[13]} WHERE Id='".$_POST["Id"]."'");
			if($Check_Delete < 1)
			{
				exit("<div class=\"error-box\"> Este CronTab n&atilde;o existe.</div>");
			}
			else
			{
				$this->Query("DELETE dbo.{$CTM[13]} WHERE Id='".$_POST["Id"]."'");
				exit("<div class=\"success-box\"> CromTab deletado com Sucesso!</div>");
			}
		}
		if(in_array($_SESSION["Hash_Account"], $_PanelAdmin["CronbJob"]["Security"]) == FALSE)
		{
			exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o para usar esta op&ccedil;&atilde;o.</div>");
		}
		if($Check < 1)
	   	{
		   	exit("<div class=\"info-box\"> N&atilde;o h&aacute; CronTabs cadastrados no momento.</div>");
	   	}
	    else
	   	{
		  	$Query = $this->Query("SELECT Id,CronTab,Cron_Time,Cron_Next FROM dbo.{$CTM[13]} ORDER BY Id DESC");
		   	while($Get = $this->Fetch($Query))
		   	{
				switch($Get[1])
				{
					case 1 : $Name = "Sitronizar VIP"; break;
					case 2 : $Name = "Sitronizar Chars Banidos"; break;
					case 3 : $Name = "Sitronizar Contas Banidas"; break;
					case 4 : $Name = "Sortear Jogador"; break;
				}
			   	$Return .= "<option value=\"{$Get[0]}\">{$Name} - {$Get[2]} (".date("d/m/Y", $Get[3]).")</option>\n";
		   	}
			$CTM_Template->Set("CronTab_List", $Return);
			unset($Return);
		}
	}
	private function Manage_CronTab()
	{
		global $CTM_Template, $CTM, $_PanelAdmin;
		
		if($_GET["cmd"] == TRUE)
		{
			$Moeda = (int)$_POST["Moeda"];
			$Number = (int)$_POST["Number"];
			$CronTab = (int)$_POST["CronTab"];
			//$Day = (int)$_POST["Cron_Day"];
			//$Month = $_POST["Cron_Month"];
			//$Year = (int)$_POST["Cron_Year"];
			$Hours = (int)$_POST["Hours"];
			$Minutes = (int)$_POST["Minutes"];
			
			//$Cron_Date = strtotime($Day." ".$Month." ".$Year);
			$Time = $Hours.":".$Minutes;
			
			//if(empty($Day)) { $Error[0] .= "&raquo; Dia para o termino do CronTab<br />\n"; }
			//if(empty($Month)) { $Error[0] .= "&raquo; M&ecirc;s para o termino do CronTab<br />\n"; }
			//if(empty($Year)) { $Error[0] .= "&raquo; Ano para o termino do CronTab<br />\n"; }
			if(strlen($Hours) < 1) { $Error[0] .= "&raquo; Horas para executar o CronTab<br />\n"; }
			if(strlen($Minutes) < 1) { $Error[0] .= "&raquo; Minutos para executar o CronTab<br />\n"; }
			if($CronTab == 4 && empty($Number)) { $Error[0] .= "&raquo; Quantidade a Receber<br />\n"; }
			
			$Number = $CronTab < 4 ? 0 : $Number;
			$Moeda = $CronTab < 4 ? 0 : $Moeda;
			
			if($Error[0] == TRUE)
			{
				exit("<div class=\"warning-box\"> Preencha os seguintes campos:<br /><br />{$Error[0]}</div>");
			}
			else
			{
				//$Enable = $_POST["CronTab_Enable"] == TRUE ? 0 : 1;
				//$this->Query("UPDATE dbo.{$CTM[13]} SET CronTab={$CronTab},Cron_Runing={$Enable},Cron_Date={$Cron_Date},Cron_Time='{$Time}',Number={$Number} WHERE Id=".$_GET["id"]);
				$this->Query("UPDATE dbo.{$CTM[13]} SET CronTab={$CronTab},Cron_Time='{$Time}',Coin={$Moeda},Number={$Number} WHERE Id=".$_GET["id"]);
				exit("<div class=\"success-box\"> CronTab Editado com Sucesso.</div>");
			}
		}
		echo("<script type=\"text/javascript\">
				function Check_CronTab()
				{
					var CronTab = document.getElementById('CronTab').value; 
					if(CronTab < 4)
					{
						document.getElementById(\"Number\").disabled = true;
						document.getElementById(\"Moeda\").disabled = true;
					}
					else if(CronTab == 4)
					{
						document.getElementById(\"Number\").disabled = false;
						document.getElementById(\"Moeda\").disabled = false;
					}
				}
				var CronTab = document.getElementById('CronTab').value; 
				if(CronTab < 4)
				{
					document.getElementById(\"Number\").disabled = true;
					document.getElementById(\"Moeda\").disabled = true;
				}
				else if(CronTab == 4)
				{
					document.getElementById(\"Number\").disabled = false;
					document.getElementById(\"Moeda\").disabled = false;
				}
				</script>\n\r");
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[13]}");
		
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[13]} WHERE Id='".$_POST["Id"]."'");
		if($Check < 1)
		{
				exit("<div class=\"error-box\"> Este CronTab n&atilde;o existe.</div>");
		}
		$Query = $this->Query("SELECT * FROM dbo.{$CTM[13]} WHERE Id='".$_POST["Id"]."'");
		$Load = $this->FetchArray($Query);
		
		//$Cron_Date = date("d", $Load["Cron_Date"]);
		//$Cron_Month = date("m", $Load["Cron_Date"]);
		//$Cron_Year = date("Y", $Load["Cron_Date"]);
		$Cron_Time = explode(":", $Load["Cron_Time"]);
		
		$CTM_Template->Set("CronTab_ID", $Load["Id"]);
		$CTM_Template->Set("CronTab_Number", $Load["Number"] == 0 ? NULL : $Load["Number"]);
		$CTM_Template->Set("CronTab_Year", $Cron_Year);
		$CTM_Template->Set("CronTab_Hours", $Cron_Time[0]);
		$CTM_Template->Set("CronTab_Minutes", $Cron_Time[1]);
		$CTM_Template->Set("Check_CronTab#1", $Load["CronTab"] == 1 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_CronTab#2", $Load["CronTab"] == 2 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_CronTab#3", $Load["CronTab"] == 3 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_CronTab#4", $Load["CronTab"] == 4 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Coin#1", $Load["Coin"] == 1 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Coin#2", $Load["Coin"] == 2 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Coin#3", $Load["Coin"] == 3 ? "selected=\"selected\"" : NULL);
		/*$CTM_Template->Set("Check_Day#01", $Cron_Date == 01 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#02", $Cron_Date == 02 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#03", $Cron_Date == 03 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#04", $Cron_Date == 04 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#05", $Cron_Date == 05 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#06", $Cron_Date == 06 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#07", $Cron_Date == 07 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#08", $Cron_Date == 08 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#09", $Cron_Date == 09 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#10", $Cron_Date == 10 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#11", $Cron_Date == 11 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#12", $Cron_Date == 12 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#13", $Cron_Date == 13 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#14", $Cron_Date == 14 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#15", $Cron_Date == 15 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#16", $Cron_Date == 16 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#17", $Cron_Date == 17 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#18", $Cron_Date == 18 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#19", $Cron_Date == 19 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#20", $Cron_Date == 20 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#21", $Cron_Date == 21 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#22", $Cron_Date == 22 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#23", $Cron_Date == 23 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#24", $Cron_Date == 24 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#25", $Cron_Date == 25 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#26", $Cron_Date == 26 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#27", $Cron_Date == 27 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#28", $Cron_Date == 28 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#29", $Cron_Date == 29 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#30", $Cron_Date == 30 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Day#31", $Cron_Date == 31 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Month#01", $Cron_Month == 01 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Month#02", $Cron_Month == 02 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Month#03", $Cron_Month == 03 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Month#04", $Cron_Month == 04 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Month#05", $Cron_Month == 05 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Month#06", $Cron_Month == 06 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Month#07", $Cron_Month == 07 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Month#08", $Cron_Month == 08 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Month#09", $Cron_Month == 09 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Month#10", $Cron_Month == 10 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Month#11", $Cron_Month == 11 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Month#13", $Cron_Month == 12 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Enable", $Load["Cron_Runing"] == 0 ? "checked=\"checked\"" : NULL);*/
	}
	private function Manage_Warning()
	{
		global $CTM_Template, $CTM;
		
		if($_GET["cmd"] == true)
		{
			$Text = base64_encode(str_replace("\\", "", $_POST["Text"]));
			$Date = strtotime("now");
			
			if(empty($Text))
			{
				exit("<div class=\"warning-box\"> Digite a Menssagem!</div>");
			}
			else
			{
				$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[5]}");
				if($Check < 1)
				{
					$this->Query("INSERT INTO dbo.{$CTM[5]} (Date,Account,Text) VALUES ('{$Date}','{$this->Login}','{$Text}')");
					$this->Message = "Adicionado";
				}
				else
				{
					$this->Query("UPDATE dbo.{$CTM[5]} SET Date='{$Date}',Account='{$this->Login}',Text='{$Text}'");
					$this->Message = "Editado";
				}
				exit("<div class=\"success-box\"> Aviso {$this->Message} com Sucesso!</div>");
			}
		}
		$Check = $this->NumQuery("SELECT * FROM {$CTM[5]}");
		if($Check < 1)
		{
			$Button = "Adicionar";
			$Date = strtotime("now");
			$Value = NULL;
		}
		else
		{
			$Load = $this->FetchQuery("SELECT Date,Text FROM dbo.{$CTM[5]}");
			$Button = "Editar";
			$Date = $Load[0];
			$Value = base64_decode($Load[1]);
		}
		$CTM_Template->Set("Button", $Button);
		$CTM_Template->Set("Warning_Date", date("d/m/Y", $Date));
		$CTM_Template->Set("Warning_Time", date("H:i", $Date));
		$CTM_Template->Set("Warning_Value", $Value);
		
	}
	private function Add_News()
	{
		global $CTM_Template, $CTM;
		
		if($_GET["cmd"] == TRUE)
		{
			$Title = base64_encode($_POST["Title"]);
			$Date = strtotime("now");
			$Text = base64_encode(str_replace("\\", "", $_POST["Text"]));
			$Comments = $_POST["Comments_Enable"] == TRUE ? 1 : 0;
			
			if(empty($Title))
			{
				exit("<div class=\"warning-box\"> Digite o titulo da Noticia</div>");
			}
			elseif(empty($Text))
			{
				exit("<div class=\"warning-box\"> Digite a menssagem</div>");
			}
			else
			{
				$this->Query("INSERT INTO dbo.{$CTM[6]} (Title,Date,Account,Text,Comment) VALUES ('{$Title}',{$Date},'{$this->Login}','{$Text}',{$Comments})");
				exit("<div class=\"success-box\"> Noticia <b>".base64_decode($Title)."</b> adicionada com Sucesso</div>");
			}
		}
		$Date = strtotime("now");
		$CTM_Template->Set("Notice_Date", date("d/m/Y", $Date));
		$CTM_Template->Set("Notice_Time", date("H:i", $Date));
	}
	private function List_News()
	{
		global $CTM_Template, $CTM;
		
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[6]}");

		if($_GET["cmd"] == "delete")
		{
			$Check_Delete = $this->NumQuery("SELECT * FROM dbo.{$CTM[6]} WHERE Id='".$_POST["Id"]."'");
			if($Check_Delete)
			{
				exit("<div class=\"error-box\"> Esta noticia n&atilde;o existe.</div>");
			}
			else
			{
				$this->Query("DELETE dbo.{$CTM[6]} WHERE Id='".$_POST["Id"]."'");
				exit("<div class=\"success-box\"> Noticia deletada com Sucesso!</div>");
			}
		}
		if($Check < 1)
	   	{
		   	exit("<div class=\"info-box\"> N&atilde; h&aacute; noticias postadas no momento.</div>");
	   	}
	    else
	   	{
		  	$Query = $this->Query("SELECT Title,Date,Id FROM dbo.{$CTM[6]} ORDER BY Id DESC");
		   	while($Get = $this->Fetch($Query))
		   	{
			   	$Return .= "<option value=\"{$Get[2]}\">".base64_decode($Get[0])." (".date("d/m/Y", $Get[1])." as ".date("H:i", $Get[1]).")</option>\n";
		   	}
			$CTM_Template->Set("Notice_List", $Return);
			unset($Return);
		}
	}
	private function Manage_News()
	{
		global $CTM_Template, $CTM;
		
		if($_GET["cmd"] == TRUE)
		{
			$Id = $_POST["Id"];
			$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[6]} WHERE Id='{$Id}'");
			if($Check < 1)
			{
				exit("<div class=\"error-box\"> Esta noticia n&atilde;o existe</div>");
			}
			else
			{
				$this->Query("DELETE dbo.{$CTM[6]} WHERE Id='{$Id}'");
				exit("<div class=\"success-box\"> Noticia removida com Sucesso!</div>");
			}
		}
		if($_GET["exec"] == TRUE)
		{
			$Id = $_GET["id"];
			$Title = base64_encode($_POST["Title"]);
			$Date = strtotime("now");
			$Text = base64_encode(str_replace("\\", "", $_POST["Text"]));
			$Comments = $_POST["Comments_Enable"] == TRUE ? 1 : 0;
			
			if(empty($Title))
			{
				exit("<div class=\"warning-box\"> Digite o titulo da Noticia</div>");
			}
			elseif(empty($Text))
			{
				exit("<div class=\"warning-box\"> Digite a menssagem</div>");
			}
			else
			{
				$this->Query("UPDATE dbo.{$CTM[6]} SET Title='{$Title}',Text='{$Text}',Comment={$Comments} WHERE id='{$Id}'");
				if($_POST["Update_Date"] == TRUE)
				{
					$this->Query("UPDATE dbo.{$CTM[6]} SET Date='{$Date}' WHERE Id='{$Id}'");
				}
				exit("<div class=\"success-box\"> Noticia editada com Sucesso!</div>");
			}
		}
		$Id = $_POST["Id"];
		$Query = $this->Query("SELECT Title,Date,Account,Text,Comment FROM dbo.{$CTM[6]} WHERE Id='{$Id}'");
		$Check = $this->NumRow($Query);

		if($Check < 1)
		{
			exit("<div class=\"error-box\"> Esta noticia n&atilde;o existe</div>");
		}
		$Load = $this->Fetch($Query);
		$Character = $this->FetchQuery("SELECT name FROM dbo.{$CTM[0]} WHERE account='{$Load[2]}'");
		
		$CTM_Template->Set("Notice_Title", base64_decode($Load[0]));
		$CTM_Template->Set("Notice_Date", date("d/m/Y", $Load[1]));
		$CTM_Template->Set("Notice_Time", date("H:i", $Load[1]));
		$CTM_Template->Set("Notice_Char", $Character[0]);
		$CTM_Template->Set("Notice_Text", base64_decode($Load[3]));
		$CTM_Template->Set("Notice_Comments", $Load[4] == 1 ? "checked=\"checked\"" : NULL);
		$CTM_Template->Set("Notice_ID", $Id);
	}
	private function Manage_ScreenShots()
	{
		global $CTM_Template, $CTM;
		
		$Find_Screens = $this->Query("SELECT * FROM dbo.{$CTM[20]} ORDER BY Votes DESC, Id DESC");
		$Check = $this->NumRow($Find_Screens);
		
		if($Check < 1)
		{
			exit("<div class=\"info-box\"> Nenhuma ScreenShot cadastrada no momento.</div>");
		}
		while($ScreenShot = $this->FetchArray($Find_Screens))
		{
			$Text = $ScreenShot["Votes"] > 0 ? "Votos" : "Voto";
			
			if($WzAG == 0)
			{
				$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
						<tr>\n";
			}
				
			$Return .= "<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
						<tr>
							<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=paneladmin&str=MANAGE_SCREENSHOTS&cmd=true&id=".$ScreenShot["Id"]."', 'Command', 'GET');\" style=\"color: #666666;\">Autor: ".$ScreenShot["User_Char"]." <img src=\"".constant("Upload_SS").$ScreenShot["ScreenShot"]."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$ScreenShot["Votes"]." ".$Text.")</a></td>
						</tr>
			</table></td>";
			$WzAG++;
			if($WzAG > 2)
			{
				$Return .= "
							</tr>
					</table>";
				$WzAG = 0;
			}
		}
		if($_GET["cmd"] == TRUE)
		{
			$Id = $_GET["id"];
			$Find_File = $this->FetchQuery("SELECT ScreenShot FROM dbo.{$CTM[20]} WHERE Id = '{$Id}'");
			
			$CTM_ScreenShots = new CTM_ScreenShots();
			$CTM_ScreenShots->Variable_1 = $Id;
			$CTM_ScreenShots->Variable_2 = $Find_File[0];
			$CTM_ScreenShots->Variable_3 = FALSE;
			$CTM_ScreenShots->Delete_ScreenShot();
			
			exit("<div class=\"success-box\"> ScreenShot deletada com Sucesso!</div>");
		}
		else
		{
			$CTM_Template->Set("%ScreenShot_List%", $Return);
		}
		unset($Return);
	}
	private function Add_File()
	{
		global $CTM;
		
		if($_GET["cmd"] == TRUE)
		{
			$Name = $_POST["Name"];
			$Link = $_POST["Link"];
			$Description = base64_encode($_POST["Description"]);
			$File_Size = $_POST["File_Size"];
			
			if(empty($Name) || empty($Link) || empty($Description) || empty($File_Size))
			{
				exit("<div class=\"warning-box\"> Preencha todo os Campos.</div>");
			}
			else
			{
				$this->Query("INSERT INTO dbo.{$CTM[2]} (name,link,description,file_size) VALUES ('{$Name}','{$Link}','{$Description}','{$File_Size}')");
				exit("<div class=\"success-box\"> Arquivo <b>{$Name}</b> adicionado com Sucesso!</div>");
			}
		}
	}
	private function File_List()
	{
		global $CTM_Template, $CTM;
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[2]}");
		
		if($Check < 1)
	   	{
		   	exit("<div class=\"info-box\"> N&atilde; h&aacute; arquivos cadastrados no momento.</div>");
	   	}
		else
		{
			 $Query = $this->Query("SELECT name,id FROM dbo.{$CTM[2]} ORDER BY id DESC");
			 while($Get = $this->Fetch($Query))
		   	 {
			   	 $Return .= "<option value=\"{$Get[1]}\">".$Get[0]."</option>\n";
		   	 }
			 $CTM_Template->Set("File_List", $Return);
			 unset($Return);
		}
	}
	private function Manage_File()
	{
		global $CTM_Template, $CTM;
		
		if($_GET["cmd"] == TRUE)
		{
			$Id = $_POST["Id"];
			$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[2]} WHERE id='{$Id}'");
			if($Check < 1)
			{
				exit("<div class=\"error-box\"> Este arquivo n&atilde;o existe.</div>");
			}
			else
			{
				$this->Query("DELETE dbo.{$CTM[2]} WHERE id='{$Id}'");
				exit("<div class=\"success-box\"> Arquivo deletado com Sucesso!</div>");
			}
		}
		if($_GET["exec"] == TRUE)
		{
			$Id = $_GET["id"];
			$Name = $_POST["Name"];
			$Link = $_POST["Link"];
			$Description = base64_encode($_POST["Description"]);
			$File_Size = $_POST["File_Size"];
			
			if(empty($Name) || empty($Link) || empty($Description) || empty($File_Size))
			{
				exit("<div class=\"warning-box\"> Preencha todo os Campos.</div>");
			}
			else
			{
				$this->Query("UPDATE dbo.{$CTM[2]} SET name='{$Name}',link='{$Link}',description='{$Description}',file_size='{$File_Size}' WHERE id='{$Id}'");
				exit("<div class=\"success-box\"> Arquivo editado com Sucesso!</div>");
			}
		}
		$Id = $_POST["Id"];
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[2]} WHERE id='{$Id}'");

		if($Check < 1)
		{
			exit("<div class=\"error-box\"> Este arquivo n&atilde;o existe.</div>");
		}

		$Query = $this->Query("SELECT * FROM dbo.{$CTM[2]} WHERE id='{$Id}'");
		$Load = $this->FetchArray($Query);
		
		$CTM_Template->Set("File_Name", $Load["name"]);
		$CTM_Template->Set("File_Link", $Load["link"]);
		$CTM_Template->Set("File_Desc", base64_decode($Load["description"]));
		$CTM_Template->Set("File_Size", $Load["file_size"]);
		$CTM_Template->Set("File_ID", $Id);
	}
	private function Add_Member()
	{
		global $CTM;
		
		if($_GET["cmd"] == TRUE)
		{
			$Account = $_POST["Account"];
			$Name = $_POST["Name"];
			$Contact = $_POST["Contact"];
			$Type = $_POST["Type"];
			$Check[0] = $this->NumQuery("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}'");
			$Check[1] = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Name}'");
			
			if(empty($Account) || empty($Name)/* || empty($Contact)*/)
			{
				exit("<div class=\"warning-box\"> Preencha todos o Campos</div>");
			}
			elseif($Check[0] < 1)
			{
				exit("<div class=\"error-box\"> Est&aacute; conta n&atilde;o existe.</div>");
			}
			elseif($Check[1] < 1)
			{
				exit("<div class=\"error-box\"> Este personagem n&atilde;o existe.</div>");
			}
			else
			{
				$this->Query("INSERT INTO dbo.{$CTM[0]} (account,name,type,contact) VALUES ('{$Account}','{$Name}',{$Type},'{$Contact}')");
				exit("<div class=\"success-box\"> Membro <b>{$Name}</b> adicionado com sucesso!</div>");
			}
		}
	}
	private function List_Members()
	{
		global $CTM_Template, $CTM;
		
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[0]}");
		
		if($Check < 1)
	   	{
		   	exit("<div class=\"info-box\"> N&atilde;o h&aacute; membros da equipe cadastrados.</div>");
	   	}
		$Query = $this->Query("SELECT name,id,type FROM dbo.{$CTM[0]} ORDER BY Id DESC");
		while($Get = $this->Fetch($Query))
		{
			switch($Get[2])
			{
				case 1 : $type = "Game Master"; break;
				case 2 : $type = "Sub-Administrador"; break;
				case 3 : $type = "Administrador"; break;
			}
			$Return .= "<option value=\"{$Get[1]}\">".$Get[0]." - {$type}</option>\n";
		}
		$CTM_Template->Set("Members_List", $Return);
		unset($Return);
	}
	private function Manage_Member()
	{
		global $CTM_Template, $CTM, $_PanelAdmin;
		
		if($_GET["cmd"] == TRUE)
		{
			for($WzAG = 0; $WzAG < count($_PanelAdmin["General"]["Master"]); $WzAG++)
			{
				$Master = $_PanelAdmin["General"]["Master"][$WzAG];
			}
			$Id = $_POST["Id"];
			$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[0]} WHERE Id='{$Id}'");
			$Type = $this->FetchQuery("SELECT type FROM dbo.{$CTM[0]} WHERE id='{$Id}'");
			if($Check < 1)
			{
				exit("<div class=\"error-box\"> Este membro n&atilde;o existe.</div>");
			}
			elseif($this->Login != $Master && $Type[0] == 3)
			{
				exit("<div class=\"info-box\"> Voc&ecirc; n&atilde;o pode deletar 1 Administrador</div>");
			}
			else
			{
				$this->Query("DELETE dbo.{$CTM[0]} WHERE id='{$Id}'");
				exit("<div class=\"success-box\"> Membro deletado com Sucesso!</div>");
			}
		}
		
		if($_GET["exec"] == TRUE)
		{
			$Id = $_GET["id"];
			$Account = $_POST["Account"];
			$Name = $_POST["Name"];
			$Contact = $_POST["Contact"];
			$Type = $_POST["Type"];
			$Check[0] = $this->NumQuery("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}'");
			$Check[1] = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Name}'");

			
			if(empty($Account) || empty($Name) || empty($Contact))
			{
				exit("<div class=\"warning-box\"> Preencha todos o Campos</div>");
			}
			elseif($Check[0] < 1)
			{
				exit("<div class=\"error-box\"> Est&aacute; conta n&atilde;o existe.</div>");
			}
			elseif($Check[1] < 1)
			{
				exit("<div class=\"error-box\"> Este personagem n&atilde;o existe.</div>");
			}
			else
			{
				$this->Query("UPDATE dbo.{$CTM[0]} SET account='{$Account}',name='{$Name}',type={$Type},contact='{$Contact}' WHERE id='{$Id}'");
				exit("<div class=\"success-box\"> Membro editado com sucesso!</div>");
			}
		}
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[0]} WHERE id=".$_POST["Id"]);

		if($Check < 1)
		{
			exit("<div class=\"error-box\"> Este membro n&atilde;o existe.</div>");
		}

		$Query = $this->Query("SELECT * FROM dbo.{$CTM[0]} WHERE id=".$_POST["Id"]);
		$Load = $this->FetchArray($Query);

		if(in_array($_SESSION["Hash_Account"], $_PanelAdmin["General"]["Master"]) == false && $Load["type"] == 3)
		{
			exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o pode editar 1 Administrador</div>");
		}
		
		$CTM_Template->Set("Member_Account", $Load["account"]);
		$CTM_Template->Set("Member_Name", $Load["name"]);
		$CTM_Template->Set("Member_Contact", $Load["contact"]);
		$CTM_Template->Set("Member_ID", $_POST["Id"]);
		$CTM_Template->Set("Check_Type#1", $Load["type"] == 1 ? "selected=\"selected\" " : NULL);
		$CTM_Template->Set("Check_Type#2", $Load["type"] == 2 ? "selected=\"selected\" " : NULL);
		$CTM_Template->Set("Check_Type#3", $Load["type"] == 3 ? "selected=\"selected\" " : NULL);
	}
	private function Add_Poll()
	{
		global $CTM_Template, $CTM;
		
		if($_GET["cmd"] == TRUE)
		{
			$Question = base64_encode($_POST["Question"]);
			$Expiration = mktime($_POST["Exp_Hour"], $_POST["Exp_Minute"], 0, 
			$_POST["Exp_Month"], $_POST["Exp_Day"], $_POST["Exp_Year"]);

			for($WzAG = 0; $WzAG <= $_GET["num"]; $WzAG++)
			{
				$String_ID = $WzAG+1;
				if(empty($_POST["Answer_".$WzAG]))
				{
					exit("<div class=\"warning-box\"> Preencha todos os Campos.</div>");
				}
			}
			
			if(empty($Question) || 
			$_POST["Exp_Hour"] == NULL ||
			$_POST["Exp_Minute"] == NULL ||
			empty($_POST["Exp_Day"]) ||
			empty($_POST["Exp_Month"]) || 
			empty($_POST["Exp_Year"]))
			{
				exit("<div class=\"warning-box\"> Preencha todos os Campos.</div>");
			}
			else
			{
				$this->Query("INSERT INTO dbo.{$CTM[15]} (Question,Time_,Expiration,Status) VALUES 
				('{$Question}',".time().",{$Expiration},0xFFFF)");
				$Find_ID = $this->FetchQuery("SELECT Id=@@IDENTITY FROM dbo.{$CTM[15]} ORDER BY Id DESC");
				
				for($WzAG = 0; $WzAG <= $_GET["num"]; $WzAG++)
				{
					$this->Query("INSERT INTO dbo.{$CTM[16]} (Poll_ID,Answer,Votes) VALUES
					(".$Find_ID[0].",'".base64_encode($_POST["Answer_".$WzAG])."',0)");
				}
				exit("<div class=\"success-box\"> Enquete adicionada com Sucesso!</div>");
			}
		}
		if(empty($_POST["Answer_Number"]))
		{
			exit("<div class=\"warning-box\"> Preencha o numero de respostas.</div>");
		}
		for($WzAG = 0; $WzAG <= $_POST["Answer_Number"]; $WzAG++)
		{
			$Answer_Input .= "<tr>
    <td width=\"181\">Resposta ".$WzAG.":</td>
    <td width=\"226\"><input type=\"text\" name=\"Answer_".$WzAG."\" id=\"Answer_".$WzAG."\" /></td>
  </tr>";
		}
		$CTM_Template->Set("%Numbers%", $_POST["Answer_Number"]);
		$CTM_Template->Set("%Answer_Values%", $Answer_Input);
		unset($Answer_Input);
	}
	private function Load_Poll()
	{
		global $CTM_Template, $CTM;
		
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[15]}");
		
		if($Check < 1)
		{
			exit("<div class=\"info-box\"> N&atilde;o h&aacute; enquetes cadastradas no momento.</div>");
		}
		else
		{
			$Find_Poll = $this->Query("SELECT Question,Id FROM dbo.{$CTM[15]} ORDER BY Id DESC");
			
			while($Value = $this->Fetch($Find_Poll))
			{
				$Poll_Input .= "<option value=\"".$Value[1]."\">".base64_decode($Value[0])."</option>";
			}
			$CTM_Template->Set("%Poll_List%", $Poll_Input);
			unset($Poll_Input);
		}
	}
	private function Manage_Poll()
	{
		global $CTM_Template, $CTM;
		
		if($_GET["cmd"] == TRUE)
		{
			$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[15]} WHERE Id='".$_POST["Id"]."'");
			
			if(empty($_POST["Id"]))
			{
				exit("<div class=\"warning-box\"> Selecione a Enquete.</div>");
			}
			elseif($Check < 1)
			{
				exit("<div class=\"error-box\"> Esta enquete n&atilde;o existe!</div>");
			}
			else
			{
				$this->Query("DELETE FROM dbo.{$CTM[15]} WHERE Id='".$_POST["Id"]."'");
				$this->Query("DELETE FROM dbo.{$CTM[16]} WHERE Poll_ID='".$_POST["Id"]."'");
				$this->Query("DELETE FROM dbo.{$CTM[17]} WHERE Poll_ID='".$_POST["Id"]."'");
				exit("<div class=\"success-box\"> Enquete deletada com Sucesso!");
			}
		}
		if($_GET["exec"] == TRUE)
		{
			$Id = $_GET["id"];
			$Question = base64_encode($_POST["Question"]);
			$Expiration = mktime($_POST["Exp_Hour"], $_POST["Exp_Minute"], 0, 
			$_POST["Exp_Month"], $_POST["Exp_Day"], $_POST["Exp_Year"]);
			$Status = $_POST["Status"];
			
			if(
			empty($Question) || 
			$_POST["Exp_Hour"] == NULL ||
			$_POST["Exp_Minute"] == NULL ||
			empty($_POST["Exp_Day"]) ||
			empty($_POST["Exp_Month"]) || 
			empty($_POST["Exp_Year"]))
			{
				exit("<div class=\"warning-box\"> Preencha todos os Campos.</div>");
			}
			else
			{
				$Status = $Status == TRUE ? "0xFFFF" : "0x01E2";
				$this->Query("UPDATE dbo.{$CTM[15]} SET Question='{$Question}',Expiration='{$Expiration}',Status={$Status}
				WHERE Id='{$Id}'");
				
				for($WzAG = 0; $WzAG <= $_GET["num"]; $WzAG++)
				{
					$this->Query("UPDATE dbo.{$CTM[16]} SET Answer='".base64_encode($_POST["Answer_".$WzAG])."' 
					WHERE Id='".$_POST["IdAnswer_".$WzAG]."'");
				}
				exit("<div class=\"success-box\"> Enquete editada com Sucesso!</div>");
			}
		}
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[15]} WHERE Id='".$_POST["Id"]."'");
		$Query[0] = $this->Query("SELECT Question,Expiration,Status FROM dbo.{$CTM[15]} WHERE Id='".$_POST["Id"]."'");
		$Query[1] = $this->Query("SELECT Answer,Id FROM dbo.{$CTM[16]} WHERE Poll_ID='".$_POST["Id"]."'");
		$Count = $this->NumQuery("SELECT * FROM dbo.{$CTM[16]} WHERE Poll_ID='".$_POST["Id"]."'");
		$Poll = $this->FetchArray($Query[0]);
		
		if(empty($_POST["Id"]))
		{
			exit("<div class=\"warning-box\"> Selecione a Enquete.</div>");
		}
		elseif($Check < 1)
		{
			exit("<div class=\"error-box\"> Esta enquete n&atilde;o existe!</div>");
		}
		$Exp_Hour = date("H", $Poll[1]);
		$Exp_Minute = date("i", $Poll[1]);
		$Exp_Day = date("d", $Poll[1]);
		$Exp_Month = date("m", $Poll[1]);
		$Exp_Year = date("Y", $Poll[1]);
		
		$CTM_Template->Set("Poll_Question", base64_decode($Poll["Question"]));
		$CTM_Template->Set("Poll_Exp#Hour", $Exp_Hour);
		$CTM_Template->Set("Poll_Exp#Minute", $Exp_Minute);
		$CTM_Template->Set("Poll_Exp#Day", $Exp_Day);
		$CTM_Template->Set("Poll_Exp#Month", $Exp_Month);
		$CTM_Template->Set("Poll_Exp#Year", $Exp_Year);

		for($WzAG = 0; $WzAG < $this->NumRow($Query[1]); $WzAG++)
		{
			$Answer = $this->FetchArray($Query[1]);
			$Answer_Input .= "<tr>
    <td width=\"181\">Resposta ".$WzAG.":</td>
    <td width=\"226\"><input type=\"hidden\" name=\"IdAnswer_".$WzAG."\" id=\"IdAnswer_".$WzAG."\" value=\"".$Answer[1]."\" />
	<input type=\"text\" name=\"Answer_".$WzAG."\" id=\"Answer_".$WzAG."\" value=\"".base64_decode($Answer[0])."\" /></td>
  </tr>";
		}
		$CTM_Template->Set("Poll_Status", strtoupper(bin2hex($Poll[2])) == "FFFF" ? "checked=\"checked\"" : NULL);
		$CTM_Template->Set("Poll_ID", $_POST["Id"]);
		$CTM_Template->Set("%Answer_Values%", $Answer_Input);
		$CTM_Template->Set("%Numbers%", $Count);
		unset($Answer_Input);
	}
	private function Manage_Account()
	{
		global $CTM_Template;
		
		if($_GET["cmd"] == TRUE)
		{
			$Account = pack("H*", base64_decode($_GET["id"]));
			$Name = $_POST["Name"];
			$Mail = $_POST["Mail"];
			$Question = $_POST["Question"];
			$Answer = $_POST["Answer"];
			$Phone = $_POST["Phone"];
			$Type = $_POST["Type"];
			$Block = $_POST["Block"];
			$Coin_1 = $_POST["Coin_1"];
			$Coin_2 = $_POST["Coin_2"];
			$Coin_3 = $_POST["Coin_3"];
			
			if(empty($Coin_1)) $Coin_1 = 0;
			if(empty($Coin_2)) $Coin_2 = 0;
			if(empty($Coin_3)) $Coin_3 = 0;
			if(
			empty($Name) || 
			empty($Mail) || 
			empty($Question) || 
			empty($Answer) || 
			empty($Phone))
			{
				exit("<div class=\"warning-box\"> Preencha todos os Campos.</div>");
			}
			elseif(preg_match("/(.*?)@(.*?)\..([com|net|org])/i", $Mail) == FALSE)
			{
				exit("<div class=\"error-box\"> E-Mail invalido.</div>");
			}
			else
			{
				$Block = $Block == TRUE ? 1 : 0;
				$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET memb_name='{$Name}',mail_addr='{$Mail}',
				tel__numb='{$Phone}',fpas_ques='{$Question}',fpas_answ='{$Answer}',bloc_code='{$Block}'
				WHERE memb___id='{$Account}'");
				$this->Query("UPDATE ".VIP_DB.".dbo.".VIP_Table." SET ".VIP_Column."='{$Type}'
				WHERE ".VIP_Login."='{$Account}'");
				$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET 
				".GL_Column_1."='{$Coin_1}',".GL_Column_2."='{$Coin_2}',".GL_Column_3."='{$Coin_3}'
				WHERE ".GL_Login."='{$Account}'");
				
				exit("<div class=\"success-box\"> Conta editada com Sucesso!</div>");
			}
		}
		$Account = $_POST["Account"];
		$Search = $_POST["Search"];
		
		switch($Search)
		{
			case 1 :
			$Check_Exists = $this->NumQuery("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}'");
			$Find_Account = $this->FetchQuery("SELECT memb___id,memb_name,mail_addr,fpas_ques,fpas_answ,tel__numb,bloc_code
			FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}'");
			$Check_Message = "Esta conta n&atilde;o existe.";
			$Set_Account = $Account;
			break;
			case 2 :
			$Check_Exists = $this->NumQuery("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE mail_addr='{$Account}'");
			$Find_Account = $this->FetchQuery("SELECT memb___id,memb_name,mail_addr,fpas_ques,fpas_answ,tel__numb,bloc_code
			FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE mail_addr='{$Account}'");
			$Check_Message = "Nenhuma conta encontrada com este E-Mail.";
			$Set_Account = $Find_Account[0];
			break;
			case 3 :
			$Check_Exists = $this->NumQuery("SELECT memb___id FROM ".MuAcc_DB.".dbo.MEMB_STAT 
			WHERE IP='{$Account}' ORDER BY ConnectTM");
			$Find_ByAddr = $this->FetchQuery("SELECT memb___id FROM ".MuAcc_DB.".dbo.MEMB_STAT 
			WHERE IP='{$Account}' ORDER BY ConnectTM");
			$Find_Account = $this->FetchQuery("SELECT memb___id,memb_name,mail_addr,fpas_ques,fpas_answ,tel__numb,bloc_code
			FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Find_ByAddr[0]}'");
			$Check_Message = "Nenhuma conta encontrada com este IP.";
			$Set_Account = $Find_ByAddr[0];
			break;
			case 4 :
			$Check_Exists = $this->NumQuery("SELECT AccountID FROM ".MuGen_DB.".dbo.Character 
			WHERE Name='{$Account}'");
			$Find_ByChar = $this->FetchQuery("SELECT AccountID FROM ".MuGen_DB.".dbo.Character 
			WHERE Name='{$Account}'");
			$Find_Account = $this->FetchQuery("SELECT memb___id,memb_name,mail_addr,fpas_ques,fpas_answ,tel__numb,bloc_code
			FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Find_ByChar[0]}'");
			$Check_Message = "Nenhuma conta encontrada com este personagem.";
			$Set_Account = $Find_ByChar[0];
			break;
		}
		
		$Find_VIP = $this->FetchQuery("SELECT ".VIP_Column." FROM ".VIP_DB.".dbo.".VIP_Table."
		WHERE ".VIP_Login."='{$Set_Account}'");
		$Find_Coin = $this->FetchQuery("SELECT ".GL_Column_1.",".GL_Column_2.",".GL_Column_3."
		FROM ".GL_DB.".dbo.".GL_Table." WHERE ".GL_Login."='{$Set_Account}'");
		
		if(empty($Account))
		{
			exit("<div class=\"warning-box\"> Digite a conta.</div>");
		}
		elseif($Check_Exists < 1)
		{
			exit("<div class=\"error-box\"> {$Check_Message}</div>");
		}
		else
		{
			$CTM_Template->Set("Account_ID", $Find_Account[0]);
			$CTM_Template->Set("Account_Name", $Find_Account[1]);
			$CTM_Template->Set("Account_Mail", $Find_Account[2]);
			$CTM_Template->Set("Account_Question", $Find_Account[3]);
			$CTM_Template->Set("Account_Answer", $Find_Account[4]);
			$CTM_Template->Set("Account_Phone", $Find_Account[5]);
			$CTM_Template->Set("Account_Block", $Find_Account[6] == 1 ? " checked=\"checked\"" : NULL);
			$CTM_Template->Set("Account_Type[0]", $Find_VIP[0] == 0 ? " selected=\"selected=\"" : NULL);
			$CTM_Template->Set("Account_Type[1]", $Find_VIP[0] == 1 ? " selected=\"selected=\"" : NULL);
			$CTM_Template->Set("Account_Type[2]", $Find_VIP[0] == 2 ? " selected=\"selected=\"" : NULL);
			$CTM_Template->Set("Account_Type[3]", $Find_VIP[0] == 3 ? " selected=\"selected=\"" : NULL);
			$CTM_Template->Set("Account_Type[4]", $Find_VIP[0] == 4 ? " selected=\"selected=\"" : NULL);
			$CTM_Template->Set("Account_Type[5]", $Find_VIP[0] == 5 ? " selected=\"selected=\"" : NULL);
			$CTM_Template->Set("Account_Coin[1]", $Find_Coin[0]);
			$CTM_Template->Set("Account_Coin[2]", $Find_Coin[1]);
			$CTM_Template->Set("Account_Coin[3]", $Find_Coin[2]);
			$CTM_Template->Set("%ACCOUNT_VALUE%", base64_encode(bin2hex($Find_Account[0])));
		}
	}
	private function Ban_Acc()
	{
		global $CTM, $_PanelAdmin, $_Mailer;
		
		if($_GET["cmd"] == TRUE)
		{
			$Account = $_POST["Account"];
			$Time = $_POST["Time"];
			$Reason = base64_encode($_POST["Reason"]);
			$Check[0] = $this->NumQuery("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}'");
			$Check[1] = $this->FetchQuery("SELECT bloc_code,memb_name,mail_addr FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}'");
			
			if(empty($Account) || empty($Time) || empty($Reason))
			{
				exit("<div class=\"warning-box\"> Preencha todos os Campos</div>");
			}
			elseif($Check[0] < 1)
			{
				exit("<div class=\"error-box\"> Esta conta n&atilde;o existe.</div>");
			}
			elseif($Check[1][0] == 1)
			{
				exit("<div class=\"error-box\"> Esta conta se encontra Banida</div>");
			}
			else
			{
				$Str_Time = strtotime("+ {$Time} days");
				$Date = date("d/m/Y", $Str_Time);
				$Hour = date("H:i", $Str_Time);
				/****************************** Send Mail *******************************/
				if($_PanelAdmin["Accounts"]["Ban"]["Send_Mail"] === TRUE)
				{
					$Message .= "Ol&aacute; <strong>".$Check[1][1]."</strong>!<br /><br />";
					$Message .= "Voc&ecirc; cometeu um ato foras das regras do servidor,";
					$Message .= "<br />Devido a este motivo sua conta esta banida, informa&ccedil;&otilde;es:<br /><br />";
					$Message .= "<strong>Login:</strong> ".$Account."<br />";
					$Message .= "<strong>Motivo:</strong> ".utf8_decode(base64_decode($Reason))."<br />";
					$Message .= "<strong>Tempo:</strong> ".$Time." Dias<br />";
					$Message .= "<strong>Expira&ccedil;&atilde;o:</strong> ".$Date." as ".$Hour."<br />";
					$Message .= "<br />";
					$Message .= "N&atilde;o cometa o mesmo erro novamente.<br />";
					$Message .= "Caso tenha sido banido injustamente entre em contato.<br /><br />";
				
					$CTM_Mailer = new CTM_Mailer();
					$CTM_Mailer->SMTP_Server = $_Mailer["SMTP"]["Server"];
					$CTM_Mailer->SMTP_Port = $_Mailer["SMTP"]["Port"];
					$CTM_Mailer->SMTP_User = $_Mailer["SMTP"]["User"];
					$CTM_Mailer->SMTP_Pass = $_Mailer["SMTP"]["Pass"];
					$CTM_Mailer->Mail_From = $_Mailer["SMTP"]["Mail"];
					$CTM_Mailer->SMTP_Debug = $_Mailer["SMTP"]["Debug"];
					$CTM_Mailer->Mail_To = $Check[1][2];
					$CTM_Mailer->Mail_Sender = "Suporte ".constant("Server_Name");
					$CTM_Mailer->Mail_Recipient = $Check[1][1];
					$CTM_Mailer->Mail_Subject = utf8_decode("Sua conta foi banida - ".constant("Server_Name"));
					$CTM_Mailer->Mail_Message = $Message;
				
					if($CTM_Mailer->Send_Mail() == FALSE)
					{
						exit("<div class=\"error-box\"> Erro ao enviar o E-Mail!</div>");
					}
					else
					{
						$Character = $this->FetchQuery("SELECT name FROM dbo.{$CTM[0]} WHERE account='".$this->Login."'");
						
						$this->Query("INSERT INTO dbo.{$CTM[7]} (Account,Responsible,Reason,Time) VALUES ('{$Account}','{$Character[0]}','{$Reason}',{$Str_Time})");
						$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET bloc_code=1 WHERE memb___id='{$Account}'");
						unset($Message);
						exit("<div class=\"success-box\"> Conta <b>{$Account}</b> banida por <b>{$Time} dias</b> com Sucesso!</div>");
					}
				}
				else
				{
					$Character = $this->FetchQuery("SELECT name FROM dbo.{$CTM[0]} WHERE account='".$this->Login."'");
					
					$this->Query("INSERT INTO dbo.{$CTM[7]} (Account,Responsible,Reason,Time) VALUES ('{$Account}','{$Character[0]}','{$Reason}',{$Str_Time})");
					$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET bloc_code=1 WHERE memb___id='{$Account}'");
					exit("<div class=\"success-box\"> Conta <b>{$Account}</b> banida por <b>{$Time} dias</b> com Sucesso!</div>");
				}
			}
		}
	}
	private function Unban_Acc()
	{
		global $CTM_Template, $CTM;
		
		if($_GET["cmd"] == TRUE)
		{
			$Account = $_POST["Account"];
			$Check = $this->FetchQuery("SELECT bloc_code FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}'");
			
			if(empty($Account))
			{
				exit("<div class=\"warning-box\"> Selecione a conta</div>");
			}
			elseif($Check[0] == 0)
			{
				exit("<div class=\"error-box\"> Esta conta n&atilde;o esta banida</div>");
			}
			else
			{
				$this->Query("DELETE dbo.{$CTM[7]} WHERE Account='{$Account}'");
				$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET bloc_code=0 WHERE memb___id='{$Account}'");
				exit("<div class=\"success-box\"> Conta <b>{$Account}</b> desbanida com Sucesso!</div>");
			}
		}
		$Check = $this->FetchQuery("SELECT count(*) FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE bloc_code=1");

		if($Check[0] < 1)
		{
			exit("<div class=\"info-box\"> N&atilde;o h&aacute; contas banidas no momento.</div>");
		}

		$Query = $this->Query("SELECT memb___id,memb_name FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE bloc_code=1");
		
		while($Load = $this->Fetch($Query))
		{
			$Return .= "<option value=\"{$Load[0]}\">{$Load[0]} - ({$Load[1]})</option>\n";
		}
		$CTM_Template->Set("Accounts_Banned", $Return);
		unset($Return);
	}
	private function Delete_Account()
	{
		global $CTM, $_Ranking;
		
		if($_GET["cmd"] == TRUE)
		{
			$Account = $_POST["Account"];
			$Search = $_POST["Search"];
			
			switch($Search)
			{
				case 1 :
				$Check_Exists = $this->NumQuery("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}'");
				$Check_Message = "Esta conta n&atilde;o existe.";
				$Account = $Account;
				break;
				case 2 :
				$Check_Exists = $this->NumQuery("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE mail_addr='{$Account}'");
				$Find_Account = $this->FetchQuery("SELECT memb___id FROM ".MuAcc_DB.".dbo.MEMB_INFO 
				WHERE mail_addr='{$Account}'");
				$Check_Message = "Nenhuma conta encontrada com este E-Mail.";
				$Account = $Find_Account[0];
				break;
				case 3 :
				$Check_Exists = $this->NumQuery("SELECT memb___id FROM ".MuAcc_DB.".dbo.MEMB_STAT 
				WHERE IP='{$Account}' ORDER BY ConnectTM");
				$Find_ByAddr = $this->FetchQuery("SELECT memb___id FROM ".MuAcc_DB.".dbo.MEMB_STAT 
				WHERE IP='{$Account}' ORDER BY ConnectTM");
				$Check_Message = "Nenhuma conta encontrada com este IP.";
				$Account = $Find_ByAddr[0];
				break;
				case 4 :
				$Check_Exists = $this->NumQuery("SELECT AccountID FROM ".MuGen_DB.".dbo.Character 
				WHERE Name='{$Account}'");
				$Find_ByChar = $this->FetchQuery("SELECT AccountID FROM ".MuGen_DB.".dbo.Character 
				WHERE Name='{$Account}'");
				$Check_Message = "Nenhuma conta encontrada com este personagem.";
				$Account = $Find_ByChar[0];
				break;
			}
			
			if(empty($_POST["Account"]))
			{
				exit("<div class=\"warning-box\"> Digite a conta.</div>");
			}
			elseif($Check_Exists < 1)
			{
				exit("<div class=\"error-box\"> {$Check_Message}</div>");
			}
			else
			{
				$Check_Chars = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE AccountID='{$Account}'");
				
				if($Check_Chars > 0)
				{
					$Chars_Query = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE AccountID='{$Account}'");
					
					while($Find_Chars = $this->FetchArray($Chars_Query))
					{
						$Character = $Find_Chars["Name"];
						$this->Query("DELETE ".MuGen_DB.".dbo.GuildMember WHERE Name='{$Character}'");
						
						$Find_Guild = $this->FetchQuery("SELECT G_Name FROM ".MuGen_DB.".dbo.Guild WHERE G_Master='{$Character}'");
						$this->Query("DELETE ".MuGen_DB.".dbo.Guild WHERE G_Master='{$Character}'");
						$this->Query("DELETE ".MuGen_DB.".dbo.GuildMember WHERE G_Name='{$Find_Guild[0]}'");
						
						if(GS_Version > 1)
						{
							$this->Query("DELETE ".MuGen_DB.".dbo.T_CGuid WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.T_FriendMain WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.T_FriendMail WHERE FriendName='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.T_FriendList WHERE FriendName='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.T_WaitFriend WHERE FriendName='{$Character}'");
						}
						if(@Server_Files == 0)
						{
							$this->Query("DELETE ".MuGen_DB.".dbo.OptionData WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.T_MasterLevelSystem WHERE CHAR_NAME='{$Character}'");
							if($_Ranking["Gens"]["Enable"] === TRUE)
							{
								$this->Query("DELETE ".MuGen_DB.".dbo.T_GensSystem WHERE CHAR_NAME='{$Character}'");
							}
						}
						if(@Server_Files == 1)
						{
							$this->Query("DELETE ".MuGen_DB.".dbo.OptionData WHERE Name='{$Character}'");
						}
						if(@Server_Files == 2)
						{
							$this->Query("DELETE ".MuGen_DB.".dbo.OptionData WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.QuestWorld WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.QuestKillCount WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.RankingBloodCastle WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.RankingDevilSquare WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.RankingChaosCastle WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.RankingIllusionTemple WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.RankingDuel WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.Gens_Rank WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.Gens_Reward WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.EventSantaClaus WHERE Name='{$Character}'");
							$this->Query("DELETE ".MuGen_DB.".dbo.EventLeoTheHelper WHERE Name='{$Character}'");
						}
						@unlink(constant("Upload_Img")."/".$Find_Chars[$CTM[C][0]]);
						$this->Query("DELETE ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
					}
					$this->Query("DELETE ".MuGen_DB.".dbo.AccountCharacter WHERE Id='{$Account}'");
				}
				$this->Query("DELETE ".MuGen_DB.".dbo.warehouse WHERE AccountID='{$Account}'");
				$this->Query("DELETE ".MuAcc_DB.".dbo.MEMB_STAT WHERE memb___id='{$Account}'");
				
				if(VI_CURR_INFO == TRUE)
				{
					$this->Query("DELETE ".MuGen_DB.".dbo.VI_CURR_INFO WHERE memb___id='{$Account}'");
				}
				if(ExtWarehouse == TRUE)
				{
					$this->Query("DELETE ".MuGen_DB.".dbo.".ExtWare_Table." WHERE ".ExtWare_Login."='{$Account}'");
				}
				if(VIP_Table != "MEMB_INFO")
				{
					$this->Query("DELETE ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='{$Account}'");
				}
				if(GL_Table != "MEMB_INFO")
				{
					$this->Query("DELETE ".GL_DB.".dbo.".GL_Table." WHERE ".GL_Login."='{$Account}'");
				}
				
				$this->Query("DELETE dbo.{$CTM[0]} WHERE account='{$Account}'");
				$this->Query("DELETE ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}'");
				
				exit("<div class=\"success-box\"> Conta deletada com Sucesso!</div>");
			}
		}
	}
	private function Create_Character()
	{
		global $CTM_Template, $_ClassType;
		
		if($_GET["cmd"] == TRUE)
		{
			$Account = $_POST["Account"];
			$Name = $_POST["Name"];
			$Class = $_POST["Class"];
			$Level = $_POST["Level"];
			$Points = $_POST["Points"];
			$Strength = $_POST["Strength"];
			$Dexterity = $_POST["Dexterity"];
			$Vitality = $_POST["Vitality"];
			$Energy = $_POST["Energy"];
			$Money = $_POST["Money"];
			$CtlCode = $_POST["CtlCode"];
			$MuVersion = GS_Version > 1 ? 1 : 0;
			$Check = $this->NumQuery("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='{$Account}'");
			
			if(
			empty($Account) ||
			empty($Strength) ||
			empty($Dexterity) ||
			empty($Vitality) ||
			empty($Energy) ||
			$Money == NULL ||
			$Points == NULL ||
			$CtlCode == NULL)
			{
				exit("<div class=\"warning-box\"> Preencha todos os Campos.</div>");
			}
			elseif($Check < 1)
			{
				exit("<div class=\"error-box\"> Esta conta n&atilde;o existe.</div>");
			}
			else
			{
				$Command = $this->FetchQuery("exec dbo.CTM_CreateCharacter
				'{$Account}','{$Name}',{$Class},{$Level},{$Points},{$Strength},{$Dexterity},{$Vitality},{$Energy},
				{$Money},{$CtlCode},{$MuVersion}");
				$Result = "0x".bin2hex($Command[0]);
				
				if($Result == "0x00")
				{
					exit("<div class=\"error-box\"> Este personagem j&aacute; existe.</div>");
				}
				elseif($Result == "0x03")
				{
					exit("<div class=\"error-box\"> Esta conta j&aacute; esta com 5 chars.</div>");
				}
				elseif($Result == "0x01")
				{
					exit("<div class=\"success-box\"> Personagem criado com sucesso!</div>");
				}
				else
				{
					exit("<div class=\"error-box\"> Erro na opera&ccedil;&atilde;o (".$Result.").");
				}
			}
		}
		foreach($_ClassType as $Class => $Value)
		{
			$Class_List .= "<option value=\"".$Value[0]."\">".$Value[1]."</option>\n";
		}
		$CTM_Template->Set("%CLASS_LIST%", $Class_List);
		$CTM_Template->Set("%STAFF_CODE%", constant("Staff_Code"));
		unset($Class_List);
	}
	private function Manage_Char()
	{
		global $CTM_Template, $_ClassType, $_MapInfo;
		
		if($_GET["cmd"] == TRUE)
		{
			$Character = explode(":", $_GET["name"]);
			$Level = $_POST["Level"];
			$Class = $_POST["Class"];
			$Points = $_POST["Points"];
			$Experience = $_POST["Experience"];
			$Strength = $_POST["Strength"];
			$Dexterity = $_POST["Dexterity"];
			$Vitality = $_POST["Vitality"];
			$Energy = $_POST["Energy"];
			$Command = $_POST["Leadership"];
			$Money = $_POST["Money"];
			$MapNumber = $_POST["MapNumber"];
			$MapPosX = $_POST["MapPosX"];
			$MapPosY = $_POST["MapPosY"];
			$PkCount = $_POST["PkCount"];
			$PkTime = $_POST["PkTime"];
			$CtlCode = $_POST["CtlCode"];
			$Resets = $_POST["Resets"];
			$ResetsDay = $_POST["ResetsDay"];
			$ResetsWeek = $_POST["ResetsWeek"];
			$ResetsMonth = $_POST["ResetsMonth"];
			$MResets = $_POST["MResets"];
			if(empty($Command))
			{
				$Command = 0;
			}
			if(
			(empty($Level)) ||
			($Class == NULL) || 
			($Points == NULL) ||
			($Experience == NULL) ||
			(empty($Strength)) ||
			(empty($Dexterity)) ||
			(empty($Vitality)) ||
			(empty($Energy)) ||
			($Money == NULL) ||
			($MapNumber == NULL) ||
			($MapPosX == NULL) ||
			($MapPosY == NULL) ||
			($PkCount == NULL) ||
			($PkTime == NULL) ||
			($CtlCode == NULL) ||
			($Resets == NULL) ||
			($ResetsDay == NULL) ||
			($ResetsWeek == NULL) ||
			($ResetsMonth == NULL) ||
			($MResets == NULL))
			{
				exit("<div class=\"warning-box\"> Preencha todos os campos.</div>");
			}
			else
			{
				$Cmd_Query = $Character[1] == $_ClassType["DL"][0] || $Character[1] == $_ClassType["LE"][0] || 
				$Character[1] == $_ClassType["LE2"][0] ? ",".Column_Cmd."='{$Command}'" : NULL;			
				$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET 
				cLevel='{$Level}',Class='{$Class}',LevelUpPoint='{$Points}',Experience='{$Experience}',
				Strength='{$Strength}',Dexterity='{$Dexterity}',Vitality='{$Vitality}',Energy='{$Energy}'{$Cmd_Query},
				Money='{$Money}',MapNumber='{$MapNumber}',MapPosX='{$MapPosX}',MapPosY='{$MapPosY}',PkCount='{$PkCount}',
				PkTime='{$PkTime}',CtlCode='{$CtlCode}',
				".Column_Reset."='{$Resets}',".Column_ResetDay."='{$ResetsDay}',".Column_ResetWeek."='{$ResetsWeek}',
				".Column_ResetMonth."='{$ResetsMonth}',".Column_MReset."='{$MResets}' WHERE Name='{$Character[0]}'");
				exit("<div class=\"success-box\"> Personagem editado com Sucesso!</div>");
			}
		}
		$Character = $_POST["Character"];
		$Check_Exists = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
		$Query_Char = $this->Query("SELECT AccountID,Name,cLevel,Class,LevelUpPoint,Experience,
		Strength,Dexterity,Vitality,Energy,Money,MapNumber,MapPosX,MapPosY,PkCount,PkTime,CtlCode,
		".Column_Reset.",".Column_ResetDay.",".Column_ResetWeek.",".Column_ResetMonth.",".Column_MReset." 
		FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
		$Find_Char = $this->FetchArray($Query_Char);
		$Find_Command = $Find_Char[3] == $_ClassType["DL"][0] || $Find_Char[3] == $_ClassType["LE"][0] ||
		$Find_Char[3] == $_ClassType["LE2"][0] ?
		$this->FetchQuery("SELECT ".Column_Cmd." FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'") : NULL;
		
		if(empty($Character))
		{
			exit("<div class=\"warning-box\"> Digite o nome do personagem.</div>");
		}
		elseif($Check_Exists < 1)
		{
			exit("<div class=\"error-box\"> Este personagem n&atilde;o existe!</div>");
		}
		foreach($Find_Char as $Char => $Value)
		{
			$CTM_Template->Set("Char_".$Char, $Value);
		}
		foreach($_ClassType as $Class => $Value)
		{
			$Selected = $Find_Char[3] == $Value[0] ? "selected=\"selected=\"" : NULL;
			$Class_List .= "<option value=\"".$Value[0]."\" ".$Selected.">".$Value[1]."</option>\n";
		}
		foreach($_MapInfo as $SetMap => $Value)
		{
			$Selected = $Find_Char[11] == $Value[0] ? "selected=\"selected=\"" : NULL;
			$Map_List .= "<option value=\"".$Value[0]."\" ".$Selected.">".$Value[3]."</option>\n";
		}
		$CTM_Template->Set("Char_Resets", $Find_Char[17]);
		$CTM_Template->Set("Char_ResetsDay", $Find_Char[18]);
		$CTM_Template->Set("Char_ResetsWeek", $Find_Char[19]);
		$CTM_Template->Set("Char_ResetsMonth", $Find_Char[20]);
		$CTM_Template->Set("Char_MResets", $Find_Char[21]);
		$CTM_Template->Set("Check_Code#1", $Find_Char[15] == 0 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Code#2", $Find_Char[15] == 1 ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Check_Code#3", $Find_Char[15] == constant("Staff_Code") ? "selected=\"selected\"" : NULL);
		$CTM_Template->Set("Class_List", $Class_List);
		$CTM_Template->Set("Map_List", $Map_List);
		$CTM_Template->Set("Staff_Code", constant("Staff_Code"));
		$CTM_Template->Set("Char_ID", $Character.":".$Find_Char[3]);
		$CTM_Template->Set("%Input_Cmd%", $Find_Char[3] == $_ClassType["DL"][0] || $Find_Char[3] == $_ClassType["LE"][0] ||
		$Find_Char[3] == $_ClassType["LE2"][0] ? "<tr>
    <td width=\"181\">Comando:</td>
    <td width=\"226\"><input type=\"text\" name=\"Leadership\" id=\"Leadership\" onKeyPress=\"return NumbersOnly(event)\" value=\"{$Find_Command[0]}\" /></td>
  </tr>" : NULL);
		unset($Class_List);
		unset($Map_List);
	}
	private function Ban_Char()
	{
		global $CTM, $_PanelAdmin, $_Mailer;
		
		if($_GET["cmd"] == TRUE)
		{
			$Character = $_POST["Character"];
			$Time = $_POST["Time"];
			$Reason = base64_encode($_POST["Reason"]);
			$Check[0] = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
			$Check[1] = $this->FetchQuery("SELECT CtlCode,AccountID FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
			$Find_Account = $this->FetchQuery("SELECT memb_name,mail_addr FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='".$Check[1][1]."'");
			
			if(empty($Character) || empty($Time) || empty($Reason))
			{
				exit("<div class=\"warning-box\"> Preencha todos os Campos.</div>");
			}
			elseif($Check[0] < 1)
			{
				exit("<div class=\"error-box\"> Este Char n&atilde;o existe.</div>");
			}
			elseif($Check[1][0] == 1)
			{
				exit("<div class=\"error-box\"> Este char se encontra banido.</div>");
			}
			else
			{
				$Str_Time = strtotime("+ {$Time} days");
				$Date = date("d/m/Y", $Str_Time);
				$Hour = date("H:i", $Str_Time);
				/****************************** Send Mail *******************************/
				if($_PanelAdmin["Characters"]["Ban"]["Send_Mail"] === TRUE)
				{
					$Message .= "Ol&aacute; <strong>".$Find_Account[0]."</strong>!<br /><br />";
					$Message .= "Voc&ecirc; cometeu um ato foras das regras do servidor,";
					$Message .= "<br />Devido a este motivo seu personagem esta banido, informa&ccedil;&otilde;es:<br /><br />";
					$Message .= "<strong>Login:</strong> ".$Check[1][1]."<br />";
					$Message .= "<strong>Personagem:</strong> ".$Character."<br />";
					$Message .= "<strong>Motivo:</strong> ".utf8_decode(base64_decode($Reason))."<br />";
					$Message .= "<strong>Tempo:</strong> ".$Time." Dias<br />";
					$Message .= "<strong>Expira&ccedil;&atilde;o:</strong> ".$Date." as ".$Hour."<br />";
					$Message .= "<br />";
					$Message .= "N&atilde;o cometa o mesmo erro novamente.<br />";
					$Message .= "Caso tenha sido banido injustamente entre em contato.<br /><br />";
				
					$CTM_Mailer = new CTM_Mailer();
					$CTM_Mailer->SMTP_Server = $_Mailer["SMTP"]["Server"];
					$CTM_Mailer->SMTP_Port = $_Mailer["SMTP"]["Port"];
					$CTM_Mailer->SMTP_User = $_Mailer["SMTP"]["User"];
					$CTM_Mailer->SMTP_Pass = $_Mailer["SMTP"]["Pass"];
					$CTM_Mailer->Mail_From = $_Mailer["SMTP"]["Mail"];
					$CTM_Mailer->SMTP_Debug = $_Mailer["SMTP"]["Debug"];
					$CTM_Mailer->Mail_To = $Find_Account[1];
					$CTM_Mailer->Mail_Sender = "Suporte ".constant("Server_Name");
					$CTM_Mailer->Mail_Recipient = $Find_Account[0];
					$CTM_Mailer->Mail_Subject = utf8_decode("Seu personagem foi banido - ".constant("Server_Name"));
					$CTM_Mailer->Mail_Message = $Message;
				
					if($CTM_Mailer->Send_Mail() == FALSE)
					{
						exit("<div class=\"error-box\"> Erro ao enviar o E-Mail!</div>");
					}
					else
					{
						$Character_S = $this->FetchQuery("SELECT name FROM dbo.{$CTM[0]} WHERE account='".$this->Login."'");
						
						$this->Query("INSERT INTO dbo.{$CTM[8]} (Character,Responsible,[Time],Reason) VALUES ('{$Character}','{$Character_S[0]}',".strtotime("+ {$Time} days").",'{$Reason}')");
						$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET CtlCode=1 WHERE Name='{$Character}'");
						unset($Message);
						exit("<div class=\"success-box\"> Char <b>{$Character}</b> banido por <b>{$Time} dias</b> com Sucesso!</div>");
					}
				}
				else
				{
					$Character_S = $this->FetchQuery("SELECT name FROM dbo.{$CTM[0]} WHERE account='".$this->Login."'");
					
					$this->Query("INSERT INTO dbo.{$CTM[8]} (Character,Responsible,[Time],Reason) VALUES ('{$Character}','{$Character_S[0]}',".strtotime("+ {$Time} days").",'{$Reason}')");
					$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET CtlCode=1 WHERE Name='{$Character}'");
					exit("<div class=\"success-box\"> Char <b>{$Character}</b> banido por <b>{$Time} dias</b> com Sucesso!</div>");
				}
			}
		}
	}
	private function Unban_Char()
	{
		global $CTM_Template, $CTM;
		
		if($_GET["cmd"] == TRUE)
		{
			$Character = $_POST["Character"];
			$Check = $this->FetchQuery("SELECT CtlCode FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
			
			if(empty($Character))
			{
				exit("<div class=\"warning-box\"> Selecione o Char</div>");
			}
			elseif($Check[0] < 1 || $Check[0] > 1)
			{
				exit("<div class=\"error-box\"> Este Char n&atilde;o esta banido</div>");
			}
			else
			{
				$this->Query("DELETE dbo.{$CTM[8]} WHERE Character='{$Character}'");
				$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET CtlCode=0 WHERE Name='{$Character}'");
				exit("<div class=\"success-box\"> Char <b>{$Character}</b> desbanido com Sucesso!</div>");
			}
		}
		$Check = $this->FetchQuery("SELECT count(*) FROM ".MuGen_DB.".dbo.Character WHERE CtlCode=1");

		if($Check[0] < 1)
		{
			exit("<div class=\"info-box\"> N&atilde;o h&aacute; chars banidos no momento.</div>");
		}

		$Query = $this->Query("SELECT Name FROM ".MuGen_DB.".dbo.Character WHERE CtlCode=1");
		
		while($Load = $this->Fetch($Query))
		{
			$Return .= "<option value=\"{$Load[0]}\">{$Load[0]}</option>";
		}
		$CTM_Template->Set("Characters_Banned", $Return);
		unset($Return);
	}
	private function Delete_Character()
	{
		global $CTM, $_Ranking;
		
		if($_GET["cmd"] == TRUE)
		{
			$Character = $_POST["Character"];
			$Guild = $_POST["Delete_Guild"];
			$Check[0] = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
			$Check[1] = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.Guild WHERE G_Master='{$Character}'");
			$Find_Char = $this->FetchQuery("SELECT AccountID,{$CTM[C][0]} FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
			$Find_Query = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.AccountCharacter WHERE Id='".$Find_Char[0]."'");
			$Find_Game = $this->FetchArray($Find_Query);
		
			if($Find_Game["GameID1"] == $Character) { $GameID = "GameID1"; }
			if($Find_Game["GameID2"] == $Character) { $GameID = "GameID2"; }
			if($Find_Game["GameID3"] == $Character) { $GameID = "GameID3"; }
			if($Find_Game["GameID4"] == $Character) { $GameID = "GameID4"; }
			if($Find_Game["GameID5"] == $Character) { $GameID = "GameID5"; }
			
			if(empty($Character))
			{
				exit("<div class=\"warning-box\"> Digite o nome do personagem.</div>");
			}
			elseif($Check[0] < 1)
			{
				exit("<div class=\"error-box\"> Este personagem n&atilde;o existe.</div>");
			}
			elseif($Guild == FALSE && $Check[1] > 0)
			{
				exit("<div class=\"error-box\"> Este personagem &eacute; um Guild Master.</div>");
			}
			else
			{
				$this->Query("UPDATE ".MuGen_DB.".dbo.AccountCharacter SET ".$GameID."=NULL WHERE Id='{$Find_Char[0]}'");
				$this->Query("DELETE ".MuGen_DB.".dbo.GuildMember WHERE Name='{$Character}'");
				if($Guild == TRUE)
				{
					$Find_Guild = $this->FetchQuery("SELECT G_Name FROM ".MuGen_DB.".dbo.Guild WHERE G_Master='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.Guild WHERE G_Master='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.GuildMember WHERE G_Name='{$Find_Guild[0]}'");
				}
				if(GS_Version > 1)
				{
					$this->Query("DELETE ".MuGen_DB.".dbo.T_CGuid WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.T_FriendMain WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.T_FriendMail WHERE FriendName='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.T_FriendList WHERE FriendName='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.T_WaitFriend WHERE FriendName='{$Character}'");
				}
				if(@Server_Files == 0)
				{
					$this->Query("DELETE ".MuGen_DB.".dbo.OptionData WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.T_MasterLevelSystem WHERE CHAR_NAME='{$Character}'");
					if($_Ranking["Gens"]["Enable"] === TRUE)
					{
						$this->Query("DELETE ".MuGen_DB.".dbo.T_GensSystem WHERE CHAR_NAME='{$Character}'");
					}
				}
				if(@Server_Files == 1)
				{
					$this->Query("DELETE ".MuGen_DB.".dbo.OptionData WHERE Name='{$Character}'");
				}
				if(@Server_Files == 2)
				{
					$this->Query("DELETE ".MuGen_DB.".dbo.OptionData WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.QuestWorld WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.QuestKillCount WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.RankingBloodCastle WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.RankingDevilSquare WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.RankingChaosCastle WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.RankingIllusionTemple WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.RankingDuel WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.Gens_Rank WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.Gens_Reward WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.EventSantaClaus WHERE Name='{$Character}'");
					$this->Query("DELETE ".MuGen_DB.".dbo.EventLeoTheHelper WHERE Name='{$Character}'");
				}
				@unlink(constant("Upload_Img")."/".$Find_Char[1]);
				$this->Query("DELETE ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
				exit("<div class=\"success-box\"> Personagem deletado com Sucesso!</div>");
			}
		}
	}
	/** New Final: Reference **/
	private function Show_Reference()
	{
		global $CTM_Template;
		
		$query = $this->Query("SELECT * FROM CTM_WebReference ORDER BY Points DESC");
		
		if($this->NumRow($query) < 1)
		{
			$all = "<div class=\"info-box\"> N&atilde;o h&aacute; registros de refer&ecirc;ncias no momento.</div>";
		}
		else
		{
			$all = "
			<table width=\"400\" border=\"0\">
                <tr>
                  <td><strong>Id</strong></td>
                  <td><strong>Conta</strong></td>
                  <td><strong>Pontos</strong></td>
                  <td><strong>Acessos</strong></td>
				  <td><strong>Cadastros</strong></td>
                </tr>";
			
			while($users = $this->FetchObject($query))
			{
				$all .= "
				<tr>
                  <td>".$users->Id."</td>
                  <td>".$users->Account."</td>
                  <td>".$users->Points."</td>
                  <td>".$users->AccessCount."</td>
				  <td>".$users->RegisterCount."</td>
                </tr>";
			}
		}
		
		$CTM_Template->Set("RankResult", $all);
		unset($all);
	}
	private function Reset_Reference()
	{
		if($_GET['cmd'] == true)
		{
			$this->Query("UPDATE CTM_WebReference SET AccessCount = 0, RegisterCount = 0, Points = 0");
			$this->Query("DELETE FROM CTM_WebReferenceData");
			
			exit("<div class=\"success-box\"> Refer&ecirc;ncias resetadas com sucesso!</div>");
		}
	}
	/****************************************/
	private function List_Tickets()
	{
		global $CTM_Template, $CTM, $_Panel;
		
		echo("<script type=\"text/javascript\" src=\"modules/javascripts/SpryTabbedPanels.js\"></script>
		<style type=\"text/css\"> @import url('modules/css/SpryTabbedPanels.css'); </style>");
		
		$Query[0] = $this->Query("SELECT * FROM dbo.{$CTM[3]} WHERE Status=0 ORDER BY Id DESC");
		$Query[1] = $this->Query("SELECT * FROM dbo.{$CTM[3]} WHERE Status=1 or Status=2 ORDER BY Id DESC");
		$Query[2] = $this->Query("SELECT * FROM dbo.{$CTM[3]} WHERE Status=3 ORDER BY Id DESC");
		$Check[0] = $this->NumRow($Query[0]);
		$Check[1] = $this->NumRow($Query[1]);
		$Check[2] = $this->NumRow($Query[2]);
		
		if($Check[0] < 1)
		{
			$Return_Open = "<div class=\"info-box\"> Nenhum Ticket aberto no Momento</div>";
		}
		else
		{
			$Return_Open .= "
			<table width=\"400\" border=\"0\">
                <tr>
                  <td><strong>Data</strong></td>
                  <td><strong>Departamento</strong></td>
                  <td><strong>Assunto</strong></td>
                  <td><strong>Status</strong></td>
                </tr>";
			while($Tickets_Open = $this->FetchArray($Query[0]))
			{
				switch($Tickets_Open["Status"])
				{
					case 0 : $Status = "<strong><font color=\"#008B8B\">Aberto</font></strong>"; break;
					case 1 : $Status = "<strong><font color=\"#C2DC61\">Respondido</font></strong>"; break;
					case 2 : $Status = "<strong><font color=\"#FE8735\">Aguardando Resposta</font></strong>"; break;
					case 3 : $Status = "<strong><font color=\"#FE8735\">Fechado</font></strong>"; break;
				}
				$Return_Open .= "
				<tr>
                  <td>".date("d/m/Y", $Tickets_Open["Date"])."</td>
                  <td>".base64_decode($Tickets_Open["Subject"])."</td>
                  <td><a href=\"javascript: void(CTM_TeaM)\" onclick=\"CTM_Load('?pag=paneladmin&str=VIEW_TICKET&id=".$Tickets_Open["Id"]."','Panel_Nav','GET');\">".base64_decode($Tickets_Open["Title"])."</a></td>
                  <td>".$Status."</td>
                </tr>";
			}
			$Return_Open .= "
		</table>";
		}
		
		if($Check[1] < 1)
		{
			$Return_Progress = "<div class=\"info-box\"> Nenhum Ticket em andamento no Momento</div>";
		}
		else
		{
			$Return_Progress .= "
			<table width=\"400\" border=\"0\">
                <tr>
                  <td><strong>Data</strong></td>
                  <td><strong>Departamento</strong></td>
                  <td><strong>Assunto</strong></td>
                  <td><strong>Status</strong></td>
                </tr>";
			while($Tickets_Progress = $this->FetchArray($Query[1]))
			{
				switch($Tickets_Progress["Status"])
				{
					case 0 : $Status = "<strong><font color=\"#008B8B\">Aberto</font></strong>"; break;
					case 1 : $Status = "<strong><font color=\"#C2DC61\">Respondido</font></strong>"; break;
					case 2 : $Status = "<strong><font color=\"#FE8735\">Aguardando Resposta</font></strong>"; break;
					case 3 : $Status = "<strong><font color=\"#FE8735\">Fechado</font></strong>"; break;
				}
				$Return_Progress .= "
				<tr>
                  <td>".date("d/m/Y", $Tickets_Progress["Date"])."</td>
                  <td>".base64_decode($Tickets_Progress["Subject"])."</td>
                  <td><a href=\"javascript: void(CTM_TeaM)\" onclick=\"CTM_Load('?pag=paneladmin&str=VIEW_TICKET&id=".$Tickets_Progress["Id"]."','Panel_Nav','GET');\">".base64_decode($Tickets_Progress["Title"])."</a></td>
                  <td>".$Status."</td>
                </tr>";
			}
			$Return_Progress .= "
		</table>";
		}
		
		if($Check[2] < 1)
		{
			$Return_Closed = "<div class=\"info-box\"> Nenhum Ticket Fechado no Momento</div>";
		}
		else
		{
			$Return_Closed .= "
			<table width=\"400\" border=\"0\">
                <tr>
                  <td><strong>Data</strong></td>
                  <td><strong>Departamento</strong></td>
                  <td><strong>Assunto</strong></td>
                  <td><strong>Status</strong></td>
                </tr>";
			while($Tickets_Closed = $this->FetchArray($Query[2]))
			{
				switch($Tickets_Closed["Status"])
				{
					case 0 : $Status = "<strong><font color=\"#008B8B\">Aberto</font></strong>"; break;
					case 1 : $Status = "<strong><font color=\"#C2DC61\">Respondido</font></strong>"; break;
					case 2 : $Status = "<strong><font color=\"#FE8735\">Aguardando Resposta</font></strong>"; break;
					case 3 : $Status = "<strong><font color=\"#FE8735\">Fechado</font></strong>"; break;
				}
				$Return_Closed .= "
				<tr>
                  <td>".date("d/m/Y", $Tickets_Closed["Date"])."</td>
                  <td>".base64_decode($Tickets_Closed["Subject"])."</td>
                  <td><a href=\"javascript: void(CTM_TeaM)\" onclick=\"CTM_Load('?pag=paneladmin&str=VIEW_TICKET&id=".$Tickets_Closed["Id"]."','Panel_Nav','GET');\">".base64_decode($Tickets_Closed["Title"])."</a></td>
                  <td>".$Status."</td>
                </tr>";
			}
			$Return_Closed .= "
		</table>";
		}
		
		$CTM_Template->Set("Tickets_Open", $Return_Open);
		$CTM_Template->Set("Tickets_Progress", $Return_Progress);
		$CTM_Template->Set("Tickets_Closed", $Return_Closed);
		unset($Return_Open);
		unset($Return_Progress);
		unset($Return_Closed);
	}
	private function Suportt_Tickets()
	{
		global $CTM_General, $CTM_Template, $CTM, $_PanelAdmin;
		$CTM_BBCode = new CTM_BBCode();
		
		$Id = $_GET["id"];
		$Query = $this->Query("SELECT * FROM dbo.{$CTM[3]} WHERE Id='{$Id}'");
		$Check = $this->NumRow($Query);

		if($Check < 1)
		{
			exit("<div class=\"error-box\"> Este Ticket n&atilde;o existe.</div>");
		}
		
		if($_GET["cmd"] == "resp")
		{
			$Id = $_GET["id"];
			$Text = base64_encode(str_replace("\\", "", $_POST["Text"]));
			$Character = $this->FetchQuery("SELECT name FROM dbo.{$CTM[0]} WHERE account='{$this->Login}'");
			
			if(empty($Text))
			{
				exit("<div class=\"warning-box\"> Digite a mensagem.</div>");
			}
			else
			{
				$this->Query("INSERT INTO dbo.{$CTM[9]} (Date,Character,TicketID,Text) VALUES(".strtotime("now").",'{$Character[0]}',{$Id},'{$Text}')");
				$this->Query("UPDATE dbo.{$CTM[3]} SET Status=1 WHERE Id='{$Id}'");
				exit("<div class=\"success-box\"> Resposta enviada com Sucesso</div>");
			}
		}
		if($_GET["cmd"] == "open")
		{
			$Id = $_GET["id"];
			$this->Query("UPDATE dbo.{$CTM[3]} SET Status=0 WHERE Id='{$Id}'");
			exit("<div class=\"success-box\"> Ticket Aberto com Sucesso!</div>");
		}
		if($_GET["cmd"] == "close")
		{
			$Id = $_GET["id"];
			$this->Query("UPDATE dbo.{$CTM[3]} SET Status=3 WHERE Id='{$Id}'");
			exit("<div class=\"success-box\"> Ticket Fechado com Sucesso!</div>");
		}
		if($_GET["cmd"] == "delete")
		{
			if($this->Privilegy($_PanelAdmin["Ticket"]["Delete"], 1) == FALSE)
			{
				exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o tem permis&atilde;o para executar este comando.</div>");
			}
			else
			{
				$this->Query("DELETE dbo.{$CTM[3]} WHERE Id='{$Id}'");
				$this->Query("DELETE dbo.{$CTM[9]} WHERE TicketID='{$Id}'");
				exit("<div class=\"success-box\"> Ticket deletado com Sucesso!</div>");
			}
		}
		$Load = $this->FetchArray($Query);
		$Image = $CTM_General->Image($Load["Character"]);

		$Resp_Query = $this->Query("SELECT Date,Character,Text FROM dbo.{$CTM[9]} WHERE TicketID='{$Id}' ORDER BY Id DESC");

		switch($Load["Status"])
		{
			case 0 : $Status = "<strong><font color=\"#008B8B\">Aberto</font></strong>"; break;
			case 1 : $Status = "<strong><font color=\"#C2DC61\">Respondido</font></strong>"; break;
			case 2 : $Status = "<strong><font color=\"#FE8735\">Aguardando Resposta</font></strong>"; break;
			case 3 : $Status = "<strong><font color=\"#FE8735\">Fechado</font></strong>"; break;
		}

		$Define = $Load["Status"] == 3 ? "<input type=\"button\" value=\"Abrir Ticket\" onclick=\"CTM_Load('?pag=paneladmin&str=VIEW_TICKET&cmd=open&id=".$Load["Id"]."','Command','POST',BuscaElementosForm('Manage_Ticket'));\" />" : "<input type=\"button\" value=\"Fechar Ticket\" onclick=\"CTM_Load('?pag=paneladmin&str=VIEW_TICKET&cmd=close&id=".$Load["Id"]."','Command','POST',BuscaElementosForm('Manage_Ticket'));\" />";
		
		while($Resp = $this->Fetch($Resp_Query))
		{
			$New_Img = $CTM_General->Image($Resp[1]);
			$Staff = $this->NumQuery("SELECT Name FROM dbo.{$CTM[0]} WHERE Name='{$Resp[1]}'");
			$Ticket = $Staff > 0 ? " style=\"background-color:#CFE6FF\"" : NULL;
			$Return .= "<blockquote{$Ticket}>
	<table border=\"0\">
 			 <tr>
   			 <td width=\"135\"><img src=\"".$New_Img."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /></td>
   			 <td width=\"493\"><table border=\"0\">
				 <tr>
       			 <td><blockquote>Postado por: <b class=\"colr\">".$Resp[1]."</b> em <b class=\"colr\">".date("d/m/Y", $Resp[0])."</b> as <b class=\"colr\">".date("H:i", $Resp[0])."</b></blockquote></td>
				 </tr>
				 <tr>
       			 <td><blockquote>".nl2br($CTM_BBCode->Replace(base64_decode($Resp[2])))."</blockquote></td>
				 </tr>
    			</table>
				</td>
  			</tr>
			</table>
		</blockquote>";
		}
		
		$CTM_Template->Set("Ticket_Title", base64_decode($Load["Title"]));
		$CTM_Template->Set("Ticket_Char#Image", $Image);
		$CTM_Template->Set("Ticket_Char", $Load["Character"]);
		$CTM_Template->Set("Ticket_Date", date("d/m/Y", $Load["Date"]));
		$CTM_Template->Set("Ticket_Time", date("H:i", $Load["Date"]));
		$CTM_Template->Set("Ticket_Subject", base64_decode($Load["Subject"]));
		$CTM_Template->Set("Ticket_Protocol", $Load["Protocol"]);
		$CTM_Template->Set("Ticket_Text", nl2br($CTM_BBCode->Replace(base64_decode($Load["Text"]))));
		$CTM_Template->Set("Ticket_Define", $Define);
		$CTM_Template->Set("Ticket_ID", $Load["Id"]);
		$CTM_Template->Set("Resp_List", $Return);
		$CTM_Template->Set("%DELETE_BUTTON%" , $this->Privilegy($_PanelAdmin["Ticket"]["Delete"], 1) == TRUE ? "&nbsp;<input type=\"button\" value=\"Deletar Ticket\" onclick=\"Delete_Ticket();\" />" : NULL);
		unset($Return);
	}
	private function Payments()
	{
		global $CTM_Template, $CTM;
		
		echo("<script type=\"text/javascript\" src=\"modules/javascripts/SpryTabbedPanels.js\"></script>
		<style type=\"text/css\"> @import url('modules/css/SpryTabbedPanels.css'); </style>\n\r");
		
		$Query[0] = $this->Query("SELECT * FROM dbo.{$CTM[10]} WHERE Status < 1 ORDER BY Id DESC");
		$Query[1] = $this->Query("SELECT * FROM dbo.{$CTM[10]} WHERE Status > 0 ORDER BY Id DESC");
		$Check[0] = $this->NumRow($Query[0]);
		$Check[1] = $this->NumRow($Query[1]);
		
		if($Check[0] < 1)
		{
			$Return_Open = "<div class=\"info-box\"> Nenhum Pagamento aberto no Momento</div>";
		}
		else
		{
			$Return_Open .= "
			<table width=\"400\" border=\"0\">
                <tr>
                  <td><strong>ID</strong></td>
                  <td><strong>Banco</strong></td>
                  <td><strong>Data</strong></td>
                  <td><strong>Status</strong></td>
                </tr>";
			while($Payment_Open = $this->FetchArray($Query[0]))
			{
				switch($Payment_Open["Status"])
				{
					case 0 : $Status = "<strong><font color=\"blue\">Aberto</font></strong>"; break;
					case 1 : $Status = "<strong><font color=\"green\">Confirmado</font></strong>"; break;
					case 2 : $Status = "<strong><font color=\"red\">Rejeitado</font></strong>"; break;
				}
				$Return_Open .= "
				<tr>
                  <td>#".$Payment_Open["Id"]." <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=paneladmin&str=VIEW_PAYMENT&id=".$Payment_Open["Id"]."','Panel_Nav','GET');\">[ Ver ]</a></td>
                  <td>".base64_decode($Payment_Open["Bank"])."</td>
                  <td>".date("d/m/Y", $Payment_Open["Time"])." as ".date("H:i", $Payment_Open["Time"])."</td>
                  <td>".$Status."</td>
                </tr>";
			}
			$Return_Open .= "
		</table>";
		}
		
		if($Check[1] < 1)
		{
			$Return_Closed = "<div class=\"info-box\"> Nenhum Pagamento Fechado no Momento</div>";
		}
		else
		{
			$Return_Closed .= "
			<table width=\"400\" border=\"0\">
                <tr>
                  <td><strong>ID</strong></td>
                  <td><strong>Banco</strong></td>
                  <td><strong>Data</strong></td>
                  <td><strong>Status</strong></td>
                </tr>";
			while($Payment_Close = $this->FetchArray($Query[1]))
			{
				switch($Payment_Close["Status"])
				{
					case 0 : $Status = "<strong><font color=\"blue\">Aberto</font></strong>"; break;
					case 1 : $Status = "<strong><font color=\"green\">Confirmado</font></strong>"; break;
					case 2 : $Status = "<strong><font color=\"red\">Rejeitado</font></strong>"; break;
				}
				$Return_Closed .= "
				<tr>
                  <td>#".$Payment_Close["Id"]." <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=paneladmin&str=VIEW_PAYMENT&id=".$Payment_Close["Id"]."','Panel_Nav','GET');\">[ Ver ]</a></td>
                  <td>".base64_decode($Payment_Close["Bank"])."</td>
                  <td>".date("d/m/Y", $Payment_Close["Time"])." as ".date("H:i", $Payment_Close["Time"])."</td>
                  <td>".$Status."</td>
                </tr>";
			}
			$Return_Closed .= "
		</table>";
		}
		$CTM_Template->Set("Payments_Open", $Return_Open);
		$CTM_Template->Set("Payments_Closed", $Return_Closed);
		unset($Return_Open);
		unset($Return_Closed);
	}
	private function Manage_Payment()
	{
		global $CTM_General, $CTM_Template, $CTM, $_PanelAdmin;
		$CTM_BBCode = new CTM_BBCode();
		
		$Id = $_GET["id"];
		$Query = $this->Query("SELECT * FROM dbo.{$CTM[10]} WHERE Id='{$Id}'");
		$Check = $this->NumRow($Query);

		if($Check < 1)
		{
			exit("<div class=\"error-box\"> Este Pagamento n&atilde;o existe.</div>");
		}
		
		if($_GET["cmd"] == "resp")
		{
			$Id = $_GET["id"];
			$Text = base64_encode(str_replace("\\", "", $_POST["Text"]));
			$Character = $this->FetchQuery("SELECT name FROM dbo.{$CTM[0]} WHERE account='{$this->Login}'");
			
			if(empty($Text))
			{
				exit("<div class=\"warning-box\"> Digite a mensagem.</div>");
			}
			else
			{
				$this->Query("INSERT INTO dbo.{$CTM[11]} (Date,Character,PaymentID,Text) VALUES(".strtotime("now").",'{$Character[0]}',{$Id},'{$Text}')");
				exit("<div class=\"success-box\"> Resposta enviada com Sucesso</div>");
			}
		}
		if($_GET["cmd"] == "confirm")
		{
			$Id = $_GET["id"];
			$Payment = $this->FetchQuery("SELECT Golds,Account,Status FROM dbo.{$CTM[10]} WHERE Id='{$Id}'");
			
			if($Payment[2] == 1)
			{
				exit("<div class=\"info-box\"> Este pagamento j&aacute; se encontra Confirmado</div>");
			}
			elseif($Payment[2] == 2)
			{
				exit("<div class=\"error-box\"> Este pagamento se encontra Rejeitado</div>");
			}
			else
			{
				if($_PanelAdmin["Payment"]["Auto_Credit"] == TRUE)
				{
					$CTM_General->Check_Coin_Table($Payment[1]);
					$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".GL_Column_1."=".GL_Column_1."+{$Payment[0]} WHERE ".GL_Login."='{$Payment[1]}'");
				}
				$Credit = $_PanelAdmin["Payment"]["Auto_Credit"] == TRUE ? "<br />Creditado <b>{$Payment[0]} ".Gold."</b> na conta <b>{$Payment[1]}</b>" : NULL;
				$this->Query("UPDATE dbo.{$CTM[10]} SET Status=1 WHERE Id='{$Id}'");
				exit("<div class=\"success-box\"> Pagamento Confirmado com Sucesso!{$Credit}</div>");
			}
		}
		if($_GET["cmd"] == "rejet")
		{
			$Id = $_GET["id"];
			$Payment = $this->FetchQuery("SELECT Status FROM dbo.{$CTM[10]} WHERE Id='{$Id}'");
			
			if($Payment[0] == 1)
			{
				exit("<div class=\"info-box\"> Este pagamento se encontra Confirmado</div>");
			}
			elseif($Payment[0] == 2)
			{
				exit("<div class=\"error-box\"> Este pagamento j&aacute; se encontra Rejeitado</div>");
			}
			else
			{
				$this->Query("UPDATE dbo.{$CTM[10]} SET Status=2 WHERE Id='{$Id}'");
				exit("<div class=\"success-box\"> Pagamento Rejeitado com Sucesso!</div>");
			}
		}
		if($_GET["cmd"] == "delete")
		{
			if($this->Privilegy($_PanelAdmin["Payment"]["Delete"], 1) == FALSE)
			{
				exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o tem permis&atilde;o para executar este comando.</div>");
			}
			else
			{
				$this->Query("DELETE dbo.{$CTM[10]} WHERE Id='{$Id}'");
				$this->Query("DELETE dbo.{$CTM[11]} WHERE PaymentID='{$Id}'");
				exit("<div class=\"success-box\"> Pagamento deletado com Sucesso!</div>");
			}
		}
		$Load = $this->FetchArray($Query);
		$Image = $CTM_General->Image($Load["Character"]);

		$Resp_Query = $this->Query("SELECT Date,Character,Text FROM dbo.{$CTM[11]} WHERE PaymentID='{$Id}' ORDER BY Id DESC");

		switch($Load["Status"])
		{
			case 0 : $Status = "<strong><font color=\"blue\">Aberto</font></strong>"; break;
			case 1 : $Status = "<strong><font color=\"green\">Confirmado</font></strong>"; break;
			case 2 : $Status = "<strong><font color=\"red\">Rejeitado</font></strong>"; break;
		}
		
		while($Resp = $this->Fetch($Resp_Query))
		{
			$New_Img = $CTM_General->Image($Resp[1]);
			$Staff = $this->NumQuery("SELECT Name FROM dbo.{$CTM[0]} WHERE Name='{$Resp[1]}'");
			$Payment = $Staff > 0 ? " style=\"background-color:#CFE6FF\"" : NULL;
			$Return .= "<blockquote{$Payment}>
	<table border=\"0\">
 			 <tr>
   			 <td width=\"135\"><img src=\"".$New_Img."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /></td>
   			 <td width=\"493\"><table border=\"0\">
				 <tr>
       			 <td><blockquote>Postado por: <b class=\"colr\">".$Resp[1]."</b> em <b class=\"colr\">".date("d/m/Y", $Resp[0])."</b> as <b class=\"colr\">".date("H:i", $Resp[0])."</b></blockquote></td>
				 </tr>
				 <tr>
       			 <td><blockquote>".nl2br($CTM_BBCode->Replace(base64_decode($Resp[2])))."</blockquote></td>
				 </tr>
    			</table>
				</td>
  			</tr>
			</table>
		</blockquote>\n\r";
		}
		
		$CTM_Template->Set("Payment_Post#Date", date("d/m/Y", $Load["Time"]));
		$CTM_Template->Set("Payment_Char#Image", $Image);
		$CTM_Template->Set("Payment_Char", $Load["Character"]);
		$CTM_Template->Set("Payment_Time", date("H:i", $Load["Time"]));
		$CTM_Template->Set("Payment_Status", $Status);
		$CTM_Template->Set("Payment_Amounts", $Load["Golds"]);
		$CTM_Template->Set("Payment_Bank", base64_decode($Load["Bank"]));
		$CTM_Template->Set("Payment_Type", $Load["Payment"]);
		$CTM_Template->Set("Payment_Date", $Load["Date"]);
		$CTM_Template->Set("Payment_Price", $Load["Price"]);
		$CTM_Template->Set("Payment_Master", $Load["Master"]);
		$CTM_Template->Set("Payment_Document", $Load["Document"]);
		$CTM_Template->Set("Payment_Message", @nl2br($CTM_BBCode->Replace(@base64_decode($Load["Text"]))));
		$CTM_Template->Set("Resp_List", $Return);
		$CTM_Template->Set("Payment_ID", $Load["Id"]);
		$CTM_Template->Set("%DELETE_BUTTON%" , $this->Privilegy($_PanelAdmin["Payment"]["Delete"], 1) == TRUE ? "&nbsp;<input type=\"button\" value=\"Deletar Pagamento\" onclick=\"Delete_Payment();\" />" : NULL);
		unset($Return);
	}
	private function Add_VIP()
	{
		if($_GET["cmd"] == TRUE)
		{
			$Account = $_POST["Account"];
			$Type = $_POST["Type"];
			$Time = $_POST["Time"];
			
			$findAccount = $this->Query("SELECT AccountID FROM ".MuGen_DB.".dbo.Character WHERE Name = '{$Account}' OR AccountID='{$Account}'");
			$rows = $this->NumRow($findAccount);
			$login = $this->Fetch($findAccount);
			
			$Check = $this->FetchQuery("SELECT ".VIP_Column.",".VIP_Time." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='{$login[0]}'");
			
			if(empty($Time))
			{
				$Time = 0;
			}
			if(empty($Account))
			{
				exit("<div class=\"warning-box\"> Digite a conta a receber o VIP</div>");
			}
			elseif($rows < 1)
			{
				exit("<div class=\"error-box\"> Esta conta n&atilde;o existe.</div>");
			}
			elseif($Check[0] == 1)
			{
				if($Type == 2)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_1").".</div>");
				}
				elseif($Type == 3)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_1").".</div>");
				}
				elseif($Type == 4)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_1").".</div>");
				}
				elseif($Type == 5)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_1").".</div>");
				}
				else
				{
					$Define = FALSE;
				}
			}
			elseif($Check[0] == 2)
			{
				if($Type == 1)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_2").".</div>");
				}
				elseif($Type == 3)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_2").".</div>");
				}
				elseif($Type == 4)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_2").".</div>");
				}
				elseif($Type == 5)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_2").".</div>");
				}
				else
				{
					$Define = FALSE;
				}
			}
			elseif($Check[0] == 3)
			{
				if($Type == 1)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_3").".</div>");
				}
				elseif($Type == 2)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_3").".</div>");
				}
				elseif($Type == 4)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_3").".</div>");
				}
				elseif($Type == 5)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_3").".</div>");
				}
				else
				{
					$Define = FALSE;
				}
			}
			elseif($Check[0] == 4)
			{
				if($Type == 1)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_4").".</div>");
				}
				elseif($Type == 2)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_4").".</div>");
				}
				elseif($Type == 3)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_4").".</div>");
				}
				elseif($Type == 5)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_4").".</div>");
				}
				else
				{
					$Define = FALSE;
				}
			}
			elseif($Check[0] == 5)
			{
				if($Type == 1)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_5").".</div>");
				}
				elseif($Type == 2)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_5").".</div>");
				}
				elseif($Type == 3)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_5").".</div>");
				}
				elseif($Type == 4)
				{
					exit("<div class=\"warning-box\"> Est&aacute; conta se encontra ".constant("VIP_5").".</div>");
				}
				else
				{
					$Define = FALSE;
				}
			}
			if($Define == FALSE)
			{
				if($Check[1][0] == $Type)
				{
					$VIP_Time = strtotime(date("d-m-Y g:i a", $Check[1])." + ".$Time." days");
				}
				else
				{
					$VIP_Time = strtotime("+ ".$Time." days");
					$Begin = ",".VIP_Begin."=".strtotime("now")."";
				}
				$this->Query("UPDATE ".VIP_DB.".dbo.".VIP_Table." SET ".VIP_Column."={$Type},".VIP_Time."={$VIP_Time},".VIP_Credits."=".VIP_Credits."+{$Time}{$Begin} WHERE ".VIP_Login."='{$login[0]}'");
				exit("<div class=\"success-box\"> Adicionado <b>".$Time." dias</b> de <b>".constant("VIP_".$Type)."</b> na conta <b>".$login[0]."</b> com Sucesso!</div>");
			}
		}
	}
	private function Transform_VIP()
	{
		if($_GET["cmd"] == TRUE)
		{
			$Account = $_POST["Account"];
			$Type = $_POST["Type"];
			
			$findAccount = $this->Query("SELECT AccountID FROM ".MuGen_DB.".dbo.Character WHERE Name = '{$Account}' OR AccountID='{$Account}'");
			$rows = $this->NumRow($findAccount);
			$login = $this->Fetch($findAccount);
			
			$Check = $this->FetchQuery("SELECT ".VIP_Column.",".VIP_Time." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='{$login[0]}'");
			
			if(empty($Account))
			{
				exit("<div class=\"warning-box\"> Digite a conta</div>");
			}
			elseif($rows < 1)
			{
				exit("<div class=\"error-box\"> Esta conta n&atilde;o existe.</div>");
			}
			if($Check[0] < 1)
			{
				exit("<div class=\"warning-box\"> Est&aacute; conta n&atilde;o &eacute; VIP</div>");
			}
			else
			{
				$this->Query("UPDATE ".VIP_DB.".dbo.".VIP_Table." SET ".VIP_Column."={$Type} WHERE ".VIP_Login."='{$login[0]}'");
				exit("<div class=\"success-box\"> VIP alterado para <b>".constant("VIP_".$Type)."</b> com sucesso!</div></div>");
			}
		}
	}
	private function Delete_VIP()
	{
		if($_GET["cmd"] == TRUE)
		{
			$Account = $_POST["Account"];
			
			$findAccount = $this->Query("SELECT AccountID FROM ".MuGen_DB.".dbo.Character WHERE Name = '{$Account}' OR AccountID='{$Account}'");
			$rows = $this->NumRow($findAccount);
			$login = $this->Fetch($findAccount);
			
			$Check = $this->FetchQuery("SELECT ".VIP_Column." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='{$login[0]}'");
			
			if(empty($Time))
			{
				$Time = 0;
			}
			if(empty($Account))
			{
				exit("<div class=\"warning-box\"> Digite a conta</div>");
			}
			elseif($rows < 1)
			{
				exit("<div class=\"error-box\"> Esta conta n&atilde;o existe.</div>");
			}
			if($Check[0] < 1)
			{
				exit("<div class=\"warning-box\"> Est&aacute; conta n&atilde;o &eacute; VIP</div>");
			}
			else
			{
				$this->Query("UPDATE ".VIP_DB.".dbo.".VIP_Table." SET ".VIP_Column."=0,".VIP_Begin."=0,".VIP_Time."=0,".VIP_Credits."=0 WHERE ".VIP_Login."='{$login[0]}'");
				exit("<div class=\"success-box\"> VIP removido com sucesso!</div>");
			}
		}
	}
	private function Add_VIP_All_Accounts()
	{
		if($_GET["cmd"] == TRUE)
		{
			$Type = $_POST["Type"];
			$Time = $_POST["Time"];
			
			if(empty($Time))
			{
				$Time = 0;
			}
			if(empty($Type))
			{
				exit("<div class=\"warning-box\"> Selecione o Tipo de VIP.</div>");
			}
			else
			{
				$VIP_Time = strtotime("+ ".$Time." days");
				$Begin = ",".VIP_Begin."=".strtotime("now")."";
				$this->Query("UPDATE ".VIP_DB.".dbo.".VIP_Table." SET ".VIP_Column."={$Type},".VIP_Time."={$VIP_Time},".VIP_Credits."={$Time}{$Begin} WHERE ".VIP_Column."=0");
				exit("<div class=\"success-box\"> Adicionado <b>".$Time." dias</b> de <b>".constant("VIP_".$Type)."</b> em todas as contas Free do servidor com Sucesso!</div>");
			}
		}
	}
	private function Add_Cash()
	{
		global $CTM_General;
		
		if($_GET["cmd"] == TRUE)
		{
			$Account = $_POST["Account"];
			$Coin = $_POST["Coin"];
			$Cash = $_POST["Cash"];
			
			$findAccount = $this->Query("SELECT AccountID FROM ".MuGen_DB.".dbo.Character WHERE Name = '{$Account}' OR AccountID = '{$Account}'");
			$rows = $this->NumRow($findAccount);
			$login = $this->Fetch($findAccount);
			
			if(empty($Cash))
			{
				$Cash = 0;
			}
			if(empty($Coin))
			{
				exit("<div class=\"warning-box\"> Selecione a Moeda</div>");
			}
			if(empty($Account))
			{
				exit("<div class=\"warning-box\"> Digite a conta</div>");
			}
			elseif($rows < 1)
			{
				exit("<div class=\"error-box\"> Esta conta n&atilde;o existe.</div>");
			}
			else
			{
				$CTM_General->Check_Coin_Table($login[0]);
				$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".constant("GL_Column_".$Coin)."=".constant("GL_Column_".$Coin)."+{$Cash} WHERE ".GL_Login."='{$login[0]}'");
				exit("<div class=\"success-box\"> Adicionado <b>{$Cash} ".constant("Coin_".$Coin)."</b> na conta <b>{$Account}</b></div>");
			}
		}
	}
	private function Delete_Cash()
	{
		if($_GET["cmd"] == TRUE)
		{
			$Account = $_POST["Account"];
			$Cash = $_POST["Cash"];
			$Coin = $_POST["Coin"];
			
			$findAccount = $this->Query("SELECT AccountID FROM ".MuGen_DB.".dbo.Character WHERE Name = '{$Account}' OR AccountID = '{$Account}'");
			$rows = $this->NumRow($findAccount);
			$login = $this->Fetch($findAccount);
			
			$Check = $this->FetchQuery("SELECT ".constant("GL_Column_".$Coin)." FROM ".GL_DB.".dbo.".GL_Table." WHERE ".GL_Login."='{$login[0]}'");
			
			if(empty($Cash))
			{
				$Cash = 0;
			}
			if(empty($Coin))
			{
				exit("<div class=\"warning-box\"> Selecione a moeda</div>");
			}
			if(empty($Account))
			{
				exit("<div class=\"warning-box\"> Digite a conta</div>");
			}
			elseif($rows < 1)
			{
				exit("<div class=\"error-box\"> Esta conta n&atilde;o existe.</div>");
			}
			elseif($Check[0] < $Cash)
			{
				exit("<div class=\"info-box\"> Est&aacute; conta n&atilde;o contem ".constant("Coin_".$Coin)."</div>");
			}
			else
			{
				$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".constant("GL_Column_".$Coin)."=".constant("GL_Column_".$Coin)."-{$Cash} WHERE ".GL_Login."='{$login[0]}'");
				exit("<div class=\"success-box\"> Removido <b>{$Cash} ".constant("Coin_".$Coin)."</b> da conta <b>{$Account}</b></div>");
			}
		}
	}
	private function SQL_Backup()
	{
		global $CTM_Template;
		
		if($_GET["cmd"] == TRUE)
		{
			$DataBase = $_POST["DataBase"];
			$Directory = str_replace("\\", "/", $_POST["Directory"]);
			$Name = $_POST["File_Name"];
			
			if(empty($DataBase))
			{
				exit("<div class=\"warning-box\"> Selecione a DataBase a ser Salva</div>");
			}
			elseif(file_exists($Directory) == FALSE)
			{
				exit("<div class=\"error-box\"> Esse diret&oacute;rio n&atilde;o existe.</div>");
			}
			else
			{
				$this->Query("BACKUP DATABASE [".$DataBase."] TO  DISK = N'".$Directory.$DataBase." - ".$Name."' WITH NOFORMAT, NOINIT,  NAME = N'".$DataBase."-Full Database Backup', SKIP, NOREWIND, NOUNLOAD,  STATS = 10");
				exit("<div class=\"success-box\"> Backup da DataBase <b>".$DataBase."</b> efetuado com Sucesso!</div>");
			}
		}
		$Query = $this->Query("exec sp_databases");
		while($Load = $this->Fetch($Query))
		{
			$Size = $Load[1];
		
			if (1048576 < $Size)
			{
				$Size = round($Size / 1048576, 3)." Gb";
			}
			elseif (1024 < $real_size)
			{
				$Size = round($Size / 1024, 3)." Mb";
			}
			$Return .= "<option value=\"{$Load[0]}\">".$Load[0]." (".$Size.")</option>\n";
		}
		$CTM_Template->Set("DataBase_List", $Return);
		$CTM_Template->Set("File_Date", date("d-m-Y"));
	}
	private function EffectWeb_CheckUpdate()
	{
		global $CTM_Crypt, $CTM_Template, $Update_Key;
		
		$Link .= $CTM_Crypt->Update_Server[constant("Server_Location")]."/";
		$Link .= constant("Product_ID")."/".$CTM_Crypt->Key_System.".php?key=".bin2hex($Update_Key);
		
		$CTM_cURL = new CTM_cURL("http://".$Link);
		$CTM_cURL->SetOPT("Timeout", 10);
		$CTM_cURL->SetOPT("Return");
		
		if(
		$CTM_cURL->Info_cURL("File_Exists") <> 200 ||
		$CTM_cURL->Info_cURL("File_Exists") == 404 ||
		$CTM_cURL->Exec_cURL() == "FALSE")
		{
			exit("<div class=\"success-box\"> Sua vers&atilde;o da Effect Web &eacute; a atual (".base64_decode(Web_Version).").</div>");
		}
		else
		{
			eval(base64_decode($CTM_cURL->Exec_cURL()));
			
			$CTM_Template->Set("%UPDATE[New_Version]%", $CTM_Version["New_Version"]);
			$CTM_Template->Set("%UPDATE[Release_Date]%", $CTM_Version["Release_Date"]);
			$CTM_Template->Set("%UPDATE[ChangeLog]%", nl2br(base64_decode($CTM_Version["ChangeLog"])));
			$CTM_Template->Set("%UPDATE[Link_Topic]%", $CTM_Version["Link_Topic"]);
			$CTM_Template->Set("%UPDATE[Link_ChangeLog]%", $CTM_Version["Link_ChangeLog"]);
		}
	}
}
endif;
?>