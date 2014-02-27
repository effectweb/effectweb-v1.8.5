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

if(!class_exists("CTM_FileUpload")) :

class CTM_FileUpload
{
	public $Size = NULL;
	public $Directory = NULL;
	public $File = NULL;
	public $Name = NULL;
	public $Upload = NULL;
	public $Return_Cmd = NULL;
	public $File_Type = 1;
	public $Reduce = FALSE;
	public $Pixel = NULL;
	public $Message = array();
	public $Error = NULL;
	private $Extension = NULL;
	private $Preg_Match = NULL;
	private $Mime_Type = NULL;
	
	public function __construct()
	{
		
	}
	private function Set_Upload()
	{
		switch($this->File_Type)
		{
			case 1 :
			$this->Message = array(0 => "Selecione uma Imagem",
								   1 => "Erro ao enviar a Imagem",
								   2 => "Formato inv&aacute;lido.<br />A os formatos aceitos s&atilde;o: <b>JPEG</b>, <b>GIF</b>, <b>PNG</b>",
								   3 => "Tamanho da imagem exedido.<br />Maximo: <b>".$this->Size."</b> (Bytes)",
								   4 => "Imagem Enviada com Sucesso!",
									  );
			$this->Preg_Match = "gif|png|jpg|jpeg";
			$this->Mime_Type = array("image/jpeg", "image/gif", "image/png");
			break;
			case 2 :
			$this->Message = array(0 => "Selecione o arquivo",
								   1 => "Erro ao enviar o Arquivo",
								   2 => "Formato inv&aacute;lido.<br />A os formatos aceitos s&atilde;o: <b>PDF>, <b>TXT</b>, <b>DOC</b>",
								   3 => "Tamanho do arquivo exedido.<br />Maximo: <b>".$this->Size."</b> (Bytes)",
								   4 => "Arquivo Enviado com Sucesso!",
									  );
			$this->Preg_Match = "pdf|txt|doc";
			$this->Mime_Type = array("application/pdf", "unknown/unknown", "application/msword");
			break;
		}
	}
	private function Check_File()
	{
		$this->File = isset($_FILES[$this->Upload]) == TRUE ? $_FILES[$this->Upload] : FALSE;
		
		/*if(is_file($this->File["tmp_name"]) == FALSE)
		{
			$this->Error[0] = $this->Message[0];
		}*/
		if(file_exists($this->Directory) == FALSE)
		{
			@mkdir($this->Directory);
		}
		elseif(is_uploaded_file($this->File["tmp_name"]) == FALSE)
		{
			$this->Error[1] = $this->Message[1];
		}
		elseif(in_array($this->File["type"], $this->Mime_Type) == FALSE)
		{
			$this->Error[1] = $this->Message[2];
		}
		elseif($this->File["size"] > $this->Size)
		{
			$this->Error[0] = $this->Message[3];
		}
		return TRUE;
	}
	public function Command()
	{
		$this->Set_Upload();
		
		if($this->Check_File() == TRUE)
		{
			$this->File_Upload();
		}
	}
	private function File_Upload()
	{
		if($this->Error[0] == TRUE)
		{
			$Return = "<div class=\"warning-box\">{$this->Error[0]}</div>";
		}
		elseif($this->Error[1] == TRUE)
		{
			$Return = "<div class=\"error-box\">{$this->Error[1]}</div>";
		}
		else
		{
			preg_match("/\.(".$this->Preg_Match."){1}$/i", $this->File["name"], $Extension);
			$File = $this->Directory.$this->Name.".".$Extension[1];
			
			if($this->File_Type == 1 && $this->Reduce == TRUE)
			{
				$this->Collapse_Img($this->File["tmp_name"], $File, strtolower($Extension[1]), $this->Pixel);
			}
			else
			{
				copy($this->File["tmp_name"], $File);
			}
			$Return = "<div class=\"success-box\"> ".$this->Message[4]."</div>";
		}
		$this->Return_Cmd = $Return;
	}
	private function Collapse_Img($Name, $Image, $Extension, $Pixel)
	{
		$Get_Img = getimagesize($Name);
		$Fetch = explode(",", $Pixel);
	
		$Create_Img = imagecreatetruecolor($Fetch[0], $Fetch[1]);

		switch($Extension)
		{
			case("gif") : $Image_Extension = imagecreatefromgif($Name); break;
			case("jpg") : $Image_Extension = imagecreatefromjpeg($Name); break;
			case("png") : $Image_Extension = imagecreatefrompng($Name); break;
		}

		imagecopyresampled($Create_Img, $Image_Extension, 0, 0, 0, 0, $Fetch[0] + 1, $Fetch[1] + 1, $Get_Img[0], $Get_Img[1]);

		switch($Extension)
		{
			case("jpg") : return imagejpeg($Create_Img, $Image); break;
			case("gif") : return imagegif($Create_Img, $Image); break;
			case("png") : return imagepng($Create_Img, $Image); break;
		}
		imagedestroy($Image_Extension);
	}
}
endif;
?>