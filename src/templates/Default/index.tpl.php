<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Description" content="Effect Web - Powered By: CTM TeaM Softwares" />
<meta name="Keywords" content="MuOnline, Private Servers, Mu, Mu Shock, Shock, CTM, CTM TeaM, MuServer, MuGlobal, MuChina, MuKorea, Mu Servers, Top Servers, Mu Online, Itens, Shop, MuShop, MuOnline Shop" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Erick-Master" />
<meta name="Robots" content="index,follow" />
<title>{%TITLE_WEB%}</title>

<!--
/************************************************************************
	@ JavaScripts
*************************************************************************/
-->

<script type="text/javascript" src="modules/header/javascripts/ajax.js"></script>
<script type="text/javascript" src="modules/header/javascripts/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="templates/{Template_Dir}/modules/javascripts/ddsmoothmenu.js"></script>
<script type="text/javascript" src="templates/{Template_Dir}/modules/javascripts/menu.js"></script>
<script type="text/javascript" src="modules/header/javascripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="modules/header/javascripts/sexyalertbox.v1.2.jquery.js"></script>
<script type="text/javascript" src="modules/header/javascripts/sexy-tooltips.v1.1.jquery.js"></script>
<script type="text/javascript" src="modules/header/javascripts/jquery.lightbox.js"></script>
<script type="text/javascript" src="modules/header/javascripts/SpryTabbedPanels.js"></script>
<script type="text/javascript" src="modules/header/javascripts/functions.js"></script>
<script type="text/javascript">
function Credits()
{
	Sexy.info("<span class=\"h1\">Effect Web {Web_Version}</span><br /><br />Desenvolvido Por: <b>Erick-Master</b><br /><br /><b>CTM TEAM Softwares</b><br /><a target=\"_black\" href=\"http://www.ctmts.com.br\">www.ctmts.com.br</a>");
}
function Record_Gen()
{
	Sexy.info("No dia <b>{Record_Gen#Date}</b> as <b>{Record_Gen#Time}</b>.<br />Nosso Record teve o total de <b class=\"colr\">{Record_Gen#Players}</b> Player(s) Online");
}
function Record_Day()
{
	Sexy.info("Hoje (<b>{Record_Day#Date}</b>) as <b>{Record_Day#Time}</b>.<br />Nosso Record teve o total de <b class=\"colr\">{Record_Day#Players}</b> Player(s) Online");
}
</script>
<!--
/************************************************************************
	@ CSS Style
*************************************************************************/
-->

<style type="text/css">
	@import url("templates/{Template_Dir}/modules/css/Erick-Master.css"); /* Web Style */
	@import url("templates/{Template_Dir}/modules/css/ddsmoothmenu.css"); /* Menu Style */
	@import url("modules/header/css/sexyalertbox.css"); /* SexyAlert Style */
	@import url("modules/header/css/sexy-tooltips.css"); /* Sexy Tooltips Style */
	@import url("modules/header/css/jquery.lightbox.css"); /* jQuery Lightbox Evolution Style */
	@import url("modules/header/css/SpryTabbedPanels.css"); /* Spry Tabbed Panels */
</style>
</head>

<body>
<!--
/************************************************************************
	@ Wrapper
*************************************************************************/
-->

<div id="wrapper_sec">
<!--
/************************************************************************
	@ Header
*************************************************************************/
-->
	<div id="masthead">
    <div id="header"></div>
        <div class="topnav">
        </div>
        <div class="clear"></div>
