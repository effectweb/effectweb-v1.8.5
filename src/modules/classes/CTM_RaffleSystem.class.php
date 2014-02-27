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

if(!class_exists("CTM_RaffleSystem")) :

class CTM_RaffleSystem extends CTM_MSSQL
{
	public function __construct($Function)
	{
		if($Function == 1)
		{
			$this->Raffle_Player();
		}
		if($Function == 2)
		{
			$this->Raffle_List();
		}
		if($Function == 3)
		{
			$this->Clear_Raffles();
		}
	}
	private function System_Enable()
	{
		global $_RaffleSystem;
		
		if($_RaffleSystem["Enable"] == FALSE)
		{
			exit("<div class=\"info-box\"> Sistema de sorteio desativado no momento.</div>");
		}
	}
	public function Raffle_Panel($String)
	{
		global $_RaffleSystem;
		$this->System_Enable();
		
		return in_array($_SESSION["Hash_Account"], $_RaffleSystem[$String]);
	}
	private function Security($String)
	{
		global $_RaffleSystem;
		
		if(in_array($_SESSION["Hash_Account"], $_RaffleSystem[$String]) == FALSE)
		{
			exit("<div class=\"error-box\"> Voc&ecirc; n&atilde;o contem permis&atilde;o para usar est&aacute; op&ccedil;&atilde;o.</div>");
		}
	}
	private function Raffle_Player()
	{
		global $CTM, $_RaffleSystem;
		$this->Security("Raffle");
		
		if($_GET["cmd"] == true)
		{
			$Moeda = $_POST['Moeda'];
			$Golds = $_POST["Golds"];
			$Date = date("d/m/Y");
			$Time = date("H:i:s");
			$Selected = $this->FetchQuery("SELECT memb___id FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE ConnectStat>0 ORDER BY newid();");
			$GameIDC = $this->FetchQuery("SELECT GameIDC FROM ".MuGen_DB.".dbo.AccountCharacter WHERE Id='".$Selected[0]."'");
			if(empty($Moeda) || $Moeda < 1 || $Moeda > 3)
			{
				exit("<div class=\"warning-box\"> Selecione uma moeda v&aacute;lida.</div>");
			}
			elseif($Golds == NULL)
			{
				exit("<div class=\"warning-box\"> Digite o Numero de ".constant("Coin_".$Moeda)." a ser Premiado</div>");
			}
			else
			{
				$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".constant("GL_Column_".$Moeda)."=".constant("GL_Column_".$Moeda)."+".$Golds." WHERE ".GL_Login."='{$Selected[0]}'");
				$this->Query("INSERT INTO dbo.{$CTM[12]} (MuCharacter,Coin,Award,Raffle_Date,Raffle_Time) VALUES ('{$GameIDC[0]}',{$Moeda},{$Golds},'{$Date}','{$Time}')");
				exit("<div class=\"success-box\">O Char <strong>'".$GameIDC[0]."</strong>' foi Premiado com ".$Golds." ".constant("Coin_".$Moeda)."</div>");
			}
		}
	}
	private function Raffle_List()
	{
		global $CTM_Template, $CTM, $_RaffleSystem;
		
		if($_RaffleSystem["Enable"] == TRUE)
		{
			if($_RaffleSystem["List"]["Enable"] == TRUE)
			{
				$Query = $this->Query("SELECT * FROM  ".MSSQL_DB.".dbo.{$CTM[12]} ORDER BY Id");
				$Check = $this->NumRow($Query);
		
				if($Check < 1)
				{
					$Return = "<div class=\"info-box\"> N&atilde;o h&aacute; Sorteios efetuandos no Momento</div>";
				}
				else
				{
					$Return .= "
						<table width=\"436\" border=\"0\">
  							<tr>";
    							if($_RaffleSystem["List"]["Id"] == true)
								{
									$Return .= "<td><strong>ID:</strong></td>";
								}
								$Return .= "<td><strong>Personagem:</strong></td>";
								if($_RaffleSystem["List"]["Coin"] == true)
								{
									$Return .= "<td><strong>Moeda</strong></td>";
								}
								if($_RaffleSystem["List"]["Gold"] == true)
								{
									$Return .= "<td><strong>Quantidade</strong></td>";
								}
								if($_RaffleSystem["List"]["Date"] == true)
								{
									$Return .= "<td><strong>Data:</strong></td>";
								}
								if($_RaffleSystem["List"]["Time"] == true)
								{
									$Return .= "<td><strong>Hora:</strong></td>";
								}
							$Return .= "</tr>";
  
					while($Load = $this->FetchArray($Query))
					{
						$Return .= "
					  		<tr>";
  								if($_RaffleSystem["List"]["Id"] == TRUE)
								{
									$Return .= "<td>".$Load["Id"]."</td>";
								}
								$Return .= "<td><a href=\"javascript: void(EffectWeb)\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Load["MuCharacter"])."','conteudo','GET');\">".$Load["MuCharacter"]."</a></td>";
								if($_RaffleSystem["List"]["Coin"] == TRUE)
								{
									$Return .= "<td>".constant("Coin_".$Load["Coin"])."</td>";
								}
								if($_RaffleSystem["List"]["Gold"] == TRUE)
								{
									$Return .= "<td>".$Load["Award"]."</td>";
								}
								if($_RaffleSystem["List"]["Date"] == TRUE)
								{
									$Return .= "<td>".$Load["Raffle_Date"]."</td>";
								}
								if($_RaffleSystem["List"]["Time"] == TRUE)
								{
									$Return .= "<td>".$Load["Raffle_Time"]."</td>";
								}
							$Return .= "</tr>";
					}
					$Return .= "</table>";
				}
				$CTM_Template->Set("Raffle_List", $Return);
				unset($Return);
			}
			else
			{
				$CTM_Template->Set("Raffle_List", "<div class=\"info-box\"> A lista de sorteados se encontra desativada.</div>");
			}
		}
		else
		{
			$CTM_Template->Set("Raffle_List", "<div class=\"info-box\"> Sistema de sorteio desativado no momento.</div>");
		}
	}
	private function Clear_Raffles()
	{
		global $_RaffleSystem, $CTM;
		$this->Security("Clear");
		
		if($_GET["cmd"] == TRUE)
		{
			$this->Query("DELETE dbo.{$CTM[12]}");	
			exit("<div class=\"success-box\"> Lista de sorteados limpas com sucesso!</div>");
		}
	}
}
endif;
?>