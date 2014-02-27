<form name="Login_Form" id="Login_Form">
				<table width="234" border="0">
 				 <tr>
  				  <td width="54">Login:</td>
   				 <td width="164"><input type="text" name="Log_Account" id="Log_Account" value="{Account}" onKeyUp="this.value = this.value.toLowerCase();" /></td>
 				 </tr>
  				<tr>
   				 <td>Senha:</td>
    				<td><input type="password" name="Log_Password" id="Log_Password" value="{Password}" /></td>
 				 </tr>
				</table>
				<input type="button" value="Logar" onClick="CTM_Load('?ajax=panel&cmd=login','Panel','POST',BuscaElementosForm('Login_Form'));" />
                <br /><br  />
                <a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=recovery','conteudo','GET');">&raquo; Esqueci minha senha!</a>
				{Message}