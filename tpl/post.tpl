        <div id="main">
        
        	<div class="main_top">
            	<h1><a href='?act=publications&id=<?=$id?>'><?=$title?></a> 
            	
            	<?php if(isset($data['admin']) and $data['admin']==true) : ?>
            	<a style="color:red;" href='?act=admin&method=delete&id=<?=$id?>'>[del]</a>
            	<?endif;?>
            	
            	</h1>
            </div>

           	<div class="main_body">
				<p><img src="img.php?id=<?=$id?>"></p>
                <p><?=$text?></p>
                <hr><br>
                <p>
                <?php
					foreach($tags as $tag) {
						echo "| <a href='?act=tags&tag={$tag['id']}'>{$tag['name']}</a> | ";
					}
                ?>
                </p>
            </div>
           	<div class="main_bottom"></div>
            
        </div>
