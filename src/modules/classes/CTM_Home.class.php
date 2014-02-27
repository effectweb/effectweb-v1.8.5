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

if(!class_exists("CTM_Home")) :

class CTM_Home extends CTM_MSSQL
{
	public function __construct()
	{
		global $CTM_Template;
		$CTM_ScreenShots = new CTM_ScreenShots();
		$this->Warning();
		$this->Castle_Siege();
		
		$CTM_Template->Set("Show_News", constant("Show_News") == TRUE ? $this->Show_News() : NULL);
		$CTM_Template->Set("Board_News", constant("Board_News") == TRUE ? $this->Board_News() : NULL);
		$CTM_Template->Set("Top_Home#Resets_MResets", constant("Top_Resets") == TRUE ? $this->Top_Home("Resets_MResets") : NULL);
		$CTM_Template->Set("Top_Home#RDay_RWeek_RMonth", constant("Top_RDayRWeekRMonth") == TRUE ? $this->Top_Home("ResetsDay_ResetsWeek_ResetsMonth") : NULL);
		$CTM_Template->Set("Top_Home#PK_Hero", constant("Top_PKHero") == TRUE ? $this->Top_Home("PK_Hero") : NULL);
		$CTM_Template->Set("Top_Home#Guilds", constant("Top_Guilds") == TRUE ? $this->Top_Home("Guilds") : NULL);
		$CTM_Template->Set("ScreenShots", constant("Show_ScreenShots") == TRUE ? $CTM_ScreenShots->Recents_ScreenShots() : NULL);
	}
	private function Show_News()
	{
		global $CTM;
		
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[6]}");
		$CTM_BBCode = new CTM_BBCode();
		
