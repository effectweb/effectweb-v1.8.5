<?php
if(constant("Show_News") == true)
{
?>
	<div class="col2">
        	<h4>Not&iacute;cias do Servidor</h4>
            	<blockquote>{Show_News}</blockquote>
        </div>
<?php
}
if(constant("Board_News") == true)
{
?>
	<div class="col2">
        	<h4>Not&iacute;cias do F&oacute;rum</h4>
            	<blockquote>{Board_News}</blockquote>
        </div>
<?php
}
if(constant("Show_Warning") == true)
{
?>
	{%SHOW_WARNING%}
<?php
}
if(constant("Siege_Enable") == true)
{
?>
	<div class="col2">
        	<h4 style="display:none;" class="heading colr">Castle Siege</h4>
            	<div style="background: url(images/siege.jpg) no-repeat center center; height: 120px; position: relative;">
                    <div id="siege" style="position: absolute; top: 49px; left: 370px;"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=search&guild={%CASTLE_SIEGE[LINK]%}','conteudo','GET');">{%CASTLE_SIEGE[OWNER]%}</a></div>
                    <div style="position: absolute; top: 78px; left: 370px; color: #FFFFFF;">{%CASTLE_SIEGE[DATE]%} as {%CASTLE_SIEGE[HOUR]%}</div>
                </div>
        </div>
<?php
}
if(constant("Top_Resets") == true)
{
?>
        <div class="col2">
        	<h4>Top Reset / Master Reset</h4>
            	<blockquote>{Top_Home#Resets_MResets}</blockquote>
        </div>
<?php
}
if(constant("Top_RDayRWeekRMonth") == true)
{
?>
        <div class="col2">
        	<h4>Top Reset Diario / Semanal / Mensal</h4>
            	<blockquote>{Top_Home#RDay_RWeek_RMonth}</blockquote>
        </div>
<?php
}
if(constant("Top_PKHero") == true)
{
?>
        <div class="col2">
        	<h4>Top PK / Hero</h4>
            	<blockquote>{Top_Home#PK_Hero}</blockquote>
        </div>
<?php
}
if(constant("Top_Guilds") == true)
{
?>
        <div class="col2">
        	<h4>Top Guild</h4>
            	<blockquote>{Top_Home#Guilds}</blockquote>
        </div>
		
<?php
}
if(constant("Show_ScreenShots") == true)
{
?>
        <div class="col2">
        	<h4>ScreenShots</h4>
            	<blockquote>{ScreenShots}</blockquote>
        </div>
		
<? } ?>