function cargarVotacionPlanchas(){
	cargaContenido('remp','front/views/votar.html');
	enviar("",'back/controller/lista/ListaListByFecha.php',postCargarVotacionPlanchas);//No me lo toque ( ¬.¬)
}

function postCargarVotacionPlanchas(result, state){
	 if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){
         	var str ="";
         	for(var i=1; i < Object.keys(json).length; i++) {
                var lista = json[i];
                str += '<div class="col-lg-1 hovereffect"><div class="card"><div class="card-body">';
                str += '<a href="javascript:preVotar('+lista.numero+')"><button type="button" class="btn btn-primary">'
                str += lista.numero+'</button></a></div></div></div></div></div>';
            }
            document.getElementById("contenedor").innerHTML+=str;
         }else{
               swal("El representante no se encuentra registrado!\nPor favor registrelo.", {
                   icon: "error",
                 });
                 cargarInicio();
         }
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}


function preVotar(num){
		swal({
		  title: '¿Está seguro?',
		  icon: 'warning',
		  buttons: ["Cancelar", "Si, estoy seguro"],
		  dangerMode: true
		}).then((sure) => {
		  if (sure) {
		  	formData = {numero:num};
		  	enviar(formData, 'back/controller/registro_voto/Registro_votoUpdate.php', postVotar);
		  }
		});
}


function postVotar(restult, state){
swal("Su voto ha sido registrado", {
		      icon: "success",
		    });
}