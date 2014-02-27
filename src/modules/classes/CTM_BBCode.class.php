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

if(!class_exists("CTM_BBCode")) :

class CTM_BBCode
{
	private $Codes = 
	array(
		 "[b]" => "<strong>",
		 "[/b]" => "</strong>",
		 "[i]" => "<em>",
		 "[/i]" => "</em>",
		 "[u]" => "<u>",
		 "[/u]" => "</u>",
		 "[s]" => "<s>",
		 "[/s]" => "</s>",
		 "[h1]" => "<h1>",
		 "[/h1]" => "</h1>",
		 "[left]" => "<div align=\"left\">",
		 "[/left]" => "</div>",
		 "[center]" => "<div align=\"center\">",
		 "[/center]" => "</div>",
		 "[right]" => "<div align=\"right\">",
		 "[/right]" => "</div>",
		 "[red]" => "<font color=\"#FF0000\">",
		 "[/red]" => "</font>",
		 "[white]" => "<font color=\"#FFFFFF\">",
		 "[/white]" => "</font>",
		 "[blue]" => "<font color=\"#0000FF\">",
		 "[/blue]" => "</font>",
		 "[green]" => "<font color=\"green\">",
		 "[/green]" => "</font>",
		 "[yellow]" => "<font color=\"#FEFF00\">",
		 "[/yellow]" => "</font>",
		 "[violet]" => "<font color=\"#FF00FF\">",
		 "[/violet]" => "</font>",
		 "[gray]" => "<font color=\"#808080\">",
		 "[/gray]" => "</font>",
		 "[lime]" => "<font color=\"#00FF00\">",
		 "[/lime]" => "</font>",
		 "[silver]" => "<font color=\"#C0C0C0\">",
		 "[/silver]" => "</font>",
		 "[pink]" => "<font color=\"#FFC0CB\">",
		 "[/pink]" => "</font>",
		 "[navy]" => "<font color=\"#000080\">",
		 "[/navy]" => "</font>",
		 "[aqua]" => "<font color=\"#00FFFF\">",
		 "[/aqua]" => "</font>",
                    );
	public function Replace($String)
	{
		foreach ($this->Codes as $BBCode => $Value)
		{
			$String = eregi_replace(quotemeta($BBCode), quotemeta($Value), $String);
			$String = str_replace("\.", ".", $String);
		}
		return $String;
	}
}
endif;
?>