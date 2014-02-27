<div class="col2">
        	<h4 class="heading colr">Cadastro</h4>
			 <blockquote>
			 <form name="Register" id="Register">
<h6 class="colr">Dados da Conta</h6>
<table width="100%" border="0">
  <tr>
    <td width="207">Login:</td>
    <td width="253"><input type="text" name="Account" id="Account" onBlur="CTM_Load('?pag=register&cmd=verify&id=login&account='+document.getElementById('Account').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toLowerCase();" maxlength="10" /><span id="AccountResult"></span></td>
  </tr>
  <tr>
    <td>Senha:</td>
    <td><input type="password" name="Password" id="Password" maxlength="10" onKeyUp="PasswordLevel('Password');" /><span id="PasswordResult"></span></td>
  </tr>
  <tr>
    <td>Confirmar Senha:</td>
    <td><input type="password" name="Re_Password" id="Re_Password" onBlur="CTM_Load('?pag=register&cmd=verify&id=pwd&pwd_1='+document.getElementById('Password').value+'&pwd_2='+document.getElementById('Re_Password').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toLowerCase();" maxlength="10" /><span id="Re_PasswordResult"></span></td>
  </tr>
  <?php if(DEFINEPID_ENABLE) : ?>
  <tr>
    <td width="207">Personal ID:</td>
    <td width="253"><input type="text" name="PID" id="PID" onKeyUp="this.value = this.value.toLowerCase();" onKeyPress="return NumbersOnly(event);" maxlength="7" /></td>
  </tr>
  <?php endif; if(ITEMBONUS_ENABLE) : ?>
  <tr>
    <td><strong style="color: red;">B&ocirc;nus:</strong></td>
    <td><select name="ItemBonus" id="ItemBonus">
    <option value="" selected="selected">Nenhum</option>
    <option value="1">Kit Full SM</option>
    <option value="2">Kit Full BK</option>
    <option value="3">Kit Full FE</option>
    <?php if(GS_Version >= 4) : ?>
    <option value="4">Kit Full SU</option>
    <?php endif; ?>
    <option value="5">Kit Full MG</option>
    <?php if(GS_Version >= 1) : ?>
    <option value="6">Kit Full DL</option>
    <?php endif; if(GS_Version >= 6) : ?>
    <option value="7">Kit Full RF</option>
    <?php endif; ?>
    </select></td>
  </tr>
  <?php endif; ?>
