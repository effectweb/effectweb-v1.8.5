<script type="text/javascript">
function Security_Captcha(div)
{
	document.getElementById(div).src = '{Captcha_Image}&' + Math.random();
}
Security_Captcha('captcha');
</script>
<div id="Verify" style="display: none;"></div>
<div class="col2">
<h4>Redefinir Senha</h4>
	   <blockquote>
<form name="Reset_Pwd" id="Reset_Pwd">
<table width="414" border="0">
  <?php
  if(isset($_GET["code"]) == FALSE)
  {
  ?>
  <tr>
    <td width="213">Codigo de Valida&ccedil;&atilde;o:</td>
    <td width="191"><input type="text" name="Code" id="Code" onBlur="CTM_Load('?pag=recovery&run=true&cmd=verify&id=code&code='+document.getElementById('Code').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toLowerCase();" maxlength="32" /><span id="CodeResult"></span></td>
  </tr>
  <? } ?>
  <tr>
    <td width="213">Nova Senha:</td>
    <td width="191"><input type="password" name="Password" id="Password" maxlength="10" onKeyUp="PasswordLevel('Password');" /><span id="PasswordResult"></span></td>
  </tr>
  <tr>
    <td width="213">Confirmar Senha:</td>
    <td width="191"><input type="password" name="Re_Password" id="Re_Password" onBlur="CTM_Load('?pag=recovery&run=true&cmd=verify&id=pwd&pwd_1='+document.getElementById('Password').value+'&pwd_2='+document.getElementById('Re_Password').value, 'Verify', 'GET');" maxlength="10" /><span id="Re_PasswordResult"></span></td>
  </tr>
  <tr>
    <td>Codigo de Seguran&ccedil;a:</td>
    <td><img src="{Captcha_Image}" style="border:none;" id="captcha" /> <a href="javascript: void(EffectWeb);" onclick="Security_Captcha('captcha');"><img src="images/icons/refresh.png" border="0" title="Atualizar Codigo de Seguran&ccedil;a" /></a></td>
  </tr>
  <tr>
    <td>Confirmar Codigo:</td>
    <td><input type="text" name="Captcha" id="Captcha" onBlur="CTM_Load('?pag=recovery&run=true&cmd=verify&id=captcha&captcha='+document.getElementById('Captcha').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toUpperCase();" maxlength="10" /><span id="CaptchaResult"></span></td>
  </tr>
</table><br /><br />
<b class="colr">Deseja alterar sua senha?</b><br /><br />
<input type="button" value="Redefinir Senha" onclick="CTM_Load('?pag=recovery&run=true{Reset_Link}&cmd=true','Command','POST',BuscaElementosForm('Reset_Pwd'));" />
	  </form>
	</blockquote>
	<div id="Command"></div>
</div>