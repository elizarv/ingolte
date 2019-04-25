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


function preRepre1List(){
     //Solicite información del servidor
    cargaContenido('remp','front/views/listarAccionistas.html');
 	enviar("",'back/controller/accionistas/AccionistasList.php',postRepre1List);
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Representantes</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Representantes</h2>';

}


 function postRepre1List(result,state){
     //Maneje aquí la respuesta del servidor.
     if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){
            for(var i=1; i < Object.keys(json).length; i++) {
                var accionista = json[i];
                //----------------- Para una tabla -----------------------
                str="<tr><td>"+accionista.nombre+"</td><td>"+accionista.cedula+"</td><td>"+accionista.acciones+"</td>";
                str+="<td><button class='btn btn-success btn-sm' data-toggle='tooltip' onclick='preRepre2List(\""+accionista.cedula+"\",\""+accionista.nombre+"\")'";
                str+="data-placement='top' title='Seleccionar' id='actualizarUsuario'><i class='material-icons'>";
                str+='check_circle_outline</i></button></td></tr>';
                document.getElementById("AccionistaList").innerHTML+=str;
            }
         }
         function_datatable();
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}


function preRepre2List(cedula,nombre){
     //Solicite información del servidor
    nombre_rep = nombre;
    cedula_rep = cedula;
    formData={"cc":cedula_rep};
    cargaContenido('remp','front/views/listarAccionistas2.html');
 	enviar(formData,'back/controller/accionistas/AccionistasList2.php',postRepre2List);
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Representantes</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Representantes</h2>';
    
}


 function postRepre2List(result,state){
     //Maneje aquí la respuesta del servidor.
     document.getElementById("datos").innerHTML = '<h5 class="h5">Nombre: '+nombre_rep+'</h5><h5 class="h5">CC: '+cedula_rep+'</h5>'
     if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){
            for(var i=1; i < Object.keys(json).length; i++) {
                var accionista = json[i];
                //----------------- Para una tabla -----------------------
                str="<tr><td>"+accionista.nombre+"</td><td>"+accionista.cedula+"</td><td>"+accionista.acciones+"</td>";
                str+="<td><button class='btn btn-success btn-sm' data-toggle='tooltip' onclick='preRepresentantes(\""+accionista.cedula+"\",\""+accionista.nombre+"\")'";
                str+="data-placement='top' title='Seleccionar' id='actualizarUsuario'><i class='material-icons'>";
                str+='check_circle_outline</i></button></td></tr>';
                document.getElementById("AccionistaList").innerHTML+=str;
            }
         }
         function_datatable();
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function preRepresentantes(cedula,nombre){
     //Solicite información del servidor
    nombre_acc = nombre;
    cedula_acc = cedula;
    cargaContenido('remp','front/views/registrarRepresentante.html');
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Representantes</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Representantes</h2>';       
    enviar("",'',postRepresentantes);
}

function postRepresentantes(){
    var str = '<h4>Representante:</h4>';
    str += '<h5 class="h5">Nombre: '+nombre_rep+'</h5>';
    str += '<h5 class="h5">CC: '+cedula_rep+'</h5><br>';
    str +='<h4>Accionista a representar:</h4>'
    str += '<h5 class="h5">Nombre: '+nombre_acc+'</h5>';
    str += '<h5 class="h5">CC: '+cedula_acc+'</h5><br>';
    str += '<input type="hidden" id="cc_rep" name="cc_rep" value="'+cedula_rep+'">';
    str += '<input type="hidden" id="cc_acc"  name="cc_acc" value="'+cedula_acc+'">';
    document.getElementById("datos").innerHTML = str;
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

function preVotantesList(){
    cargaContenido('remp','front/views/registrarVotantes.html');
    enviar("",'back/controller/accionistas/VotantesList.php',postVotantesList);
    var str='<li class="breadcrumb-item"><a href="javascript:cargarInicio()"><i class="material-icons">home</i></a></li>'
    str+='<li class="breadcrumb-item">Representantes</li>';
    document.getElementById("breadc").innerHTML=str;
    document.getElementById("seccname").innerHTML='<h2 class="no-margin-bottom">Accionistas</h2>';
}

 function postVotantesList(result,state){
     if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){
            for(var i=1; i < Object.keys(json).length; i++) {
                var accionista = json[i];
                //----------------- Para una tabla -----------------------
                str="<tr><td>"+accionista.nombre+"</td><td>"+accionista.cedula+"</td>";
                str+="<td><button class='btn btn-success btn-sm' data-toggle='tooltip' onclick='preVotanteInsert(\""+accionista.cedula+"\")'";
                str+="data-placement='top' title='Seleccionar' id='actualizarUsuario'><i class='material-icons'>";
                str+='check_circle_outline</i></button></td></tr>';
                document.getElementById("AccionistaList").innerHTML+=str;
            }
         }
         function_datatable();
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function preVotanteInsert(cedula){
    var formData = {"cc":cedula};
    enviar(formData,'back/controller/registro_voto/registro_votoInsert.php',postVotanteInsert);
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
                //----------------- Para una tabla -----------------------
                cedula_rep = accionista.cedula;
                nombre_rep = accionista.nombre;
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
    enviar("",'',cargarDatosRep);
}

function cargarDatosRep(){
    enviar("",'',mostrarDatosRep);
}

function mostrarDatosRep(){
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
    enviar("",'',mostrarDatosFin);
}


function mostrarDatosFin(){
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