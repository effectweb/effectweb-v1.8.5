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

if(IN_EFFECTWEB != "47e5098c88cc5f67543414ff1af32efc")
	exit("<!-- CTM.Error(x); -->");

if(!class_exists("CTM_Register")) :

class CTM_Register extends CTM_MSSQL
{
	private $Error = NULL;
	private $Pwd_Query = NULL;
	
	private $itemCryptKey = "JlgzWXhGWCNnajZoNER1cUh5bnI4R0BkajR4YQ==";
	private $itemScript = array();
	
	public function __construct()
	{
		global $CTM_General, $CTM_Template, $Login, $_Register;
		
		if(constant("Register[Enable]") == true)
		{
			if($CTM_General->Check_Logged(false) == TRUE)
			{
				exit("<div class=\"info-box\"> Notamos que voc&ecirc; se encontra Logado com a conta \"".$_SESSION["Hash_Account"]."\", o cadastro n&atilde;o pode ser Efetuado.</div>");
			}
			elseif(isset($_GET["run"]) == TRUE)
			{
				$this->VerifyDatas();
				$this->Confirm_Register();
				echo("<script type=\"text/javascript\">
				function Security_Captcha(div)
				{
					document.getElementById(div).src = '?public=captcha&' + Math.random();
				}
				Security_Captcha('captcha');
				</script>

				<div id=\"Verify\" style=\"display: none;\"></div>");
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/register[CONFIRM].pag.php");
			}
			else
			{
				define("ITEMBONUS_ENABLE", $this->useItemScript() && constant("Register[ItemBonus]"));
				define("DEFINEPID_ENABLE", constant("Register[DefinePID]"));
				
				$this->VerifyDatas();
				$this->RegisterNow();
				echo("<script type=\"text/javascript\">
				function Security_Captcha(div)
				{
					document.getElementById(div).src = '?public=captcha&' + Math.random();
				}
				Security_Captcha('captcha');
				</script>

				<div id=\"Verify\" style=\"display: none;\"></div>");
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/register.pag.php");
			}
		}
		else
		{
			exit("<div class=\"info-box\"> O registro se encontra Desativado no Momento.</div>");
		}
	}
	private function RegisterNow()
	{
		global $CTM, $_Register, $_Mailer;
		$CTM_Captcha = new CTM_Captcha();
		$iPID = (boolean)constant("Register[DefinePID]");
		$lower = (boolean)constant("Register[ForceLower]");
		
		if($_GET["cmd"] == TRUE)
		{
			#Define POST
			$Account =  $_POST["Account"];
			$Password = $_POST["Password"];
			$Re_Password = $_POST["Re_Password"];
			$PID = $_POST["PID"];
			$Mail = $_POST["Mail"];
			$Re_Mail = $_POST["Re_Mail"];
			$Name = $_POST["Name"];
			$Phone = $_POST["Phone"];
			$Sex = $_POST["Sex"];
			$Date_D = $_POST["Date_D"];
			$Date_M = $_POST["Date_M"];
			$Date_Y = $_POST["Date_Y"];
			$Question = $_POST["Question"];
			$Answer = $_POST["Resp"];
			$Captcha = $_POST["Captcha"];
			$ItemBonus = $_POST["ItemBonus"];
			
			# Define Empty POST
			if(empty($Account)) { $this->Error = "&raquo; Login em Branco<br />"; }
			if(empty($Password)) { $this->Error .= "&raquo; Senha em Branco<br />"; }
			if(empty($Re_Password)) { $this->Error .= "&raquo; Confirma&ccedil;&atilde;o de Senha em Branco<br />"; }
			if(empty($PID) && $iPID) { $this->Error .= "&raquo; Personal ID em branco<br />"; }
			if(empty($Mail)) { $this->Error .= "&raquo; E-Mail em Branco<br />"; }
			if(empty($Re_Mail)) { $this->Error .= "&raquo; Confirma&ccedil;&atilde;o de E-Mail em Branco<br />"; }
			if(empty($Name)) { $this->Error .= "&raquo; Nome em Branco<br />"; }
			if(empty($Phone)) { $this->Error .= "&raquo; Telefone em Branco<br />"; }
			if(empty($Sex)) { $this->Error .= "&raquo; Selecione seu Sexo<br />"; }
			if(empty($Date_D)) { $this->Error .= "&raquo; Selecione o dia de seu nascimento<br />"; }
			if(empty($Date_M)) { $this->Error .= "&raquo; Selecione o m&ecirc;s de seu nascimento<br />"; }
			if(empty($Date_Y)) { $this->Error .= "&raquo; Selecione o ano de seu nascimento<br />"; }
			if(empty($Question)) { $this->Error .= "&raquo; Selecione uma Pergunta Secreta<br />"; }
			if(empty($Answer)) { $this->Error .= "&raquo; Digite a resposta Secreta<br />"; }
			if(empty($Captcha)) { $this->Error .= "&raquo; Codigo de Seguan&ccedil;a em Branco<br />"; }
			
			# Define POST Erros
			if($CTM_Captcha->Check($Captcha) == FALSE) { $this->Error .= "&raquo; Codigo de Seguran&ccedil;a Incorreto.<br />"; }
			if(eregi("[^a-zA-Z0-9_!=?&-]", $Account)) { $this->Error .= "&raquo; N&atilde;o use s&iacute;mbolos no Login<br />"; }
			if(eregi("[^a-zA-Z0-9_!=?&-]", $Password) || eregi("[^a-zA-Z0-9_!=?&-]", $Re_Password)) { $this->Error .= "&raquo; N&atilde;o use s&iacute;mbolos na Senha<br />"; }
			if(eregi("[^a-zA-Z0-9_!=?&-]", $Re_Password)) { 
			$this->Error .= "&raquo; N&atilde;o use s&iacute;mbolos na Confirma&ccedil;&atilde;o de Senha<br />"; }
			if(!is_numeric($PID) && $iPID) { $this->Error .= "&raquo; O Personal ID deve conter somente n&uacute;meros<br />"; }
			if(strlen($PID) <> 7 && $iPID) { $this->Error .= "&raquo; O Personal ID deve conter exatamente 7 digitos<br />"; }
			if(preg_match("/(.*?)@(.*?)\..([com|net|org])/i", $Mail) == FALSE) { $this->Error .= "&raquo; E-Mail inv&aacute;lido<br />"; }
			
			# Define Verify POST
			if($Password != $Re_Password) { $this->Error .= "&raquo; Senhas n&atilde;o conferem<br />"; }
			if($Mail != $Re_Mail) { $this->Error .= "&raquo; E-Mails n&atilde;o conferem<br />"; }
			
			# Define Check POST
			$Check[0] = $this->NumQuery("SELECT memb___id FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id=".($lower ? "LOWER" : NULL)."('{$Account}')");
			$Check[1] = $this->NumQuery("SELECT mail_addr FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE mail_addr='{$Mail}'");
			if($Check[0] > 0) { $this->Error .= "&raquo; Login em Uso<br />"; }
			if($Check[1] > 0) { $this->Error .= "&raquo; E-Mail em Uso<br />"; }
			
			# Define Show Errors
			if(isset($this->Error)) 
			{
				exit("<div class=\"error-box\">Os seguintes erros for&atilde;o encontrados: <br />".$this->Error."</div>");
			}
			
			# Define Send Variables
			$Date = date("d/m/Y - H:i:s");
			$Date_G = $Date_D."/".$Date_M."/".$Date_Y;
			$PID = "111111".($iPID ? $PID : "1234567");
			$Account = $lower == true ? strtolower($Account) : $Account;
			
			# Define Password Module
			if(USE_MD5 == 1)
			{
				$this->Pwd_Query = "CONVERT(varbinary(16),'0x00')";
			}
			else
			{
				$this->Pwd_Query = "'".$Password."'";
			}
			# Define Mail Register
			if(constant("Register[Confirm_Mail]") === TRUE)
			{
				for ($WzAG = 0; $WzAG < 25; $WzAG++)
				{
					$Rand .= chr(mt_rand(65, 90));
				}
				$Define["Account"] = substr(md5($Rand.sha1(time())), 0, 10);
				$Define["Mail_Check"] = 0;
				$HashCode = md5(sha1($Rand));
				$Binarry = "0x".bin2hex($HashCode);
				$this->Query("INSERT INTO dbo.{$CTM[18]} (Account,Temp_Account,HashCode,Status) VALUES (
				'".$Account."','".$Define["Account"]."',".$Binarry.",0xFFFF)");
			}
			else
			{
				$Define["Account"] = $Account;
				$Define["Mail_Check"] = 1;
			}
			
			# Degine Item Bonus
			if(!($ItemBonus == NULL) && ITEMBONUS_ENABLE)
			{
				$itemHexa = $this->itemScript($ItemBonus);
				if($itemHexa != "none")
					$this->Query("INSERT INTO ".MuGen_DB.".dbo.warehouse (AccountID,items,money,DbVersion) VALUES ('".$Define["Account"]."',CONVERT(varbinary(".(GS_Version > 1 ? 1920 : 1200)."),".$itemHexa."),'0','".(GS_Version > 1 ? 3 : 1)."')");
			}
			
			
			# Define Register Query
			$this->Query("INSERT INTO ".MuAcc_DB.".dbo.MEMB_INFO (memb___id,memb__pwd,memb_name,sno__numb,post_code,addr_info,addr_deta,tel__numb,mail_addr,phon_numb,fpas_ques,fpas_answ,job__code,CTM_Date,CTM_Birth,CTM_Sex,appl_days,modi_days,out__days,true_days,mail_chek,bloc_code,ctl1_code) VALUES ('".$Define["Account"]."',".$this->Pwd_Query.",'{$Name}','{$PID}','s-n','11111','','{$Phone}','{$Mail}','','{$Question}','{$Answer}','1','{$Date}','{$Date_G}','{$Sex}','2003-11-23','2003-11-23','2003-11-23','2003-11-23','".$Define["Mail_Check"]."','0','1')");
			if (USE_MD5 == 1)
			{
				$this->Query("exec dbo.CTM_CryptPwd '".$Define["Account"]."','".$Password."'");
			}
			
			# Define Register VI_CURR_INFO
			if(VI_CURR_INFO == TRUE)
			{
				$this->Query("INSERT INTO ".MuAcc_DB.".dbo.VI_CURR_INFO (ends_days,chek_code,used_time,memb___id,memb_name,memb_guid,sno__numb,Bill_Section,Bill_value,Bill_Hour,Surplus_Point,Surplus_Minute,Increase_Days) VALUES ('2005','1',1234,'".$Account."','{$Name}',1,'7','6','3','6','6','2003-11-23 10:36:00','0')");
			}
			
			# Define VIP Table
			if(VIP_Table != "MEMB_INFO")
			{
				$this->Query("INSERT INTO ".VIP_DB.".dbo.".VIP_Table." (".VIP_Login.",".VIP_Column.",".VIP_Begin.",".VIP_Time.",".VIP_Credits.") VALUES ('".$Define["Account"]."',0,0,0,0)");
			}
			
			# Define Cash Table
			if(GL_Table != "MEMB_INFO")
			{
				$this->Query("INSERT INTO ".GL_DB.".dbo.".GL_Table." (".GL_Column_1.",".GL_Login.") VALUES (0,'".$Define["Account"]."')");
			}
			
			# Define Bonus Register
			if(constant("Register[VIP][Enable]") === TRUE)
			{
				switch(constant("Register[VIP][Type]"))
				{
					case 1 : $VIP_Type = constant("VIP_1"); break;
					case 2 : $VIP_Type = constant("VIP_2"); break;
					case 3 : $VIP_Type = constant("VIP_3"); break;
					case 4 : $VIP_Type = constant("VIP_4"); break;
					case 5 : $VIP_Type = constant("VIP_5"); break;
				}
				$VIP_Begin = strtotime("now");
				$VIP_Time = strtotime("+ ".constant("Register[VIP][Time]")." days");
				
				$this->Query("UPDATE ".VIP_DB.".dbo.".VIP_Table." SET ".VIP_Column."=".constant("Register[VIP][Type]").",".VIP_Begin."=".$VIP_Begin.",".VIP_Time."=".$VIP_Time.",".VIP_Credits."=".constant("Register[VIP][Time]")." WHERE ".VIP_Login."='".$Define["Account"]."'");

				$Bonus .= "&raquo; ".constant("Register[VIP][Time]")." dias de ".$VIP_Type.".<br />";
			}
			if(constant("Register[Cash][Enable]") === TRUE)
			{
				$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".constant("GL_Column_".constant("Register[Cash][Coin]"))."=".constant("GL_Column_".constant("Register[Cash][Coin]"))."+".constant("Register[Cash][Number]")." WHERE ".GL_Login."='".$Define["Account"]."'");
				$Bonus .= "&raquo; ".constant("Register[Cash][Number]")." ".constant("Coin_".constant("Register[Cash][Coin]"))."";
			}
			if($Bonus == TRUE) { $Echo_Bonus = "<br /><br />Voc&ecirc; foi premiado com: <br />{$Bonus}"; }
			# Define Message
			if(constant("Register[Confirm_Mail]") === TRUE)
			{
				$Exit = "Cadastro Realizado com Sucesso!<br />Foi enviado 1 e-mail para <strong>{$Mail}</strong> contendo informa&ccedil;&otilde;es para confirmar o seu cadastro.<br />Entre em seu E-Mail e siga as instru&ccedil;&otilde;es para confirmar o seu cadastro.<br /><strong style=\"color: red;\">Caso seu E-Mail seja na hotmail, verifique sua caixa de Spam.</strong><br />A Equipe ".Server_Name." agradece.";
			}
			else
			{
				$Exit = "Cadastro Realizado com Sucesso!<br /><br />&raquo; Nome: <b>{$Name}</b><br />&raquo; E-Mail: <b>{$Mail}</b><br />&raquo; Login: <b>{$Account}</b><br />&raquo; Senha: <b>{$Password}</b>{$Echo_Bonus}<br /><br />Seja Bem Vindo ao ".Server_Name.". Baixe o Client em nossa &aacute;rea de Downloads e Divirta-se.<br />A Equipe ".Server_Name." agradece.";
			}
			# Define Send Mail
			if(constant("Register[Confirm_Mail]") === TRUE)
			{
				$Link .= "http://";
				$Link .= $_SERVER["HTTP_HOST"];
				$Link .= $_SERVER["PHP_SELF"];
				$Link .= "?do=register&run=true";
				$Code_Link = "&code=".$HashCode;
				$Message .= "Ol&aacute; <strong>".$Name."</strong>!<br /><br />";
				$Message .= "Obrigado por cadastrar em nosso servidor,,";
				$Message .= "<br />Segue abaixo alguns dados referentes a sua conta:<br /><br />";
				$Message .= "<strong>Login:</strong> ".$Account."<br />";
				$Message .= "<strong>E-Mail:</strong> ".$Mail."<br />";
				$Message .= "<strong>Senha:</strong> ".$Password."<br />";
				$Message .= "<strong>Pergunta Secreta:</strong> ".$Question."<br />";
				$Message .= "<strong>Resposta Secreta:</strong> ".$Answer."<br /><br />";
				$Message .= "Para completar este processo, clique no link abaixo para confirmar o seu cadastro:<br />";
				$Message .= "<strong>Link:</strong> <a target=\"_blank\" href=\"".$Link.$Code_Link."\">".$Link.$Code_Link;
				$Message .= "</a><br /><br />";
				$Message .= "<h3><strong>N&atilde;o funciona?</strong></h3>";
				$Message .= "Ent&atilde;o clique no link abaixo de digite o seguinte codigo:<br />";
				$Message .= "Codigo: <strong>".$HashCode."</strong><br />";
				$Message .= "<strong>Link:</strong> <a target=\"_black\" href=\"".$Link."\">".$Link."</a><br />";
				$Message .= "{$Echo_Bonus}";
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
				$CTM_Mailer->Mail_Subject = utf8_decode("Confirmação de Cadastro - ".constant("Server_Name"));
				$CTM_Mailer->Mail_Message = $Message;
				
				if($CTM_Mailer->Send_Mail() == FALSE)
				{
					exit("<div class=\"error-box\"> Erro ao enviar o E-Mail!</div>");
				}
				else
				{
					unset($Link);
					unset($Message);
				}
			}
			
			# Define New Final Reference
			if(!empty($_COOKIE['NewFinal_Reference']))
			{
				$reference = $_COOKIE['NewFinal_Reference'];
				$IP = $_SERVER['REMOTE_ADDR'];
				
				$query = $this->Query("SELECT Account FROM dbo.CTM_WebReference WHERE Id = '{$reference}'");
				$check = $this->NumRow($query);
				$fetch = $this->Fetch($query);
				
				if($check > 0)
				{
					$query = $this->Query("SELECT Account FROM dbo.CTM_WebReferenceData WHERE Reference = '{$reference}' AND (Account = '{$Account}' OR IPAddress = '{$IP}')");
					$check = $this->NumRow($query);
					
					if($check < 1)
					{
						$this->Query("UPDATE dbo.CTM_WebReference SET RegisterCount = RegisterCount + 1, Points = Points + ".NEWFINAL_REF_REGPOINTS." WHERE Id = {$reference}");
						$this->Query("INSERT INTO dbo.CTM_WebReferenceData (Reference,RefLogin,Account,IPAddress) VALUES ({$reference},'{$fetch[0]}','{$Account}','{$IP}')");
					}
				}
			}
			
			$_SESSION['CTM_Captcha'] = md5(sha1(mt_rand(0, 9999)));
			
			exit("<div class=\"success-box\">".$Exit."</div>");
		}
	}
	private function useItemScript()
	{
		global $controller;
		
		if(!file_exists("modules/core/Core_Register.txt")) return FALSE;
		
		$itemFile = file_get_contents("modules/core/Core_Register.txt");
		$itemFile = preg_replace("/".preg_quote("----------- BEGIN CTM.MODULE LICENSE FOR [")."(.*?)".preg_quote("] -----------")."/is", NULL, trim($itemFile));
		$itemFile = preg_replace("/".preg_quote("----------- END CTM.MODULE LICENSE FOR [")."(.*?)".preg_quote("] -----------")."/is", NULL, trim($itemFile));
		$itemFile = str_replace(array("\r", "\n"), NULL, $itemFile);
		$itemFile = CTM_Crypt::stringNewDecoder(base64_decode($itemFile), $this->itemCryptKey);
		
		eval($itemFile);
		
		$this->itemScript['LICENSE'] = $itemScriptData['LICENSE'];
		$this->itemScript['OPTIONS'] = $itemScriptData['OPTIONS'];
		
		return $controller->getLicenseInfo("license", "serial") == $this->itemScript['LICENSE'];
	}
	private function itemScript($option)
	{
		$script = "none";
		
		switch($option)
		{
			case 4 :
				if(GS_Version >= 4 && $this->itemScript['OPTIONS'][$option])
				{
					$script = $this->itemScript['OPTIONS'][$option];
					for($i = 0; $i < 120; $i++)
					{
						$pos = strpos($script, "{XXXXXXXX}");
						if($pos > 0)
						{
							$script = substr_replace($script, $this->Get_ItemSerial(), $pos, 10);
							continue;
						}
					}
				}
			break;
			case 6 :
				if(GS_Version >= 1 && $this->itemScript['OPTIONS'][$option])
				{
					$script = $this->itemScript['OPTIONS'][$option];
					for($i = 0; $i < 120; $i++)
					{
						$pos = strpos($script, "{XXXXXXXX}");
						if($pos > 0)
						{
							$script = substr_replace($script, $this->Get_ItemSerial(), $pos, 10);
							continue;
						}
					}
				}
			break;
			case 7 :
				if(GS_Version == 6 && $this->itemScript['OPTIONS'][$option])
				{
					$script = $this->itemScript['OPTIONS'][$option];
					for($i = 0; $i < 120; $i++)
					{
						$pos = strpos($script, "{XXXXXXXX}");
						if($pos > 0)
						{
							$script = substr_replace($script, $this->Get_ItemSerial(), $pos, 10);
							continue;
						}
					}
				}
			break;
			default :
				if($this->itemScript['OPTIONS'][$option])
				{
					$script = $this->itemScript['OPTIONS'][$option];
					for($i = 0; $i < 120; $i++)
					{
						$pos = strpos($script, "{XXXXXXXX}");
						if($pos > 0)
						{
							$script = substr_replace($script, $this->Get_ItemSerial(), $pos, 10);
							continue;
						}
					}
				}
			break;
		}
		
		return str_pad($script, (GS_Version > 1 ? 1920 : 1200) * 2 + 2, "F", STR_PAD_RIGHT);
	}
	private function Get_ItemSerial()
	{
		$WZ_GetItemSerial = $this->FetchQuery("exec ".MuGen_DB.".dbo.WZ_GetItemSerial");
		
		$ItemSerial = strtoupper(dechex($WZ_GetItemSerial[0]));
		$ItemSerial = str_pad($ItemSerial, 8, 0, STR_PAD_LEFT);
		
		return $ItemSerial;
	}
	private function Confirm_Register()
	{
		global $CTM;
		$CTM_Captcha = new CTM_Captcha();
		
		if($_GET["code"] == TRUE)
		{
			echo("<div class=\"col2\">");
			if(empty($_GET["code"]))
			{
				exit("<div class=\"error-box\"> Este link de valida&ccedil;&atilde;o &eacute; invalido.</div>");
			}
			else
			{
				$Encode = "0x".bin2hex($_GET["code"]);
				$Check_Link = $this->NumQuery("SELECT * FROM dbo.{$CTM[18]} WHERE HashCode={$Encode}");
				$Find_Link = $this->FetchQuery("SELECT Status,Account,Temp_Account 
				FROM dbo.{$CTM[18]} WHERE HashCode={$Encode}");
					
				if($Check_Link < 1)
				{
					exit("<div class=\"error-box\"> Este link de valida&ccedil;&atilde;o &eacute; invalido.</div>");
				}
				if(strtoupper(bin2hex($Find_Link[0])) == "F41E")
				{
					exit("<div class=\"error-box\"> Este Link j&aacute; se encontra usado.</div>");
				}
				else
				{
					$this->Query("UPDATE dbo.{$CTM[18]} SET Status=0xF41E WHERE HashCode={$Encode}");
					$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET memb___id='".$Find_Link[1]."',mail_chek=1 WHERE memb___id='".$Find_Link[2]."'");
					$this->Query("UPDATE ".MuGen_DB.".dbo.warehouse SET AccountID='".$Find_Link[1]."' WHERE AccountID='".$Find_Link[2]."'");
					if(VIP_table != "MEMB_INFO")
					{
						$this->Query("UPDATE ".VIP_DB.".dbo.".VIP_Table." SET ".VIP_Login."='".$Find_Link[1]."' WHERE ".VIP_Login."='".$Find_Link[2]."'");
					}
					if(GL_Table != "MEMB_INFO")
					{
						$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".GL_Login."='".$Find_Link[1]."' WHERE ".GL_Login."='".$Find_Link[2]."'");
					}
					exit("<div class=\"success-box\"> Cadastrado confirmado com Sucesso!<br /><br />Seja Bem Vindo ao ".Server_Name.". Baixe o Client em nossa &aacute;rea de Downloads e Divirta-se.<br />A Equipe ".Server_Name." agradece.</div>");
				}
			}
		}
		else
		{
			if($_GET["cmd"] == TRUE)
			{
				$Code = $_POST["Code"];
				$Captcha = $_POST["Captcha"];
				
				$Encode = "0x".bin2hex($Code);
				$Check_Link = $this->NumQuery("SELECT * FROM dbo.{$CTM[18]} WHERE HashCode={$Encode}");
				$Find_Link = $this->FetchQuery("SELECT Status,Account,Temp_Account 
				FROM dbo.{$CTM[18]} WHERE HashCode={$Encode}");
			
				if(empty($Code))
				{
					exit("<div class=\"warning-box\"> Digite o codigo de valida&ccedil;&atilde;o.</div>");
				}
				elseif(empty($Captcha))
				{
					exit("<div class=\"warning-box\"> Digite o codigo de seguran&ccedil;a.</div>");
				}
				elseif($CTM_Captcha->Check($Captcha) == FALSE)
				{
					exit("<div class=\"error-box\"> Codigo de seguran&ccedil;a incorreto!</div>");
				}
				if($Check_Link < 1)
				{
					exit("<div class=\"error-box\"> Este codigo de valida&ccedil;&atilde;o &eacute; invalido.</div>");
				}
				elseif(strtoupper(bin2hex($Find_Link[0])) == "F41E")
				{
					exit("<div class=\"error-box\"> Este codigo j&aacute; se encontra usado.</div>");
				}
				else
				{
					$this->Query("UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET memb___id='".$Find_Link[1]."',mail_chek=1 WHERE memb___id='".$Find_Link[2]."'");
					$this->Query("UPDATE ".MuGen_DB.".dbo.warehouse SET AccountID='".$Find_Link[1]."' WHERE AccountID='".$Find_Link[2]."'");
					if(VIP_Table != "MEMB_INFO")
					{
						$this->Query("UPDATE ".VIP_DB.".dbo.".VIP_Table." SET ".VIP_Login."='".$Find_Link[1]."' WHERE ".VIP_Login."='".$Find_Link[2]."'");
					}
					if(GL_Table != "MEMB_INFO")
					{
						$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".GL_Login."='".$Find_Link[1]."' WHERE ".GL_Login."='".$Find_Link[2]."'");
					}
					$this->Query("UPDATE dbo.{$CTM[18]} SET Status=0xF41E WHERE HashCode={$Encode}");
					exit("<div class=\"success-box\"> Cadastrado confirmado com Sucesso!<br /><br />Seja Bem Vindo ao ".Server_Name.". Baixe o Client em nossa &aacute;rea de Downloads e Divirta-se.<br />A Equipe ".Server_Name." agradece.</div>");
				}
			}
		}
	}
	private function VerifyDatas()
	{
		if($_GET["cmd"] == "verify")
		{
			header("Content-Type: text/javascript", true);
			if($_GET["id"] == "code")
			{
				$Code = $_GET["code"];
				$HashCode = "0x".bin2hex($Code);
				$Check = $this->NumQuery("SELECT * FROM dbo.".$GLOBALS["CTM"][18]." WHERE HashCode={$HashCode}");
				
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
			if($_GET["id"] == "login")
			{
				$lower = (boolean)constant("Register[ForceLower]");
				$Acc = $_GET["account"];
				$Check = $this->NumQuery("SELECT memb___id FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE memb___id=".($lower ? "LOWER" : NULL)."('{$Acc}')");
				
				if(empty($Acc))
				{
					exit("<script>VerifyDatas('Account', 'AccountResult', 'Campo em branco', '#efdc75', 'warning');</script>");
				}
				elseif(strlen($Acc) > 10)
				{
					exit("<script>VerifyDatas('Account', 'AccountResult', 'Maximo 10 Digitos', '#FF0000', 'error');</script>");
				}
				elseif(strlen($Acc) < 4)
				{
					exit("<script>VerifyDatas('Account', 'AccountResult', 'Minimo 4 Digitos', '#FF0000', 'error');</script>");
				}
				else
				{
					if($Check > 0)
					{
						exit("<script>VerifyDatas('Account', 'AccountResult', 'Login j&aacute; Existe', '#FF0000', 'error');</script>");
					}
					else
					{
						exit("<script>VerifyDatas('Account', 'AccountResult', 'Login v&aacute;lido', 'green', 'success');</script>");
					}
				}
			}
			if($_GET["id"] == "mail")
			{

				$Mail_Addr = $_GET["mail"];
				$Check = $this->NumQuery("SELECT mail_addr FROM ".MuAcc_DB.".dbo.MEMB_INFO WHERE mail_addr='{$Mail_Addr}'");
				
				if(empty($Mail_Addr))
				{
					exit("<script>VerifyDatas('Mail', 'MailResult', 'Campo em branco', '#efdc75', 'warning');</script>");
				}
				else
				{
					if(preg_match("/(.*?)@(.*?).(.).([com|net|org])/i", $Mail_Addr) == FALSE)
					{
						exit("<script>VerifyDatas('Mail', 'MailResult', 'E-Mail inv&aacute;lido', '#FF0000', 'error');</script>");
					}
					elseif($Check > 0)
					{
						exit("<script>VerifyDatas('Mail', 'MailResult', 'E-Mail j&aacute; Existe', '#FF0000', 'error');</script>");
					}
					else
					{
						exit("<script>VerifyDatas('Mail', 'MailResult', 'E-Mail v&aacute;lido', 'green', 'success');</script>");
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
			if($_GET["id"] == "re_mail")
			{
				$Mail_1 = $_GET["mail_1"];
				$Mail_2 = $_GET["mail_2"];
				
				if(empty($Mail_2))
				{
					exit("<script>VerifyDatas('Re_Mail', 'Re_MailResult', 'Campo em branco', '#efdc75', 'warning');</script>");
				}
				else
				{
					if($Mail_1 != $Mail_2)
					{
						exit("<script>VerifyDatas('Re_Mail', 'Re_MailResult', 'E-Mails n&atilde;o conferem', '#FF0000', 'error');</script>");
					}
					else
					{
						exit("<script>VerifyDatas('Re_Mail', 'Re_MailResult', 'E-Mail Confirmado', 'green', 'success');</script>");
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