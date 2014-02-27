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

if(!class_exists("CTM_Header")) :

class CTM_Header extends CTM_MSSQL
{
	public function Template_Selector()
	{
		global $_Templates;
		
		for($TPL = 0; $TPL < count($_Templates); $TPL++)
		{
			$TPL_Decode = isset($_COOKIE["Web_Template"]) == TRUE ? pack("H*", $_COOKIE["Web_Template"]) : NULL;
			$Selected = $TPL_Decode == $_Templates[$TPL][0] ? "selected=\"selected\"" : NULL;
			$Return .= "<option {$Selected} value=\"".bin2hex($_Templates[$TPL][0])."\">".$_Templates[$TPL][1]."</option>\n";
		}
		return $Return;
	}
	public function Menu_Extras()
	{
		global $_Menu;
		
		for($Menu = 0; $Menu < count($_Menu); $Menu++)
		{
			if($_Menu[$Menu][0] == 1)
			{
				 $Return .= "<li><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=".$_Menu[$Menu][2]."','conteudo','GET');\">".$_Menu[$Menu][1]."</a></li>";
			}
			elseif($_Menu[$Menu][0] == 2)
			{
				$Return .= "<li><a target=\"_black\" href=\"".$_Menu[$Menu][2]."\">".$_Menu[$Menu][1]."</a></li>";
			}
		}
		return $Return;
	}
	public function Menu_Shops()
	{
		global $_Shop;
		
		if(@Num_Shops > 1)
		{
			$Return .= "<a href=\"#\">Shop</a>
					<ul class=\"subnav\">";
			for($X = 0; $X < count($_Shop); $X++)
			{
				$Return .= "<li><a target=\"_black\" href=\"".$_Shop[$X][0]."\">".$_Shop[$X][1]."</a></li>";
			}
				$Return .= "</ul>
				</li>";
		}
		elseif(@Num_Shops == 1)
		{
			$Return = "<a target=\"_black\" href=\"".Shop_Link."\">Shop</a></li>";
		}
		return $Return;
	}
	public function Show_Poll()
	{
		global $CTM;
		
		if($_GET["cmd"] == "results")
		{
			$this->Poll_Result();
			exit(false);
		}
		if($_GET["cmd"] == "vote")
		{
			$this->Vote_Poll();
			exit(false);
		}
		if($_GET["cmd"] == "all_poll")
		{
			$this->All_Poll();
			exit(false);
		}
		$Get_Id = isset($_GET["show"]) == TRUE ? "WHERE Id='".$_GET["show"]."'" : NULL;
		
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[15]}");
		
