<script type="text/javascript">
function Security_Captcha(div)
{
	document.getElementById(div).src = '{Captcha_Image}&' + Math.random();
}
Security_Captcha('captcha');
</script>
<div id="Verify" style="display: none;"></div>
<h4 class="heading colr">Alterar Nick</h4>
	   <blockquote>
	  Seu Nick atual &eacute; <b>{Manage_Character}</b>.<br /><Br />
<form name="New_Nick" id="New_Nick">
<table width="414" border="0">
  <tr>
    <td width="213">Novo Nick:</td>
    <td width="191"><input type="text" name="Nick" id="Nick" maxlength="10" /></td>
  </tr>
  <tr>
    <td>Codigo de Segurança:</td>
    <td><img src="{Captcha_Image}" style="border:none;" id="captcha" /> <a href="javascript: void(EffectWeb);" onclick="Security_Captcha('captcha');"><img src="images/icons/refresh.png" border="0" title="Atualizar Codigo de Seguran&ccedil;a" /></a></td>
  </tr>
  <tr>
    <td>Confirmar Codigo:</td>
    <td><input type="text" name="Captcha" id="Captcha" onBlur="CTM_Load('?pag=paneluser&str=CHANGE_NICK&cmd=check_captcha&captcha='+document.getElementById('Captcha').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toUpperCase();" maxlength="10" /><span id="CaptchaResult">&nbsp;</span></td>
  </tr>
</table><br /><br />
<b class="colr">Deseja alterar seu Nick?</b><br /><br />
<input type="button" value="Alterar Nick" onclick="CTM_Load('?pag=paneluser&str=CHANGE_NICK&cmd=true','Command','POST',BuscaElementosForm('New_Nick'));" />
	  </form>
	</blockquote>
	<div id="Command"></div>