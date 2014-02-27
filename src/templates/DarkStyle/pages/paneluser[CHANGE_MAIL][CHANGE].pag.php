<script type="text/javascript">
function Security_Captcha(div)
{
	document.getElementById(div).src = '{Captcha_Image}&' + Math.random();
}
Security_Captcha('captcha');
</script>
<div class="col2">
<h4>Alterar E-Mail</h4>
	   <blockquote>
<form name="Change_Mail" id="Change_Mail">
<table width="100%" border="0">
  <?php
  if(isset($_GET["code"]) == FALSE)
  {
  ?>
  <tr>
    <td width="213">Codigo de Valida&ccedil;&atilde;o:</td>
    <td width="191"><input type="text" name="Code" id="Code" onKeyUp="this.value = this.value.toLowerCase();" maxlength="32" /
 /></td>
  </tr>
  <? } ?>
  <tr>
    <td width="213">E-Mail Atual:</td>
    <td width="191"><input type="text" name="Old_Mail" id="Old_Mail" /></td>
  </tr>
  <tr>
    <td width="213">Novo E-Mail:</td>
    <td width="191"><input type="text" name="New_Mail" id="New_Mail" /></td>
  </tr>
  <tr>
    <td width="213">Confirmar E-Mail:</td>
    <td width="191"><input type="text" name="Re_Mail" id="Re_Mail" /></td>
  </tr>
  <tr>
    <td>Codigo de Seguran&ccedil;a:</td>
    <td><img src="{Captcha_Image}" style="border:none;" id="captcha" /> <a href="javascript: void(EffectWeb);" onclick="Security_Captcha('captcha');"><img src="images/icons/refresh.png" border="0" title="Atualizar Codigo de Seguran&ccedil;a" /></a></td>
  </tr>
  <tr>
    <td>Confirmar Codigo:</td>
    <td><input type="text" name="Captcha" id="Captcha" onKeyUp="this.value = this.value.toUpperCase();" maxlength="10" /></td>
  </tr>
</table><br /><br />
<b class="colr">Deseja alterar seu E-Mail?</b><br /><br />
<input type="button" value="Alterar E-Mail" onclick="CTM_Load('?pag=paneluser&str=CHANGE_MAIL&run=true{Reset_Link}&cmd=true','Command','POST',BuscaElementosForm('Change_Mail'));" />
	  </form>
	</blockquote>
	<div id="Command"></div>
</div>