<h4> Editar Membro</h4>
	<blockquote>
<form name="Edit_Member" id="Edit_Member">
<table width="452" border="0">
  <tr>
    <td>Conta:</td>
    <td><input type="text" name="Account" id="Account" value="{Member_Account}" /></td>
  </tr>
  <tr>
    <td>Nome (Char):</td>
    <td><input type="text" name="Name" id="Name" value="{Member_Name}" /></td></td>
  </tr>
  <tr>
    <td>Tipo:</td>
    <td><select name="Type" id="Type">
	<option {Check_Type#1}value="1">Game Master</option>
	<option {Check_Type#2}value="2">Sub-Administrador</option>
    <?php
	global $_PanelAdmin;
	
	if(in_array($_SESSION["Hash_Account"], $_PanelAdmin["General"]["Master"]) == true)
	{
	?>
	<option {Check_Type#3}value="3">Administrador</option>
	<? } ?>
	</select>
	</td>
  </tr>
  <tr>
    <td>Contato:</td>
    <td><input type="text" name="Contact" id="Contact" value="{Member_Contact}" /></td></td>
  </tr>
      <tr>
        <td align="center" colspan="41"><input type="button" value="Editar Membro" onclick="CTM_Load('?pag=paneladmin&str=EDIT_MEMBER&exec=true&id={Member_ID}','Command','POST',BuscaElementosForm('Edit_Member'));" /></td>
      </tr>
</table>
</form>
</blockquote>
<div id="Command"></div>