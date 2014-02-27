<h4>Adicionar Enquete</h4>
	   <blockquote>
	   <form name="Poll_Options" id="Poll_Options">
<table width="417" border="0">
  <tr>
    <td width="181">Numero de Respostas:</td>
    <td width="226"><input type="text" name="Answer_Number" id="Answer_Number" onKeyPress="return NumbersOnly(event);" /></td>
  </tr>
</table>
<input type="button" value="Continuar..." onclick="CTM_Load('?pag=paneladmin&str=ADD_POLL','Show_Options','POST',BuscaElementosForm('Poll_Options'));" />
</form>
	</blockquote>
	<div id="Show_Options"></div>