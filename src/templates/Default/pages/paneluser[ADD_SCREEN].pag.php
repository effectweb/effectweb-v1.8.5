<form method="post" action="?pag=paneluser&str=ADD_SCREEN&cmd=true" enctype="multipart/form-data">
<div style="padding: 10px;">
  <h4>Adicionar ScreenShot</h4><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="39%" valign="top"><strong class="colr" style="font-size: 12px;">Personagem:</strong></td>
    <td width="50%"><select name="Character" id="Character">
    <option value="" disabled="disabled" selected="selected">Selecione</option>
    {%CHARACTER_LIST%}
    </select></td>
    <td width="1%">&nbsp;</td>
  </tr>
  <tr>
    <td width="39%" valign="top"><strong class="colr" style="font-size: 12px;">ScreenShot:</strong></td>
    <td width="50%"><input type="file" name="ScreenShot" id="ScreenShot"></td>
    <td width="1%">&nbsp;</td>
  </tr>
  <tr>
    <td width="39%" valign="top"><strong class="colr" style="font-size: 12px;">Descri&ccedil;&atilde;o:</strong></td>
  </tr>
  <tr align="center">
        <td height="35"><select onchange="selTexto('Description', '['+this.options[this.selectedIndex].value+']', '[/'+this.options[this.selectedIndex].value+']');">
               <option value="0" disabled="disabled" selected="selected">Selecione uma Cor</option>
               <option value="red">Vermelho</option>
               <option value="white">Branco</option>
               <option value="blue">Azul Escuro</option>
               <option value="yellow">Amarelho</option>
               <option value="green">Verde Escuro</option>
               <option value="violet">Violeta</option>
               <option value="gray">Cinza Escuro</option>
               <option value="lime">Verde Lim&atilde;o</option>
               <option value="silver">Cinza Claro</option>
               <option value="pink">Rosa</option>
               <option value="navy">Azul Marinho</option>
               <option value="aqua">Azul &Aacute;gua</option>
            </select></td>
        <td>&nbsp;</td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Description', '[b]', '[/b]');"><img src="images/icons/bbcode/text_bold.png" border="0" /></a></td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Description', '[i]', '[/i]');"><img src="images/icons/bbcode/text_italic.png" border="0" /></a></td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Description', '[u]', '[/u]');"><img src="images/icons/bbcode/text_underline.png" border="0" /></a></td>
        <td<a href="javascript: void(EffectWeb);" onclick="selTexto('Description', '[s]', '[/s]');"><img src="images/icons/bbcode/text_strikethrough.png" border="0" /></a></td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Description', '[h1]', '[/h1]');"><img src="images/icons/bbcode/text_heading_1.png" border="0" /></a></td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Description', '[left]', '[/left]');"><img src="images/icons/bbcode/text_align_left.png" border="0" /></a></td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Description', '[center]', '[/center]');"><img src="images/icons/bbcode/text_align_center.png" border="0" /></a></td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Description', '[right]', '[/right]');"><img src="images/icons/bbcode/text_align_right.png" border="0" /></a></td>
      </tr>
      <tr>
        <td align="center" colspan="41"><textarea name="Description" id="Description" cols="60" rows="7"></textarea><br />&nbsp;</td>
      </tr>
  <tr>
    <td width="39%" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td style="padding: 10px;"><input type="submit" value="Enviar ScreenShot" /></td>
  </tr>
</table>
</div>
</form>
{Command_Result}