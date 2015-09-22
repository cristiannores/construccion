
$(document).ready(function() {
   
        
        

	
     
});

function enviarMensaje(){
    var form = $("#formulario-contacto").serialize();
    var nombre = $("#nombre").val();
    var correo = $("#correo").val();
    var mensaje = $("#mensaje").val();
   $.ajax({
           url: "/application/contacto/enviar-mensaje",
           type:"POST",
           dataType: "json",
           data: {nombre:nombre,correo:correo,mensaje:mensaje},
           success: function(html){
              
              
              
           }
     });
}