<h4 class="heading colr">Criar Personagem</h4>
	   <blockquote>
	   <form name="Create_Character" id="Create_Character">
<table width="417" border="0">
  <tr>
    <td width="181">Conta:</td>
    <td width="226"><input type="text" name="Account" id="Account" /></td>
  </tr>
  <tr>
    <td width="181">Nome:</td>
    <td width="226"><input type="text" name="Name" id="Name" /></td>
  </tr>
  <tr>
    <td width="181">Classe:</td>
    <td width="226"><select name="Class" id="Class">
    {%CLASS_LIST%}
    </select>
    </td>
  </tr>
  <tr>
    <td width="181">Level:</td>
    <td width="226"><input type="text" name="Level" id="Level" onKeyPress="return NumbersOnly(event)" value="1" /></td>
  </tr>
  <tr>
    <td width="181">Pontos a Distribuir:</td>
    <td width="226"><input type="text" name="Points" id="Points" onKeyPress="return NumbersOnly(event)" value="0" /></td>
  </tr>
  <tr>
    <td width="181">For&ccedil;a:</td>
    <td width="226"><input type="text" name="Strength" id="Strength" onKeyPress="return NumbersOnly(event)" value="18" /></td>
  </tr>
  <tr>
    <td width="181">Agilidade:</td>
    <td width="226"><input type="text" name="Dexterity" id="Dexterity" onKeyPress="return NumbersOnly(event)" value="18" /></td>
  </tr>
  <tr>
    <td width="181">Vitalidade:</td>
    <td width="226"><input type="text" name="Vitality" id="Vitality" onKeyPress="return NumbersOnly(event)" value="15" /></td>
  </tr>
  <tr>
    <td width="181">Energia:</td>
    <td width="226"><input type="text" name="Energy" id="Energy" onKeyPress="return NumbersOnly(event)" value="30" /></td>
  </tr>
  <tr>
    <td width="181">Zen:</td>
    <td width="226"><input type="text" name="Money" id="Money" onKeyPress="return NumbersOnly(event)" value="30" /></td>
  </tr>
  <tr>
    <td width="181">Posi&ccedil;&atilde;o:</td>
    <td width="226"><select name="CtlCode" id="CtlCode">
    <option value="0">Normal</option>
    <option value="1">Banido</option>
    <option value="{%STAFF_CODE%}">Staff</option>
    </select></td>
  </tr>
</table>
<input type="button" value="Criar Char" onclick="CTM_Load('?pag=paneladmin&str=CREATE_CHAR&cmd=true','Command','POST',BuscaElementosForm('Create_Character'));" />
</form>
	</blockquote>
	<div id="Command"></div>