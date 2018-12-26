
function notif_close(){
  $(".notificacion").removeClass("show");
 
}
var timeoutHandle;
function show_notif(tipo, mensaje){
	/*
	tipo = SUCCESS || WARNING || ERROR || WAITING
	*/

  window.clearTimeout(timeoutHandle);

  //$(".notificacion").addClass(tipo);
  $(".notificacion").addClass("show");

  $(".notificacion").on('click', function(){
    $(this).removeClass("show");
  });

  timeoutHandle =  setTimeout(function(){
    $(".notificacion").removeClass("show");    
  }, 5000);

  $("#mensaje_notificacion").html(mensaje);
  

}

function cierra_dialogo_notificacion(){
  $(".notificacion").removeClass("show");
}
function notif_update_tipo(n_tipo){
	$(".notificacion").removeClass("SUCCESS");
	$(".notificacion").removeClass("WARNING");
	$(".notificacion").removeClass("ERROR");
	$(".notificacion").removeClass("WAITING");
	$(".notificacion").addClass(n_tipo);
}
function notif_update_timeout(){
	timeoutHandle =  setTimeout(function(){
	    $(".notificacion").removeClass("show");    
	  }, 5000);
}

/*

<!-- notificacion_normal -->
 
<div class="notificacion">
	<div id="cuerpo_notificacion">
		<div class="mensaje valign-wrapper">
			<p class="valign" id="mensaje_notificacion"></p>
		</div>
		<a href="Javascript:notif_close();" style="    position: absolute; top: 2px; right: 0px; color: #fff;"><i class="fa fa-times"></i></a>
	</div>
</div>
*/

