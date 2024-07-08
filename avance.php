<?php
    session_start();
    if (!$_SESSION["autenticado"] || $_SESSION["rol"] == "postulante" ) {
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
   
    <script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>
    <link href="css/general.css" rel="stylesheet"> 
    <link href="css/notificacion.css" rel="stylesheet"> 
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
  
 
</head>
<body>
    <?php require("shared/header.php")?>
    <div id="app">
        <div class=" contenedor">
            <!-- START BREADCRUMB -->
            <div class="col-12 p-0">
                <div class="breadcrumb">
                    <span class="pointer" @click="irA('inicio')">Inicio</span>
                    <span class="mx-2 grey"> - {{pantalla}} </span>
                </div>
            </div>
  
            <!-- START COMPONENTE LOADING BUSCANDO USUARIOS -->
            <div class="contenedorLoading" v-if="buscando">
                <div class="loading">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
            <!-- END COMPONENTE LOADING BUSCANDO USUARIOS -->
            <div class="row d-flex justify-content-center justify-content-sm-start mt-4" v-else>
                <div class="row d-flex justify-content-end px-0 mb-3">
                    <button class="boton" type="button" @click="modal = true">
                        DESCARGAR EXCEL
                    </button>
                </div>

                <!-- START AVANCE -->
                <div class="row d-flex justify-content-between px-0 mb-3 rowAvance" v-if="mostrarResumen">
                    <div class="col-12 col-md-2 px-0 resumen total">
                        TOTAL: {{resumen.total}}
                    </div>
                    <div class="col-12 col-md-2 px-0 resumen terminados">
                        {{resumen.terminados}} {{resumen.terminados == 1 ? 'terminado' : 'terminados'}}
                    </div>
                    <div class="col-12 col-md-2 px-0 resumen empezados">
                        {{resumen.empezados}} {{resumen.empezados == 1 ? 'empezado' : 'empezados'}}
                    </div>
                    <div class="col-12 col-md-2 px-0 resumen pendientes">
                        {{parseInt(resumen.total) - (parseInt(resumen.terminados) + parseInt(resumen.empezados))}} sin hacer
                    </div>
                    <div class="col-12 col-md-1 px-0 resumen cerrar" @click="mostrarResumen = false">
                        x
                    </div>
                </div>
                <!-- START AVANCE -->


                <div class="card" v-for="usuario in usuarios">
                    <div class="card-body py-0 mt-3">
                        <h5 class="card-title">{{usuario.voluntario}}</h5>
                    </div>
                    
                    <div class="card-body px-0">
                        <span class="principal">
                            {{usuario.terminados}} / {{usuario.asignados}}
                        </span>     
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi green bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                            {{usuario.terminados}} terminados</li>
                        <li class="list-group-item"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi naranja bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg>
                            {{usuario.empezados}} empezados</li>
                        <li class="list-group-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill rojo" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                            </svg>   
                            {{(parseInt(usuario.asignados) - parseInt(usuario.terminados) - parseInt(usuario.empezados)) }} sin hacer</li>
                    </ul>
                </div>
            </div>
            <!-- START MODAL -->
            <div v-if="modal">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">DESCARGAR EXCEL</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalAsignacion = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body">
                            <div class="row">  
                                <div class="col-sm-12 mt-3">
                                    <label for="ciudad">VOLUNTARIO</label>
                                    <select class="form-control" v-model="descarga.asignado">
                                        <option value="todos">Todos</option>
                                        <option v-for="voluntario in usuarios" v-bind:value="voluntario.id">{{voluntario.voluntario}}</option>
                                    </select> 
                                </div>           
                            </div>
                            <div class="row">  
                                <div class="col-sm-12 my-3">
                                    <label for="ciudad">ESTADO </label>
                                    <select class="form-control" v-model="descarga.estado">
                                        <option value="todos">Todos</option>
                                        <option value="terminados">Terminados</option>
                                    </select> 
                                </div>           
                            </div>
                            <div v-if="!descargando">
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="botonCancelar" @click="modal = false" id="" data-dismiss="modal">Cancelar</button>
                                    <button type="button" @click="descargarExcel"  class="boton">Descargar</button>
                                </div>
                            </div>
                            <div v-if="descargando">
                                <div class="modal-footer d-flex justify-content-between">
                                    <div class="contenedorLoadingModal">
                                        <div class="loading">
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>    
            </div>    
            <!-- END MODAL -->

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
    </div>

    <style scoped>
            .rowAvance{
            background-color: lightgray;
        }
        .resumen {
            border: solid 1px grey;
            border-radius: 5px;
            background: white;
            display: flex;
            font-size: 16px;
            font-weight: bolder;
            height: 40px;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .total{
            border: solid 1px rgb(124, 69, 153);
            color: rgb(124, 69, 153)
        }
        .terminados{
            color: green;
            border: solid 1px green;
        }
        .pendientes{
            color: orange;
            border: solid 1px orange;
        }
        .empezados{
            color: grey;
            border: solid 1px grey;
        }
        .cerrar{
            color: rgb(238, 100, 100);
            border: solid 1px rgb(238, 100, 100);
        }
        .cerrar:hover{
            background-color: rgb(238, 100, 100);
            color: white;
            cursor: pointer;
        }
        .principal {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            font-size: 17px;
            font-weight: bolder;
            justify-content: center;
            background: #B3B4B6;
            align-items: center;
            text-align: center;
            margin:0px auto;
            padding:3%
        }
        .rojo {
            color: red;
        }
        .naranja {
            color: orange;
        }
        .green {
            color: green;
        }
        .card-title{
            text-align: center;
        }
        li.list-group-item{
            text-align: center;
        }
        .card{
            width: 180px;
            margin: 0 10px 10px;
        }
        
      
            
    </style>
    <script>
        var app = new Vue({
            el: "#app",
            components: {
            },
            mounted () {
                this.pantalla = localStorage.getItem("pantalla");
                if (this.pantalla == null) {
                    window.location.href = 'home.php'; 
                }
                this.getVoluntariosActivos();
                this.getResumen();
            },
            data: {
                pantalla: null,
                buscando: true,
                tituloToast: null,
                textoToast: null,
                usuarios: [
                ],
                descarga: {
                    asignado: "todos",
                    estado: "todos"
                },
                modal: false,
                descargando: false,
                mostrarResumen: false,
                resumen: null
            },
            methods:{
                getVoluntariosActivos () {
                    this.buscando = true;
                    axios.post("funciones/avance.php?accion=consultarVoluntarios")
                    .then(function(response){  
                        console.log(response.data);
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.usuarios != false) {
                                app.usuarios = response.data.usuarios;
                                app.buscando = false;
                            } else {
                                app.usuarios = [];
                                app.mostrarToast("Error", "No se pudo recuperar la información");
                            }
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo recuperar la información");
                    });
                },
                descargarExcel () {
                    this.descargando = true;
                    let formdata = new FormData();
                    formdata.append("asignado", this.descarga.asignado);
                    formdata.append("estado", this.descarga.estado);
                    axios.post("funciones/avance.php?accion=consultarDescarga", formdata)
                    .then(function(response){ 
                        app.armarExcel(response.data.resultado)
                        app.descargando = false;
                        app.modal = false;
                    }).catch( error => {
                        app.descargando = false;
                        app.modal = false;
                        app.mostrarToast("Error", "No se pudo recuperar la información");
                    });
                },
                exportarTodos() {
                    this.exportando = true;
                    let usuarios = [];

                    let formdata = new FormData();
                    axios.post("funciones/asignados.php?accion=getTotalAsignados", formdata)
                    .then(function(response){    
                        if (response.data.error) {
                            app.exportando = false;
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.usuarios != false) {
                                usuarios = response.data.usuarios
                                app.armarExcel(usuarios)
                            }
                        }
                    }).catch( error => {
                        app.exportando = false;
                        app.mostrarToast("Error", "No se pudo armar el archivo. Intentá nuevamente");
                    });
                },
                armarExcel(usuarios){
                    const libro = XLSX.utils.book_new();
                    const hoja = XLSX.utils.json_to_sheet(usuarios);

                    // Agregar la hoja de trabajo al libro
                    XLSX.utils.book_append_sheet(libro, hoja, 'Sheet1');

                    // Guardar el libro como archivo Excel
                    const nombreArchivo = 'usuarios.xlsx';
                    XLSX.writeFile(libro, nombreArchivo);
                },
               
                getResumen () {
                    axios.post("funciones/avance.php?accion=getResumen")
                    .then(function(response){  
                        console.log(response.data);
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.resumen != false) {
                                app.resumen = response.data.resumen[0];
                                app.mostrarResumen = true;
                            }
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo recuperar la información");
                    });
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
                }
            }
        })
    </script>
</body>
</html>