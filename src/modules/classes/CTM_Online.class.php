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

if(!class_exists("CTM_Online")) :

class CTM_Online extends CTM_MSSQL
{
	public function __construct()
	{
		global $CTM_General, $CTM_Template;
	
		$Title = $_GET["gs"] == TRUE ? $_GET["gs"] : "Total";
		$CTM_Template->Set("Pag_Title", $Title);
		
		if($_GET["gs"] == TRUE)
		{
			$Query = $this->Query("SELECT memb___id FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE ConnectStat=1 and ServerName='".$_GET["gs"]."' ORDER BY newid();");
			$Check = $this->NumRow($Query);
			
			if($Check < 1)
			{
				exit("<div class=\"info-box\"> N&atilde;o h&aacute; Jogadores conectados neste Servidor</div>");
			}
		}
		else
		{
			$Query = $this->Query("SELECT memb___id,ServerName FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE ConnectStat=1 ORDER BY newid();");
			$Check = $this->NumRow($Query);
	
			if($Check < 1)
			{
				exit("<div class=\"info-box\"> N&atilde;o h&aacute; Jogadores conectados no Momento</div>");
			}
		}
		
		$CTM_Template->Set("Server", $_GET["gs"] == FALSE ? "<td><strong>Servidor:</strong></td>" : NULL);
		
		while($Account = $this->Fetch($Query))
		{
			$GameIDC = $this->FetchQuery("SELECT GameIDC FROM ".MuGen_DB.".dbo.AccountCharacter WHERE id='{$Account[0]}'");
			$Character = $this->FetchQuery("SELECT cLevel,".Column_Reset.",Class,MapNumber FROM ".MuGen_DB.".dbo.Character WHERE Name='{$GameIDC[0]}'");
			$Class = $CTM_General->ClassName($Character[2]);
			$Map = $CTM_General->Map($Character[3]);
		
			$Return .= "<tr>
   			 		<td class=\"colr\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($GameIDC[0])."','conteudo','GET');\">".$GameIDC[0]."</a></td>
    				<td>".$Character[0]."</td>
    		 		<td>".$Character[1]."</td>
    				<td>".$Class."</td>
    	 			<td>".$Map."</td>";
			if($_GET["gs"] == FALSE)
			{
				$Return .= "<td>".$Account[1]."</td>";
			}
  			$Return .= "</tr>";
		}
		
		$CTM_Template->Set("Players_Online", $Return);
		unset($Return);
	}
}
endif;
?>	