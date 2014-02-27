<div class="col2">
	<h4>{News#Title}</h4>
	<blockquote>
	<table width="638" border="0">
 			 <tr>
   			 <td width="135"><img src="{News#Image}" width="120" height="120" style="border: 1px solid #B3B3B3;" class="image" /></td>
   			 <td width="493"><table width="445" border="0">
				 <tr>
       			 <td><blockquote>Postado por: <b class="colr">{News#Character}</b> em <b class="colr">{News#Date}</b> as <b class="colr">{News#Hour}</b></blockquote></td>
				 </tr>
				 <tr>
       			 <td><blockquote>{News#Text}</blockquote></td>
				 </tr>
    			</table>
				</td>
  			</tr>
			</table>
		</blockquote>
<div id="News_Comments">{News#Comments}</div>
<?php
global $Check_Logged;
if($Check_Logged == TRUE)
{
?>
<h2>Comentar</h2>
<blockquote>
<form name="News_Comment" id="News_Comment">
<table width="452" border="0">
  <tr>
    <td><strong>Personagem:</strong></td>
    <td><select name="Character" id="Character">
    {News#Characters}
    </select></td>
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
        <td align="center" colspan="41"><input type="button" value="Comentar" onclick="CTM_Load('?pag=news&str=VIEW&id={News#Id}&cmd=comment','Comment','POST',BuscaElementosForm('News_Comment'));" /></td>
      </tr>
</table>
</form>
</blockquote>
<div id="Comment">{News#Comment_Cmd}</div>
<?php
}
else
{
?>
<div class="info-box"> Logue-se para comentar esta Noticia.</div>
<? } ?>
		</div>