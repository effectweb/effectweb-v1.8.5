<h4> Banir Char</h4>
	<blockquote>
<form name="Ban_Char" id="Ban_Char">
<table width="452" border="0">
  <tr>
    <td>Char:</td>
    <td><input type="text" name="Character" id="Character" /></td>
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
<input type="button" value="Banir Char" onclick="CTM_Load('?pag=paneladmin&str=BAN_CHAR&cmd=true','Command','POST',BuscaElementosForm('Ban_Char'));" />
</form>
</blockquote>
<div id="Command"></div>