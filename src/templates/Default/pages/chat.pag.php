<div class="col2">
        	<h4 class="heading colr">Chat {Server_Name}</h4>
			 <blockquote>
             <?php
			 if(@Chat_Enable == false)
			 {
				 exit("<div class=\"info-box\"> O Chat se encontra Desativado</div>");
			 }
			 else
			 {
			 ?>
			 <div align="center">{Chat_Scripts}</div>
             <? } ?>
			 </blockquote>
</div>