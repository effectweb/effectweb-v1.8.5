<div class="col2">
        	<h4 class="heading col">Informa&ccedil;&otilde;es</h4>
			 <blockquote>
			 <ul class="ul">
			   <li>&raquo; Nome: <b>{Server_Name}</b></li>
			   <li>&raquo; Vers&atilde;o: <b>{@_Info#Version}</b></li>
			   <li>&raquo; Experi&ecirc;ncia: <b>{@_Info#Xp}</b></li>
			   <li>&raquo; Drop: <b>{@_Info#Drop}</b></li>
			   <li>&raquo; Bug Bless: <b>{Bug_Bless}</b></li>
			   <li>&raquo; Tipo de Reset: <b>{Reset_Type}</b></li>
			   <li>&raquo; Reset Free: <b>{Reset_Free}</b></li>
			   <li>&raquo; Reset {VIP_Name#1}: <b>{Reset_VIP-1}</b></li>
			   <li>&raquo; Reset {VIP_Name#2}: <b>{Reset_VIP-2}</b></li>
			   <li>&raquo; Total de Contas: <b>{Accounts}</b></li>
			   <li>&raquo; Total de Personagens: <b>{Characters}</b></li>
			   <li>&raquo; Total de Guilds: <b>{Guilds}</b></li>
			   <li>&raquo; Total de Contas {VIP_Name#1}: <b>{VIP-1}</b></li>
			   <li>&raquo; Total de Contas {VIP_Name#2}: <b>{VIP-2}</b></li>
               <?php
			   if(constant("VIP_Number") >= 3)
			   {
			   ?>
               <li>&raquo; Total de Contas {VIP_Name#3}: <b>{VIP-3}</b></li>
               <?php
			   }
			   if(constant("VIP_Number") >= 4)
			   {
			   ?>
               <li>&raquo; Total de Contas {VIP_Name#4}: <b>{VIP-4}</b></li>
               <?php
			   }
			   if(constant("VIP_Number") == 5)
			   {
			   ?>
               <li>&raquo; Total de Contas {VIP_Name#5}: <b>{VIP-5}</b></li>
               <? } ?>
			   <li>&raquo; Contas Banidas: <b>{Acc_Ban}</b></li>
			   <li>&raquo; Personagens Banidos: <b>{Char_Ban}</b></li>
			   <li>&raquo; Personagens PK: <b>{Char_PK}</b></li>
			   <li>&raquo; Personagen Herois: <b>{Char_Hero}</b></li>
			   <li>&raquo; Servidor: <b>{Server}</b></li>
			   <li>&raquo; Horario: <b>{Server_Time}</b></li>
               <?php
			   if(constant("Status_Enable") > 0)
			   {
			   ?>
				   <li>&raquo; Status: <b>{Status}</b></li>
			   <? } ?>
			   <li>&raquo; Players Online: <b>{Online}</b></li>
			   <li>&raquo; Record Online: <b>{Record}</b></li>
			 </ul>
			 </blockquote>	   