		if($Check < 1)
		{
			$Return = "<div class=\"info-box\"> N&atilde;o h&aacute; Noticias postada no Momento.</div>";
		}
		else
		{
			$Query = $this->Query("SELECT TOP ".Top_News." Title,Date,Id FROM dbo.{$CTM[6]} ORDER BY Id DESC");
			
			$Return .= "<ul style=\"list-style: none;\">";
			while($Load = $this->Fetch($Query))
			{
				$Return .= "<li>&raquo; <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=news&str=VIEW&id=".$Load[2]."','conteudo','GET');\"><b class=\"colr\">".base64_decode($Load[0])."</a></b> - [ ".date("d/m/Y", $Load[1])." as ".date("H:i", $Load[1])." ]</li>\n";
			}
			$Return .= "</ul><br /><div align=\"right\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=news','conteudo','GET');\">[ Todas as Noticias ]</a></div>";
		}
		return $Return;
	}
	private function Warning()
	{
		global $CTM_Template, $CTM;
		
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[5]}");
		$CTM_BBCode = new CTM_BBCode();
		if($Check > 0 && constant("Show_Warning") == TRUE)
		{
			$Load = $this->FetchQuery("SELECT Date,Text,Account FROM dbo.{$CTM[5]}");
			$Character = $this->FetchQuery("SELECT name FROM dbo.{$CTM[0]} WHERE account='{$Load[2]}'");
			
			$Open = fopen("templates/".$CTM_Template->Open()."/pages/home[WARNING].pag.php", "r");
			$CTM_Template->Set("%SHOW_WARNING%", fread($Open, filesize("templates/".$CTM_Template->Open()."/pages/home[WARNING].pag.php")));
			$CTM_Template->Set("%WARNING_MESSAGE%", nl2br($CTM_BBCode->Replace(base64_decode($Load[1]))));
			$CTM_Template->Set("%WARNING_LINK%", urlencode($Character[0]));
			$CTM_Template->Set("%WARNING_CHAR%", $Character[0]);
			$CTM_Template->Set("%WARNING_DATE%", date("d/m/Y", $Load[0]));
			$CTM_Template->Set("%WARNING_TIME%", date("H:i", $Load[0]));
		}
		else
		{
			$CTM_Template->Set("%SHOW_WARNING%", NULL);
		}
	}
	private function Board_News()
	{
		global $_Home;
		
		$CTM_MySQL = new CTM_MySQL();
		$CTM_MySQL->MySQL_Host = $_Home["Board"]["MySQL"]["Host"];
		$CTM_MySQL->MySQL_User = $_Home["Board"]["MySQL"]["User"];
		$CTM_MySQL->MySQL_Pass = $_Home["Board"]["MySQL"]["Pass"];
		$CTM_MySQL->MySQL_Data = $_Home["Board"]["MySQL"]["DataBase"];
		$CTM_MySQL->Connect();
		
		/********************** Invision Power Board ***********************/
		if($_Home["Board"]["Mode"] == 1)
		{
			$Erick_Master .= "SELECT * FROM ".$_Home["Board"]["Prefix"]."topics WHERE ";
			for($WzAG = 0; $WzAG < count($_Home["Board"]["Forum_ID"]); $WzAG++)
			{
				$CTMT = $_Home["Board"]["Forum_ID"][$WzAG];
			
				if($WzAG < count($_Home["Board"]["Forum_ID"]) - 1)
				{
					$Erick_Master .= "forum_id='{$CTMT}' or ";
				}
				else
				{
					$Erick_Master .= "forum_id='{$CTMT}' ";
				}
			}
			$Query = $CTM_MySQL->Query($Erick_Master."ORDER BY tid DESC LIMIT ".$_Home["Board"]["Top_News"]);
			
			if($CTM_MySQL->NumRow($Query) < 1)
			{
				$Return = "<div class=\"info-box\"> N&atilde;o h&aacute; Noticias postada no Momento.</div>";
			}
			else
			{
				$Return .= "<ul style=\"list-style: none;\">\n";
				 
				 while($Load = $CTM_MySQL->FetchArray($Query))
				 {
					 $Title = $_Home["Board"]["Debug"] == TRUE ? utf8_encode($Load["title"]) : $Load["title"];
					 $Target = $_Home["Board"]["Target"] == TRUE ? "target=\"_blank\"" : NULL;
					 $Link = $_Home["Board"]["Link"]."/index.php?showtopic=".$Load["tid"];
					 $Return .= "<li>&raquo; <a href=\"{$Link}\" {$Target}><b class=\"colr\">".$Title."</b></a> - [ ".date("d/m/Y", $Load["start_date"])." as ".date("H:i", $Load["start_date"])." ]</li>\n";
				 }
				 $Return .= "</ul>";
			}
		}
		/********************** vBulletin ***********************/
		if($_Home["Board"]["Mode"] == 2)
		{
			$Erick_Master .= "SELECT * FROM ".$_Home["Board"]["Prefix"]."thread WHERE ";
			for($WzAG = 0; $WzAG < count($_Home["Board"]["Forum_ID"]); $WzAG++)
			{
				$CTMT = $_Home["Board"]["Forum_ID"][$WzAG];
			
				if($WzAG < count($_Home["Board"]["Forum_ID"]) - 1)
				{
					$Erick_Master .= "forumid='{$CTMT}' or ";
				}
				else
				{
					$Erick_Master .= "forumid='{$CTMT}' ";
				}
			}
			$Query = $CTM_MySQL->Query($Erick_Master."ORDER BY threadid DESC LIMIT ".$_Home["Board"]["Top_News"]);
			
			if($CTM_MySQL->NumRow($Query) < 1)
			{
				$Return = "<div class=\"info-box\"> N&atilde;o h&aacute; Noticias postada no Momento.</div>";
			}
			else
			{
				$Return .= "<ul style=\"list-style: none;\">\n";
				 
				 while($Load = $CTM_MySQL->FetchArray($Query))
				 {
					 $Title = $_Home["Board"]["Debug"] == TRUE ? utf8_encode($Load["title"]) : $Load["title"];
					 $Target = $_Home["Board"]["Target"] == TRUE ? "target=\"_blank\"" : NULL;
					 $Link = $_Home["Board"]["Link"]."/showthread.php?t=".$Load["threadid"];
					 $Return .= "<li>&raquo; <a href=\"{$Link}\" {$Target}><b class=\"colr\">".$Title."</b></a> - [ ".date("d/m/Y", $Load["dateline"])." as ".date("H:i", $Load["dateline"])." ]</li>\n";
				 }
				 $Return .= "</ul>";
			}
		}
		/********************** phpBB ***********************/
		if($_Home["Board"]["Mode"] == 3)
		{
			$Erick_Master .= "SELECT * FROM ".$_Home["Board"]["Prefix"]."topics WHERE ";
			for($WzAG = 0; $WzAG < count($_Home["Board"]["Forum_ID"]); $WzAG++)
			{
				$CTMT = $_Home["Board"]["Forum_ID"][$WzAG];
			
				if($WzAG < count($_Home["Board"]["Forum_ID"]) - 1)
				{
					$Erick_Master .= "forum_id='{$CTMT}' or ";
				}
				else
				{
					$Erick_Master .= "forum_id='{$CTMT}' ";
				}
			}
			$Query = $CTM_MySQL->Query($Erick_Master."ORDER BY topic_id DESC LIMIT ".$_Home["Board"]["Top_News"]);
			
			if($CTM_MySQL->NumRow($Query) < 1)
			{
				$Return = "<div class=\"info-box\"> N&atilde;o h&aacute; Noticias postada no Momento.</div>";
			}
			else
			{
				$Return .= "<ul style=\"list-style: none;\">\n";
				 
				 while($Load = $CTM_MySQL->FetchArray($Query))
				 {
					 $Title = $_Home["Board"]["Debug"] == TRUE ? utf8_encode($Load["topic_title"]) : $Load["topic_title"];
					 $Target = $_Home["Board"]["Target"] == TRUE ? "target=\"_blank\"" : NULL;
					 $Link = $_Home["Board"]["Link"]."/viewtopic.php?t=".$Load["topic_id"];
					 $Return .= "<li>&raquo; <a href=\"{$Link}\" {$Target}><b class=\"colr\">".$Title."</b></a> - [ ".date("d/m/Y", $Load["topic_time"])." as ".date("H:i", $Load["topic_time"])." ]</li>\n";
				 }
				 $Return .= "</ul>";
			}
		}
		/********************** Simple Machines Forum ***********************/
		if($_Home["Board"]["Mode"] == 4)
		{
			$Erick_Master .= "SELECT * FROM ".$_Home["Board"]["Prefix"]."topics WHERE ";
			for($WzAG = 0; $WzAG < count($_Home["Board"]["Forum_ID"]); $WzAG++)
			{
				$CTMT = $_Home["Board"]["Forum_ID"][$WzAG];
			
				if($WzAG < count($_Home["Board"]["Forum_ID"]) - 1)
				{
					$Erick_Master .= "id_board='{$CTMT}' or ";
				}
				else
				{
					$Erick_Master .= "id_board='{$CTMT}' ";
				}
			}
			$Query = $CTM_MySQL->Query($Erick_Master."ORDER BY id_topic DESC LIMIT ".$_Home["Board"]["Top_News"]);
			
			if($CTM_MySQL->NumRow($Query) < 1)
			{
				$Return = "<div class=\"info-box\"> N&atilde;o h&aacute; Noticias postada no Momento.</div>";
			}
			else
			{
				$Return .= "<ul style=\"list-style: none;\">\n";
				 
				 while($Load = $CTM_MySQL->FetchArray($Query))
				 {
					 $Find_Topic_Query = $CTM_MySQL->Query("SELECT * FROM ".$_Home["Board"]["Prefix"]."messages WHERE id_topic='".$Load["id_topic"]."' ORDER BY id_msg");
					 $Find_Topic = $CTM_MySQL->FetchArray($Find_Topic_Query);
					 $Title = $_Home["Board"]["Debug"] == TRUE ? utf8_encode($Find_Topic["subject"]) : $Find_Topic["subject"];
					 $Target = $_Home["Board"]["Target"] == TRUE ? "target=\"_blank\"" : NULL;
					 $Link = $_Home["Board"]["Link"]."/index.php?topic=".$Load["id_topic"];
					 $Return .= "<li>&raquo; <a href=\"{$Link}\" {$Target}><b class=\"colr\">".$Title."</b></a> - [ ".date("d/m/Y", $Find_Topic["poster_time"])." as ".date("H:i", $Find_Topic["poster_time"])." ]</li>\n";
				 }
				 $Return .= "</ul>";
			}
		}
		return $Return;
	}
	private function Top_Home($Top)
	{
		global $CTM_General;
		
		if($Top == "Resets_MResets")
		{
			$Query = $this->Query("SELECT TOP 5 * FROM ".MuGen_DB.".dbo.Character WHERE CtlCode < 8 ORDER BY ".Column_MReset." DESC, ".Column_Reset." DESC");
			$Check = $this->NumRow($Query);
			
			if($Check < 1)
			{
				$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
			}
			
			$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
					<tr>
					<td style=\"width: 110px;\">
					<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
		<tr>";
			for($WzAG = 0; $WzAG < $this->NumRow($Query); $WzAG++)
			{
				$Rank = $WzAG+1;
				$Character = $this->FetchArray($Query);
				$Image = $CTM_General->Image($Character["Name"]);
				$Return .= "
		<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character["Name"])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Character["Name"]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$Character[Column_MReset]." MR - ".$Character[Column_Reset]." Resets)</a></td>";
			}
	    $Return .= "
		</tr>
		   </table>
		   </td>
		     </tr>
			</table>";
			return $Return;
		}
		if($Top == "ResetsDay_ResetsWeek_ResetsMonth")
		{
			$Query = $this->Query("SELECT TOP 5 * FROM ".MuGen_DB.".dbo.Character WHERE CtlCode < 8 ORDER BY ".Column_ResetDay." DESC, ".Column_ResetWeek." DESC, ".Column_ResetMonth." DESC");
			$Check = $this->NumRow($Query);
			
			if($Check < 1)
			{
				$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
			}
			
			$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
					<tr>
					<td style=\"width: 110px;\">
					<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
		<tr>";
			for($WzAG = 0; $WzAG < $this->NumRow($Query); $WzAG++)
			{
				$Rank = $WzAG+1;
				$Character = $this->FetchArray($Query);
				$Image = $CTM_General->Image($Character["Name"]);
				$Return .= "
		<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character["Name"])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Character["Name"]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />".$Character[Column_ResetDay]." D - ".$Character[Column_ResetWeek]." S - ".$Character[Column_ResetMonth]." M</a></td>";
			}
	    $Return .= "
		</tr>
		   </table>
		   </td>
		     </tr>
			</table>";
			return $Return;
		}
		if($Top == "PK_Hero")
		{
			$Query = $this->Query("SELECT TOP 5 * FROM ".MuGen_DB.".dbo.Character WHERE CtlCode < 8 ORDER BY ".RANKING_HERO_COLUMN." + ".RANKING_PK_COLUMN." DESC");
			$Check = $this->NumRow($Query);
			
			if($Check < 1)
			{
				$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
			}
			
			$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
					<tr>
					<td style=\"width: 110px;\">
					<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
		<tr>";
			for($WzAG = 0; $WzAG < $this->NumRow($Query); $WzAG++)
			{
				$Rank = $WzAG+1;
				$Character = $this->FetchArray($Query);
				$Image = $CTM_General->Image($Character["Name"]);
				$Return .= "
		<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character["Name"])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Character["Name"]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />".$Character[RANKING_HERO_COLUMN]." Hero - ".$Character[RANKING_PK_COLUMN]." PK</a></td>";
			}
	    $Return .= "
		</tr>
		   </table>
		   </td>
		     </tr>
			</table>";
			return $Return;
		}
		/*if($Top == "PK_Hero")
		{
			function is($count)
			{
				if($count == 0) return "Normal";
				if($count > 0) return "PK";
				if($count < 0) return "Hero";
			}
			$Query = $this->Query("SELECT TOP 5 * FROM ".MuGen_DB.".dbo.Character WHERE CtlCode < 8 ORDER BY ".Column_PK." ASC");
			$Check = $this->NumRow($Query);
			
			if($Check < 1)
			{
				$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
			}
			
			$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
					<tr>
					<td style=\"width: 110px;\">
					<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
		<tr>";
			$normal = array();
			$others = array();
			for($WzAG = 0; $WzAG < $this->NumRow($Query); $WzAG++)
			{
				$Character = $this->FetchArray($Query);
				if($Character[Column_PK] == 0) $normal[] = $Character;
				else $others[] = $Character;
			}
			$newLoop = array_merge($others, $normal);
				
			foreach($newLoop as $WzAG => $Character)
			{
				$Rank = $WzAG+1;
				$Image = $CTM_General->Image($Character["Name"]);
				$is = is($Character[Column_PK]);
				$kill = sprintf("%u", $Character[Column_PK]);
				$Return .= "
		<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character["Name"])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Character["Name"]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$is." : ".$kill." Kills)</a></td>";
			}
	    $Return .= "
		</tr>
		   </table>
		   </td>
		     </tr>
			</table>";
			return $Return;
		}*/
		if($Top == "Guilds")
		{
			$Query = $this->Query("SELECT TOP 5 G_Name,G_Score,G_Mark FROM ".MuGen_DB.".dbo.Guild ORDER BY G_Score DESC");
			$Check = $this->NumRow($Query);
			
			if($Check < 1)
			{
				$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>" ;
			}
			
			$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
					<tr>
					<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
		<tr>";
			for($WzAG = 0; $WzAG < $this->NumRow($Query); $WzAG++)
			{
				$Rank = $WzAG+1;
				$Guild = $this->Fetch($Query);
				$Image = "?public=logoGuild&code=".urlencode(bin2hex($Guild[2]));
				$Return .= "
		<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&guild=".urlencode($Guild[0])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Guild[0]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$Guild[1]." Score)</a></td>";
			}
	    $Return .= "
		</tr>
		   </table>
		   </td>
		     </tr>
			</table>";
			return $Return;
		}
	}
	private function Castle_Siege()
	{
		global $CTM_Template;
		
		if(constant("Siege_Enable") == true)
		{
			$Query = $this->Query("SELECT OWNER_GUILD,CONVERT(varchar(5),SIEGE_END_DATE,3) FROM ".MuGen_DB.".dbo.MuCastle_DATA ORDER BY MAP_SVR_GROUP DESC");
			$Load = $this->Fetch($Query);
			$date = explode("/", $Load[1]);
			$date = ($date[0] - 1)."/".$date[1];
			$date = SIEGE_DATE_FIX ? $date : $Load[1];
			
			$CTM_Template->Set("%CASTLE_SIEGE[LINK]%", urlencode($Load[0]));
			$CTM_Template->Set("%CASTLE_SIEGE[OWNER]%", $Load[0]);
			$CTM_Template->Set("%CASTLE_SIEGE[DATE]%", $date);
			$CTM_Template->Set("%CASTLE_SIEGE[HOUR]%", Siege_Hour);
		}
	}
}
endif;
?>