		if($Check < 1)
		{
			exit("<div class=\"min-info\"> Nenhuma enquete cadastrada.</div>");
		}
		else
		{
			$Query = $this->Query("SELECT * FROM dbo.{$CTM[15]} {$Get_Id} ORDER BY Id DESC");
			$Load = $this->FetchArray($Query);
			
			$Return .= "<form name=\"Poll_Form\" id=\"Poll_Form\">
				<ul class=\"ul\">
        		<li><strong>&raquo; ".base64_decode($Load["Question"])."</strong></li>
				<li style=\"border-bottom: 1px solid #333333;\"></li>\n";
				
			$Query_Answers = $this->Query("SELECT * FROM dbo.{$CTM[16]} WHERE Poll_ID='".$Load["Id"]."'");
			
			while($Answers = $this->FetchArray($Query_Answers))
			{
				$Return .= "<li><input name=\"Answer\" type=\"radio\" id=\"Answer\" value=\"".$Answers["Id"]."\" class=\"radio\"> ".base64_decode($Answers["Answer"])."</li>\n";
			}
			
			$Return .= "<li><input type=\"button\" value=\"Votar\" onclick=\"CTM_Load('?ajax=poll&cmd=vote&id=".$Load["Id"]."', 'Result', 'POST', BuscaElementosForm('Poll_Form'));\" /> <input type=\"button\" value=\"Resultado\" onclick=\"CTM_Load('?ajax=poll&cmd=results&id=".$Load["Id"]."', 'Result', 'GET');\" /></li>
			<li><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?ajax=poll&cmd=all_poll', 'Web_Poll', 'GET');\">&raquo; Todas as Enquetes</a></li>
			</ul>
        </form>
		<div style=\"clear: both;\"></div>
         <div id=\"Result\"></div>";
		
			exit($Return);
			unset($Return);
			
		}
	}
	private function Poll_Result()
	{
		global $CTM;
		
		$Id = (int)$_GET["id"];
		$Query = $this->Query("SELECT Answer,Votes,Id FROM dbo.{$CTM[16]} WHERE Poll_ID={$Id}");
		$Question = $this->FetchQuery("SELECT Question,Status,Expiration FROM dbo.{$CTM[15]} WHERE Id={$Id}");
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[15]} WHERE Id={$Id}");
		
		if($Check < 1)
		{
			$Return = "<div class=\"min-error\"> Esta enquete n&atilde;o existe.</div>";
		}
		else
		{
			if(time() >= $Question[2])
			{
				$this->Query("UPDATE dbo.{$CTM[15]} SET Status=0x01E2 WHERE Id={$Id}");
			}
			
			switch(strtoupper(bin2hex($Question[1])))
			{
				case "FFFF" : $Status = "<span style=\"color: green\">Aberto</span>"; break;
				case "01E2" : $Status = "<span style=\"color: red\">Fechado</span>"; break;
			}
			
			$Total_Query = $this->Query("SELECT sum(Votes) as Result FROM dbo.{$CTM[16]} WHERE Poll_ID={$Id}");
			$Total[0] = $this->FetchArray($Total_Query);
			$Total[1] = number_format($Total[0]["Result"], 0, false, ".");
			
			$Return .= "<ul class=\"ul\">
			<li style=\"border-bottom: 1px solid #333333;\"></li>
	<li>Status: ".$Status."</li>
	<li>Total de votos: <strong>".$Total[1]."</strong></li>
	<li style=\"border-bottom: 1px solid #333333;\"></li>\n";
			while($Answers = $this->Fetch($Query))
			{
				$Votes = number_format($Answers[1], 0, false, ".");
				$Result = @ceil($Answers[1] * 100 / $Total[0]["Result"]);
				
				$Return .= "<li><strong>&raquo; ".base64_decode($Answers[0])."</strong> - Votos: <strong>{$Votes}</strong> (<strong>{$Result}%</strong>)<br /><div class=\"VotesCount\"><div class=\"PollCount\" style=\"width: {$Result}%\"></div></div></li>\n";
			}
			exit($Return);
			unset($Return);
		}
	}
	private function Vote_Poll()
	{
		global $CTM_General, $CTM;
		
		$Id = (int)$_GET["id"];
		$Account = $_SESSION["Hash_Account"];
		$Answer = $_POST["Answer"];
		$Check[0] = $this->NumQuery("SELECT * FROM dbo.{$CTM[15]} WHERE Id={$Id}");
		$Check[1] = $this->NumQuery("SELECT * FROM dbo.{$CTM[16]} WHERE Poll_ID={$Id}");
		
		if($Check[0] < 1)
		{
			$Return = "<div class=\"min-error\"> Esta enquete n&atilde;o existe.</div>";
		}
		else
		{
			$Status = $this->FetchQuery("SELECT Status,Expiration FROM dbo.{$CTM[15]} WHERE Id={$Id}");
			$Check_Vote = $this->NumQuery("SELECT * FROM dbo.{$CTM[17]} WHERE Poll_ID={$Id} and Account='".$Account."'");
			$Expiration = $this->FetchQuery("SELECT Expiration FROM dbo.{$CTM[17]} WHERE Poll_ID={$Id} and Account='{$Account}'");
			
			if(empty($Answer) || empty($Id))
			{
				$Return = "<div class=\"min-warning\"> Selecione uma op&ccedil;&atilde;o.</div>";
			}
			elseif($CTM_General->Check_Logged(2) == TRUE)
			{
				$Return = "<div class=\"min-error\"> Para votar &eacute; preciso estar logado.</div>";
			}
			elseif(strtoupper(bin2hex($Status[0])) == "01E2" || time() >= $Status[1])
			{
				$this->Query("UPDATE dbo.{$CTM[15]} SET Status=0x01E2 WHERE Id={$Id}");
				$Return = "<div class=\"min-error\"> Esta enquete esta fechada</div>";
			}
			elseif($Check[1] < 1)
			{
				$Return = "<div class=\"min-error\"> Esta pergunta n&atilde;o existe.</div>";
			}
			elseif(time() >= $Expiration[0])
			{
				$Time = time()+86400;
				$this->Query("DELETE dbo.{$CTM[17]} WHERE Poll_ID={$Id} and Account='{$Account}'");
				$this->Query("UPDATE dbo.{$CTM[16]} SET Votes=Votes+1 WHERE Poll_ID={$Id} and Id={$Answer}");
				$this->Query("INSERT INTO dbo.{$CTM[17]} (Account,Poll_ID,Expiration) VALUES ('{$Account}',{$Id},{$Time})");
				
				$Ajax = "<script>CTM_Load('?ajax=poll&cmd=results&id={$Id}', 'Vote_Computed', 'GET');</script>";
				$Return .= "<div class=\"min-success\"> Voto computado.</div>";
				$Return .= "<span id=\"Vote_Computed\">{$Ajax}</span>";
			}
			elseif($Check_Vote > 0)
			{
				$Return = "<div class=\"min-info\"> Voc&ecirc; j&aacute; votou nessa enquete.</div>";
			}
			else
			{
				$Time = time()+86400;
				$this->Query("DELETE dbo.{$CTM[17]} WHERE Poll_ID={$Id} and Account='{$Account}'");
				$this->Query("UPDATE dbo.{$CTM[16]} SET Votes=Votes+1 WHERE Poll_ID={$Id} and Id={$Answer}");
				$this->Query("INSERT INTO dbo.{$CTM[17]} (Account,Poll_ID,Expiration) VALUES ('{$Account}',{$Id},{$Time})");
				
				$Ajax = "<script>CTM_Load('?ajax=poll&cmd=results&id={$Id}', 'Vote_Computed', 'GET');</script>";
				$Return .= "<div class=\"min-success\"> Voto computado.</div>";
				$Return .= "<span id=\"Vote_Computed\">{$Ajax}</span>";
			}
			
			exit($Return);
			unset($Return);
		}
	}
	private function All_Poll()
	{
		global $CTM;
		
		$Query = $this->Query("SELECT Question,Id FROM dbo.{$CTM[15]} ORDER BY Id DESC");
		
		$Return .= "<ul class=\"ul\">\n";
		while($Find_Poll = $this->Fetch($Query))
		{
			$Return .= "<li><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?ajax=poll&show=".$Find_Poll[1]."','Web_Poll','GET');\">&raquo; ".base64_decode($Find_Poll[0])."</a></li>\n";
		}
		$Return .= "</ul>";
		
		exit($Return);
		unset($Return);
	}
}
endif;
?>