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

if(!class_exists("CTM_CronJob")) :

class CTM_CronJob
{
	private $Request;
	private $CronTab;
	
	public function __construct()
	{
		if(constant("CronJob_Enable") == TRUE)
		{
			$this->ExecCronJob();
			$this->CronJob_AutoActive();
		}
	}
	private function File_Log()
	{
		@mkdir("modules/Logs");
		if(!file_exists("modules/Logs/CTM_CronJobDebug.htm"))
		{
			$Creat = @fopen(constant("Directory")."modules/Logs/CTM_CronJobDebug.htm", "a+");
			@fwrite($Creat, "*******************************************<br />\n * Effect Web ".base64_decode(Web_Version)."<br />\n * CronJob Debug System<br />\n * Powered by Erick-Master<br />\n * CTM Team Softwares<br />\n * www.ctmts.com.br<br />\n*******************************************<br />\n\n");
			@fclose($Creat);
		}
	}
	private function Start_Debug($CronTab)
	{
		switch($CronTab)
		{
			case 1 : $CronTab = "Sincronizar VIP"; break;
			case 2 : $CronTab = "Sincronizar Chars Banidos"; break;
			case 3 : $CronTab = "Sincronizar Contas Banidas"; break;
			case 4 : $CronTab = "Sortear Player"; break;
			case 5 : $CronTab = "Reativar CronTabs"; break;
		}
		$this->File_Log();
		$File = @fopen("modules/Logs/CTM_CronJobDebug.htm", "a+");
		@fwrite($File, "&raquo; Iniciando Tarefa<br />\n&raquo; CronTab: <b>".$CronTab."</b><br />\n&raquo; Data: <b>".date("d/m/Y")."</b><br />\n&raquo; Hora: <b>".date("H:i:s")."</b><br />\n");
		@fclose($File);
	}
	private function End_Debug()
	{
		$File = @fopen("modules/Logs/CTM_CronJobDebug.htm", "a+");
		@fwrite($File, "&raquo; Tarefa Finalizada<br />\n==============================================================================================================<br />\n");
		@fclose($File);
	}
	private function Debug($Write)
	{
		$File = @fopen("modules/Logs/CTM_CronJobDebug.htm", "a+");
		@fwrite($File, $Write);
		@fclose($File);
	}
	private function ExecQuery($Command)
	{
		$Query = @mssql_query($Command);
		if($Query == FALSE)
		{
			$Return = "&raquo; Falha no Comando <span style=\"color: red;\">&#8226;</span><br />\nFALSE";
		}
		else
		{
			$Return = $Query;
		}
		return $Return;
	}
	private function ExecFetch($Command)
	{
		$Query = @mssql_fetch_row(@mssql_query($Command));
		if($Query == FALSE)
		{
			$Return = "&raquo; Falha no Comando <span style=\"color: red;\">&#8226;</span><br />\nFALSE";
		}
		else
		{
			$Return = $Query;
		}
		return $Return;
	}
	private function ExecCommand($Command, $Exec, $Send)
	{
		if(constant("CronJob_Debug") == TRUE)
		{
			$this->Debug("&raquo; {$Command}<br />\n");
		}
		if($Exec == "Query")
		{
			$_Exec = $this->ExecQuery($Send);
			if(ereg("FALSE", $_Exec) == TRUE)
			{
				$Str = str_replace("FALSE", "", $_Exec);
				if(constant("CronJob_Debug") == TRUE)
				{
					$this->Debug($Str);
				}
				return false;
			}
			else
			{
				if(constant("CronJob_Debug") == TRUE)
				{
					$this->Debug("&raquo; Comando Efetuado com Sucesso <span style=\"color: green;\">&#8226;</span><br />\n");
				}
				return $_Exec;
			}
		}
		if($Exec == "Fetch")
		{
			$_Exec = $this->ExecFetch($Send);
			if(ereg("FALSE", $_Exec) == TRUE)
			{
				$Str = str_replace("FALSE", "", $_Exec);
				if(constant("CronJob_Debug") == TRUE)
				{
					$this->Debug($Str);
				}
				return false;
			}
			else
			{
				if(constant("CronJob_Debug") == TRUE)
				{
					$this->Debug("&raquo; Comando Efetuado com Sucesso <span style=\"color: green;\">&#8226;</span><br />\n");
				}
				return $_Exec;
			}
		}
	}
	private function ExecCronJob()
	{
		global $CTM;
		$this->Request = @mssql_query("SELECT * FROM ".MSSQL_DB.".dbo.{$CTM[13]}");
		while($this->CronTab = @mssql_fetch_array($this->Request))
		{
			if(/*$this->CronTab["Cron_Date"] >= time() && */$this->CronTab["Cron_Next"] <= time())
			{
				$this->Start_Debug($this->CronTab["CronTab"]);
				/*if($this->CronTab["Cron_Enabled"] == 0)
				{
					$this->Debug("&raquo; Tarefa desabilitada <span style=\"color: red;\">&#8226;</span><br />\n");
					$this->End_Debug();
				}
				else
				{*/
					@ignore_user_abort(true);
					@flush();
					@ob_flush();
					@set_time_limit(0);
				
					switch($this->CronTab["CronTab"])
					{
						case 1 : $this->CronJob_SynchronizeVIP(); break;
						case 2 : $this->CronJob_SynchronizeChars(); break;
						case 3 : $this->CronJob_SynchronizeAccs(); break;
						case 4 : $this->CronJob_RafflePlayer($this->CronTab["Number"], $this->CronTab["Coin"]); break;
					}
					
					$cron_time = explode(":", $this->CronTab['Cron_Time']);
					$next = strtotime("+ ".$cron_time[0]." hours".($cron_time[1] > 0 ? " ".$cron_time[1]." minutes" : NULL));
					
					$this->End_Debug();
					//@mssql_query("UPDATE ".MSSQL_DB.".dbo.{$CTM[13]} SET Cron_Runing=1 WHERE Id=".$this->CronTab["Id"]."");
					@mssql_query("UPDATE ".MSSQL_DB.".dbo.{$CTM[13]} SET Cron_Next={$next} WHERE Id=".$this->CronTab["Id"]."");
				//}
			}
		}
	}
	private function CronJob_SynchronizeVIP()
	{
		global $CTM_General;
		
		$Query = $this->ExecCommand("Listar contas VIP", "Query", "SELECT ".VIP_Time.",".VIP_Credits.",".VIP_Login.",".VIP_Column." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Column." > 0");
		while($Synchronizing = @mssql_fetch_row($Query))
		{
			if(time() >= $Synchronizing[0] || $Synchronizing[1] < 1)
			{
				$this->ExecCommand("Retirar VIPs", "Query", "UPDATE ".VIP_DB.".dbo.".VIP_Table." SET ".VIP_Column."=0,".VIP_Begin."=0,".VIP_Time."=0,".VIP_Credits."=0 WHERE ".VIP_Login."='".$Synchronizing[2]."'");
				$Operation .= "&bull; <strong>".$Synchronizing[2]."</strong> - <strong>".$CTM_General->Memb_Type($Synchronizing[3])."</strong> vencido <strong>[".date("d/m/Y", $Synchronizing[0])." as ".date("H:i", $Synchronizing[0])."]</strong><br />\n";
			}
		}
		$Count = count($Operation);
		$Count = $Count < 1 ? "&bull; Nenhum VIP Vencido<br />\n" : $Operation;
		
		if(constant("CronJob_Debug") == TRUE)
		{
			$this->Debug($Count);
		}
	}
	private function CronJob_SynchronizeChars()
	{
		global $CTM;
		
		$Query = $this->ExecCommand("Listar Chars Banidos", "Query", "SELECT Time,Character FROM dbo.{$CTM[8]}");
		while($Synchronizing = @mssql_fetch_row($Query))
		{
			if(time() >= $Synchronizing[0])
			{
				$this->ExecCommand("Desbanir Chars", "Query", "UPDATE ".MuGen_DB.".dbo.Character SET CtlCode=0 WHERE Name='{$Synchronizing[1]}'");
				$this->ExecCommand("Remover Informa&ccedil;&otilde;es", "Query", "DELETE dbo.{$CTM[8]} WHERE Character='{$Synchronizing[1]}'");
				$Operation .= "&bull; Char <strong>".$Synchronizing[1]."</strong> desbanido <strong>[".date("d/m/Y", $Synchronizing[0])." as ".date("H:i", $Synchronizing[0])."]</strong><br />\n";
			}
		}
		$Count = count($Operation);
		$Count = $Count < 1 ? "&bull; Nenhum personagem desbanido<br />\n" : $Operation;
		
		if(constant("CronJob_Debug") == TRUE)
		{
			$this->Debug($Count);
		}
	}
	private function CronJob_SynchronizeAccs()
	{
		global $CTM;
		
		$Query = $this->ExecCommand("Listar Contas Banidas", "Query", "SELECT Time,Account FROM dbo.{$CTM[7]}");
		while($Synchronizing = @mssql_fetch_row($Query))
		{
			if(time() >= $Synchronizing[0])
			{
				$this->ExecCommand("Desbanir Contas", "Query", "UPDATE ".MuAcc_DB.".dbo.MEMB_INFO SET bloc_code=0 WHERE memb___id='{$Synchronizing[1]}'");
				$this->ExecCommand("Remover Informa&ccedil;&otilde;es", "Query", "DELETE dbo.{$CTM[7]} WHERE Account='{$Synchronizing[1]}'");
				$Operation .= "&raquo; Conta <strong>".$Synchronizing[1]."</strong> desbanida <strong>[".date("d/m/Y", $Synchronizing[0])." as ".date("H:i", $Synchronizing[0])."]</strong><br />\n";
			}
		}
		$Count = count($Operation);
		$Count = $Count < 1 ? "&bull; Nenhuma conta desbanida<br />\n" : $Operation;
		
		if(constant("CronJob_Debug") == TRUE)
		{
			$this->Debug($Count);
		}
	}
	private function CronJob_RafflePlayer($Cash, $Coin)
	{
		global $CTM, $_RaffleSystem;
		
		$Date = date("d/m/Y");
		$Time = date("H:i:s");
		$Raffled = $this->ExecCommand("Sorteando Jogador", "Fetch", "SELECT memb___id FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE ConnectStat > 0 ORDER BY newid()");
		$GameIDC =  @mssql_fetch_row(@mssql_query("SELECT GameIDC FROM ".MuGen_DB.".dbo.AccountCharacter WHERE Id='{$Raffled[0]}'"));
		if(constant("CronJob_Debug") == TRUE)
		{
			$this->Debug("&raquo; Jogador Sorteado: <b>{$GameIDC[0]}</b><br />\n");
		}
		$this->ExecCommand("Creditando ".constant("Coin_".$Coin), "Query", "UPDATE ".GL_DB.".dbo.".GL_Table." SET ".constant("GL_Column_".$Coin)."=".constant("GL_Column_".$Coin)."+{$Cash} WHERE ".GL_Login."='{$Raffled[0]}'");
		$this->ExecCommand("Atualizando lista de Sortados", "Query", "INSERT INTO dbo.{$CTM[12]} (MuCharacter,Coin,Award,Raffle_Date,Raffle_Time) VALUES ('{$GameIDC[0]}',{$Coin},{$Cash},'{$Date}','{$Time}')");
	}
	private function CronJob_AutoActive()
	{
		global $CTM;
		
		if(constant("CronJob_Clear") == TRUE)
		{
			if(constant("CronJob_Time").":".constant("CronJob_Minute") == date("H:i"))
			{
				$this->Start_Debug(5);
				$this->ExecCommand("Reativando CronTabs", "Query", "UPDATE ".MSSQL_DB.".dbo.{$CTM[13]} SET Cron_Runing=0");
				$this->End_Debug();
			}
		}
	}
}
endif;
?>