<h4 class="heading colr">Adicionar arquivo</h4>
	   <blockquote>
	   <form name="Add_File" id="Add_File">
<table width="417" border="0">
  <tr>
    <td width="181">Nome:</td>
    <td width="226"><input type="text" name="Name" id="Name" /></td>
  </tr>
  <tr>
    <td width="181">Link:</td>
    <td width="226"><input type="text" name="Link" id="Link" /></td>
  </tr>
  <tr>
    <td width="181">Descri&ccedil;&atilde;o:</td>
    <td width="226"><input type="text" name="Description" id="Description" /></td>
  </tr>
  <tr>
    <td width="181">Tamanho:</td>
    <td width="226"><input type="text" name="File_Size" id="File_Size" /></td>
  </tr>
</table>
<input type="button" value="Adicionar Arquivo" onclick="CTM_Load('?pag=paneladmin&str=ADD_FILE&cmd=true','Command','POST',BuscaElementosForm('Add_File'));" />
</form>
	</blockquote>
	<div id="Command"></div>