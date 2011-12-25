        <div id="main">
        
        	<div class="main_top">
            	<h1><a href='?act=publications&id=<?=$id?>'><?=$title?></a></h1>
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
