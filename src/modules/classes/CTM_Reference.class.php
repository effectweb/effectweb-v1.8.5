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
	
if(!class_exists("CTM_Reference")) :

class CTM_Reference extends CTM_MSSQL
{
	public function ReferenceLink($id)
	{
		if($this->checkReference($id))
		{
			$query = $this->Query("SELECT Id FROM dbo.CTM_WebReference WHERE Id = ".$id);
			$check = $this->NumRow($query);
			
			if($check > 0)
			{
				$this->Query("UPDATE dbo.CTM_WebReference SET AccessCount = AccessCount + 1,Points = Points + ".NEWFINAL_REF_ACCESSPOINTS." WHERE Id = ".$id);
				$this->setCookies($id);
			}
		}
		exit("<script>location = '?do=register'</script>");
	}
	private function checkReference($id)
	{
		if(empty($id) && !is_int($id)) return FALSE;
		if(!isset($_COOKIE['NewFinal_ReferenceSet']))
		{
			$query = $this->Query("SELECT IPAddress FROM dbo.CTM_WebReferenceData WHERE IPAddress = '".$_SERVER['REMOTE_ADDR']."'");
			if($this->NumRow($query) > 0) return FALSE;
			
			return TRUE;
		}
		
		return TRUE;
	}
	private function setCookies($id)
	{
		$server = preg_replace("/.*/i", NULL, $_SERVER['HTTP_HOST']);
		
		setcookie("NewFinal_Reference", $id, time() + (1 * 24 * 60 * 60), "/", $server);
		setcookie("NewFinal_Reference", $id, time() + (1 * 24 * 60 * 60), "/", str_replace("www.", NULL, $server));
	
		setcookie("NewFinal_ReferenceSet", 1, strtotime("+ 24 hours"), NULL, $server);
		setcookie("NewFinal_ReferenceSet", 1, strtotime("+ 24 hours"), NULL, str_replace("www.", NULL, $server));
	}
}
endif;
?>