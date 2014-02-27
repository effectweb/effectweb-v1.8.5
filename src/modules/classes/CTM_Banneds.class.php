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

if(!class_exists("CTM_Banneds")) :
	
class CTM_Banneds extends CTM_MSSQL
{
	/**
	 *	Class Constructor
	 *
	 *	@return	void
	*/
	public function __construct()
	{
		global $CTM_Template;
		
		switch($_GET['type'])
		{
			case "accounts" :
				$this->Accounts();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/banneds[ACCOUNTS].pag.php");
			break;
			case "characters" :
				$this->Characters();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/banneds[CHARACTERS].pag.php");
			break;
			default :
				exit("<div class=\"error-box\"> Selecione uma op&ccedil;&atilde;o v&aacute;lida.</div>");
			break;
		}
	}
	/**
	 *	Private: Accounts Banneds
	 *
	 *	@return	void
	*/
	private function Accounts()
	{
		global $CTM_Template;
		
		$accounts_query = $this->Query("SELECT ".MuAcc_DB.".dbo.MEMB_INFO.memb___id, ".MSSQL_DB.".dbo.CTM_WebAccBan.Responsible, ".MSSQL_DB.".dbo.CTM_WebAccBan.Reason, ".MSSQL_DB.".dbo.CTM_WebAccBan.[Time] FROM ".MuAcc_DB.".dbo.MEMB_INFO LEFT JOIN ".MSSQL_DB.".dbo.CTM_WebAccBan ON (".MSSQL_DB.".dbo.CTM_WebAccBan.Account = ".MuAcc_DB.".dbo.MEMB_INFO.memb___id) WHERE ".MuAcc_DB.".dbo.MEMB_INFO.bloc_code = 1");
		
		if($this->NumRow($accounts_query) < 1)
		{
			$return = "<div class=\"info-box\"> N&atilde;o h&aacute; contas banidas no momento.</div>";
		}
		else
		{
			$return = "<table width=\"100%\" border=\"0\">
  <tr>
    <td><strong>Conta:</strong></td>
	<td><strong>Respon&aacute;vel:</strong></td>
    <td><strong>Motivo:</strong></td>
    <td><strong>Vencimento:</strong></td>
  </tr>";
			while($accounts = $this->FetchObject($accounts_query))
			{
				$return .= "  <tr>
    <td>".$accounts->memb___id."</td>
	<td>".(strlen($accounts->Responsible) < 1 ? "Administra&ccedil;&atilde;o" : $accounts->Responsible)."</td>
    <td>".(strlen($accounts->Reason) < 1 ? "Sem Informa&ccedil;&atilde;o" : base64_decode($accounts->Reason))."</td>
    <td>".(strlen($accounts->Time) <> 10 ? "Nunca" : date("d/m/Y - h:i a", $accounts->Time))."</td>
  </tr>";
			}
			
			$return .= "</table>";
		}
		
		$CTM_Template->Set("AccountsBanned", $return);
	}
	/**
	 *	Private: Characters Banneds
	 *
	 *	@return	void
	*/
	private function Characters()
	{
		global $CTM_Template;
		
		$characters_query = $this->Query("SELECT ".MuGen_DB.".dbo.Character.Name, ".MSSQL_DB.".dbo.CTM_WebCharBan.Responsible, ".MSSQL_DB.".dbo.CTM_WebCharBan.Reason, ".MSSQL_DB.".dbo.CTM_WebCharBan.[Time] FROM ".MuGen_DB.".dbo.Character LEFT JOIN ".MSSQL_DB.".dbo.CTM_WebCharBan ON (".MSSQL_DB.".dbo.CTM_WebCharBan.[Character] = ".MuGen_DB.".dbo.Character.Name) WHERE ".MuGen_DB.".dbo.Character.CtlCode = 1");
		
		if($this->NumRow($characters_query) < 1)
		{
			$return = "<div class=\"info-box\"> N&atilde;o h&aacute; personagens banidos no momento.</div>";
		}
		else
		{
			$return = "<table width=\"100%\" border=\"0\">
  <tr>
    <td><strong>Personagem:</strong></td>
    <td><strong>Respon&aacute;vel:</strong></td>
	<td><strong>Motivo:</strong></td>
    <td><strong>Vencimento:</strong></td>
  </tr>";
			while($characters = $this->FetchObject($characters_query))
			{
				$return .= "  <tr>
    <td>".$characters->Name."</td>
	<td>".(strlen($characters->Responsible) < 1 ? "Administra&ccedil;&atilde;o" : $characters->Responsible)."</td>
    <td>".(strlen($characters->Reason) < 1 ? "Sem Informa&ccedil;&atilde;o" : base64_decode($characters->Reason))."</td>
    <td>".(strlen($characters->Time) <> 10 ? "Nunca" : date("d/m/Y - h:i a", $characters->Time))."</td>
  </tr>";
			}
			
			$return .= "</table>";
		}
		
		$CTM_Template->Set("CharactersBanned", $return);
	}
}
endif;
?>