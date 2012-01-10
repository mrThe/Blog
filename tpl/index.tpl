<?php include("header.tpl");?>

<?php if(isset($data['admin']) and $data['admin']==true) : ?>

        <div id="main">
        
        	<div class="main_top">
            	<h1>Админ-панель
            	
            	<?php if(isset($data['admin']) and $data['admin']==true) : ?>
            	<a style="color:red;" href='?act=auth&method=logout'>[logout]</a>
            	<?endif;?>
            	
            	</h1>
            </div>

           	<div class="main_body">
           	
				<p>
					<form method='POST' enctype='multipart/form-data'>
	
					<div class="table-row">
						<label>Title:</label>
						<input name="title" type="text" maxlength="255"	>
					</div><br>

					
					<div class="table-row">
						<label>Pic:</label>
						<input type="file" name="pic">
					</div><br>
					
					<div class="table-row">
						<label>Text:</label>
						<textarea name="text"  style="width: 500px; height: 200px;"></textarea>
					</div><br>
					
					<div class="table-row">
						<label>Tags:</label>
						<div class="tags">
							|<input type="checkbox" name="tags[]" value="1">tag1 |<input type="checkbox" name="tags[]" value="2">tag2 |<input type="checkbox" name="tags[]" value="3">tag3 |<input type="checkbox" name="tags[]" value="4">tag4  |
						</div>
					</div><br>
					
					<div class="table-row">
					<label>&nbsp;</label>
						<input type="hidden" value="add" name="method">
						<input type="submit" value="Post!">
					</div><br>
							
					</form>
				</p>

            </div>
           	<div class="main_bottom"></div>
            
        </div>


<?endif;?>

<?php

if(isset($data['publications'] )) {
	foreach($data['publications'] as $pub) {
		$id=$pub['id'];
		$title=$pub['title'];
		$text=$pub['text'];
		$tags=$pub['tags'];
		include("post.tpl");
	}
} else echo $data['text'];

include("footer.tpl");
 
?>
