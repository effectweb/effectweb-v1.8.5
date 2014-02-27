<h4>Adicionar CronTab</h4>
	   <blockquote>
	   <form name="Add_CronTab" id="Add_CronTab">
						<table width="426" border="0">
                         <tr>
  						  <td width="269">Tarefa:</td>
   						  <td width="147"><select name="CronTab" id="CronTab" onchange="Check_CronTab();">
                          <option value="1">Sitronizar VIP</option>
                          <option value="2">Sitronizar Chars Banidos</option>
                          <option value="3">Sitronizar Contas Banidas</option>
                          <option value="4">Sortear Jogador Online</option>
                          </select></td>
  						</tr>
                         <tr>
  						  <td width="269">Moeda a Receber:</td>
   						  <td width="147"><select name="Moeda" id="Moeda">
    					 <option value="" selected="selected" disabled="disabled">Selecione</option>
   						 <option value="1">{Coin_1}</option>
    					 <?php
						 if(constant("Coin_Number") >= 2) { echo("<option value=\"2\">{Coin_2}</option>"); }
   						 if(constant("Coin_Number") == 3) { echo("<option value=\"3\">{Coin_3}</option>"); }
						 ?>
    					 </select></td>
  						</tr>
                        <tr>
  						  <td width="269">Quantidade a Receber:</td>
   						  <td width="147"><input type="text" name="Number" id="Number" onkeypress="return NumbersOnly(event);"  disabled="disabled" /></td>
  						</tr>
  						<tr>
    						<td>N&uacute;mero de horas para executar o CronTab:</td>
    						<td><input type="text" name="Hours" id="Hours" onkeypress="return NumbersOnly(event);" value="1" />	</td>
 						 </tr>
 						 <tr>
   							<td>N&uacute;mero de minutos para executar o CronTab:</td>
    						<td><input type="text" name="Minutes" id="Minutes" onkeypress="return NumbersOnly(event);" value="0" /></td>
  						</tr>
				</table>
				<input type="button" value="Adicionar CronTab" onClick="CTM_Load('?pag=paneladmin&str=ADD_CRONTAB&cmd=true','Command','POST',BuscaElementosForm('Add_CronTab'));">
				</form>

	</blockquote>
	<div id="Command"></div>