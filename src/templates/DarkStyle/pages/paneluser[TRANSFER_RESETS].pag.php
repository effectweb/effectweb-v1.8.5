<h4>Transferir Resets</h4>
			<blockquote>
Resets Atuais de seu Personagem: <span class="colr">{%CHAR_RESETS%}</span><br />
Numero mimino de Resets quereridos: <span class="colr">{%RESETS_MIN%}</span><br />
Numero mimino de Resets a enviar: <span class="colr">{%RESETS_SEND%}</span><br />
<br />
<form name="Transfer_Resets" id="Transfer_Resets">
<table width="403" border="0">
  <tr>
    <td width="166"><strong>Personagem a Receber:</strong></td>
    <td width="227"><select name="Character_Get" id="Character_Get">
    {%CHARACTER_LIST%}
    </select></td>
  </tr>
  <tr>
    <td width="166"><strong>Quantidade:</strong></td>
    <td width="227"><input type="text" name="Resets" id="Resets" onkeypress="return NumbersOnly(event);" size="6" /></td>
  </tr>
</table>
<input type="button" value="Transferir" onClick="CTM_Load('?pag=paneluser&str=TRANSFER_RESETS&cmd=true', 'Command', 'POST',BuscaElementosForm('Transfer_Resets'));">
</form>
</blockquote>
<div id="Command"></div>