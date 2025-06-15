<?php
session_start();
    if (!$_SESSION["autenticado"] ) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI RESIDENCIAS</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.21/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="css/general.css" rel="stylesheet"> 
    <link href="css/notificacion.css" rel="stylesheet"> 
 
</head>
<body>
    <?php require("shared/header.php")?>
    <div id="app">
        <div class="contenedor">
            <div class="row d-flex justify-content-between mt-3">
                <div class="col-12 px-0">
                    <div class="row d-flex justify-content-end">

                        <button type="button" class="boton botonActualizar" @click="getEstadoPostulante()">
                            ACTUALIZAR
                        </button>
                    </div>
                </div>
            </div>
            <div class="row mt-6">
                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-5 d-flex justify-content-center">
                    <div class="opciones" :class="bloqueado1 == true ? 'grey' : ''" @click="irA('actividad1')">
                        <b>ACTIVIDAD 1</b>
                        <br>
                        {{estado1 == 2 ? "Terminado" : estado1 == 1 ? "Empezado" : "Sin Hacer" }}
                        <br>
                        {{!bloqueado1 ? "Habilitado" : "Bloqueado" }}
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-5 d-flex justify-content-center">
                    <div class="opciones" :class="bloqueado2 == true ? 'grey' : ''" @click="irA('actividad2')">
                        <b>ACTIVIDAD 2</b>
                        <br>
                        {{estado2 == 2 ? "Terminado" : estado2 == 1 ? "Empezado" : "Sin Hacer" }}
                        <br>
                        {{!bloqueado2 ? "Habilitado" : "Bloqueado" }}
                    </div>
                </div>
               
                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-5 d-flex justify-content-center">
                    <div class="opciones" :class="bloqueado3 == true ? 'grey' : ''" @click="irA('actividad3')">
                        <b>ACTIVIDAD 3</b>
                        <br>
                        {{estado3 == 2 ? "Terminado" : estado3 == 1 ? "Empezado" : "Sin Hacer" }}
                        <br>
                        {{!bloqueado3 ? "Habilitado" : "Bloqueado" }}
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-5 d-flex justify-content-center">
                    <div class="opciones" :class="bloqueado4 == true ? 'grey' : ''" @click="irA('actividad4')">
                        <b>ACTIVIDAD 4</b>
                        <br>
                        {{estado4 == 2 ? "Terminado" : estado4 == 1 ? "Empezado" : "Sin Hacer" }}
                        <br>
                        {{!bloqueado4 ? "Habilitado" : "Bloqueado" }}
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-5 d-flex justify-content-center">
                    <div class="opciones" :class="bloqueado5 == true ? 'grey' : ''" @click="irA('actividad5')">
                        <b>ACTIVIDAD 5</b>
                        <br>
                        {{estado5 == 2 ? "Terminado" : estado5 == 1 ? "Empezado" : "Sin Hacer" }}
                        <br>
                        {{!bloqueado5 ? "Habilitado" : "Bloqueado" }}
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-5 d-flex justify-content-center">
                    <div class="opciones" :class="bloqueado6 == true ? 'grey' : ''" @click="irA('actividad6')">
                        <b>ACTIVIDAD 6</b>
                        <br>
                        {{estado6 == 2 ? "Terminado" : estado6 == 1 ? "Empezado" : "Sin Hacer" }}
                        <br>
                        {{!bloqueado6 ? "Habilitado" : "Bloqueado" }}
                    </div>
                </div>
            </div>
        </div>
        <!-- START MODAL -->
        <div v-if="modal">
            <div id="myModal" class="modal">
                <div class="modal-content px-0 py-0">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title">¡TERMINASTE!</h5>
                    </div>
                    <div class="modal-body" >
                        <div class="row mb-3">
                            Listo, ya realizaste todas las actividades.
                            Antes de irte, confirma con el voluntario que te acompañó que esté todo bien!

                            ¡Gracias por tu tiempo!
                        </div>
                        <div class="modal-footer f-flex justify-content-center">
                            <button type="button" class="boton" @click="terminar()" id="" data-dismiss="modal">CERRAR</button>
                        </div>
                    </div>
                    
                </div>    
            </div>  
        </div>  
        <!-- END MODAL ASIGNAR USUARIO -->
        <!-- START NOTIFICACION -->
        <div role="alert" id="mitoast" aria-live="assertive" @mouseover="ocultarToast" aria-atomic="true" class="toast">
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
            <!-- END NOTIFICACION -->
    </div>

    <style scoped>
        .opciones{
            flex-direction: column;
            border: solid 1px rgb(124, 69, 153);
            border-radius: 10px;
            color: rgb(124, 69, 153);
            text-transform: uppercase;
            text-align: center;
            width: 95%;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .modal-title{
            text-align: center !important;
        }
        .opciones:hover{
            cursor: pointer;
            background: rgb(124, 69, 153);
            color: white;
        }
        .grey{
            background: lightgrey;
        }
        .contenedor{
            max-width: 1000px;
            margin: auto;
        }
    </style>

  
    <script>
        var app = new Vue({
            el: "#app",
            components: {
                
            },
            data: {
               bloqueado1: true,
               bloqueado2: true,
               bloqueado3: true,
               bloqueado4: true,
               bloqueado5: true,
               bloqueado6: true,
               estado1: 0,
               estado2: 0,
               estado3: 0,
               estado4: 0,
               estado5: 0,
               estado6: 0,
               idUsuario: null,
               textoToast: null,
               tituloToast: null,
               modal: false
            },
            mounted () {
                this.idPostulante = <?php echo json_encode($_SESSION["idUsuario"]); ?>;
                this.getEstadoPostulante();
            },
            methods:{
                getEstadoPostulante() {
                    let formdata = new FormData();
                    formdata.append("idUsuario", this.idPostulante);
                    axios.post("funciones/seguimiento.php?accion=getEstadoPostulante", formdata)
                    .then(function(response){   
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.estado != false && response.data.estado.length != 0) {
                                app.estado1 = response.data.estado[0].estado1;
                                app.bloqueado1 = response.data.estado[0].habilitado1 == 0 ? true : false ;
                                app.estado2 = response.data.estado[0].estado2;
                                app.bloqueado2 = response.data.estado[0].habilitado2 == 0 ? true : false ;

                                app.estado3 = response.data.estado[0].estado3;
                                app.bloqueado3 = response.data.estado[0].habilitado3 == 0 ? true : false ;

                                app.estado4 = response.data.estado[0].estado4;
                                app.bloqueado4 = response.data.estado[0].habilitado4 == 0 ? true : false ;

                                app.estado5 = response.data.estado[0].estado5;
                                app.bloqueado5 = response.data.estado[0].habilitado5 == 0 ? true : false ;

                                app.estado6 = response.data.estado[0].estado6;
                                app.bloqueado6 = response.data.estado[0].habilitado6 == 0 ? true : false ;
                                app.validarEstados();
                            } else {
                                console.log("no hay info");
                                app.mostrarToast("Error", "No se pudo recuperar la información");
                            }
                        }
                       
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo recuperar la información");
                    });
                },
                validarEstados () {
                    if (
                        this.estado1 == 2 &&
                        this.estado2 == 2 &&
                        this.estado3 == 2 &&
                        this.estado4 == 2 &&
                        this.estado5 == 2 &&
                        this.estado6 == 2
                    ) {
                        this.modal = true;
                    }
                },
                terminar () {
                    window.location.href = 'funciones/cerrarSesion.php';   
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
                ocultarToast(titulo, texto) {
                    var toast = document.getElementById("mitoast");
                    toast.classList.add("remove");
                    toast.classList.add("toast");
                    app.tituloToast = "";
                    app.textoToast = "";
                },
                irA(param) {
                    switch (param) {
                        case "actividad1":  
                            if (this.bloqueado1) {
                                return;
                            }  
                            window.location.href = 'actividades/actividad1.php';   
                            break;
                    
                        case "actividad2": 
                            if (this.bloqueado2) {
                                return;
                            }     
                            window.location.href = 'actividades/actividad2.php';   
                            break;

                        case "actividad3": 
                            if (this.bloqueado3) {
                                return;
                            }     
                            window.location.href = 'actividades/actividad3.php';   
                            break;

                        case "actividad4": 
                            if (this.bloqueado4) {
                                return;
                            }     
                            window.location.href = 'actividades/actividad4.php';   
                            break;
                        
                         case "actividad5":  
                            if (this.bloqueado5) {
                                return;
                            }    
                            window.location.href = 'actividades/actividad5.php';   
                            break;
                        
                        case "actividad6":   
                            if (this.bloqueado6) {
                                return;
                            }   
                            window.location.href = 'actividades/actividad6.php';   
                            break;

                        default:
                            break;
                    }
                },
                setPantalla (pantalla) {
                    localStorage.setItem("pantalla", pantalla)
                }
            }
        })
    </script>
</body>
</html>