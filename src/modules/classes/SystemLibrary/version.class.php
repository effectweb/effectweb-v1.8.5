<?php
//**********************************************//
// -> Controller System [Effect Web]            //
// -> Powered by Erick-Master                   //
// -> CTM Team Softwares                        //
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

class Version
{
	private $real_version	= NULL;
	private $full_version	= NULL;
	private $number_version	= NULL;
	private $hex_version	= NULL;

	private $product_info	= array
	(
		"name" => "Effect Web v1.x",
		"changelog" => "ChangeLog.htm",
		"location" => "Settings.php"
	);

	public function setVersion($version, $full_version = NULL)
	{
		$this->real_version = $version;
		$this->full_version = $full_version;
		$this->number_version = eregi_replace("[^0-9\.]", NULL, $version);
		$this->hex_version = $this->getHexVersion($this->number_version);
	}

	public function getVersion($type = "number")
	{
		switch($type)
		{
			case "full" : return $this->full_version; break;
			case "number" : return $this->number_version; break;
			case "hex" : return $this->hex_version; break;
			default: return $this->real_version; break;
		}
	}

	public function compareVersions($version, $block_site = FALSE)
	{
		if("0x".strtoupper(dechex($version)) != $this->hex_version)
		{
			if($block_site == true)
			{
				echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\r\n";
				echo '<html xmlns="http://www.w3.org/1999/xhtml">';
				echo '<head>'."\r\n";
				echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'."\r\n";
				echo '<title>'.$this->product_info['name'].': Sistema em atualiza&ccedil;&atilde;o</title>'."\r\n";
				echo '</head>'."\r\n"."\r\n";
				echo '<body>'."\r\n";
				echo '<h2>Sistema em atualiza&ccedil;&atilde;o</h2>'."\r\n";
				echo '<address>Nosso sistema encontra-se em atualiza&ccedil;&atilde;o no momento.</address>'."\r\n";
				echo '<hr />'."\r\n";
				echo '<h3>Mensagem destinada ao administrador:</h3>'."\r\n";
				echo '<address>Pegue a chave de update da vers&atilde;o x no <b>'.$this->product_info['changelog'].'</b> da '.$this->product_info['name'].' e insira na <b>'.$this->product['location'].'</b></address>'."\r\n";
				echo '</body>'."\r\n";
				echo '</html>';

				exit();
			}
		}
	}

	private function getHexVersion($version)
	{
		return "0x".strtoupper(dechex(crc32($version)));
	}
}