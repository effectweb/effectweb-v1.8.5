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

if(!class_exists("CTM_Info")) :

class CTM_Info extends CTM_MSSQL
{	
	public function __construct($Function)
	{
		switch($Function)
		{
			case "General" : $this->General(); break;
			case "Staff" : $this->Staff(); break;
			case "Terms" : $this->Terms(); break;
		}
	}
	private function General()
	{
		global $CTM_Template, $CTM_General, $CTM, $_Panel;
		
		if(constant("Status_Enable") == TRUE)
		{
			$Connect_GS = @fsockopen(GS_Host, GS_Port, $error, $msg, 1);
		}
		switch(constant("Server_BB"))
		{
			case 0 : $Info["BB"] = "<span style=\"color:red\">Offline</span>"; break;
			case 1 : $Info["BB"] = "<span style=\"color:green;\">Online</span>"; break;
			case 2 : $Info["BB"] = "<span style=\"color:blue;\">".constant("BB_Text")."</span>"; break;
		}
		switch($_Panel["Char"]["Reset"]["General"]["Mode"])
		{
			case 1 : $Info["Reset_Type"] = "Acumulativo"; break;
			case 2 : $Info["Reset_Type"] = "Pontuativo"; break;
			case 3 : $Info["Reset_Type"] = "Tabelado"; break;
		}
		$Info["Accounts"] = $CTM_General->ServerInfo(1, MuAcc_DB, "MEMB_INFO", FALSE, FALSE, FALSE);
		$Info["Characters"] = $CTM_General->ServerInfo(1, MuGen_DB, "Character", FALSE, FALSE, FALSE);
		$Info["Guilds"] = $CTM_General->ServerInfo(1, MuGen_DB, "Guild", FALSE, FALSE, FALSE);
		$Info["VIP-1"] = $CTM_General->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 1, FALSE);
		$Info["VIP-2"] = $CTM_General->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 2, FALSE);
		$Info["VIP-3"] = $CTM_General->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 3, FALSE);
		$Info["VIP-4"] = $CTM_General->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 4, FALSE);
		$Info["VIP-5"] = $CTM_General->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 5, FALSE);
		$Info["Acc_Ban"] = $CTM_General->ServerInfo(2, MuAcc_DB, "MEMB_INFO", "bloc_code", 1, FALSE);
		$Info["Char_Ban"] = $CTM_General->ServerInfo(2, MuGen_DB, "Character", "CtlCode", 1, FALSE);
		$Info["Online"] = $CTM_General->ServerInfo(2, MuAcc_DB, "MEMB_STAT", "ConnectStat", 1, FALSE);
		$Info["Record"] = $this->FetchQuery("SELECT record FROM ".MSSQL_DB.".dbo.{$CTM[1]} ORDER BY id DESC");
		$Info["Char_PK"] = $CTM_General->ServerInfo(3, MuGen_DB, "Character", "pklevel", 3, 1);
		$Info["Char_Hero"] = $CTM_General->ServerInfo(3, MuGen_DB, "Character", "pklevel", 3, 2);
		$Info["Server"] = Server_Type == 1 ? "Semi-Dedicado" : "Dedicado";
		$Info["Status"] = Status_Enable == 1 ? $Connect_GS == TRUE ? "<span style=\"color: green;\">Online</span>" : "<span style=\"color: red;\">Offline</span>" : "<span style=\"color: red;\">Manuten&ccedil;&atilde;o</span>";
		
		if($_Panel["Char"]["Reset"]["General"]['Mode'] < 3)
		{
			$Info["Reset_Free"] = $_Panel["Char"]["Reset"]["General"]["Level"][0]." - ".$_Panel["Char"]["Reset"]["General"]["Points"][0];
			$Info["Reset_VIP-1"] = $_Panel["Char"]["Reset"]["General"]["Level"][1]." - ".$_Panel["Char"]["Reset"]["General"]["Points"][1];
			$Info["Reset_VIP-2"] = $_Panel["Char"]["Reset"]["General"]["Level"][2]." - ".$_Panel["Char"]["Reset"]["General"]["Points"][2];
			$Info["Reset_VIP-3"] = $_Panel["Char"]["Reset"]["General"]["Level"][3]." - ".$_Panel["Char"]["Reset"]["General"]["Points"][3];
			$Info["Reset_VIP-4"] = $_Panel["Char"]["Reset"]["General"]["Level"][4]." - ".$_Panel["Char"]["Reset"]["General"]["Points"][4];
			$Info["Reset_VIP-5"] = $_Panel["Char"]["Reset"]["General"]["Level"][5]." - ".$_Panel["Char"]["Reset"]["General"]["Points"][5];
		}
		else
		{
			$Info["Reset_Free"] = "Tabelado";
			$Info["Reset_VIP-1"] = "Tabelado";
			$Info["Reset_VIP-2"] = "Tabelado";
			$Info["Reset_VIP-3"] = "Tabelado";
			$Info["Reset_VIP-4"] = "Tabelado";
			$Info["Reset_VIP-5"] = "Tabelado";
		}	
			
		$CTM_Template->Set("Bug_Bless", $Info["BB"]);
		$CTM_Template->Set("Reset_Type", $Info["Reset_Type"]);
		$CTM_Template->Set("Accounts", $Info["Accounts"][0]);
		$CTM_Template->Set("Characters", $Info["Characters"][0]);
		$CTM_Template->Set("Guilds", $Info["Guilds"][0]);
		$CTM_Template->Set("VIP-1", $Info["VIP-1"][0]);
		$CTM_Template->Set("VIP-2", $Info["VIP-2"][0]);
		$CTM_Template->Set("VIP-3", $Info["VIP-3"][0]);
		$CTM_Template->Set("VIP-4", $Info["VIP-4"][0]);
		$CTM_Template->Set("VIP-5", $Info["VIP-5"][0]);
		$CTM_Template->Set("Acc_Ban", $Info["Acc_Ban"][0]);
		$CTM_Template->Set("Char_Ban", $Info["Char_Ban"][0]);
		$CTM_Template->Set("Online", $Info["Online"][0]);
		$CTM_Template->Set("Record", $Info["Record"][0]);
		$CTM_Template->Set("Char_PK", $Info["Char_PK"][0]);
		$CTM_Template->Set("Char_Hero", $Info["Char_Hero"][0]);
		$CTM_Template->Set("Server", $Info["Server"]);
		$CTM_Template->Set("Status", $Info["Status"]);
		$CTM_Template->Set("Reset_Free", $Info["Reset_Free"]);
		$CTM_Template->Set("Reset_VIP-1", $Info["Reset_VIP-1"]);
		$CTM_Template->Set("Reset_VIP-2", $Info["Reset_VIP-2"]);
		$CTM_Template->Set("Reset_VIP-3", $Info["Reset_VIP-3"]);
		$CTM_Template->Set("Reset_VIP-4", $Info["Reset_VIP-4"]);
		$CTM_Template->Set("Reset_VIP-5", $Info["Reset_VIP-5"]);
		$CTM_Template->Set("Server_Time", constant("Server_Time"));
	}
	private function Staff()
	{
		global $CTM_Template;
		
		$CTM_Template->Set("Staff_Members", "<script>CTM_Load('?pag=staff&str=LIST','Staff_Members','GET');</script>");
		if(strtoupper($_GET["str"]))
		{
			$this->Staff_List();
			exit(false);
		}
	}
	private function Staff_List()
	{
		global $CTM_General, $CTM_Template, $CTM;
		
		$Query[0] = $this->Query("SELECT * FROM dbo.{$CTM[0]} ORDER BY type DESC, id ASC");
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[0]}");
		
		if($Check < 1)
		{
			echo "<div class=\"info-box\"> Nenhum membro da Equipe cadastrado no Momento</div>";
		}
		else
		{
			while($Load = $this->FetchArray($Query[0]))
			{
				$Set_Stat = $this->FetchQuery("SELECT ConnectStat FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE memb___id='".$Load["account"]."'");
				$Set_Class = $this->FetchQuery("SELECT Class FROM ".MuGen_DB.".dbo.Character WHERE Name='".$Load["name"]."'");
				$Class = $CTM_General->ClassName($Set_Class[0]);
				$Image = $CTM_General->Image($Load["name"]);
		
				switch($Set_Stat[0])
				{
					case 0 : $Status = "<span style=\"color: red;\">Offline</span>"; break;
					case 1 : $Status = "<span style=\"color: green;\">Online</span>"; break;
				}
				switch($Load["type"])
				{
					case 1 : 
					$Name = "<font color=\"Burlywood\"><strong>".$Load["name"]."</strong></font>"; 
					$Office = "Game Master";
					break;
					case 2 : 
					$Name = "<font color=\"red\"><strong>".$Load["name"]."</strong></font>"; 
					$Office = "Sub-Administrador";
					break;
					case 3 : 
					$Name = "<span style=\"background: url(images/effect.gif\"><font color=\"#3989EA\"><strong>".$Load["name"]."</strong></font></span>"; 
					$Office = "Administrador";
					break;
				}
				
				$CTM_Template->Set("Image", $Image);
				$CTM_Template->Set("Name", $Name);
				$CTM_Template->Set("Office", $Office);
				$CTM_Template->Set("Contact", $Load["contact"]);
				$CTM_Template->Set("Class", $Class);
				$CTM_Template->Set("Status", $Status);
				
				echo("<blockquote>  
				<table width=\"100%\" border=\"0\">
 			 		<tr>
   			 		<td width=\"135\"><img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /></td>
   					 <td width=\"493\"><table width=\"445\" border=\"0\">
     			 		<tr>
       			 		<td width=\"157\"><strong>Nome:</strong></td>
				 		<td width=\"278\">".$Name."</td>
     			 		</tr>
				 		<tr>
				  		<td><strong>Cargo:</strong></td>
				  		<td><font color=\"#008000\"><span style=\"font-weight: 400\">".$Office."</span></font></td>
				  		</tr>
     			 		<tr>
        					<td><strong>Contato:</strong></td>
							<td><span style=\"font-weight: 400\">
				<font color=\"#0000FF\">".$Load["contact"]."</font></td>
     			 		</tr>
				 		<tr>
				  		<td><strong>Classe:</strong></td>
				  		<td><span style=\"font-weight: 400\">
				<font color=\"#666699\">".$Class."</font></td>
      					<tr>
       			 		<td><strong>Status:</strong></td>
				 		<td>".$Status."</td>
     		 		    </tr>
    					</table></td>
  					</tr>
					</table>
 	 			</blockquote>");
			}
		}
		return $Return;
		unset($Return);
	}
	private function Terms()
	{
		global $CTM_Template;
		
		if($_GET["register"] == TRUE)
		{
			$CTM_Register = new CTM_Register();
		}
		
		$Open = @fopen("modules/Terms.txt", "r");
		$Terms = $Open == FALSE ? "<div class=\"error-box\"> Erro ao abrir o arquivo <b>".'"'."Terms.txt".'"'."</b></div>" : fread($Open, filesize("modules/Terms.txt"));
		
		$CTM_Template->Set("Terms", $Terms);
	}
}
endif;
?>