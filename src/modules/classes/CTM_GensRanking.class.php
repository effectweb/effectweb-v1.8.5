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

if(!class_exists("CTM_GensRanking")) :

class CTM_GensRanking extends CTM_MSSQL
{
	private function FamilyDir($Family)
	{
		switch($Family)
		{
				case 1 : return "duprian"; break;
				case 2 : return "vanert"; break;
		}
	}
	private function FamilyName($Family)
	{
		switch($Family)
		{
				case 1 : return "Duprian"; break;
				case 2 : return "Vanert"; break;
		}
	}
	private function RankName($Ranking)
	{
		switch($Ranking)
		{
			case 1 : return "Grande Duque"; break;
			case 2 : return "Duque"; break;
			case 3 : return "Marqu&ecirc;s"; break;
			case 4 : return "Conde"; break;
			case 5 : return "Visconde"; break;
			case 6 : return "Bar&atilde;o"; break;
			case 7 : return "Guerreiro Comandante"; break;
			case 8 : return "Guerreiro Superior"; break;
			case 9 : return "Guerreiro"; break;
			case 10 : return "Guarda"; break;
			case 11 : return "Oficial"; break;
			case 12 : return "Tenente"; break;
			case 13 : return "Sargento"; break;
			case 14 : return "Soldado"; break;
		}
	}
	private function RankImage($Ranking, $Family)
	{
		switch($Family)
		{
			case 2 : $Folder = "vanert"; break;
			case 1 : $Folder = "duprian"; break;
		}
		switch($Ranking)
		{
			case 1 : return "images/gens/{$Folder}/01.jpg"; break;
			case 2 : return "images/gens/{$Folder}/02.jpg"; break;
			case 3 : return "images/gens/{$Folder}/03.jpg"; break;
			case 4 : return "images/gens/{$Folder}/04.jpg"; break;
			case 5 : return "images/gens/{$Folder}/05.jpg"; break;
			case 6 : return "images/gens/{$Folder}/06.jpg"; break;
			case 7 : return "images/gens/{$Folder}/07.jpg"; break;
			case 8 : return "images/gens/{$Folder}/08.jpg"; break;
			case 9 : return "images/gens/{$Folder}/09.jpg"; break;
			case 10 : return "images/gens/{$Folder}/10.jpg"; break;
			case 11 : return "images/gens/{$Folder}/11.jpg"; break;
			case 12 : return "images/gens/{$Folder}/12.jpg"; break;
			case 13 : return "images/gens/{$Folder}/13.jpg"; break;
			case 14 : return "images/gens/{$Folder}/14.jpg"; break;
		}
	}
	public function RankingSystem($Top)
	{
		global $_Ranking;
		
		$Query = $this->Query("SELECT TOP ".$Top." * FROM ".$_Ranking["Gens"]["DB"].".dbo.".$_Ranking["Gens"]["Table"]." ORDER BY RANKING ASC, CONTRIBUITION DESC");
		for($WzAG = 0; $WzAG < $this->NumRow($Query); $WzAG++)
		{
			$Ranking = $WzAG+1;
			$Load = $this->FetchArray($Query);
			$Rank = $this->RankImage($Load["RANKING"], $Load["FAMILY"]);
			$Position = $this->RankName($Load["RANKING"]);
			$Family = $this->FamilyName($Load["FAMILY"]);
			$FamilyDir = $this->FamilyDir($Load["FAMILY"]);
			
			$Return .= "<tr>
                      <td align='center'>".$Ranking."</td>
                      <td align='center'><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Load["CHAR_NAME"])."','conteudo','GET');\" >".$Load["CHAR_NAME"]."</a></td>
                      <td align='center'><img src=\"images/gens/".$FamilyDir."/14.jpg\" title=\"{$Family}\" /></td>

                      <td align='center'>".$Load["CONTRIBUITION"]."</td>
                      <td align='center'><img src=\"{$Rank}\" title=\"{$Position}\" /></td>
                     </tr>\n";
		}
		return $Return;
		unset($Return);
	}
}
endif;
?>