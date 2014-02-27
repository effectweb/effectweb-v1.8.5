<h4 class="heading colr">Limpar Personagem</h4>
	   <blockquote>
        <span class="red">Aten&ccedil;&atilde;o: Este comando n&atilde;o poderar ser disfeito, os itens selecionados abaixo ser&atilde;o removidos literalmente!</span><br /><Br />
		<b class="colr">Selecione o que deve ser removido</b><br /><Br />
		<form name="Clear_Char" id="Clear_Char">
		<table width="225" border="0">
  <tr>
    <td width="161">Invent&aacute;rio</td>
    <td width="54"><input type="checkbox" name="Inventory" id="Inventory" /></td>
  </tr>
  <tr>
    <td>Skills</td>
    <td><input type="checkbox" name="Skills" id="Skills" /></td>
  </tr>
  <tr>
    <td>Zen</td>
    <td><input type="checkbox" name="Money" id="Money" /></td>
  </tr>
  <tr>
    <td>Quests</td>
    <td><input type="checkbox" name="Quests" id="Quests" /></td>
  </tr>
</table><Br />
		<input type="button" value="Executar Comando" onclick="CTM_Load('?pag=paneluser&str=CLEAR_CHAR&cmd=true','Command','POST',BuscaElementosForm('Clear_Char'));" />
		</form>
	</blockquote>
	<div id="Command"></div>