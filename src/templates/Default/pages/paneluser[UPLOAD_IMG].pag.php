<form method="post" action="?pag=paneluser&str=UPLOAD_IMG&cmd=upload" enctype="multipart/form-data">
<div style="padding: 10px;"><h4 class="heading colr">Gerenciar Imagem</h4><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="39%" valign="top"><strong class="colr">Alterar Imagem:</strong></td>
    <td width="50%"><input type="file" name="Char_Image" id="Char_Image"></td>
    <td width="1%">&nbsp;</td>
  </tr>
  <tr>
    <td width="39%" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td style="padding: 10px;"><input type="submit" value="Enviar Imagem" /></td>
    <td style="padding: 10px;"><input type="button" value="Remover Imagem" onclick="javascript: window.location='?pag=paneluser&str=UPLOAD_IMG&cmd=delete';" /></td>

  </tr>
</table>
</div>
</form>
{Command_Result}