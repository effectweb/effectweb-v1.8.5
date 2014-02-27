<div class="col2">
<h4 class="heading colr">Confirmar Cadastro</h4>
	   <blockquote>
<form name="Confirm_Register" id="Confirm_Register">
<table width="414" border="0">
  <tr>
    <td width="213">Codigo de Valida&ccedil;&atilde;o:</td>
    <td width="191"><input type="text" name="Code" id="Code" onBlur="CTM_Load('?pag=register&run=true&cmd=verify&id=code&code='+document.getElementById('Code').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toLowerCase();" maxlength="32" /><span id="CodeResult"></span></td>
  </tr>
  <tr>
    <td>Codigo de Seguran&ccedil;a:</td>
    <td><img src="{Captcha_Image}" style="border:none;" id="captcha" /> <a href="javascript: void(EffectWeb);" onclick="Security_Captcha('captcha');"><img src="images/icons/refresh.png" border="0" title="Atualizar Codigo de Seguran&ccedil;a" /></a></td>
  </tr>
  <tr>
    <td>Confirmar Codigo:</td>
    <td><input type="text" name="Captcha" id="Captcha" onBlur="CTM_Load('?pag=register&run=true&cmd=verify&id=captcha&captcha='+document.getElementById('Captcha').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toUpperCase();" maxlength="10" /><span id="CaptchaResult"></span></td>
  </tr>
</table><br /><br />
<b class="colr">Deseja confirmar o seu cadastro?</b><br /><br />
<input type="button" value="Confirmar Cadastro" onclick="CTM_Load('?pag=register&run=true&cmd=true','Command','POST',BuscaElementosForm('Confirm_Register'));" />
	  </form>
	</blockquote>
	<div id="Command"></div>
</div>