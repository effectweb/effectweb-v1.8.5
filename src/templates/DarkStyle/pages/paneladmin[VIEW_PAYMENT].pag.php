<script type="text/javascript">
function Delete_Payment()
{
	var Check = confirm('Atencao\r\nTem certeza que deseja deletar este Pagamento?');
	if (Check == true)
	{
		CTM_Load('?pag=paneladmin&str=VIEW_PAYMENT&cmd=delete&id={Payment_ID}','Command','POST',BuscaElementosForm('Manage_Payment'));
		return true;
	}
}
</script>
<h4>Pagamento {Payment_Post#Date}</h4>
	<blockquote>
	<table width="100%" border="0">
 			 <tr>
   			 <td width="135"><img src="{Payment_Char#Image}" width="120" height="120" style="border: 1px solid #B3B3B3;" class="image" /></td>
   			 <td width="493"><table border="0">
				 <tr>
       			 <td><blockquote>Postado por: <b class="colr">{Payment_Char}</b> em <b class="colr">{Payment_Post#Date}</b> as <b class="colr">{Payment_Time}</b><br />Status: {Payment_Status}</blockquote></td>
				 </tr>
				 <tr>
       			 <td><blockquote><h4 class="heading colr" style="font-size: 15px;">Dados da Compra</h4>
				 Numero de {Coin_1}: <strong class="colr">{Payment_Amounts}</strong>
				 <h4 class="heading red" style="font-size: 15px;">Dados do Dep&oacute;sito</h4>
				 Banco: <strong class="colr">{Payment_Bank}</strong><br />
				 Tipo de Pagamento: <strong class="colr">{Payment_Type}</strong><br />
				 Data: <strong class="colr">{Payment_Date}</strong><br />
				 Valor: <strong class="colr">R$ {Payment_Price}</strong><br /><br />
				 CTR/Terminal/NB. Envelope: <strong class="colr">{Payment_Master}</strong><br />
				 N. Documento: <strong class="colr">{Payment_Document}</strong>
				 <h4 class="heading colr" style="font-size: 15px;">Mensagem</h4>
				 {Payment_Message}</blockquote></td>
				 </tr>
    			</table>
				</td>
  			</tr>
			</table>
		</blockquote>
        {Resp_List}
		<h4>Gerenciar</h4>
	<blockquote>
	<form name="Manage_Payment" id="Manage_Payment">
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
        <td align="center" colspan="41"><input type="button" value="Responder" onclick="CTM_Load('?pag=paneladmin&str=VIEW_PAYMENT&cmd=resp&id={Payment_ID}','Command','POST',BuscaElementosForm('Manage_Payment'));" />&nbsp;<input type="button" value="Confirmar Pagamento" onclick="CTM_Load('?pag=paneladmin&str=VIEW_PAYMENT&cmd=confirm&id={Payment_ID}','Command','POST',BuscaElementosForm('Manage_Payment'));" />&nbsp;<input type="button" value="Rejeitar Pagamento" onclick="CTM_Load('?pag=paneladmin&str=VIEW_PAYMENT&cmd=rejet&id={Payment_ID}','Command','POST',BuscaElementosForm('Manage_Payment'));" />{%DELETE_BUTTON%}</td>
      </tr>
	  </table>
	  </form>
	  </blockquote>
	  <div id="Command"></div>