<script type="text/javascript">
function Delete_Char()
{
	var Check = confirm('Atencao\r\nO Comando a seguir irar deletar TOTALMENTE este personagem.\r\nTem certeza que deseja continuar?');
	if (Check == true)
	{
		CTM_Load('?pag=paneladmin&str=DELETE_CHAR&cmd=true','Command','POST',BuscaElementosForm('Delete_Character'));
		return true;
	}
}
</script>
<h4>Deletar Personagem</h4>
	   <blockquote>
	   <form name="Delete_Character" id="Delete_Character">
<table width="417" border="0">
  <tr>
    <td width="181">Char:</td>
    <td width="226"><input type="text" name="Character" id="Character" /></td>
  </tr>
  <tr>
    <td width="181">Deletar Guild caso for Guild Master:</td>
    <td width="226"><input type="checkbox" name="Delete_Guild" id="Delete_Guild" /></td>
  </tr>
</table>
<input type="button" value="Deletar Personagem" onclick="Delete_Char();" />
</form>
	</blockquote>
	<div id="Command"></div>