<!--
/************************************************************************
	@ Menu
*************************************************************************/
-->
        <div id="navigation">
        	<div id="smoothmenu1" class="ddsmoothmenu">
            	<ul>
                    <!-- Home -->
                    <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=home','conteudo','GET'); AutoLoad();">Home</a></li>
                    <!-- Panel -->
                    <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser','conteudo','GET');">Painel</a>
                         <ul>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&option=SELECT_CHAR','conteudo','GET');">Gerenciar Personagem</a></li>
                      	</ul>
                    </li>
                    <!-- Informations -->
                    <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=info','conteudo','GET');">Informa&ccedil;&otilde;es</a>
                         <ul>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=staff','conteudo','GET');">Equipe</a></li>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=terms','conteudo','GET');">Regras / Termos</a></li>
                      	</ul>
                    </li>
                    <!-- Register -->
                    <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=terms&register=true','conteudo','GET');">Cadastro</a></li>
                    <!-- Downloads -->
                    <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=downloads','conteudo','GET');">Downloads</a></li>
                    <!-- Rankings -->
                    <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=ranking','conteudo','GET');">Rankings</a>
                         <ul>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=ranking&rank=resets','conteudo','GET');">Resets Gerais</a></li>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=ranking&rank=resetsday','conteudo','GET');">Resets Diarios</a></li>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=ranking&rank=resetsweek','conteudo','GET');">Resets Semanais</a></li>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=ranking&rank=resetsmonth','conteudo','GET');">Resets Mensais</a></li>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=ranking&rank=mresets','conteudo','GET');">Master Reset</a></li>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=ranking&rank=guild','conteudo','GET');">Guilds</a></li>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=ranking&rank=pk','conteudo','GET');">Top PK</a></li>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=ranking&rank=hero','conteudo','GET');">Top Hero</a></li>
                          <?php
						  global $_Ranking;
						  if($_Ranking["Gens"]["Enable"] == true)
						  {
						  ?>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=ranking&rank=gens','conteudo','GET');">Gens</a></li>
                          <? } ?>
                      	</ul>
                    </li>
                    <!-- Contact -->
                    <li><a href="#" onclick="CTM_Load('?pag=contact','conteudo','GET');">Contato</a>
                    	<ul>
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=contact&type=mail','conteudo','GET');">E-Mail / MSN</a></li>
                          {Menu#Suportt_Phone}
                          <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=contact&type=tickets','conteudo','GET');">Tickets</a></li>
                          {Menu#Suportt_Forum}
                      	</ul>
                    </li>
                    <!-- Extras -->
                    <li><a href="#">Extras</a>
                      <ul>
                    <li><a href="#">Redes Sociais</a>
                    	<ul>
						  <li><a target="_black" href="{Menu#Orkut_Link}">Orkut (Comunidade)</a></li>
						{Menu#Twitter_Link}
                     </ul>
                       </li>
                     {Menu#Chat}
                     {Menu#Raffles}
					 {Menu#Extras}
                      	</ul>
                    </li>
                    <!-- VIP / Golds -->
                    <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=vip-cash','conteudo','GET');">VIPs / {Coin_1}</a></li>
                    <!-- Shop Links -->
                    <li>
                    {Menu#Shops}
					{Menu#Forum}
                </ul>
                <br style="clear: left" />
        	</div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
    <div id="content_sec">
<!--
/************************************************************************
	@ Sidebar
*************************************************************************/
-->
    	<div class="sidebar_start">
        	<!-- Panel -->
            <div class="sidebar">
            	<h3 class="sidebar_head">Painel</h3>
                <div id="Panel">{Div#Panel}</div>
                <div class="clear"></div>
        	</div>
            <!-- Informations -->
            <div class="sidebar">
            	<h3 class="sidebar_head">Informa&ccedil;&otilde;es</h3>
                <ul>
                  <li>&raquo; Nome: <b>{Server_Name}</b></li>
                  <li>&raquo; Vers&atilde;o: <b>{@_Info#Version}</b></li>
                  <li>&raquo; Experi&ecirc;ncia: <b>{@_Info#Xp}</b></li>
                  <li>&raquo; Drop: <b>{@_Info#Drop}</b></li>
                  <li>&raquo; Bug Bless: <b>{@_Info#BugBless}</b></li>
                  <li>&raquo; Tipo de Reset: <b>{@_Info#ResetType}</b></li>
                  <li style="border-bottom: 1px solid #333333;"></li>
                  <li>&raquo; Total de Contas: <b>{@_Info#Accounts}</b></li>
                  <li>&raquo; Total de Personagens: <b>{@_Info#Characters}</b></li>
                  <li>&raquo; Total de Guilds: <b>{@_Info#Guilds}</b></li>
                  <li>&raquo; Contas {VIP_Name#1}: <b>{@_Info#VIP-1}</b></li>
                  <li>&raquo; Contas {VIP_Name#2}: <b>{@_Info#VIP-2}</b></li>
                  <?php if(VIP_Number >= 3) { ?>
                  <li>&raquo; Contas {VIP_Name#3}: <b>{@_Info#VIP-3}</b></li>
                  <?php } if(VIP_Number >= 4) { ?>
                  <li>&raquo; Contas {VIP_Name#4}: <b>{@_Info#VIP-4}</b></li>
                  <?php } if(VIP_Number == 5) { ?>
                  <li>&raquo; Contas {VIP_Name#5}: <b>{@_Info#VIP-5}</b></li>
                  <?php } ?>
                  <li>&raquo; Contas Banidas: <a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=banneds&type=accounts','conteudo','GET');"><b>{@_Info#Acc_Ban}</b></a></li>
                  <li>&raquo; Personagens Banidos: <a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=banneds&type=characters','conteudo','GET');"><b>{@_Info#Char_Ban}</b></a></li>
                  <li>&raquo; Record Online: <a href="javascript: void(EffectWeb);" onclick="Record_Gen(); return false;"><b>{Record_Gen#Players}</b></a></li>
                  <li>&raquo; Record Hoje: <a href="javascript: void(EffectWeb);" onclick="Record_Day(); return false;"><b>{Record_Day#Players}</b></a></li>
                </ul>
                    <div class="clear"></div>
        	</div>
            <!-- Server List -->
            <div class="sidebar">
            	<h3 class="sidebar_head">Servidores</h3>
                <div id="ServerRefresh" style="display: none;"></div>
                <div id="Servers">{Server_List}</div>
                <div class="clear"></div>
        	</div>
            <!-- Web Poll -->
            <div class="sidebar">
            	<h3 class="sidebar_head">Enquete</h3>
                <div id="Web_Poll">{Web_Poll}</div>
                <div class="clear"></div>
        	</div>
            <!-- Staff -->
            <div class="sidebar">
            	<h3 class="sidebar_head">Equipe</h3>
                <div id="StaffList">{Staff_List}</div>
                <div class="clear"></div>
        	</div>
        </div>
<!--
/************************************************************************
	@ Contents
*************************************************************************/
-->
        <div id="conteudo">{%WEB_NAVIGATION%}</div>
    </div>
    <div class="clear"></div>
<!--
/************************************************************************
	@ Footer
*************************************************************************/
-->
    <div id="footer">
    	<div class="rights">
        	<p>Powered by <a href="javascript: void(EffectWeb)" onclick="Credits(); return false;">Erick-Master</a></p>
            <div class="clear"></div>
            <ul>
            	<li class="first">{Footer}</li>
            </ul>
            <p>Copyright &copy; {Year} {Server_Name} - Todos os Direitos Reservados</p>
            {Template_Selector}
        </div>
    </div>
</div>
</body>
</html>