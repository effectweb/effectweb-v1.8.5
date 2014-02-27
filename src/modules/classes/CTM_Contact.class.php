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

if(!class_exists("CTM_Contact")) :

class CTM_Contact
{
	public function __construct()
	{
		switch($_GET["type"])
		{
			case "mail" :
			$this->Contact_Mail();
			break;
			case "phone" :
			$this->Contact_Phone();
			break;
			case "tickets" :
			$this->Contact_Tickets();
			break;
			default :
			$this->Contact_General();
			break;
		}
	}
	private function Contact_Mail()
	{
		global $CTM_Template, $_Suportt;
		
		for($WzAG = 0; $WzAG < count($_Suportt["Mail"]); $WzAG++)
		{
			$Return .= "<li>&raquo; ".$_Suportt["Mail"][$WzAG][1]." - <span class=\"colr\">".$_Suportt["Mail"][$WzAG][0]."</span></li>";
		}
		$Open = fopen("templates/".$CTM_Template->Open()."/pages/contact[MAIL].pag.php", "r");
		$CTM_Template->Set("Contact_Option", fread($Open, filesize("templates/".$CTM_Template->Open()."/pages/contact[MAIL].pag.php")));
		$CTM_Template->Set("%CONTACT_MAIL%", $Return);
		unset($Return);
		fclose($Open);
	}
	private function Contact_Phone()
	{
		global $CTM_Template, $_Suportt;
		
		if(@Suportt_Phone == FALSE)
		{
			$CTM_Template->Set("Contact_Option", "<div class=\"info-box\"> No momento n&atilde;o oferecemos Telefones para Contato</div>");
		}
		else
		{
			for($WzAG = 0; $WzAG < count($_Suportt["Phone"]); $WzAG++)
			{
				$Return .= "<li>&raquo; ".$_Suportt["Phone"][$WzAG][1]." - <span class=\"colr\">".$_Suportt["Phone"][$WzAG][0]."</span> (Falar com: <span class=\"colr\">".$_Suportt["Phone"][$WzAG][2]."</span>)</li>";
			}
			$Open = fopen("templates/".$CTM_Template->Open()."/pages/contact[PHONE].pag.php", "r");
			$CTM_Template->Set("Contact_Option", fread($Open, filesize("templates/".$CTM_Template->Open()."/pages/contact[PHONE].pag.php")));
			$CTM_Template->Set("%CONTACT_PHONE%", $Return);
			unset($Return);
			fclose($Open);
		}
	}
	private function Contact_Tickets()
	{
		global $CTM_Template, $_Suportt;
		
		$Open = fopen("templates/".$CTM_Template->Open()."/pages/contact[TICKET].pag.php", "r");
		$CTM_Template->Set("Contact_Option", fread($Open, filesize("templates/".$CTM_Template->Open()."/pages/contact[TICKET].pag.php")));
		fclose($Open);
	}
	private function Contact_General()
	{
		global $CTM_Template, $_Suportt;
		
		$Number[0] = constant("Forum_Enable") == TRUE ? 1 : 0;
		$Number[1] = constant("Suportt_Phone") == TRUE ? 1 : 0;
		$Return .= "Visando uma melhor forma de atendimento, estamos disponibilizando "; 
		$Return .= 2.+$Number[0]+$Number[1].""; 
		$Return .= " maneiras r&aacute;pidas e seguras para que voc&ecirc; entre em contato com a nossa Equipe:<br /><br /><input type=\"button\" value=\"E-Mail / MSN\" onclick=\"CTM_Load('?pag=contact&type=mail','conteudo','GET');\"> "; 
		if(constant("Suportt_Phone") == TRUE) { $Return .= "<input type=\"button\" value=\"Telefone\" onclick=\"CTM_Load('?pag=contact&type=phone','conteudo','GET');\">"; } 
		$Return .= " <input type=\"button\" value=\"Tickets de Suporte\" onclick=\"CTM_Load('?pag=contact&type=tickets','conteudo','GET');\">";
		if(constant("Forum_Enable") == TRUE)
		{
			$Return .= " <input type=\"button\" value=\"F&oacute;rum\" onclick=\"window.open('".Suportt_Forum."', 'windowname1'); return false;\">";
		}
		
		$CTM_Template->Set("Contact_Option", $Return);
	}
}
endif;
?>