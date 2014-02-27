<h4 class="heading colr"> Banir Conta</h4>
	<blockquote>
<form name="Ban_Acc" id="Ban_Acc">
<table width="452" border="0">
  <tr>
    <td>Conta:</td>
    <td><input type="text" name="Account" id="Account" /></td>
  </tr>
  <tr>
    <td>Tempo:</td>
    <td><input type="text" name="Time" id="Time" onKeyPress="return NumbersOnly(event)" /></td>
  </tr>
  <tr>
    <td>Motivo:</td>
    <td><input type="text" name="Reason" id="Reason" /></td>
  </tr>
</table>
<input type="button" value="Banir Conta" onclick="CTM_Load('?pag=paneladmin&str=BAN_ACC&cmd=true','Command','POST',BuscaElementosForm('Ban_Acc'));" />
</form>
</blockquote>
<div id="Command"></div>