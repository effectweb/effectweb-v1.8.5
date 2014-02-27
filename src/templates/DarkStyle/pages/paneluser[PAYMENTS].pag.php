<h4>Pagamentos</h4>
	   <blockquote>
	   <div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup" style="font-size: 13px;">
    <li class="TabbedPanelsTab" tabindex="0">Pagamentos em Aberto</li>
    <li class="TabbedPanelsTab" tabindex="0">Pagamentos Fechados</li>
	<li class="TabbedPanelsTab" tabindex="0">Confirmar Pagamento</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    {Payment_Open}
    </div>
	<div class="TabbedPanelsContent">
    {Payment_Closed}
    </div>
	<div class="TabbedPanelsContent">
	<form name="Confirm_Paymet" id="Confirm_Payment">
	   <h4 class="heading colr" style="font-size: 15px;">Dados da Compra</h4>
	   <table width="452" border="0">
  <tr>
    <td>Personagem:</td>
    <td><select name="Character" id="Character">
	<option value="" selected="selected" disabled="disabled">Selecione</option>
    {Character_List}
    </select></td>
  </tr>
  <tr>
    <td>Numero de {Coin_1}:</td>
    <td><input type="text" name="Amount" id="Amount" size="5" maxlength="8" onKeyPress="return NumbersOnly(event)" /></td>
  </tr>
  </table>
  <h4 class="heading red" style="font-size: 15px; font-weight: 0; margin-bottom: 0px;">Dados do Dep&oacute;sito</h4>
  <table width="452" border="0">
  <tr>
    <td>Banco:</td>
    <td><select name="Bank" id="Bank">
	<option value="" selected="selected" disabled="disabled">Selecione</option>
    {Bank_List}
    </select></td>
  </tr>
  <tr>
    <td>Tipo de Pagamento</td>
    <td><select name="Payment" id="Payment">
	<option value="Atendente">Atendente</option>
	<option value="Caixa Eletronico">Caixa Eletronico</option>
	<option value="Trans. Bancaria">Transferencia Bancaria</option>
	</select></td>
  </tr>
  <tr>
    <td>Valor:</td>
    <td><input type="text" name="Price" id="Price" size="7" maxlength="6" value="Ex: 20,00" onFocus="clearText(this)" /></td>
  </tr>
  <tr>
    <td>Data:</td>
    <td><input type="text" name="Date" id="Date" size="12" maxlength="10" value="Ex: XX/YY/ZZ" onFocus="clearText(this)" /></td>
  </tr>
  <tr>
    <td>CTR/Terminal/N. Envelope:</td>
    <td><input type="text" name="Master" id="Master" /></td>
  </tr>
  <tr>
    <td>N. Documento:</td>
    <td><input type="text" name="Document" id="Document" /></td>
  </tr>
  </table>
  <h4 class="heading colr" style="font-size: 15px;">Mensagem</h4>
  <table width="452" border="0">
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
        <td align="center" colspan="41"><input type="button" value="Confirmar Pagamento" onclick="CTM_Load('?pag=paneluser&str=PAYMENTS&exec=true','Command','POST',BuscaElementosForm('Confirm_Payment'));" /></td>
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