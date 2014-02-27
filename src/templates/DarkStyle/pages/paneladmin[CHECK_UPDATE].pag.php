<h4>Verificar Atualiza&ccedil;&otilde;es</h4>
	   <blockquote>
	   Existe uma nova atualiza&ccedil;&atilde;o:<br />
       <br />
       <ul style="list-style: none;">
       	<li>&raquo; Vers&atilde;o atual: {Web_Version}</li>
        <li>&raquo; Nova Vers&atilde;o: <b class="colr">{%UPDATE[New_Version]%}</b></li>
        <li>&raquo; Release Date: <b>{%UPDATE[Release_Date]%}</b></li>
       </ul>
     <br />
     <h2>Base ChangeLog:</h2>
     <blockquote>
     {%UPDATE[ChangeLog]%}
     </blockquote>
     
    <input type="button" value="ChangeLog Completo" onclick="window.open('{%UPDATE[Link_ChangeLog]%}', 'windowname1'); return false;" />&nbsp;<input type="button" value="Mais Informa&ccedil;&otilde;es" onclick="window.open('{%UPDATE[Link_Topic]%}', 'windowname2'); return false;" />
	</blockquote>