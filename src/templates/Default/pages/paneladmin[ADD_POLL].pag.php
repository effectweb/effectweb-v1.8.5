	   <blockquote>
	   <form name="Add_Poll" id="Add_Poll">
<table width="417" border="0">
  <tr>
    <td width="181">Pergunta:</td>
    <td width="226"><input type="text" name="Question" id="Question" /></td>
  </tr>
  <tr>
    <td width="181">Expira&ccedil;&atilde;o (Dias):</td>
    <td width="226"><input type="text" name="Exp_Hour" id="Exp_Hour" size="3" onKeyPress="return NumbersOnly(event);" value="Hora" /><input type="text" name="Exp_Minute" id="Exp_Minute" size="3" onKeyPress="return NumbersOnly(event);" value="Minuto" /><input type="text" name="Exp_Day" id="Exp_Day" size="3" onKeyPress="return NumbersOnly(event);" value="Dia" /><input type="text" name="Exp_Month" id="Exp_Month" size="3" onKeyPress="return NumbersOnly(event);" value="M&ecirc;s" /><input type="text" name="Exp_Year" id="Exp_Year" size="3" onKeyPress="return NumbersOnly(event);" value="Ano" /></td>
  </tr>
  {%Answer_Values%}
</table>
<input type="button" value="Adicionar Enquete" onclick="CTM_Load('?pag=paneladmin&str=ADD_POLL&cmd=true&num={%Numbers%}','Command','POST',BuscaElementosForm('Add_Poll'));" />
</form>
	</blockquote>
	<div id="Command"></div>