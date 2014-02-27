<h4 class="heading colr">Editar CronTab</h4>
	   <blockquote>
	   <form name="Edit_CronTab" id="Edit_CronTab">
						<table width="426" border="0">
                         <tr>
  						  <td width="269">Tarefa:</td>
   						  <td width="147"><select name="CronTab" id="CronTab" onchange="Check_CronTab();">
                          <option value="1" {Check_CronTab#1}>Sitronizar VIP</option>
                          <option value="2" {Check_CronTab#2}>Sitronizar Chars Banidos</option>
                          <option value="3" {Check_CronTab#3}>Sitronizar Contas Banidas</option>
                          <option value="4" {Check_CronTab#4}>Sortear Jogador Online</option>
                          </select></td>
  						</tr>
                        <tr>
  						  <td width="269">Moeda a Receber:</td>
   						  <td width="147"><select name="Moeda" id="Moeda">
   						 <option value="1"{Check_Coin#1}>{Coin_1}</option>
						 <?php if(constant("Coin_Number") >= 2) { ?> <option value="2"{Check_Coin#2}>{Coin_2}</option>
   						 <?php } if(constant("Coin_Number") == 3) { ?> <option value="3"{Check_Coin#3}>{Coin_3}</option> <?php } ?>
    					 </select></td>
  						</tr>
                         <tr>
  						  <td width="269">Quantidade a Receber:</td>
   						  <td width="147"><input type="text" name="Number" id="Number" onkeypress="return NumbersOnly(event);"  disabled="disabled" value="{CronTab_Number}" /></td>
  						</tr>
 						<tr>
    						<td>N&uacute;mero de horas para executar o CronTab:</td>
    						<td><input type="text" name="Hours" id="Hours" onkeypress="return NumbersOnly(event);" value="{CronTab_Hours}" />	</td>
 						 </tr>
 						 <tr>
   							<td>N&uacute;mero de minutos para executar o CronTab:</td>
    						<td><input type="text" name="Minutes" id="Minutes" onkeypress="return NumbersOnly(event);" value="{CronTab_Minutes}" /></td>
  						</tr>
				</table>
				<input type="button" value="Editar CronTab" onClick="CTM_Load('?pag=paneladmin&str=EDIT_CRONTAB&cmd=true&id={CronTab_ID}','Command','POST',BuscaElementosForm('Edit_CronTab'));">
				</form>

	</blockquote>
	<div id="Command"></div>