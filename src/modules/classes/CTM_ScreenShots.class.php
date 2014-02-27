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

if(!class_exists("CTM_ScreenShots")) :

class CTM_ScreenShots extends CTM_MSSQL
{
	public $Variable_1 = NULL;
	public $Variable_2 = NULL;
	public $Variable_3 = NULL;
	public $Variable_4 = NULL;
	private $Login = NULL;
	
	public function __construct($String = FALSE)
	{
		global $CTM_Template;
		
		$this->Login = $_SESSION["Hash_Account"];
		
		if($String == TRUE)
		{
			if(isset($_GET["view"]) == TRUE)
			{
				$this->View_ScreenShot();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/screenshots[VIEW].pag.php");
			}
			else
			{
				$this->Total_ScreenShots();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/screenshots.pag.php");
			}
		}
	}
	public function Upload_ScreenShot()
	{
		global $CTM_Crypt, $CTM;
		
		$Character = $this->Variable_2;
		$Description = $this->Variable_3 == NULL ? "NULL" : base64_encode($this->Variable_3);
			
		$CTM_FileUpload = new CTM_FileUpload();
		$CTM_FileUpload->Upload = "ScreenShot";
		$CTM_FileUpload->File_Type = 1;
		$CTM_FileUpload->Size = 2000000;
		$CTM_FileUpload->Directory = constant("Upload_SS");
		$CTM_FileUpload->Name = $CTM_Crypt->CharImg($Character.time());
	
		$CTM_FileUpload->Command();
		
		if($CTM_FileUpload->Error == FALSE)
		{
			preg_match("/\.(gif|png|jpg|jpeg){1}$/i", $CTM_FileUpload->File["name"], $Extension);
			$this->Query("INSERT INTO dbo.{$CTM[20]} (Account,User_Char,Votes,Description,Up_Date,ScreenShot) VALUES ('".$this->Variable_1."','".$Character."',0,'".$Description."',".time().",'".$CTM_FileUpload->Name.".".$Extension[1]."')");
			$this->Variable_4 = $CTM_FileUpload->Name.".".$Extension[1];
				
		}
		return $CTM_FileUpload->Return_Cmd;
	}
	public function Delete_ScreenShot()
	{
		global $CTM;
		
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[20]} WHERE Id='{$this->Variable_1}'");
		
