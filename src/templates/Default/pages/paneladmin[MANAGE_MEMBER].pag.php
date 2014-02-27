<script language="javascript1.5">
function Delete_Member()
{
	var Check = confirm('Atencao\r\nTem certeza que deseja deletar este membro?');
	if (Check == true)
	{
		CTM_Load('?pag=paneladmin&str=EDIT_MEMBER&cmd=true', 'While', 'POST',BuscaElementosForm('Manage_Members'));
		return true;
	}
}
</script>
<h4 class="heading colr">Gerenciar Membros</h4>
	   <blockquote>
	   <form name="Manage_Members" id="Manage_Members">
		   <strong>Nome:</strong> <select name="Id" id="Id">
		   {Members_List}
           </select>&nbsp;<input type="button" value="Editar" onclick="CTM_Load('?pag=paneladmin&str=EDIT_MEMBER','While','POST',BuscaElementosForm('Manage_Members'));" />&nbsp;<input type="button" value="Deletar Membro" onclick="Delete_Member()" />
		   </form>
	</blockquote>
	<div id="While"></div>