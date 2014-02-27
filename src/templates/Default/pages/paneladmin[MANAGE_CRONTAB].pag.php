<script language="javascript1.5">
function Delete_CronTab()
{
	var Check = confirm('Atencao\r\nTem certeza que deseja deletar este CronTab?');
	if (Check == true)
	{
		CTM_Load('?pag=paneladmin&str=MANAGE_CRONTAB&cmd=delete', 'While', 'POST',BuscaElementosForm('Manage_CronTab'));
		return true;
	}
}
</script>
<h4 class="heading colr">Gerenciar CronTabs</h4>
	   <blockquote>
       <form name="Manage_CronTab" id="Manage_CronTab">
		   <strong>Noticia:</strong> <select name="Id" id="Id">
           {CronTab_List}
           </select>&nbsp;<input type="button" value="Editar" onclick="CTM_Load('?pag=paneladmin&str=EDIT_CRONTAB','While','POST',BuscaElementosForm('Manage_CronTab'));" />&nbsp;<input type="button" value="Deletar CronTab" onclick="Delete_CronTab()" />
		   </form>
	</blockquote>
	<div id="While"></div>