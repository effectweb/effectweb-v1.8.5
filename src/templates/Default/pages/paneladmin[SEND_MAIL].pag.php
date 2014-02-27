<h4 class="heading colr"> Enviar E-Mail ao Jogador</h4>
	<blockquote>
<form name="Send_Mail" id="Send_Mail">
<table width="100%" border="0">
  <tr>
    <td>Conta / E-Mail:</td>
    <td><input type="text" name="Account_Mail" id="Account_Mail" /></td>
  </tr>
  <tr>
    <td>Assunto:</td>
    <td><input type="text" name="Subject" id="Subject" /></td>
  </tr>
      <tr align="center">
        <td height="35"><select onchange="selTexto('Text', '['+this.options[this.selectedIndex].value+']', '[/'+this.options[this.selectedIndex].value+']');">
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
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Text', '[b]', '[/b]');"><img src="images/icons/bbcode/text_bold.png" border="0" /></a></td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Text', '[i]', '[/i]');"><img src="images/icons/bbcode/text_italic.png" border="0" /></a></td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Text', '[u]', '[/u]');"><img src="images/icons/bbcode/text_underline.png" border="0" /></a></td>
        <td<a href="javascript: void(EffectWeb);" onclick="selTexto('Text', '[s]', '[/s]');"><img src="images/icons/bbcode/text_strikethrough.png" border="0" /></a></td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Text', '[h1]', '[/h1]');"><img src="images/icons/bbcode/text_heading_1.png" border="0" /></a></td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Text', '[left]', '[/left]');"><img src="images/icons/bbcode/text_align_left.png" border="0" /></a></td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Text', '[center]', '[/center]');"><img src="images/icons/bbcode/text_align_center.png" border="0" /></a></td>
        <td><a href="javascript: void(EffectWeb);" onclick="selTexto('Text', '[right]', '[/right]');"><img src="images/icons/bbcode/text_align_right.png" border="0" /></a></td>
      </tr>
      <tr>
        <td align="center" colspan="41"><textarea name="Text" id="Text" cols="60" rows="7"></textarea><br />&nbsp;</td>
      </tr>
      <tr>
        <td colspan="41"><strong class="colr">Tags:</strong><br />&nbsp;<ul class="ul">
        <li>&raquo; <strong>{Memb_Name}</strong> - Nome do Jogador</li>
        <li>&raquo; <strong>{Memb_Mail}</strong> - E-Mail do Jogador</li>
        <li>&raquo; <strong>{Memb_Login}</strong> - Conta do Jogador</li>
        </ul><br /></td>
      </tr>
      <tr>
        <td align="center" colspan="41"><input type="button" value="Enviar E-Mail" onclick="CTM_Load('?pag=paneladmin&str=SEND_MAIL&cmd=true','Command','POST',BuscaElementosForm('Send_Mail'));" /></td>
      </tr>
</table>
</form>
</blockquote>
<div id="Command"></div>