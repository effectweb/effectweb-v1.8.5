<h4>Distribuir Pontos</h4>
	   <blockquote>
	   <B class="colr">Seu Status atual &eacute;:</b><br /><br />
	   &raquo; Pontos a Distribuir: <b>{Char_Points}</b><br />
	   &raquo; For&ccedil;a: <b>{Char_Strength}</b><br />
	   &raquo; Agilidade: <b>{Char_Dexterity}</b><br />
	   &raquo; Vitalidade: <b>{Char_Vitality}</b><br />
	   &raquo; Energia: <b>{Char_Energy}</b><br />
       {Char_Command}
       <br />
	   <b class="colr">Distribua seus Pontos</b><Br /><br />
        <form name="Distribute_Points" id="Distribute_Points">
<table width="365" border="0">
  <tr>
    <td width="162">Força:</td>
    <td width="193"><input type="text" name="Strength" id="Strength" onKeyPress="return NumbersOnly(event)" maxlength="5" /></td>
  </tr>
  <tr>
    <td>Agilidade:</td>
    <td><input type="text" name="Dexterity" id="Dexterity" onKeyPress="return NumbersOnly(event)" maxlength="5" /></td>
  </tr>
  <tr>
    <td>Vitalidade:</td>
    <td><input type="text" name="Vitality" id="Vitality" onKeyPress="return NumbersOnly(event)" maxlength="5" /></td>
  </tr>
  <tr>
    <td>Energia:</td>
    <td><input type="text" name="Energy" id="Energy" onKeyPress="return NumbersOnly(event)" maxlength="5" /></td>
  </tr>
  {Command_Input}
</table><br />
<input type="button" value="Distribuir Pontos" onClick="CTM_Load('?pag=paneluser&str=DISTRIBUTE_POINTS&cmd=true','Command','POST',BuscaElementosForm('Distribute_Points'));" />
</form>
	</blockquote>
	<div id="Command"></div>