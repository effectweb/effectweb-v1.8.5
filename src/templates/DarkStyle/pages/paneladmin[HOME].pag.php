<h4>Informa&ccedil;&otilde;es</h4>
	   <blockquote>
	   <div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup" style="font-size: 13px;">
    <li class="TabbedPanelsTab" tabindex="0">Informa&ccedil;&otilde;es da Hospedagem</li>
    <li class="TabbedPanelsTab" tabindex="0">Informa&ccedil;&otilde;es do Servidor</li>
	<li class="TabbedPanelsTab" tabindex="0">Informa&ccedil;&otilde;es do Site</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
	<table width="362" border="0">
  <tr>
    <td>&raquo; Sistema Operacional:</td>
    <td><strong>{Operation_System}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Nome do Servidor:</td>
    <td><strong>{Computer_Name}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Software do Servidor:</td>
    <td><strong>{Server_Software}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Adminitrador do Servidor:</td>
    <td><strong>{Server_Admin}</strong></td>
  </tr>
  <tr>
    <td>&raquo; IP do Servidor:</td>
    <td><strong>{Server_Addr}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Porta do Servidor:</td>
    <td><strong>{Server_Port}</strong></td>
  </tr>
  </table>
  </div>
    <div class="TabbedPanelsContent">
	<table width="362" border="0">
  <tr>
    <td>&raquo; Total de Contas:</td>
    <td><strong>{Info_Accounts}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Total de contas {VIP_Name#1}:</td>
    <td><strong>{Info_VIP-1}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Total de contas {VIP_Name#2}:</td>
    <td><strong>{Info_VIP-2}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Total de Personagens:</td>
    <td><strong>{Info_Characters}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Personagens Banidos:</td>
    <td><strong>{Info_Char-Ban}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Contas Banidas:</td>
    <td><strong>{Info_Acc-Ban}</strong></td>
  </tr>
  <?php
  if(constant("Status_Enable") == true)
  {
  ?>
  <tr>
    <td>&raquo; Status do Servidor:</td>
    <td><strong>{Info_Status}</strong></td>
  </tr>
  <? } ?>
  </table>
  </div>
	<div class="TabbedPanelsContent">
	          <table width="400" border="0" style="font-size: 12px;">
  <tr>
    <td>Nome:</td>
    <td><b>{EffectWeb_Name}</b></td>
  </tr>
  <tr>
    <td>Vers&atilde;o Atual:</td>
    <td><b>{EffectWeb_Version}</b></td>
  </tr>
  <tr>
    <td>Vers&atilde;o Recente:</td>
    <td><b>{EffectWeb_Update}</b></td>
  </tr>
  <tr>
    <td>Desenvolvedor:</td>
    <td><b class="red">{Developer_Name}</b></td>
  </tr>
  <tr>
    <td>Titular da Licen&ccedil;a:</td>
    <td><b>{EffectWeb_Holder}</b></td>
  </tr>
  <tr>
    <td>Dom&iacute;nio Licenciado:</td>
    <td><b><a href="javascript: void(EffectWeb);" onclick="Serial();return false;">{EffectWeb_Domain}</a></b></td>
  </tr>
  <tr>
    <td>Tipo de Licen&ccedil;a:</td>
    <td><b>{EffectWeb_License}</b></td>
  </tr>
  <tr>
    <td>Vencimento:</td>
    <td><b>{EffectWeb_Expiration}</b></td>
  </tr>
  </table>
  <br />
  <strong class="colr">Contato com o Desenvolvedor:</strong><br />
  <br />
  <table width="400" border="0" style="font-size: 12px;">
  <tr>
    <td>E-Mail/MSN:</td>
    <td><b>{Developer_Mail}</b></td>
  </tr>
  <tr>
    <td>Skype:</td>
    <td><b>{Developer_Skype}</b></td>
  </tr>
  <tr>
    <td>Telefone:</td>
    <td><b>{Developer_Phone}</b></td>
  </tr>
  <tr>
    <td width="205">Site:</td>
    <td width="337"><b><a target="_blank" href="http://{Developer_Page}">{Developer_Page}</a></b></td>
  </tr>
</table>
<br />
<input type="button" value="ChangeLog da Web" onclick="window.open('http://changelog.ctmts.com.br/?id=03', 'windowname1'); return false;">
    </div>
  </div>
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
	</blockquote>