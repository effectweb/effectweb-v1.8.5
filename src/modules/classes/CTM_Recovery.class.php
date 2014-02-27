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

if(!class_exists("CTM_Recovery")) :

class CTM_Recovery extends CTM_MSSQL
{
	public function __construct()
	{
		global $CTM_Template;
		
		if(isset($_GET["run"]) == TRUE)
		{
			$this->Check_Datas();
			$this->Reset_Password();
			$CTM_Template->Set("Captcha_Image", "?public=captcha");
			$CTM_Template->Set("Reset_Link", isset($_GET["code"]) == TRUE ? "&code=".$_GET["code"] : NULL);
			$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/recovery[RESET_PWD].pag.php");
		}
		else
		{
			$this->Prepare();
			$CTM_Template->Set("Captcha_Image", "?public=captcha");
			$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/recovery.pag.php");
		}
	}
	private function Reset_Password()
	{
		global $CTM;
		$CTM_Captcha = new CTM_Captcha();
		
		if($_GET["code"] == TRUE)
		{
			if($_GET["check"] == TRUE)
			{
				if(empty($_GET["code"]))
				{
					exit("<div class=\"error-box\"> Este link de valida&ccedil;&atilde;o &eacute; invalido.</div>");
				}
				else
				{
					$Encode = "0x".bin2hex($_GET["code"]);
					$Check_Link = $this->NumQuery("SELECT * FROM dbo.{$CTM[14]} WHERE HashCode={$Encode}");
					$Find_Link = $this->FetchQuery("SELECT Status,Account,Mail,Time_,Expiration 
					FROM dbo.{$CTM[14]} WHERE HashCode={$Encode}");
					
					if($Check_Link < 1)
					{
						exit("<div class=\"error-box\"> Este link de valida&ccedil;&atilde;o &eacute; invalido.</div>");
					}
					if(strtoupper(bin2hex($Find_Link[0])) == "001F")
					{
						exit("<div class=\"error-box\"> Este Link j&aacute; se encontra usado.</div>");
					}
					elseif(time() >= $Find_Link[4])
					{
						exit("<div class=\"error-box\"> Este Link expirou.</div>");
					}
					else
					{
						exit(false);
					}
				}
			}
			if($_GET["cmd"] == TRUE)
			{
				$Password = $_POST["Password"];
				$Re_Password = $_POST["Re_Password"];
				$Captcha = $_POST["Captcha"];
				
				if(empty($_GET["code"]))
				{
					exit("<div class=\"error-box\"> Este link de valida&ccedil;&atilde;o &eacute; invalido.</div>");
				}
				else
				{
					$Encode = "0x".bin2hex($_GET["code"]);
					$Check_Link = $this->NumQuery("SELECT * FROM dbo.{$CTM[14]} WHERE HashCode={$Encode}");
					$Find_Link = $this->FetchQuery("SELECT Status,Account,Mail,Time_,Expiration 
					FROM dbo.{$CTM[14]} WHERE HashCode={$Encode}");
					
					if($Check_Link < 1)
					{
						exit("<div class=\"error-box\"> Este link de valida&ccedil;&atilde;o &eacute; invalido.</div>");
					}
					elseif(strtoupper(bin2hex($Find_Link[0])) == "001F")
					{
						exit("<div class=\"error-box\"> Este Link j&aacute; se encontra usado.</div>");
					}
					elseif(time() >= $Find_Link[4])
					{
						exit("<div class=\"error-box\"> Este Link expirou.</div>");
					}
					elseif(empty($Password))
					{
						exit("<div class=\"warning-box\"> Digite a nova senha.</div>");
					}
					elseif(empty($Re_Password))
					{
						exit("<div class=\"warning-box\"> Digite a confirma&ccedil;&atilde;o de senha.</div>");
					}
					elseif(empty($Captcha))
					{
						exit("<div class=\"warning-box\"> Digite o codigo de seguran&ccedil;a.</div>");
					}
					elseif(eregi("[^a-zA-Z0-9_!=?&-]", $Password)) 
					{
						exit("<div class=\"error-box\"> N&atilde;o use s&iacute;mbolos na Senha.</div>");
					}
					elseif(eregi("[^a-zA-Z0-9_!=?&-]", $Re_Password)) 
					{
						exit("<div class=\"error-box\"> N&atilde;o use s&iacute;mbolos na Confirma&ccedil;&atilde;o de Senha.</div>");
					}
					elseif($CTM_Captcha->Check($Captcha) == FALSE)
					{
						exit("<div class=\"error-box\"> Codigo de seguran&ccedil;a incorreto!</div>");
					}
					else
					{
						$this->Query("UPDATE dbo.{$CTM[14]} SET Status=0x001F WHERE HashCode={$Encode}");
						if(USE_MD5 == 1)
						{
							$this->Query("exec dbo.CTM_CryptPwd '".$Find_Link[1]."','".$Password."'");
						}
						else
						{
							$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET memb__pwd='{$Password}' WHERE memb___id='".$Find_Link[1]."'");
						}
						exit("<div class=\"success-box\"> Senha alterada com Sucesso!</div>");
					}
				}
			}
			else
			{
				echo("<script>CTM_Load('?pag=recovery&run=true&code=".$_GET["code"]."&check=true','Command','GET');</script>");
			}
		}
		else
		{
			if($_GET["cmd"] == TRUE)
			{
				$Code = $_POST["Code"];
				$Password = $_POST["Password"];
				$Re_Password = $_POST["Re_Password"];
				$Captcha = $_POST["Captcha"];
				
				$Encode = "0x".bin2hex($Code);
				$Check_Link = $this->NumQuery("SELECT * FROM dbo.{$CTM[14]} WHERE HashCode={$Encode}");
				$Find_Link = $this->FetchQuery("SELECT Status,Account,Mail,Time_,Expiration 
				FROM dbo.{$CTM[14]} WHERE HashCode={$Encode}");
			
				if(empty($Code))
				{
					exit("<div class=\"warning-box\"> Digite o codigo de valida&ccedil;&atilde;o.</div>");
				}
				elseif(empty($Password))
				{
					exit("<div class=\"warning-box\"> Digite a nova senha.</div>");
				}
				elseif(empty($Re_Password))
				{
					exit("<div class=\"warning-box\"> Digite a confirma&ccedil;&atilde;o de senha.</div>");
				}
				elseif(empty($Captcha))
				{
					exit("<div class=\"warning-box\"> Digite o codigo de seguran&ccedil;a.</div>");
				}
				elseif(eregi("[^a-zA-Z0-9_!=?&-]", $Password)) 
				{
					exit("<div class=\"error-box\"> N&atilde;o use s&iacute;mbolos na Senha.</div>");
				}
				elseif(eregi("[^a-zA-Z0-9_!=?&-]", $Re_Password)) 
				{
					exit("<div class=\"error-box\"> N&atilde;o use s&iacute;mbolos na Confirma&ccedil;&atilde;o de Senha.</div>");
				}
				elseif($CTM_Captcha->Check($Captcha) == FALSE)
				{
					exit("<div class=\"error-box\"> Codigo de seguran&ccedil;a incorreto!</div>");
				}
				if($Check_Link < 1)
				{
					exit("<div class=\"error-box\"> Este codigo de valida&ccedil;&atilde;o &eacute; invalido.</div>");
				}
				elseif(strtoupper(bin2hex($Find_Link[0])) == "001F")
				{
					exit("<div class=\"error-box\"> Este codigo j&aacute; se encontra usado.</div>");
				}
				elseif(time() >= $Find_Link[4])
				{
					exit("<div class=\"error-box\"> Este codigo expirou.</div>");
				}
				else
				{
					$this->Query("UPDATE dbo.{$CTM[14]} SET Status=0x001F WHERE HashCode={$Encode}");
					if(USE_MD5 == 1)
					{
						$this->Query("exec dbo.CTM_CryptPwd '".$Find_Link[1]."','".$Password."'");
					}
					else
					{
						$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET memb__pwd='{$Password}' WHERE memb___id='".$Find_Link[1]."'");
					}
					exit("<div class=\"success-box\"> Senha alterada com Sucesso!</div>");
				}
			}
		}
	}
	private function Prepare()
	{
		global $CTM_General, $CTM, $_Mailer;
		$CTM_Captcha = new CTM_Captcha();
		if($CTM_General->Check_Logged(false) == TRUE)
		{
			exit("<div class=\"info-box\"> Notamos que voc&ecirc; se encontra Logado com a conta \"".$_SESSION["Hash_Account"]."\", o processo n&atilde;o pode ser Efetuado.</div>");
		}
		
		if($_GET["cmd"] == TRUE)
		{
			$Mail = $_POST["Mail"];
			$Captcha = $_POST["Captcha"];
			$Check = $this->NumQuery("SELECT mail_addr FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE mail_addr='{$Mail}'");
			$Find_Mail = $this->FetchQuery("SELECT mail_chek FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE mail_addr='{$Mail}'");
			
			if(empty($Mail))
			{
				exit("<div class=\"warning-box\"> Digite seu E-Mail.</div>");
			}
			elseif(empty($Captcha))
			{
				exit("<div class=\"warning-box\"> Digite o Codigo de Seguran&ccedil;a.</div>");
			}
			elseif($CTM_Captcha->Check($Captcha) == FALSE)
			{
				exit("<div class=\"error-box\"> Codigo de seguran&ccedil;a incorreto!</div>");
			}
			elseif(preg_match("/(.*?)@(.*?).(.).([com|net|org])/i", $Mail) == FALSE)
			{
				exit("<div class=\"error-box\"> E-Mail inv&aacute;lido!</div>");
			}
			elseif($Check < 1)
			{
				exit("<div class=\"error-box\"> Este E-Mail n&atilde;o existe!</div>");
			}
			elseif($Find_Mail[0] == 0)
			{
				exit("<div class=\"error-box\"> Sua conta n&atilde;o esta confirmada.</div>");
			}
			else
			{
				for ($WzAG = 0; $WzAG < 25; $WzAG++)
				{
					$Rand .= chr(mt_rand(65, 90));
				}
				$HashCode = md5($Rand);
				$Binarry = "0x".bin2hex($HashCode);
				$Find_Account = $this->FetchQuery("
				SELECT memb___id,memb_name,fpas_ques,fpas_answ FROM ".MuAcc_DB.".dbo.MEMB_INFO 
				WHERE mail_addr='{$Mail}'");
				$this->Query("INSERT INTO dbo.{$CTM[14]} (Account,Mail,HashCode,Time_,Expiration,Status) 
				VALUES ('".$Find_Account[0]."','".$Mail."',".$Binarry.",".time().",".strtotime("+ 24 hours").",0xFFFF)");
				
				/***************************** Send Mail ******************************/
				$Link .= "http://";
				$Link .= $_SERVER["HTTP_HOST"];
				$Link .= $_SERVER["PHP_SELF"];
				$Link .= "?do=recovery&run=true";
				$Code_Link = "&code=".$HashCode;
				$Message .= "Ol&aacute; <strong>".$Find_Account[1]."</strong>!<br /><br />";
				$Message .= "Voc&ecirc; solicitou a recupera&ccedil;&atilde;o de dados referentes a sua conta,";
				$Message .= "<br />Segue abaixo alguns dados referentes a sua conta:<br /><br />";
				$Message .= "<strong>Login:</strong> ".$Find_Account[0]."<br />";
				$Message .= "<strong>E-Mail:</strong> ".$Mail."<br />";
				$Message .= "<strong>Pergunta Secreta:</strong> ".$Find_Account[2]."<br />";
				$Message .= "<strong>Resposta Secreta:</strong> ".$Find_Account[3]."<br /><br />";
				$Message .= "Para completar este processo, clique no link abaixo para redefinir sua senha:<br />";
				$Message .= "<strong>Link:</strong> <a target=\"_blank\" href=\"".$Link.$Code_Link."\">".$Link.$Code_Link;
				$Message .= "</a><br /><br />";
				$Message .= "<h3><strong>N&atilde;o funciona?</strong></h3>";
				$Message .= "Ent&atilde;o clique no link abaixo de digite o seguinte codigo:<br />";
				$Message .= "Codigo: <strong>".$HashCode."</strong><br />";
				$Message .= "<strong>Link:</strong> <a target=\"_black\" href=\"".$Link."\">".$Link."</a><br />";
				$Message .= "<br /><br />Caso tenha mais problemas, por favor contate o Suporte.<br /><br />";
				
				$CTM_Mailer = new CTM_Mailer();
				$CTM_Mailer->SMTP_Server = $_Mailer["SMTP"]["Server"];
				$CTM_Mailer->SMTP_Port = $_Mailer["SMTP"]["Port"];
				$CTM_Mailer->SMTP_User = $_Mailer["SMTP"]["User"];
				$CTM_Mailer->SMTP_Pass = $_Mailer["SMTP"]["Pass"];
				$CTM_Mailer->Mail_From = $_Mailer["SMTP"]["Mail"];
				$CTM_Mailer->SMTP_Debug = $_Mailer["SMTP"]["Debug"];
				$CTM_Mailer->Mail_To = $Mail;
				$CTM_Mailer->Mail_Sender = "Suporte ".constant("Server_Name");
				$CTM_Mailer->Mail_Recipient = $Find_Account[1];
				$CTM_Mailer->Mail_Subject = utf8_decode("Recuperação de Senha - ".constant("Server_Name"));
				$CTM_Mailer->Mail_Message = $Message;
				
				if($CTM_Mailer->Send_Mail() == FALSE)
				{
					exit("<div class=\"error-box\"> Erro ao enviar o E-Mail!</div>");
				}
				else
				{
					if(constant("Recovery_Pass") === TRUE)
					{
						$New_Password = substr(md5(hash("sha512", $Rand)), 0, 10);
					
						if(USE_MD5 == 1)
						{
							$this->Query("exec dbo.CTM_CryptPwd '".$Find_Account[0]."','".$New_Password."'");
						}
						else
						{
							$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET memb__pwd='{$New_Password}' WHERE memb___id='".$Find_Account[0]."'");
						}
					}
					unset($Link);
					unset($Message);
					exit("<div class=\"success-box\"> Foi enviado um E-Mail com os dados referente a sua conta.<br />Siga as instru&ccedil;&otilde;es para redefinir sua senha.<br /><strong style=\"color: red;\">Caso seu E-Mail seja na hotmail, verifique sua caixa de Spam.</strong></div>");
				}
			}
		}
	}
	private function Check_Datas()
	{
		header("Content-Type: text/javascript", true);
		
		if($_GET["cmd"] == "verify")
		{
			if($_GET["id"] == "code")
			{
				$Code = $_GET["code"];
				$HashCode = "0x".bin2hex($Code);
				$Check = $this->NumQuery("SELECT * FROM dbo.".$GLOBALS["CTM"][14]." WHERE HashCode={$HashCode}");
				
				if(empty($Code))
				{
					exit("<script>VerifyDatas('Code', 'CodeResult', 'Campo em branco', '#efdc75', 'warning');</script>");
				}
				else
				{
					if($Check < 1)
					{
						exit("<script>VerifyDatas('Code', 'CodeResult', 'Codigo invalido', '#FF0000', 'error');</script>");
					}
					else
					{
						exit("<script>VerifyDatas('Code', 'CodeResult', 'Codigo v&aacute;lido', 'green', 'success');</script>");
					}
				}
			}
			if($_GET["id"] == "pwd")
			{
				$Pwd_1 = $_GET["pwd_1"];
				$Pwd_2 = $_GET["pwd_2"];
				
				if(empty($Pwd_2))
				{
					exit("<script>VerifyDatas('Re_Password', 'Re_PasswordResult', 'Campo em branco', '#efdc75', 'warning');</script>");
				}
				else
				{
					if($Pwd_1 != $Pwd_2)
					{
						exit("<script>VerifyDatas('Re_Password', 'Re_PasswordResult', 'Senhas n&atilde;o conferem', '#FF0000', 'error');</script>");
					}
					else
					{
						exit("<script>VerifyDatas('Re_Password', 'Re_PasswordResult', 'Senha Confirmada', 'green', 'success');</script>");
					}
				}
			}
			if($_GET["id"] == "captcha")
			{
				$CTM_Captcha = new CTM_Captcha();
				$Captcha = $_GET["captcha"];
				
				if(empty($Captcha))
				{
					exit("<script>VerifyDatas('Captcha', 'CaptchaResult', 'Campo em branco', '#efdc75', 'warning');</script>");
				}
				else
				{
					if($CTM_Captcha->Check($Captcha) == FALSE)
					{
						exit("<script>VerifyDatas('Captcha', 'CaptchaResult', 'Codigo de Seguan&ccedil;a Incorreto', '#FF0000', 'error');</script>");
					}
					else
					{
						exit("<script>VerifyDatas('Captcha', 'CaptchaResult', 'Codigo de Seguan&ccedil;a v&aacute;lido', 'green', 'success');</script>");
					}
				}
			}
		}
	}
}
endif;
?>