window.onload=inicio();

function inicio(){
    var misUsuarios = [];
    var misReservas = [];
    var login=byId('login');
    var dni=document.getElementById('dni');
    var clave=document.getElementById('clave');
    var botonEntrar=document.getElementById('botonEntrar');
    botonEntrar.addEventListener('click',loginConsulta);
    var lista=document.getElementsByClassName('cuadrado');
    for (var i = 0; i < lista.length; i++) {
        lista[i].addEventListener('click', function() {
            var that = this;
            var procesarRespuesta3 = function(respuesta) {
                if (respuesta.r == true) {
                    if (that.textContent == "DISPONIBLE") {
                        that.textContent = "RESERVADO";
                        that.parentNode.setAttribute('class','reservado');
                    }
                }
                else {
                    if (respuesta.r == 'miReserva') {
                        that.textContent = "DISPONIBLE";
                        that.parentNode.classList.remove('reservado');
                    }
                    else {
                        alert('El día y la hora seleccionada está reservada por otro usuario');
                    }
                }
            };

            var ajax = new Ajax();
            ajax.setPost();
            var datoid = this.getAttribute('id');
            ajax.setParametros("id=" + datoid);
            ajax.setUrl("../ajax/ajaxReserva.php");
            ajax.setRespuesta(procesarRespuesta3);
            ajax.doPeticion();

        }, false)
    }
    var enlaceInsertar=document.getElementById('ins');
    enlaceInsertar.addEventListener('click',insertarUsuario);
    var dniU=document.getElementById('dniU');
    var claveU=document.getElementById('claveU');
    var botonInsertar=document.getElementById('botonInsertar');
    botonInsertar.addEventListener('click',insertar);
    var volverAdministrador=document.getElementById('volverA');
    volverAdministrador.addEventListener('click',volver);
    var borraU=document.getElementById('borraU');
    borraU.addEventListener('click',borrarUsuarioConsulta);
    var borrarT=document.getElementById('borrarTabla');
    borrarT.addEventListener('click',borrarTabla);

    //LOGIN
    function loginConsulta(){
        var ajax = new Ajax();
        ajax.setPost();
        var datoDni = encodeURI(dni.value);
        var datoClave = encodeURI(clave.value);
        ajax.setParametros("dni="+datoDni+"&clave="+datoClave);
        ajax.setUrl("../ajax/ajaxLogin.php");
        ajax.setRespuesta(loginRespuesta);
        ajax.doPeticion();
    }
    function loginRespuesta(respuesta){
        var divMensaje=document.getElementById('mensaje');
        var divAgenda=document.getElementById('divAgenda');
        if (respuesta.login) {
            if(respuesta.login=='admin'){
                login.classList.add("oculta");
                peticionReservas();
                divAgenda.classList.remove("oculta");
                if(divMensaje.getAttribute('class')!='oculta'){
                    divMensaje.setAttribute("class","oculta");
                }
                var divAdministrador=document.getElementById('divAdministrador');
                divAdministrador.classList.remove("oculta");
            }else{
                    peticionReservas();
                    login.classList.add("oculta");
                    divAgenda.classList.remove("oculta");
                    if(divMensaje.getAttribute('class')!='oculta'){
                        divMensaje.setAttribute("class","oculta");
                    }
                    //divRespuesta.classList.remove("ocultar");
                    //peticionCiudades();
                }
            } else {
                divMensaje.classList.remove("oculta");
            }
    }
    
    //CARGAR TABLA
    function peticionReservas(){
        var ajax = new Ajax();
        ajax.setUrl("../ajax/ajaxListaReservas.php");
        ajax.setRespuesta(peticionReservasRespuesta);
        ajax.doPeticion();
    }
    
    function peticionReservasRespuesta(respuesta){
        misReservas = respuesta.estado;
        tabla(misReservas);
    }
    
    function tabla(misReservas) {
        for (var i = 0; i < misReservas.length; i++) {
            var id = misReservas[i].idReserva;
            var fila = document.getElementById(id);
            fila.parentNode.classList.add('reservado');
            fila.textContent = "RESERVADO";
        }
    }
    
    //RECARGAR PÁGINA
        var procesarRespuesta = function(respuesta) {
        if (respuesta.login) {
            //login.classList.add("oculta");
            //peticionReservas();
            var divAgenda=document.getElementById('divAgenda');
            var divMensaje=document.getElementById('divMensaje');
            //divAgenda.classList.remove("oculta");
                if(respuesta.login=='admin'){
                login.classList.add("oculta");
                peticionReservas();
                divAgenda.classList.remove("oculta");
                if(divMensaje.getAttribute('class')!='oculta'){
                    divMensaje.setAttribute("class","oculta");
                }
                var divAdministrador=document.getElementById('divAdministrador');
                divAdministrador.classList.remove("oculta");
            }else{
                    peticionReservas();
                    login.classList.add("oculta");
                    divAgenda.classList.remove("oculta");
                    if(divMensaje.getAttribute('class')!='oculta'){
                        divMensaje.setAttribute("class","oculta");
                    }
                    //divRespuesta.classList.remove("ocultar");
                    //peticionCiudades();
                }
        }
    };
    var ajax = new Ajax();
    ajax.setUrl("../ajax/ajaxLogueado.php");
    ajax.setRespuesta(procesarRespuesta);
    ajax.doPeticion();
    
    //CERRAR SESIÓN
    var cerrar=document.getElementById('cerrar');
    cerrar.addEventListener("click",function(){
        var procesarRespuesta = function (respuesta) {
            if (!respuesta.login) {
                login.classList.remove("oculta");
                var divAgenda=document.getElementById('divAgenda');
                divAgenda.classList.add("oculta");
                var divAdministrador=document.getElementById('divAdministrador');
                divAdministrador.classList.add("oculta");
            }
        };
        var ajax = new Ajax();
        ajax.setUrl("../ajax/ajaxLogout.php");
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
        
        
    },false)
    
    //INSERTAR USUARIO (VISTA)
    function insertarUsuario(e){
        e.preventDefault();
        var divInsertar=document.getElementById('divInsertar');
        divInsertar.classList.remove("oculta");
        var divAgenda=document.getElementById('divAgenda');
        divAgenda.classList.add("oculta");
        var divAdministrador=document.getElementById('divAdministrador');
        divAdministrador.classList.add("oculta");
    }
    
    //INSERTAR USUARIO
    function insertar(){
        var ajax = new Ajax();
        ajax.setPost();
        var datoDni = encodeURI(dniU.value);
        var datoClave = encodeURI(claveU.value);
        ajax.setParametros("dni="+datoDni+"&clave="+datoClave);
        ajax.setUrl("../ajax/ajaxInsertar.php");
        ajax.setRespuesta(insertRespuesta);
        ajax.doPeticion();
    }
    
    function insertRespuesta(respuesta){
        var divMensaje=document.getElementById('divMensaje');
        var divInsertar=document.getElementById('divInsertar');
        divInsertar.setAttribute("class","oculta");
        var divUsuarios=document.getElementById('divUsuarios');
        divUsuarios.setAttribute("class","oculta");
        var span=document.getElementById('msj');
        if (respuesta.insert) {
            span.textContent="Usuario introducido correctamente";
            divMensaje.classList.remove("oculta");
        } else {
            span.textContent="¡Error! Ya existe un usuario con ese DNI introducido en la base de datos";
            divMensaje.classList.remove("oculta");
        }
    }
    
    //VOLVER ADMINISTRADOR
    function volver(){
        var divMensaje=document.getElementById('divMensaje');
        divMensaje.setAttribute("class","oculta");
        var divAdministrador=document.getElementById('divAdministrador');
        divAdministrador.classList.remove("oculta");
        var divAgenda=document.getElementById('divAgenda');
        divAgenda.classList.remove("oculta");
        var divUsuarios=document.getElementById("divUsuarios");
        divUsuarios.setAttribute('class','oculta');
    }
    
    //LISTAR Y BORRAR USUARIOS
    function borrarUsuarioConsulta(){
        var ajax = new Ajax();
        ajax.setUrl("../ajax/ajaxListarUsuarios.php");
        ajax.setRespuesta(listarRespuesta);
        ajax.doPeticion();
    }
    function listarRespuesta(respuesta){
        misUsuarios = respuesta.usuarios;
        refrescoUsuarios(misUsuarios);
        var divUsuarios=document.getElementById("divUsuarios");
        divUsuarios.classList.remove('oculta');
        var divAdministrador=document.getElementById('divAdministrador');
        divAdministrador.classList.add("oculta");
        var divMensaje=document.getElementById('divMensaje');
        divMensaje.classList.remove('oculta');
        var divMsj=document.getElementById('msj');
        divMsj.textContent="";
            
    }

    function refrescoUsuarios(listaUsuarios){
        var li, dniUsuario;
        var idLista = "listaDeUsuarios";
        var lista = document.getElementById(idLista);
        if(lista){
            borrarNodo(lista);
        }
        var myList = document.createElement("ul");
        var enlace, enlaceEditar;
        myList.id = idLista;
        for(var i=0; i<listaUsuarios.length; i++){
            li = document.createElement("li");
            dniUsuario = listaUsuarios[i].dni;
            li.textContent = listaUsuarios[i].dni;
            enlace = document.createElement("a");
            enlace.className = "borrar";
            enlace.href = "#";
            enlace.textContent = "  Borrar  ";
            borrarUsuario(enlace, dniUsuario);
            li.appendChild(enlace);
            myList.appendChild(li);
        }
        var divUsuarios=document.getElementById('divUsuarios');
        divUsuarios.appendChild(myList);
    }
    
    function borrarNodo(padre){
        if (padre.parentNode) {
            padre.parentNode.removeChild(padre);
        }
    }
    
    function borrarUsuario(link, dni){
        link.addEventListener("click", function (event) {
                event.preventDefault();
                if (window.confirm("Borrar?")) {
                    borrarElemento(dni);
                    //alert(id); //idCiudad tiene el valor esperado: closure
                }
            }, false);
    }
    function borrarElemento(dni){
        var procesarRespuesta = function (respuesta) {
            if(respuesta.delete > 0){
                //borrar del array el elemento
                borrarElementoMisUsuarios(misUsuarios,dni);
                refrescoUsuarios(misUsuarios);
            }else{
                alert("El usuario seleccionado no se ha podido borrar.");
            }
        };
        var ajax = new Ajax();
        ajax.setUrl("ajax/ajaxUsuarioDelete.php?dni=" + dni);
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    }
    
    
    function borrarElementoMisUsuarios(listaUsuarios,dni){
        for(var i=0; i<listaUsuarios.length; i++){
            if(listaUsuarios[i].dni == dni){
                listaUsuarios.splice(i,1);
            }
        }
    }
    
    //BORRAR TABLA
    function borrarTabla(e){
        e.preventDefault();
        var ajax = new Ajax();
        ajax.setUrl("ajax/ajaxBorrarTabla.php");
        ajax.setRespuesta(borrarTablaRespuesta);
        ajax.doPeticion();
    }
    function borrarTablaRespuesta(respuesta){
        if(respuesta.resp==true){
            var td=document.getElementsByTagName('td');
            for(var i=0;i<td.length;i++){
                td[i].classList.remove('reservado');
            }
            var lis=document.getElementsByClassName('cuadrado');
            for(var j=0;j<lis.length;j++){
                lis[j].textContent="DISPONIBLE";
            }
            var divAgenda=document.getElementById('divAgenda');
            divAgenda.classList.add('oculta');
            peticionReservas();
            divAgenda.classList.remove('oculta');
        }
    }
    
    
    
    
}


function obtenerDia(cadena){
    var cadena2="";
    for(var i=0;i<cadena.length;i++){
        var caracter=cadena.charAt(i);
        if(caracter=='_'){
            return cadena2;
        }
        cadena2=cadena2+caracter;
    }
}

function obtenerHora(cadena){
    var cadena2="";
    var extremo=cadena.length-1;
    for(var i=extremo;i>=0;i=i-1){
        var caracter=cadena.charAt(i);
        if(caracter=='_'){
            return cadena2;
        }
        cadena2=cadena2+caracter;
    }
}

function byId(cadena){
    return document.getElementById(cadena);
}