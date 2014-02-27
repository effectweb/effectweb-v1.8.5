<h4 class="heading colr">Tickets de Suporte</h4>
	   <blockquote>
	   <div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup" style="font-size: 13px;">
    <li class="TabbedPanelsTab" tabindex="0">Tickets Abertos</li>
    <li class="TabbedPanelsTab" tabindex="0">Tickets em Andamento</li>
	<li class="TabbedPanelsTab" tabindex="0">Tickets Fechados</li>
	<li class="TabbedPanelsTab" tabindex="0">Abrir novo Ticket</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    {Tickets_Open}
    </div>
	<div class="TabbedPanelsContent">
    {Tickets_Progress}
    </div>
	<div class="TabbedPanelsContent">
    {Tickets_Closed}
    </div>
	<div class="TabbedPanelsContent">
    {Check_Limit}
    <form name="Open_Ticket" id="Open_Ticket">
<table width="452" border="0">
  <tr>
    <td>Assunto:</td>
    <td><input type="text" name="Title" id="Title" /></td>
  </tr>
  <tr>
    <td>Departamento:</td>
    <td><select name="Subject" id="Subject">
    {Departament_List}
    </select>
    </td>
  </tr>
  <tr>
    <td>Personagem:</td>
    <td><select name="Character" id="Character">
    {Character_List}
    </select>
    </td>
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
        <td align="center" colspan="41"><input type="button" value="Abrir Ticket" onclick="CTM_Load('?pag=paneluser&str=TICKETS&cmd=true','Command','POST',BuscaElementosForm('Open_Ticket'));" /></td>
      </tr>
</table>
</form>
</div>
  </div>
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
	</blockquote>
	<div id="Command"></div>