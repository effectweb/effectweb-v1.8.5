<?php
global $CTM_MSSQL, $CTM, $_PanelAdmin, $_RaffleSystem;
$CTM_RaffleSystem = new CTM_RaffleSystem(false);

$Account = $CTM_MSSQL->FetchQuery("SELECT type FROM dbo.{$CTM[0]} WHERE account='".$_SESSION["Hash_Account"]."'");
?>
<div class="col2">
        	<h4 class="heading colr">Painel Administrativo</h4>
            	<table width="100%" border="0" cellspacing="4" cellpadding="4">
  <tr>
    <td width="22%" valign="top">
<div id="paneluser_bar">
<?php
if($Account[0] >= $_PanelAdmin["ManageX"])
{
?>
        <div class="block">
                <h2 class="blockhead">Gerenciamento Geral</h2>
                <div class="blockbody">
                        <ul class="blockrow">
                <?php
				if($Account[0] >= $_PanelAdmin["Manage"]["Sitronize"])
				{
				?>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=SYNCHRONIZE&syntax=VIP','Panel_Nav','GET');">Sincronizar VIP</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=SYNCHRONIZE&syntax=CHAR','Panel_Nav','GET');">Sincronizar Chars Banidos</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=SYNCHRONIZE&syntax=ACC','Panel_Nav','GET');">Sincronizar Conta Banidas</a></li>
				<? } ?>
                        </ul>
                </div>
        </div>
