//funciones generales

function tieneN(value, N){
    return value.length == N;
}
function incluyeNumeros(valor){
    return ( (valor.includes("0")) ||
        (valor.includes("1")) ||
        (valor.includes("2")) ||
        (valor.includes("3")) ||
        (valor.includes("4")) ||
        (valor.includes("5")) ||
        (valor.includes("6")) ||
        (valor.includes("7")) ||
        (valor.includes("8")) ||
        (valor.includes("9")))
}

//funciones para validar campos 
function validarNombre(nombre, campoMensaje){
    if (nombre.length <3){
        campoMensaje.innerHTML = "Debe ingresar 3 o mas caracteres";
        campoMensaje.className="red";
    } else if (incluyeNumeros(nombre)==true){
        campoMensaje.innerHTML = "No puede incluir números";
        campoMensaje.className="red";
    }else{
        campoMensaje.innerHTML = "";
    }
}        
function validarDni(dni, campoMensaje){
    if(tieneN(dni, 8)!=true){
        campoMensaje.innerHTML = "El dni ingresado debe poseer 8 dígitos";
        campoMensaje.className="red";
    }
    else if(isNaN(dni)==true){
        campoMensaje.innerHTML = "El dni ingresado debe ser numérico";
        campoMensaje.className="red";
    }else{
        campoMensaje.innerHTML=  "";
    }
}
function validarEmail(email, campoMensaje){
    if( (!email.includes("@"))|| (!email.includes(".") )){
        campoMensaje.innerHTML= "El email ingresado debe ser del tipo ejemplo@ejemplo.com";
        campoMensaje.className="red";
    }else{
        campoMensaje.innerHTML = "";    
    }
}
function validarPassword(password, campoMensaje){
    if(tieneN(password, 6) != true){
        campoMensaje.innerHTML = "La contraseña debe poseer 6 dígitos";
        campoMensaje.className="red";
    }else{
        campoMensaje.innerHTML ="";
    }
}
function compararPassword(password1, password2, campoMensaje){
    if(password1 != password2){
        campoMensaje.innerHTML ="las contraseñas no coinciden";
        campoMensaje.className="red";
    }else{
        campoMensaje.innerHTML ="";
    }
}



function validarMinutos(minutos, campoMensaje){
    if ( (minutos<1) || (minutos>45) ){
        campoMensaje.innerHTML = "Solo puede asignar entre 1 y 45 minutos";
        campoMensaje.className="red";
    }else{
        campoMensaje.innerHTML= "";
    }
}


//validación campos de formulario de las secciones
let input = document.querySelectorAll(".input");
input.forEach(function(valor){
    valor.addEventListener('focus', function(){
        valor.addEventListener('keyup', function(){
            let inputName = valor.getAttribute("name");
            let id = valor.parentNode.parentNode.getAttribute("id");
            let campoMensaje = document.querySelector("#mensaje" + id);
                        
            let datoIngresado = valor.value;
            if (inputName == "name"){
                validarNombre(datoIngresado, campoMensaje);   
            }
            if (inputName == "lastName"){
                validarNombre(datoIngresado, campoMensaje);   
            }
            if (inputName == "dni"){
                validarDni(datoIngresado, campoMensaje);   
            }
            if (inputName == "email"){
                validarEmail(datoIngresado, campoMensaje);   
            }
            if ((inputName == "password") || (inputName == "newPassword")){
                validarPassword(datoIngresado, campoMensaje);   
            }
            if (inputName == "confirmPassword"){
                let pass = valor.parentNode.previousElementSibling.lastElementChild.previousElementSibling.value;
                compararPassword(datoIngresado, pass,  campoMensaje);   
            }
            if (inputName == "minutos"){
                validarMinutos(datoIngresado, campoMensaje);   
            }

    })
})
})


/* Validacion campos CREAR USUARIO 
let campoCrearUsuario = document.querySelectorAll(".campoCrearUsuario");
let mensajeCrearUsuario = document.querySelector("#mensajeCrearUsuario");
campoCrearUsuario.forEach(function(boton){
    boton.addEventListener('focus', function(){
        boton.addEventListener('keyup', function(){
            let inputFocus = boton.getAttribute("name");
            let datoIngresado = boton.value;
            if(inputFocus == "name"){
                if(datoIngresado.length<3){
                    mensajeCrearUsuario.innerHTML="El nombre debe poseer mínimo 3 caracteres";    
                }else{
                    mensajeCrearUsuario.innerHTML="";    
                }
            }    
            if(inputFocus == "lastName"){
                if(datoIngresado.length<3){
                    mensajeCrearUsuario.innerHTML="El apellido debe poseer mínimo 3 caracteres";    
                }else{
                    mensajeCrearUsuario.innerHTML="";    
                }
            }
            if(inputFocus == "dni"){
                if(datoIngresado.length!=8){
                    mensajeCrearUsuario.innerHTML="El dni debe poseer mínimo 8 caracteres";    
                }else{
                    mensajeCrearUsuario.innerHTML="";
                }
            }    
            if(inputFocus == "email"){
                if((datoIngresado.includes("@")==false) || (datoIngresado.includes(".")==false)) {
                    mensajeCrearUsuario.innerHTML="El mail debe ser del tipo ejemplo@ejemplo.com";    
                }else{
                    mensajeCrearUsuario.innerHTML="";
                }
            }    
        })
    })    
})                
*/



/* Funciones para botones "ver +" y "ver -"   */
let verMas = document.querySelectorAll('.verMas');
let verMenos = document.querySelectorAll('.verMenos');
verMas.forEach(function(boton){
    boton.addEventListener('click', function(){
        opcionElegida = boton.getAttribute("name");
       
        botonVerMas = document.querySelector('#verMas' + opcionElegida);
        botonVerMas.className="ocultar";
        cajaAMostrar = document.querySelector('#caja' + opcionElegida);
        cajaAMostrar.classList.remove("ocultar");
        
        botonVerMenos = document.querySelector('#verMenos' + opcionElegida);
        botonVerMenos.classList.remove("ocultar");
    })
})
verMenos.forEach(function(boton){
    boton.addEventListener('click', function(){
        opcionElegida = boton.getAttribute("name");
                     
        botonVerMenos = document.querySelector('#verMenos' + opcionElegida);
        botonVerMenos.className="ocultar";
        cajaAMostrar = document.querySelector('#caja' + opcionElegida);
        cajaAMostrar.className="ocultar";
    
        botonVerMas = document.querySelector('#verMas' + opcionElegida);
        botonVerMas.classList.remove("ocultar");
    })
})