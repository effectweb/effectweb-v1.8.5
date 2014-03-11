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

if(!class_exists("CTM_General")) :

class CTM_General extends CTM_MSSQL
{
	protected function CallSecuritySite($secure_key)
	{
		if($secure_key != "B6A013A69733B5B30DCFCE78CD37B6DC")
			return false;
		else
			return "YTc2ZGJiMmZlNDY5ZThkNzkwYmU0ZjJhYWUyNDUwMDI=";
	}
	protected function init()
	{
		global $CTM_Template, $CTM_Pages, $CTM, $_RaffleSystem, $_Panel, $version;
		
		$this->Logout_Command();
		$CTM_Header = new CTM_Header();
		
		$GLOBALS['Check_Logged'] = $this->Check_Logged(false);
		
		if($GLOBALS['Check_Logged'])
		{
			$_SESSION['Hash_Account'] = str_replace(array("'", ";", "--"), NULL, $_SESSION['Hash_Account']);
			$_SESSION['Web_ManageChar'] = str_replace(array("'", ";", "--"), NULL, $_SESSION['Web_ManageChar']);
		}
		
		/***************************************************
			@ General
		****************************************************/
		$CTM_Template->Set("Server_Name", Server_Name);
		$CTM_Template->Set("%TITLE_WEB%", Web_Title);
		$CTM_Template->Set("Web_Version", $version->getVersion("full"));
		$CTM_Template->Set("Footer", "Effect Web ".$version->getVersion("full"));
		$CTM_Template->Set("Div#Panel", "<script>CTM_Load('?ajax=panel','Panel','GET');</script>");
		$CTM_Template->Set("Server_List", "<script>CTM_Load('?ajax=servers','Servers','GET');</script>");
		$CTM_Template->Set("Web_Poll", "<script>CTM_Load('?ajax=poll','Web_Poll','GET');</script>");
		$CTM_Template->Set("Staff_List", "<script>CTM_Load('?ajax=staff','StaffList','GET');</script>");
		$CTM_Template->Set("%WEB_NAVIGATION%", $CTM_Pages->Index());
		$CTM_Template->Set("Coin_1", Coin_1);
		$CTM_Template->Set("Coin_2", Coin_2);
		$CTM_Template->Set("Coin_3", Coin_3);
		$CTM_Template->Set("VIP_Name#1", VIP_1);
		$CTM_Template->Set("VIP_Name#2", VIP_2);
		$CTM_Template->Set("VIP_Name#3", VIP_3);
		$CTM_Template->Set("VIP_Name#4", VIP_4);
		$CTM_Template->Set("VIP_Name#5", VIP_5);
		$CTM_Template->Set("Year", date("Y"));
		
		/***************************************************
			@ Record
		****************************************************/
		$this->ServerRecord();
		$Record = $this->FetchQuery("SELECT Record,Data FROM dbo.{$CTM[1]} WHERE Type=1 ORDER BY id DESC");
		$CTM_Template->Set("Record_Gen#Date", date("d/m/Y", $Record[1]));
		$CTM_Template->Set("Record_Gen#Time", date("H:i", $Record[1]));
		$CTM_Template->Set("Record_Gen#Players", $Record[0]);
		
		/**************** Record Day *****************/
		$this->ServerRecord();
		$Record_Day = $this->FetchQuery("SELECT Record,Data FROM dbo.{$CTM[1]} WHERE Type=2");
		$CTM_Template->Set("Record_Day#Date", date("d/m/Y", $Record_Day[1]));
		$CTM_Template->Set("Record_Day#Time", date("H:i", $Record_Day[1]));
		$CTM_Template->Set("Record_Day#Players", $Record_Day[0]);
		
		/***************************************************
			@ Information
		****************************************************/
		switch(constant("Server_BB"))
		{
			case 0 : $_Info["BB"] = "<span style=\"color:red\">Offline</span>"; break;
			case 1 : $_Info["BB"] = "<span style=\"color:green;\">Online</span>"; break;
			case 2 : $_Info["BB"] = "<span style=\"color:blue;\">".constant("BB_Text")."</span>"; break;
		}
		switch($_Panel["Char"]["Reset"]["General"]["Mode"])
		{
			case 1 : $_Info["Reset_Type"] = "Acumulativo"; break;
			case 2 : $_Info["Reset_Type"] = "Pontuativo"; break;
			case 3 : $_Info["Reset_Type"] = "Tabelado"; break;
		}
		$_Info["Accounts"] = $this->ServerInfo(1, MuAcc_DB, "MEMB_INFO", FALSE, FALSE, FALSE);
		$_Info["Characters"] = $this->ServerInfo(1, MuGen_DB, "Character", FALSE, FALSE, FALSE);
		$_Info["Guilds"] = $this->ServerInfo(1, MuGen_DB, "Guild", FALSE, FALSE, FALSE);
		$_Info["VIP-1"] = $this->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 1, FALSE);
		$_Info["VIP-2"] = $this->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 2, FALSE);
		$_Info["VIP-3"] = $this->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 3, FALSE);
		$_Info["VIP-4"] = $this->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 4, FALSE);
		$_Info["VIP-5"] = $this->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 5, FALSE);
		$_Info["Acc_Ban"] = $this->ServerInfo(2, MuAcc_DB, "MEMB_INFO", "bloc_code", 1, FALSE);
		$_Info["Char_Ban"] = $this->ServerInfo(2, MuGen_DB, "Character", "CtlCode", 1, FALSE);
		/************************** @ Set Template @ **************************/
		$CTM_Template->Set("@_Info#Version", Server_Version);
		$CTM_Template->Set("@_Info#Xp", Server_Xp);
		$CTM_Template->Set("@_Info#Drop", Server_Drop);
		$CTM_Template->Set("@_Info#Accounts", $_Info["Accounts"][0]);
		$CTM_Template->Set("@_Info#Characters", $_Info["Characters"][0]);
		$CTM_Template->Set("@_Info#Guilds", $_Info["Guilds"][0]);
		$CTM_Template->Set("@_Info#VIP-1", $_Info["VIP-1"][0]);
		$CTM_Template->Set("@_Info#VIP-2", $_Info["VIP-2"][0]);
		$CTM_Template->Set("@_Info#VIP-3", $_Info["VIP-3"][0]);
		$CTM_Template->Set("@_Info#VIP-4", $_Info["VIP-4"][0]);
		$CTM_Template->Set("@_Info#VIP-5", $_Info["VIP-5"][0]);
		$CTM_Template->Set("@_Info#Acc_Ban", $_Info["Acc_Ban"][0]);
		$CTM_Template->Set("@_Info#Char_Ban", $_Info["Char_Ban"][0]);
		$CTM_Template->Set("@_Info#BugBless", $_Info["BB"]);
		$CTM_Template->Set("@_Info#ResetType", $_Info["Reset_Type"]);
		
		/***************************************************
			@ Menu
		****************************************************/
		$CTM_Template->Set("Menu#Suportt_Phone", Suportt_Phone == TRUE ? "<li><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=contact&type=phone','conteudo','GET');\">Telefone</a></li>" : NULL);
		$CTM_Template->Set("Menu#Suportt_Forum", Forum_Enable == TRUE ? "<li><a target=\"_black\" href=\"".Suportt_Forum."\">F&oacute;rum</a></li>" : NULL);
		$CTM_Template->Set("Menu#Orkut_Link", Orkut_Link);
		$CTM_Template->Set("Menu#Twitter_Link", Twitter_Enable == TRUE ? "<li><a target=\"_black\" href=\"".Twitter_Link."\">Twitter</a></li>" : NULL);
		$CTM_Template->Set("Menu#Chat", Chat_Enable == TRUE ? "<li><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=chat','conteudo','GET');\">Chat ".Server_Name."</a></li>" : NULL);
		$CTM_Template->Set("Menu#Extras", $CTM_Header->Menu_Extras());
		$CTM_Template->Set("Menu#Shops", $CTM_Header->Menu_Shops());
		$CTM_Template->Set("Menu#Forum", Forum_Enable == TRUE ? "<!-- Forum Links -->\n<li><a target=\"_black\" href=\"".Forum_Link."\">F&oacute;rum</a></li>" : NULL);
		$CTM_Template->Set("Menu#Raffles", $_RaffleSystem["Enable"] == TRUE && $_RaffleSystem["List"]["Enable"] == TRUE ? "<li><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=raffles','conteudo','GET');\">Players Sorteados</a></li>" : NULL); 
		
		/***************************************************
			@ Template Selector
		****************************************************/
		if($this->License_Limit(3) == "PREMIUM")
		{
			$CTM_Template->Set("Template_Selector", Template_Selector == TRUE ? "<form name=\"Select_Template\" id=\"Select_Template\">
        <strong class=\"colr\" style=\"font-size: 12px;\">Template: </strong>\n<select name=\"Template\" id=\"Template\" onchange=\"window.location='?tpl='+document.getElementById('Template').value\">
		".$CTM_Header->Template_Selector()."
		</select>
        </form>" : NULL);
		}
		else
		{
			$CTM_Template->Set("Template_Selector", NULL);
		}
		
		/***************************************************
			@ Command New License
		****************************************************/
		if($_GET["exec"] == "new_license" && in_array($_SESSION["Hash_Account"], $GLOBALS['_PanelAdmin']["Manage"]["EffectWeb"]))
		{
			@unlink("modules/core/license/license.dat");
			@unlink("modules/core/license/license.cache.ini");

			exit("<script>window.location = '?';</script>");
		}
		
		/***************************************************
			@ Check Web ManageChar
		****************************************************/
		if(connection_aborted() == TRUE)
		{
			@session_destroy();
			//$_SESSION["Web_ManageChar"] = NULL;
		}
	}
	private function Logout_Command()
	{
		if($_GET["exec"] == "logout")
		{
			$_SESSION["Web_ManageChar"] = NULL;
			$_SESSION["Hash_Account"] = NULL;
			$_SESSION["Hash_Password"] = NULL;
			header("Location: ?");
		}
	}
	public function ServerInfo($Type, $DataBase, $Table, $Column, $Where, $Command)
	{
		if($Type == 1)
		{
			return $this->FetchQuery("SELECT count(1) FROM {$DataBase}.dbo.{$Table}");
		}
		if($Type == 2)
		{
			return $this->FetchQuery("SELECT count(1) FROM {$DataBase}.dbo.{$Table} WHERE {$Column}='{$Where}'");
		}
		if($Type == 3)
		{
			$Cmd = $Command == 1 ? ">" : "<";
			return $this->FetchQuery("SELECT count(1) FROM {$DataBase}.dbo.{$Table} WHERE {$Column}{$Cmd}'{$Where}'");
		}
	}
	public function ServerRecord()
	{
		global $CTM;
		$Request = $this->FetchQuery("SELECT count(1) FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE ConnectStat=1");
		$Query[0] = $this->Query("SELECT Record FROM dbo.{$CTM[1]} WHERE Type=1 ORDER BY Id DESC");
		$Query[1] = $this->Query("SELECT Record FROM dbo.{$CTM[1]} WHERE Type=2");
		$Check[0] = $this->NumRow($Query[0]);
		$Check[1] = $this->NumRow($Query[1]);
		
		if($Check[0] < 1)
		{
			$Date = strtotime("now");
			$this->Query("INSERT INTO {$CTM[1]} (Record,Data,Type) VALUES ({$Request[0]},'{$Date}',1)");
		}
		else
		{
			$Record = $this->Fetch($Query[0]);
			if($Request[0] > $Record[0])
			{
				$Date = strtotime("now");
				$this->Query("INSERT INTO {$CTM[1]} (Record,Data,Type) VALUES ({$Request[0]},'{$Date}',1)");
			}
		}
		if($Check[1] < 1)
		{
			$Date = strtotime("now");
			$this->Query("INSERT INTO {$CTM[1]} (Record,Data,Type) VALUES ({$Request[0]},'{$Date}',2)");
		}
		else
		{
			$Record_Day = $this->Fetch($Query[1]);
			if($Request[0] > $Record_Day[0])
			{
				$Checking = $this->NumQuery("SELECT * FROM dbo.{$CTM[1]} WHERE Type=2");
				$Date = strtotime("now");
				if($Checking < 1)
				{
					$this->Query("INSERT INTO dbo.{$CTM[1]} (Record,Data,Type) VALUES ({$Request[0]},'{$Date}',2)");
				}
				else
				{
					$this->Query("UPDATE dbo.{$CTM[1]} SET Record={$Request[0]},Data={$Date} WHERE Type=2");
				}
			}
		}
	}
	public function Check_Logged($Cheking = 1)
	{
		if($Cheking == 1)
		{
			if(isset($_SESSION["Hash_Account"]) == FALSE || isset($_SESSION["Hash_Password"]) == FALSE)
			{
				exit("<div class=\"info-box\"> Somente usuarios logados tem acesso a est&aacute; pagina.</div>");
			}
		}
		if($Cheking == 2)
		{
			if(
			(isset($_SESSION["Hash_Account"]) == FALSE && isset($_SESSION["Hash_Password"]) == FALSE) ||
			(isset($_SESSION["Hash_Account"]) == FALSE && isset($_SESSION["Hash_Password"]) == TRUE) ||
			(isset($_SESSION["Hash_Password"]) == FALSE && isset($_SESSION["Hash_Account"]) == TRUE))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			if(
			(isset($_SESSION["Hash_Account"]) == TRUE && isset($_SESSION["Hash_Password"]) == TRUE) ||
			(isset($_SESSION["Hash_Account"]) == TRUE && isset($_SESSION["Hash_Password"]) == FALSE) ||
			(isset($_SESSION["Hash_Password"]) == TRUE && isset($_SESSION["Hash_Account"]) == FALSE))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}
	public function Check_Banned()
	{
		$Check = $this->FetchQuery("SELECT bloc_code FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id='".$_SESSION["Hash_Account"]."'");
		if($Check[0] == 1)
		{
			exit("<div class=\"info-box\"> Sua conta est&aacute; banida</div>");
		}
	}
	public function Check_Staff()
	{
		global $CTM;
		
		$Check[0] = $this->NumQuery("SELECT * FROM dbo.{$CTM[0]} WHERE account='".$_SESSION["Hash_Account"]."'");
		if($Check[0] > 0)
		{
			$Check[1] = $this->FetchQuery("SELECT type FROM dbo.{$CTM[0]} WHERE account='".$_SESSION["Hash_Account"]."'");
		}
		if($Check[0] < 1 || $Check[1][0] < 1)
		{
			exit("<div class=\"info-box\"> Voc&ecirc; n&atilde;o contem privilegio para acessar esta pagina</div>");
		}
	}
	public function Check_Coin_Table($Account)
	{
		if(constant("GL_Table") != "MEMB_INFO")
		{
			$Check_Exists = $this->NumQuery("SELECT * FROM ".GL_DB.".dbo.".GL_Table." WHERE ".GL_Login."='{$Account}'");
			
			if($Check_Exists < 1)
			{
				$this->Query("INSERT INTO ".GL_DB.".dbo.".GL_Table." (".GL_Column_1.",".GL_Login.") VALUES (0,'{$Account}')");
				return TRUE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	public function Image($Char)
	{
		global $CTM;
		
		$Image = $this->FetchQuery("SELECT {$CTM[C][0]} FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Char}'");
		$Request = constant("Upload_Img");
		if($Image[0] == NULL)
		{
			$Image[0] = "nophoto.gif";
		}
		return file_exists($Request.$Image[0]) == TRUE ? $Request.$Image[0] : $Request."nophoto.gif";
	}
	public function ClassName($Char)
	{
		global $_ClassType;
		
		switch($Char)
		{
			case $_ClassType["DW"][0] : return $_ClassType["DW"][1]; break;
			case $_ClassType["SM"][0] : return $_ClassType["SM"][1]; break;
			case $_ClassType["GM"][0] : return $_ClassType["GM"][1]; break;
			case $_ClassType["DK"][0] : return $_ClassType["DK"][1]; break;
			case $_ClassType["BK"][0] : return $_ClassType["BK"][1]; break;
			case $_ClassType["BM"][0] : return $_ClassType["BM"][1]; break;
			case $_ClassType["FE"][0] : return $_ClassType["FE"][1]; break;
			case $_ClassType["ME"][0] : return $_ClassType["ME"][1]; break;
			case $_ClassType["HE"][0] : return $_ClassType["HE"][1]; break;
			case $_ClassType["MG"][0] : return $_ClassType["MG"][1]; break;
			case $_ClassType["DM"][0] : return $_ClassType["DM"][1]; break;
			case $_ClassType["DM2"][0] : return $_ClassType["DM2"][1]; break;
			case $_ClassType["DL"][0] : return $_ClassType["DL"][1]; break;
			case $_ClassType["LE"][0] : return $_ClassType["LE"][1]; break;
			case $_ClassType["LE2"][0] : return $_ClassType["LE2"][1]; break;
			case $_ClassType["SU"][0] : return $_ClassType["SU"][1]; break;
			case $_ClassType["BS"][0] : return $_ClassType["BS"][1]; break;
			case $_ClassType["DIM"][0] : return $_ClassType["DIM"][1]; break;
			case $_ClassType["RF"][0] : return $_ClassType["RF"][1]; break;
			case $_ClassType["FM"][0] : return $_ClassType["FM"][1]; break;
		}
	}
	public function Map($Char)
	{
		global $_MapInfo;
		
		for($MP = 0; $MP < count($_MapInfo); $MP++)
		{
			switch($Char)
			{
				case $_MapInfo[$MP][0] : return $_MapInfo[$MP][3]; break;
			}
		}
	}
	public function Memb_Type($Acc)
	{
		switch($Acc)
		{
			case 0 : return "Free"; break;
			case 1 : return VIP_1; break;
			case 2 : return VIP_2; break;
			case 3 : return VIP_3; break;
			case 4 : return VIP_4; break;
			case 5 : return VIP_5; break;
			default : return "Erro"; break;
		}
	}
	public function VIP($Type, $Account)
	{
		$Send = $this->FetchQuery("SELECT ".VIP_Begin.",".VIP_Time.",".VIP_Column." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='{$Account}'");
		switch($Type)
		{
			case 1 : return $Send[2] > 0 ? date("d/m/Y", $Send[0])." as ".date("H:i", $Send[0]) : "Nunca"; break;
			case 2 : return $Send[2] > 0 ? date("d/m/Y", $Send[1])." as ".date("H:i", $Send[1]) : "Nunca"; break;
		}
	}
	/**
	 *	1.7.16 : Get Hex Void
	 *
	 *	@param	string	Type
	 *	@return	string
	*/
	public function GetHexVoid($type)
	{
		switch($type)
		{
			case "vault" :
				return "0x".str_repeat("FF", (GS_Version >= 2 ? (GS_Version == 7 ? 3840 : 1920) : 1200));
			break;
			case "inventory" :
				return "0x".str_repeat("FF", (GS_Version >= 2 ? (GS_Version == 7 ? 2732 : 1728) : (GSVersion == 1 ? 1080 : 760)));
			break;
			case "skill" :
				return "0x".str_repeat("FF0000", (GS_Version >= 1 ? 180 : 60) / 6);
			break;
			case "quest" :
				return "0x".str_repeat("FF", 50);
			break;
		}
	}
	/**
	 *	1.7.16 : Get Hex Void
	 *
	 *	@param	string	Type
	 *	@return	string
	*/
	public function GetHexSize($type)
	{
		switch($type)
		{
			case "vault" :
				return GS_Version >= 2 ? (GS_Version == 7 ? 3840 : 1920) : 1200;
			break;
			case "inventory" :
				GS_Version >= 2 ? (GS_Version == 7 ? 2732 : 1728) : (GSVersion == 1 ? 1080 : 760);
			break;
			case "skill" :
				return GS_Version >= 1 ? 180 : 60;
			break;
			case "quest" :
				return 50;
			break;
		}
	}
}
endif;
?>
