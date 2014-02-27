	   <blockquote>
	   <form name="Edit_Poll" id="Edit_Poll">
<table width="417" border="0">
  <tr>
    <td width="181">Pergunta:</td>
    <td width="226"><input type="text" name="Question" id="Question" value="{Poll_Question}" /></td>
  </tr>
  <tr>
    <td width="181">Expira&ccedil;&atilde;o (Dias):</td>
    <td width="226"><input type="text" name="Exp_Hour" id="Exp_Hour" size="3" onKeyPress="return NumbersOnly(event);" value="{Poll_Exp#Hour}" /><input type="text" name="Exp_Minute" id="Exp_Minute" size="3" onKeyPress="return NumbersOnly(event);" value="{Poll_Exp#Minute}" /><input type="text" name="Exp_Day" id="Exp_Day" size="3" onKeyPress="return NumbersOnly(event);" value="{Poll_Exp#Day}" /><input type="text" name="Exp_Month" id="Exp_Month" size="3" onKeyPress="return NumbersOnly(event);" value="{Poll_Exp#Month}" /><input type="text" name="Exp_Year" id="Exp_Year" size="3" onKeyPress="return NumbersOnly(event);" value="{Poll_Exp#Year}" /></td>
  </tr>
  <tr>
    <td width="181">Status:</td>
    <td width="226"><input type="checkbox" name="Status" id="Status" {Poll_Status} /> Aberta</td>
  </tr>
  {%Answer_Values%}
</table>
<input type="button" value="Editar Enquete" onclick="CTM_Load('?pag=paneladmin&str=EDIT_POLL&exec=true&num={%Numbers%}&id={Poll_ID}','Command','POST',BuscaElementosForm('Edit_Poll'));" />
</form>
	</blockquote>
	<div id="Command"></div>