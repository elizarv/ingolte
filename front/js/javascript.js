var nombre_rep, cedula_rep, nombre_acc, cedula_acc, acciones_acc;


function function_datatable(){
    var table = $('#myTable').DataTable(
                {
                "language": {
                    "lengthMenu": "Mostrando _MENU_ resultados por pagina",
                    "zeroRecords": "No encontrado",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No disponible",
                    "infoFiltered": "(filtrado de _MAX_ registros)",
                    "search": "Buscar: ",
                    "paginate": {
                        "first":      "Primero",
                        "last":       "Ultimo",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                }
            });
}


function cargarInicio(){
	cargaContenido('remp','front/views/home.html');
	document.getElementById("breadc").innerHTML='<li class="breadcrumb-item"><i class="material-icons">home</i></li>';
	document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Inicio</h2>';
	enviar("",'back/controller/usuario/UsuarioGetLogged.php',postgetLogged);//No me lo toque ( ¬.¬)
}

function cargarRegistroAccionista(){
	cargaContenido('remp','front/views/registrarAccionista.html');
	var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
	str+='<li class="breadcrumb-item">Registrar Accionista</li>';
	document.getElementById("breadc").innerHTML=str;
	document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Agregar Usuario</h2>';
}

function preAccionistaInsert(idForm){
    //Haga aquí las validaciones necesarias antes de enviar el formulario.
   if(validarForm(idForm)){
    var formData=$('#'+idForm).serialize();
    enviar(formData,'back/controller/accionistas/AccionistasInsert.php',postAccionistaInsert);
    }else{
        alert("Debe llenar los campos requeridos");
    }
}

function postAccionistaInsert(result,state){
    //Maneje aquí la respuesta del servidor.
    //Consideramos buena práctica no manejar código HTML antes de este punto.
        if(state=="success"){
                    if(result=="true"){
                       swal("Registro exitoso!", {
                           icon: "success",
                         });
                         cargarInicio();
                    }else{
                       alert("Hubo un errror en la inserción ( u.u)\n"+result);
                    }

       }else{
            alert("Hubo un errror interno ( u.u)\n"+result);
            }
}


function preAccionistaInsert(idForm){
    if(validarForm(idForm)){
    var formData=$('#'+idForm).serialize();
    enviar(formData,'back/controller/accionistas/AccionistasInsert.php',postAccionistaInsert);
    }else{
        alert("Debe llenar los campos requeridos");
    }
}


function preRepresentanteInsert(idForm){
    if(validarForm(idForm)){
        var formData = $('#'+idForm).serialize();
        enviar(formData,'back/controller/Periodo/PeriodoInsert.php',postRepresentanteInsert);
    }
}

function postRepresentanteInsert(result, state){
    if(state=="success"){
                    if(result=="true"){
                       swal("Registro exitoso!", {
                           icon: "success",
                         });
                         cargarInicio();
                    }else if(result == "Error"){
                        swal("Registro Invalido.\nLa suma de acciones a su cargo exceden el limite de 250", {
                           icon: "error",
                         });
                         cargarInicio();
                    }else{
                       alert("Hubo un errror en la inserción ( u.u)\n"+result);
                    }

       }else{
            alert("Hubo un errror interno ( u.u)\n"+result);
            }
}

function cargarRegistroLista(){
    cargaContenido('remp','front/views/registrarLista.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Registrar Accionista</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Agregar Lista</h2>';
}

function preListaInsert(idForm){
    if(validarForm(idForm)){
        var formData = $('#'+idForm).serialize();
        enviar(formData,'back/controller/Candidato/CandidatoInsert.php',postListaInsert);
    }
}

function postListaInsert(result, state){
    if(state=="success"){
                    if(result=="true"){
                       swal("Registro exitoso!", {
                           icon: "success",
                         });
                         cargarInicio();
                    }else{
                       alert("Hubo un errror en la inserción ( u.u)\n"+result);
                    }

       }else{
            alert("Hubo un errror interno ( u.u)\n"+result);
            }
}


function cargarVotanteRegistro(){
    cargaContenido('remp','front/views/registrarVotantes.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Registrar Votante</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Registrar Poder</h2>';
}

function preBuscarDatosVotante(idForm){
    if(validarForm(idForm)){
        var formData = $('#'+idForm).serialize();
        enviar(formData,'back/controller/Accionistas/AccionistaSelect.php',postBuscarDatosVotante);
    }
}

 function postBuscarDatosVotante(result,state){
     if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){
                var accionista = json[1];
                cargarDatosVotante(accionista.cedula, accionista.nombre);
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

function cargarDatosVotante(cedula, nombre){
    cedula_rep = cedula;
    nombre_rep = nombre;
    cargaContenido('remp','front/views/registrarVotantes2.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Registrar Votante</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Registrar Votante</h2>';
    enviar("",'',postCargarDatosVotante);
}


function postCargarDatosVotante(){
    var str = "";
    str += '<h5 class="h5">Nombre: '+nombre_rep+'</h5>';
    str += '<h5 class="h5">CC: '+cedula_rep+'</h5><br>';    
    str +='<input type="hidden" id="cc" name="cc" value="'+cedula_rep+'">';
    document.getElementById("datos").innerHTML = str;
}

function preVotanteInsert(idForm){
    if(validarForm(idForm)){
        var formData = $('#'+idForm).serialize();
        enviar(formData,'back/controller/registro_voto/registro_votoInsert.php',postVotanteInsert);
    }
}

function postVotanteInsert(result,state){
    if(state=="success"){
                    if(result=="true"){
                       swal("Registro exitoso!", {
                           icon: "success",
                         });
                         cargarInicio();
                    }else{
                       alert("Hubo un errror en la inserción ( u.u)\n"+result);
                    }

       }else{
            alert("Hubo un errror interno ( u.u)\n"+result);
            }
}


function cargarSelectAccionista(){
    cargaContenido('remp','front/views/selectAccionista.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Registrar Poder</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Registrar Poder</h2>';
    enviar('','back/controller/periodo/PeriodoList.php',postPeriodoList);
}

function postPeriodoList(result,state){
     //Maneje aquí la respuesta del servidor.
     if(state=="success"){
        var json=JSON.parse(result);
         if(json[0].msg=="exito"){
            for(var i=1; i < Object.keys(json).length; i++) {
                var accionista = json[i];
                //----------------- Para una tabla -----------------------
                str="<tr><td>"+accionista.repre+"</td><td>"+accionista.cedula+"</td><td>"+accionista.nombre+"</td>";
                str+="<td>"+accionista.ccrepre+"</td><td>"+accionista.num+"</td></tr>";
                document.getElementById("AccionistaList").innerHTML+=str;
            }
         }
         function_datatable();
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function preSelectAccionista(idForm){
    if(validarForm(idForm)){
        var formData = $('#'+idForm).serialize();
        enviar(formData,'back/controller/Accionistas/AccionistaSelect.php',postSelectAccionista);
    }
}

 function postSelectAccionista(result,state){
     if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){
                var accionista = json[1];
                cedula_rep = accionista.cedula;
                nombre_rep = accionista.nombre;
                enviar('','',cargarSelectAccionista2);
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

function cargarSelectAccionista2(){
    cargaContenido('remp','front/views/selectAccionista2.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Registrar Poder</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Registrar Poder</h2>';
    enviar('','',cargarDatosRep);
}

function cargarDatosRep(){
    var str="";
    str += '<h5 class="h5">Nombre: '+nombre_rep+'</h5>';
    str += '<h5 class="h5">CC: '+cedula_rep+'</h5><br>';
    document.getElementById("datos").innerHTML = str;
}


function preSelectAccionista2(idForm){
    if(validarForm(idForm)){
        var formData = $('#'+idForm).serialize();
        enviar(formData,'back/controller/Accionistas/AccionistaSelect2.php',postSelectAccionista2);
    }
}

 function postSelectAccionista2(result,state){
     if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){
                var accionista = json[1];
                cedula_acc = accionista.cedula;
                nombre_acc = accionista.nombre;
                acciones_acc = accionista.acciones;
                enviar('','',cargarSelectAccionistaFin);
         }else{
               swal("El accionista no se encuentra registrado!", {
                   icon: "error",
                 });
                 cargarInicio();
         }
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function cargarSelectAccionistaFin(){
    cargaContenido('remp','front/views/registrarRepresentante.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Registrar Poder</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Registrar Poder</h2>';
    enviar("",'',cargarDatosFin);
}

function cargarDatosFin(){
    var str = '<h4>Representante:</h4>';
    str += '<h5 class="h5">Nombre: '+nombre_rep+'</h5>';
    str += '<h5 class="h5">CC: '+cedula_rep+'</h5><br>';
    str += '<h4>Accionista:</h4>';
    str += '<h5 class="h5">Nombre: '+nombre_acc+'</h5>';
    str += '<h5 class="h5">CC: '+cedula_acc+'</h5>';
    str += '<h5 class="h5">Número de acciones: '+acciones_acc+'</h5><br>';
    document.getElementById("datos").innerHTML = str;
    var str ='<input type="hidden" id="cc_rep" name="cc_rep" value="'+cedula_rep+'">';
    str += '<input type="hidden" id="cc_acc"  name="cc_acc" value="'+cedula_acc+'">';
    document.getElementById("datos2").innerHTML = str;
}


function cargarConsultarPoderes(){
    cargaContenido('remp','front/views/consultarPoderes.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Consultar Lista de Poderes</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Consultar Lista de Poderes</h2>';
    enviar('','back/controller/Periodo/PoderList.php',postPeriodoList);
}

function preConsultarPoderes(idForm){
    if(validarForm(idForm)){
        var formData = $('#'+idForm).serialize();
        enviar(formData,'back/controller/Periodo/PeriodoSelect.php',selectPeriodo);
    }
}

function selectPeriodo(result,state){
    if(state=="success"){
        var json=JSON.parse(result);
        if(json[0].msg == "Error"){
            swal("No se encuentran poderes registrados en esa fecha", {
                           icon: "error",
                         });                    
        }else{
            formData={fecha:json[1].fecha};
            enviar(formData,'back/controller/fpdf/reportePoderes.php',postConsultarPoderes);
        }
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function postConsultarPoderes(result,state){
    if(state=="success"){
        location.replace("back/controller/fpdf/pdf/reportePoderes.pdf");   
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

