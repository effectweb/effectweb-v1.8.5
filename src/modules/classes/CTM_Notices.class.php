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

if(!class_exists("CTM_Notices")) :

class CTM_Notices extends CTM_MSSQL
{
	public function __construct()
	{
		global $CTM_Template;
		
		switch(strtoupper($_GET["str"]))
		{
			case "VIEW" :
			$this->View();
			$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/news[VIEW].pag.php");
			break;
			default :
			$this->News();
			$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/news.pag.php");
			break;
		}
	}
	private function View()
	{
		global $CTM_Template, $CTM_General, $CTM;
		$CTM_BBCode = new CTM_BBCode();
		
		$Id = $_GET["id"];
		$Account = $_SESSION["Hash_Account"];
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[6]} WHERE Id='{$Id}'");
		if($Check < 1)
		{
			exit("<div class=\"error-box\"> Noticia n&atilde;o encontrada.</div>");
		}
		
		if($_GET["cmd"] == "show_comments")
		{
			$this->Show_Comments();
		}
		if($_GET["cmd"] == "comment")
		{
			$this->Comment_News();
		}
		$Query = $this->FetchQuery("SELECT Title,Date,Account,Text,Comment FROM dbo.{$CTM[6]} WHERE Id='{$Id}'");
		$Character = $this->FetchQuery("SELECT name FROM dbo.{$CTM[0]} WHERE account='{$Query[2]}'");
		$Find_Characters = $this->Query("SELECT Name FROM ".MuGen_DB.".dbo.Character WHERE AccountID='{$Account}'");
		$Image = $CTM_General->Image($Character[0]);
		
		while($Characters = $this->Fetch($Find_Characters))
		{
			$Character_Acc .= "<option value=\"{$Characters[0]}\">{$Characters[0]}</option>\n";
		}
		
		$CTM_Template->Set("News#Title", base64_decode($Query[0]));
		$CTM_Template->Set("News#Image", $Image);
		$CTM_Template->Set("News#Character", $Character[0]);
		$CTM_Template->Set("News#Date", date("d/m/Y", $Query[1]));
		$CTM_Template->Set("News#Hour", date("H:i", $Query[1]));
		$CTM_Template->Set("News#Text", nl2br($CTM_BBCode->Replace(base64_decode($Query[3]))));
		$CTM_Template->Set("News#Id", $Id);
		$CTM_Template->Set("News#Characters", $Character_Acc);
		$CTM_Template->Set("News#Comments", "<script>CTM_Load('?pag=news&str=VIEW&id={$Id}&cmd=show_comments','News_Comments','GET');</script>");
		$CTM_Template->Set("News#Comment_Cmd", $Query[4] == 0 ? "<div class=\"info-box\"> Esta not&iacute;cia n&atilde;o esta com comentarios liberados.</div>" : NULL);
		unset($Character_Acc);
	}
	private function News()
	{
		global $CTM_Template, $CTM;
	
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[6]}");
		if($Check < 1)
		{
			$Return = "<div class=\"info-box\"> N&atilde;o h&aacute; Noticias postada no Momento.</div>";
		}
		else
		{
			$Query = $this->Query("SELECT Title,Date,Id FROM dbo.{$CTM[6]} ORDER BY Id DESC");
			
			$Return .= "<ul style=\"list-style: none;\">";
			while($Load = $this->Fetch($Query))
			{
				$Return .= "<li>&raquo; <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=news&str=VIEW&id=".$Load[2]."','conteudo','GET');\"><b class=\"colr\">".base64_decode($Load[0])."</a></b> - [ ".date("d/m/Y", $Load[1])." as ".date("H:i", $Load[1])." ]</li>\n";
			}
			$Return .= "</ul>";
		}
		$CTM_Template->Set("News_List", $Return);
		unset($Return);
	}
	private function Comment_News()
	{
		global $CTM_General, $CTM;
		$Id = $_GET["id"];
		
		if($_GET["cmd"] == "comment")
		{
			if($CTM_General->Check_Logged(2) == TRUE)
			{
				exit("<div class=\"error-box\"> Para comentar &eacute; preciso estar Logado.<div>");
			}
			else
			{
				$Account = $_SESSION["Hash_Account"];
				$Character = $_POST["Character"];
				$Comment = base64_encode(strip_tags($_POST["Text"]));
				$Check = $this->FetchQuery("SELECT Comment FROM dbo.{$CTM[6]} WHERE Id='{$Id}'");
				
				if($Check[0] == 0)
				{
					exit("<div class=\"error-box\"> Esta not&iacute;cia n&atilde;o esta com comentarios liberados.</div>");
				}
				elseif(empty($Character))
				{
					exit("<div class=\"warning-box\"> Selecione o personagem.</div>");
				}
				elseif(empty($Comment))
				{
					exit("<div class=\"warning-box\"> Digite seu comentario.</div>");
				}
				else
				{
					$this->Query("INSERT INTO dbo.{$CTM[23]} (NoticeID,Account,User_Char,Comment_Date,Text) VALUES ({$Id},'{$Account}','{$Character}',".time().",'{$Comment}')");
					exit("<script>CTM_Load('?pag=news&str=VIEW&id={$Id}','conteudo','GET');</script>");
				}
			}
		}
	}
	private function Show_Comments()
	{
		global $CTM_General, $CTM;
		$CTM_BBCode = new CTM_BBCode();
		
		$Id = $_GET["id"];
		$Account = $_SESSION["Hash_Account"];
		
		$Find_Comments = $this->Query("SELECT * FROM dbo.{$CTM[23]} WHERE NoticeID='{$Id}' ORDER BY Id DESC");
		
		while($Comments = $this->FetchArray($Find_Comments))
		{
			$Return .= "<blockquote>
	<table width=\"638\" border=\"0\">
 			 <tr>
   			 <td width=\"135\"><img src=\"".$CTM_General->Image($Comments["User_Char"])."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /></td>
   			 <td width=\"493\"><table width=\"445\" border=\"0\">
				 <tr>
       			 <td><blockquote>Postado por: <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Comments["User_Char"])."','conteudo','GET');\"><b class=\"colr\">".$Comments["User_Char"]."</b></a> em <b class=\"colr\">".date("d/m/Y", $Comments["Comment_Date"])."</b></blockquote></td>
				 </tr>
				 <tr>
       			 <td><blockquote>".nl2br($CTM_BBCode->Replace(strip_tags(base64_decode($Comments["Text"]))))."</blockquote></td>
				 </tr>
    			</table>
				</td>
  			</tr>
			</table>
		</blockquote>";
				
		}
		exit($Return);
		unset($Return);
	}
}
endif;
?>