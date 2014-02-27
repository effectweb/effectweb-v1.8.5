<h4>Minha Conta</h4>
	   <blockquote>
	   <table border="0">
  <tr>
    <td width="218">ID:</td>
    <td width="321"><strong>{Memb#Id}</strong></td>
  </tr>
  <tr>
    <td>Conta:</td>
    <td><strong>{Memb#Account}</strong></td>
  </tr>
  <tr>
    <td>Saldo de {Coin_1}:</td>
    <td><strong>{Memb#Coin_1}</strong></td>
  </tr>
  <?php
  if(constant("Coin_Number") >= 2)
  {
  ?>
  <tr>
    <td>Saldo de {Coin_2}:</td>
    <td><strong>{Memb#Coin_2}</strong></td>
  </tr>
  <?php
  }
  if(constant("Coin_Number") == 3)
  {
  ?>
  <tr>
    <td>Saldo de {Coin_3}:</td>
    <td><strong>{Memb#Coin_3}</strong></td>
  </tr>
  <? } ?>
  <tr>
    <td>Condi&ccedil;&atilde;o:</td>
    <td><strong>{Memb#Type}</strong></td>
  </tr>
  <tr>
    <td>Inicio:</td>
    <td><strong>{Memb#VIP_Begin}</strong></td>
  </tr>
  <tr>
    <td>Termino:</td>
    <td><strong>{Memb#VIP_End}</strong></td>
  </tr>
  <tr>
    <td>Data de Nascimento:</td>
    <td><strong>{Memb#Birth}</strong></td>
  </tr>
</table>
	</blockquote>