/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Yo <3 Cúcuta  \\
/** Valida los campos requeridos en un formulario
 * Returns flag Devuelve true si el form cuenta con los datos mínimos requeridos
 */
function validarForm(idForm){
	var form=$('#'+idForm)[0];
	for (var i = 0; i < form.length; i++) {
		var input = form[i];
		if(input.required && input.value==""){
			return false;
		}
	}
	return true;
}

////////// ACCIONISTAS \\\\\\\\\\
function preAccionistasInsert(idForm){
     //Haga aquí las validaciones necesarias antes de enviar el formulario.
	if(validarForm(idForm)){
 	var formData=$('#'+idForm).serialize();
 	enviar(formData,'../back/controller/accionistas/AccionistasInsert.php',postAccionistasInsert);
 	}else{
 		alert("Debe llenar los campos requeridos");
 	}
}

 function postAccionistasInsert(result,state){
     //Maneje aquí la respuesta del servidor.
     //Consideramos buena práctica no manejar código HTML antes de este punto.
 		if(state=="success"){
                     if(result=="true"){            
 			alert("Accionistas registrado con éxito");
                     }else{
                        alert("Hubo un errror en la inserción ( u.u)\n"+result);
                     } 		}else{
 			alert("Hubo un errror interno ( u.u)\n"+result);
 		}
}

function preAccionistasList(container){
     //Solicite información del servidor
     cargaContenido(container,'AccionistasList.html'); 
 	enviar("",'../back/controller/accionistas/AccionistasList.php',postAccionistasList); 
}

 function postAccionistasList(result,state){
     //Maneje aquí la respuesta del servidor.
     if(state=="success"){
        document.getElementById("AccionistasList").innerHTML=result;
     }else{
 		alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

////////// PERIODO \\\\\\\\\\
function prePeriodoInsert(idForm){
     //Haga aquí las validaciones necesarias antes de enviar el formulario.
	if(validarForm(idForm)){
 	var formData=$('#'+idForm).serialize();
 	enviar(formData,'../back/controller/periodo/PeriodoInsert.php',postPeriodoInsert);
 	}else{
 		alert("Debe llenar los campos requeridos");
 	}
}

 function postPeriodoInsert(result,state){
     //Maneje aquí la respuesta del servidor.
     //Consideramos buena práctica no manejar código HTML antes de este punto.
 		if(state=="success"){
                     if(result=="true"){            
 			alert("Periodo registrado con éxito");
                     }else{
                        alert("Hubo un errror en la inserción ( u.u)\n"+result);
                     } 		}else{
 			alert("Hubo un errror interno ( u.u)\n"+result);
 		}
}

function prePeriodoList(container){
     //Solicite información del servidor
     cargaContenido(container,'PeriodoList.html'); 
 	enviar("",'../back/controller/periodo/PeriodoList.php',postPeriodoList); 
}

 function postPeriodoList(result,state){
     //Maneje aquí la respuesta del servidor.
     if(state=="success"){
        document.getElementById("PeriodoList").innerHTML=result;
     }else{
 		alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

//That´s all folks!