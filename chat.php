    <input type="text" id="msg"><button >Enviar</button>
    <div id="caja"></div>
    <script type="text/javascript">
    	(function() {
    		chat = {
    			addMsg: function(obj){
    				if (obj.msg) {
    					let caja = $('#caja')[0];
	    				let p = document.createElement("p");
	    				let i = document.createElement("i");
	    				p.setAttribute('style', 'color: '+obj.color+';');
	    				i.setAttribute('style', 'color: black;');
	    				i.innerHTML = obj.msg;
	    				let b = document.createElement("b")
        				b.innerHTML = obj.nom+': ';
	    				p.insertBefore( i, p.lastChild);
	    				p.insertBefore( b, p.firstChild);
	    				caja.insertBefore(p, caja.firstChild);
    				}
    				
    			},
    			enviar: function(){
    				let msg =  $("#msg").val(); 
    				$("#msg").val('');
    				ws.send('{"to":"<?php echo $sala.'chat'; ?>", "msg": "'+msg+'", "color": "<?php echo $color?>", "nom": "<?php echo $nombre?>"}');
    			},
    			end: function(){
    				if(confirm("Sin Conexion :( | volver a unirse?")){
    					chat.soket();
    				} else {
    					$('button')[0].setAttribute('disabled', '');
    					$('#chat')[0].setAttribute('disabled', '');
    					let element = $('#chat')[0];
    					element.parentNode.removeChild(element);
    				}
				},
    			soket: function() {
					ws = new WebSocket("ws://achex.ca:4010");
					ws.onopen = function() {
						ws.send('{"setID":"<?php echo $sala.'chat'; ?>","passwd":"123@Cuatro"}');
					}
					ws.onclose = function(){
						chat.end();
					}
					ws.onmessage= function(e){
						let datos = e.data;
						let objeto = jQuery.parseJSON(datos);
						if(objeto.auth != 'ok') chat.addMsg(objeto);
					}
				},
				main: function(){
					let element = $('form')[0];
					element.parentNode.removeChild(element);
					$('#caja')[0].setAttribute('style', 'height: 60vh; overflow-y: scroll; background: gray;');
					
					chat.soket();
				}
    		} 
    		$('button').click(function() {
    			// body...
    			chat.enviar();
    		});
    		window.addEventListener("load", chat.main);
    	})();
    	
    </script>
