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

if(!class_exists("CTM_Captcha")) :

class CTM_Captcha
{
	public $Captcha = NULL;
	
	public function Gerate()
	{
		$Rand = "ABCDEFGHJKLMNPRSTUVWXYZ123456789";
		for ($WzAG = 0; $WzAG < 10; $WzAG++)
		{
			if (strlen($Rand) > 0)
			{
				$this->Captcha .= $Rand{mt_rand(0, strlen($Rand) - 1)};
			}
			else
			{
				$this->Captcha .= chr(rand(65, 90));
			}
		}
		$_SESSION["CTM_Captcha"] = md5(sha1($this->Captcha));
	}
	public function Captcha_Image($Height = 103, $Width = 25)
	{
		$this->Gerate();
		$Image = imagecreate($Height, $Width);
		
		$Color[0] = imagecolorallocate($Image, 160, 160, 160);
		$Color[1] = imagecolorallocate($Image, 54, 54, 54);
		$Color[2] = imagecolorallocate($Image, 51, 51, 51);
		imagefill($Image, 0, 0, $Color[1]);
		imagestring($Image, 8, 20, 4, $this->Captcha, $Color[0]);
		imagerectangle($Image, 0, 0, $Height - 1, $Width - 1, $Color[2]);
		header("Content-Type: image/jpeg");
		imagejpeg($Image);
		imagedestroy($Image);
	}
	public function Check($Check)
	{
		return md5(sha1($Check)) == $_SESSION["CTM_Captcha"] ? TRUE : FALSE;
	}
}
endif;
?>