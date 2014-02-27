<form name="Login_Form" id="Login_Form">
<p>
        <label>Login:</label>
        <input type="text" name="Log_Account" id="Log_Account" value="{Account}" size="20" maxlength="12" />
    </p>
    <p>
        <label>Senha:</label>
        <input type="password" name="Log_Password" id="Log_Password" value="{Password}" size="20" maxlength="12" />
    </p>
    <p>
        <input type="button" value="Logar" onClick="CTM_Load('?ajax=panel&cmd=login','Panel','POST',BuscaElementosForm('Login_Form'));" />
        {Message}
    </p>
    <p>
    	<a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=recovery','conteudo','GET');">&raquo; Esqueci minha senha!</a>
    </p>
</form>