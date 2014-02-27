<div class="col2">
        	<h4>Termos / Regras do {Server_Name}</h4>
			 <blockquote>
             {Terms}
             <?php
			 if($_GET["register"] == true)
			 {
			 ?>
             <br /><br />
				 <center><input type="button" value="Aceito" onclick="CTM_Load('?pag=register','conteudo','GET');" />&nbsp;&nbsp;<input type="button" value="N&atilde;o Aceito" onclick="javascript: window.location='http://www.pollypocket.com.br/';" />
             <? } ?>
             </blockquote>
</div>