</table>
<h6 class="colr">Detalhes da Conta</h6>
<table width="100%" border="0">
  <tr>
    <td width="416">Nome:</td>
    <td width="431"><input type="text" name="Name" id="Name" maxlength="10" /></td>
  </tr>
  <tr>
    <td>E-Mail:</td>
    <td><input type="text" name="Mail" id="Mail" onBlur="CTM_Load('?pag=register&cmd=verify&id=mail&mail='+document.getElementById('Mail').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toLowerCase();" maxlength="50" /><span id="MailResult"></span></td>
  </tr>
  <tr>
    <td>Confirmar E-Mail:</td>
    <td><input type="text" name="Re_Mail" id="Re_Mail" onBlur="CTM_Load('?pag=register&cmd=verify&id=re_mail&mail_1='+document.getElementById('Mail').value+'&mail_2='+document.getElementById('Re_Mail').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toLowerCase();" maxlength="50" /><span id="Re_MailResult"></span></td>
  </tr>
  <tr>
    <td>Telefone:</td>
    <td><input type="text" name="Phone" id="Phone" maxlength="15" /></td>
  </tr>
  <tr>
    <td>Sexo:</td>
    <td><select name="Sex" id="Sex">
	<option value="Feminino">Feminino</option>
	<option value="Masculino">Masculino</option>
    </select></td>
  </tr>
  <tr>
    <td>Nascimento:</td>
    <td><select name="Date_D" id="Date_D">
    <option value="">Dia</option>
    <option value="01">01</option>
    <option value="02">02</option>
    <option value="03">03</option>
    <option value="04">04</option>
    <option value="05">05</option>
    <option value="06">06</option>
    <option value="07">07</option>
    <option value="08">08</option>
    <option value="09">09</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    <option value="26">26</option>
    <option value="27">27</option>
    <option value="28">28</option>
    <option value="29">29</option>
    <option value="30">30</option>
    <option value="31">31</option>
    </select>&nbsp;
    <select name="Date_M" id="Date_M">
    <option value="">M&ecirc;s</option>
    <option value="01">01</option>
    <option value="02">02</option>
    <option value="03">03</option>
    <option value="04">04</option>
    <option value="05">05</option>
    <option value="06">06</option>
    <option value="07">07</option>
    <option value="08">08</option>
    <option value="09">09</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
	</select>
	&nbsp;<select name="Date_Y" id="Date_Y">
    <option value="">Ano</option>
	<option value="2000">2000</option>
	<option value="1999">1999</option>
	<option value="1998">1998</option>
	<option value="1997">1997</option>
	<option value="1996">1996</option>
	<option value="1995">1995</option>
	<option value="1994">1994</option>
	<option value="1993">1993</option>
    <option value="1992">1992</option>
    <option value="1991">1991</option>
    <option value="1990">1990</option>
    <option value="1989">1989</option>
    <option value="1988">1988</option>
    <option value="1987">1987</option>
    <option value="1986">1986</option>
    <option value="1985">1985</option>
    <option value="1984">1984</option>
    <option value="1983">1983</option>
    <option value="1982">1982</option>
    <option value="1981">1981</option>
	<option value="1980">1980</option>
	<option value="1979">1979</option>
	<option value="1978">1978</option>
	<option value="1977">1977</option>
	<option value="1976">1976</option>
	<option value="1975">1975</option>
	<option value="1974">1974</option>
	<option value="1973">1973</option>
	<option value="1972">1972</option>
	<option value="1971">1971</option>
	<option value="1970">1970</option>
	<option value="1969">1969</option>
	<option value="1968">1968</option>
	<option value="1967">1967</option>
	<option value="1966">1966</option>
	<option value="1965">1965</option>
	<option value="1964">1964</option>
	<option value="1963">1963</option>
	<option value="1962">1962</option>
	<option value="1961">1961</option>
	<option value="1960">1960</option>
	<option value="1959">1959</option>
	<option value="1958">1958</option>
	<option value="1957">1957</option>
	<option value="1956">1956</option>
	<option value="1955">1955</option>
	<option value="1954">1954</option>
	<option value="1953">1953</option>
	<option value="1952">1952</option>
	</select></td>
  </tr>
  <tr>
    <td>Pergunta Secreta:</td>
    <td><select name="Question" id="Question">
    <option value="">Selecione uma Pergunta</option>
    <option value="Nome da sua primeira escola?">Nome da sua primeira escola?</option>
    <option value="Nome do medico do seu parto?">Nome do medico do seu parto?</option>
    <option value="Nascimento da av&oacute;?">Nascimento da av&oacute;?</option>
    <option value="Casamento de seus pais? ex: ##/##/##">Casamento de seus pais? ex: ##/##/##</option>
    <option value="Mulher/Homem que voc&ecirc; ama?">Mulher/Homem que voc&ecirc; ama?</option>
    </select></td>
  </tr>
  <tr>
    <td>Resposta Secreta:</td>
    <td><input type="text" name="Resp" id="Resp" maxlength="50"></td>
  </tr>
  <tr>
    <td>Codigo de Segurança:</td>
    <td><img src="?public=captcha" style="border:none;" id="captcha" /> <a href="javascript: void(EffectWeb);" onclick="Security_Captcha('captcha');"><img src="images/icons/refresh.png" border="0" title="Atualizar Codigo de Seguran&ccedil;a" /></a></td>
  </tr>
  <tr>
    <td>Confirmar Codigo:</td>
    <td><input type="text" name="Captcha" id="Captcha" onBlur="CTM_Load('?pag=register&cmd=verify&id=captcha&captcha='+document.getElementById('Captcha').value, 'Verify', 'GET');" onKeyUp="this.value = this.value.toUpperCase();" maxlength="10" /><span id="CaptchaResult"></span></td>
  </tr>
</table>
<br />
<div align="center"><input type="button" value="Cadastrar Agora" onclick="CTM_Load('?pag=register&cmd=true','Command','POST',BuscaElementosForm('Register'));" /></div>
</form>
<br />
			 </blockquote>
			 <div id="Command"></div>
</div>