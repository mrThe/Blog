        <div id="main">
        
        	<div class="main_top">
            	<h1>Чат</h1>
            </div>

           	<div class="main_body">
				<p id="messages_id">
				<?php
					foreach($data['messages'] as $message) {
							echo "<b>".$message['name'].": </b>".$message['text']."<br>";
					}?>
				</p>
				<hr>
				
				<script type="text/javascript" src="js/chat.js"></script>
				<script>
				var lastMessage=<?=$data['lastmessageid'][0]['max'];?>; //global
				setInterval('updateChat()', 10000);
				</script>
				
				<p>
					<form method="POST">
						<input type='text' name='name' style="width:100px" value="Имя" onClick="clearText(this, 'Имя');" onBlur="if(this.value=='')this.value='Имя'">
						<input type='text' name='message'  style="width:770px"  value="Сообщение" onClick="clearText(this, 'Сообщение');" onBlur="if(this.value=='')this.value='Сообщение'">
						<input type='button' value='Add!'  style="width:875px" onClick="sendMessage();">
						<input type="hidden" value="add" name="method">
					</form>
				</p>

            </div>
           	<div class="main_bottom"></div>
            
        </div>