<?php
}
if(in_array($_SESSION["Hash_Account"], $_PanelAdmin["Manage"]["EffectWeb"]) == true)
{
?>
        <div class="block">
                <h2 class="blockhead">Effect Web</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=CHECK_UPDATE','Panel_Nav','GET');">Verificar Atualiza&ccedil;&otilde;es</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="New_License();">Alterar Serial de Licen&ccedil;a</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if(in_array($_SESSION["Hash_Account"], $_PanelAdmin["CronbJob"]["Security"]) == true)
{
?>
        <div class="block">
                <h2 class="blockhead">CronJob</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_CRONTAB','Panel_Nav','GET');">Adicionar CronTab</a></li>
                <li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_CRONTAB','Panel_Nav','GET');">Gerenciar CronTabs</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Mail"])
{
?>
        <div class="block">
                <h2 class="blockhead">E-Mail</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=SEND_MAIL','Panel_Nav','GET');">Enviar E-Mail ao Jogador</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if(in_array($_SESSION["Hash_Account"], $_RaffleSystem["Accounts"]) == true && $_RaffleSystem["Enable"] == true)
{
?>
        <div class="block">
                <h2 class="blockhead">Sistema de Sorteio</h2>
                <div class="blockbody">
                        <ul class="blockrow">
                <?php
				if($CTM_RaffleSystem->Raffle_Panel("Raffle") == true)
				{
				?>
                <li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=RAFFLE_PLAYER','Panel_Nav','GET');">Sortear Jogador</a></li>
				<?php
				}
				if($CTM_RaffleSystem->Raffle_Panel("Clear") == true)
				{
				?>
                <li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=CLEAR_RAFFLES','Panel_Nav','GET');">Limpar Lista de Sorteados</a></li>
                <? } ?>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Warning"])
{
?>
        <div class="block">
                <h2 class="blockhead">Aviso Importante</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_WARNING','Panel_Nav','GET');">Gerenciar Aviso</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="Delete_Warning();">Remover Aviso</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["News"])
{
?>
        <div class="block">
                <h2 class="blockhead">Noticias</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_NEWS','Panel_Nav','GET');">Adicionar Noticias</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_NEWS','Panel_Nav','GET');">Gerenciar Noticias</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["ScreenShots"])
{
?>
        <div class="block">
                <h2 class="blockhead">ScreenShots</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_SCREENSHOTS','Panel_Nav','GET');">Gerenciar ScreenShots</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Downloads"])
{
?>
        <div class="block">
                <h2 class="blockhead">Gerenciar Downloads</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_FILE','Panel_Nav','GET');">Adicionar Arquivo</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_FILES','Panel_Nav','GET');">Gerenciar Arquivos</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Staff"])
{
?>
        <div class="block">
                <h2 class="blockhead">Gerenciar Equipe</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_MEMBER','Panel_Nav','GET');">Adicionar Membro</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_MEMBER','Panel_Nav','GET');">Gerenciar Membros</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Poll"])
{
?>
        <div class="block">
                <h2 class="blockhead">Gerenciar Enquetes</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=POLL_OPT','Panel_Nav','GET');">Adicionar Enquete</a></li>
                <li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_POLL','Panel_Nav','GET');">Gerenciar Enquetes</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Account"])
{
?>
        <div class="block">
                <h2 class="blockhead">Gerenciar Contas</h2>
                <div class="blockbody">
                        <ul class="blockrow">
                 <?php
				 if($Account[0] >= $_PanelAdmin["Accounts"]["Manage"])
				 {
				 ?>
                 <li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_ACC','Panel_Nav','GET');">Gerenciar Conta</a></li>
                 <? } ?>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=BAN_ACC','Panel_Nav','GET');">Banir Conta</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=UNBAN_ACC','Panel_Nav','GET');">Desbanir Conta</a></li>
                <?php
				if(in_array($_SESSION["Hash_Account"], $_PanelAdmin["General"]["Master"]) === true)
				{
				?>
					<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=DELETE_ACC','Panel_Nav','GET');">Deletar Conta</a></li>
               <? } ?>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Character"])
{
?>
        <div class="block">
                <h2 class="blockhead">Gerenciar Chars</h2>
                <div class="blockbody">
                        <ul class="blockrow">
                  <?php
				 if($Account[0] >= $_PanelAdmin["Characters"]["Create"])
				 {
				 ?>
                 <li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=CREATE_CHAR','Panel_Nav','GET');">Criar Personagem</a></li>
                 <?php
				 }
				 if($Account[0] >= $_PanelAdmin["Characters"]["Manage"])
				 {
				 ?>
                 <li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_CHAR','Panel_Nav','GET');">Editar Personagem</a></li>
                 <? } ?>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=BAN_CHAR','Panel_Nav','GET');">Banir Char</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=UNBAN_CHAR','Panel_Nav','GET');">Desbanir Char</a></li>
                <?php
				if(in_array($_SESSION["Hash_Account"], $_PanelAdmin["General"]["Master"]) === true)
				{
				?>
					<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=DELETE_CHAR','Panel_Nav','GET');">Deletar Personagem</a></li>
               <? } ?>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Reference"])
{
?>
        <div class="block">
                <h2 class="blockhead">Refer&ecirc;ncia</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=SHOW_REFERENCE','Panel_Nav','GET');">Ranking</a></li>
                <li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=RESET_REFERENCE','Panel_Nav','GET');">Resetar</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Tickets"])
{
?>
        <div class="block">
                <h2 class="blockhead">Suporte</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=TICKETS','Panel_Nav','GET');">Tickets de Suporte</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Payments"])
{
?>
        <div class="block">
                <h2 class="blockhead">Financeiro</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=PAYMENTS','Panel_Nav','GET');">Gerenciar Pagamentos</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["VIP"])
{
?>
        <div class="block">
                <h2 class="blockhead">Gerenciar VIP</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_VIP','Panel_Nav','GET');">Adicionar VIP</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=TRANSFORM_VIP','Panel_Nav','GET');">Transformar VIP</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=DELETE_VIP','Panel_Nav','GET');">Remover VIP</a></li>
                <?php
                if($Account[0] >= $_PanelAdmin["VIP"])
				{
				?>
                <li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_VIP_ALL','Panel_Nav','GET');">Adicionar todas as Contas</a></li>
                <? } ?>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Cash"])
{
?>
        <div class="block">
                <h2 class="blockhead">Gerenciar Moedas</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_CASH','Panel_Nav','GET');">Adicionar Moeda</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=DELETE_CASH','Panel_Nav','GET');">Remover Moeda</a></li>
                        </ul>
                </div>
        </div>
<?php
}
if($Account[0] >= $_PanelAdmin["SQL"])
{
?>
        <div class="block">
                <h2 class="blockhead">Gerenciar MSSQL</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=SQL_BACKUP','Panel_Nav','GET');">Efetuar Backups</a></li>
                        </ul>
                </div>
        </div>
<? } ?>
</div></td>
       <td id="Panel_Nav" valign="top">
	   {Panel_Navigator}
	   </td>
  </tr>
</table>
</blockquote></td>
  </tr>
</table>
        </div>