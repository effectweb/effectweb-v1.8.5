	   <blockquote>
	   <form name="Manage_Account" id="Manage_Account">
<table width="417" border="0">
  <tr>
    <td width="181">Conta:</td>
    <td width="226"><input type="text" disabled="disabled" value="{Account_ID}" /></td>
  </tr>
  <tr>
    <td width="181">Nome:</td>
    <td width="226"><input type="text" name="Name" id="Name" value="{Account_Name}" /></td>
  </tr>
  <tr>
    <td width="181">E-Mail:</td>
    <td width="226"><input type="text" name="Mail" id="Mail" value="{Account_Mail}" /></td>
  </tr>
  <tr>
    <td width="181">Pergunta Secreta:</td>
    <td width="226"><input type="text" name="Question" id="Question" value="{Account_Question}" /></td>
  </tr>
  <tr>
    <td width="181">Resposta Secreta:</td>
    <td width="226"><input type="text" name="Answer" id="Answer" value="{Account_Answer}" /></td>
  </tr>
  <tr>
    <td width="181">Telefone:</td>
    <td width="226"><input type="text" name="Phone" id="Phone" value="{Account_Phone}" /></td>
  </tr>
  <tr>
    <td width="181">Tipo de Conta:</td>
    <td width="226"><select name="Type" id="Type">
    <option value="0" {Account_Type[0]}>Free</option>
    <option value="1" {Account_Type[1]}>{VIP_Name#1}</option>
    <option value="2" {Account_Type[2]}>{VIP_Name#2}</option>
    <?php
    if(constant("VIP_Number") >= 3)
	{
	?>
    <option value="3" {Account_Type[3]}>{VIP_Name#3}</option>
    <?php
	}
    if(constant("VIP_Number") >= 4)
	{
	?>
    <option value="4" {Account_Type[4]}>{VIP_Name#4}</option>
    <?php
	}
    if(constant("VIP_Number") == 5)
	{
	?>
    <option value="5" {Account_Type[5]}>{VIP_Name#5}</option>
    <? } ?>
    </select>
    </td>
  </tr>
  <tr>
    <td width="181">{Coin_1}:</td>
    <td width="226"><input type="text" name="Coin_1" id="Coin_1" onKeyPress="return NumbersOnly(event)" value="{Account_Coin[1]}" /></td>
  </tr>
  <?php
  if(constant("Coin_Number") >= 2)
  {
  ?>
  <tr>
    <td width="181">{Coin_2}:</td>
    <td width="226"><input type="text" name="Coin_2" id="Coin_2" onKeyPress="return NumbersOnly(event)" value="{Account_Coin[2]}" /></td>
  </tr>
  <?php
  }
  if(constant("Coin_Number") == 3)
  {
  ?>
  <tr>
    <td width="181">{Coin_3}:</td>
    <td width="226"><input type="text" name="Coin_3" id="Coin_3" onKeyPress="return NumbersOnly(event)" value="{Account_Coin[3]}" /></td>
  </tr>
  <? } ?>
  <tr>
    <td width="181">Conta Banida:</td>
    <td width="226"><input type="checkbox" name="Block" id="Block" {Account_Block} /></td>
  </tr>
</table>
<input type="button" value="Editar Conta" onclick="CTM_Load('?pag=paneladmin&str=EDIT_ACC&cmd=true&id={%ACCOUNT_VALUE%}','Command','POST',BuscaElementosForm('Manage_Account'));" />
</form>
	</blockquote>
	<div id="Command"></div>