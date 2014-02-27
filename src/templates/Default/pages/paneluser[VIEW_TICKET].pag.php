<script language="javascript1.5">
function Close_Ticket()
{
	var Check = confirm('AtencaornTem certeza que deseja fechar este Ticket?');
	if (Check == true)
	{
		CTM_Load('?pag=paneluser&str=VIEW_TICKET&exec=true&id={Ticket_ID}', 'Close_Ticket', 'GET');
		return true;
	}
}
</script>
<h4 class="heading colr">Ticket {Ticket_Title}</h4>
	<blockquote>
	<table border="0">
 			 <tr>
   			 <td width="135"><img src="{Ticket_Char#Image}" width="120" height="120" style="border: 1px solid #B3B3B3;" class="image" /></td>
   			 <td width="493"><table border="0">
				 <tr>
       			 <td><blockquote>Postado por: <b class="colr">{Ticket_Character}</b> em <b class="colr">{Ticket_Date}</b> as <b class="colr">{Ticket_Time}</b><br />Departamento: <b class="colr=">{Ticket_Departament}</b><br />Status: {Ticket_Status}</blockquote></td>
				 </tr>
				 <tr>
       			 <td><blockquote>{Ticket_Text}</blockquote></td>
				 </tr>
    			</table>
				</td>
  			</tr>
			</table>
		</blockquote>
        {Resp_List}
        <div id="Comment_Form">{Comment_Form}</div>