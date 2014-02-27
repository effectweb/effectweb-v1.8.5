<h4>Trocar Resets por {%COIN_NAME%}</h4>
			<blockquote>
Resets Atuais de seu Personagem: <span class="colr">{%CHAR_RESETS%}</span> (Sem o bonus de cadastro)<br />
Pre&ccedil;o de cada {%COIN_NAME%} em Resets: <span class="colr">{%COIN_PRICE%}</span><br />
<br />
<form name="Trade_ResetsCash" id="Trade_ResetsCash">
<table width="403" border="0">
  <tr>
    <td width="166"><strong>Quantidade:</strong></td>
    <td width="227"><input type="text" name="Coin" id="Coin" onkeypress="return NumbersOnly(event);" size="6" /></td>
  </tr>
</table>
<input type="button" value="Trocar" onClick="CTM_Load('?pag=paneluser&str=TRADE_RCASH&cmd=true', 'Command', 'POST',BuscaElementosForm('Trade_ResetsCash'));">
</form>
</blockquote>
<div id="Command"></div>