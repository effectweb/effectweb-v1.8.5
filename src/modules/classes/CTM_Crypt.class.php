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

if(!class_exists("CTM_Crypt")) :

class CTM_Crypt extends CTM_General
{	
	public function Pwd($CTM_Crypt)
	{
		$Pwd = @md5(@sha1(@hash("sha512", $Pwd)));
		if($Pwd == false)
		{
			exit("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\">CTM-Error #4: Entre em contato com o Desenvolvedor.</span>");
		}
		return $Pwd;
	}
	public function CharImg($CTM_Crypt)
	{
		$Crypt = @md5(@hash("haval256,3", $CTM_Crypt));
		if($Crypt == FALSE)
		{
			exit("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\">CTM-Error #8: Entre em contato com o Desenvolvedor.</span>");
		}
		return $Crypt;
	}
	public static function stringNewEncoder($string, $password = NULL)
	{
		$password = md5(empty($password) ? "FFFF" : $password);
		
		$pwd_length = strlen($password);
		$return = NULL;
			
		for($i = 0; $i < 255; $i++)
		{
			$key[$i] = ord(substr($password, ($i % $pwd_length) + 1, 1));
			$counter[$i] = $i;
		}
			
		for($i = 0; $i < 255; $i++)
		{
			$x = ($x + $counter[$i] + $key[$i]) % 255;
			$temp_swap = $counter[$i];
			$counter[$i] = $counter[$x];
			$counter[$x] = $temp_swap;
		}
			
		for($i = 0; $i < strlen($string); $i++)
		{
			$a = ($a + 1) % 255;
			$y = ($y + $counter[$a]) % 255;
			
			$temp = $counter[$a];
			$counter[$a] = $counter[$y];
			$counter[$y] = $temp;
			$k = $counter[(($counter[$a] + $counter[$y]) % 255)];
			$Zcipher = ord(substr($string, $i, 1)) ^ $k;
			$return .= chr($Zcipher);
		}
				
		return $return;
	}
	public static function stringNewDecoder($string, $password = NULL)
	{
		$password = md5(empty($password) ? "FFFF" : $password);
		
		$pwd_length = strlen($password);
		$return = NULL;
			
		for($i = 0; $i < 255; $i++)
		{
			$key[$i] = ord(substr($password, ($i % $pwd_length) + 1, 1));
			$counter[$i] = $i;
		}
			
		for($i = 0; $i < 255; $i++)
		{
			$x = ($x + $counter[$i] + $key[$i]) % 255;
			$temp_swap = $counter[$i];
			$counter[$i] = $counter[$x];
			$counter[$x] = $temp_swap;
		}
			
		for($i = 0; $i < strlen($string); $i++)
		{
			$a = ($a + 1) % 255;
			$y = ($y + $counter[$a]) % 255;
			
			$temp = $counter[$a];
			$counter[$a] = $counter[$y];
			$counter[$y] = $temp;
			$k = $counter[(($counter[$a] + $counter[$y]) % 255)];
			$Zcipher = ord(substr($string, $i, 1)) ^ $k;
			$return .= chr($Zcipher);
		}
				
		return $return;
	}
	public function EncodeKey($CTM_Crypt)
	{
		$Return = array(
				  "=" => "C",
				  "A" => "!",
				  "B" => "@",
				  "C" => "H",
				  "D" => "6",
				  "E" => "J",
				  "F" => "7",
				  "G" => "V",
				  "H" => "&",
				  "I" => "?",
				  "J" => "T",
				  "K" => "4",
				  "L" => "$",
				  "M" => "/",
				  "N" => "D",
				  "O" => "8",
				  "P" => "0",
				  "Q" => "%",
				  "R" => "*",
				  "S" => "+",
				  "T" => "5",
				  "U" => "<",
				  "V" => "2",
				  "W" => "B",
				  "Y" => "A",
				  "X" => "-",
				  "Z" => "W",
				  "0" => "X",
				  "1" => "R",
				  "2" => "U",
				  "3" => "1",
				  "4" => "3",
				  "5" => "V",
				  "6" => "S",
				  "7" => "Z",
				  "8" => "Y",
				  "9" => "K",
		);
		
		return strtr($CTM_Crypt, $Return);
	}
	public function DecodeKey($CTM_Crypt)
	{
		$Return = array(
				  "C" => "=",
				  "!" => "A",
				  "@" => "B",
				  "H" => "C",
				  "6" => "D",
				  "J" => "E",
				  "7" => "F",
				  "V" => "G",
				  "&" => "H",
				  "?" => "I",
				  "T" => "J",
				  "4" => "K",
				  "$" => "L",
				  "/" => "M",
				  "D" => "N",
				  "8" => "O",
				  "0" => "P",
				  "%" => "Q",
				  "*" => "R",
				  "+" => "S",
				  "5" => "T",
				  "<" => "U",
				  "2" => "V",
				  "B" => "W",
				  "A" => "Y",
				  "-" => "X",
				  "W" => "Z",
				  "X" => "0",
				  "R" => "1",
				  "U" => "2",
				  "1" => "3",
				  "3" => "4",
				  "V" => "5",
				  "S" => "6",
				  "Z" => "7",
				  "Y" => "8",
				  "K" => "9",
		);
		return strtr($CTM_Crypt, $Return);
	}
	public function CallSecuritySite()
	{
		if(parent::CallSecuritySite("B6A013A69733B5B30DCFCE78CD37B6DC") != "YTc2ZGJiMmZlNDY5ZThkNzkwYmU0ZjJhYWUyNDUwMDI=")
			exit("Files corrupted.");
		
		$this->init();
		return "YTc2ZGJiMmZlNDY5ZThkNzkwYmU0ZjJhYWUyNDUwMDI=";
	}
}
endif;
?>