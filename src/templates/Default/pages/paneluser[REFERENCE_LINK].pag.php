<h4 class="heading colr">Link de Refer&ecirc;ncia</h4>
			<blockquote>
O link de refer&ecirc;ncia serve para voc&ecirc; ajudar o servidor divulgando para seus amigos e pela internet.<br /><br />
<?php if(WITH_ACCOUNT_LINK < 1) : ?>
<b class="colr">Deseja gerar o seu link de refer&ecirc;ncia?</b><br /><br />
<input type="button" value="Gerar Link" onclick="CTM_Load('?pag=paneluser&str=REFERENCE_LINK&cmd=true','Command','GET');" />
<div id="Command"></div>
<?php else : ?>
<b class="colr">Status da Refer&ecirc;ncia:</b><br />
<table width="100%" border="0">
	<tr>
    	<td>N&uacute;mero de Clicks:</td>
        <td class="colr">{REFERENCE[ACCESS_COUNT]}</td>
    </tr>
    <tr>
    	<td>N&uacute;mero de Registros:</td>
        <td class="colr">{REFERENCE[REGISTER_COUNT]}</td>
    </tr>
    <tr>
    	<td>Pontos:</td>
        <td class="colr">{REFERENCE[POINTS]}</td>
    </tr>
</table>
<br /><strong>Link de Refer&ecirc;ncia:</strong> <input type="text" name="Link" id="Link" value="{REFERENCE[LINK]}" size="50" readonly="readonly" onclick="highlight(this);" />
<?php endif; ?>
</blockquote>