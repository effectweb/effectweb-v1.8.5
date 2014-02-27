<ul>
	<li>&raquo; Bem Vindo: <b>{Memb_Name}</b></li>
	<li>&raquo; Tipo de Conta: <b>{Memb_Type}</b></li>
	<li>&raquo; {Coin_1}: <b>{Memb_Amount[1]}</b></li>
    <?php if(Coin_Number >= 2) { ?>
    <li>&raquo; {Coin_2}: <b>{Memb_Amount[2]}</b></li>
    <?php } if(Coin_Number == 3) { ?>
    <li>&raquo; {Coin_3}: <b>{Memb_Amount[3]}</b></li>
    <?php } ?>
	<li style="border-bottom: 1px solid #333333;"></li>
    <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser','conteudo','GET');">&raquo; Painel de Controle</a></li>
    {PanelAdmin_Link}
    <li><a href="?exec=logout">&raquo; Deslogar</a></li>
</ul>