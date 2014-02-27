<script type="text/javascript" src="modules/header/javascripts/pagseguro.js"></script>
<h4 class="heading colr">PagSeguro</h4>
			<blockquote>
O PagSeguro &eacute; o meio de pagamento mais completo e eficiente na prote&ccedil;&atilde;o contra fraudes em compras online.<br /><br />
            1. N&atilde;o repassa dados financeiros aos vendedores;<br />
            2. Sua compra entregue ou seu dinheiro de volta.<br />
            
            <br />
            <br />
            <br />
            <strong>Conv&ecirc;nio com os maiores bancos e administradoras:</strong><br /><br />
            
            Para garantir total seguran&ccedil;a e integridade durante as compras e vendas online, todas as opera&ccedil;&otilde;es financeiras s&atilde;o efetuadas em ambiente seguro. Veja os principais bancos e administradoras conveniados:<br />
            <br />
            <form  action="https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx" method="post" target="_blank" id="pagse" name="pagse">
            <input type="hidden" name="email_cobranca" value="{%MAIL_RECEIVER%}">
            <input type="hidden" name="tipo" value="CP">
            <input type="hidden" name="moeda" value="BRL">
            <input type="hidden" name="item_id_1" value="12">
            <input type="hidden" name="item_quant_1" value="1">
            <input type="hidden" name="item_peso_1" value="0">
            <input type="hidden" name="item_descr_1" value="{%USER_LOGIN%}">
            &nbsp;&nbsp;&raquo; Preencha o formulario abaixo:
                    <table width="100%" border="0" cellpadding="5">
              <tr>
                <td align="right"><strong>Valor da contribui&ccedil;&atilde;o:</strong></td>
                <td><input type="text" name="item_valor_1" id="item_valor_1" class="campos" onBlur="if((this.value=='') || (this.value=='0,') || (this.value=='0,0') || (this.value=='0'))this.value='0,00';" onKeyPress="if (event.keyCode &lt; 44 || event.keyCode &gt; 57 ) event.returnValue = false; return ApenasNumeros(event)" onKeyDown="FormataValor(this,event,13,2);" value="0,00"></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input name="contribuir" class="button"
                onclick="retirar('item_valor_1')" type="submit" id="contribuir" value="Efetuar Pagamento" /></td>
              </tr>
                    </table>
                </form>
</blockquote>