		if($Check < 1)
		{
			exit("<div class=\"error-box\"> Esta ScreenShot n&atilde;o existe.</div>");
		}
		else
		{
			$this->Query("DELETE dbo.{$CTM[20]} WHERE Id='{$this->Variable_1}'");
			$this->Query("DELETE dbo.{$CTM[21]} WHERE ScreenID='{$this->Variable_1}'");
			$this->Query("DELETE dbo.{$CTM[22]} WHERE ScreenID='{$this->Variable_1}'");
			@unlink(constant("Upload_SS").$this->Variable_2);
		}
	}
	public function Recents_ScreenShots()
	{
		global $CTM;
		
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[20]}");
		
		if($Check < 1)
		{
			$Return = "<div class=\"info-box\"> N&atilde;o h&aacute; ScreenShots adicionadas no momento.</div>";
		}
		else
		{
			$Query = $this->Query("SELECT TOP 5 * FROM dbo.{$CTM[20]} ORDER BY Votes DESC, Id DESC");
			
			while($ScreenShot = $this->FetchArray($Query))
			{
				$Text = $ScreenShot["Votes"] > 0 ? "Votos" : "Voto";
				
				if($WzAG == 0)
				{
					$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
							<tr>\n";
				}
				
				$Return .= "<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
							<tr>
								<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=screenshots&view=".$ScreenShot["Id"]."', 'conteudo', 'GET');\" style=\"color: #666666;\">Autor: ".$ScreenShot["User_Char"]." <img src=\"".constant("Upload_SS").$ScreenShot["ScreenShot"]."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$ScreenShot["Votes"]." ".$Text.")</a></td>
							</tr>
				</table></td>";
				$WzAG++;
				if($WzAG > 4)
				{
					$Return .= "
								</tr>
						</table>
						<br /><div align=\"right\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=screenshots','conteudo','GET');\">[ Todas as ScreenShots ]</a></div>";
					$WzAG = 0;
				}
			}
			$Return .= "</tr>
						</table>";
		}
		return $Return;
		unset($Return);
	}
	public function Total_ScreenShots()
	{
		global $CTM_Template, $CTM;
	
		$Check = $this->NumQuery("SELECT * FROM dbo.{$CTM[20]}");
		
		if($Check < 1)
		{
			$Return = "<div class=\"info-box\"> N&atilde;o h&aacute; ScreenShots adicionadas no momento.</div>";
		}
		else
		{
			$Query = $this->Query("SELECT * FROM dbo.{$CTM[20]} ORDER BY Votes DESC, Id DESC");
			
			while($ScreenShot = $this->FetchArray($Query))
			{
				$Text = $ScreenShot["Votes"] > 0 ? "Votos" : "Voto";
				
				if($WzAG == 0)
				{
					$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
							<tr>\n";
				}
				
				$Return .= "<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
							<tr>
								<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=screenshots&view=".$ScreenShot["Id"]."', 'conteudo', 'GET');\" style=\"color: #666666;\">Autor: ".$ScreenShot["User_Char"]." <img src=\"".constant("Upload_SS").$ScreenShot["ScreenShot"]."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$ScreenShot["Votes"]." ".$Text.")</a></td>
							</tr>
							<tr>	
							</tr>
				</table></td>";
				$WzAG++;
				if($WzAG > 4)
				{
					$Return .= "
								</tr>
						</table>";
					$WzAG = 0;
				}
			}
		}
		$CTM_Template->Set("%SHOW_SCREENSHOTS%", $Return);
		unset($Return);
	}
	public function View_ScreenShot()
	{
		global $CTM_General, $CTM_Template, $CTM;
		$CTM_BBCode = new CTM_BBCode();
		
		$Id = $_GET["view"];
		
		$Query = $this->Query("SELECT * FROM dbo.{$CTM[20]} WHERE Id='{$Id}'");
		$Check = $this->NumRow($Query);
		
		if($Check < 1)
		{
			exit("<div class=\"error-box\"> Esta ScreenShot n&atilde;o existe.</div>");
		}
		else
		{
			if($_GET["cmd"] == "vote")
			{
				if($CTM_General->Check_Logged(2) == TRUE)
				{
					exit("<div class=\"error-box\"> Para votar &eacute; preciso estar Logado.<div>");
				}
				else
				{
					$Votes = $_POST["Votes"];
					$Find_Votes = $this->FetchQuery("SELECT Votes FROM dbo.{$CTM[20]} WHERE Id='{$Id}'");
					$Check_Vote = $this->NumQuery("SELECT * FROM dbo.{$CTM[21]} WHERE ScreenID='{$Id}' and Account='{$this->Login}'");
					if($Check_Vote > 0)
					{
						exit("<div class=\"info-box\"> Voc&ecirc; j&aacute; votou nesta ScreenShot.</div>");
					}
					else
					{
						$Screen_Votes = $Find_Votes[0]+$Votes;
						$this->Query("INSERT INTO dbo.{$CTM[21]} (Account,Vote,ScreenID) VALUES ('{$this->Login}',{$Votes},{$Id})");
						$this->Query("UPDATE dbo.{$CTM[20]} SET Votes=Votes+{$Votes} WHERE Id='{$Id}'");
						exit("<div class=\"success-box\"> Voto computado com Sucesso!</div>
						<script>document.getElementById('Screen_Votes').innerHTML = '".$Screen_Votes."';</script>");
					}
				}
			}
			if($_GET["cmd"] == "comment")
			{
				if($CTM_General->Check_Logged(2) == TRUE)
				{
					exit("<div class=\"error-box\"> Para comentar &eacute; preciso estar Logado.<div>");
				}
				else
				{
					$Character = $_POST["Character"];
					$Comment = base64_encode($_POST["Text"]);
					
					if(empty($Character))
					{
						exit("<div class=\"warning-box\"> Selecione o personagem.</div>");
					}
					elseif(empty($Comment))
					{
						exit("<div class=\"warning-box\"> Digite seu comentario.</div>");
					}
					else
					{
						$this->Query("INSERT INTO dbo.{$CTM[22]} (ScreenID,Account,User_Char,Comment_Date,Text) VALUES ({$Id},'{$this->Login}','{$Character}',".time().",'{$Comment}')");
						exit("<script>CTM_Load('?pag=screenshots&view={$Id}','conteudo','GET');</script>");
					}
				}
			}
			$ScreenShot = $this->FetchArray($Query);
			$Find_Comments = $this->Query("SELECT * FROM dbo.{$CTM[22]} WHERE ScreenID='{$Id}' ORDER BY Id DESC");
			$Find_Characters = $this->Query("SELECT Name FROM ".MuGen_DB.".dbo.Character WHERE AccountID='{$this->Login}'");
			$Link .= "http://";
			$Link .= $_SERVER["HTTP_HOST"];
			$Link .= $_SERVER["PHP_SELF"];
			$Link .= "?do=screenshots&id=".$ScreenShot["Id"];
			$Date = date("d/m/Y", $ScreenShot["Up_Date"]);
			$Description = $ScreenShot["Description"] == "NULL" ? "Sem Informa&ccedil;&atilde;o" : nl2br($CTM_BBCode->Replace(base64_decode($ScreenShot["Description"])));
			
			while($Comments = $this->FetchArray($Find_Comments))
			{
				$Return .= "<blockquote>
	<table width=\"638\" border=\"0\">
 			 <tr>
   			 <td width=\"135\"><img src=\"".$CTM_General->Image($Comments["User_Char"])."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /></td>
   			 <td width=\"493\"><table width=\"445\" border=\"0\">
				 <tr>
       			 <td><blockquote>Postado por: <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Comments["User_Char"])."','conteudo','GET');\"><b class=\"colr\">".$Comments["User_Char"]."</b></a> em <b class=\"colr\">".date("d/m/Y", $Comments["Comment_Date"])."</b></blockquote></td>
				 </tr>
				 <tr>
       			 <td><blockquote>".nl2br($CTM_BBCode->Replace(base64_decode($Comments["Text"])))."</blockquote></td>
				 </tr>
    			</table>
				</td>
  			</tr>
			</table>
		</blockquote>";
				
			}
			while($Characters = $this->Fetch($Find_Characters))
			{
				$Character .= "<option value=\"{$Characters[0]}\">{$Characters[0]}</option>\n";
			}
			$CTM_Template->Set("ScreenShot[Id]", $ScreenShot["Id"]);
			$CTM_Template->Set("ScreenShot[Image]", constant("Upload_SS").$ScreenShot["ScreenShot"]);
			$CTM_Template->Set("ScreenShot[Description]", $Description);
			$CTM_Template->Set("ScreenShot[Autor]", $ScreenShot["User_Char"]);
			$CTM_Template->Set("ScreenShot[Date]", $Date);
			$CTM_Template->Set("ScreenShot[Votes]", $ScreenShot["Votes"]);
			$CTM_Template->Set("ScreenShot[Link]", $Link);
			$CTM_Template->Set("ScreenShot[Comments]", $Return);
			$CTM_Template->Set("ScreenShot[Characters]", $Character);
			unset($Link);
			unset($Return);
			unset($Character);
		}
	}
}
endif;
?>