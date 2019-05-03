//var nombre_rep, cedula_rep, nombre_acc, cedula_acc, acciones_acc;


function function_datatable(){
    $('#myTable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
    } );
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
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
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
                    }else if(result=="Ya"){
                        swal("Ya se encuentra registrado", {
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
    str+='<li class="breadcrumb-item">Registrar Candidato</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Agregar Candidato de lista de votación</h2>';
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
                document.getElementById("nombre_rep").value=accionista.nombre;
                document.getElementById("cedula_rep").value=accionista.cedula;
                cargarDatosVotante();
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

function cargarDatosVotante(){
    cargaContenido('remp','front/views/registrarVotantes2.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Registrar Votante</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Registrar Votante</h2>';
    enviar('','',postCargarDatosVotante);
}


function postCargarDatosVotante(){
    var str = "";
    str += '<h5 class="h5">Nombre: '+document.getElementById("nombre_rep").value+'</h5>';
    str += '<h5 class="h5">CC: '+document.getElementById("cedula_rep").value+'</h5><br>';    
    str +='<input type="hidden" id="cc" name="cc" value="'+document.getElementById("cedula_rep").value+'">';
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
                document.getElementById("nombre_rep").value=accionista.nombre;
                document.getElementById("cedula_rep").value=accionista.cedula;
                cargarSelectAccionista2();
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
    str += '<h5 class="h5">Nombre: '+document.getElementById("nombre_rep").value+'</h5>';
    str += '<h5 class="h5">CC: '+document.getElementById("cedula_rep").value+'</h5><br>';
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
                document.getElementById("cedula_acc").value = accionista.cedula;
                document.getElementById("nombre_acc").value = accionista.nombre;
                document.getElementById("acciones_acc").value = accionista.acciones;
                cargarSelectAccionistaFin();
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
    str += '<h5 class="h5">Nombre: '+document.getElementById("nombre_rep").value+'</h5>';
    str += '<h5 class="h5">CC: '+document.getElementById("cedula_rep").value+'</h5><br>';
    str += '<h4>Accionista:</h4>';
    str += '<h5 class="h5">Nombre: '+document.getElementById("nombre_acc").value+'</h5>';
    str += '<h5 class="h5">CC: '+document.getElementById("cedula_acc").value+'</h5>';
    str += '<h5 class="h5">Número de acciones: '+document.getElementById("acciones_acc").value+'</h5><br>';
    document.getElementById("datos").innerHTML = str;
    var str ='<input type="hidden" id="cc_rep" name="cc_rep" value="'+document.getElementById("cedula_rep").value+'">';
    str += '<input type="hidden" id="cc_acc"  name="cc_acc" value="'+document.getElementById("cedula_acc").value+'">';
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
            enviar(formData,'back/controller/dompdf/reportePoderes.php',postConsultarPoderes);
        }
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function postConsultarPoderes(result,state){
    if(state=="success"){
        window.open('back/controller/dompdf/pdfs/reportePoderes.pdf', '_blank');
        cargarInicio();
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function cargarotra(){
    cargaContenido('remp','front/views/registrarVotacion.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Registrar Nueva Votación</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Registrar Votación</h2>';
}

function preVotacionInsert(idForm){
    if(validarForm(idForm)){
        var formData = $('#'+idForm).serialize();
        enviar(formData,'back/controller/otras_votaciones/Otras_votacionesInsert.php',postVotacionInsert);
    }
}

function postVotacionInsert(result,state){
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

function cargarConsultarAsistencia(){
    cargaContenido('remp','front/views/consultarAsistencia.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Consultar Asistencia</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Consultar Asistencia</h2>';
}

function preConsultarAsistencia(idForm){
    if(validarForm(idForm)){
        var formData = $('#'+idForm).serialize();
        enviar(formData,'back/controller/registro_voto/Registro_votoSelect.php',selectAsistencia);
    }
}

function selectAsistencia(result,state){
    if(state=="success"){
        var json=JSON.parse(result);
        if(json[0].msg == "Error"){
            swal("No se encuentran poderes registrados en esa fecha", {
                           icon: "error",
                         });                    
        }else{
            formData={fecha:json[1].fecha};
            enviar(formData,'back/controller/dompdf/reporteAsistencia.php',postConsultarAsistencia);
        }
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function postConsultarAsistencia(result,state){
    if(state=="success"){
        window.open('back/controller/dompdf/pdfs/reporteAsistencia.pdf', '_blank');
        cargarInicio();
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }

}


function cargarConsultaVotacion(){
    cargaContenido('remp','front/views/consultarVotacion.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Consultar Votación</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Consultar Votación</h2>';
}

function cargarConsultaListas(){
    cargaContenido('remp','front/views/consultarListas.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Consultar Listas de Votación</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Consultar Listas de Votación</h2>';
    enviar('','back/controller/Candidato/CandidatoList.php',postConsultaListas);
}

function postConsultaListas(result, state){
    if(state=="success"){
        var json=JSON.parse(result);
         if(json[0].msg=="exito"){
            for(var i=1; i < Object.keys(json).length; i++) {
                var canditado = json[i];
                //----------------- Para una tabla -----------------------
                str="<tr><td>"+canditado.fecha+"</td><td>"+canditado.numero+"</td><td>"+canditado.numerocandidato+"</td>";
                str+="<td>"+canditado.nombre+"</td><td>"+canditado.cedula+"</td></tr>";
                document.getElementById("listaslist").innerHTML+=str;
            }
         }
         function_datatable();
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function cargarConsultaOtras(){
    cargaContenido('remp','front/views/consultarOtras.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Consultar Votaciones</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Consultar Votaciones</h2>';
    enviar('','back/controller/Otras_votaciones/Otras_votacionesList.php',postConsultaOtras);
}

function postConsultaOtras(result, state){
    if(state=="success"){
        var json=JSON.parse(result);
         if(json[0].msg=="exito"){
            for(var i=1; i < Object.keys(json).length; i++) {
                var votacion = json[i];
                //----------------- Para una tabla -----------------------
                str="<tr><td>"+votacion.fecha+"</td><td>"+votacion.nombre+"</td></tr>";
                document.getElementById("listaslist").innerHTML+=str;
            }
         }
         function_datatable();
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}