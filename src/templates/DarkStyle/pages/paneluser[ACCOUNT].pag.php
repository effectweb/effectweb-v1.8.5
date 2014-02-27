<script type="text/javascript">
function Security_Captcha(div)
{
	document.getElementById(div).src = '{Captcha_Image}&' + Math.random();
}
Security_Captcha('captcha');
</script>

<div id="Verify" style="display: none;"></div>
        	<h4>Editar Dados</h4>
			<blockquote>
            	<form name="Account_Dates" id="Account_Dates">
<table width="425" border="0">
  <tr>
    <td width="186">Nome:</td>
    <td width="229"><input type="text" name="Name" id="Name" value="{Account_Name}" /></td>
  </tr>
  <tr>
    <td>E-Mail:</td>
    <td><input type="text" value="{Account_Mail}" readonly="readonly" /></td>
  </tr>
  <tr>
    <td>Telefone:</td>
    <td><input type="text" name="Phone" id="Phone" value="{Account_Phone}" /></td>
  </tr>
</table>
<input type="button" value="Editar Dados" onclick="CTM_Load('?pag=paneluser&str=ACCOUNT&cmd=account','Command','POST',BuscaElementosForm('Account_Dates'));" />
</form>
</blockquote>
<h4>Alterar Senha</h4>
<blockquote>
            	<form name="Account_Pwd" id="Account_Pwd">
<table width="425" border="0">
  <tr>
    <td>Senha Atual:</td>
    <td><input type="password" name="Old_Password" id="Old_Password" onBlur="CTM_Load('?pag=paneluser&str=ACCOUNT&cmd=old_pwd&pwd='+document.getElementById('Old_Password').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toLowerCase();" maxlength="10" /><span id="Old_PasswordResult"></span></td>
  </tr>
  <tr>
    <td width="186">Nova Senha:</td>
    <td width="229"><input type="password" name="Password" id="Password" maxlength="10" onKeyUp="PasswordLevel('Password');" /><span id="PasswordResult"></span></td>
  </tr>
  <tr>
    <td>Confirmar Nova Senha:</td>
    <td><input type="password" name="Re_Password" id="Re_Password" onBlur="CTM_Load('?pag=paneluser&str=ACCOUNT&cmd=check_pwd&pwd_1='+document.getElementById('Password').value+'&pwd_2='+document.getElementById('Re_Password').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toLowerCase();" maxlength="10" /><span id="Re_PasswordResult"></span></td>
  </tr>
  <tr>
    <td>Codigo de Seguran&ccedil;a:</td>
    <td><img src="{Captcha_Image}" style="border:none;" id="captcha" /> <a href="javascript: void(EffectWeb);" onclick="Security_Captcha('captcha');"><img src="images/icons/refresh.png" border="0" title="Atualizar Codigo de Seguran&ccedil;a" /></a></td>
  </tr>
  <tr>
    <td>Confirmar Codigo:</td>
    <td><input type="text" name="Captcha" id="Captcha" onBlur="CTM_Load('?pag=paneluser&str=ACCOUNT&cmd=check_captcha&captcha='+document.getElementById('Captcha').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toUpperCase();" maxlength="10" /><span id="CaptchaResult">&nbsp;</span></td>
  </tr>
</table>
<input type="button" value="Alterar Senha" onclick="CTM_Load('?pag=paneluser&str=ACCOUNT&cmd=password','Command','POST',BuscaElementosForm('Account_Pwd'));" />
</form>
</blockquote>
<div id="Command"></div>
