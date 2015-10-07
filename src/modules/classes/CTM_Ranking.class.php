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

if(!class_exists("CTM_Ranking")) :

class CTM_Ranking extends CTM_MSSQL
{
	public function __construct()
	{
		global $CTM_Template, $_Ranking;
		
		$CTM_Template->Set("TopRank_List", $this->TopRank_List());
		$this->Ranking_System();
		
		if(isset($_GET["rank"]) == TRUE)
		{	
			switch($_GET["rank"])
			{
				case "resets" :
				$Title = "Resets Gerais";
				if($_Ranking["Reset"][0] == TRUE)
				{
					$Return = $this->Reset_Rank($_Ranking["Reset"][1]);
				}
				else
				{
					$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
				}
				break;
				case "resetsday" :
				$Title = "Resets Diarios";
				if($_Ranking["ResetDay"][0] == TRUE)
				{
					$Return = $this->ResetDay_Rank($_Ranking["ResetDay"][1]);
				}
				else
				{
					$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
				}
				break;
				case "resetsweek" :
				$Title = "Resets Semanais";
				if($_Ranking["ResetWeek"][0] == TRUE)
				{
					$Return = $this->ResetWeek_Rank($_Ranking["ResetWeek"][1]);
				}
				else
				{
					$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
				}
				break;
				case "resetsmonth" :
				$Title = "Resets Mensais";
				if($_Ranking["ResetMonth"][0] == TRUE)
				{
					$Return = $this->ResetMonth_Rank($_Ranking["ResetMonth"][1]);
				}
				else
				{
					$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
				}
				break;
				case "mresets" :
				$Title = "Master Resets";
				if($_Ranking["MReset"][0] == TRUE)
				{
					$Return = $this->MReset_Rank($_Ranking["MReset"][1]);
				}
				else
				{
					$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
				}
				break;
				case "guild" :
				$Title = "Guilds";
				if($_Ranking["Guild"][0] == TRUE)
				{
					$Return = $this->Guild_Rank($_Ranking["Guild"][1]);
				}
				else
				{
					$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
				}
				break;
				case "pk" :
				$Title = "Top PK";
				if($_Ranking["PK"][0] == TRUE)
				{
					$Return = $this->TopPK_Rank($_Ranking["PK"][1]);
				}
				else
				{
					$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
				}
				break;
				case "hero" :
				$Title = "Top Hero";
				if($_Ranking["Hero"][0] == TRUE)
				{
					$Return = $this->TopHero_Rank($_Ranking["Hero"][1]);
				}
				else
				{
					$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
				}
				break;
				case "gens" :
				$Title = "Gens";
				if($_Ranking["Gens"][0] == TRUE && $_Ranking["Gens"]["Enable"] == TRUE)
				{
					$Return = $this->Gens_Rank($_Ranking["Gens"][1]);
				}
				else
				{
					$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
				}
				break;
				default :
				$Title = "Error";
				$Return = "<div class=\"error-box\"> Ranking invalido!</div>";
				break;
			}
			$CTM_Ranking .= "<h4 class=\"heading colr\">{$Title}</h4>";
			$CTM_Ranking .= "<blockquote>";
			$CTM_Ranking .= $Return;
			$CTM_Ranking .= "</blockquote>";
			$CTM_Template->Set("Ranking_Result", $CTM_Ranking);
			unset($CTM_Ranking);
		}
		else
		{
			$CTM_Template->Set("Ranking_Result", NULL);
		}
	}
	private function Ranking_System()
	{
		global $_Ranking;
		
		if($_GET["cmd"] == TRUE)
		{
			$Ranking = $_POST["Ranking"];
			$Top_Rank = intval($_POST["Top_Rank"]);
			
			if(empty($Ranking))
			{
				exit("<div class=\"warning-box\"> Selecione o Ranking</div>");
			}
			elseif(empty($Top_Rank))
			{
				exit("<div class=\"warning-box\"> Selecione o Top Ranking</div>");
			}
			elseif(array_search($_POST["Top_Rank"], $_Ranking['Gerator']['TOP']) == null)
			{
				exit("<div class=\"error-box\"> Selecione um Top Ranking correto</div>");
			}
			else
			{
				switch($Ranking)
				{
					case 1 :
					if($_Ranking["Reset"][0] == TRUE)
					{
						$Return = $this->Reset_Rank($Top_Rank);
						$Title = "Resets Gerais";
					}
					else
					{
						$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
					}
					break;
					case 2 :
					if($_Ranking["ResetDay"][0] == TRUE)
					{
						$Return = $this->ResetDay_Rank($Top_Rank);
						$Title = "Resets Diarios";
					}
					else
					{
						$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
					}
					break;
					case 3 :
					if($_Ranking["ResetWeek"][0] == TRUE)
					{
						$Return = $this->ResetWeek_Rank($Top_Rank);
						$Title = "Resets Semanais";
					}
					else
					{
						$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
					}
					break;
					case 4 :
					if($_Ranking["ResetMonth"][0] == TRUE)
					{
						$Return = $this->ResetMonth_Rank($Top_Rank);
						$Title = "Resets Mensais";
					}
					else
					{
						$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
					}
					break;
					case 5 :
					if($_Ranking["MReset"][0] == TRUE)
					{
						$Return = $this->MReset_Rank($Top_Rank);
						$Title = "Master Reset";
					}
					else
					{
						$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
					}
					break;
					case 6 :
					if($_Ranking["Guild"][0] == TRUE)
					{
						$Return = $this->Guild_Rank($Top_Rank);
						$Title = "Guilds";
					}
					else
					{
						$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
					}
					break;
					case 7 :
					if($_Ranking["PK"][0] == TRUE)
					{
						$Return = $this->TopPK_Rank($Top_Rank);
						$Title = "Top PK";
					}
					else
					{
						$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
					}
					break;
					case 8 :
					if($_Ranking["Hero"][0] == TRUE)
					{
						$Return = $this->TopHero_Rank($Top_Rank);
						$Title = "Top Hero";
					}
					else
					{
						$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
					}
					break;
					case 9 :
					if($_Ranking["Gens"][0] == TRUE && $_Ranking["Gens"]["Enable"] == TRUE)
					{
						$Return = $this->Gens_Rank($Top_Rank);
						$Title = "Gens";
					}
					else
					{
						$Return = "<div class=\"info-box\"> Este Ranking se encontra Desabilitado</div>";
					}
					break;
					default :
					$Return = "<div class=\"error-box\"> Ranking Invalido</div>";
					break;
				}
				$CTM_Ranking .= "<h4 class=\"heading colr\">{$Title}</h4>";
				$CTM_Ranking .= "<blockquote>";
				$CTM_Ranking .= $Return;
				$CTM_Ranking .= "</blockquote>";
				exit($CTM_Ranking);
			}
		}
	}
	private function TopRank_List()
	{
		global $_Ranking;
		
		for($WzAG = 0; $WzAG < count($_Ranking["Gerator"]["TOP"]); $WzAG++)
		{
			$Return .= "<option value=\"".$_Ranking["Gerator"]["TOP"][$WzAG]."\">".$_Ranking["Gerator"]["TOP"][$WzAG]."</option>";
		}
		return $Return;
		unset($Return);
	}
	private function Reset_Rank($Top_Rank)
	{
		global $_Ranking, $CTM_General;
		
		$Query = $this->Query("SELECT TOP ".$Top_Rank." Name,".Column_Reset." FROM ".MuGen_DB.".dbo.Character WHERE CtlCode < 8 ORDER BY ".Column_Reset." DESC");
		$Check = $this->NumRow($Query);
		
		if($Check < 1)
		{
			$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
		}
		else
		{
			
			$Return .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
				<tr>
    		<td colspan=\"2\">";
	
			$Rank = 1;
			while($Character = $this->Fetch($Query))
			{
				$Image = $CTM_General->Image($Character[0]);
				
				if($GS == 0)
				{
					$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
							<tr>";
				}
					
				$Return .= "<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
			<tr>
			<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character[0])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Character[0]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$Character[1]." Resets)</a></td>
			</tr>
				<tr>	
				</tr>
				<tr>
				<td>&nbsp;</td>
				</tr>
			</table></td>";
				$GS++;
				if($GS > 4)
				{
					$Return .= "</tr>
					</table>";
					$GS = 0;
				}
				$Rank = $Rank + 1;
			}
			$Return .= "</tr>
							</table>
							</td>
						</tr>
					</table>";
		}
		return $Return;
		unset($Return);
	}
	private function ResetDay_Rank($Top_Rank)
	{
		global $_Ranking, $CTM_General;
		
		$Query = $this->Query("SELECT TOP ".$Top_Rank." Name,".Column_ResetDay." FROM ".MuGen_DB.".dbo.Character WHERE CtlCode < 8 ORDER BY ".Column_ResetDay." DESC");
		$Check = $this->NumRow($Query);
		
		if($Check < 1)
		{
			$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
		}
		else
		{
			
			$Return .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
				<tr>
    		<td colspan=\"2\">";
	
			$Rank = 1;
			while($Character = $this->Fetch($Query))
			{
				$Image = $CTM_General->Image($Character[0]);
				
				if($GS == 0)
				{
					$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
							<tr>";
				}
					
				$Return .= "<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
			<tr>
			<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character[0])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Character[0]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$Character[1]." Resets Diarios)</a></td>
			</tr>
				<tr>	
				</tr>
				<tr>
				<td>&nbsp;</td>
				</tr>
			</table></td>";
				$GS++;
				if($GS > 4)
				{
					$Return .= "</tr>
					</table>";
					$GS = 0;
				}
				$Rank = $Rank + 1;
			}
			$Return .= "</tr>
							</table>
							</td>
						</tr>
					</table>";
		}
		return $Return;
		unset($Return);
	}
	private function ResetWeek_Rank($Top_Rank)
	{
		global $_Ranking, $CTM_General;
		
		$Query = $this->Query("SELECT TOP ".$Top_Rank." Name,".Column_ResetWeek." FROM ".MuGen_DB.".dbo.Character WHERE CtlCode < 8 ORDER BY ".Column_ResetWeek." DESC");
		$Check = $this->NumRow($Query);
		
		if($Check < 1)
		{
			$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
		}
		else
		{
			
			$Return .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
				<tr>
    		<td colspan=\"2\">";
	
			$Rank = 1;
			while($Character = $this->Fetch($Query))
			{
				$Image = $CTM_General->Image($Character[0]);
				
				if($GS == 0)
				{
					$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
							<tr>";
				}
					
				$Return .= "<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
			<tr>
			<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character[0])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Character[0]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$Character[1]." Resets Semanais)</a></td>
			</tr>
				<tr>	
				</tr>
				<tr>
				<td>&nbsp;</td>
				</tr>
			</table></td>";
				$GS++;
				if($GS > 4)
				{
					$Return .= "</tr>
					</table>";
					$GS = 0;
				}
				$Rank = $Rank + 1;
			}
			$Return .= "</tr>
							</table>
							</td>
						</tr>
					</table>";
		}
		return $Return;
		unset($Return);
	}
	private function ResetMonth_Rank($Top_Rank)
	{
		global $_Ranking, $CTM_General;
		
		$Query = $this->Query("SELECT TOP ".$Top_Rank." Name,".Column_ResetMonth." FROM ".MuGen_DB.".dbo.Character WHERE CtlCode < 8 ORDER BY ".Column_ResetMonth." DESC");
		$Check = $this->NumRow($Query);
		
		if($Check < 1)
		{
			$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
		}
		else
		{
			
			$Return .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
				<tr>
    		<td colspan=\"2\">";
	
			$Rank = 1;
			while($Character = $this->Fetch($Query))
			{
				$Image = $CTM_General->Image($Character[0]);
				
				if($GS == 0)
				{
					$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
							<tr>";
				}
					
				$Return .= "<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
			<tr>
			<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character[0])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Character[0]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$Character[1]." Resets Mensais)</a></td>
			</tr>
				<tr>	
				</tr>
				<tr>
				<td>&nbsp;</td>
				</tr>
			</table></td>";
				$GS++;
				if($GS > 4)
				{
					$Return .= "</tr>
					</table>";
					$GS = 0;
				}
				$Rank = $Rank + 1;
			}
			$Return .= "</tr>
							</table>
							</td>
						</tr>
					</table>";
		}
		return $Return;
		unset($Return);
	}
	private function MReset_Rank($Top_Rank)
	{
		global $_Ranking, $CTM_General;
		
		$Query = $this->Query("SELECT TOP ".$Top_Rank." Name,".Column_MReset." FROM ".MuGen_DB.".dbo.Character WHERE CtlCode < 8 ORDER BY ".Column_MReset." DESC");
		$Check = $this->NumRow($Query);
			
		if($Check < 1)
		{
			$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
		}
		else
		{
			
			$Return .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
				<tr>
    				<td colspan=\"2\">";
	
			$Rank = 1;
			while($Character = $this->Fetch($Query))
			{
				$Image = $CTM_General->Image($Character[0]);
				
				if($GS == 0)
				{
					$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
							<tr>";
				}
				
				$Return .= "
						<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
				<tr>
					<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character[0])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Character[0]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$Character[1]." Master Resets)</a></td>
				</tr>
				<tr>	
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>";
				$GS++;
				if($GS > 4)
				{
					$Return .= "</tr>
					</table>";
					$GS = 0;
				}
					$Rank = $Rank + 1;
			}
			$Return .= "</tr>
						</table>
						</td>
					</tr>
				</table>";
		}
		return $Return;
		unset($Return);
	}
	private function Guild_Rank($Top_Rank)
	{
		global $_Ranking, $CTM_General;
		
		$Query = $this->Query("SELECT TOP ".$Top_Rank." G_Name,G_Score,G_Mark FROM ".MuGen_DB.".dbo.Guild ORDER BY G_Score DESC");
		$Check = $this->NumRow($Query);
			
		if($Check < 1)
		{
			$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
		}
		else
		{
			$Return .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
				<tr>
    				<td colspan=\"2\">";
	
			$Rank = 1;
			while($Guild = $this->Fetch($Query))
			{
				$Image = "?public=logoGuild&code=".urlencode(bin2hex($Guild[2]));
				
				if($GS == 0)
				{
					$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
							<tr>";
				}
				
				$Return .= "
						<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
				<tr>
					<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&guild=".urlencode($Guild[0])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Guild[0]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$Guild[1]." Score)</a></td>
				</tr>
				<tr>	
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>";
				$GS++;
				if($GS > 4)
				{
					$Return .= "</tr>
					</table>";
					$GS = 0;
				}
				$Rank = $Rank + 1;
			}
			$Return .= "</tr>
						</table>
						</td>
					</tr>
				</table>";
		}
		return $Return;
		unset($Return);
	}
	private function TopPK_Rank($Top_Rank)
	{
		global $_Ranking, $CTM_General;
		
		$Query = $this->Query("SELECT TOP ".$Top_Rank." Name,".RANKING_PK_COLUMN." FROM ".MuGen_DB.".dbo.Character WHERE CtlCode < 8 AND ".RANKING_PK_COLUMN." > 0 ORDER BY ".RANKING_PK_COLUMN." DESC");
		$Check = $this->NumRow($Query);
			
		if($Check < 1)
		{
			$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
		}
		else
		{
			$Return .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
				<tr>
    				<td colspan=\"2\">";
	
			while($Character = $this->Fetch($Query))
			{
				$Rank = $Rank + 1;
				$Image = $CTM_General->Image($Character[0]);
				$kill = str_replace("-", NULL, $Character[1]);
				if($GS == 0)
				{
					$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
							<tr>";
				}
				
				$Return .= "
						<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
				<tr>
					<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character[0])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Character[0]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(PK : ".$kill." Kills)</a></td>
					</tr>
					<tr>	
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>";
				$GS++;
				if($GS > 4)
				{
					$Return .= "</tr>
					</table>";
					$GS = 0;
				}
			}
			$Return .= "</tr>
						</table>
						</td>
					</tr>
				</table>";
		}
		return $Return;
		unset($Return);
	}
	private function TopHero_Rank($Top_Rank)
	{
		global $_Ranking, $CTM_General;
		
		$Query = $this->Query("SELECT TOP ".$Top_Rank." Name,".RANKING_HERO_COLUMN." FROM ".MuGen_DB.".dbo.Character WHERE CtlCode < 8 AND ".RANKING_HERO_COLUMN." > 0 ORDER BY ".RANKING_HERO_COLUMN." DESC");
		$Check = $this->NumRow($Query);
			
		if($Check < 1)
		{
			$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
		}
		else
		{
			$Return .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
				<tr>
    				<td colspan=\"2\">";
	
			while($Character = $this->Fetch($Query))
			{
				$Rank = $Rank + 1;
				$Image = $CTM_General->Image($Character[0]);
				$kill = str_replace("-", NULL, $Character[1]);
				if($GS == 0)
				{
					$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
							<tr>";
				}
				
				$Return .= "
						<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
				<tr>
					<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character[0])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Character[0]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(Hero : ".$kill." Kills)</a></td>
					</tr>
					<tr>	
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>";
				$GS++;
				if($GS > 4)
				{
					$Return .= "</tr>
					</table>";
					$GS = 0;
				}
			}
			$Return .= "</tr>
						</table>
						</td>
					</tr>
				</table>";
		}
		return $Return;
		unset($Return);
	}
	private function Gens_Rank($Top_Rank)
	{
		global $_Ranking;
		
		$Query = $this->Query("SELECT TOP ".$Top_Rank." * FROM ".$_Ranking["Gens"]["DB"].".dbo.".$_Ranking["Gens"]["Table"]." ORDER BY RANKING ASC, CONTRIBUITION DESC");
		$Check = $this->NumRow($Query);
			
		if($Check < 1)
		{
			$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
		}
		else
		{
			$CTM_GensRanking =  new CTM_GensRanking();
			$Return .= "<table border='0' width='100%'>
                    	 <tr>
                      		<td align='center'><strong>Rank</strong></td>
                      <td align='center'><strong>Nome</strong></td>
                     	 <td align='center'><strong>Fam&iacute;lia</strong></td>
                      	<td align='center'><strong>Pontos</strong></td>
                      	<td align='center'><strong>Nivel</strong></td>
                     	</tr>\n";
		 	$Return .= $CTM_GensRanking->RankingSystem($Top_Rank);
		 	$Return .= "</table>";
		}
		return $Return;
		unset($Return);		 
	}
}
endif;
?>
