<h4 class="heading colr">Resetar Personagem ({Reset_Mode})</h4>
	   <blockquote>
        <strong class="colr">Requerimentos para Resetar:</strong><br>
  <br>
  Level: <strong>{Reset_Level}</strong><br>
  Zen Requerido: <strong>{Reset_Money}</strong><br>
  <br>
  <strong class="colr">Status antes do Reset:</strong><br>
  <br>
  Resets: <strong>{Char_Resets}</strong><br>
  Level: <strong>{Char_Level}</strong><br>
  Pontos: <strong>{Char_Points}</strong><br>
  <?php
  global $_Panel;
  
  if($_Panel["Char"]["Reset"]["General"]["Mode"] == 2)
  {
  ?>
  For&ccedil;a: <strong>{Char_Strength}</strong><br />
  Agilidade: <strong>{Char_Dexterity}</strong><br />
  Vitalidade: <strong>{Char_Vitality}</strong><br />
  Energia: <strong>{Char_Energy}</strong><br />
  {Char_Command}
  <? } ?>
  Classe: <strong>{Char_Class}</strong><br>
  Zen: <strong>{Char_Money}</strong><br><br />
<strong class="colr">Status apos o Reset:</strong><br>
  <br>
  Resets: <strong>{Reseted_Resets}</strong><br>
  Level: <strong>{Reseted_Level}</strong><br>
  Pontos: <strong>{Reseted_Points}</strong><br>
  <?php
  global $_Panel;
  
  if($_Panel["Char"]["Reset"]["General"]["Mode"] == 2)
  {
  ?>
  For&ccedil;a: <strong>{Reseted_Strength}</strong><br />
  Agilidade: <strong>{Reseted_Dexterity}</strong><br />
  Vitalidade: <strong>{Reseted_Vitality}</strong><br />
  Energia: <strong>{Reseted_Energy}</strong><br />
  {Reseted_Command}
  <? } ?>
  Classe: <strong>{Reseted_Class}</strong><br>
  Zen: <strong>{Reseted_Money}</strong><br>
Skills Limpas: <strong>{Clear_Skills}</strong><br>
Inventorio Limpo: <strong>{Clear_Inventory}</strong><br>
Quests Resetadas: <strong>{Clear_Quests}</strong><br>
<br /><b class="colr">Deseja Resetar seu personagem?</b><Br /><br /><input type="button" value="Resetar Personagem" onclick="CTM_Load('?pag=paneluser&str=RESET_CHAR&cmd=true','Command','GET');" />
</blockquote>
<div id="Command"></div>