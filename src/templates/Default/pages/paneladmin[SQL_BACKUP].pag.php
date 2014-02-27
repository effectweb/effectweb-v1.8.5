<h4 class="heading colr"> Efetuar Backups</h4>
	<blockquote>
<form name="SQL_Backup" id="SQL_Backup">
<table width="452" border="0">
  <tr>
    <td>DataBase:</td>
    <td><select name="DataBase" id="DataBase">
	{DataBase_List}
	</select>
	</td>
  </tr>
  <tr>
    <td>Nome do Arquivo:</td>
    <td><input type="text" name="File_Name" id="File_Name" value="{File_Date}" /></td></td>
  </tr>
  <tr>
    <td>Diretorio:</td>
    <td><input type="text" name="Directory" id="Directory" value="C:/Backups/" /></td></td>
  </tr>
      <tr>
        <td align="center" colspan="41"><input type="button" value="Efetuar aBackup" onclick="CTM_Load('?pag=paneladmin&str=SQL_BACKUP&cmd=true','Command','POST',BuscaElementosForm('SQL_Backup'));" /></td>
      </tr>
</table>
</form>
</blockquote>
<div id="Command"></div>