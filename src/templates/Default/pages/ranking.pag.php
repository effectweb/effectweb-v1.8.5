<div class="col2">
        	<h4 class="heading colr">Ranking</h4>
			<blockquote>
            <form name="Gerate_Ranking" id="Gerate_Ranking">
          <table width="100%" border="0">
  <tr>
      <td width="190"><strong><label>Ranking:</label></strong> &nbsp;&nbsp;<select name="Ranking" id="Ranking">
    <option value="" disabled="disabled" selected="selected">Selecione</option>
    <option value="1">Resets Gerais</option>
    <option value="2">Resets Diarios</option>
    <option value="3">Resets Semanais</option>
    <option value="4">Resets Mensais</option>
    <option value="5">Master Resets</option>
    <option value="6">Guilds</option>
    <option value="7">Top PK</option>
    <option value="8">Top Hero</option>
    <?php
	global $_Ranking;
	if($_Ranking["Gens"]["Enable"] == true)
	{
	?>
    <option value="9">Gens</option>
    <? } ?>
    </select></td>
    <td width="171"><strong><label>Top:</label></strong> &nbsp;&nbsp;<select name="Top_Rank" id="Top_Rank">
    <option value="" disabled="disabled" selected="selected">Selecione</option>
    {TopRank_List}
    </select></td>
    <td width="122"><input type="button" value="Gerar Ranking" onclick="CTM_Load('?pag=ranking&cmd=true','Ranking_Result','POST',BuscaElementosForm('Gerate_Ranking'));"></td>
  </tr>
</table>
</form>
            </blockquote>
            <div id="Ranking_Result">{Ranking_Result}</div>
</div>