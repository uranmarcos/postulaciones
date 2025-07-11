<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>SI RESIDENCIAS</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.21/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/notificacion.css" rel="stylesheet">
 
</head>
<body>
    <div class="container">

        <div id="app">
            <div class="col-10 col-sm-8 col-md-5 col-lg-3">

                <div class="contenedorLogo">
                    <img 
                        src="img/logo.png" 
                        alt="logo"  
                    >
                </div>
                
                <div class="panel panel-primary">
                    <div class="panel-heading d-flex justify-content-center">
                        <span class="mr-5"></span> <span class="ml-5">RESIDENCIAS</span>
                    </div>

                    <div class="panel-body">
                        <label for="user">
                            Usuario
                        </label>
                        <input type="text" class="form-control" maxlength="8" v-model="usuario">
                        <div class="error">{{errorUsuario}}</div>
                        <br>
                        <label for="password">
                            Contraseña
                        </label> 
                        <button @click="changeType()" class="btn-eye">
                            <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                width="17" 
                                height="17" 
                                fill="currentColor" 
                                class="bi mb-0 bi-eye-fill grey" 
                                viewBox="0 0 16 16"
                                v-if="showPasword"    
                            >
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                            </svg>
                            <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                width="17" 
                                height="17" 
                                fill="currentColor" 
                                class="bi mb-0 bi-eye-slash-fill grey" 
                                viewBox="0 0 16 16"
                                v-if="!showPasword" 
                            >
                                <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                            </svg>
                        </button>
                        
                        <input type="password" id="password" class="form-control" @keyup.enter="ingresar" v-model="password">
                        <div class="error">{{errorPassword}}</div>
                        <div 
                            class="contenedorRecordar"
                            @click="changeRecordar()"
                        >
                            <input 
                                type="checkbox" 
                                id="recordar" 
                                name="recordar" 
                                v-model="recordar"
                                class="mt-0 mr-4"
                            >
                            <label 
                                for="recordar"
                                class="labelChexbox"
                            >
                                Recordar usuario
                            </label>
                        </div>
                    </div>
                
                    <div class="panel-footer">
                        <button 
                            class="btn btn-primary btn-block" 
                            @click="ingresar()"
                            v-if="!loading"
                        >
                            <span class="glyphicon glyphicon-log-in">
                                
                            </span>
                            Ingresar
                        </button>

                        <button 
                            class="btn btn-primary btn-block"
                            v-if="loading" 
                        >
                            <div class="loading">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                        </button>

                    </div>
                
                </div>
            </div>
            <div role="alert" id="mitoast" aria-live="assertive" aria-atomic="true" class="toast">
                <div class="toast-header">
                    <!-- Nombre de la Aplicación -->
                    <div class="row tituloToast" id="tituloToast">
                        <strong class="mr-auto">{{tituloToast}}</strong>
                    </div>
                </div>
                <div class="toast-content">
                    <div class="row textoToast">
                        <strong >{{textoToast}}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .purple{
            color: rgb(124, 69, 153)
        }
        .grey{
            color: rgb(94, 93, 93);
        }
        .btn-eye{
            border: none;
            background-color: white;
        }
        .btn-eye:focus{
            outline: none !important;
        }
        .labelChexbox {
            margin: 0;
            padding-left: 8px;
            width:100%;
            font-size: 12px;
            display: flex;
            align-items: center;
        }
        //
        .contenedorRecordar{
            margin-top: 16px;
            display: flex;
            align-items: center;
        }
        .contenedorRecordar:hover{
            cursor:pointer;
        }
        .container{
            height: 100vh;
            display: flexbox;
            align-items: center;
            color: rgb(94, 93, 93);
        }
        .contenedorLogo{
            display: flex;
            justify-content: center;
        }
        img{
            height: 20vh;
            margin: 0 auto 20px;
            border-radius: 50%;
        }
        #app{
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;

        }
        div.panel.panel-primary{
            border: solid 1px rgb(124, 69, 153);
        }
        .panel-primary>.panel-heading{
            border: solid 1px rgb(124, 69, 153) !important;
        }
        div.panel-heading{
            background-color: rgb(124, 69, 153) !important;
            border: solid 1px rgb(124, 69, 153);
        }
        .btn-primary{
            background-color: rgb(124, 69, 153) !important;
            border: solid 1px rgb(124, 69, 153);
        }
        .btn-primary:focus{
            outline: none !important;
        }
        .error{
            font-size: 12px;
            color: red
        }
    </style>
    <script>
        var app = new Vue({
            el: "#app",
            components: {
            },
            data: {
                usuario: "",
                password: "",
                errorUsuario: null,
                errorPassword: null,
                error: false,
                loading: false,
                tituloToast: "",
                textoToast: "",
                recordar: false,
                showPasword: false
            },
            mounted () {
                let usuarioRecordardo = localStorage.getItem("usuarioPostulaciones");
                this.password = "";
                if (usuarioRecordardo) {
                    this.usuario = usuarioRecordardo;
                    this.recordar = true;
                }
                if (!this.recordar) {
                    localStorage.removeItem("usuarioPostulaciones");
                    this.usuario = "";
                }
            },
            methods:{
                changeRecordar () {
                    this.recordar = !this.recordar;
                    localStorage.removeItem("usuarioPostulaciones");
                },
                changeType () {
                    this.showPasword = !this.showPasword
                    const passwordField = document.querySelector('#password')
                    if (passwordField.getAttribute('type') === 'password') passwordField.setAttribute('type', 'text')
                    else passwordField.setAttribute('type', 'password')
                },
                ingresar() {
                    this.errorUsuario = null;
                    this.errorPassword = null;
                    this.error = false;
                    if (this.usuario == null || this.usuario.trim() == '') {
                        this.errorUsuario = "Campo requerido";
                        this.error = true;
                    }
                    if (this.password == null || this.password.trim() == '') {
                        this.errorPassword = "Campo requerido";
                        this.error = true;
                    }
                    if (!this.error) {
                        this.loading= true;
                        let formdata = new FormData();
                        formdata.append("usuario", app.usuario);
                        formdata.append("password", app.password);
                        formdata.append("voluntario", app.voluntario);
                        axios.post("funciones/acciones.php?accion=login", formdata)
                        .then(function(r){
                            let data = r.data 
                            if (data.error) {
                                app.mostrarToast("Error", data.mensaje);
                            } else {
                                if (data.mensaje == "OK") {
                                    if (app.recordar) {
                                        localStorage.setItem("usuarioPostulaciones", app.usuario)
                                    } else {
                                        localStorage.removeItem("usuarioPostulaciones", app.usuario)
                                    }
                                    if (data.u== "postulante") {
                                        window.location.href = 'menu.php'; 
                                    } else {
                                        window.location.href = 'home.php'; 
                                    } 
                                }
                            }
                            app.loading = false;
                        }).catch( error => {
                            app.loading = false;
                            app.mostrarToast("Error", "Hubo un error");
                        })
                    }
                },
                mostrarToast(titulo, texto) {
                    app.tituloToast = titulo;
                    app.textoToast = texto;
                    var toast = document.getElementById("mitoast");
                    var tituloToast = document.getElementById("tituloToast");
                    toast.classList.remove("toast");
                    toast.classList.add("mostrar");
                    setTimeout(function(){ toast.classList.toggle("mostrar"); }, 10000);
                    if (titulo == 'Éxito') {
                        toast.classList.remove("bordeError");
                        toast.classList.add("bordeExito");
                        tituloToast.className = "exito";
                    } else {
                        toast.classList.remove("bordeExito");
                        toast.classList.add("bordeError");
                        tituloToast.className = "errorModal";
                    }
                },
            }
        })
    </script>
</body>
</html>