	function clearText(obj, value) {
		if(obj.value==value)
			obj.value="";
	}
	
	function sendMessage() {
		var name=document.getElementsByName('name')[0];
		var message=document.getElementsByName('message')[0];
		if((message.value=='Сообщение') || (name.value=='Имя') || name.value=='' || message.value=='') {
			alert('Заполните имя/сообщение!');
			return 0;
		}
		
		var xmlhttp = getXmlHttp();
		xmlhttp.open('POST', '?act=chat&method=add', true);
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		
		
		xmlhttp.onreadystatechange =
			function() {
				if (xmlhttp.readyState == 4) {
					if(xmlhttp.status == 200) {
						updateChat();//alert(xmlhttp.responseText);
					}
				}
			};
		
		
		var post_data="name="+encodeURIComponent(name.value)+"&message="+encodeURIComponent(message.value);

		xmlhttp.send(post_data);
		message.value="";
	}
	
	function updateChat() {
		var xmlhttp = getXmlHttp()
		xmlhttp.open('GET', '?act=chat&method=getjson&lastmessage='+lastMessage, true);
		xmlhttp.onreadystatechange =
			function() {
				if (xmlhttp.readyState == 4) {
					if(xmlhttp.status == 200) {
						var messages = eval('(' + xmlhttp.responseText + ')');
						messages=messages.messages; // lol
						if(messages.length==0) return;
						
						var messagesPlace=document.getElementById('messages_id');

						for(var i=0; i<messages.length; i++) {
							messagesPlace.innerHTML=messagesPlace.innerHTML
								+'<b>'+messages[i].name+': </b>'
								+messages[i].text+'<br>';
								
							lastMessage=messages[i].id;
						}
					}
				}
			};
		
		xmlhttp.send(null);
	}
		
	function getXmlHttp(){
		var xmlhttp;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false;
			}
		}
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
	}
