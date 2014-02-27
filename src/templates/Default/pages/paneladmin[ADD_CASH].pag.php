<h4 class="heading colr">Adicionar Moeda</h4>
	   <blockquote>
	   <form name="Add_Cash" id="Add_Cash">
<table width="417" border="0">
  <tr>
    <td width="181">Conta/Char:</td>
    <td width="226"><input type="text" name="Account" id="Account" /></td>
  </tr>
  <tr>
    <td>Moeda:</td>
    <td><select name="Coin" id="Coin">
    <option value="" disabled="disabled" selected="selected">Selecione</option>
    <option value="1">{Coin_1}</option>
    <?php
    if(constant("Coin_Number") >= 2)
	{
	?>
    <option value="2">{Coin_2}</option>
    <?php
	}
	if(constant("Coin_Number") == 3)
	{
	?>
    <option value="3">{Coin_3}</option>
    <? } ?>
    </select></td>
  </tr>
  <tr>
    <td>Quantidade:</td>
    <td><input type="text" name="Cash" id="Cash" onKeyPress="return NumbersOnly(event)" /></td>
  </tr>
</table>
<input type="button" value="Adicionar Moeda" onclick="CTM_Load('?pag=paneladmin&str=ADD_CASH&cmd=true','Command','POST',BuscaElementosForm('Add_Cash'));" />
</form>
	</blockquote>
	<div id="Command"></div>