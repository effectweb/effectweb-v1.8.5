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

if(!class_exists("CTM_Search")) :

class CTM_Search extends CTM_MSSQL
{
	public function __construct()
	{
		global $CTM_Template;
		
		echo("<script src=\"modules/header/javascripts/functions.js\"></script>\n\r");

		if($_GET["char"]) { $Title = "Char [ ".$_GET["char"]." ]"; }
		if($_GET["guild"]) { $Title = "Guild [ ".$_GET["guild"]." ]"; }
		
		if($_GET["char"])
		{
			$Check = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='".$_GET["char"]."'");
			if($Check < 1)
			{
				$Result = "<div class=\"error-box\"> Personagem n&atilde;o encontrada</div>";
			}
			else
			{
				$Result = $this->Result(1, "Character", array("Name", $_GET["char"]));
			}
		}
		if($_GET["guild"])
		{
			$Check = $this->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.Guild WHERE G_Name='".$_GET["guild"]."'");
			if($Check < 1)
			{
				$Result = "<div class=\"error-box\"> Guild n&atilde;o encontrada</div>";
			}
			else
			{
				$Result = $this->Result(2, "Guild", array("G_Name", $_GET["guild"]));
			}
		}
		
		$CTM_Template->Set("Pag_Title", $Title);
		$CTM_Template->Set("Search_Result", $Result);
	}
	private function Result($Type, $Table, $Column)
	{
		global $CTM_General, $CTM;
		
		if($Type == 1)
		{
			if(ENABLE_INFO_CHAR == true)
			{
				$Check_Table = $this->NumQuery("SELECT * FROM ".MSSQL_DB.".dbo.{$CTM[4]} WHERE Character='{$Column[1]}'");
				if($Check_Table < 1)
				{
					$this->Query("INSERT INTO ".MSSQL_DB.".dbo.{$CTM[4]} (Status,Character) VALUES (1,'{$Column[1]}')");
				}
				$Check = $this->FetchQuery("SELECT Status FROM ".MSSQL_DB.".dbo.{$CTM[4]} WHERE Character='{$Column[1]}'");
				if($Check[0] == 0)
				{
					$Return = "<div class=\"info-box\"> Este Perfil se encontra desabilitado</div>";
				}
				else
				{
					$Query = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.{$Table} WHERE {$Column[0]}='".$Column[1]."'");
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
					$Return .= "<table width=\"638\" border=\"0\">
					<tr>
						<td width=\"135\"><img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /></td>
						<td width=\"493\"><table width=\"445\" border=\"0\">
					 <tr>
						<td width=\"195\">Classe: <span class=\"colr\">".$Class."</span></td>
						<td width=\"235\">Resets: <span class=\"colr\">".$Load[Column_Reset]."</span></td>
					 </tr>
					 <tr>
						<td>Level: <span class=\"colr\">".$Load["cLevel"]."</span></td>
						<td>Master Resets: <span class=\"colr\">".$Load[Column_MReset]."</span></td>
					 </tr>
					<tr>
					 <td>For&ccedil;a: <span class=\"colr\">".$Load["Strength"]."</span></td>
					 <td>PK Kills: <span class=\"colr\">".$Load[Column_PK]."</span></td>
					</tr>
					<tr>
						<td>Agilidade: <span class=\"colr\">".$Load["Dexterity"]."</span></td>
						<td>Mapa: <span class=\"colr\">".$Map."</span></td>
					 </tr>
					 <tr>
						<td>Vitalidade: <span class=\"colr\">".$Load["Vitality"]."</span></td>
						<td>Servidor: <span class=\"colr\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=online&gs=".urlencode($Server[1])."','conteudo','GET');\">".$Server[1]."</a></span></td>
					 </tr>
					<tr>
						<td>Energia: <span class=\"colr\">".$Load["Energy"]."</span></td>
						<td>Status: <span class=\"colr\">".$Status."</span></td>
					 </tr>
					 <tr>";
						if($Load["Class"] == 64 || $Load["Class"] == 65 || $Load["Class"] == 66)
						{
							$Return .= "
								 <td>Comando: <span class=\"colr\">".$Load[Column_Cmd]."</span></td>
								";
						}
						$Return .= "<td>Guild: <span class=\"colr\">".$Guild."</span> <img src=\"?public=logoGuild&code=".urlencode(bin2hex($Logo[0]))."\" width=\"15\" height=\"15\" /></td>
								</tr>
						</table></td>
					</tr>
					</table>";
				}
			}
			else
			{
				$Return = "<div class=\"info-box\"> Exibi&ccedil;&atilde;o de perfil desabilitada.</div>";
			}
		}
		if($Type == 2)
		{
			if(ENABLE_INFO_GUILD == true)
			{
				$Query = $this->Query("SELECT * FROM ".MuGen_DB.".dbo.{$Table} WHERE {$Column[0]}='".$Column[1]."'");
				$Load = $this->FetchArray($Query);
				$Request = $this->Query("SELECT Name,G_Status FROM ".MuGen_DB.".dbo.GuildMember WHERE G_Name='".$Column[1]."'");
				$Count = $this->FetchQuery("SELECT count(*) FROM ".MuGen_DB.".dbo.GuildMember WHERE G_Name='".$Column[1]."'");
				$Send = base64_encode($Load["G_Notice"]);
				$Notice = base64_decode($Send);
				$Image = "?public=logoGuild&code=".urlencode(bin2hex($Load["G_Mark"]));
				$Return .= "<table width=\"543\" border=\"0\">
							<tr>
							 <td width=\"144\"><div id=\"ctmt\"><img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /></div></td>
							 <td width=\"389\"><table width=\"386\" border=\"0\" id=\"ctmt\">
								 <tr>
								 <td width=\"181\">Nome:</td>
									<td width=\"195\"><span class=\"colr\">".$Load["G_Name"]."</span></td>
								 </tr>
								 <tr>
									<td>Guild Master:</td>
									<td><span class=\"colr\">".$Load["G_Master"]."</span></td>
								 </tr>
								 <tr>
								 <td>Scores:</td>
								 <td><span class=\"colr\">".$Load["G_Score"]."</span></td>
								 </tr>
								<tr>
									<td>Not&iacute;cias:</td>
									<td><span class=\"colr\">[ <a class=\"colr\" href=\"javascript: void(EffectWeb);\" rel=\"tooltip\" title=\"Not&iacute;cia: <b><span class='colr'>".$Notice."</span></b>\">Ver Not&iacute;cia</a> ]</span></td>
								 </tr>
								<tr>
								 <td>Total de Membros:</td>
								 <td><span class=\"colr\">".$Count[0]."</span></td>
								</tr>
							 </table></td>
							</tr>
							</table><br />
							<table width=\"474\" border=\"0\" id=\"ctmt\">
							  <tr>
							 <td><strong>Char:</strong></td>
							  <td><strong>Classe:</strong></td>
							 <td><strong>Level:</strong></td>
								<td><strong>Resets:</strong></td>
								<td><strong>Status:</strong></td>
							 </tr>";
							 for($WzAG = 0; $WzAG < $this->NumRow($Request); $WzAG++)
							 {
								 $Send_Char = $this->Fetch($Request);
								 $Member = $this->FetchQuery("SELECT Name,Class,cLevel,".Column_Reset.",AccountID FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Send_Char[0]}'");
								 $Send_Status = $this->FetchQuery("SELECT ConnectStat FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE memb___id='{$Member[4]}'");
								 $Class = $CTM_General->ClassName($Member[1]);
								 if($Send_Char[1] == 128) { $Guild = array("gold.gif", "Guild Master"); }
								 if($Send_Char[1] == 64) { $Guild = array("silver.gif", "Assistant"); }
								 if($Send_Char[1] == 32) { $Guild = array("bronze.gif", "Batte Master"); }
								 $G_Status = $Send_Char[1] == true ? "<img src=\"images/icons/".$Guild[0]."\" valign=\"middle\" title=\"".$Guild[1]."\">" : NULL;
								 switch($Send_Status[0])
								 {
									 case 0 : $Status = "<span style=\"color: red;\">Offline</span>"; break;
									 case 1 : $Status = "<span style=\"color: green\">Online</span>"; break;
								 }
								 $Return .= "
									<tr>
									 <td class=\"colr\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Member[0])."','conteudo','GET');\">".$Member[0]."</a> ".$G_Status."</td>
									 <td class=\"colr\">".$Class."</td>
									 <td class=\"colr\">".$Member[2]."</td>
									 <td class=\"colr\">".$Member[3]."</td>
									 <td class=\"colr\">".$Status."</td>
									</tr>";
							 }
				$Return .= "</table>";
			}
			else
			{
				$Return = "<div class=\"info-box\"> Exibi&ccedil;&atilde;o de perfil desabilitada.</div>";
			}
		}
		return $Return;
	}
}
endif;
?>