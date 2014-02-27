<script type="text/javascript">
function Security_Captcha(div)
{
	document.getElementById(div).src = '{Captcha_Image}&' + Math.random();
}
Security_Captcha('captcha');
</script>
<h4>Alterar E-Mail</h4>
	   <blockquote>
<form name="Send_Mail" id="Send_Mail">
<table width="100%" border="0">
  <tr>
    <td>Codigo de Segurança:</td>
    <td><img src="{Captcha_Image}" style="border:none;" id="captcha" /> <a href="javascript: void(EffectWeb);" onclick="Security_Captcha('captcha');"><img src="images/icons/refresh.png" border="0" title="Atualizar Codigo de Seguran&ccedil;a" /></a></td>
  </tr>
  <tr>
    <td>Confirmar Codigo:</td>
    <td><input type="text" name="Captcha" id="Captcha" onKeyUp="this.value = this.value.toUpperCase();" maxlength="10" /><span id="CaptchaResult">&nbsp;</span></td>
  </tr>
</table><br /><br />
<b class="colr">Deseja continuar?</b><br /><br />
<input type="button" value="Continuar" onclick="CTM_Load('?pag=paneluser&str=CHANGE_MAIL&cmd=true','Command','POST',BuscaElementosForm('Send_Mail'));" />
	  </form>
	</blockquote>
	<div id="Command"></div>