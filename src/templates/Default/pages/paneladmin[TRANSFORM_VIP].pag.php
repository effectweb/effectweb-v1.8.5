<h4 class="heading colr">Transformar VIP</h4>
	   <blockquote>
	   <form name="Transform_VIP" id="Transform_VIP">
<table width="417" border="0">
  <tr>
    <td width="181">Conta/Char:</td>
    <td width="226"><input type="text" name="Account" id="Account" /></td>
  </tr>
  <tr>
    <td>Tipo:</td>
    <td><select name="Type" id="Type">
     <option value="1">{VIP_Name#1}</option>
    <option value="2">{VIP_Name#2}</option>
    <?php
	if(constant("VIP_Number") >= 3)
	{
	?>
    <option value="3">{VIP_Name#3}</option>
    <?php
	}
	if(constant("VIP_Number") >= 4)
	{
	?>
    <option value="4">{VIP_Name#4}</option>
    <?php
	}
	if(constant("VIP_Number") == 5)
	{
	?>
    <option value="5">{VIP_Name#5}</option>
    <? } ?>
    </select></td>
  </tr>
</table>
<input type="button" value="Transformar VIP" onclick="CTM_Load('?pag=paneladmin&str=TRANSFORM_VIP&cmd=true','Command','POST',BuscaElementosForm('Transform_VIP'));" />
</form>
	</blockquote>
	<div id="Command"></div>