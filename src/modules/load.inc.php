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

if(defined("IN_EFFECTWEB"))
	exit("<!-- CTM.Error(x); -->");

# Open Class File
function __autoload($class_name)
{
	if(file_exists("modules/classes/SystemLibrary/".strtolower($class_name).".class.php"))
		require_once("modules/classes/SystemLibrary/".strtolower($class_name).".class.php");
	else
		require_once("modules/classes/".$class_name.".class.php");
}

define("IN_EFFECTWEB", "47e5098c88cc5f67543414ff1af32efc");

# Web Info
$CTM = array("CTM_WebStaff", "CTM_WebRecord", "CTM_WebFiles", "CTM_WebTickets", "CTM_WebProfile", "CTM_WebWarning", "CTM_WebNews", "CTM_WebAccBan", "CTM_WebCharBan", "CTM_WebTicketRes", "CTM_WebPayments", "CTM_WebPaymentRes","CTM_WebRaffles", "CTM_WebCronJob", "CTM_WebRecovery", "CTM_WebPoll", "CTM_WebPollAnswers", "CTM_WebPollVotes", "CTM_WebRegister", "CTM_WebChangeMail","CTM_WebScreenShots", "CTM_WebScreenVotes", "CTM_WebScreenComments","CTM_WebNewsComments");
$CTM[C] = array(CHAR_IMAGE_COLUMN, EXTRA_VAULT_COLUMN);
define("Product", "Effect Web");

# Version
$version = new Version();
$version->setVersion("v1.8.5", "v1.8.5 Finish Edition");
$version->compareVersions(constant("Update_Key"), true);

# Login
if(!empty($_SESSION['Hash_Account']))
{
	$_SESSION["Hash_Account"] = str_replace(array("'", ";", "--"), NULL, $_SESSION["Hash_Account"]);
	$Login = str_replace(array("'", ";", "--"), NULL, $_SESSION["Hash_Account"]);
}

# Class Load
$CTM_Security = new CTM_Security();
$CTM_Template = new CTM_Template();
$CTM_Pages = new CTM_Pages();
$CTM_Crypt = new CTM_Crypt();

if($CTM_Crypt->CallSecuritySite() != "YTc2ZGJiMmZlNDY5ZThkNzkwYmU0ZjJhYWUyNDUwMDI=")
	exit("Files corrupted.");
	
$CTM_MSSQL = new CTM_MSSQL();

# PagSeguro
if($_GET['module'] == "pagseguro")
{
	$CTM_PagSeguro = new CTM_PagSeguro();
	$CTM_PagSeguro->PagSeguroReturn();
}

# Reference
if(strlen($_GET['ref']) > 0)
{
	$CTM_Reference = new CTM_Reference();
	$CTM_Reference->ReferenceLink($_GET['ref']);
}

$CTM_Ajax = new CTM_Ajax();
ob_clean();

?>