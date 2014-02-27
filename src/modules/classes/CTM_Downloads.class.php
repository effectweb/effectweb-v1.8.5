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

if(!class_exists("CTM_Downloads")) :

class CTM_Downloads extends CTM_MSSQL
{
	public function __construct()
	{
		global $CTM_Template, $CTM;
		
		$Query = $this->Query("SELECT * FROM {$CTM[2]} ORDER BY id");
		$Check = $this->NumRow($Query);
		
		if($Check < 1)
		{
			exit("<div class=\"info-box\"> Nenhum arquivo para Downloads no Momento</div>");
		}
		else
		{
			$CTM_Template->Set("Check_Files", NULL);
			while($File = $this->FetchArray($Query))
			{
				$Return .= "<tr>
   		 				<td>".$File["name"]."</td>
    					<td>".base64_decode($File["description"])."</td>
    					<td>".$File["file_size"]."</td>
    					<td>[ <a target=\"_black\" href=\"?redirect=".urlencode($File["link"])."\">Download</a> ]</td>
  					</tr>";
			}
		}
		$CTM_Template->Set("Driver#ATI", "?redirect=".urlencode("http://support.amd.com/us/gpudownload/Pages/index.aspx"));
		$CTM_Template->Set("Driver#Intel", "?redirect=".urlencode("http://downloadcenter.intel.com/?lang=por"));
		$CTM_Template->Set("Driver#Matrox", "?redirect=".urlencode("http://www.matrox.com/mga/support/drivers/"));
		$CTM_Template->Set("Driver#NVidia", "?redirect=".urlencode("http://www.nvidia.com.br/Download/index.aspx?lang=br"));
		$CTM_Template->Set("Downloads", $Return);
		unset($Return);
	}
}
endif;
?>