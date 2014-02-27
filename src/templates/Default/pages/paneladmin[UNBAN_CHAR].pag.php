<script language="javascript1.5">
function Unban_Character()
{
	var Check = confirm('Atencao\r\nTem certeza que deseja desbanir este Char?');
	if (Check == true)
	{
		CTM_Load('?pag=paneladmin&str=UNBAN_CHAR&cmd=true', 'Command','POST',BuscaElementosForm('Unban_Char'));
		return true;
	}
}
</script>
<h4 class="heading colr"> Debanir Char</h4>
	<blockquote>
<form name="Unban_Char" id="Unban_Char">
<table width="452" border="0">
  <tr>
    <td>Char:</td>
    <td><select name="Character" id="Character">
	<option value="" disabled="disabled" selected="selected">Selecione</option>
    {Characters_Banned}
	</select>&nbsp;<input type="button" value="Desbanir Char" onclick="Unban_Character();" /></td>
  </tr>
</table>
</form>
</blockquote>
<div id="Command"></div>