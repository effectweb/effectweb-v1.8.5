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

if(!class_exists("CTM_Mailer")) :

class CTM_Mailer
{
	public $SMTP_Server = "localhost";
	public $SMTP_Port = 25;
	public $SMTP_User = NULL;
	public $SMTP_Pass = NULL;
	public $SMTP_Debug = TRUE;
	public $Mail_From = NULL;
	public $Mail_Sender = NULL;
	public $Mail_To = NULL;
	public $Mail_Recipient = NULL;
	public $Mail_Subject = NULL;
	public $Mail_Message = NULL;
	private $SMTP_TimeOut = 30;
	private $SMTP_Socket = NULL;
	private $SMTP_Authentication = TRUE;
	private $Error = array();
	private $Return = array();
	
	public function __construct()
	{
		
	}
	private function Check_Strings()
	{
		if(empty($this->SMTP_User) || empty($this->SMTP_Pass) || $this->SMTP_Server == "localhost")
		{
			$this->SMTP_Authentication = FALSE;
		}
		if(empty($this->SMTP_Server))
		{
			$this->Error[] = TRUE;
			$this->Return[] = TRUE;
		}
		if(empty($this->Mail_From))
		{
			$this->Error[] = TRUE;
			$this->Return[] = TRUE;
		}
		if(empty($this->Mail_To))
		{
			$this->Error[] = TRUE;
			$this->Return[] = TRUE;
		}
		if(empty($this->Mail_Subject))
		{
			$this->Error[] = TRUE;
			$this->Return[] = TRUE;
		}
		if(empty($this->Mail_Message))
		{
			$this->Error[] = TRUE;
			$this->Return[] = TRUE;
		}
		
		if(count($this->Return) > 0)
		{
			$this->Return = array();
			return FALSE;
		}
		else
		{
			$this->Return = array();
			return TRUE;
		}
	}
	private function Send_Pack($Pack_Data)
	{
		if(!fputs($this->SMTP_Socket, $Pack_Data."\r\n"))
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	private function Helo_Server()
	{
		$this->Send_Pack("EHLO ".$this->SMTP_Server);
			
		return TRUE;
	}
	private function SMTP_Authentication()
	{
		$this->Send_Pack("AUTH LOGIN");
			
		$this->Send_Pack(base64_encode($this->SMTP_User));
			
		$this->Send_Pack(base64_encode($this->SMTP_Pass));
	}
	private function Start_Socket()
	{
		$this->SMTP_Socket = @fsockopen($this->SMTP_Server, $this->SMTP_Port, $errno, $errstr, $this->SMTP_TimeOut);
		
		if($this->SMTP_Socket == FALSE)
		{
			$this->Error[] = TRUE;
		}
			
		$this->Helo_Server();
	}
	private function Finish_Socket()
	{
		$this->Send_Pack("QUIT");
		$this->SMTP_Debug();
		fclose($this->SMTP_Socket);
	}
	public function Send_Mail()
	{
		if($this->Check_Strings() == FALSE)
		{
			$this->Return[] = TRUE;
			$this->Error[] = TRUE;
		}
		
		if(count($this->Return) > 0)
		{
			$this->Return = array();
		}
		else
		{
			$this->Return = array();
			$this->Start_Socket();
			if($this->SMTP_Authentication == TRUE)
			{
				$this->SMTP_Authentication();
			}
		
			$this->Send_Pack("MAIL FROM: ".$this->Mail_From);
		
			$_Mail = explode(";", $this->Mail_To);
			for($WzAG = 0; $WzAG < count($_Mail); $WzAG++)
			{
				$this->Send_Pack("RCPT TO: ".$_Mail[$WzAG]);
			}
		
			$this->Send_Pack("DATA");
		
			$this->Send_Pack($this->Mail_Header());
			$this->Send_Pack($this->Mail_Template());
			$this->Send_Pack(".");
			
			$this->Finish_Socket();
		
		}
		if(count($this->Error) > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	private function From_Mail()
	{
		if(strlen($this->Mail_Sender) == 0)
		{
			$Return = "From: ".$this->Mail_From;
		}
		else
		{
			$Return = "From: {$this->Mail_Sender} <{$this->Mail_From}>";
		}
		return $Return;
	}
	private function To_Mail()
	{
		$Mail_To = "To: ";
		$_Mail = explode(";", $this->Mail_To);

		for($WzAG = 0; $WzAG < count($_Mail); $WzAG++)
		{
			if(empty($_Mail[$WzAG]))
			{
				continue;
			}
			$Mail_To .= $_Mail[$WzAG].", ";
		}
		return substr($Mail_To, 0, strrpos($Mail_To, ","));
	}
	private function Mail_Header()
	{
		$Header = "Message-Id: <".date("YmdHis").".".md5(microtime()).".".strtoupper($this->Mail_From)."> \r\n";
		$Header .= $this->From_Mail()." \r\n";
		$Header .= $this->To_Mail()." \r\n";
		$Header .= "Subject: ".$this->Mail_Subject." \r\n";
		$Header .= "Date: ".date("D, d M Y H:i:s O")." \r\n";
		$Header .= "MIME-Version: 1.0 \r\n";
		$Header .= "Content-Type: text/html; charset=ISO-8859-1";
		$Header .= "X-MSMail-Priority: High";
		
		return $Header;
		unset($Header);
	}
	private function SMTP_Debug()
	{
		while(TRUE && !feof($this->SMTP_Socket))
		{
			$SMTP_Log .= fgets($this->SMTP_Socket)."<br>\n";
		}
		if($this->SMTP_Debug == TRUE)
		{
			@mkdir("modules/Logs");
			if(!file_exists("modules/Logs/CTM_Mailer.htm"))
			{
				$Creat = @fopen("modules/Logs/CTM_Mailer.htm", "a+");
				@fwrite($Creat, "*******************************************<br />\n -> Effect Web ".base64_decode(Web_Version)."<br />\n -> 	Mailer Debug System<br />\n -> Powered By: Erick-Master<br />\n -> CTM TeaM Softwares<br />\n -> www.ctmts.com.br<br />\n*******************************************<br />\n\n");
				@fclose($Creat);
			}
			$Date = date("d/m/Y");
			$Time = date("H:i:s");
			$Requested = $_SERVER["REQUEST_URI"];
			$Addr = $_SERVER["REMOTE_ADDR"];
			$HostAddr = gethostbyaddr($Addr);
			$Log = str_replace(base64_encode($this->SMTP_Pass), str_repeat("*", strlen($this->SMTP_Pass)), $SMTP_Log);
			$Log = str_replace(base64_encode($this->SMTP_User), str_repeat("*", strlen($this->SMTP_User)), $Log);
		
			$Mailer_Log = "&bull; User IP: <b>".$Addr."</b><br />\n";
			$Mailer_Log .= "&bull; Reverse IP: <b>".$HostAddr."</b><br />\n";
			$Mailer_Log .= "&bull; Date: <b>".$Date."</b><br />\n";
			$Mailer_Log .= "&bull; Time: <b>".$Time."</b><br />\n";
			$Mailer_Log .= "&bull; Page: <b>".$Requested."</b><br />\n";
			$Mailer_Log .= "&bull; Send Mail: <b>".$this->Mail_To."</b><br />\n";
			$Mailer_Log .= "&bull; Subject: <b>".$this->Mail_Subject."</b><br />\n";
			$Mailer_Log .= "&bull; SMTP Log: <br />".$Log."<br />\n";
			$Mailer_Log .="==============================================================================================================<br />\n";
			$FileLog = @fopen("modules/Logs/CTM_Mailer.htm", "a");
			@fwrite($FileLog, $Mailer_Log);
			@fclose($FileLog);
		
		}
	}
	private function Mail_Template()
	{
		return "<html>
		<head>
        <meta name=\"Description\" content=\"Effect Web - Powered By: CTM TeaM Softwares\" />
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
		<meta name=\"author\" content=\"Erick-Master\" />
		</head>
	
		<body>
			<div align=\"center\">
				<div style=\"background: #fff; border: 7px solid #6c6c6c; padding: 1px; width: 500px;\">
				<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500px\">
					<tr>
						<td colspan=\"2\">&nbsp;</td>
					</tr>
					<tr>
						<td colspan=\"2\" style=\"padding: 10px; font-family: Tahoma; font-size: 10px;\" align=\"left\">
        				".$this->Mail_Message."
						<div align=\"center\"><strong>Qualquer duvida contatar o Suporte.</strong></div>
                        </td>
					</tr>
					<tr>
						<td colspan=\"2\"><div style=\"padding: 1px; background-color: #eaeaea;\"></div></td>
					</tr>
					<tr>
					<td align=\"left\" style=\"padding: 5px; font-family: Tahoma; font-size: 10px;\">Copyright &copy; ".date("Y")." ".constant("Server_Name")."</td>
					<td align=\"right\" style=\"padding: 5px; font-family: Tahoma; font-size: 10px;\">Powered By: Erick-Master</td>
					</tr>
				</table>
				</div>
			</div>
		</body>
</html>";
	}
}
endif;
?>