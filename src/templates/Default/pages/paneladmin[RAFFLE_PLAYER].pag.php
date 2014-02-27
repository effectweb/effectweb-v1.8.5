<h4 class="heading colr">Sortear Jogador</h4>
	   <blockquote>
<form name="Raffle_Player" id="Raffle_Player">
<table border="0">
  <tr>
    <td width="291"><strong>Moeda a ser premiada:</strong></td>
    <td width="204"><select name="Moeda" id="Moeda">
    <option value="" selected="selected" disabled="disabled">Selecione</option>
    <option value="1">{Coin_1}</option>
    <?php
	if(constant("Coin_Number") >= 2) { echo("<option value=\"2\">{Coin_2}</option>"); }
    if(constant("Coin_Number") == 3) { echo("<option value=\"3\">{Coin_3}</option>"); }
	?>
    </select></td>
  </tr>
  <tr>
    <td width="291"><strong>Quantidade a ser Premiado:</strong></td>
    <td width="204"><input type="text" name="Golds" id="Golds" size="5" maxlength="8" /></td>
  </tr>
</table>
<br />
<input type="button" value="Sortear Jogador" onclick="CTM_Load('?pag=paneladmin&str=RAFFLE_PLAYER&cmd=true','Command','POST',BuscaElementosForm('Raffle_Player'));" />
</form>
	</blockquote>
	<div id="Command"></div>