<h4>Editar arquivo</h4>
	   <blockquote>
	   <form name="Edit_File" id="Edit_File">
<table width="417" border="0">
  <tr>
    <td width="181">Nome:</td>
    <td width="226"><input type="text" name="Name" id="Name" value="{File_Name}" /></td>
  </tr>
  <tr>
    <td width="181">Link:</td>
    <td width="226"><input type="text" name="Link" id="Link" value="{File_Link}" /></td>
  </tr>
  <tr>
    <td width="181">Descri&ccedil;&atilde;o:</td>
    <td width="226"><input type="text" name="Description" id="Description" value="{File_Desc}" /></td>
  </tr>
  <tr>
    <td width="181">Tamanho:</td>
    <td width="226"><input type="text" name="File_Size" id="File_Size" value="{File_Size}" /></td>
  </tr>
</table>
<input type="button" value="Editar Arquivo" onclick="CTM_Load('?pag=paneladmin&str=EDIT_FILE&exec=true&id={File_ID}','Command','POST',BuscaElementosForm('Edit_File'));" />
</form>
	</blockquote>
	<div id="Command"></div>