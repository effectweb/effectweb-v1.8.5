<?php
//**********************************************//
// -> Effect Web                                //
// -> Powered by Erick-Master                   //
// -> CTM TEAM Softwares                        //
// -> www.ctmts.com.br                          //
//**********************************************//

define("SESSION_NAME", "df5A279HCERUxcpA");

ob_start();
session_name(SESSION_NAME);
session_start();

if(isset($_GET["public"]))
{
	switch($_GET["public"])
	{
		case "captcha" :
		require_once("modules/classes/CTM_Captcha.class.php");
		$CTM_Captcha = new CTM_Captcha();
		$CTM_Captcha->Captcha_Image(130, 25);
		exit();
		break;
		case "logoGuild" :
		require_once("modules/classes/CTM_LogoGuild.class.php");
		$CTM_LogoGuild = new CTM_LogoGuild();
		$CTM_LogoGuild->ShowLogo();
		exit();
		break;
	}
}

require_once("modules/Settings.php");
require_once("modules/load.inc.php");

$CTM_General = new CTM_General();
$CTM_CronJob = new CTM_CronJob();
$CTM_Pages->Redirect();

$CTM_Template->TPL_Modules();
$CTM_Pages->AjaxPages();
$CTM_Pages->GeneralPages();

$CTM_Template->Show();
?>