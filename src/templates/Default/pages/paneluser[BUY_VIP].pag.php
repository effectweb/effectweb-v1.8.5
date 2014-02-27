<h4 class="heading colr">Comprar VIP</h4>
			<blockquote>
Seu saldo de {Coin_1} &eacute; <span class="colr">{Number_Amount} {Coin_1}</span><br />
<form name="Buy_VIP" id="Buy_VIP">
<input type="hidden" name="SetValue" id="SetValue" value="0" />
<table width="403" border="0">
  <tr>
    <td width="166"><strong>Tipo de VIP:</strong></td>
    <td width="227"><input type="radio" name="Type" id="Type" value="1" onclick="CTM_Load('?pag=paneluser&str=BUY_VIP&show=1','Show_Time','GET');"> {VIP_Name#1}<br /><input type="radio" name="Type" id="Type" value="2" onclick="CTM_Load('?pag=paneluser&str=BUY_VIP&show=2','Show_Time','GET');"> {VIP_Name#2}
    <?php
    if(constant("VIP_Number") >= 3)
	{
	?>
    <br /><input type="radio" name="Type" id="Type" value="3" onclick="CTM_Load('?pag=paneluser&str=BUY_VIP&show=3','Show_Time','GET');"> {VIP_Name#3}
    <?php
	}
	if(constant("VIP_Number") >= 4)
	{
	?>
    <br /><input type="radio" name="Type" id="Type" value="4" onclick="CTM_Load('?pag=paneluser&str=BUY_VIP&show=4','Show_Time','GET');"> {VIP_Name#4}
    <?php
	}
	if(constant("VIP_Number") == 5)
	{
	?>
    <br /><input type="radio" name="Type" id="Type" value="5" onclick="CTM_Load('?pag=paneluser&str=BUY_VIP&show=5','Show_Time','GET');"> {VIP_Name#5}
    <? } ?>
    </td>
  </tr>
</table>
<div id="Show_Time"></div>
<input type="button" value="Comprar VIP" onClick="CTM_Load('?pag=paneluser&str=BUY_VIP&cmd=true', 'Command', 'POST',BuscaElementosForm('Buy_VIP'));">
</form>
</blockquote>
<div id="Command"></div>