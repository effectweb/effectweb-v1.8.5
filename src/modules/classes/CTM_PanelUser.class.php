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

if(!class_exists("CTM_PanelUser")) :

class CTM_PanelUser extends CTM_MSSQL
{
	private $Login = NULL;
	private $Error = NULL;
	private $Points = NULL;
	private $Selected = NULL;
	private $Set_Points = array();
	
	public function __construct()
	{
		global $CTM_General, $CTM_Template, $_Panel, $_PmSystem, $_PAGSEGURO;
		$this->Login = $_SESSION["Hash_Account"];
		
		$CTM_PagSeguro = new CTM_PagSeguro();
		define("PAGSEGURO_ENABLE", $CTM_PagSeguro->CheckModule() && $_Panel['Financial']['PagSeguro'][0] == 1);
		
		$CTMT = "templates/".$CTM_Template->Open()."/pages/";
		switch(strtoupper($_GET["str"]))
		{
			case "CHAR_DIV" :
			$this->Char_Div();
			$CTM_Template->Load($CTMT."paneluser[CHAR_DIV].pag.php");
			break;
			/*case "PM_DIV" :
			$this->PM_Div();
			$CTM_Template->Load($CTMT."paneluser[PM_DIV].pag.php");
			break;*/
			case "HOME" : 
			$this->Home();
			$CTM_Template->Load($CTMT."paneluser[HOME].pag.php");
			break;
			case "ACCOUNT" :
			$this->OptionEnable($_Panel["Account"]["Dates"]);
			$this->Privilegy($_Panel["Account"]["Dates"]);
			$this->ConnectStat();
			$this->Account();
			$CTM_Template->Load($CTMT."paneluser[ACCOUNT].pag.php");
			break;
			case "CHANGE_PID" :
			$this->OptionEnable($_Panel["Account"]["Change_PID"]);
			$this->ConnectStat();
			$this->Change_PID();
			$CTM_Template->Load($CTMT."paneluser[CHANGE_PID].pag.php");
			break;
			case "CHANGE_MAIL" :
			$this->OptionEnable($_Panel["Account"]["Change_Mail"]);
			$this->Privilegy($_Panel["Account"]["Change_Mail"]);
			$this->ConnectStat();
			$this->Change_Mail();
			break;
			case "SELECT_CHAR" :
			$this->Manage_Char();
			$CTM_Template->Load($CTMT."paneluser[SELECT_CHAR].pag.php");
			break;
			case "ALT_VAULT" :
			$this->OptionEnable($_Panel["Account"]["Alt_Vault"]);
			$this->Privilegy($_Panel["Account"]["Alt_Vault"]);
			$this->ConnectStat();
			$this->Alt_Vault();
			$CTM_Template->Load($CTMT."paneluser[ALT_VAULT].pag.php");
			break;
			/*case "REPAIR_VAULT" :
			$this->OptionEnable($_Panel["Account"]["Repair_Vault"]);
			$this->Privilegy($_Panel["Account"]["Repair_Vault"]);
			$this->ConnectStat();
			$this->Repair_Vault();
			$CTM_Template->Load($CTMT."paneluser[REPAIR_VAULT].pag.php");
			break;*/
			case "CONNECTS" :
			$this->OptionEnable($_Panel["Account"]["Connects"]);
			$this->Privilegy($_Panel["Account"]["Connects"]);
			$this->Connects();
			$CTM_Template->Load($CTMT."paneluser[CONNECTS].pag.php");
			break;
			case "ADD_SCREEN" :
			$this->OptionEnable($_Panel["Account"]["ScreenShots"]);
			$this->Privilegy($_Panel["Account"]["ScreenShots"]);
			$this->Add_ScreenShot();
			$CTM_Template->Load($CTMT."paneluser[ADD_SCREEN].pag.php");
			break;
			case "DELETE_SCREEN" :
			$this->OptionEnable($_Panel["Account"]["ScreenShots"]);
			$this->Privilegy($_Panel["Account"]["ScreenShots"]);
			$this->Delete_ScreenShot();
			$CTM_Template->Load($CTMT."paneluser[DELETE_SCREEN].pag.php");
			break;
			/*case "PM_ENTER" :
			$this->OptionEnable($_Panel["Account"]["PM_System"]);
			$this->Privilegy($_Panel["Account"]["PM_System"]);
			$this->PM_Enter();
			$CTM_Template->Load($CTMT."paneluser[PM_ENTER].pag.php");
			break;
			case "PM_EXIT" :
			$this->OptionEnable($_Panel["Account"]["PM_System"]);
			$this->Privilegy($_Panel["Account"]["PM_System"]);
			$this->PM_Exit();
			$CTM_Template->Load($CTMT."paneluser[PM_EXIT].pag.php");
			break;
			case "READ_PM" :
			$this->OptionEnable($_Panel["Account"]["PM_System"]);
			$this->Privilegy($_Panel["Account"]["PM_System"]);
			$this->ConnectStat();
			$this->Read_PM();
			$CTM_Template->Load($CTMT."paneluser[READ_PM].pag.php");
			break;
			case "SEND_PM" :
			$this->OptionEnable($_Panel["Account"]["PM_System"]);
			$this->Privilegy($_Panel["Account"]["PM_System"]);
			$this->ConnectStat();
			$this->Send_PM();
			$CTM_Template->Load($CTMT."paneluser[SEND_PM].pag.php");
			break;*/
			case "REFERENCE_LINK" :
			$this->OptionEnable($_Panel["Account"]["ReferenceLink"]);
			$this->Privilegy($_Panel["Account"]["ReferenceLink"]);
			$this->NewFinal_ReferenceLink();
			$CTM_Template->Load($CTMT."paneluser[REFERENCE_LINK].pag.php");
			break;
			case "MANAGE_CHAR" :
			$this->CheckCharSelected();
			$this->Show_Char();
			$CTM_Template->Load($CTMT."paneluser[MANAGE_CHAR].pag.php");
			break;
			case "RESET_CHAR" :
			$this->OptionEnable($_Panel["Char"]["Reset"]);
			$this->Privilegy($_Panel["Char"]["Reset"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->ResetSystem();
			$CTM_Template->Load($CTMT."paneluser[RESET_CHAR].pag.php");
			break;
			case "MASTER_RESET" :
			$this->OptionEnable($_Panel["Char"]["MReset"]);
			$this->Privilegy($_Panel["Char"]["MReset"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->MasterReset();
			$CTM_Template->Load($CTMT."paneluser[MASTER_RESET].pag.php");
			break;
			case "TRANSFER_RESETS" :
			$this->OptionEnable($_Panel["Char"]["Transfer_Resets"]);
			$this->Privilegy($_Panel["Char"]["Transfer_Resets"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Transfer_Resets();
			$CTM_Template->Load($CTMT."paneluser[TRANSFER_RESETS].pag.php");
			break;
			case "TRADE_RCASH" :
			$this->OptionEnable($_Panel["Char"]["Trade_RCash"]);
			$this->Privilegy($_Panel["Char"]["Trade_RCash"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Trade_ResetsCash();
			$CTM_Template->Load($CTMT."paneluser[TRADE_RCASH].pag.php");
			break;
			case "CLEAR_PK" :
			$this->OptionEnable($_Panel["Char"]["Clear_PK"]);
			$this->Privilegy($_Panel["Char"]["Clear_PK"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Clear_PK();
			$CTM_Template->Load($CTMT."paneluser[CLEAR_PK].pag.php");
			break;
			case "CHANGE_CLASS" :
			$this->OptionEnable($_Panel["Char"]["Change_Class"]);
			$this->Privilegy($_Panel["Char"]["Change_Class"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Change_Class();
			$CTM_Template->Load($CTMT."paneluser[CHANGE_CLASS].pag.php");
			break;
			case "CHANGE_NICK" :
			$this->OptionEnable($_Panel["Char"]["Change_Nick"]);
			$this->Privilegy($_Panel["Char"]["Change_Nick"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Change_Nick();
			$CTM_Template->Load($CTMT."paneluser[CHANGE_NICK].pag.php");
			break;
			case "MOVE_CHAR" :
			$this->OptionEnable($_Panel["Char"]["Move_Char"]);
			$this->Privilegy($_Panel["Char"]["Move_Char"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Move_Char();
			$CTM_Template->Load($CTMT."paneluser[MOVE_CHAR].pag.php");
			break;
			case "PROFILE_CHAR" :
			$this->OptionEnable($_Panel["Char"]["Profile_Char"]);
			$this->Privilegy($_Panel["Char"]["Profile_Char"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Profile_Char();
			$CTM_Template->Load($CTMT."paneluser[PROFILE_CHAR].pag.php");
			break;
			case "UPLOAD_IMG" :
			$this->OptionEnable($_Panel["Char"]["Upload_Img"]);
			$this->Privilegy($_Panel["Char"]["Upload_Img"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Upload_Img();
			$CTM_Template->Load($CTMT."paneluser[UPLOAD_IMG].pag.php");
			break;
			case "CONCERT_POINTS" :
			$this->OptionEnable($_Panel["Char"]["Concert_Points"]);
			$this->Privilegy($_Panel["Char"]["Concert_Points"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Concert_Points();
			$CTM_Template->Load($CTMT."paneluser[CONCERT_POINTS].pag.php");
			break;
			case "RESET_POINTS" :
			$this->OptionEnable($_Panel["Char"]["Reset_Points"]);
			$this->Privilegy($_Panel["Char"]["Reset_Points"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Reset_Points();
			$CTM_Template->Load($CTMT."paneluser[RESET_POINTS].pag.php");
			break;
			case "DISTRIBUTE_POINTS" :
			$this->OptionEnable($_Panel["Char"]["Distribute_Points"]);
			$this->Privilegy($_Panel["Char"]["Distribute_Points"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Distribute_Points();
			$CTM_Template->Load($CTMT."paneluser[DISTRIBUTE_POINTS].pag.php");
			break;
			case "CLEAR_CHAR" :
			$this->OptionEnable($_Panel["Char"]["Clear_Char"]);
			$this->Privilegy($_Panel["Char"]["Clear_Char"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Clear_Char();
			$CTM_Template->Load($CTMT."paneluser[CLEAR_CHAR].pag.php");
			break;
			/*case "REPAIR_INVENTORY" :
			$this->OptionEnable($_Panel["Char"]["Repair_Inventory"]);
			$this->Privilegy($_Panel["Char"]["Repair_Inventory"]);
			$this->CheckCharSelected();
			$this->ConnectStat();
			$this->Repair_Inventory();
			$CTM_Template->Load($CTMT."paneluser[REPAIR_INVENTORY].pag.php");
			break;*/
			case "CLOSE_CHAR" :
			$_SESSION["Web_ManageChar"] = NULL;
			unset($_SESSION["Web_ManageChar"]);
			exit("<script>CTM_Load('?pag=paneluser','conteudo','GET');</script>");
			break;
			case "TICKETS" :
			$this->OptionEnable($_Panel["Suportt"]["Tickets"]);
			$this->Open_Ticket();
			$CTM_Template->Load($CTMT."paneluser[TICKETS].pag.php");
			break;
			case "VIEW_TICKET" :
			$this->OptionEnable($_Panel["Suportt"]["Tickets"]);
			$this->Resp_Ticket();
			$CTM_Template->Load($CTMT."paneluser[VIEW_TICKET].pag.php");
			break;
			case "PAYMENTS" :
			$this->OptionEnable($_Panel["Financial"]["Payments"]);
			$this->Confirm_Payment();
			$CTM_Template->Load($CTMT."paneluser[PAYMENTS].pag.php");
			break;
			case "VIEW_PAYMENT" :
			$this->OptionEnable($_Panel["Financial"]["Payments"]);
			$this->Resp_Payment();
			$CTM_Template->Load($CTMT."paneluser[VIEW_PAYMENT].pag.php");
			break;
			case "TRADE_AMOUNT" :
			$this->OptionEnable($_Panel["Financial"]["Trade_Amount"]);
			$this->ConnectStat();
			$this->Trade_Amount();
			$CTM_Template->Load($CTMT."paneluser[TRADE_AMOUNT].pag.php");
			break;
			case "BUY_VIP" :
			$this->OptionEnable($_Panel["Financial"]["Buy_VIP"]);
			$this->ConnectStat();
			$this->Buy_VIP();
			$CTM_Template->Load($CTMT."paneluser[BUY_VIP].pag.php");
			break;
			case "PAGSEGURO" :
			if(!PAGSEGURO_ENABLE)
				$_Panel["Financial"]["PagSeguro"][0] = 0;
				
			$this->OptionEnable($_Panel["Financial"]["PagSeguro"]);
			
			$CTM_Template->Set("%MAIL_RECEIVER%", $_PAGSEGURO['MAIL_RECEIVER']);
			$CTM_Template->Set("%USER_LOGIN%", $this->Login);
			$CTM_Template->Load($CTMT."paneluser[PAGSEGURO].pag.php");
			break;
			default :
			$this->General_Nav();
			$CTM_Template->Load($CTMT."paneluser.pag.php"); 
			break;
		}
	}
	private function General_Nav()
	{
		global $CTM_General, $CTM_Template, $_Panel;
		
		echo("<script src=\"modules/header/javascripts/functions.js\"></script>
		<span style=\"display:none;\" id=\"VIP_1\">".constant("VIP_1")."</span>
		<span style=\"display:none;\" id=\"VIP_2\">".constant("VIP_2")."</span>\n\r");
		
		if(strtoupper($_GET["option"]) == TRUE)
		{
			$Navigator = $_GET["option"];
		}
		else
		{
			$Navigator = "HOME";	
		}
		
		$CTM_Template->Set("Account_Dates#1", $_Panel["Account"]["Dates"][1]);
		$CTM_Template->Set("Account_Dates#2", $_Panel["Account"]["Dates"][2]);
		$CTM_Template->Set("Account_Dates#3", $_Panel["Account"]["Dates"][3]);
		$CTM_Template->Set("Account_Change_Mail#1", $_Panel["Account"]["Change_Mail"][1]);
		$CTM_Template->Set("Account_Change_Mail#2", $_Panel["Account"]["Change_Mail"][2]);
		$CTM_Template->Set("Account_Change_Mail#3", $_Panel["Account"]["Change_Mail"][3]);
		$CTM_Template->Set("Account_Alt_Vault#1", $_Panel["Account"]["Alt_Vault"][1]);
		$CTM_Template->Set("Account_Alt_Vault#2", $_Panel["Account"]["Alt_Vault"][2]);
		$CTM_Template->Set("Account_Alt_Vault#3", $_Panel["Account"]["Alt_Vault"][3]);
		//$CTM_Template->Set("Account_Repair_Vault#1", $_Panel["Account"]["Repair_Vault"][1]);
		//$CTM_Template->Set("Account_Repair_Vault#2", $_Panel["Account"]["Repair_Vault"][2]);
		//$CTM_Template->Set("Account_Repair_Vault#3", $_Panel["Account"]["Repair_Vault"][3]);
		$CTM_Template->Set("Account_Connects#1", $_Panel["Account"]["Connects"][1]);
		$CTM_Template->Set("Account_Connects#2", $_Panel["Account"]["Connects"][2]);
		$CTM_Template->Set("Account_Connects#3", $_Panel["Account"]["Connects"][3]);
		$CTM_Template->Set("Account_ScreenShots#1", $_Panel["Account"]["ScreenShots"][1]);
		$CTM_Template->Set("Account_ScreenShots#2", $_Panel["Account"]["ScreenShots"][2]);
		$CTM_Template->Set("Account_ScreenShots#3", $_Panel["Account"]["ScreenShots"][3]);
		$CTM_Template->Set("Suportt_Tickets#1", $_Panel["Suportt"]["Tickets"][1]);
		$CTM_Template->Set("Suportt_Tickets#2", $_Panel["Suportt"]["Tickets"][2]);
		$CTM_Template->Set("Suportt_Tickets#3", $_Panel["Suportt"]["Tickets"][3]);
		
		$CTM_Template->Set("Character_Manage", $_SESSION["Web_ManageChar"] ? "<script>CTM_Load('?pag=paneluser&str=CHAR_DIV','Char_Div','GET');</script>" : NULL);
		/*$CTM_Template->Set("PmSystem_Panel", $_PmSystem["Enable"] == TRUE && $_PmSystem["Mode"] == 0 ? "<script>CTM_Load('?pag=paneluser&str=PM_DIV','PM_Div','GET');</script>" : NULL);*/
		
		$CTM_Template->Set("Panel_Navigator", "<script>CTM_Load('?pag=paneluser&str=".$Navigator."','Panel_Nav','GET');</script>");
	}
	private function Char_Div()
	{
		global $CTM_Template, $_Panel;
		
		echo("<script src=\"modules/header/javascripts/functions.js\"></script>\n\r");
		
		$CTM_Template->Set("Manage_Char", $_SESSION["Web_ManageChar"]);
		$CTM_Template->Set("Char_Reset#1", $_Panel["Char"]["Reset"][1]);
		$CTM_Template->Set("Char_Reset#2", $_Panel["Char"]["Reset"][2]);
		$CTM_Template->Set("Char_Reset#3", $_Panel["Char"]["Reset"][3]);
		$CTM_Template->Set("Char_MReset#1", $_Panel["Char"]["MReset"][1]);
		$CTM_Template->Set("Char_MReset#2", $_Panel["Char"]["MReset"][2]);
		$CTM_Template->Set("Char_MReset#3", $_Panel["Char"]["MReset"][3]);
		$CTM_Template->Set("Char_TReset#1", $_Panel["Char"]["Transfer_Resets"][1]);
		$CTM_Template->Set("Char_TReset#2", $_Panel["Char"]["Transfer_Resets"][2]);
		$CTM_Template->Set("Char_TReset#3", $_Panel["Char"]["Transfer_Resets"][3]);
		$CTM_Template->Set("Char_TRCash#1", $_Panel["Char"]["Trade_RCash"][1]);
		$CTM_Template->Set("Char_TRCash#2", $_Panel["Char"]["Trade_RCash"][2]);
		$CTM_Template->Set("Char_TRCash#3", $_Panel["Char"]["Trade_RCash"][3]);
		$CTM_Template->Set("Char_Clear_PK#1", $_Panel["Char"]["Clear_PK"][1]);
		$CTM_Template->Set("Char_Clear_PK#2", $_Panel["Char"]["Clear_PK"][2]);
		$CTM_Template->Set("Char_Clear_PK#3", $_Panel["Char"]["Clear_PK"][3]);
		$CTM_Template->Set("Char_Change_Class#1", $_Panel["Char"]["Change_Class"][1]);
		$CTM_Template->Set("Char_Change_Class#2", $_Panel["Char"]["Change_Class"][2]);
		$CTM_Template->Set("Char_Change_Class#3", $_Panel["Char"]["Change_Class"][3]);
		$CTM_Template->Set("Char_Change_Nick#1", $_Panel["Char"]["Change_Nick"][1]);
		$CTM_Template->Set("Char_Change_Nick#2", $_Panel["Char"]["Change_Nick"][2]);
		$CTM_Template->Set("Char_Change_Nick#3", $_Panel["Char"]["Change_Nick"][3]);
		$CTM_Template->Set("Char_Move_Char#1", $_Panel["Char"]["Move_Char"][1]);
		$CTM_Template->Set("Char_Move_Char#2", $_Panel["Char"]["Move_Char"][2]);
		$CTM_Template->Set("Char_Move_Char#3", $_Panel["Char"]["Move_Char"][3]);
		$CTM_Template->Set("Char_Profile_Char#1", $_Panel["Char"]["Profile_Char"][1]);
		$CTM_Template->Set("Char_Profile_Char#2", $_Panel["Char"]["Profile_Char"][2]);
		$CTM_Template->Set("Char_Profile_Char#3", $_Panel["Char"]["Profile_Char"][3]);
		$CTM_Template->Set("Char_Upload_Img#1", $_Panel["Char"]["Upload_Img"][1]);
		$CTM_Template->Set("Char_Upload_Img#2", $_Panel["Char"]["Upload_Img"][2]);
		$CTM_Template->Set("Char_Upload_Img#3", $_Panel["Char"]["Upload_Img"][3]);
		$CTM_Template->Set("Char_Concert_Points#1", $_Panel["Char"]["Concert_Points"][1]);
		$CTM_Template->Set("Char_Concert_Points#2", $_Panel["Char"]["Concert_Points"][2]);
		$CTM_Template->Set("Char_Concert_Points#3", $_Panel["Char"]["Concert_Points"][3]);
		$CTM_Template->Set("Char_Reset_Points#1", $_Panel["Char"]["Reset_Points"][1]);
		$CTM_Template->Set("Char_Reset_Points#2", $_Panel["Char"]["Reset_Points"][2]);
		$CTM_Template->Set("Char_Reset_Points#3", $_Panel["Char"]["Reset_Points"][3]);
		$CTM_Template->Set("Char_Distribute_Points#1", $_Panel["Char"]["Distribute_Points"][1]);
		$CTM_Template->Set("Char_Distribute_Points#2", $_Panel["Char"]["Distribute_Points"][2]);
		$CTM_Template->Set("Char_Distribute_Points#3", $_Panel["Char"]["Distribute_Points"][3]);
		$CTM_Template->Set("Char_Clear_Char#1", $_Panel["Char"]["Clear_Char"][1]);
		$CTM_Template->Set("Char_Clear_Char#2", $_Panel["Char"]["Clear_Char"][2]);
		$CTM_Template->Set("Char_Clear_Char#3", $_Panel["Char"]["Clear_Char"][3]);
		//$CTM_Template->Set("Char_Repair_Inventory#1", $_Panel["Char"]["Repair_Inventory"][1]);
		//$CTM_Template->Set("Char_Repair_Inventory#2", $_Panel["Char"]["Repair_Inventory"][2]);
		//$CTM_Template->Set("Char_Repair_Inventory#3", $_Panel["Char"]["Repair_Inventory"][3]);
		
		$CTM_Template->Set("%TRADE_RCOIN%", constant("Coin_".$_Panel["Char"]["Trade_RCash"]["Coin"]));
		$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/paneluser[CHAR_DIV].pag.php");
	}
	/*private function PM_Div()
	{
		global $CTM_Template, $_PmSystem, $_Panel;
		
		echo("<script src=\"modules/header/javascripts/functions.js\"></script>\n\r");
		
		/*************************************
			@ Private Message System
			@ Notifications
			@ By: Erick-Master
		**************************************
		
		if($_PmSystem["Enable"] == TRUE)
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
				$CTM_Template->Set("@_Msg", $Count_PM[0] > 0 ? "<span class=\"colr\">(".$Count_PM[0].")</span></b>" : NULL);
				$CTM_Template->Set("@_Span", $Count_PM[0] > 0 ? "<b>" : NULL);

				$CTM_Template->Set("Account_PmSystem#1", $_Panel["Account"]["PM_System"][1]);
				$CTM_Template->Set("Account_PmSystem#2", $_Panel["Account"]["PM_System"][2]);
				$CTM_Template->Set("Account_PmSystem#3", $_Panel["Account"]["PM_System"][3]);
				
			}
			else
			{
				return "&nbsp;";
			}
		}
		else
		{
			return "&nbsp;";
		}
	}*/
	private function OptionEnable($Option)
	{	
		if($Option[0] != 1)
		{
			exit("<div class=\"info-box\"> Esta op&ccedil;&atilde;o se encontra Desativada</div>");
		}
	}
	private function Privilegy($Option)
	{
		$Query = $this->FetchQuery("SELECT ".VIP_Column." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='".$this->Login."'");
		$Query = $Query[0] + 1;
		
		if($Option[$Query] <> 1)
			exit("<div class=\"info-box\"> Voc&ecirc; n&atilde;o tem privilegio para Acessar est&aacute; op&ccedil;&atilde;o</div>");
		else return NULL;
		/*
		if($Option[1] == 1)
		{
			if($Query[0] < 0)
			{
				$Return = TRUE;
			}
			else
			{
				$Return = FALSE;
			}
		}
		elseif($Option[2] == 1)
		{
			if($Query[0] < 1)
			{
				$Return = TRUE;
			}
			else
			{
				$Return = FALSE;
			}
		}
		elseif($Option[3] == 1)
		{
			if($Query[0] < 2)
			{
				$Return = TRUE;
			}
			else
			{
				$Return = FALSE;
			}
		}
		elseif($Option[4] == 1)
		{
			if($Query[0] < 3)
			{
				$Return = TRUE;
			}
			else
			{
				$Return = FALSE;
			}
		}
		elseif($Option[5] == 1)
		{
			if($Query[0] < 4)
			{
				$Return = TRUE;
			}
			else
			{
				$Return = FALSE;
			}
		}
		elseif($Option[6] == 1)
		{
			if($Query[0] < 5)
			{
				$Return = TRUE;
			}
			else
			{
				$Return = FALSE;
			}
		}
		else
		{
			$Return = TRUE;
		}
		return $Return == TRUE ? exit("<div class=\"info-box\"> Voc&ecirc; n&atilde;o tem privilegio para Acessar est&aacute; op&ccedil;&atilde;o</div>") : NULL;*/
	}
	private function ConnectStat()
	{
		$Check = $this->FetchQuery("SELECT ConnectStat FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE memb___id='".$this->Login."'");
		if($Check[0] == 1)
		{
			exit("<div class=\"info-box\"> Deslogue sua conta para usar essa op&ccedil;&atilde;o!</div>");
		}
	}
	private function CheckCharSelected()
	{
		$check = 0;
		
		if(!isset($_SESSION["Web_ManageChar"])) $check++;
		if(empty($_SESSION["Web_ManageChar"])) $check++;
		if(!$_SESSION["Web_ManageChar"]) $check++;
		
		if($check == 0)
		{
			$_SESSION["Web_ManageChar"] = preg_replace("/('|\"|;)/i", NULL, $_SESSION["Web_ManageChar"]);
			return TRUE;
		}
		else
		{
			exit("<script>CTM_Load('?pag=paneluser&str=SELECT_CHAR','Panel_Nav','GET');</script>");
			return FALSE;
		}
	}
	private function WriteLog($log, $text = FALSE)
	{
		global $version, $_Panel;
		
		if(ENABLE_PANELUSER_LOGS == TRUE)
		{
			switch($log)
			{
				case "ACCOUNT" :
					$option = "Alterar Dados";
					$_char = FALSE;
				break;
				case "CHANGE_PID" :
					$option = "Alterar Personal ID";
					$_char = FALSE;
				break;
				case "CHANGE_MAIL" :
					$option = "Alterar E-Mail";
					$_char = FALSE;
				break;
				case "ALT_VAULT" :
					$option = "Alterar Ba&uacute;";
					$_char = FALSE;
				break;
				case "CONNECTS" :
					$option = "Conex&otilde;es Recentes";
					$_char = FALSE;
				break;
				case "ADD_SCREEN" :
					$option = "Adicionar ScreenShot";
					$_char = FALSE;
				break;
				case "DELETE_SCREEN" :
					$option = "Deletar ScreenShot";
					$_char = FALSE;
				break;
				case "RESET_CHAR" :
					$option = "Resetar Personagem";
					$_char = TRUE;
				break;
				case "MASTER_RESET" :
					$option = "Master Reset";
					$_char = TRUE;
				break;
				case "TRANSFER_RESETS" :
					$option = "Transferir Resets";
					$_char = TRUE;
				break;
				case "TRADE_RCASH" :
					$option = "Trocar Resets por ".constant("Coin_".$_Panel["Char"]["Trade_RCash"]["Coin"]);
					$_char = TRUE;
				break;
				case "CLEAR_PK" :
					$option = "Limpar PK/Hero";
					$_char = TRUE;
				break;
				case "CHANGE_CLASS" :
					$option = "Alterar Classe";
					$_char = TRUE;
				break;
				case "CHANGE_NICK" :
					$option = "Alterar Nick";
					$_char = TRUE;
				break;
				case "MOVE_CHAR" :
					$option = "Mover Personagem";
					$_char = TRUE;
				break;
				case "PROFILE_CHAR" :
					$option = "Gerenciar Perfil";
					$_char = TRUE;
				break;
				case "UPLOAD_IMG" :
					$option = "Gerenciar Imagem";
					$_char = TRUE;
				break;
				case "CONCERT_POINTS" :
					$option = "Concertar Pontos";
					$_char = TRUE;
				break;
				case "RESET_POINTS" :
					$option = "Resetar Pontos";
					$_char = TRUE;
				break;
				case "DISTRIBUTE_POINTS" :
					$option = "Distribuir Pontos";
					$_char = TRUE;
				break;
				case "CLEAR_CHAR" :
					$option = "Limpar Personagem";
					$_char = TRUE;
				break;
				case "REFERENCE_LINK" :
					$option = "Link de Refer&ecirc;ncia";
					$_char = TRUE;
				break;
				case "TICKETS" :
					$option = "Tickets";
					$_char = TRUE;
				break;
				case "PAYMENTS" :
					$option = "Pagamentos";
					$_char = TRUE;
				break;
				case "TRADE_AMOUNT" :
					$option = "Trocar Moedas";
					$_char = TRUE;
				break;
				case "BUY_VIP" :
					$option = "Comprar VIP";
					$_char = TRUE;
				break;
				case "PAGSEGURO" :
					$option = "PagSeguro";
					$_char = TRUE;
				break;
			}
			
			if(!file_exists("modules/Logs/CTM_PanelUser/".date("d-m-Y").".htm"))
			{
				$begin = "*******************************************<br />\r\n";
				$begin .= "* Effect Web ".$version->getVersion("full")."<br />\r\n";
				$begin .= "* Painel de Controle (User)<br />\r\n";
				$begin .= "* Powered by Erick-Master<br />\r\n";
				$begin .= "* CTM Teaa Softwares<br />\r\n";
				$begin .= "* www.ctmts.com.br<br />\r\n";
				$begin .= "*******************************************<br />\r\n";
			}
			
			$write = $begin;
			$write .= "&raquo; [".date("H:i:s")."] ";
			$write .= "<b>[".$this->Login.($_char == true ? " - ".$_SESSION["Web_ManageChar"] : NULL)."]</b> Utilizando a op&ccedil;&atilde;o: <strong>".$option."</strong>.";
			
			if($text)
				$write .= " [".$text."]";
				
			$write .= "<br />\r\n";
			
			$fp = @fopen("modules/Logs/CTM_PanelUser/".date("d-m-Y").".htm", "a+");
			@fwrite($fp, $write);
			@fclose($fp);
		}
	}
	private function Home()
	{
		global $CTM_General, $CTM_Template;
		
		$Query = $this->Query("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='".$_SESSION["Hash_Account"]."'");
		$Load = $this->FetchArray($Query);
		$VIP = $this->FetchQuery("SELECT ".VIP_Column.",".VIP_Time.",".VIP_Begin." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='".$_SESSION["Hash_Account"]."'");
		$Cash = $this->FetchQuery("SELECT ".GL_Column_1.",".GL_Column_2.",".GL_Column_3." FROM ".GL_DB.".dbo.".GL_Table." WHERE ".GL_Login."='".$_SESSION["Hash_Account"]."'");
		
		$CTM_Template->Set("Memb#Id", "#".$Load["memb_guid"]);
		$CTM_Template->Set("Memb#Account", $Load["memb___id"]);
		$CTM_Template->Set("Memb#Coin_1", $Cash[0]);
		$CTM_Template->Set("Memb#Coin_2", $Cash[1]);
		$CTM_Template->Set("Memb#Coin_3", $Cash[2]);
		$CTM_Template->Set("Memb#Type", $CTM_General->Memb_Type($VIP[0]));
		$CTM_Template->Set("Memb#VIP_Begin", $CTM_General->VIP(1, $Load["memb___id"]));
		$CTM_Template->Set("Memb#VIP_End", $CTM_General->VIP(2, $Load["memb___id"]));
		$CTM_Template->Set("Memb#Birth", $Load["CTM_Birth"]);
	}
	private function Account()
	{
		global $CTM_Template, $CTM_Crypt;
		$CTM_Captcha = new CTM_Captcha();
		
		$Query = $this->Query("SELECT memb_name,tel__numb,mail_addr FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='".$_SESSION["Hash_Account"]."'");
		$Load = $this->Fetch($Query);
		
		$CTM_Template->Set("Account_Name", $Load[0]);
		$CTM_Template->Set("Account_Phone", $Load[1]);
		$CTM_Template->Set("Account_Mail", $Load[2]);
		$CTM_Template->Set("Captcha_Image", "?public=captcha");
		
		if($_GET["cmd"] == "account")
		{
			$Name = $_POST["Name"];
			$Phone = $_POST["Phone"];
			
			if(empty($Name)) { $this->Error .= "&raquo; Nome<br />\n"; }
			if(empty($Phone)) { $this->Error .= "&raquo; Telefone<br />\n"; }
			
			if($this->Error == TRUE)
			{
				exit("<div class=\"warning-box\"> Os seguintes campos devem ser Preenchidos:<br /><br />{$this->Error}</div>");
			}
			else
			{
				$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET memb_name='{$Name}',tel__numb='{$Phone}',CTM_Sex='{$Sex}' WHERE memb___id='".$this->Login."'");
				$this->WriteLog("ACCOUNT", "Dados alterados");
				exit("<div class=\"success-box\"> Dados alterados com Sucesso</div>");
			}
		}
		if($_GET["cmd"] == "password")
		{
			$Old_Pwd = $_POST["Old_Password"];
			$Password = $_POST["Password"];
			$Re_Password = $_POST["Re_Password"];
			$Captcha = $_POST["Captcha"];
		
			$Check_Pwd = $this->FetchQuery("exec dbo.CTM_CheckLogin '".$this->Login."','".$Old_Pwd."',".USE_MD5."");
			
			if(empty($Old_Pwd)) { $this->Error[0] .= "&raquo; Senha Atual<br />\n"; }
			if(empty($Password)) { $this->Error[0] .= "&raquo; Senha<br />\n"; }
			if(empty($Re_Password)) { $this->Error[0] .= "&raquo; Confirma&ccedil;&atilde;o de Senha<br />\n"; }
			if(empty($Captcha)) { $this->Error[0] .= "&raquo; Codigo de Seguran&ccedil;a<br />\n"; }
			
			if($Check_Pwd[0] == 0) { $this->Error[1] .= "&raquo; Senha atual Incorreta<br />\n"; }
			if(eregi("[^a-zA-Z0-9_!=?&-]", $Password) || eregi("[^a-zA-Z0-9_!=?&-]", $Re_Password)) { $this->Error[1] .= "&raquo; N&atilde;o use s&iacute;mbolos na Senha<br />"; }
			if(strlen($Password) < 4 || strlen($Re_Password) < 4) { $this->Error[1] .= "&raquo; Senha de no minimo Minimo 4 caracteres<br />\n"; }
			if($Password != $Re_Password) { $this->Error[1] .= "&raquo; Senhas n&atilde;o conferem<br />\n"; }
			if($CTM_Captcha->Check($Captcha) == FALSE) { $this->Error[1] .= "&raquo; Codigo de Seguran&ccedil;a incorreto<br />\n"; }
			
			if($this->Error[0] == TRUE)
			{
				exit("<div class=\"warning-box\"> Os seguintes campos devem ser Preenchidos:<br /><br />{$this->Error[0]}</div>");
			}
			elseif($this->Error[1] == TRUE)
			{
				exit("<div class=\"error-box\"> Os seguintes erros for&atilde;o encontrados:<br /><br />{$this->Error[1]}</div>");
			}
			else
			{
				if(USE_MD5 == 1)
				{
					$this->Query("exec dbo.CTM_CryptPwd '".$this->Login."','".$Password."'");
				}
				else
				{
					$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET memb__pwd='".$Password."' WHERE memb___id='".$this->Login."'");
				}
				$this->WriteLog("ACCOUNT", "Senha alterada");
				$_SESSION["Hash_Password"] = $CTM_Crypt->Pwd($Password);
				exit("<div class=\"success-box\"> Senha alterada com Sucesso</div>");
			}
		}
		if($_GET["cmd"] == "old_pwd")
		{
			$Pwd = $_GET["pwd"];
			$Check_Old = $this->FetchQuery("exec dbo.CTM_CheckLogin '".$this->Login."','".$Pwd."',".USE_MD5."");
				
			if(empty($Pwd))
			{
				exit("<script>VerifyDatas('Old_Password', 'Old_PasswordResult', 'Campo em branco', '#efdc75', 'warning');</script>");
			}
			else
			{
				if($Check_Old[0] == 0)
				{
					exit("<script>VerifyDatas('Old_Password', 'Old_PasswordResult', 'Senha atual Incorreta', '#FF0000', 'error');</script>");
				}
				else
				{
					exit("<script>VerifyDatas('Old_Password', 'Old_PasswordResult', 'Senha Confirmada', 'green', 'success');</script>");
				}
			}
		}
		if($_GET["cmd"] == "check_pwd")
		{
			$Pwd_1 = $_GET["pwd_1"];
			$Pwd_2 = $_GET["pwd_2"];
				
			if(empty($Pwd_2))
			{
				exit("<script>VerifyDatas('Re_Password', 'Re_PasswordResult', 'Campo em branco', '#efdc75', 'warning');</script>");
			}
			else
			{
				if($Pwd_1 != $Pwd_2)
				{
					exit("<script>VerifyDatas('Re_Password', 'Re_PasswordResult', 'Senhas n&atilde;o conferem', '#FF0000', 'error');</script>");
				}
				else
				{
					exit("<script>VerifyDatas('Re_Password', 'Re_PasswordResult', 'Senha Confirmada', 'green', 'success');</script>");
				}
			}
		}
		if($_GET["cmd"] == "check_captcha")
		{
			$Captcha = $_GET["captcha"];
				
			if(empty($Captcha))
			{
				exit("<script>VerifyDatas('Captcha', 'CaptchaResult', 'Campo em branco', '#efdc75', 'warning');</script>");
			}
			else
			{
				if($CTM_Captcha->Check($Captcha) == FALSE)
				{
					exit("<script>VerifyDatas('Captcha', 'CaptchaResult', 'Codigo de Seguan&ccedil;a Incorreto', '#FF0000', 'error');</script>");
				}
				else
				{
					exit("<script>VerifyDatas('Captcha', 'CaptchaResult', 'Codigo de Seguan&ccedil;a v&aacute;lido', 'green', 'success');</script>");
				}
			}
		}
	}
	private function Change_PID()
	{
		if($_GET["cmd"] == TRUE)
		{
			$NEW_PID = $_POST["NEW_PID"];
			$PASSWORD = $_POST["PASSWORD"];
			
			if(empty($NEW_PID) || empty($PASSWORD))
			{
				exit("<div class=\"warning-box\"> Preencha todos os campos.</div>");
			}
			elseif(!is_numeric($NEW_PID))
			{
				exit("<div class=\"warning-box\"> O Perosnal ID deve conter apenas n&uacute;meros.</div>");
			}
			elseif(strlen($NEW_PID) <> 7)
			{
				exit("<div class=\"warning-box\"> O Personal ID deve conter 7 digitos.</div>");
			}
			else
			{
				$check = $this->FetchQuery("exec dbo.CTM_CheckLogin '".$this->Login."','".$PASSWORD."',".USE_MD5);
				
				if($check[0] <> 1)
				{
					exit("<div class=\"error-box\"> Senha incorreta!</div>");
				}
				else
				{
					$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET sno__numb = '111111{$NEW_PID}' WHERE memb___id = '".$this->Login."'");
					$this->WriteLog("CHANGE_PID");
					exit("<div class=\"success-box\"> Personal ID Alterado com Sucesso!</div>");
				}
			}
		}
	}
	private function Change_Mail()
	{
		global $CTM_General, $CTM_Template, $CTM, $_Mailer;
		$CTM_Captcha = new CTM_Captcha();
		
		if(isset($_GET["run"]) == TRUE)
		{
			if($_GET["code"] == TRUE)
			{
				if($_GET["check"] == TRUE)
				{
					if(empty($_GET["code"]))
					{
						exit("<div class=\"error-box\"> Este link de valida&ccedil;&atilde;o &eacute; invalido.</div>");
					}
					else
					{
						$Encode = "0x".bin2hex($_GET["code"]);
						$Check_Link = $this->NumQuery("SELECT * FROM dbo.{$CTM[19]} WHERE HashCode={$Encode}");
						$Find_Link = $this->FetchQuery("SELECT Status,Account,Mail,Expiration 
						FROM dbo.{$CTM[19]} WHERE HashCode={$Encode}");
					
						if($Check_Link < 1)
						{
							exit("<div class=\"error-box\"> Este link de valida&ccedil;&atilde;o &eacute; invalido.</div>");
						}
						if(strtoupper(bin2hex($Find_Link[0])) == "2A9F")
						{
							exit("<div class=\"error-box\"> Este Link j&aacute; se encontra usado.</div>");
						}
						elseif(time() >= $Find_Link[3])
						{
							exit("<div class=\"error-box\"> Este Link expirou.</div>");
						}
						else
						{
							exit(false);
						}
					}
				}
				if($_GET["cmd"] == TRUE)
				{
					$Old_Mail = $_POST["Old_Mail"];
					$New_Mail = $_POST["New_Mail"];
					$Re_Mail = $_POST["Re_Mail"];
					$Captcha = $_POST["Captcha"];
				
					if(empty($_GET["code"]))
					{
						exit("<div class=\"error-box\"> Este link de valida&ccedil;&atilde;o &eacute; invalido.</div>");
					}
					else
					{
						$Encode = "0x".bin2hex($_GET["code"]);
						$Check_Link = $this->NumQuery("SELECT * FROM dbo.{$CTM[19]} WHERE HashCode={$Encode}");
						$Find_Link = $this->FetchQuery("SELECT Status,Account,Mail,Expiration 
						FROM dbo.{$CTM[19]} WHERE HashCode={$Encode}");
						$Check_Mail = $this->NumQuery("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE mail_addr='{$Old_Mail}'
						and memb___id='".$Find_Link[1]."'");
					
						if($Check_Link < 1)
						{
							exit("<div class=\"error-box\"> Este link de valida&ccedil;&atilde;o &eacute; invalido.</div>");
						}
						elseif(strtoupper(bin2hex($Find_Link[0])) == "2A9F")
						{
							exit("<div class=\"error-box\"> Este Link j&aacute; se encontra usado.</div>");
						}
						elseif(time() >= $Find_Link[3])
						{
							exit("<div class=\"error-box\"> Este Link expirou.</div>");
						}
						elseif(empty($Old_Mail))
						{
							exit("<div class=\"warning-box\"> Digite o seu E-Mail atual.</div>");
						}
						elseif(empty($New_Mail))
						{
							exit("<div class=\"warning-box\"> Digite o novo E-Mail.</div>");
						}
						elseif(empty($Re_Mail))
						{
							exit("<div class=\"warning-box\"> Digite a confirma&ccedil;&atilde;o do E-Mail.</div>");
						}
						elseif(empty($Captcha))
						{
							exit("<div class=\"warning-box\"> Digite o codigo de seguran&ccedil;a.</div>");
						}
						elseif(preg_match("/(.*?)@(.*?)\..([com|net|org])/i", $New_Mail) == FALSE) 
						{
							exit("<div class=\"error-box\"> E-Mail inv&aacute;lido</div>");
						}
						elseif($New_Mail != $Re_Mail) 
						{
							exit("<div class=\"error-box\"> E-Mails n&atilde;o conferem.</div>");
						}
						elseif($CTM_Captcha->Check($Captcha) == FALSE)
						{
							exit("<div class=\"error-box\"> Codigo de seguran&ccedil;a incorreto!</div>");
						}
						elseif($Check_Mail < 1)
						{
							exit("<div class=\"error-box\"> E-Mail atual incorreto!</div>");
						}
						else
						{
							$this->Query("UPDATE dbo.{$CTM[19]} SET Status=0x2A9F WHERE HashCode={$Encode}");
							$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET mail_addr='{$New_Mail}' WHERE memb___id='".$Find_Link[1]."' and mail_addr='".$Find_Link[2]."'");
							$this->WriteLog("CHANGE_MAIL", "E-Mail anterior: ".$Old_Mail);
							exit("<div class=\"success-box\"> E-Mail alterado com Sucesso!</div>");
						}
					}
				}	
				else
				{
				echo("<script>CTM_Load('?pag=paneluser&str=CHANGE_MAIL&run=true&code=".$_GET["code"]."&check=true','Command','GET');</script>");
				}
			}
			else
			{
				if($_GET["cmd"] == TRUE)
				{
					$Code = $_POST["Code"];
					$Old_Mail = $_POST["Old_Mail"];
					$New_Mail = $_POST["New_Mail"];
					$Re_Mail = $_POST["Re_Mail"];
					$Captcha = $_POST["Captcha"];
				
					$Encode = "0x".bin2hex($Code);
					$Check_Link = $this->NumQuery("SELECT * FROM dbo.{$CTM[19]} WHERE HashCode={$Encode}");
					$Find_Link = $this->FetchQuery("SELECT Status,Account,Mail,Expiration 
					FROM dbo.{$CTM[19]} WHERE HashCode={$Encode}");
					$Check_Mail = $this->NumQuery("SELECT * FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE mail_addr='{$Old_Mail}'
					and memb___id='".$Find_Link[1]."'");
			
					if(empty($Code))
					{
						exit("<div class=\"warning-box\"> Digite o codigo de valida&ccedil;&atilde;o.</div>");
					}
					elseif(empty($Old_Mail))
					{
						exit("<div class=\"warning-box\"> Digite o seu E-Mail atual.</div>");
					}
					elseif(empty($New_Mail))
					{
						exit("<div class=\"warning-box\"> Digite o novo E-Mail.</div>");
					}
					elseif(empty($Re_Mail))
					{
						exit("<div class=\"warning-box\"> Digite a confirma&ccedil;&atilde;o do E-Mail.</div>");
					}
					elseif(empty($Captcha))
					{
						exit("<div class=\"warning-box\"> Digite o codigo de seguran&ccedil;a.</div>");
					}
					if($Check_Link < 1)
					{
						exit("<div class=\"error-box\"> Este codigo de valida&ccedil;&atilde;o &eacute; invalido.</div>");
					}
					elseif(preg_match("/(.*?)@(.*?)\..([com|net|org])/i", $New_Mail) == FALSE) 
					{
						exit("<div class=\"error-box\"> E-Mail inv&aacute;lido</div>");
					}
					elseif($New_Mail != $Re_Mail) 
					{
						exit("<div class=\"error-box\"> E-Mails n&atilde;o conferem.</div>");
					}
					elseif($CTM_Captcha->Check($Captcha) == FALSE)
					{
						exit("<div class=\"error-box\"> Codigo de seguran&ccedil;a incorreto!</div>");
					}
					elseif($Check_Mail < 1)
					{
						exit("<div class=\"error-box\"> E-Mail atual incorreto!</div>");
					}
					elseif(strtoupper(bin2hex($Find_Link[0])) == "2A9F")
					{
						exit("<div class=\"error-box\"> Este codigo j&aacute; se encontra usado.</div>");
					}
					elseif(time() >= $Find_Link[3])
					{
						exit("<div class=\"error-box\"> Este codigo expirou.</div>");
					}
					else
					{
						$this->Query("UPDATE dbo.{$CTM[19]} SET Status=0x2A9F WHERE HashCode={$Encode}");
						$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET mail_addr='{$New_Mail}' WHERE memb___id='".$Find_Link[1]."' and mail_addr='".$Find_Link[2]."'");
						$this->WriteLog("CHANGE_MAIL", "E-Mail anterior: ".$Old_Mail);
						exit("<div class=\"success-box\"> E-Mail alterado com Sucesso!</div>");
					}
				}
			}
			$CTMT = "templates/".$CTM_Template->Open()."/pages/";
			$CTM_Template->Set("Captcha_Image", "?public=captcha");
			$CTM_Template->Set("Reset_Link", isset($_GET["code"]) == TRUE ? "&code=".$_GET["code"] : NULL);
			$CTM_Template->Load($CTMT."paneluser[CHANGE_MAIL][CHANGE].pag.php");
		}
		else
		{
			if($_GET["cmd"] == TRUE)
			{
				$Captcha = $_POST["Captcha"];
				$Find_Account = $this->FetchQuery("SELECT memb_name,mail_addr FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='".$this->Login."'");
				
				if(empty($Captcha))
				{
					exit("<div class=\"warning-box\"> Digite o codigo de seguran&ccedil;a.</div>");
				}
				elseif($CTM_Captcha->Check($Captcha) == FALSE)
				{
					exit("<div class=\"error-box\"> Codigo de seguran&ccedil;a incorreto!</div>");
				}
				else
				{
					$Time = strtotime("+ 24 hours");
					for ($WzAG = 0; $WzAG < 25; $WzAG++)
					{
						$Rand .= chr(mt_rand(65, 90));
					}
					$HashCode = md5(sha1($Rand));
					$Binarry = "0x".bin2hex($HashCode);
					$this->Query("INSERT INTO dbo.{$CTM[19]} (Account,Mail,HashCode,Expiration,Status) VALUES (
					'".$this->Login."','".$Find_Account[1]."',".$Binarry.",".$Time.",0xFFFF)");
					/******************************* Send Mail ********************************/
					$Link .= "http://";
					$Link .= $_SERVER["HTTP_HOST"];
					$Link .= $_SERVER["PHP_SELF"];
					$Link .= "?do=paneluser&str=CHANGE_MAIL&run=true";
					$Code_Link = "&code=".$HashCode;
					$Message .= "Ol&aacute; <strong>".$Find_Account[0]."</strong>!<br /><br />";
					$Message .= "Voc&ecirc; solicitou a altera&ccedil;&atilde;o do e-mail de sua conta,";
					$Message .= "<br />Para completar este processo, clique no link abaixo para alterar seu e-mail:<br />";
					$Message .= "<strong>Link:</strong> <a target=\"_blank\" href=\"".$Link.$Code_Link."\">".$Link.$Code_Link;
					$Message .= "</a><br /><br />";
					$Message .= "<h3><strong>N&atilde;o funciona?</strong></h3>";
					$Message .= "Ent&atilde;o clique no link abaixo de digite o seguinte codigo:<br />";
					$Message .= "Codigo: <strong>".$HashCode."</strong><br />";
					$Message .= "<strong>Link:</strong> <a target=\"_black\" href=\"".$Link."\">".$Link."</a><br />";
					$Message .= "<br /><br />Caso tenha mais problemas, por favor contate o Suporte.<br /><br />";
					
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
					$CTM_Mailer->Mail_Subject = utf8_decode("Alteração de E-Mail - ".constant("Server_Name"));
					$CTM_Mailer->Mail_Message = $Message;
					
					if($CTM_Mailer->Send_Mail() == FALSE)
					{
						exit("<div class=\"error-box\"> Erro ao enviar o E-Mail!</div>");
					}
					else
					{
						unset($Link);
						unset($Message);
						exit("<div class=\"success-box\"> Foi enviado um E-Mail com as informa&ccedil;&otilde;es precisas.<br />Siga as instru&ccedil;&otilde;es para alterar seu E-Mail.</div>");
					}
				}
			}
			
			$CTMT = "templates/".$CTM_Template->Open()."/pages/";
			$CTM_Template->Set("Captcha_Image", "?public=captcha");
			$CTM_Template->Load($CTMT."paneluser[CHANGE_MAIL].pag.php");
		}
	}
	private function Manage_Char()
	{
		global $CTM_General, $CTM_Template, $CTM;
		
		$Check_Chars = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE AccountID='".$_SESSION["Hash_Account"]."'");

		if($Check_Chars < 1)
		{
			exit("<h4 class=\"heading colr\">Gerenciar Personagem</h4>
		<div class=\"info-box\"> Voc&ecirc; n&atilde;o contem Personagens no Momento.</div>");
		}
		
		if($_GET["select"] == TRUE)
		{
			$_SESSION["Web_ManageChar"] = preg_replace("/('|\"|;)/i", NULL, base64_decode($_GET["select"]));
			echo("<script>CTM_Load('?pag=paneluser&str=CHAR_DIV','Char_Div','GET');\nCTM_Load('?pag=paneluser&str=MANAGE_CHAR','Panel_Nav','GET');</script>");
		}
		$Query = $this->Query("SELECT Name,cLevel FROM ".MuGen_DB.".dbo.Character WHERE AccountID='".$_SESSION["Hash_Account"]."'");
		
		$Return .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
			<tr>
    <td colspan=\"2\">";
		while($Load = $this->Fetch($Query))
		{
			$Image = $CTM_General->Image($Load[0]);
	
			if($WzAG == 0)
			{
				$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
						<tr>";
			}
			$Return .= "<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
				<tr>
				<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=paneluser&str=SELECT_CHAR&select=".base64_encode($Load[0])."', 'Command','GET');\" style=\"color: #666666;\">".$Load[0]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(Level ".$Load[1].")</a></td>
				</tr>
						<tr>	
						</tr>
						<tr>
						<td>&nbsp;</td>
						</tr>
					</table></td>";
			$WzAG++;
			if($WzAG > 2)
			{
				$Return .= "</tr>
				</table>";
				$WzAG = 0;
			}
		}
		$Return .= "</tr>
		</table>
		</td>
		</tr>
		</table>";
		
		$CTM_Template->Set("Character_List", $Return);
		unset($Return);
	}
	private function Alt_Vault()
	{
		global $CTM;
		
		$Check_Vault = $this->NumQuery("SELECT AccountID FROM ".MuGen_DB.".dbo.warehouse WHERE AccountID='".$this->Login."'");
		if($Check_Vault < 1)
		{
			exit("<h4 class=\"heading colr\">Alterar Ba&uacute</h4>
		<div class=\"info-box\"> Abra o Ba&uacute ao menos uma vez para efetuar o processo.</div>");
		}
		if($_GET["cmd"] == TRUE)
		{
			$Check_Vault = $this->NumQuery("SELECT AccountID FROM ".MuGen_DB.".dbo.warehouse WHERE AccountID='".$_SESSION["Hash_Account"]."'");

			if($Check_Vault < 1)
			{
				exit("<div class=\"error-box\"> Abra o Ba&uacute ao menos uma vez para efetuar o processo.</div>");
			}
			else
			{
				$this->Query("UPDATE ".MuGen_DB.".dbo.warehouse SET Items={$CTM[C][1]},{$CTM[C][1]}=Items WHERE AccountID='".$this->Login."'");
				$this->WriteLog("ALT_VAULT");
				exit("<div class=\"success-box\"> Ba&uacute alterado com Sucesso</div>");
			}
		}
	}
	/*private function Repair_Vault()
	{		
		global $CTM_General;
		
		$Check_Vault = $this->NumQuery("SELECT AccountID FROM ".MuGen_DB.".dbo.warehouse WHERE AccountID='".$this->Login."'");
		if($Check_Vault < 1)
		{
			exit("<h4 class=\"heading colr\">Alterar Ba&uacute</h4>
		<div class=\"info-box\"> Abra o Ba&uacute ao menos uma vez para efetuar o processo.</div>");
		}
		if($_GET["cmd"] == TRUE)
		{
			$Vault_Size = $CTM_General->GetHexSize("vault");
			$Item_Size = constant("GS_Version") >= 2 ? 32 : 20;
			
			for($i = 0; $i < $Vault_Size / 216; $i++)
			{
				$Code = $i * 255;
				$Tech = $Code + 255;
				$Result = $this->FetchQuery("SELECT SubString(Items,{$Code}, {$Tech}) FROM ".MuGen_DB.".dbo.warehouse WHERE AccountID='{$this->Login}'");
	
				$Vault = $Vault.$Result[0];
			}
			$Item_Hex = strtoupper(bin2hex($Vault));
			
			for($i = 0; $i < strlen($Vault) * 2; $i++)
			{
				if (($i % $Item_Size == 0))
				{
					$Binarry = substr($Item_Hex, $i, $Item_Size);
					if(strlen($Binarry) >= $Item_Size)
					{
						$New_Hex .= substr($Binarry, 0, 4)."FF".substr($Binarry, 6);
					}
				}
			}
			$this->Query("UPDATE ".MuGen_DB.".dbo.warehouse SET Items=0x{$New_Hex} WHERE AccountID='{$this->Login}'");
			exit("<div class=\"success-box\"> Ba&uacute; reparado com Sucesso!</div>");
		}
	}*/
	private function Connects()
	{
		global $CTM_Template;
		
		$this->WriteLog("CONNECTS");
		$Query = $this->Query("SELECT ServerName,IP,ConnectTM FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE memb___id='{$this->Login}'");
		
		while($Load = $this->Fetch($Query))
		{
			$GameIDC = $this->FetchQuery("SELECT GameIDC FROM ".MuGen_DB.".dbo.AccountCharacter WHERE Id='{$this->Login}'");
			$Return .= "<tr>
    			<td width=\"45\">".$GameIDC[0]."</td>
    			<td>".$Load[1]."</td>
    			<td>".$Load[0]."</td>
    			<td>".$Load[2]."</td>
  			</tr>\n";
		}
		$CTM_Template->Set("Connect_List", $Return);
		unset($Return);
	}	
	private function Add_ScreenShot()
	{
		global $CTM_Crypt, $CTM_Template, $CTM;
		
		echo("<title>".utf8_decode(@Web_Title)." - Powered By: CTM TeaM"."</title>
			<style type=\"text/css\"> 
				@import url('templates/Default/modules/css/Erick-Master.css');
			</style>
			<script type=\"text/javascript\" src=\"modules/header/javascripts/functions.js\"></script>");
		
		$Find_Chars = $this->Query("SELECT Name FROM ".MuGen_DB.".dbo.Character WHERE AccountID='{$this->Login}'");
		while($Characters = $this->Fetch($Find_Chars))
		{
			$Tag_Chars .= "<option value=\"{$Characters[0]}\">{$Characters[0]}</option>\n";
		}
		$CTM_Template->Set("%CHARACTER_LIST%", $Tag_Chars);
		unset($Tag_Chars);
		if($_GET["cmd"] == true)
		{
			if(empty($_POST["Character"]))
			{
				$Return = "<div class=\"warning-box\"> Selecione um personagem.</div>";
			}
			else
			{
				$CTM_ScreenShots = new CTM_ScreenShots();
				$CTM_ScreenShots->Variable_1 = $this->Login;
				$CTM_ScreenShots->Variable_2 = $_POST["Character"];
				$CTM_ScreenShots->Variable_3 = $_POST["Description"];
			
				$Return = $CTM_ScreenShots->Upload_ScreenShot();
				
				if($Return == true)
					$this->WriteLog("ADD_SCREEN", "Arquivo: ".$CTM_ScreenShots->Variable_4);
			}
		}
		$CTM_Template->Set("Command_Result", $Return == TRUE ? $Return : NULL);
	}
	private function Delete_ScreenShot()
	{
		global $CTM_Template, $CTM;
		
		$Find_Screens = $this->Query("SELECT * FROM dbo.{$CTM[20]} WHERE Account='{$this->Login}' ORDER BY Votes DESC, Id DESC");
		$Check = $this->NumRow($Find_Screens);
		
		if($Check < 1)
		{
			exit("<div class=\"info-box\"> Voc&ecirc; n&atilde;o adiciono ScreenShots no momento.</div>");
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
							<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=paneluser&str=DELETE_SCREEN&cmd=true&id=".$ScreenShot["Id"]."', 'Command', 'GET');\" style=\"color: #666666;\">Autor: ".$ScreenShot["User_Char"]." <img src=\"".constant("Upload_SS").$ScreenShot["ScreenShot"]."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$ScreenShot["Votes"]." ".$Text.")</a></td>
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
			$Find_File = $this->FetchQuery("SELECT ScreenShot FROM dbo.{$CTM[20]} WHERE Id='{$Id}'");
			
			$CTM_ScreenShots = new CTM_ScreenShots();
			$CTM_ScreenShots->Variable_1 = $Id;
			$CTM_ScreenShots->Variable_2 = $Find_File[0];
			$CTM_ScreenShots->Variable_3 = FALSE;
			$CTM_ScreenShots->Delete_ScreenShot();
			
			$this->WriteLog("DELETE_SCREEN", "Arquivo: ".$Find_File[0]);
			exit("<div class=\"success-box\"> ScreenShot deletada com Sucesso!</div>");
		}
		else
		{
			$CTM_Template->Set("%ScreenShot_List%", $Return);
		}
		unset($Return);
	}
	/*private function PM_Enter()
	{
		global $CTM_General, $CTM_Template, $_PmSystem;
		
		$Query_Chars = $this->Query("SELECT Name FROM ".MuGen_DB.".dbo.Character WHERE AccountID='".$_SESSION["Hash_Account"]."'");
		while($Send_Chars = $this->Fetch($Query_Chars))
		{
			$Chars = $Send_Chars[0];
			$Query_GUID = $this->Query("SELECT GUID,Name FROM ".MuGen_DB.".dbo.".$_PmSystem["Main"]." WHERE Name='{$Chars}'");
			$Fetch_GUID = $this->Fetch($Query_GUID);
			$GUID = $Fetch_GUID[0];
			$PM_Char = $Fetch_GUID[1];
			$Query_PMs = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.".$_PmSystem["Table"]." WHERE GUID='{$GUID}' ORDER BY MemoIndex ASC, bRead");
			while($Load = $this->FetchArray($Query_PMs))
			{
				$Subject = $Load["bRead"] == 0 ? "<span class=\"colr\">".utf8_decode($Load["Subject"])."</span>" : utf8_decode($Load["Subject"]);
				$Return .= "<tr>
    			<td width=\"45\">".$PM_Char."</td>
    			<td><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=paneluser&str=READ_PM&guid=".$Load["GUID"]."&index=".$Load["MemoIndex"]."','Panel_Nav','GET');\"><b>".$Subject."</b></a></td>
				<td>".$Load["FriendName"]."</td>
    			<td>".$Load["wDate"]."</td>
  			</tr>";
			}
		}
		$CTM_Template->Set("Messages_List", $Return);
		unset($Return);
	}
	private function PM_Exit()
	{
		global $CTM_General, $CTM_Template, $_PmSystem;
		
		$Query_Chars = $this->Query("SELECT Name FROM ".MuGen_DB.".dbo.Character WHERE AccountID='".$_SESSION["Hash_Account"]."'");
		while($Send_Chars = $this->Fetch($Query_Chars))
		{
			$Chars = $Send_Chars[0];
			$Query_GUID = $this->Query("SELECT GUID,Name FROM ".MuGen_DB.".dbo.".$_PmSystem["Main"]." WHERE Name='{$Chars}'");
			$Fetch_GUID = $this->Fetch($Query_GUID);
			$GUID = $Fetch_GUID[0];
			$PM_Char = $Fetch_GUID[1];
			$Query_PMs = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.".$_PmSystem["Table"]." WHERE FriendName='{$Chars}' ORDER BY MemoIndex ASC, wDate");
			while($Load = $this->FetchArray($Query_PMs))
			{
				$Friend = $this->FetchQuery("SELECT Name FROM ".MuGen_DB.".dbo.".$_PmSystem["Main"]." WHERE GUID=".$Load["GUID"]."");
				$Subject = utf8_decode($Load["Subject"]);
				$Return .= "<tr>
    			<td width=\"45\">".$Load["FriendName"]."</td>
    			<td><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=paneluser&str=READ_PM&guid=".$Load["GUID"]."&index=".$Load["MemoIndex"]."','Panel_Nav','GET');\"><b>".$Subject."</b></a></td>
				<td>".$Friend[0]."</td>
    			<td>".$Load["wDate"]."</td>
  			</tr>";
			}
		}
		$CTM_Template->Set("Messages_List", $Return);
		unset($Return);
	}
	private function Read_PM()
	{
		global $CTM_General, $CTM_Template, $_PmSystem;
		
		if($_GET["cmd"] == true)
		{
			$CTM_PmSystem = new CTM_PmSystem("Send", $_GET["guid"], $_GET["id"]);
		}

		$GUID = $_GET["guid"];
		$Index = $_GET["index"];

		$Check = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.".$_PmSystem["Table"]." WHERE GUID={$GUID} and MemoIndex={$Index}");

		if($Check < 1)
		{
			echo("<div class=\"error-box\"> Mensagem n&atilde;o encontrada</div>");
		}
		else
		{
			$Load = $this->FetchQuery("SELECT Subject,FriendName FROM ".MuGen_DB.".dbo.".$_PmSystem["Table"]." WHERE GUID={$GUID} and MemoIndex={$Index}");
			$New_GUID = $this->FetchQuery("SELECT GUID FROM ".MuGen_DB.".dbo.".$_PmSystem["Table"]." WHERE FriendName='{$Load[1]}'");
			$Friend = $this->FetchQuery("SELECT Name FROM ".MuGen_DB.".dbo.".$_PmSystem["Main"]." WHERE GUID={$GUID}");
			echo("");
			$CTM_PmSystem = new CTM_PmSystem("Read", $GUID, $Index);
			
			$CTM_Template->Set("Message_Title", utf8_decode($Load[0]));
			$CTM_Template->Set("Message_ID", $New_GUID[0]);
			$CTM_Template->Set("New_ID", urlencode($Friend[0]));
		}
	}
	private function Send_PM()
	{
		global $CTM_Template, $_PmSystem;
		
		if($_GET["cmd"] == TRUE)
		{
			$Send_Char = $_POST["Send_Char"];
			$Char = $_POST["Char"];
	
			$Check = $this->NumQuery("SELECT GUID FROM ".MuGen_DB.".dbo.".$_PmSystem["Friend"]." WHERE GUID={$Char} and FriendName='{$Send_Char}'");
	
			if(empty($Send_Char))
			{
				exit("<div class=\"warning-box\"> Digite o Char a receber a Mensagem</div>");
			}
			elseif($Check < 1)
			{
				$Name_Char = $this->FetchQuery("SELECT Name FROM ".MuGen_DB.".dbo.".$_PmSystem["Main"]." WHERE GUID={$Char}");
				exit("<div class=\"error-box\"> O Char digitado n&atilde;o pertence a lista de amigos do Char : ".$Name_Char[0]."</div>");
			}
			else
			{
				$GUID = $this->FetchQuery("SELECT FriendGuid FROM ".MuGen_DB.".dbo.".$_PmSystem["Friend"]." WHERE FriendName='{$Send_Char}'");
				$Name = $this->FetchQuery("SELECT Name FROM ".MuGen_DB.".dbo.".$_PmSystem["Main"]." WHERE GUID='{$Char}'");
				$CTM_PmSystem = new CTM_PmSystem("Send", $GUID[0], $Name[0]);
				exit();
			}
		}
		$Query_Chars = $this->Query("SELECT Name FROM ".MuGen_DB.".dbo.Character WHERE AccountID='".$_SESSION["Hash_Account"]."'");
		while($Fetch = $this->Fetch($Query_Chars))
		{
			$Get_GUID = $this->FetchQuery("SELECT GUID FROM ".MuGen_DB.".dbo.".$_PmSystem["Main"]." WHERE Name='{$Fetch[0]}'");
			$Return .= "<option value=\"{$Get_GUID[0]}\">{$Fetch[0]}</option>\n";
		}
		$CTM_Template->Set("Character_List", $Return);
	}*/
	/** New Final: 1.8 - Reference Link **/
	private function NewFinal_ReferenceLink()
	{
		global $CTM_Template, $CTM_MSSQL;
		
		$this->WriteLog("REFERENCE_LINK");
		$query = $CTM_MSSQL->Query("SELECT * FROM dbo.CTM_WebReference WHERE Account = '".$this->Login."'");
		define("WITH_ACCOUNT_LINK", $CTM_MSSQL->NumRow($query));
		
		if(WITH_ACCOUNT_LINK < 1)
		{
			if($_GET['cmd'] == TRUE)
			{
				$CTM_MSSQL->Query("INSERT INTO dbo.CTM_WebReference (Account) VALUES ('".$this->Login."')");
				exit("<script>CTM_Load('?pag=paneluser&str=REFERENCE_LINK','Panel_Nav','GET');</script>");
			}
		}
		else
		{
			$query = $CTM_MSSQL->Query("SELECT * FROM dbo.CTM_WebReference WHERE Account = '".$this->Login."'");
			$fetch = $CTM_MSSQL->FetchObject($query);
			
			$CTM_Template->Set("REFERENCE[LINK]", NEWFINAL_REF_LINK.$fetch->Id);
			$CTM_Template->Set("REFERENCE[ACCESS_COUNT]", $fetch->AccessCount);
			$CTM_Template->Set("REFERENCE[REGISTER_COUNT]", $fetch->RegisterCount);
			$CTM_Template->Set("REFERENCE[POINTS]", $fetch->Points);
		}
	}
	/*****************************/
	private function Show_Char()
	{
		global $CTM_General, $CTM_Template, $CTM, $_Panel, $_ClassType;
		
		$Query = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='".$_SESSION["Web_ManageChar"]."'");
		$Load = $this->FetchArray($Query);
		$Server = $this->FetchQuery("SELECT ConnectStat,ServerName FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE memb___id='".$Load["AccountID"]."'");
		$Class = $CTM_General->ClassName($Load["Class"]);
		$Map = $CTM_General->Map($Load["MapNumber"]);
		$Image = $CTM_General->Image($Load["Name"]);
		$Request = $this->Query("SELECT G_Name FROM ".MuGen_DB.".dbo.GuildMember WHERE Name='".$Load["Name"]."'");
		$Send = $this->Fetch($Request);
		$Logo = $this->FetchQuery("SELECT G_Mark FROM ".MuGen_DB.".dbo.Guild WHERE G_Name='{$Send[0]}'");
		$Guild = $this->NumRow($Request) > 0 ? "<a href=\"javascript: void(EffectWeb)\" onclick=\"CTM_Load('?pag=search&guild=".urlencode($Send[0])."','conteudo','GET');\">".$Send[0]."</a>" : "Nenhuma";
		switch($Server[0])
		{
			case 0 : $Status = "<span style=\"color: red;\">Offline</span>"; break;
			case 1 : $Status = "<span style=\"color: green;\">Online</span>"; break;
		}
		
		$CTM_Template->Set("Character_Manage", $_SESSION["Web_ManageChar"]);
		$CTM_Template->Set("Char_Image", $Image);
		$CTM_Template->Set("Char_Class", $Class);
		$CTM_Template->Set("Char_Resets", $Load[constant("Column_Reset")]);
		$CTM_Template->Set("Char_MResets", $Load[constant("Column_MReset")]);
		$CTM_Template->Set("Char_PK", $Load[constant("Column_PK")]);
		$CTM_Template->Set("Char_Level", $Load["cLevel"]);
		$CTM_Template->Set("Char_Strength", $Load["Strength"]);
		$CTM_Template->Set("Char_Dexterity", $Load["Dexterity"]);
		$CTM_Template->Set("Char_Vitality", $Load["Vitality"]);
		$CTM_Template->Set("Char_Energy", $Load["Energy"]);
		$CTM_Template->Set("Char_Command", $Load["Class"] == $_ClassType["DL"][0] || $Load["Class"] == $_ClassType["LE"][0] || $Load["Class"] == $_ClassType["LE2"][0] ? "<td>Comando: <span class=\"colr\">".$Load[Column_Cmd]."</span></td>" : NULL);
		$CTM_Template->Set("Char_Map", $Map);
		$CTM_Template->Set("Char_Server", $Server[1]);
		$CTM_Template->Set("Char_Status", $Status);
		$CTM_Template->Set("Char_Guild", $Guild);
		$CTM_Template->Set("Guild_Image", "?public=logoGuild&code=".urlencode(bin2hex($Logo[0])));
	}
	private function ResetClass($Class)
	{
		global $_ClassType;
		
		switch($Class)
		{
			case $_ClassType["DW"][0] : return $_ClassType["DW"][0]; break;
			case $_ClassType["SM"][0] : return $_ClassType["DW"][0]; break;
			case $_ClassType["GM"][0] : return $_ClassType["DW"][0]; break;
			case $_ClassType["DK"][0] : return $_ClassType["DK"][0]; break;
			case $_ClassType["BK"][0] : return $_ClassType["DK"][0]; break;
			case $_ClassType["BM"][0] : return $_ClassType["DK"][0]; break;
			case $_ClassType["FE"][0] : return $_ClassType["FE"][0]; break;
			case $_ClassType["ME"][0] : return $_ClassType["FE"][0]; break;
			case $_ClassType["HE"][0] : return $_ClassType["FE"][0]; break;
			case $_ClassType["MG"][0] : return $_ClassType["MG"][0]; break;
			case $_ClassType["DM"][0] : return $_ClassType["MG"][0]; break;
			case $_ClassType["DM2"][0] : return $_ClassType["MG"][0]; break;
			case $_ClassType["DL"][0] : return $_ClassType["DL"][0]; break;
			case $_ClassType["LE"][0] : return $_ClassType["DL"][0]; break;
			case $_ClassType["LE2"][0] : return $_ClassType["DL"][0]; break;
			case $_ClassType["SU"][0] : return $_ClassType["SU"][0]; break;
			case $_ClassType["BS"][0] : return $_ClassType["SU"][0]; break;
			case $_ClassType["DIM"][0] : return $_ClassType["SU"][0]; break;
			case $_ClassType["RF"][0] : return $_ClassType["RF"][0]; break;
			case $_ClassType["FM"][0] : return $_ClassType["RF"][0]; break;
		}
	}
	private function ResetPoints($Return, $String = 1)
	{
		global $_Panel;
		
		switch($String)
		{
			case 1 : $Stat = array(18,18,15,30,0); break;
			case 2 : 
			$Value = $_Panel["Char"]["MReset"]["Points"];
			$Stat = array($Value[0],$Value[1],$Value[2],$Value[3],$Value[4]);
			break;
		}
		$Array = array($Stat[0],$Stat[1],$Stat[2],$Stat[3],$Stat[4]);
		return $Array[$Return];
	}
	private function ResetMap($Return, $Class)
	{
		switch($Class)
		{
			case $_ClassType["FE"][0] : 
			$MapNumber = 3;
			$MapPosX = 174;
			$MapPosY = 111;
			break;
			case $_ClassType["ME"][0] : 
			$MapNumber = 3;
			$MapPosX = 174;
			$MapPosY = 111;
			break;
			case $_ClassType["HE"][0] : 
			$MapNumber = 3;
			$MapPosX = 174;
			$MapPosY = 111;
			break;
			default :
			$MapNumber = 0;
			$MapPosX = 125;
			$MapPosY = 125;
			break;
		}
		$Array = array($MapNumber,$MapPosX,$MapPosY);
		return $Array[$Return];
	}
	private function ResetSystem()
	{
		global $CTM_General, $CTM_Template, $_Panel;
		
		$Account = $this->FetchQuery("SELECT ".VIP_Column." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='".$this->Login."'");
		$Character = $_SESSION["Web_ManageChar"];
		$Query = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}' and AccountID='{$this->Login}'");
		$Find_Char = $this->FetchArray($Query);
		
		if($_Panel["Char"]["Reset"]["General"]["Mode"] == 3)
		{
			if($Find_Char[Column_Reset] >= 0 && $Find_Char[Column_Reset] <= 10)
			{
				$resetTable = "0-10";
				$tableBase = 0;
			}
			elseif($Find_Char[Column_Reset] >= 11 && $Find_Char[Column_Reset] <= 50)
			{
				$resetTable = "11-50";
				$tableBase = 10;
			}
			elseif($Find_Char[Column_Reset] >= 51 && $Find_Char[Column_Reset] <= 100)
			{
				$resetTable = "51-100";
				$tableBase = 50;
			}
			elseif($Find_Char[Column_Reset] >= 101 && $Find_Char[Column_Reset] <= 150)
			{
				$resetTable = "101-150";
				$tableBase = 100;
			}
			elseif($Find_Char[Column_Reset] >= 151 && $Find_Char[Column_Reset] <= 200)
			{
				$resetTable = "151-200";
				$tableBase = 150;
			}
			elseif($Find_Char[Column_Reset] >= 201 && $Find_Char[Column_Reset] <= 300)
			{
				$resetTable = "201-300";
				$tableBase = 200;
			}
			else
			{
				$resetTable = "301-XXX";
				$tableBase = 300;
			}
		}
		
		switch($_Panel["Char"]["Reset"]["General"]["Mode"])
		{
			case 1 : 
			$var = $_Panel["Char"]["Reset"]["General"];
			$_Find["Point"] = $_Panel["Char"]["Reset"]["General"]["Points"];
			$_Find["Mode"] = "Acumulativo";
			break;
			case 2 :
			$var = $_Panel["Char"]["Reset"]["General"];
			$_Find["Point"] = $_Panel["Char"]["Reset"]["General"]["Points"];
			$_Find["Mode"] = "Pontuativo";
			break;
			case 3 :
			$var = $_Panel["Char"]["Reset"]['Tabulated'][$resetTable];
			$_Find["Point"] = $_Panel["Char"]["Reset"]['Tabulated'][$resetTable]["Points"];
			$_Find["Mode"] = "Tabelado";
			break;
		}
		
		$Reset["Level"] = $var["Level"][$Account[0]];
		$Reset["Money"] = $var["Money"][$Account[0]];
		$Reset["Return"] = $var["Return"][$Account[0]];
		$Reset["Clear_Inv"] = $var["Invent"][$Account[0]] == 1 ? "Inventory=".$CTM_General->GetHexVoid("inventory")."," : NULL;
		$Reset["Clear_Skill"] = $var["Skill"][$Account[0]] == 1 ? "MagicList=".$CTM_General->GetHexVoid("skill")."," : NULL;
		$Reset["Clear_Quest"] = $var["Quest"][$Account[0]] == 1 ? "Quest=".$CTM_General->GetHexVoid("quest").",Class=".$this->ResetClass($Find_Char["Class"])."," : NULL;
		$Reset["Inventory"] = $var["Invent"][$Account[0]] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
		$Reset["Skills"] = $var["Skill"][$Account[0]] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
		$Reset["Quests"] = $var["Quest"][$Account[0]] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
		$Reset["Points"] = $_Find["Point"][$Account[0]];
		$Reset["Class"] = $var["Quest"][$Account[0]] == 1 ? $this->ResetClass($Find_Char["Class"]) : $Find_Char["Class"];

		if($_Panel["Char"]["Reset"]["General"]["Mode"] == 3)
		{
			$somePoints = $var['SomePoints'][$Account[0]];

			if($resetTable == "0-10" && $Find_Char[Column_Reset] > 0)
				$Reset['Points'] *= $Find_Char[Column_Reset];
			else
				$Reset['Points'] = $somePoints + (($Find_Char[Column_Reset] - $tableBase) * $Reset['Points']);
		}
		
		if($_GET["cmd"] == TRUE)
		{
			if($Find_Char["cLevel"] < $Reset["Level"])
			{
				$this->Error .= "&raquo; Level insuficiente<br />\n";
			}
			elseif($Find_Char["Money"] < $Reset["Money"])
			{
				$this->Error .= "&raquo; Zen insuficiente<br />\n";
			}
			
			if(isset($this->Error) == TRUE)
			{
				exit("<div class=\"error-box\"> Os seguintes erros foram encontrados:<br /><br />{$this->Error}</div>");
			}
			else
			{
				if($_Panel["Char"]["Reset"]["General"]["Mode"] == 1)
				{
					$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET cLevel=".$Reset["Return"].",Experience=0,".Column_Reset."=".Column_Reset."+1,".Column_ResetDay."=".Column_ResetDay."+1,".Column_ResetWeek."=".Column_ResetWeek."+1,".Column_ResetMonth."=".Column_ResetMonth."+1,Money=Money-".$Reset["Money"].",".$Reset["Clear_Inv"].$Reset["Clear_Skill"].$Reset["Clear_Quest"]."MapNumber=".$this->ResetMap(0,$Find_Char["Class"]).",MapPosX=".$this->ResetMap(1,$Find_Char["Class"]).",MapPosY=".$this->ResetMap(2,$Find_Char["Class"])." WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				}
				if($_Panel["Char"]["Reset"]["General"]["Mode"] == 2)
				{
					$Cmd_Query = $Find_Char["Class"] == $_ClassType["DL"][0] || $_ClassType["LE"][0] || $_ClassType["LE2"][0] ? ",".Column_Cmd."=".$this->ResetPoints(4) : NULL;
					$this->Points = $Find_Char[Column_Reset] == 0 ? $Reset["Points"] : $Reset["Points"] * $Find_Char[Column_Reset];
					$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET cLevel=".$Reset["Return"].",Experience=0,".Column_Reset."=".Column_Reset."+1,".Column_ResetDay."=".Column_ResetDay."+1,".Column_ResetWeek."=".Column_ResetWeek."+1,".Column_ResetMonth."=".Column_ResetMonth."+1,Money=Money-".$Reset["Money"].",".$Reset["Clear_Inv"].$Reset["Clear_Skill"].$Reset["Clear_Quest"]."LevelUpPoint=".$this->Points.",MapNumber=".$this->ResetMap(0,$Find_Char["Class"]).",MapPosX=".$this->ResetMap(1,$Find_Char["Class"]).",MapPosY=".$this->ResetMap(2,$Find_Char["Class"]).",Strength=".$this->ResetPoints(0).",Dexterity=".$this->ResetPoints(1).",Vitality=".$this->ResetPoints(2).",Energy=".$this->ResetPoints(3)."{$Cmd_Query} WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				}
				if($_Panel["Char"]["Reset"]["General"]["Mode"] == 3)
				{
					$Cmd_Query = $Find_Char["Class"] == $_ClassType["DL"][0] || $_ClassType["LE"][0] || $_ClassType["LE2"][0] ? ",".Column_Cmd."=".$this->ResetPoints(4) : NULL;
					$this->Points = $Find_Char[Column_Reset] == 0 ? $Reset["Points"] : $Reset["Points"] * $Find_Char[Column_Reset];
					$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET cLevel=".$Reset["Return"].",Experience=0,".Column_Reset."=".Column_Reset."+1,".Column_ResetDay."=".Column_ResetDay."+1,".Column_ResetWeek."=".Column_ResetWeek."+1,".Column_ResetMonth."=".Column_ResetMonth."+1,Money=Money-".$Reset["Money"].",".$Reset["Clear_Inv"].$Reset["Clear_Skill"].$Reset["Clear_Quest"]."LevelUpPoint=".$this->Points.",MapNumber=".$this->ResetMap(0,$Find_Char["Class"]).",MapPosX=".$this->ResetMap(1,$Find_Char["Class"]).",MapPosY=".$this->ResetMap(2,$Find_Char["Class"]).",Strength=".$this->ResetPoints(0).",Dexterity=".$this->ResetPoints(1).",Vitality=".$this->ResetPoints(2).",Energy=".$this->ResetPoints(3)."{$Cmd_Query} WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				}
				$this->WriteLog("RESET_CHAR", "Resets anteriores: ".$Find_Char[Column_Reset]);
				exit("<div class=\"success-box\"> Personagem Resetado com Sucesso!</div>");
			}
		}
		
		switch($_Panel["Char"]["Reset"]["General"]["Mode"])
		{
			case 1 : 
			$Reset["New_Pts"] = $Find_Char["LevelUpPoint"];
			break;
			case 2 :
			$Reset["New_Pts"] = $Find_Char[Column_Reset] == 0 ? $Reset["Points"] : $Reset["Points"] * $Find_Char[Column_Reset];
			break;
			case 3 :
			$Reset["New_Pts"] = $Find_Char[Column_Reset] == 0 ? $Reset["Points"] : $Reset["Points"] * $Find_Char[Column_Reset];
			break;
		}
		
		$CTM_Template->Set("Reset_Mode", $_Find["Mode"]);
		$CTM_Template->Set("Reset_Level", $Reset["Level"]);
		$CTM_Template->Set("Reset_Money", $Reset["Money"]);
		$CTM_Template->Set("Char_Resets", $Find_Char[Column_Reset]);
		$CTM_Template->Set("Char_Level", $Find_Char["cLevel"]);
		$CTM_Template->Set("Char_Points", $Find_Char["LevelUpPoint"]);
		
		if($_Panel["Char"]["Reset"]["General"]["Mode"] == 2)
		{
			$CTM_Template->Set("Char_Strength", $Find_Char["Strength"]);
			$CTM_Template->Set("Char_Dexterity", $Find_Char["Dexterity"]);
			$CTM_Template->Set("Char_Vitality", $Find_Char["Vitality"]);
			$CTM_Template->Set("Char_Energy", $Find_Char["Energy"]);
			$CTM_Template->Set("Char_Command", $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? "Comando: <strong>".$Find_Char[Column_Cmd]."</strong><br />" : NULL);
		}
		
		$CTM_Template->Set("Char_Class", $CTM_General->ClassName($Find_Char["Class"]));
		$CTM_Template->Set("Char_Money", $Find_Char["Money"]);
		$CTM_Template->Set("Reseted_Resets", $Find_Char[Column_Reset]+1);
		$CTM_Template->Set("Reseted_Level", $Reset["Return"]);
		$CTM_Template->Set("Reseted_Points", $Reset["New_Pts"]);
		
		if($_Panel["Char"]["Reset"]["General"]["Mode"] == 2)
		{
			$CTM_Template->Set("Reseted_Strength", 18);
			$CTM_Template->Set("Reseted_Dexterity", 18);
			$CTM_Template->Set("Reseted_Vitality", 15);
			$CTM_Template->Set("Reseted_Energy", 30);
			$CTM_Template->Set("Reseted_Command", $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? "Comando: <strong>0</strong><br />" : NULL);
		}
		
		$CTM_Template->Set("Reseted_Class", $CTM_General->ClassName($Reset["Class"]));
		$CTM_Template->Set("Reseted_Money", $Find_Char["Money"]-$Reset["Money"]);
		$CTM_Template->Set("Clear_Inventory", $Reset["Inventory"]);
		$CTM_Template->Set("Clear_Skills", $Reset["Skills"]);
		$CTM_Template->Set("Clear_Quests", $Reset["Quests"]);
	}
	private function MasterReset()
	{
		global $CTM_General, $CTM_Template, $_Panel, $_ClassType;
		$CTM_General->Check_Coin_Table($this->Login);
		
		$Account = $this->FetchQuery("SELECT ".VIP_Column." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='".$this->Login."'");
		$Character = $_SESSION["Web_ManageChar"];
		$Query = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}' and AccountID='{$this->Login}'");
		$Find_Char = $this->FetchArray($Query);
		
		switch($Account[0])
		{
			case 0 :
			$MReset["Cash"] = $_Panel["Char"]["MReset"]["Cash"][0];
			$MReset["Resets"] = $_Panel["Char"]["MReset"]["Resets"][0];
			$MReset["Level"] = $_Panel["Char"]["MReset"]["Level"][0];
			$MReset["ClearReset"] = $_Panel["Char"]["MReset"]["Clear_Reset"][0] == 1 ? Column_Reset."=".Column_Reset."-".$_Panel["Char"]["MReset"]["Resets"][0]."," : NULL;
			$MReset["Clear_Inv"] = $_Panel["Char"]["MReset"]["Invent"][0] == 1 ? "Inventory=".$CTM_General->GetHexVoid("inventory")."," : NULL;
			$MReset["Clear_Skill"] = $_Panel["Char"]["MReset"]["Skill"][0] == 1 ? "MagicList=".$CTM_General->GetHexVoid("skill")."," : NULL;
			$MReset["Clear_Quest"] = $_Panel["Char"]["MReset"]["Quest"][0] == 1 ? "Quest=".$CTM_General->GetHexVoid("quest").",Class=".$this->ResetClass($Find_Char["Class"])."," : NULL;
			$MReset["Money"] = $_Panel["Char"]["MReset"]["Money"][0];
			$MReset["Clear_Reset"] = $_Panel["Char"]["MReset"]["Clear_Reset"][0] == 1 ? $Find_Char[Column_Reset]-$MReset["Resets"] : $Find_Char[Column_Reset];
			$MReset["Inventory"] = $_Panel["Char"]["MReset"]["Invent"][0] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Skills"] = $_Panel["Char"]["MReset"]["Skill"][0] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Quests"] = $_Panel["Char"]["MReset"]["Quest"][0] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Class"] = $_Panel["Char"]["MReset"]["Quest"][0] == 1 ? $this->ResetClass($Find_Char["Class"]) : $Find_Char["Class"];
			break;
			case 1 :
			$MReset["Cash"] = $_Panel["Char"]["MReset"]["Cash"][1];
			$MReset["Resets"] = $_Panel["Char"]["MReset"]["Resets"][1];
			$MReset["Level"] = $_Panel["Char"]["MReset"]["Level"][1];
			$MReset["ClearReset"] = $_Panel["Char"]["MReset"]["Clear_Reset"][1] == 1 ? Column_Reset."=".Column_Reset."-".$_Panel["Char"]["MReset"]["Resets"][1]."," : NULL;
			$MReset["Clear_Inv"] = $_Panel["Char"]["MReset"]["Invent"][1] == 1 ? "Inventory=".$CTM_General->GetHexVoid("inventory")."," : NULL;
			$MReset["Clear_Skill"] = $_Panel["Char"]["MReset"]["Skill"][1] == 1 ? "MagicList=".$CTM_General->GetHexVoid("skill")."," : NULL;
			$MReset["Clear_Quest"] = $_Panel["Char"]["MReset"]["Quest"][1] == 1 ? "Quest=".$CTM_General->GetHexVoid("quest").",Class=".$this->ResetClass($Find_Char["Class"])."," : NULL;
			$MReset["Money"] = $_Panel["Char"]["MReset"]["Money"][1];
			$MReset["Clear_Reset"] = $_Panel["Char"]["MReset"]["Clear_Reset"][1] == 1 ? $Find_Char[Column_Reset]-$MReset["Resets"] : $Find_Char[Column_Reset];
			$MReset["Inventory"] = $_Panel["Char"]["MReset"]["Invent"][1] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Skills"] = $_Panel["Char"]["MReset"]["Skill"][1] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Quests"] = $_Panel["Char"]["MReset"]["Quest"][1] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Class"] = $_Panel["Char"]["MReset"]["Quest"][1] == 1 ? $this->ResetClass($Find_Char["Class"]) : $Find_Char["Class"];
			break;
			case 2 :
			$MReset["Cash"] = $_Panel["Char"]["MReset"]["Cash"][2];
			$MReset["Resets"] = $_Panel["Char"]["MReset"]["Resets"][2];
			$MReset["Level"] = $_Panel["Char"]["MReset"]["Level"][2];
			$MReset["ClearReset"] = $_Panel["Char"]["MReset"]["Clear_Reset"][2] == 1 ? Column_Reset."=".Column_Reset."-".$_Panel["Char"]["MReset"]["Resets"][2]."," : NULL;
			$MReset["Clear_Inv"] = $_Panel["Char"]["MReset"]["Invent"][2] == 1 ? "Inventory=".$CTM_General->GetHexVoid("inventory")."," : NULL;
			$MReset["Clear_Skill"] = $_Panel["Char"]["MReset"]["Skill"][2] == 1 ? "MagicList=".$CTM_General->GetHexVoid("skill")."," : NULL;
			$MReset["Clear_Quest"] = $_Panel["Char"]["MReset"]["Quest"][2] == 1 ? "Quest=".$CTM_General->GetHexVoid("quest").",Class=".$this->ResetClass($Find_Char["Class"])."," : NULL;
			$MReset["Money"] = $_Panel["Char"]["MReset"]["Money"][2];
			$MReset["Clear_Reset"] = $_Panel["Char"]["MReset"]["Clear_Reset"][2] == 1 ? $Find_Char[Column_Reset]-$MReset["Resets"] : $Find_Char[Column_Reset];
			$MReset["Inventory"] = $_Panel["Char"]["MReset"]["Invent"][2] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Skills"] = $_Panel["Char"]["MReset"]["Skill"][2] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Quests"] = $_Panel["Char"]["MReset"]["Quest"][2] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Class"] = $_Panel["Char"]["MReset"]["Quest"][2] == 1 ? $this->ResetClass($Find_Char["Class"]) : $Find_Char["Class"];
			break;
			case 3 :
			$MReset["Cash"] = $_Panel["Char"]["MReset"]["Cash"][3];
			$MReset["Resets"] = $_Panel["Char"]["MReset"]["Resets"][3];
			$MReset["Level"] = $_Panel["Char"]["MReset"]["Level"][3];
			$MReset["ClearReset"] = $_Panel["Char"]["MReset"]["Clear_Reset"][3] == 1 ? Column_Reset."=".Column_Reset."-".$_Panel["Char"]["MReset"]["Resets"][3]."," : NULL;
			$MReset["Clear_Inv"] = $_Panel["Char"]["MReset"]["Invent"][3] == 1 ? "Inventory=".$CTM_General->GetHexVoid("inventory")."," : NULL;
			$MReset["Clear_Skill"] = $_Panel["Char"]["MReset"]["Skill"][3] == 1 ? "MagicList=".$CTM_General->GetHexVoid("skill")."," : NULL;
			$MReset["Clear_Quest"] = $_Panel["Char"]["MReset"]["Quest"][3] == 1 ? "Quest=".$CTM_General->GetHexVoid("quest").",Class=".$this->ResetClass($Find_Char["Class"])."," : NULL;
			$MReset["Money"] = $_Panel["Char"]["MReset"]["Money"][3];
			$MReset["Clear_Reset"] = $_Panel["Char"]["MReset"]["Clear_Reset"][3] == 1 ? $Find_Char[Column_Reset]-$MReset["Resets"] : $Find_Char[Column_Reset];
			$MReset["Inventory"] = $_Panel["Char"]["MReset"]["Invent"][3] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Skills"] = $_Panel["Char"]["MReset"]["Skill"][3] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Quests"] = $_Panel["Char"]["MReset"]["Quest"][3] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Class"] = $_Panel["Char"]["MReset"]["Quest"][3] == 1 ? $this->ResetClass($Find_Char["Class"]) : $Find_Char["Class"];
			break;
			case 4 :
			$MReset["Cash"] = $_Panel["Char"]["MReset"]["Cash"][4];
			$MReset["Resets"] = $_Panel["Char"]["MReset"]["Resets"][4];
			$MReset["Level"] = $_Panel["Char"]["MReset"]["Level"][4];
			$MReset["ClearReset"] = $_Panel["Char"]["MReset"]["Clear_Reset"][4] == 1 ? Column_Reset."=".Column_Reset."-".$_Panel["Char"]["MReset"]["Resets"][4]."," : NULL;
			$MReset["Clear_Inv"] = $_Panel["Char"]["MReset"]["Invent"][4] == 1 ? "Inventory=".$CTM_General->GetHexVoid("inventory")."," : NULL;
			$MReset["Clear_Skill"] = $_Panel["Char"]["MReset"]["Skill"][4] == 1 ? "MagicList=".$CTM_General->GetHexVoid("skill")."," : NULL;
			$MReset["Clear_Quest"] = $_Panel["Char"]["MReset"]["Quest"][4] == 1 ? "Quest=".$CTM_General->GetHexVoid("quest").",Class=".$this->ResetClass($Find_Char["Class"])."," : NULL;
			$MReset["Money"] = $_Panel["Char"]["MReset"]["Money"][4];
			$MReset["Clear_Reset"] = $_Panel["Char"]["MReset"]["Clear_Reset"][4] == 1 ? $Find_Char[Column_Reset]-$MReset["Resets"] : $Find_Char[Column_Reset];
			$MReset["Inventory"] = $_Panel["Char"]["MReset"]["Invent"][4] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Skills"] = $_Panel["Char"]["MReset"]["Skill"][4] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Quests"] = $_Panel["Char"]["MReset"]["Quest"][4] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Class"] = $_Panel["Char"]["MReset"]["Quest"][4] == 1 ? $this->ResetClass($Find_Char["Class"]) : $Find_Char["Class"];
			break;
			case 5 :
			$MReset["Cash"] = $_Panel["Char"]["MReset"]["Cash"][5];
			$MReset["Resets"] = $_Panel["Char"]["MReset"]["Resets"][5];
			$MReset["Level"] = $_Panel["Char"]["MReset"]["Level"][5];
			$MReset["ClearReset"] = $_Panel["Char"]["MReset"]["Clear_Reset"][5] == 1 ? Column_Reset."=".Column_Reset."-".$_Panel["Char"]["MReset"]["Resets"][5]."," : NULL;
			$MReset["Clear_Inv"] = $_Panel["Char"]["MReset"]["Invent"][5] == 1 ? "Inventory=".$CTM_General->GetHexVoid("inventory")."," : NULL;
			$MReset["Clear_Skill"] = $_Panel["Char"]["MReset"]["Skill"][5] == 1 ? "MagicList=".$CTM_General->GetHexVoid("skill")."," : NULL;
			$MReset["Clear_Quest"] = $_Panel["Char"]["MReset"]["Quest"][5] == 1 ? "Quest=".$CTM_General->GetHexVoid("quest").",Class=".$this->ResetClass($Find_Char["Class"])."," : NULL;
			$MReset["Money"] = $_Panel["Char"]["MReset"]["Money"][5];
			$MReset["Clear_Reset"] = $_Panel["Char"]["MReset"]["Clear_Reset"][5] == 1 ? $Find_Char[Column_Reset]-$MReset["Resets"] : $Find_Char[Column_Reset];
			$MReset["Inventory"] = $_Panel["Char"]["MReset"]["Invent"][5] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Skills"] = $_Panel["Char"]["MReset"]["Skill"][5] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Quests"] = $_Panel["Char"]["MReset"]["Quest"][5] == 1 ? "<span style=\"color: red;\">Sim</span>" : "<span style=\"color: green;\">N&atilde;o</span>";
			$MReset["Class"] = $_Panel["Char"]["MReset"]["Quest"][5] == 1 ? $this->ResetClass($Find_Char["Class"]) : $Find_Char["Class"];
			break;
		}
		
		if($_GET["cmd"] == TRUE)
		{
			if($Find_Char["cLevel"] < $MReset["Level"])
			{
				$this->Error .= "&raquo; Level insuficiente<br />\n";
			}
			if($Find_Char["Money"] < $MReset["Money"])
			{
				$this->Error .= "&raquo; Zen insuficiente<br />\n";
			}
			if($Find_Char["Strength"] < $_Panel["Char"]["MReset"]["Stats"][0])
			{
				$this->Error .= "&raquo; &Eacute; preciso estar Full em For&ccedil;a<br />\n";
			}
			if($Find_Char["Dexterity"] < $_Panel["Char"]["MReset"]["Stats"][1])
			{
				$this->Error .= "&raquo; &Eacute; preciso estar Full em Agilidade<br />\n";
			}
			if($Find_Char["Vitality"] < $_Panel["Char"]["MReset"]["Stats"][2])
			{
				$this->Error .= "&raquo; &Eacute; preciso estar Full em Vitalidade<br />\n";
			}
			if($Find_Char["Energy"] < $_Panel["Char"]["MReset"]["Stats"][3])
			{
				$this->Error .= "&raquo; &Eacute; preciso estar Full em Energia<br />\n";
			}
			if($Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0])
			{
				if($Find_Char[Column_Cmd] < $_Panel["Char"]["MReset"]["Stats"][4])
				{
					$this->Error .= "&raquo; &Eacute; preciso estar Full em Comando<br />\n";
				}
			}
			if($Find_Char[Column_Reset] < $MReset["Resets"])
			{
				$this->Error .= "&raquo; Resets insuficientes<br />\n";
			}
			
			if(isset($this->Error) == TRUE)
			{
				exit("<div class=\"error-box\"> Os seguintes erros foram encontrados:<br /><br />{$this->Error}</div>");
			}
			else
			{
				$Cmd_Query = $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? ",".Column_Cmd."=".$this->ResetPoints(4,2) : NULL;
				$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET cLevel=1,Experience=0,LevelUpPoint=0,".$MReset["Clear_Inv"].$MReset["Clear_Skill"].$MReset["Clear_Quest"].$MReset["ClearReset"].Column_MReset."=".Column_MReset."+1,Strength=".$this->ResetPoints(0,2).",Dexterity=".$this->ResetPoints(1,2).",Vitality=".$this->ResetPoints(2,2).",Energy=".$this->ResetPoints(3,2)."{$Cmd_Query},Money=Money-".$MReset["Money"].",MapNumber=".$this->ResetMap(0,$Find_Char["Class"]).",MapPosX=".$this->ResetMap(1,$Find_Char["Class"]).",MapPosY=".$this->ResetMap(2,$Find_Char["Class"])." WHERE Name='".$Character."' and AccountID='{$this->Login}'");
				$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".constant("GL_Column_".$_Panel["Char"]["MReset"]["Coin"])."=".constant("GL_Column_".$_Panel["Char"]["MReset"]["Coin"])."+".$MReset["Cash"]." WHERE ".GL_Login."='".$this->Login."'");
				$this->WriteLog("MASTER_RESET", "Master Resets anteriores: ".$Find_Char[Column_MReset]);
				exit("<div class=\"success-box\"> Master Reset efetuado com Sucesso!<br />Voc&ecirc; foi premiado com ".$MReset["Cash"]." ".constant("Coin_".$_Panel["Char"]["MReset"]["Coin"])."!</div>");
			}
		}
		$CTM_Template->Set("MReset_Level", $MReset["Level"]);
		$CTM_Template->Set("MReset_Resets", $MReset["Resets"]);
		$CTM_Template->Set("MReset_Money", $MReset["Money"]);
		$CTM_Template->Set("MReset_Strength", $_Panel["Char"]["MReset"]["Stats"][0]);
		$CTM_Template->Set("MReset_Dexterity", $_Panel["Char"]["MReset"]["Stats"][1]);
		$CTM_Template->Set("MReset_Vitality", $_Panel["Char"]["MReset"]["Stats"][2]);
		$CTM_Template->Set("MReset_Energy", $_Panel["Char"]["MReset"]["Stats"][3]);
		$CTM_Template->Set("MReset_Command", $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? "Comando: <strong>".$_Panel["Char"]["MReset"]["Stats"][4]."</strong><br />" : NULL);
		$CTM_Template->Set("Char_MResets", $Find_Char[Column_MReset]);
		$CTM_Template->Set("Char_Resets", $Find_Char[Column_Reset]);
		$CTM_Template->Set("Char_Level", $Find_Char["cLevel"]);
		$CTM_Template->Set("Char_Points", $Find_Char["LevelUpPoint"]);
		$CTM_Template->Set("Char_Class", $CTM_General->ClassName($Find_Char["Class"]));
		$CTM_Template->Set("Char_Strength", $Find_Char["Strength"]);
		$CTM_Template->Set("Char_Dexterity", $Find_Char["Dexterity"]);
		$CTM_Template->Set("Char_Vitality", $Find_Char["Vitality"]);
		$CTM_Template->Set("Char_Energy", $Find_Char["Energy"]);
		$CTM_Template->Set("Char_Command", $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? "Comando: <strong>".$Find_Char[Column_Cmd]."</strong><br />" : NULL);
		$CTM_Template->Set("Char_Money", $Find_Char["Money"]);
		
		$CTM_Template->Set("MReseted_MResets", $Find_Char[Column_MReset]+1);
		$CTM_Template->Set("MReseted_Resets", $MReset["Clear_Reset"]);
		$CTM_Template->Set("MReseted_Level", 1);
		$CTM_Template->Set("MReseted_Points", 0);
		$CTM_Template->Set("MReseted_Class", $CTM_General->ClassName($MReset["Class"]));
		$CTM_Template->Set("MReseted_Strength", $_Panel["Char"]["MReset"]["Points"][0]);
		$CTM_Template->Set("MReseted_Dexterity", $_Panel["Char"]["MReset"]["Points"][1]);
		$CTM_Template->Set("MReseted_Vitality", $_Panel["Char"]["MReset"]["Points"][2]);
		$CTM_Template->Set("MReseted_Energy", $_Panel["Char"]["MReset"]["Points"][3]);
		$CTM_Template->Set("MReseted_Command", $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? "Comando: <strong>".$_Panel["Char"]["MReset"]["Points"][4]."</strong><br />" : NULL);
		$CTM_Template->Set("MReseted_Money", $Find_Char["Money"]-$MReset["Money"]);
		$CTM_Template->Set("Clear_Inventory", $MReset["Inventory"]);
		$CTM_Template->Set("Clear_Skills", $MReset["Skills"]);
		$CTM_Template->Set("Clear_Quests", $MReset["Quests"]);
	}
	private function Transfer_Resets()
	{
		global $CTM_Template, $_Panel;
		
		$Character = $_SESSION["Web_ManageChar"];
		$Find_Resets = $this->FetchQuery("SELECT ".Column_Reset." FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
		$Find_Chars = $this->Query("SELECT Name FROM ".MuGen_DB.".dbo.Character WHERE AccountID='{$this->Login}' ORDER BY Name");
		
		if($_GET["cmd"] == TRUE)
		{
			$Character_Get = $_POST["Character_Get"];
			$Resets = $_POST["Resets"];
			
			if(empty($Character_Get))
			{
				exit("<div class=\"warning-box\"> Selecione o personagem a receber.</div>");
			}
			elseif(empty($Resets))
			{
				exit("<div class=\"warning-box\"> Digite o numero de Resets a transferir.</div>");
			}
			elseif($Find_Resets[0] < $_Panel["Char"]["Transfer_Resets"]["Min_Total"])
			{
				exit("<div class=\"error-box\"> Para transferir voc&ecirc; precisa ter no minimo <strong>".$_Panel["Char"]["Transfer_Resets"]["Min_Total"]." Resets</strong>.</div>");
			}
			elseif($Resets < $_Panel["Char"]["Transfer_Resets"]["Min_Send"])
			{
				exit("<div class=\"error-box\"> Voc&ecirc; pode transferir no minimo <strong>".$_Panel["Char"]["Transfer_Resets"]["Min_Send"]." Resets</strong>.</div>");
			}
			elseif($Find_Resets[0] < $Resets)
			{
				exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o tem Resets suficientes.</div>");
			}
			else
			{
				$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET ".Column_Reset."=".Column_Reset."-{$Resets} WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET ".Column_Reset."=".Column_Reset."+{$Resets} WHERE Name='{$Character_Get}' and AccountID='{$this->Login}'");
				$this->WriteLog("TRANSFER_RESETS", "Transferido ".$Resets." resets para <i>".$Character_Get."</i>");
				exit("<div class=\"success-box\"> Transferido <strong>{$Resets} Resets</strong> para o personagem <strong>{$Character_Get}</strong> com Sucesso!</div>");
			}
		}
		
		while($Foreach = $this->Fetch($Find_Chars))
		{
			$Disable = $Foreach[0] == $Character ? " disabled=\"disabled\"" : NULL;
			$Value = $Foreach[0] == $Character ? NULL : $Foreach[0];
			$Characters .= "<option value=\"{$Value}\" {$Disable}>{$Foreach[0]}</option>";
		}
		
		$CTM_Template->Set("%CHAR_RESETS%", $Find_Resets[0]);
		$CTM_Template->Set("%CHARACTER_LIST%", $Characters);
		$CTM_Template->Set("%RESETS_MIN%", $_Panel["Char"]["Transfer_Resets"]["Min_Total"]);
		$CTM_Template->Set("%RESETS_SEND%", $_Panel["Char"]["Transfer_Resets"]["Min_Send"]);
		unset($Characters);
	}
	private function Trade_ResetsCash()
	{
		global $CTM_Template, $_Panel;
		$Name = constant("Coin_".$_Panel["Char"]["Trade_RCash"]["Coin"]);
		$Column = constant("GL_Column_".$_Panel["Char"]["Trade_RCash"]["Coin"]);
		
		$Character = $_SESSION["Web_ManageChar"];
		$Find_Char = $this->FetchQuery("SELECT ".Column_Reset.",AccountID FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
		$Resets = $Find_Char[0] - $_Panel["Char"]["Trade_RCash"]["Register_Bonus"];
		
		if($_GET["cmd"] == TRUE)
		{
			$Coin = $_POST["Coin"];
			$Price = $Coin * $_Panel["Char"]["Trade_RCash"]["Price"];
			
			if(empty($Coin))
			{
				exit("<div class=\"warning-box\"> Digite a quantidade de <strong>".$Name."</strong> que gostaria de receber.</div>");
			}
			elseif($Resets < $_Panel["Char"]["Trade_RCash"]["Min_Total"])
			{
				exit("<div class=\"error-box\"> Voc&ecirc; precisa conter ".$_Panel["Char"]["Trade_RCash"]["Price"]." Resets para continuar.</div>");
			}
			elseif($Coin < $_Panel["Char"]["Trade_RCash"]["Min_Send"])
			{
				exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o pode requisitar menos de ".$_Panel["Char"]["Trade_RCash"]["Min_Send"]." {$Name}.</div>");
			}
			elseif($Resets < $Price)
			{
				exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o tem Resets suficientes.</div>");
			}
			else
			{
				$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".$Column."=".$Column."+{$Coin} WHERE ".GL_Login."='{$Find_Char[1]}';\nUPDATE ".MuGen_DB.".dbo.Character SET ".Column_Reset."=".Column_Reset."-{$Price} WHERE Name='{$Character}'");
				$New_Reset = $Find_Char[0] - $Price;
				$this->WriteLog("TRADE_RCASH", "Trocado ".$Resets." resets");
				exit("<div class=\"success-box\"> Troca efetuada com Sucesso!<br /><br />Voc&ecirc; agora tem <strong>".$New_Reset." Resets</strong>.</div>");
			}
		}
		$CTM_Template->Set("%CHAR_RESETS%", $Resets);
		$CTM_Template->Set("%COIN_PRICE%", $_Panel["Char"]["Trade_RCash"]["Price"]);
		$CTM_Template->Set("%COIN_NAME%", $Name);
	}
	private function Clear_PK()
	{
		global $CTM_Template, $_Panel;
		
		$Account = $this->FetchQuery("SELECT ".VIP_Column." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='".$this->Login."'");
		
		switch($Account[0])
		{
			case 0 : $Money = $_Panel["Char"]["Clear_PK"]["Money"][0]; break;
			case 1 : $Money = $_Panel["Char"]["Clear_PK"]["Money"][1]; break;
			case 2 : $Money = $_Panel["Char"]["Clear_PK"]["Money"][2]; break;
			case 3 : $Money = $_Panel["Char"]["Clear_PK"]["Money"][3]; break;
			case 4 : $Money = $_Panel["Char"]["Clear_PK"]["Money"][4]; break;
			case 5 : $Money = $_Panel["Char"]["Clear_PK"]["Money"][5]; break;
		}
		$CTM_Template->Set("PK_Money", $Money);
		$Character = $_SESSION["Web_ManageChar"];
		$Find_Char = $this->FetchQuery("SELECT PkLevel,Money,PkCount FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}' and AccountID='{$this->Login}'");
		
		if($_GET["cmd"] == TRUE)
		{	
			if($Find_Char[1] < $Money)
			{
				$this->Error .= "&raquo; N&atilde;o contem Zen suficiente<br />\n";
			}
			if(!($Find_Char[0] <> 3))
			{
				$this->Error .= "&raquo; Voc&ecirc; n&atilde;o est&aacute; PK/Hero<br />\n";
			}
			
			if($this->Error == TRUE)
			{
				exit("<div class=\"error-box\"> O seguintes erros foram encontrados:<br /><br />{$this->Error}</div>");
			}
			else
			{
				$column = $Find_Char[0] != 3 && $Find_Char[0] < 3 ? RANKING_HERO_COLUMN : RANKING_PK_COLUMN;
				$count = (integer)str_replace("-", NULL, $Find_Char[2]);
				
				$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET PkLevel=3,{$column}={$column}+{$count},PkCount=0,PkTime=0,Money=Money-{$Money} WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				$this->WriteLog("CLEAR_PK");
				exit("<div class=\"success-box\"> PK/Hero Limpo com Sucesso!</div>");
			}
		}
	}
	private function Change_Class()
	{
		global $CTM_Template, $CTM_General, $_ClassType;
		
		$Character = $_SESSION["Web_ManageChar"];
		$Find_Char = $this->FetchQuery("SELECT Class FROM ".MuGen_DB.".dbo.Character WHERE Name='".$Character."' and AccountID='{$this->Login}'");
		
		$Class_List .= "<option value=\"".$_ClassType["DW"][0]."\">".$_ClassType["DW"][1]."</option>
	  	<option value=\"".$_ClassType["SM"][0]."\">".$_ClassType["SM"][1]."</option>\n";
	  	if(GS_Version > 2)
	  	{
		  	$Class_List .= "<option value=\"".$_ClassType["GM"][0]."\">".$_ClassType["GM"][1]."</option>\n";
	  	}
	  	$Class_List .= "
	  	<option value=\"".$_ClassType["DK"][0]."\">".$_ClassType["DK"][1]."</option>
	  	<option value=\"".$_ClassType["BK"][0]."\">".$_ClassType["BK"][1]."</option>\n";
	  	if(GS_Version > 2)
	  	{
		  	$Class_List .= "<option value=\"".$_ClassType["BM"][0]."\">".$_ClassType["BM"][1]."</option>\n";
	  	}
	  	$Class_List .= "
	  	<option value=\"".$_ClassType["FE"][0]."\">".$_ClassType["FE"][1]."</option>
	  	<option value=\"".$_ClassType["ME"][0]."\">".$_ClassType["ME"][1]."</option>\n";
	  	if(GS_Version > 2)
	  	{
		  	$Class_List .= "<option value=\"".$_ClassType["HE"][0]."\">".$_ClassType["HE"][1]."</option>\n";
	  	}
	  	$Class_List .= "
	  	<option value=\"".$_ClassType["MG"][0]."\">".$_ClassType["MG"][1]."</option>\n";
	  	if(GS_Version > 2)
	  	{
		  	$Class_List .= "<option value=\"".$_ClassType["DM"][0]."\">".$_ClassType["DM"][1]."</option>\n";
	  	}
	  	if(GS_Version > 0)
	  	{
		  	$Class_List .= "<option value=\"".$_ClassType["DL"][0]."\">".$_ClassType["DL"][1]."</option>\n";
		  	if(@GS_Version > 2)
		  	{
			  	$Class_List .= "<option value=\"".$_ClassType["LE"][0]."\">".$_ClassType["LE"][1]."</option>\n";
		  	}
	  	}
	  	if(GS_Version > 3)
	  	{
		  	$Class_List .= "<option value=\"".$_ClassType["SU"][0]."\">".$_ClassType["SU"][1]."</option>\n";
		  	$Class_List .= "<option value=\"".$_ClassType["BS"][0]."\">".$_ClassType["BS"][1]."</option>\n";
		  	$Class_List .= "<option value=\"".$_ClassType["DIM"][0]."\">".$_ClassType["DIM"][1]."</option>\n";
	  	}
	  	if(GS_Version >= 6)
	  	{
		  	$Class_List .= "<option value=\"".$_ClassType["RF"][0]."\">".$_ClassType["RF"][1]."</option>\n";
		  	$Class_List .= "<option value=\"".$_ClassType["FM"][0]."\">".$_ClassType["FM"][1]."</option>\n";
	  	}
		$Find = $this->FetchQuery("SELECT Class FROM ".MuGen_DB.".dbo.Character WHERE Name='".$_SESSION["Web_ManageChar"]."'");
		$CTM_Template->Set("Character_Class", $CTM_General->ClassName($Find[0])); 
		$CTM_Template->Set("Class_Select", $Class_List);
		unset($Class_List);
		
		if($_GET["cmd"] == TRUE)
		{
			$Class = $_POST["Class"];
			
			if($Find_Char[0] == $Class)
			{
				exit("<div class=\"warning-box\"> Sua classe atual &eacute; <b>".$CTM_General->ClassName($Class)."</b>!<br />Voc&ecirc; n&atilde;o pode alterar sua classe para a classe atual.</div>");
			}
			else
			{
				$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET Class={$Class},MagicList=".$CTM_General->GetHexVoid("skill")." WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				if(constant("Server_Files") == 0)
				{
					$this->Query("DELETE ".MuGen_DB.".dbo.T_MasterLevelSystem WHERE CHAR_NAME='{$Character}'");
				}
				if(constant("Server_Files") == 2)
				{
					$this->Query("DELETE ".MuGen_DB.".dbo.MasterSkillTree WHERE Name='{$Character}'");
				}
				$this->WriteLog("CHANGE_CLASS", "Classe anterior: ".$CTM_General->ClassName($Find_Char[0]));
				exit("<div class=\"success-box\"> Sua classe foi alterarada para <strong>".$CTM_General->ClassName($Class)."</strong> com Sucesso!</div>");
			}
		}
	}
	private function Change_Nick()
	{
		global $CTM_Template, $CTM_Crypt, $CTM, $_Panel, $_Ranking;
		$CTM_Captcha = new CTM_Captcha();
		
		$Character = $_SESSION["Web_ManageChar"];
		
		$CTM_Template->Set("Manage_Character", $Character);
		$CTM_Template->Set("Captcha_Image", "?public=captcha");
		
		if($_GET["cmd"] == TRUE)
		{
			$Nick = $_POST["Nick"];
			$Captcha = $_POST["Captcha"];
			
			$Check_Nick = $this->NumQuery("SELECT Name FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Nick}'");
			$Check_Img = $this->FetchQuery("SELECT {$CTM[C][0]} FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}' and AccountID='".$this->Login."'");
			
			if($_Panel["Char"]["Change_Nick"]["CheckGuild"] == 1)
			{
				$Check_Guild = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.GuildMember WHERE Name='".$Character."'");
			}
			
			if(empty($Nick)) { $this->Error[0] .= "&raquo; Novo Nick<br />\n"; }
			if(empty($Captcha)) { $this->Error[0] .= "&raquo; Codigo de Seguran&ccedil;a<br />\n"; }
			if(strlen($Nick) < 4)
			{
				$this->Error[1] .= "&raquo; Minimo 4 Caracteres<br />\n";
			}
			if(strlen($Nick) > 10)
			{
				$this->Error[1] .= "&raquo; Maximo 10 Caracteres<br />\n";
			}
			if(eregi("[^a-zA-Z0-9_!=?&-]", $Nick))
			{
				$this->Error[1] .= "&raquo; Caracteres inv&aacute;lidos<br />\n";
			}
			if($Check_Nick > 0)
			{
				$this->Error[1] .= "&raquo; O Nick informado j&aacute; existe<br />\n";
			}
			if($_Panel["Char"]["Change_Nick"]["CheckGuild"] == 1)
			{
				if($Check_Guild > 0)
				{
					$this->Error[1] .= "&raquo; Saia da Guild antes de alterar o Nick<br />\n";
				}
			}
			for($WzAG = 0; $WzAG < count($_Panel["Char"]["Change_Nick"]["Security"]); $WzAG++)
			{
				$Security .= stristr($Nick,$_Panel["Char"]["Change_Nick"]["Security"][$WzAG]);
			}
			if($Security == TRUE)
			{
				$this->Error[1] .= "&raquo; Este Nick contem informa&ccedil;&otilde;es invalidas<br />\n";
			}
			if($CTM_Captcha->Check($Captcha) == FALSE)
			{
				$this->Error[1] .= "&raquo; Codigo de Seguran&ccedil;a incorreto<br />\n";
			}
			if($this->Error[0] == TRUE)
			{
				exit("<div class=\"warning-box\"> Os seguinte campos se encontram em Branco:<br /><Br />{$this->Error[0]}</div>");
			}
			elseif($this->Error[1] == TRUE)
			{
				exit("<div class=\"error-box\"> Os seguintes erros foram encontrados:<br /><br />{$this->Error[1]}</div>");
			}
			else
			{
				$prepare = NULL;
				$prepare .= "UPDATE ".MuGen_DB.".dbo.Guild SET G_Master = '{$Nick}' WHERE G_Master = '{$Character}';\n";
				$prepare .= "UPDATE ".MuGen_DB.".dbo.GuildMember SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
				if(GS_Version > 1)
				{
					$prepare .= "UPDATE ".MuGen_DB.".dbo.T_CGuid SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.T_FriendMain SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.T_FriendMail SET FriendName = '{$Nick}' WHERE FriendName = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.T_FriendList SET FriendName = '{$Nick}' WHERE FriendName = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.T_WaitFriend SET FriendName = '{$Nick}' WHERE FriendName = '{$Character}';\n";
				}
				if(Server_Files == 0)
				{
					$prepare .= "UPDATE ".MuGen_DB.".dbo.OptionData SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.T_MasterLevelSystem SET CHAR_NAME = '{$Nick}' WHERE CHAR_NAME = '{$Character}';\n";

					if($_Ranking["Gens"]["Enable"] === TRUE)
					{
						$prepare .= "UPDATE ".MuGen_DB.".dbo.T_GensSystem SET CHAR_NAME = '{$Nick}' WHERE CHAR_NAME = '{$Character}';\n";
					}
				}
				if(Server_Files == 1)
				{
					$prepare .= "UPDATE ".MuGen_DB.".dbo.OptionData SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
				}
				if(Server_Files == 2)
				{
					$prepare .= "UPDATE ".MuGen_DB.".dbo.OptionData SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.QuestWorld SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.QuestKillCount SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.RankingBloodCastle SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.RankingDevilSquare SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.RankingChaosCastle SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.RankingIllusionTemple SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.RankingDuel SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.Gens_Rank SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.Gens_Reward SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.EventSantaClaus SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
					$prepare .= "UPDATE ".MuGen_DB.".dbo.EventLeoTheHelper SET Name = '{$Nick}' WHERE Name = '{$Character}';\n";
				}
				$img = NULL;
				if(!empty($Check_Img[0]))
				{
					$Crypt = $CTM_Crypt->CharImg($Nick.time());
					$File = explode(".", $Check_Img[0]);
					@rename(constant("Upload_Img").$Check_Img[0],$Request."/".$Crypt.".".$File[1]);
					$img = ",{$CTM[C][0]} = '".$Crypt.".".$File[1]."'";
				}
				$prepare .= "UPDATE ".MuGen_DB.".dbo.AccountCharacter SET GameID1 = '{$Nick}' WHERE GameID1 = '{$Character}' AND Id = '".$this->Login."';\n";
				$prepare .= "UPDATE ".MuGen_DB.".dbo.AccountCharacter SET GameID2 = '{$Nick}' WHERE GameID2 = '{$Character}' AND Id = '".$this->Login."';\n";
				$prepare .= "UPDATE ".MuGen_DB.".dbo.AccountCharacter SET GameID3 = '{$Nick}' WHERE GameID3 = '{$Character}' AND Id = '".$this->Login."';\n";
				$prepare .= "UPDATE ".MuGen_DB.".dbo.AccountCharacter SET GameID4 = '{$Nick}' WHERE GameID4 = '{$Character}' AND Id = '".$this->Login."';\n";
				$prepare .= "UPDATE ".MuGen_DB.".dbo.AccountCharacter SET GameID5 = '{$Nick}' WHERE GameID5 = '{$Character}' AND Id = '".$this->Login."';\n";
				$prepare .= "UPDATE ".MuGen_DB.".dbo.AccountCharacter SET GameIDC = '{$Nick}' WHERE GameIDC = '{$Character}' AND Id = '".$this->Login."';\n";
				$prepare .= "UPDATE ".MuGen_DB.".dbo.Character SET Name = '{$Nick}'{$img} WHERE Name = '{$Character}';";
				$this->Query($prepare);
				$_SESSION["Web_ManageChar"] = $Nick;
				$this->WriteLog("CHANGE_NICK", "Novo nick: ".$Nick);
				exit("<script>CTM_Load('?pag=panel&cmd=char','Panel_Char','GET');</script>
				<div class=\"success-box\"> Nick alterado para <strong>{$Nick}</strong> com Sucesso!</div>");
			}
		}
		if($_GET["cmd"] == "check_captcha")
		{
			$Captcha = $_GET["captcha"];
				
			if(empty($Captcha))
			{
				exit("<script>VerifyDatas('Captcha', 'CaptchaResult', 'Campo em branco', '#efdc75', 'warning');</script>");
			}
			else
			{
				if($CTM_Captcha->Check($Captcha) == FALSE)
				{
					exit("<script>VerifyDatas('Captcha', 'CaptchaResult', 'Codigo de Seguan&ccedil;a Incorreto', '#FF0000', 'error');</script>");
				}
				else
				{
					exit("<script>VerifyDatas('Captcha', 'CaptchaResult', 'Codigo de Seguan&ccedil;a v&aacute;lido', 'green', 'success');</script>");
				}
			}
		}
	}
	private function Move_Char()
	{
		global $CTM_General, $CTM_Template, $_MapInfo;
		
		$Character = $_SESSION["Web_ManageChar"];
		$Find_Query = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}' and AccountID='{$this->Login}'");
		$Find_Char = $this->FetchArray($Find_Query);
		
		if($_GET["cmd"] == TRUE)
		{
			$Map = $_POST["Map"];
			
			for($WzAG = 0; $WzAG < count($_MapInfo); $WzAG++)
			{
				$MapNumber = $_MapInfo[$WzAG][0];
				if($Map == $MapNumber)
				{
					$MapPosX = $_MapInfo[$WzAG][1];
					$MapPosY = $_MapInfo[$WzAG][2];
					$MapName = $_MapInfo[$WzAG][3];
				}
			}
			
			$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET MapNumber='{$Map}',MapPosX='{$MapPosX}',MapPosY='{$MapPosY}' WHERE Name='{$Character}' and AccountID='{$this->Login}'");
			$this->WriteLog("MOVE_CHAR", "Antes: ".$_MapInfo[$Find_Char['MapPosX']][3]." - Agora: ".$MapName);
			exit("<div class=\"success-box\"> Personagem movido para <strong>".$MapName."</strong> com Sucesso!</div>");
		}
		for($_WzAG = 0; $_WzAG < count($_MapInfo); $_WzAG++)
	  	{
		  	$Return .= "<option value=\"".$_MapInfo[$_WzAG][0]."\">".$_MapInfo[$_WzAG][3]."</option>";
	  	}
		$CTM_Template->Set("Map_List", $Return);
		unset($Return);
	}
	private function Profile_Char()
	{
		global $CTM_Template, $CTM;
		
		$Character = $_SESSION["Web_ManageChar"];
		$Find_Profile = $this->FetchQuery("SELECT Status FROM dbo.{$CTM[4]} WHERE Character='{$Character}'");
		
		if($_GET["cmd"] == TRUE)
		{
			switch($Find_Profile[0])
			{
				case 0 : $Message = "Habilitado"; break;
				case 1 : $Message = "Desabilitado"; break;
			}
			if($Find_Profile[0] == 0)
			{
				$this->Query("UPDATE dbo.{$CTM[4]} SET Status=1 WHERE Character='{$Character}'");
			}
			elseif($Find_Profile[0] == 1)
			{
				$this->Query("UPDATE dbo.{$CTM[4]} SET Status=0 WHERE Character='{$Character}'");
			}
			$this->WriteLog("PROFILE_CHAR", "Perfil {$Message}");
			exit("<div class=\"success-box\"> Perfil <b>{$Message}</b> com Sucesso!</div>");
		}
		$Find = $this->FetchQuery("SELECT Status FROM dbo.{$CTM[4]} WHERE Character='".$_SESSION["Web_ManageChar"]."'");
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[4]} WHERE Character='".$_SESSION["Web_ManageChar"]."'");

		if($Check < 1)
		{
			$this->Query("INSERT INTO dbo.{$CTM[4]} (Status,Character) VALUES (1,'".$_SESSION["Web_ManageChar"]."')");
		}

		switch($Find[0])
		{
			case 0 : $Status = array("Desabilitado", "Habilita-lo", "Habilitar"); break;
			case 1 : $Status = array("Habilitado", "Desabilita-lo", "Desabilitar"); break;
		}
		$CTM_Template->Set("Profile_Status#1", $Status[0]);
		$CTM_Template->Set("Profile_Status#2", $Status[1]);
		$CTM_Template->Set("Profile_Status#3", $Status[2]);
	}
	private function Upload_Img()
	{
		global $CTM_General, $CTM_Crypt, $CTM_Template, $CTM;
		
		echo("<title>".utf8_decode(Web_Title)." - Powered By: CTM TeaM"."</title>
			<style type=\"text/css\"> 
				@import url('templates/Default/modules/css/Erick-Master.css');
			</style>");
		
		if($_GET["cmd"] == "upload")
		{
			$Character = $_SESSION["Web_ManageChar"];
			$Check_Image = $this->FetchQuery("SELECT {$CTM[C][0]} FROM ".MuGen_DB.".dbo.Character WHERE Name='".$Character."' and AccountID='".$_SESSION["Hash_Account"]."'");

			$CTM_FileUpload = new CTM_FileUpload();
			$CTM_FileUpload->Upload = "Char_Image";
			$CTM_FileUpload->File_Type = 1;
			$CTM_FileUpload->Size = constant("Image_Size");
			$CTM_FileUpload->Directory = constant("Upload_Img");
			$CTM_FileUpload->Name = $CTM_Crypt->CharImg($Character.time());
			//$CTM_FileUpload->Reduce = FALSE;
			//$CTM_UploadImg->Pixel = "116,125";
	
			$CTM_FileUpload->Command();

			if($CTM_FileUpload->Error == FALSE)
			{
				preg_match("/\.(gif|png|jpg|jpeg){1}$/i", $CTM_FileUpload->File["name"], $Extension);
				$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET {$CTM[C][0]}='".$CTM_FileUpload->Name.".".$Extension[1]."' WHERE Name='".$Character."' and AccountID='".$_SESSION["Hash_Account"]."'");
				
				$this->WriteLog("UPLOAD_IMG", "Atualizado imagem: ".$CTM_FileUpload->Name.".".$Extension[1]);
				@unlink($CTM_FileUpload->Directory.$Check_Image[0]);
				
			}
			$Return = $CTM_FileUpload->Return_Cmd;
		}
		if($_GET["cmd"] == "delete")
		{
			global $CTM_General, $CTM;
			$Character = $_SESSION["Web_ManageChar"];
		
			if(file_exists($CTM_General->Image($Character)) == FALSE || $CTM_General->Image($Character) == constant("Upload_Img")."nophoto.gif")
			{
				$Return = "<div class=\"warning-box\"> Voc&ecirc; n&atilde;o possui uma Imagem</div>";
			}
			else
			{
				unlink($CTM_General->Image($Character));
				$this->WriteLog("UPLOAD_IMG", "Deletado image: ".$CTM_General->Image($Character));
				$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET {$CTM[C][0]}=NULL WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				$Return = "<div class=\"success-box\"> Imagem removida com Sucesso!</div>";
			}
		}
		$CTM_Template->Set("Command_Result", $Return == TRUE ? $Return : NULL);
	}
	private function Concert_Points()
	{
		global $_ClassType;
		
		if($_GET["cmd"] == TRUE)
		{
			$Character = $_SESSION["Web_ManageChar"];
			$Query = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
			$Find_Character = $this->FetchArray($Query);
			
			/************** Strength ***************/
			if($Find_Character["Strength"] == 0)
			{
				$Strength = $this->ResetPoints(0);
				$this->Set_Points[] = TRUE;
			}
			elseif($Find_Character["Strength"] > constant("Max_Points") || $Find_Character["Strength"] < 0)
			{
				$Strength = constant("Max_Points");
				$this->Set_Points[] = TRUE;
			}
			else
			{
				$Strength = $Find_Character["Strength"];
			}
			/************** Dexterity ***************/
			if($Find_Character["Dexterity"] == 0)
			{
				$Dexterity = $this->ResetPoints(1);
				$this->Set_Points[] = TRUE;
			}
			elseif($Find_Character["Dexterity"] > constant("Max_Points") || $Find_Character["Dexterity"] < 0)
			{
				$Dexterity = constant("Max_Points");
				$this->Set_Points[] = TRUE;
			}
			else
			{
				$Dexterity = $Find_Character["Dexterity"];
			}
			/************** Vitality ***************/
			if($Find_Character["Vitality"] == 0)
			{
				$Vitality = $this->ResetPoints(2);
				$this->Set_Points[] = TRUE;
			}
			elseif($Find_Character["Vitality"] > constant("Max_Points") || $Find_Character["Vitality"] < 0)
			{
				$Vitality = constant("Max_Points");
				$this->Set_Points[] = TRUE;
			}
			else
			{
				$Vitality = $Find_Character["Vitality"];
			}
			/************** Energy ***************/
			if($Find_Character["Energy"] == 0)
			{
				$Energy = $this->ResetPoints(3);
				$this->Set_Points[] = TRUE;
			}
			elseif($Find_Character["Energy"] > constant("Max_Points") || $Find_Character["Energy"] < 0)
			{
				$Energy = constant("Max_Points");
				$this->Set_Points[] = TRUE;
			}
			else
			{
				$Energy = $Find_Character["Energy"];
			}
			/************** Command ***************/
			if(
			($Find_Character["Class"] == $_ClassType["DL"][0]) ||
			($Find_Character["Class"] == $_ClassType["LE"][0]) ||
			($Find_Character["Class"] == $_ClassType["LE2"][0]))
			{
				$Is_Lord = TRUE;
				if($Find_Character[Column_Cmd] > constant("Max_Points") || $Find_Character[Column_Cmd] < 0)
				{
					$Command = constant("Max_Points");
					$this->Set_Points[] = TRUE;
				}
				else
				{
					$Command = $Find_Character[Column_Cmd];
				}
			}
			else
			{
				$Is_Lord = FALSE;
			}
			
			if(count($this->Set_Points) > 0)
			{
				$Command_Query = $Is_Lord == TRUE ? ",".constant("Column_Cmd")."=".$Command : NULL;
				$this->Query(
				"UPDATE ".MuGen_DB.".dbo.Character SET 
				Strength='{$Strength}',Dexterity='{$Dexterity}',Vitality='{$Vitality}',Energy='{$Energy}'{$Command_Query}
				WHERE Name='{$Character}'");
				$this->WriteLog("CONCERT_POINTS");
				exit("<div class=\"success-box\"> Seus pontos foram concertados com Sucesso!</div>");
			}
			else
			{
				exit("<div class=\"warning-box\"> Seus pontos est&atilde;o normais.</div>");
			}
		}
	}
	private function Reset_Points()
	{
		global $CTM_Template, $_ClassType, $_Panel;
		
		$Character = $_SESSION["Web_ManageChar"];
		$Find_Query = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}' and AccountID='{$this->Login}'");
		$Find_Char = $this->FetchArray($Find_Query);
		if(GS_Version > 0)
		{
			$Query_Cmd = ",".Column_Cmd;
		}
		
		if($_GET["cmd"] == TRUE)
		{
			$Strength = $Find_Char["Strength"];
			$Dexterity = $Find_Char["Dexterity"];
			$Vitality = $Find_Char["Vitality"];
			$Energy = $Find_Char["Energy"];
			if($Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0])
			{
				$Command = $Find_Char[Column_Cmd];
			}
			
			$Total = $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? $Strength+$Dexterity+$Vitality+$Energy+$Command : $Strength+$Dexterity+$Vitality+$Energy;
			$Total += $Find_Char["LevelUpPoint"];
			$Total -= 120;
			
			if(
			($Find_Char["Strength"] < $_Panel["Char"]["Reset_Points"]["Min"]) || 
			($Find_Char["Dexterity"] < $_Panel["Char"]["Reset_Points"]["Min"]) ||
			($Find_Char["Vitality"] < $_Panel["Char"]["Reset_Points"]["Min"]) ||
			($Find_Char["Energy"] < $_Panel["Char"]["Reset_Points"]["Min"]))
			{
				exit("<div class=\"error-box\"> Precisa ter no minimo ".$_Panel["Char"]["Reset_Points"]["Min"]." em todos os Stats</div>");
			}
			else
			{
				if($Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0])
				{
					$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET Strength=".$this->ResetPoints(0).",Dexterity=".$this->ResetPoints(1).",Vitality=".$this->ResetPoints(2).",Energy=".$this->ResetPoints(3).",".Column_Cmd."=".$this->ResetPoints(4).",LevelUpPoint={$Total} WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				}
				else
				{
					$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET Strength=".$this->ResetPoints(0).",Dexterity=".$this->ResetPoints(1).",Vitality=".$this->ResetPoints(2).",Energy=".$this->ResetPoints(3).",LevelUpPoint={$Total} WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				}
				$this->WriteLog("RESET_POINTS");
				exit("<div class=\"success-box\"> Pontos resetados com Sucesso!<br />Voc&ecirc; agora tem <strong>".$Total."</strong> pontos para distribuir</div>");
			}
		}
		$New_Points = $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? $Find_Char["Strength"]+$Find_Char["Dexterity"]+$Find_Char["Vitality"]+$Find_Char["Energy"]+$Find_Char[Column_Cmd] : $Find_Char["Strength"]+$Find_Char["Dexterity"]+$Find_Char["Vitality"]+$Find_Char["Energy"];
		$CTM_Template->Set("Char_Points", $Find_Char["LevelUpPoint"]);
		$CTM_Template->Set("Char_Strength", $Find_Char["Strength"]);
		$CTM_Template->Set("Char_Dexterity", $Find_Char["Dexterity"]);
		$CTM_Template->Set("Char_Vitality", $Find_Char["Vitality"]);
		$CTM_Template->Set("Char_Energy", $Find_Char["Energy"]);
		$CTM_Template->Set("Char_Command", $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? "&raquo; Comando: <b>".$Find_Char[constant("Column_Cmd")]."</b><br />" : NULL);
		
		$CTM_Template->Set("New_Points", $New_Points+$Find_Char["LevelUpPoint"] - 81);
		$CTM_Template->Set("New_Strength", 18);
		$CTM_Template->Set("New_Dexterity", 18);
		$CTM_Template->Set("New_Vitality", 15);
		$CTM_Template->Set("New_Energy", 30);
		$CTM_Template->Set("New_Command", $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? "&raquo; Comando: <b>0</b><br />" : NULL);
	}
	private function Distribute_Points()
	{
		global $CTM_Template, $_ClassType;
		
		$Character = $_SESSION["Web_ManageChar"];
		$Find_Query = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}' and AccountID='{$this->Login}'");
		$Find_Char = $this->FetchArray($Find_Query);
		
		if($_GET["cmd"] == TRUE)
		{
			$Strength = $_POST["Strength"];
			$Dexterity = $_POST["Dexterity"];
			$Vitality = $_POST["Vitality"];
			$Energy = $_POST["Energy"];
			if($Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0])
			{
				$Command = $_POST[Column_Cmd];
			}
			
			if(empty($Strength)) { $Strength = 0; }
			if(empty($Dexterity)) { $Dexterity = 0; }
			if(empty($Vitality)) { $Vitality = 0; }
			if(empty($Energy)) { $Energy = 0; }
			if($Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0])
			{
				if(empty($Command))
				{
					$Command = 0;
				}
			}
			
			$Total = $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? $Strength+$Dexterity+$Vitality+$Energy+$Command : $Strength+$Dexterity+$Vitality+$Energy;
			
			if($Find_Char["LevelUpPoint"] < $Total)
			{
				$this->Error .= "&raquo; Pontos insuficientes<br />\n";
			}
			if($Find_Char["Strength"]+$Strength > Max_Points) 
			{
				$this->Error .= "&raquo; Limite de Pontos em For&ccedil;a exedido<br />\n";
			}
			if($Find_Char["Dexterity"]+$Dexterity > Max_Points) 
			{
				$this->Error .= "&raquo; Limite de Pontos em Agilidade exedido<br />\n";
			}
			if($Find_Char["Vitality"]+$Vitality > Max_Points) 
			{
				$this->Error .= "&raquo; Limite de Pontos em Vitaligade exedido<br />\n";
			}
			if($Find_Char["Energy"]+$Energy > Max_Points) 
			{
				$this->Error .= "&raquo; Limite de Pontos em Energia exedido<br />\n";
			}
			if($Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0])
			{
				if($Find_Char[Column_Cmd]+$Command > Max_Points) 
				{
					$this->Error .= "&raquo; Limite de Pontos em Comando exedido<br />\n";
				}
			}
			
			if($this->Error == TRUE)
			{
				exit("<div class=\"error-box\"> Os seguintes erros foram encontrados:<br /><Br />{$this->Error}</div>");
			}
			elseif(eregi("[^0-9]", $Strength) || eregi("[^0-9]", $Dexterity) || eregi("[^0-9]", $Vitality) ||
			eregi("[^0-9]", $Energy) || (($Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0]) && eregi("[^0-9]", $Command)))
			{
				exit("<div class=\"warning-box\"> Digite somente numeros.</div>");
			}
			else
			{
				$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET Strength=Strength+{$Strength},Dexterity=Dexterity+{$Dexterity},Vitality=Vitality+{$Vitality},Energy=Energy+{$Energy} WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				if($Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0])
				{
					$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET ".Column_Cmd."=".Column_Cmd."+{$Command} WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				}
				$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET LevelUpPoint=LevelUpPoint-{$Total} WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				$Points = array($Find_Char["LevelUpPoint"]-$Total, $Find_Char["Strength"]+$Strength, $Find_Char["Dexterity"]+$Dexterity, $Find_Char["Vitality"]+$Vitality, $Find_Char["Energy"]+$Energy);
				$this->WriteLog("DISTRIBUTE_POINTS");
				if($Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0])
				{
					$Send_Cmd = $Find_Char[Column_Cmd]+$Command;
					exit("<div class=\"success-box\"> Pontos distribuidos com Sucesso!<br /><br />&raquo; For&ccedil;a: <b>{$Points[1]}</b><br />&raquo; Agilidade: <b>{$Points[2]}</b><br />&raquo; Vitalidade: <b>{$Points[3]}</b><br />&raquo; Energia: <b>{$Points[4]}</b><br />&raquo; Comando: <b>{$Send_Cmd}</b><br />&raquo; Pontos restantes: <b>{$Points[0]}</b></div>");
				}
				else
				{
					exit("<div class=\"success-box\"> Pontos distribuidos com Sucesso!<br /><br />&raquo; For&ccedil;a: <b>{$Points[1]}</b><br />&raquo; Agilidade: <b>{$Points[2]}</b><br />&raquo; Vitalidade: <b>{$Points[3]}</b><br />&raquo; Energia: <b>{$Points[4]}</b><br />&raquo; Pontos restantes: <b>{$Points[0]}</b></div>");
				}
			}
		}
		if($Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0])
		{
			$Find_Cmd = $this->FetchQuery("SELECT ".Column_Cmd." FROM ".MuGen_DB.".dbo.Character WHERE Name='".$_SESSION["Web_ManageChar"]."'");
		}
		
		$CTM_Template->Set("Char_Points", $Find_Char["LevelUpPoint"]);
		$CTM_Template->Set("Char_Strength", $Find_Char["Strength"]);
		$CTM_Template->Set("Char_Dexterity", $Find_Char["Dexterity"]);
		$CTM_Template->Set("Char_Vitality", $Find_Char["Vitality"]);
		$CTM_Template->Set("Char_Energy", $Find_Char["Energy"]);
		$CTM_Template->Set("Char_Command", $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? "&raquo; Comando: <b>".$Find_Char[constant("Column_Cmd")]."</b><br />" : NULL);
		$CTM_Template->Set("Command_Input", $Find_Char["Class"] == $_ClassType["DL"][0] || $Find_Char["Class"] == $_ClassType["LE"][0] || $Find_Char["Class"] == $_ClassType["LE2"][0] ? "<tr>
    	 	 <td>Comando:</td>
    	 	 <td><input type=\"text\" name=\"".Column_Cmd."\" id=\"".Column_Cmd."\" onKeyPress=\"return NumbersOnly(event)\" maxlength=\"5\" /></td>
	 	  </tr>" : NULL);
	}
	private function Clear_Char()
	{
		global $CTM_General;
		
		$Character = $_SESSION["Web_ManageChar"];
		
		if($_GET["cmd"] == TRUE)
		{
			$Inventory = $_POST["Inventory"];
			$Skills = $_POST["Skills"];
			$Money = $_POST["Money"];
			$Quests = $_POST["Quests"];
			
			if($Inventory == FALSE && $Skills == FALSE && $Money == FALSE && $Quests == FALSE)
			{
				exit("<div class=\"warning-box\"> Selecione pelo menos uma op&ccedil;&atilde;o a ser Limpa</div>");
			}
			else
			{
				if($Inventory == TRUE)
				{
					$cleaned .= "Invent&aacute;rio, ";
					$this->Selected .= "&raquo; Invent&aacute;rio Limpo<br />\n";
					$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET Inventory=".$CTM_General->GetHexVoid("inventory")." WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				}
				if($Skills == TRUE)
				{
					$cleaned .= "Skills, ";
					$this->Selected .= "&raquo; Skills Limpas<br />\n";
					$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET MagicList=".$CTM_General->GetHexVoid("skill")." WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				}
				if($Money == TRUE)
				{
					$cleaned .= "Zen, ";
					$this->Selected .= "&raquo; Zen Zerado<br />\n";
					$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET Money=0 WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				}
				if($Quests == TRUE)
				{
					$cleaned .= "Quests, ";
					$this->Selected .= "&raquo; Quests Resetadas<br />\n";
					$Class = $this->FetchQuery("SELECT Class FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}' and AccountID='{$this->Login}'");
					$Reset_Class = $this->ResetClass($Class[0]);
					$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET Quest=".$CTM_General->GetHexVoid("quest").",Class={$Reset_Class} WHERE Name='{$Character}' and AccountID='{$this->Login}'");
				}
				$this->WriteLog("CLEAR_CHAR", "Limpo: ".trim($cleaned, ", "));
				exit("<div class=\"success-box\"> Comando Efetuado com Sucesso!<br /><Br />{$this->Selected}</div>");
			}
		}
	}
	/*private function Repair_Inventory()
	{		
		global $CTM_General;
		
		if($_GET["cmd"] == TRUE)
		{
			$Character = $_SESSION["Web_ManageChar"];
			
			$Inventory_Size = $CTM_General->GetHexSize("inventory");
			$Item_Size = constant("GS_Version") >= 2 ? 32 : 20;
			
			for($i = 0; $i < $Inventory_Size / 216; $i++)
			{
				$Code = $i * 255;
				$Tech = $Code + 255;
				$Result = $this->FetchQuery("SELECT SubString(Inventory,{$Code}, {$Tech}) FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Character}'");
	
				$Inventory = $Inventory.$Result[0];
			}
			$Item_Hex = strtoupper(bin2hex($Inventory));
			
			for($i = 0; $i < strlen($Inventory) * 2; $i++)
			{
				if (($i % $Item_Size == 0))
				{
					$Binarry = substr($Item_Hex, $i, $Item_Size);
					if(strlen($Binarry) >= $Item_Size)
					{
						$New_Hex .= substr($Binarry, 0, 4)."FF".substr($Binarry, 6);
					}
				}
			}
			$this->Query("UPDATE ".MuGen_DB.".dbo.Character SET Inventory=0x{$New_Hex} WHERE Name='{$Character}'");
			exit("<div class=\"success-box\"> Invent&oacute;rio reparado com Sucesso!</div>");
		}
	}*/
	private function Open_Ticket()
	{
		global $CTM_Template, $CTM, $_Panel;
		
		if($_GET["cmd"] == TRUE)
		{
			$Title = base64_encode($_POST["Title"]);
			$Subject = base64_encode($_POST["Subject"]);
			$Character = $_POST["Character"];
			$Text = base64_encode(str_replace("\\", "", $_POST["Text"]));
			$Count = $this->FetchQuery("SELECT count(*) FROM dbo.{$CTM[3]} WHERE Account='{$this->Login}' and Status < 3");
			
			$Syntax = array("+", "-");
			$Rand[0] = mt_rand(1, 9);
			$Rand[1] = mt_rand(1, 9);
			$Protocol = strtotime("+ {$Rand[0]} days") + strtotime("+ {$Rand[1]} months");
			
			if(empty($Title)) { $this->Error[0] .= "&raquo; Titulo<br />\n"; }
			if(empty($Subject)) { $this->Error[0] .= "&raquo; Assunto<br />\n"; }
			if(empty($Character)) { $this->Error[0] .= "&raquo; Personagem<br />\n"; }
			if(empty($Text)) { $this->Error[0] .= "&raquo; Mensagem<br/ >\n"; }
			
			if($this->Error[0] == TRUE)
			{
				exit("<div class=\"warning-box\"> Preencha os seguintes campos:<br /><br />{$this->Error[0]}</div>");
			}
			elseif($Count[0] >= $_Panel["Suportt"]["Tickets"]["Limit_Open"])
			{
				exit("<div class=\"error-box\"> Voc&ecirc; chegou ao limite de Tickets abertos.<br />Aguarde o fechamento dos Tickets atuais.</div>");
			}
			else
			{
				$this->Query("INSERT INTO dbo.{$CTM[3]} (Protocol,Status,Title,Subject,Date,Account,Character,Text) VALUES ({$Protocol},0,'{$Title}','{$Subject}',".strtotime("now").",'{$this->Login}','{$Character}','{$Text}')");
				$this->WriteLog("TICKETS", "Tickets aberto");
				exit("<div class=\"success-box\"> Ticket aberto com Sucesso!<br />O numero do Protocolo &eacute; <b>".$Protocol."</b>.<br />Voc&ecirc; ser&aacute; respondido pela nossa equipe em 24 horas.<br />A equipe ".Server_Name." agradece o contato.</div>");
			}
		}
		echo("<script type=\"text/javascript\" src=\"modules/header/javascripts/SpryTabbedPanels.js\"></script>
		<style type=\"text/css\"> @import url('modules/css/SpryTabbedPanels.css'); </style>\n\r");

		$Query[0] = $this->Query("SELECT * FROM dbo.{$CTM[3]} WHERE Account='{$this->Login}' and Status=0 ORDER BY Id DESC");
		$Query[1] = $this->Query("SELECT * FROM dbo.{$CTM[3]} WHERE Account='{$this->Login}' and Status > 0 and Status < 3 ORDER BY Id DESC");
		$Query[2] = $this->Query("SELECT * FROM dbo.{$CTM[3]} WHERE Account='{$this->Login}' and Status=3 ORDER BY Id DESC");
		$Check[0] = $this->NumRow($Query[0]);
		$Check[1] = $this->NumRow($Query[1]);
		$Check[2] = $this->NumRow($Query[2]);

		$Query_Chars = $this->Query("SELECT Name FROM ".MuGen_DB.".dbo.Character WHERE AccountID='".$_SESSION["Hash_Account"]."'");

		$Count_Tickets = $this->FetchQuery("SELECT count(*) FROM dbo.{$CTM[3]} WHERE Account='".$_SESSION["Hash_Account"]."' and Status < 3");
		if($Check[0] < 1)
		{
			$Return_Open = "<div class=\"info-box\"> Voc&ecirc; n&atilde;o contem Tickets abertos no Momento</div>";
		}
		else
		{
			$Return_Open .= "
				<table width=\"100%\" border=\"0\">
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
                  	<td><a href=\"javascript: void(EffectWeb)\" onclick=\"CTM_Load('?pag=paneluser&str=VIEW_TICKET&id=".$Tickets_Open["Id"]."','Panel_Nav','GET');\">".base64_decode($Tickets_Open["Title"])."</a></td>
                  	<td>".$Status."</td>
                </tr>\n";
			}
			$Return_Open .= "
		</table>";
		}
		if($Check[1] < 1)
		{
			$Return_Progress = "<div class=\"info-box\"> Voc&ecirc; n&atilde;o contem Tickets em andamento no Momento</div>";
		}
		else
		{
			$Return_Progress  .= "
			<table width=\"100%\" border=\"0\">
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
				$Return_Progress  .= "
				<tr>
                  <td>".date("d/m/Y", $Tickets_Progress["Date"])."</td>
                  <td>".base64_decode($Tickets_Progress["Subject"])."</td>
                  <td><a href=\"javascript: void(EffectWeb)\" onclick=\"CTM_Load('?pag=paneluser&str=VIEW_TICKET&id=".$Tickets_Progress["Id"]."','Panel_Nav','GET');\">".base64_decode($Tickets_Progress["Title"])."</a></td>
                  <td>".$Status."</td>
                </tr>\n";
			}
			$Return_Progress .= "
		</table>";
		}
		if($Check[2] < 1)
		{
			$Return_Closed = "<div class=\"info-box\"> Voc&ecirc; n&atilde;o contem Tickets Fechados no Momento</div>";
		}
		else
		{
			$Return_Closed .= "
			<table width=\"100%\" border=\"0\">
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
                  <td><a href=\"javascript: void(EffectWeb)\" onclick=\"CTM_Load('?pag=paneluser&str=VIEW_TICKET&id=".$Tickets_Closed["Id"]."','Panel_Nav','GET');\">".base64_decode($Tickets_Closed["Title"])."</a></td>
                  <td>".$Status."</td>
                </tr\n>";
			}
			$Return_Closed .= "
		</table>";
		}
		for($WzAG = 0; $WzAG < count($_Panel["Suportt"]["Tickets"]["Departaments"]); $WzAG++)
		{
			$Return_Departaments .= "<option value=\"".utf8_decode($_Panel["Suportt"]["Tickets"]["Departaments"][$WzAG])."\">".utf8_decode($_Panel["Suportt"]["Tickets"]["Departaments"][$WzAG])."</option>\n";
		}
		while($Chars = $this->Fetch($Query_Chars))
		{
			$Return_Chars .= "<option value=\"{$Chars[0]}\">{$Chars[0]}</option>\n";
		}
		$CTM_Template->Set("Tickets_Open", $Return_Open);
		$CTM_Template->Set("Tickets_Progress", $Return_Progress);
		$CTM_Template->Set("Tickets_Closed", $Return_Closed);
		$CTM_Template->Set("Check_Limit", $Count_Tickets[0] >= $_Panel["Suportt"]["Tickets"]["Limit_Open"] ? "<div class=\"info-box\"> Voc&ecirc; chegou ao limite de Tickets abertos.<br />Aguarde o fechamento dos Tickets atuais.</div>" : NULL);
		$CTM_Template->Set("Departament_List", $Return_Departaments);
		$CTM_Template->Set("Character_List", $Return_Chars);
		unset($Return_Open);
		unset($Return_Progress);
		unset($Return_Closed);
		unset($Return_Departaments);
		unset($Return_Chars);
	}
	private function Resp_Ticket()
	{
		global $CTM_General, $CTM_Template, $CTM;
		
		if($_GET["exec"] == TRUE)
		{
			$Id = $_GET["id"];
			$this->Query("UPDATE dbo.{$CTM[3]} SET Status=3 WHERE Id='{$Id}'");
			exit("<div class=\"success-box\"> Ticket Fechado com Sucesso!</div>");
		}
		if($_GET["cmd"] == TRUE)
		{
			$Id = $_GET["id"];
			$Text = base64_encode(str_replace("\\", "", $_POST["Text"]));
			$Character = $this->FetchQuery("SELECT Character FROM dbo.{$CTM[3]} WHERE Id='{$Id}'");
			
			if(empty($Text))
			{
				exit("<div class=\"warning-box\"> Digite a mensagem.</div>");
			}
			else
			{
				$this->Query("INSERT INTO dbo.{$CTM[9]} (Date,Character,TicketID,Text) VALUES(".strtotime("now").",'{$Character[0]}',{$Id},'{$Text}')");
				$this->Query("UPDATE dbo.{$CTM[3]} SET Status=2 WHERE Id='{$Id}'");
				exit("<div class=\"success-box\"> Resposta enviada com Sucesso</div>");
			}
		}
		$CTM_BBCode = new CTM_BBCode();
		$Id = $_GET["id"];
		
		$Query = $this->Query("SELECT * FROM dbo.{$CTM[3]} WHERE Id='{$Id}'");
		$Check = $this->NumRow($Query);

		if($Check < 1)
		{
			exit("<div class=\"error-box\"> Este Ticket n&atilde;o existe.</div>");
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
		$Open = fopen("templates/".$CTM_Template->Open()."/pages/paneluser[TICKET_COMMENT].pag.php", "r");
		$CTM_Template->Set("Comment_Form", $Load["Status"] < 3 ? fread($Open, filesize("templates/".$CTM_Template->Open()."/pages/paneluser[TICKET_COMMENT].pag.php")) : NULL);
		$CTM_Template->Set("Ticket_ID", $Load["Id"]);
		$CTM_Template->Set("Ticket_Title", base64_decode($Load["Title"]));
		$CTM_Template->Set("Ticket_Char#Image", $Image);
		$CTM_Template->Set("Ticket_Character", $Load["Character"]);
		$CTM_Template->Set("Ticket_Date", date("d/m/Y", $Load["Date"]));
		$CTM_Template->Set("Ticket_Time", date("H:i", $Load["Date"]));
		$CTM_Template->Set("Ticket_Departament", base64_decode($Load["Subject"]));
		$CTM_Template->Set("Ticket_Status", $Status);
		$CTM_Template->Set("Ticket_Text", nl2br($CTM_BBCode->Replace(base64_decode($Load["Text"]))));
		$CTM_Template->Set("Resp_List", $Return);
		unset($Return);
	}
	private function Confirm_Payment()
	{
		global $CTM_Template, $CTM, $_BankList;
		
		if($_GET["exec"] == TRUE)
		{
			$Character = $_POST["Character"];
			$Golds = (int)$_POST["Amount"];
			$Bank = base64_encode($_POST["Bank"]);
			$Payment = $_POST["Payment"];
			$Price = $_POST["Price"];
			$Date = $_POST["Date"];
			$Master = $_POST["Master"];
			$Document = $_POST["Document"];
			$Text = @base64_encode(str_replace("\\", "", $_POST["Text"]));
			
			if(empty($Character)) { $this->Error .= "&raquo; Personagem<br />\n"; }
			if(empty($Golds)) { $this->Error .= "&raquo; Numero de ".Coin_1."<br />\n"; }
			if(empty($Bank)) { $this->Error .= "&raquo; Banco<br />\n"; }
			if(empty($Payment)) { $this->Error .= "&raquo; Tipo de Pagamento<br />\n"; }
			if(empty($Price)) { $this->Error .= "&raquo; Valor<br />\n"; }
			if(empty($Date)) { $this->Error .= "&raquo; Data<br />\n"; }
			if(empty($Master)) { $this->Error .= "&raquo; CTR/Terminal/N. Envelope<br />\n"; }
			if(empty($Document)) { $this->Error .= "&raquo; N. Documento<br />\n"; }
			if(empty($Text)) { $Text = NULL; }
			
			if($this->Error == TRUE)
			{
				exit("<div class=\"warning-box\"> Preencha os seguintes campos:<br /><br />{$this->Error}</div>");
			}
			else
			{
				$this->Query("INSERT INTO dbo.{$CTM[10]} (Account,Character,Status,Time,Golds,Price,Date,Bank,Payment,Master,Document,Text) VALUES ('{$this->Login}','{$Character}',0,".strtotime("now").",{$Golds},'{$Price}','{$Date}','{$Bank}','{$Payment}','{$Master}','{$Document}','{$Text}')");
				$this->WriteLog("PAYMENTS", "Pagamento aberto");
				exit("<div class=\"success-box\"> Pagamento confirmado com Sucesso!<br />Voc&ecirc; ser&aacute; atendimento pelo departamento Financeiro em 48 Horas.<br />A equipe ".Server_Name." agradece.</div>");
			}
		}
		echo("<script type=\"text/javascript\" src=\"modules/header/javascripts/SpryTabbedPanels.js\"></script>
		<style type=\"text/css\"> @import url('modules/css/SpryTabbedPanels.css'); </style>");

		$Query[0] = $this->Query("SELECT * FROM dbo.{$CTM[10]} WHERE Account='".$_SESSION["Hash_Account"]."' and Status < 1 ORDER BY Id DESC");
		$Query[1] = $this->Query("SELECT * FROM dbo.{$CTM[10]} WHERE Account='".$_SESSION["Hash_Account"]."' and Status > 0 ORDER BY Id DESC");
		$Check[0] = $this->NumRow($Query[0]);
		$Check[1] = $this->NumRow($Query[1]);

		$Get_Chars = $this->Query("SELECT Name FROM ".MuGen_DB.".dbo.Character WHERE AccountID='".$_SESSION["Hash_Account"]."'");
		
		if($Check[0] < 1)
		{
			$Return_Open = "<div class=\"info-box\"> Voc&ecirc; n&atilde;o contem Pagamentos abertos no Momento</div>";
		}
		else
		{
			$Return_Open .= "
			<table width=\"100%\" border=\"0\">
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
                  	<td>#".$Payment_Open["Id"]." <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=paneluser&str=VIEW_PAYMENT&id=".$Payment_Open["Id"]."','Panel_Nav','GET');\">[ Ver ]</a></td>
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
			$Return_Closed = "<div class=\"info-box\"> Voc&ecirc; n&atilde;o contem Pagamentos Fechados no Momento</div>";
		}
		else
		{
			$Return_Closed .= "
			<table width=\"100%\" border=\"0\">
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
                  	<td>#".$Payment_Close["Id"]." <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=paneluser&str=VIEW_PAYMENT&id=".$Payment_Close["Id"]."','Panel_Nav','GET');\">[ Ver ]</a></td>
                  	<td>".base64_decode($Payment_Close["Bank"])."</td>
                  	<td>".date("d/m/Y", $Payment_Close["Time"])." as ".date("H:i", $Payment_Close["Time"])."</td>
                  	<td>".$Status."</td>
                </tr>";
			}
			$Return_Closed .= "
		</table>";
		}
		while($Chars = $this->Fetch($Get_Chars))
		{
			$Return_Chars .= "<option value=\"{$Chars[0]}\">{$Chars[0]}</option>\n";
		}
		for($WzAG = 0; $WzAG < count($_BankList); $WzAG++)
		{
			$Return_Bank .= "<option value=\"".utf8_decode($_BankList[$WzAG][0])."\">".utf8_decode($_BankList[$WzAG][0])."</option>\n";
		}
		$CTM_Template->Set("Payment_Open", $Return_Open);
		$CTM_Template->Set("Payment_Closed", $Return_Closed);
		$CTM_Template->Set("Character_List", $Return_Chars);
		$CTM_Template->Set("Bank_List", $Return_Bank);
		unset($Return_Open);
		unset($Return_Closed);
		unset($Return_Chars);
		unset($Return_Bank);
	}
	private function Resp_Payment()
	{
		global $CTM_General, $CTM_Template, $CTM;
		$CTM_BBCode = new CTM_BBCode();
		
		if($_GET["cmd"] == TRUE)
		{
			$Id = $_GET["id"];
			$Text = base64_encode(str_replace("\\", "", $_POST["Text"]));
			$Character = $this->FetchQuery("SELECT Character FROM dbo.{$CTM[10]} WHERE Id='{$Id}'");
			
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
		$Id = $_GET["id"];
		$Query = $this->Query("SELECT * FROM dbo.{$CTM[10]} WHERE Id='{$Id}'");
		$Check = $this->NumRow($Query);

		if($Check < 1)
		{
			exit("<div class=\"error-box\"> Este Pagamento n&atilde;o existe.</div>");
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
		$CTM_Template->Set("Payment_Post#Date", date("d/m/Y", $Load["Time"]));
		$CTM_Template->Set("Payment_Char#Image", $Image);
		$CTM_Template->Set("Payment_Char", $Load["Character"]);
		$CTM_Template->Set("Payment_Post#Time", date("H:i", $Load["Time"]));
		$CTM_Template->Set("Payment_Amount", $Load["Golds"]);
		$CTM_Template->Set("Payment_Bank", base64_decode($Load["Bank"]));
		$CTM_Template->Set("Payment_Type", $Load["Payment"]);
		$CTM_Template->Set("Payment_Date", $Load["Date"]);
		$CTM_Template->Set("Payment_Price", $Load["Price"]);
		$CTM_Template->Set("Payment_Master", $Load["Master"]);
		$CTM_Template->Set("Payment_Document", $Load["Document"]);
		$CTM_Template->Set("Payment_Message", @nl2br($CTM_BBCode->Replace(@base64_decode($Load["Text"]))));
		$CTM_Template->Set("Payment_ID", $Load["Id"]);
		$CTM_Template->Set("Payment_Status", $Status);
		
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
		</blockquote>";
		}
		$CTM_Template->Set("Payment_Resp", $Return);
		unset($Return);
	}
	private function Trade_Amount()
	{
		global $CTM_Template, $_Panel;
		$Find_Cash = $this->FetchQuery("SELECT ".GL_Column_1.",".GL_Column_2.",".GL_Column_3." FROM ".GL_DB.".dbo.".GL_Table." WHERE ".GL_Login."='{$this->Login}'");
		
		if($_GET["cmd"] == TRUE)
		{
			$Find_Cash = $this->FetchQuery("SELECT ".GL_Column_1.",".GL_Column_2.",".GL_Column_3." FROM ".GL_DB.".dbo.".GL_Table." WHERE ".GL_Login."='{$this->Login}'");
			$Number_Amount = (int)$_POST["Coin_Number"];
			$Trade_Option = (int)$_POST["Trade_Option"];
			
			switch($Trade_Option)
			{
				case 1 : 
				$Change = $_Panel["Financial"]["Trade_Amount"]["Price"][0]; 
				$Query = 1;
				$Old_Amount = 2;
				$New_Amount = 1;
				break;
				case 2 : 
				$Change = $_Panel["Financial"]["Trade_Amount"]["Price"][1]; 
				$Query = 2;
				$Old_Amount = 3;
				$New_Amount = 1;
				break;
				case 3 : 
				$Change = $_Panel["Financial"]["Trade_Amount"]["Price"][2]; 
				$Query = 2;
				$Old_Amount = 3;
				$New_Amount = 2;
				break;
			}
				
			$Price = $Number_Amount * $Change;
			
			if(empty($Number_Amount) || empty($Trade_Option))
			{
				exit("<div class=\"warning-box\"> Preencha todos os Campos</div>");
			}
			elseif($Find_Cash[$Query] < $Price)
			{
				exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o contem ".constant("Coin_".$Old_Amount)." suficientes para trocar por <b>{$Number_Amount}</b> ".constant("Coin_".$New_Amount)."</div>");
			}
			else
			{
				$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".constant("GL_Column_".$New_Amount)."=".constant("GL_Column_".$New_Amount)."+".$Number_Amount." WHERE ".GL_Login."='{$this->Login}'");
				$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".constant("GL_Column_".$Old_Amount)."=".constant("GL_Column_".$Old_Amount)."-".$Price." WHERE ".GL_Login."='{$this->Login}'");
				$this->WriteLog("TRADE_AMOUNT", "Trocado ".$Price." ".constant("Coin_".$Old_Amount)." por ".$Number_Amount." ".constant("Coin_".$New_Amount));
				exit("<div class=\"success-box\"> Troca efetuada com Sucesso</div>");
			}
		}
		$CTM_Template->Set("Status_Coin#1", $Find_Cash[0]);
		$CTM_Template->Set("Status_Coin#2", $Find_Cash[1]);
		$CTM_Template->Set("Status_Coin#3", $Find_Cash[2]);
		$CTM_Template->Set("Price#1", $_Panel["Financial"]["Trade_Amount"]["Price"][0]);
		$CTM_Template->Set("Price#2", $_Panel["Financial"]["Trade_Amount"]["Price"][1]);
		$CTM_Template->Set("Price#3", $_Panel["Financial"]["Trade_Amount"]["Price"][2]);
	}
	private function Buy_VIP()
	{
		global $CTM_General, $CTM_Template, $_Panel, $_VIP;
		$CTM_General->Check_Coin_Table($this->Login);
		
		if($_GET["cmd"] == TRUE)
		{
			$Type = $_POST["Type"];
			$Value = $_POST["SetValue"];
			$Define = $_VIP[$Type][$Value];
			$Cash = $this->FetchQuery("SELECT ".GL_Column_1." FROM ".GL_DB.".dbo.".GL_Table." WHERE ".GL_Login."='".$this->Login."'");	
			if(empty($Type))
			{
				exit("<div class=\"warning-box\"> Selecione o Tipo de VIP</div>");
			}
			elseif($Cash[0] < $Define[1])
			{
				exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o contem ".Coin_1." suficientes</div>");
			}
			else
			{
				$VIP_Type = $CTM_General->Memb_Type($Type);
				$Time_Begin = strtotime("now");
				$Query = $this->Query("SELECT * FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='".$this->Login."'");
				$Check = $this->FetchArray($Query);
				if($Check[VIP_Column] == 1)
				{
					if($Type == 2)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_1."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_2."</b></div>");
					}
					elseif($Type == 3)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_1."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_3."</b></div>");
					}
					elseif($Type == 4)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_1."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_4."</b></div>");
					}
					elseif($Type == 5)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_1."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_5."</b></div>");
					}
					else
					{
						$VIP_Time = strtotime("+ ".$Define[0]." days", $Check[VIP_Time]);
					}
				}
				elseif($Check[VIP_Column] == 2)
				{
					if($Type == 1)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_2."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_1."</b></div>");
					}
					elseif($Type == 3)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_2."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_3."</b></div>");
					}
					elseif($Type == 4)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_2."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_4."</b></div>");
					}
					elseif($Type == 5)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_2."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_5."</b></div>");
					}
					else
					{
						$VIP_Time = strtotime("+ ".$Define[0]." days", $Check[VIP_Time]);
					}
				}
				elseif($Check[VIP_Column] == 3)
				{
					if($Type == 1)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_3."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_1."</b></div>");
					}
					elseif($Type == 2)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_3."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_2."</b></div>");
					}
					elseif($Type == 4)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_3."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_4."</b></div>");
					}
					elseif($Type == 5)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_3."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_5."</b></div>");
					}
					else
					{
						$VIP_Time = strtotime("+ ".$Define[0]." days", $Check[VIP_Time]);
					}
				}
				elseif($Check[VIP_Column] == 4)
				{
					if($Type == 1)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_4."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_1."</b></div>");
					}
					elseif($Type == 2)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_4."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_2."</b></div>");
					}
					elseif($Type == 3)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_4."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_3."</b></div>");
					}
					elseif($Type == 5)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_4."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_5."</b></div>");
					}
					else
					{
						$VIP_Time = strtotime("+ ".$Define[0]." days", $Check[VIP_Time]);
					}
				}
				elseif($Check[VIP_Column] == 5)
				{
					if($Type == 1)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_5."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_1."</b></div>");
					}
					elseif($Type == 2)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_5."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_2."</b></div>");
					}
					elseif($Type == 3)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_5."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_3."</b></div>");
					}
					elseif($Type == 4)
					{
						exit("<div class=\"info-box\"> Sua conta atualmente &eacute; <b>".VIP_5."</b>, aguarde o tempo do VIP terminar para comprar <b>".VIP_4."</b></div>");
					}
					else
					{
						$VIP_Time = strtotime("+ ".$Define[0]." days", $Check[VIP_Time]);
					}
				}
				else
				{
					$VIP_Time = strtotime("+ ".$Define[0]." days");
					$Begin = ",".VIP_Begin."={$Time_Begin}";
				}
				$VIP_End = date("d/m/Y", $VIP_Time)." as ".date("H:i", $VIP_Time);
				$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".GL_Column_1."=".GL_Column_1."-{$Define[1]} WHERE ".GL_Login."='".$this->Login."'");
				$this->Query("UPDATE ".VIP_DB.".dbo.".VIP_Table." SET ".VIP_Column."={$Type}{$Begin},".VIP_Time."={$VIP_Time},".VIP_Credits."=".VIP_Credits."+{$Define[0]} WHERE ".VIP_Login."='".$this->Login."'");
				$this->WriteLog("BUY_VIP", "Comprado ".$Define[0]." dias de ".$VIP_Type." vencendo em ".$VIP_End);
				exit("<div class=\"success-box\"> Sucesso! Sua conta agora &eacute; <b>".$VIP_Type."</b>.<br />Seu VIP vence em <b>".$VIP_End."</b>.");
			}
		}

		if($_GET["show"] == TRUE)
		{
			echo("
			<table width=\"100%\" border=\"0\">
			<tr>
			<td><strong>Tempo de VIP:</strong></td>
    		<td>
			<script type=\"text/javascript\">
			$(function()
			{
				$(\"#Value\").change(function()
				{
					$(\"#SetValue\").val($(\"#Value\").val());
				});
			});
			</script>
			<select name=\"Value\" id=\"Value\">\n");
			foreach($_VIP[$_GET["show"]] as $key => $value)
			{
				echo("<option value=\"".$key."\">".$value[0]." Dias (".$value[1]." ".Coin_1.")</option>\n");
			}
			exit("</select>
    		</td>
			</tr>
			</table>");
		}
		$Cash_Count = $this->FetchQuery("SELECT ".GL_Column_1." FROM ".GL_DB.".dbo.".GL_Table." WHERE ".GL_Login."='".$this->Login."'");
		$CTM_Template->Set("Number_Amount", $Cash_Count[0]);
	}
}
endif;
?>
