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

if(!class_exists("CTM_Pages")) :

class CTM_Pages
{
	public function GeneralPages()
	{
		global $CTM_General, $CTM_Template;
		
		if(isset($_GET["pag"]) == TRUE)
		{
			//self::loadAjaxCheck();
			
			$CTM_Security = new CTM_Security();

			switch($_GET["pag"])
			{
				/********* Home *********/
				case "home" :
				$CTM_Home = new CTM_Home();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/home.pag.php");
				break;
				/********* News *********/
				case "news" :
				$CTM_Notice = new CTM_Notices();
				break;
				/********* Panel User *********/
				case "paneluser" :
				global $CTM_General;
				$CTM_General->Check_Logged();
				$CTM_General->Check_Banned();
				$CTM_Security = new CTM_Security();
				$CTM_PanelUser = new CTM_PanelUser();
				break;
				/********* Panel Admin *********/
				case "paneladmin" :
				global $CTM_General;
				$CTM_General->Check_Logged();
				$CTM_General->Check_Banned();
				$CTM_General->Check_Staff();
				$CTM_Security = new CTM_Security();
				$CTM_PanelAdmin = new CTM_PanelAdmin();
				break;
				/********* Recovery *********/
				case "recovery" :
				$CTM_Recovery = new CTM_Recovery();
				break;
				/********* Info *********/
				case "info" :
				$CTM_Info = new CTM_Info("General");
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/info.pag.php");
				break;
				/********* Staff *********/
				case "staff" :
				$CTM_Info = new CTM_Info("Staff");
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/staff.pag.php");
				break;
				/********* Terms *********/
				case "terms" :
				$CTM_Info = new CTM_Info("Terms");
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/terms.pag.php");
				break;
				/********* Register *********/
				case "register" :
				$CTM_Register = new CTM_Register();
				break;
				/********* Downloads *********/
				case "downloads" :
				$CTM_Downloads = new CTM_Downloads();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/downloads.pag.php");
				break;
				/********* Ranking *********/
				case "ranking" :
				$CTM_Ranking = new CTM_Ranking();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/ranking.pag.php");
				break;
				/********* Search *********/
				case "search" :
				$CTM_Search = new CTM_Search();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/search.pag.php");
				break;
				/********* Contact *********/
				case "contact" :
				$CTM_Contact = new CTM_Contact();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/contact.pag.php");
				break;
				/********* Chat *********/
				case "chat" :
				$CTM_Template->Set("Chat_Scripts", constant("Chat_Scripts"));
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/chat.pag.php");
				break;
				/********* Online *********/
				case "online" :
				$CTM_Online = new CTM_Online();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/online.pag.php");
				break;
				/********* VIP / Cash *********/
				case "vip-cash" :
				$CTM_VipPage = new CTM_VipPage();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/vip-cash.pag.php");
				break;
				/********* ScreenShots *********/
				case "screenshots" :
				$CTM_ScreenShots = new CTM_ScreenShots(TRUE);
				break;
				/********* Banneds *********/
				case "banneds" :
				$CTM_Banneds = new CTM_Banneds();
				break;
				/*************************************************************************************
					@ Raffle System
				*************************************************************************************/
				case "raffles" :
				$CTM_RaffleSystem = new CTM_RaffleSystem(2);
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/raffles.pag.php");
				break;
				/************************************************************************************
					@ Custom Page
				*************************************************************************************/
				case $_GET["pag"] :
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/".$_GET["pag"].".pag.php");
				break;
				
			}
		}
	}
	private function loadAjaxCheck()
	{
		if(!($_GET['pag'] == "paneluser" && ($_GET['str'] == "UPLOAD_IMG" || $_GET['str'] ==  "ADD_SCREEN")))
		{
			$ajaxCheck = FALSE;
		
			$time = substr(time(), 0, -5);
			$cache = substr($_GET["cache"], 0, -8);
		
			if(md5($time) == md5($cache)) $ajaxCheck = TRUE;
			elseif($time > $cache)
			{
				if(md5($time) == md5($cache + 1)) $ajaxCheck = TRUE;
				elseif(md5($time) == md5($cache + 2)) $ajaxCheck = TRUE;
				elseif(md5($time) == md5($cache + 3)) $ajaxCheck = TRUE;
			}
			elseif($cache > $time)
			{
				if(md5($time + 1) == md5($cache)) $ajaxCheck = TRUE;
				elseif(md5($time + 2) == md5($cache)) $ajaxCheck = TRUE;
				elseif(md5($time + 3) == md5($cache)) $ajaxCheck = TRUE;
			}
			
			if(!$ajaxCheck) exit("<div class=\"error-box\"> Sess&atilde;o expirada. Atualize a p&aacute;gina.</div>");
		}
	}
	public function AjaxPages()
	{
		global $CTM_Template;
		
		if(isset($_GET["ajax"]) == TRUE)
		{
			//self::loadAjaxCheck();
			
			$CTM_Ajax = new CTM_Ajax();
			$CTM_Header = new CTM_Header();
			$CTM_Security = new CTM_Security();
			
			switch($_GET["ajax"])
			{
				case "panel" :
				$CTM_Ajax->Set_Panel();
				break;
				case "servers" :
				echo("<ul>");
				$CTM_Ajax->ServerList();
				exit("</ul>");
				break;
				case "poll" :
				$CTM_Header->Show_Poll();
				break;
				case "staff" :
				echo("<ul>");
				$CTM_Ajax->StaffList(@Staff_Code);
				exit("</ul>");
				break;
				case "check" :
				if($_GET["cmd"] == "servers")
				{
					$CTM_Ajax->RefreshServers();
				}
				break;
				default :
				"Erro no comando Ajax";
				break;
			}
		}
	}
	public function Index()
	{
		if($_GET["do"] == "recovery")
		{
			if($_GET["run"] == TRUE)
			{
				if($_GET["code"] == TRUE)
				{
					return "<script>CTM_Load('?pag=recovery&run=true&code=".$_GET["code"]."','conteudo','GET');</script>";
				}
				else
				{
					return "<script>CTM_Load('?pag=recovery&run=true','conteudo','GET');</script>";
				}
			}
		}
		elseif($_GET["do"] == "register")
		{
			if($_GET["run"] == TRUE)
			{
				if($_GET["code"] == TRUE)
				{
					return "<script>CTM_Load('?pag=register&run=true&code=".$_GET["code"]."','conteudo','GET');</script>";
				}
				else
				{
					return "<script>CTM_Load('?pag=register&run=true','conteudo','GET');</script>";
				}
			}
			else
			{
				return "<script>CTM_Load('?pag=terms&register=true','conteudo','GET');</script>";
			}
		}
		elseif($_GET["do"] == "paneluser")
		{
			if(strtoupper($_GET["str"]) == "CHANGE_MAIL")
			{
				if($_GET["run"] == TRUE)
				{
					if($_GET["code"] == TRUE)
					{
						return "<script>CTM_Load('?pag=paneluser&str=CHANGE_MAIL&run=true&code=".$_GET["code"]."','conteudo','GET');</script>";
					}
					else
					{
						return "<script>CTM_Load('?pag=paneluser&str=CHANGE_MAIL&run=true','conteudo','GET');</script>";
					}
				}
			}
		}
		elseif($_GET["do"] == "screenshots")
		{
			if($_GET["id"] == TRUE)
			{
					return "<script>CTM_Load('?pag=screenshots&view=".$_GET["id"]."','conteudo','GET');</script>";
			}
			else
			{
					return "<script>CTM_Load('?pag=screenshots','conteudo','GET');</script>";
			}
		}
		else
		{
			return "<script>CTM_Load('?pag=home','conteudo','GET');</script>";
		}
	}
	public function Redirect()
	{
		if($_GET["redirect"])
		{
			return header("Location: ".urldecode($_GET["redirect"])."");
		}
	}
}
endif;
?>