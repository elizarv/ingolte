var numero, cc, res;

function cargarOtrasVotaciones(){
	cargaContenido('remp','front/views/votar.html');
	enviar("",'back/controller/otras_votaciones/Otras_votacionesListByFecha.php',postCargarOtrasVotaciones);	
}

function postCargarOtrasVotaciones(result, state){
	 if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){
         	var str ="";
         	for(var i=1; i < Object.keys(json).length; i++) {
                var votacion = json[i];
                str += '<div class="col-lg-3 hovereffect"><div class="card"><div class="card-body">';
                str += '<h4 class="card-title">'+votacion.nombre+'</h4><div class="row "><div class="center">';
                str += '<a href="javascript:cargarVotarOtra('+votacion.id+')"><img src="front/public/img/sino.png">';
                str += '</a></div></div>';
            }
            document.getElementById("contenedor").innerHTML+=str;
         }else{
              alert("Error");
         }
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function cargarVotarOtra(id){
	numero = id;
	cargaContenido('remp','front/views/consultarCedula.html');	
}

function preVotante(idForm){
    if(validarForm(idForm)){
    var formData=$('#'+idForm).serialize();
    enviar(formData,'back/controller/otras_votaciones/VotanteSelect.php',postVotante);
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
                    preVotarOtra(cedula);
                  }else{
                    cargarVotarOtra(numero);
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

function preVotarOtra(cedula){
	cc = cedula;
	cargaContenido('remp','front/views/sino.html');
}

function votar(voto){
	res = voto;
  formData = {cedula:cc, id:numero, voto:res};
	enviar(formData,'back/controller/otros_votos/otros_votosInsert.php',postVotar);
}

function postVotar(result, state){
        swal("Su voto ha sido registrado", {
          icon: "success",
        });
        cargarVotarOtra(numero);
}