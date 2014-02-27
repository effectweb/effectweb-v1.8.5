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

if(!class_exists("CTM_PagSeguro")) :

class CTM_PagSeguro extends CTM_MSSQL
{
	public $cryptKey	= "ZmSzZGp0LJV2Lmx1AP00YGx0YGOxp2EmMt==";
	public $filename	= "modules/core/Core_PagSeguro.txt";
	
	private $token		= NULL;
	private $license	= NULL;
	private $API_Key	= NULL;
	private $settings	= array();
	
	public function __construct()
	{
		global $_PAGSEGURO;
		
		$this->settings = $_PAGSEGURO;
		$this->loadOpenModuleFile();
	}
	public function PagSeguroReturn()
	{
		if(!$this->CheckModule())
			exit("Modules Error");
		else
			$this->startModule();
	}
	/*
	*	Get Module Data from File
	*
	*	@param	string		File of Data
	*	@param	sttring		Password for decrypt
	*	@return	string
	*/
	private function loadOpenModuleFile()
	{
		if(file_exists($this->filename))
		{
			$file = file_get_contents($this->filename);
			$file = preg_replace("/".preg_quote("----------- BEGIN CTM.MODULE LICENSE FOR [")."(.*?)".preg_quote("] -----------")."/i", NULL, trim($file));
			$file = preg_replace("/".preg_quote("----------- END CTM.MODULE LICENSE FOR [")."(.*?)".preg_quote("] -----------")."/i", NULL, trim($file));
			$file = str_replace(array("\r", "\n"), NULL, $file);
			
			$data = CTM_Crypt::stringNewDecoder(base64_decode($file), $this->cryptKey);
			preg_match("/\[--(.*?)--\]/i", str_replace(array("\r", "\n"), NULL, $data), $token);
			preg_match("/\[\*\*(.*?)\*\*\]/i", str_replace(array("\r", "\n"), NULL, $data), $license);
			preg_match("/\[%%(.*?)%%\]/i", str_replace(array("\r", "\n"), NULL, $data), $apiKey);
			
			$this->token = $token[1];
			$this->license = $license[1];
			$this->API_Key = $apiKey[1];
		}
	}
	/*
	*	Check License for use
	*
	*	@param	string		API Key
	*	@return	boolean
	*/
	public function CheckModule()
	{
		global $controller;
		$serial = $controller->getLicenseInfo("license", "serial");
		
		if($this->settings['API_KEY'] != $this->API_Key)
			return FALSE;
		if($this->license != $serial)
			return FALSE;
		
		return TRUE;
	}
	/*
	*	PagSeguro Module (Adapted)
	*	Author: Litlle
	*
	*	@return	void
	*/
	private function startModule()
	{
		$PagSeguro = 'Comando=validar';
		$PagSeguro .= '&Token=' . $this->token;
		$Cabecalho = "Retorno PagSeguro";
		
		foreach ($_POST as $key => $value)
		{
			$value = urlencode(stripslashes($value));
			$PagSeguro .= "&$key=$value";
		}
		
		if (function_exists('curl_exec'))
		{
			$curl = true;
		}
		elseif ( (PHP_VERSION >= 4.3) && ($fp = @fsockopen ('ssl://pagseguro.uol.com.br', 443, $errno, $errstr, 30)) )
		{
			$fsocket = true;
		}
		elseif ($fp = @fsockopen('pagseguro.uol.com.br', 80, $errno, $errstr, 30))
		{
			$fsocket = true;
		}
		
		if ($curl == true)
		{
			$ch = curl_init();
		
		 	curl_setopt($ch, CURLOPT_URL, 'https://pagseguro.uol.com.br/Security/NPI/Default.aspx');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $PagSeguro);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
			curl_setopt($ch, CURLOPT_URL, 'https://pagseguro.uol.com.br/Security/NPI/Default.aspx');
			$resp = curl_exec($ch);
		
			curl_close($ch);
			$confirma = (strcmp ($resp, "VERIFICADO") == 0);
		}
		elseif ($fsocket == true)
		{
			$Cabecalho  = "POST /Security/NPI/Default.aspx HTTP/1.0\r\n";
			$Cabecalho .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$Cabecalho .= "Content-Length: " . strlen($PagSeguro) . "\r\n\r\n";
		
			if ($fp || $errno>0)
			{
				fputs ($fp, $Cabecalho . $PagSeguro);
				$confirma = false;
				$resp = '';
				while (!feof($fp))
				{
					$res = @fgets ($fp, 1024);
					$resp .= $res;
					if (strcmp ($res, "VERIFICADO") == 0)
					{
						$confirma=true;
						break;
					}
				}
				fclose ($fp);
			}
			else
			{
				echo "$errstr ($errno)<br />\n";
			}
		}
		
		if ($confirma)
		{
			$StatusTransacao = $_POST['StatusTransacao'];
			$produtoDesc = trim($_POST['ProdDescricao_1']);
			$valorProduto = trim($_POST['ProdValor_1']);
			$valorProduto = eregi_replace(",",".",$valorProduto);
		 	
			$operatorCalc = $this->calculation($valorProduto)*$valorProduto;
		 
			if($StatusTransacao == "Aprovado" or  $StatusTransacao == "Completo")
			{ 
				$this->Query("UPDATE ".GL_DB.".dbo.".GL_Table." SET ".GL_Column_1."=".GL_Column_1."+".(int)$operatorCalc." WHERE ".GL_Login."='$produtoDesc'");
					
		 	}
		 	else if($StatusTransacao == "Cancelado")
		 	{
			
			}
		 	else
		 	{
				
		 	}
		}
		exit("Operation Finished");
	}
	/*
	*	Value Calculation (Adapted)
	*	Author: Litlle
	*
	*	@param	string		Value
	*	@return	integer
	*/
	private function calculation($valor)
	{
		$count = count($this->settings['PROMOTIONS']);
		for($x=0; $x <= $count; $x++)
		{
			if($valor >= $this->settings['PROMOTIONS'][$x][0] and $valor <= $this->settings['PROMOTIONS'][$x][1])
			{
				return $this->settings['PROMOTIONS'][$x][2];
			}
		}
				
	}
}
endif;
?>