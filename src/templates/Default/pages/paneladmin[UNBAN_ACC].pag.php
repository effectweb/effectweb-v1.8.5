<script language="javascript1.5">
function Unban_Account()
{
	var Check = confirm('Atencao\r\nTem certeza que deseja desbanir esta Conta?');
	if (Check == true)
	{
		CTM_Load('?pag=paneladmin&str=UNBAN_ACC&cmd=true', 'Command','POST',BuscaElementosForm('Unban_Acc'));
		return true;
	}
}
</script>
<h4 class="heading colr"> Debanir Conta</h4>
	<blockquote>
<form name="Unban_Acc" id="Unban_Acc">
<table width="452" border="0">
  <tr>
    <td>Conta:</td>
    <td><select name="Account" id="Account">
	<option value="" disabled="disabled" selected="selected">Selecione</option>
    {Accounts_Banned}
	</select>&nbsp;<input type="button" value="Desbanir Conta" onclick="Unban_Account();" /></td>
  </tr>
</table>
</form>
</blockquote>
<div id="Command"></div>