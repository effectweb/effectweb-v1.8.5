<h4> Adicionar Membro</h4>
	<blockquote>
<form name="Add_Member" id="Add_Member">
<table width="452" border="0">
  <tr>
    <td>Conta:</td>
    <td><input type="text" name="Account" id="Account" /></td>
  </tr>
  <tr>
    <td>Nome (Char):</td>
    <td><input type="text" name="Name" id="Name" /></td></td>
  </tr>
  <tr>
    <td>Tipo:</td>
    <td><select name="Type" id="Type">
	<option value="1">Game Master</option>
	<option value="2">Sub-Administrador</option>
    <?php
	global $_PanelAdmin;
	
	if(in_array($_SESSION["Hash_Account"], $_PanelAdmin["General"]["Master"]) == true)
	{
		echo("<option value=\"3\">Administrador</option>");
	}
	?>
	</select>
	</td>
  </tr>
  <tr>
    <td>Contato:</td>
    <td><input type="text" name="Contact" id="Contact" /></td></td>
  </tr>
      <tr>
        <td align="center" colspan="41"><input type="button" value="Adicionar Membro" onclick="CTM_Load('?pag=paneladmin&str=ADD_MEMBER&cmd=true','Command','POST',BuscaElementosForm('Add_Member'));" /></td>
      </tr>
</table>
</form>
</blockquote>
<div id="Command"></div>