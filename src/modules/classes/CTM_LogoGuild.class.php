<?php
//**********************************************//
// -> Effect Web                                //
// -> Powered By: Erick-Master                  //
// -> CTM TeaM Softwares                        //
// -> www.ctmts.com.br                          //
//**********************************************//

$PageRequest = strtolower(basename($_SERVER['REQUEST_URI']));
$PageName = strtolower(basename(__FILE__));
if($PageRequest == $PageName)
{
	exit("<span style=\"padding: 5px; border: 1px dashed #c00;color: #c00;background-color: #ffebe8;background: #ffebe8;\"><strong>CTM-Error: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}

if(!class_exists("CTM_LogoGuild")) :

class CTM_LogoGuild
{
	private $Size = 120;
	
	private function GerateColor($G_Mark)
	{
		if(substr_count($G_Mark, 0) >= 1) { return "#FFFFFF"; }
		if(substr_count($G_Mark, 1) >= 1) { return "#000000"; }
		if(substr_count($G_Mark, 2) >= 1) { return "#8C8A8D"; }
		if(substr_count($G_Mark, 3) >= 1) { return "#FFFFFF"; }
		if(substr_count($G_Mark, 4) >= 1) { return "#FE0000"; }
		if(substr_count($G_Mark, 5) >= 1) { return "#FF8A00"; }
		if(substr_count($G_Mark, 6) >= 1) { return "#FFFF00"; }
		if(substr_count($G_Mark, 7) >= 1) { return "#8CFF01"; }
		if(substr_count($G_Mark, 8) >= 1) { return "#00FF00"; }
		if(substr_count($G_Mark, 9) >= 1) { return "#01FF8D"; }
		if(substr_count($G_Mark, "A") >= 1) { return "#00FFFF"; }
		if(substr_count($G_Mark, "B") >= 1) { return "#008AFF"; }
		if(substr_count($G_Mark, "C") >= 1) { return "#0000FE"; }
		if(substr_count($G_Mark, "D") >= 1) { return "#8C00FF"; }
		if(substr_count($G_Mark, "E") >= 1) { return "#FF00FE"; }
		if(substr_count($G_Mark, "F") >= 1) { return "#FF008C"; }
	}
	private function LoadLogo($Image, $Hexcode, $X = 0, $Y = 0)
	{
		$Pixel = $this->Size / 8;
		
		for($WzAG = 0; $WzAG < 8; $WzAG++)
		{
			for($While = 0; $While < 8; $While++)
			{
				$Offset = ($WzAG * 8) + $While;
				$Define[$WzAG][$While] = substr($Hexcode, $Offset, 1);
			}
		}
		for($WzAG = 1; $WzAG <= 8; $WzAG++)
		{
			 for($While = 1; $While <= 8; $While++)
			 {
				 $Send = $Define[$WzAG - 1][$While - 1];
				 for($Repeat = 0; $Repeat < $Pixel; $Repeat++)
				 {
					 for($Repeated = 0; $Repeated < $Pixel; $Repeated++)
					 {
						 $LoatedY = ((($WzAG - 1) * $Pixel) + $Repeat);
						 $LoatedX = ((($While - 1) * $Pixel) + $Repeated);
						 $Defined[$LoatedY][$LoatedX] = $Send;
					 }
				 }
			 }
		}
		for($WzAG = 0; $WzAG < $this->Size; $WzAG++)
		{
			for($While = 0; $While < $this->Size; $While++)
			{
				$Send = strtoupper($Defined[$WzAG][$While]);
				$Color = substr($this->GerateColor($Send), 1);
				$Gerate[0] = substr($Color, 0, 2);
				$Gerate[1] = substr($Color, 2, 2);
				$Gerate[2] = substr($Color, 4, 2);
				$Pixel_Img = imagecreate(1, 1);
				$Finish = imagecolorallocatealpha($Pixel_Img, hexdec($Gerate[0]), hexdec($Gerate[1]), hexdec($Gerate[2]), 0);
				imagefilledrectangle($Pixel_Img, 0, 0, 1, 1, $Finish);
				imagecopy($Image, $Pixel_Img, $X + $While, $Y + $WzAG, 0, 0, 1, 1);
				imagedestroy($Pixel_Img);
			}
		}
		
		header("Content-type: image/png");
		imagepng($Image);
	}
	public function ShowLogo()
	{
		$this->Size = 120;
		$this->LoadLogo(imagecreate($this->Size, $this->Size), $_GET["code"]);
		if (empty($_GET["code"]))
		{
			echo("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\">CTM-Error #7:</strong> N&atilde;o foi possivel gerar o logo da guild.</span>");
		}
	}
}
endif;
?>