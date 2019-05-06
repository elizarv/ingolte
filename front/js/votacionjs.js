var cedula;

function cargarPlanchas(cedula){
    cargaContenido('remp','front/views/votar.html');
    enviar("",'back/controller/lista/ListaListByFecha.php',postCargarVotacionPlanchas);
}

function postCargarVotacionPlanchas(result, state){
	 if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){
         	var str ="";
         	for(var i=2; i < Object.keys(json).length; i++) {
                var lista = json[i];
                str += '<div class="col-lg-1 hovereffect"><div class="card"><div class="card-body">';
                str += '<a href="javascript:preVotar('+lista.numero+')"><button type="button" class="btn btn-primary">'
                str += lista.numero+'</button></a></div></div></div></div></div>';
            }
            str += '<div class="col-lg-2 hovereffect"><div class="card"><div class="card-body">';
            str += '<a href="javascript:preVotar(\'0\')"><button type="button" class="btn btn-primary">'
            str += 'Voto en Blanco</button></a></div></div></div></div></div>';
            document.getElementById("contenedor").innerHTML+=str;
         }else{
               swal("El representante no se encuentra registrado!\nPor favor registrelo.", {
                   icon: "error",
                 });
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
            formData = {cc:cedula, numero:num};
            enviar(formData,'back/controller/registro_voto/Registro_votoUpdate.php',postVotar);
            
		  }
		});
}


function postVotar(result, state){
        swal("Su voto ha sido registrado", {
		      icon: "success",
		    });
        window.location.href = 'votaciones.html';
}


function preVotante(idForm){
    if(validarForm(idForm)){
    var formData=$('#'+idForm).serialize();
    enviar(formData,'back/controller/registro_voto/VotanteSelect.php',postVotante);
    }else{
        alert("Debe llenar los campos requeridos");
    }
}

function postVotante(result, state){
    if(state=="success"){
        var json=JSON.parse(result);
         if(json[0].msg=="exito"){
                var accionista = json[1];
                cedula = accionista.cedula;
                swal({
                  title: '¿Es usted?',
                  text: 'Nombre: '+accionista.nombre+'\nCedula: '+accionista.cedula,
                  icon: 'warning',
                  buttons: ["Cancelar", "Si, soy yo"],
                  dangerMode: true
                }).then((sure) => {
                  if (sure) {
                    cargarPlanchas(cedula);
                  }else{
                    window.location.href = 'votaciones.html';
                  }
                });       
         }else if(json[0].msg=="Error"){
            swal("Usted no se encuentra registrado.", {
                   icon: "error",
                 });

         }else{
            swal("Su voto ya ha sido registrado anteriormente", {
                   icon: "error",
                 });
         }
         
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}


