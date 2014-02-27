<div class="col2">
        	<h4 class="heading colr">VIPs / {Coin_1}</h4>
            	<blockquote><div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup" style="font-size: 13px;">
    <li class="TabbedPanelsTab" tabindex="0">O Que &eacute; {Coin_1}?</li>
    <li class="TabbedPanelsTab" tabindex="0">Como Obter {Coin_1}?</li>
	<li class="TabbedPanelsTab" tabindex="0">Pre&ccedil;o de {Coin_1}</li>
	<li class="TabbedPanelsTab" tabindex="0">Dados Bancarios</li>
    <li class="TabbedPanelsTab" tabindex="0">O que &eacute; VIP?</li>
    <li class="TabbedPanelsTab" tabindex="0">Vantagens VIP</li>
    <li class="TabbedPanelsTab" tabindex="0"><a href="javascript: void(EffectWeb)" onclick="CTM_Load('?pag=paneluser&option=BUY_VIP','conteudo','GET');">Comprar VIP</a></li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">{Coin_1} &eacute; uma moeda Virtual usada na compra de Itens, VIPs, ou outros eventos promovidos pelo Servidor.</div>
    <div class="TabbedPanelsContent">Para obter {Coin_1} &eacute; simples:<br /><br />
	<ul>
      <li>&raquo; Efetuando doa&ccedil;&otilde;es em dinheiro para o Servidor<br />
      <li>&raquo; Efetuando Master Reset em seus personagens<br />
      <li>&raquo; Ganhando em eventos promovidos pela Equipe.
	 </ul>
    </div>
	<div class="TabbedPanelsContent">
	  Tabela de Pre&ccedil;os:<br /><br />
	<ul>
	{Coin_Table}
	</ul>
    </div>
	<div class="TabbedPanelsContent">
	  Dados de contas Bancarias:<br /><br />
	<table width="673" border="0">
  <tr>
    <td><strong>Banco:</strong></td>
    <td><strong>Agencia:</strong></td>
    <td><strong>Conta:</strong></td>
    <td><strong>Opera&ccedil;&atilde;o:</strong></td>
    <td><strong>Favorecido:</strong></td>
  </tr>
  {Bank_List}
	</table>
    </div>
    <div class="TabbedPanelsContent">Conta VIP s&atilde;o privilegios que as contas Free n&atilde;o contem.<br />
      Existem {VIP_Number} tipos de contas VIPs:<br />
      <br />
	  <ul>
      <li><b class="red">&raquo; {VIP_Name#1}</b></li>
      <li><b class="colr">&raquo; {VIP_Name#2}</b></li>
      <?php
	  if(constant("VIP_Number") >= 3)
	  {
	  ?>
      <li><b class="colr">&raquo; {VIP_Name#3}</b></li>
      <?php
	  }
	  if(constant("VIP_Number") >= 4)
	  {
	  ?>
      <li><b class="colr">&raquo; {VIP_Name#4}</b></li>
      <?php
	  }
	  if(constant("VIP_Number") == 5)
	  {
	  ?>
      <li><b class="colr">&raquo; {VIP_Name#5}</b></li>
      <? } ?>
	  </ul>
      <br />
      Cada tipo de conta contendo suas vantagens.
    </div>
    <div class="TabbedPanelsContent">
      <table width="100%" border="0">
        <tr>
          <td width="251" class="colr"><b>Servi&ccedil;o:</b></td>
          <td width="125" class="colr"><b>Free:</b></td>
          <td width="170" class="colr"><b>{VIP_Name#1}:</b></td>
          <td width="182" class="colr"><b>{VIP_Name#2}:</b></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td width="183" class="colr"><b>{VIP_Name#3}:</b></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td width="184" class="colr"><b>{VIP_Name#4}:</b></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td width="185" class="colr"><b>{VIP_Name#5}:</b></td>
          <? } ?>
        </tr>
        <?php /* 1.7.12 */ if($GLOBALS['_Panel']['Char']['Reset']['General']['Mode'] < 3) : ?>
        <tr>
          <td>Reset</td>
          <td>{Advantages#Reset_Free}</td>
          <td>{Advantages#Reset_VIP1}</td>
          <td>{Advantages#Reset_VIP2}</td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td>{Advantages#Reset_VIP3}</td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td>{Advantages#Reset_VIP4}</td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td>{Advantages#Reset_VIP5}</td>
          <? } ?>
        </tr>
        <?php /* 1.7.12 */ endif; ?>
        <tr>
          <td>{MReset_Coin} por Master Reset</td>
          <td>{Advantages#MReset_Free}</td>
          <td>{Advantages#MReset_VIP1}</td>
          <td>{Advantages#MReset_VIP2}</td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td>{Advantages#MReset_VIP3}</td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td>{Advantages#MReset_VIP4}</td>
          <?php
		  }
		  if(constant("VIP_Number") >= 5)
		  {
		  ?>
          <td>{Advantages#MReset_VIP5}</td>
          <? } ?>
        </tr>
        <tr>
          <td>Alterar Dados</td>
          <td><img src="images/icons/{Advantages#Date_Free}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Date_VIP1}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Date_VIP2}.png" style="border: none;" /></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Date_VIP3}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Date_VIP4}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 5)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Date_VIP5}.png" style="border: none;" /></td>
          <? } ?>
        </tr>
        <tr>
          <td>Alterar Ba&uacute;</td>
          <td><img src="images/icons/{Advantages#Alt_Vault_Free}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Alt_Vault_VIP1}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Alt_Vault_VIP2}.png" style="border: none;" /></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Alt_Vault_VIP5}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Alt_Vault_VIP4}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Alt_Vault_VIP5}.png" style="border: none;" /></td>
          <? } ?>
        </tr>
        <tr>
          <td>Conex&otilde;es Recentes</td>
          <td><img src="images/icons/{Advantages#Connects_Free}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Connects_VIP1}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Connects_VIP2}.png" style="border: none;" /></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Connects_VIP3}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Connects_VIP4}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Connects_VIP5}.png" style="border: none;" /></td>
          <? } ?>
        </tr>
        <tr>
          <td>Limpar PK/Hero</td>
          <td><img src="images/icons/{Advantages#Clear_PK_Free}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Clear_PK_VIP1}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Clear_PK_VIP2}.png" style="border: none;" /></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Clear_PK_VIP3}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Clear_PK_VIP4}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Clear_PK_VIP5}.png" style="border: none;" /></td>
          <? } ?>
        </tr>
        <tr>
          <td>Alterar Classe</td>
          <td><img src="images/icons/{Advantages#Change_Class_Free}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Change_Class_VIP1}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Change_Class_VIP2}.png" style="border: none;" /></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Change_Class_VIP3}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Change_Class_VIP4}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Change_Class_VIP5}.png" style="border: none;" /></td>
          <? } ?>
        </tr>
        <tr>
          <td>Alterar Nick</td>
          <td><img src="images/icons/{Advantages#Change_Nick_Free}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Change_Nick_VIP1}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Change_Nick_VIP2}.png" style="border: none;" /></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Change_Nick_VIP3}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Change_Nick_VIP4}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Change_Nick_VIP5}.png" style="border: none;" /></td>
          <? } ?>
        </tr>
        <tr>
          <td>Mover Personagem</td>
          <td><img src="images/icons/{Advantages#Move_Char_Free}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Move_Char_VIP1}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Move_Char_VIP2}.png" style="border: none;" /></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Move_Char_VIP3}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Move_Char_VIP4}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Move_Char_VIP5}.png" style="border: none;" /></td>
          <? } ?>
        </tr>
        <tr>
          <td>Gerenciar Perfil</td>
          <td><img src="images/icons/{Advantages#Profile_Char_Free}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Profile_Char_VIP1}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Profile_Char_VIP2}.png" style="border: none;" /></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Profile_Char_VIP3}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Profile_Char_VIP4}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Profile_Char_VIP5}.png" style="border: none;" /></td>
          <? } ?>
        </tr>
        <tr>
          <td>Gerenciar Imagem</td>
          <td><img src="images/icons/{Advantages#Upload_Img_Free}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Upload_Img_VIP1}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Upload_Img_VIP2}.png" style="border: none;" /></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Upload_Img_VIP3}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Upload_Img_VIP4}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Upload_Img_VIP5}.png" style="border: none;" /></td>
          <? } ?>
        </tr>
        <tr>
          <td>Resetar Pontos</td>
          <td><img src="images/icons/{Advantages#Reset_Points_Free}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Reset_Points_VIP1}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Reset_Points_VIP2}.png" style="border: none;" /></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Reset_Points_VIP3}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Reset_Points_VIP4}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Reset_Points_VIP5}.png" style="border: none;" /></td>
          <? } ?>
        </tr>
        <tr>
          <td>Distribuir Pontos</td>
          <td><img src="images/icons/{Advantages#Distribute_Points_Free}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Distribute_Points_VIP1}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Distribute_Points_VIP2}.png" style="border: none;" /></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Distribute_Points_VIP3}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Distribute_Points_VIP4}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Distribute_Points_VIP5}.png" style="border: none;" /></td>
          <? } ?>
        </tr>
        <tr>
          <td>Limpar Personagem</td>
          <td><img src="images/icons/{Advantages#Clear_Char_Free}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Clear_Char_VIP1}.png" style="border: none;" /></td>
          <td><img src="images/icons/{Advantages#Clear_Char_VIP2}.png" style="border: none;" /></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Clear_Char_VIP3}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Clear_Char_VIP4}.png" style="border: none;" /></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td><img src="images/icons/{Advantages#Clear_Char_VIP5}.png" style="border: none;" /></td>
          <? } ?>
        </tr>
      </table>
      <?php /* 1.7.12 */ if($GLOBALS['_Panel']['Char']['Reset']['General']['Mode'] == 3) : ?>
      <h5 class="heading colr">Level para Resetar (Tabelado)</h5>
      <table width="100%" border="0">
        <tr>
          <td width="251" class="colr"><b>Resets:</b></td>
          <td width="125" class="colr"><b>Free:</b></td>
          <td width="170" class="colr"><b>{VIP_Name#1}:</b></td>
          <td width="182" class="colr"><b>{VIP_Name#2}:</b></td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td width="183" class="colr"><b>{VIP_Name#3}:</b></td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td width="184" class="colr"><b>{VIP_Name#4}:</b></td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td width="185" class="colr"><b>{VIP_Name#5}:</b></td>
          <? } ?>
        </tr>
        <tr>
          <td>0-10</td>
          <td>{ResetTable#0-10[Level_Free]}</td>
          <td>{ResetTable#0-10[Level_VIP1]}</td>
          <td>{ResetTable#0-10[Level_VIP2]}</td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td>{ResetTable#0-10[Level_VIP3]}</td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td>{ResetTable#0-10[Level_VIP4]}</td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td>{ResetTable#0-10[Level_VIP5]}</td>
          <? } ?>
        </tr>
        <tr>
          <td>11-50</td>
          <td>{ResetTable#11-50[Level_Free]}</td>
          <td>{ResetTable#11-50[Level_VIP1]}</td>
          <td>{ResetTable#11-50[Level_VIP2]}</td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td>{ResetTable#11-50[Level_VIP3]}</td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td>{ResetTable#11-50[Level_VIP4]}</td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td>{ResetTable#11-50[Level_VIP5]}</td>
          <? } ?>
        </tr>
        <tr>
          <td>51-100</td>
          <td>{ResetTable#51-100[Level_Free]}</td>
          <td>{ResetTable#51-100[Level_VIP1]}</td>
          <td>{ResetTable#51-100[Level_VIP2]}</td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td>{ResetTable#51-100[Level_VIP3]}</td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td>{ResetTable#51-100[Level_VIP4]}</td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td>{ResetTable#51-100[Level_VIP5]}</td>
          <? } ?>
        </tr>
        <tr>
          <td>101-150</td>
          <td>{ResetTable#101-150[Level_Free]}</td>
          <td>{ResetTable#101-150[Level_VIP1]}</td>
          <td>{ResetTable#101-150[Level_VIP2]}</td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td>{ResetTable#101-150[Level_VIP3]}</td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td>{ResetTable#101-150[Level_VIP4]}</td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td>{ResetTable#101-150[Level_VIP5]}</td>
          <? } ?>
        </tr>
        <tr>
          <td>151-200</td>
          <td>{ResetTable#151-200[Level_Free]}</td>
          <td>{ResetTable#151-200[Level_VIP1]}</td>
          <td>{ResetTable#151-200[Level_VIP2]}</td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td>{ResetTable#151-200[Level_VIP3]}</td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td>{ResetTable#151-200[Level_VIP4]}</td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td>{ResetTable#151-200[Level_VIP5]}</td>
          <? } ?>
        </tr>
        <tr>
          <td>201-300</td>
          <td>{ResetTable#201-300[Level_Free]}</td>
          <td>{ResetTable#201-300[Level_VIP1]}</td>
          <td>{ResetTable#201-300[Level_VIP2]}</td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td>{ResetTable#201-300[Level_VIP3]}</td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td>{ResetTable#201-300[Level_VIP4]}</td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td>{ResetTable#201-300[Level_VIP5]}</td>
          <? } ?>
        </tr>
        <tr>
          <td>301-XXX</td>
          <td>{ResetTable#301-XXX[Level_Free]}</td>
          <td>{ResetTable#301-XXX[Level_VIP1]}</td>
          <td>{ResetTable#301-XXX[Level_VIP2]}</td>
          <?php
		  if(constant("VIP_Number") >= 3)
		  {
		  ?>
          <td>{ResetTable#201-300[Level_VIP3]}</td>
          <?php
		  }
		  if(constant("VIP_Number") >= 4)
		  {
		  ?>
          <td>{ResetTable#301-XXX[Level_VIP4]}</td>
          <?php
		  }
		  if(constant("VIP_Number") == 5)
		  {
		  ?>
          <td>{ResetTable#301-XXX[Level_VIP5]}</td>
          <? } ?>
        </tr>
    	</table>
        <?php /* 1.7.12 */ endif; ?>
    </div>
  </div>
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</blockquote>
        </div>