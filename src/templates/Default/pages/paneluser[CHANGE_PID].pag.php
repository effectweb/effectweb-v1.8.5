<h4 class="heading colr">Alterar Personal ID</h4>
			<blockquote>
O Personal ID &eacute; usado para efetuar certos processos dentro do Jogo.<br /><br />
<form name="Change_PID" id="Change_PID">
<table width="100%" border="0">
  <tr>
    <td>Novo PID:</td>
    <td><input type="password" name="NEW_PID" id="NEW_PID" onkeypress="return NumbersOnly(event);" maxlength="7"/></td>
  </tr>
  <tr>
    <td>Sua Senha Atual:</td>
    <td><input type="password" name="PASSWORD" id="PASSWORD" /></td>
  </tr>
</table>
<input type="button" value="Alterar PID" onClick="CTM_Load('?pag=paneluser&str=CHANGE_PID&cmd=true', 'Command', 'POST', BuscaElementosForm('Change_PID'));">
</form>
</blockquote>
<div id="Command"></div>