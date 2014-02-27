	<div class="col2">
        	<h4 class="heading colr">Ver ScreenShot #{ScreenShot[Id]}</h4>
            	<blockquote>
  <table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="60%" align="center"><blockquote>
      <a href="{ScreenShot[Image]}" class="lightbox"><img src="{ScreenShot[Image]}" width="420" style="border: 0;" /></a>
    </blockquote></td>
    <td width="40%" valign="top"><blockquote>
      <div id="panel">
         <li>&raquo; Enviado por: <strong>{ScreenShot[Autor]}</strong></li>
         <li>&raquo; Enviada em: <strong>{ScreenShot[Date]}</strong></li>
         <li>&raquo; Votos: <strong id="Screen_Votes">{ScreenShot[Votes]}</strong></li>
         <li>&raquo; Link: <input type="text" value="{ScreenShot[Link]}" onClick="this.select();" readonly="readonly" size="17">
         
         <li>&raquo; Votar: <form name="Send_Vote" id="Send_Vote">
         <select name="Votes" id="Votes">
           <option value="1" selected="selected">1</option>
           <option value="2">2</option>
           <option value="3">3</option>
           <option value="4">4</option>
           <option value="5">5</option>
           <option value="6">6</option>
           <option value="7">7</option>
           <option value="8">8</option>
           <option value="9">9</option>
           <option value="10">10</option>
         </select> <input type="button" value="Votar" onclick="CTM_Load('?pag=screenshots&view={ScreenShot[Id]}&cmd=vote', 'Command', 'POST', BuscaElementosForm('Send_Vote'));" />
         </form>
         </li>
      </div>
    </blockquote></td>
  </tr>
  <tr>
    <td width="60%" align="center"><blockquote>
      {ScreenShot[Description]}</a>
    </blockquote>
    <div id="Command"></div></td>
</table>
{ScreenShot[Comments]}
<?php
global $Check_Logged;
if($Check_Logged == TRUE)
{
?>
<h4 class="heading">Comentar</h4>
<form name="ScreenShot_Comment" id="ScreenShot_Comment">
<table width="452" border="0">
  <tr>
    <td><strong>Personagem:</strong></td>
    <td><select name="Character" id="Character">
    {ScreenShot[Characters]}
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
        <td align="center" colspan="41"><input type="button" value="Comentar" onclick="CTM_Load('?pag=screenshots&view={ScreenShot[Id]}&cmd=comment','Comment','POST',BuscaElementosForm('ScreenShot_Comment'));" /></td>
      </tr>
</table>
</form>
<div id="Comment"></div>
<?php
}
else
{
?>
<div class="info-box"> Logue-se para comentar esta ScreenShot.</div>
<? } ?>
</blockquote>
        </div>