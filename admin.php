<?php
    session_start();
    if (!$_SESSION["autenticado"] || $_SESSION["rol"] != "admin" ) {
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
    <link href="css/notificacion.css" rel="stylesheet"> 
    <link href="css/general.css" rel="stylesheet"> 
  
  
 
</head>
<body>
    <?php require("shared/header.php")?>
    <div id="app">
        <div class="contenedor">
            <!-- START BREADCRUMB -->
              <div class="col-12 p-0">
                <div class="breadcrumb">
                    <span class="pointer mx-2" @click="irA('inicio')">Inicio</span>
                    <span class="pointer mx-2" @click="irA(pantalla)">- {{pantalla}}</span>
                </div>
            </div>
            <!-- END BREADCRUMB -->

            <div class="row d-flex justify-content-between mb-3">
                <div class="col-12 col-md-4 px-0">
                    <div class="row d-flex" :class="pantalla == 'usuarios' ? 'justify-content-around' : 'justify-content-left'">
                        <div class="selectBuscar">
                            <span class="labelBuscar"> Buscar por dni...</span>
                            <input 
                                class="form-control inputBuscar" 
                                autocomplete="off" 
                                @keyUp="buscarUsuario"
                                v-model="dniBusqueda"
                            >
                        </div>
        
                        <button 
                            type="button" 
                            @click="borrarBusqueda"  
                            class="botonCancelar mx-"
                            v-if="busqueda"    
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row" v-if="usuarios.length != 0">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" >Provincia</th>
                            <th scope="col" >Telefono</th>
                            <th scope="col" >Nombre</th>
                            <th scope="col" >Apellido</th>
                            <th scope="col" >Dni</th>
                            <th scope="col" >Contraseña</th>
                            <th scope="col" >A1</th>
                            <th scope="col" >CT</th>
                            <th scope="col" >Rol</th>
                            <th scope="col" >Mail</th>
                            <th scope="col" >Año</th>
                            <th scope="col" >Habilitado</th>
                            <th scope="col" >Observación</th>
                            <th scope="col" >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="usuario in usuarios">
                            <td >{{(usuario.provincia == 'null' || usuario.provincia == '') ? '-' : usuario.provincia }}</td>
                            <td >{{(usuario.telefono == '0' || usuario.telefono == 0) ? '-' : usuario.telefono }}</td>
                            <td >{{usuario.nombre}}</td>
                            <td >{{usuario.apellido}}</td>
                            <td >{{usuario.dni}}</td>
                            <td >{{usuario.rol == 'postulante' ? usuario.pass : '-'}}</td>
                            <td >{{usuario.raven}}</td>      
                            <td >{{usuario.ct}}</td>
                            <td >{{usuario.rol}}</td>
                            <td >{{usuario.mail}}</td>
                            <td >{{usuario.anio}}</td>
                            <td >{{usuario.habilitado == 1 ? "Sí" : "No"}}</td>
                            <td >
                                <div class="text-center" v-if="usuario.observacion">
                                    <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" :title="usuario.observacion">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>    
                            <td >
                                <div class="dropdown">
                                    <button class="boton dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" @click="habilitarTest(usuario)" href="#">
                                                Habilitar Test
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" @click="cambiarDni(usuario)" href="#">
                                                Cambiar dni
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" @click="eliminarUsuario(usuario)" href="#">
                                                ELIMINAR USUARIO
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" @click="verRespuestas(usuario)" href="#">
                                                Ver respuestas
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a class="dropdown-item" @click="bloquear(usuario)" href="#">
                                                Bloquear usuario
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row my-5 px-0" v-if="mostrarResultados">
                <div class="col-12 px-0">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        ACTIVIDAD 1 - RAVEN
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    RESPUESTAS RAVEN
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <div class="row d-flex justify-content-around">
                                    <h5 class="col-6 mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            ACTIVIDADES 2 A 6 
                                        </button>
                                    </h5>
                                    <button class="col-6 btn" @click="calcularCT">
                                        CALCULAR CT
                                    </button>
                                </div>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body py-1">
                                    ACTIVIDAD 2 - ÁREA 2
                                    <br>
                                    Habilitado: {{this.usuario.respuestas.habilitado2 == 0 ? "NO" : "SÍ"}}
                                    /
                                    Estado: {{this.usuario.respuestas.estado2 == 2 ? "Terminado" : this.usuario.respuestas.estado2 == 1 ? "Empezado" : "Sin hacer"}}
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-1 p-0" v-for="(u, index) in JSON.parse(this.usuario.respuestas.resultado6)">
                                            <span class="respuesta" :class="u ? 'contestada' : ''">
                                                {{u}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="card-body py-1">
                                    ACTIVIDAD 3 - ÁREA 3
                                    <br>
                                    Habilitado: {{this.usuario.respuestas.habilitado3 == 0 ? "NO" : "SÍ"}}
                                    /
                                    Estado: {{this.usuario.respuestas.estado3 == 2 ? "Terminado" : this.usuario.respuestas.estado3 == 1 ? "Empezado" : "Sin hacer"}}
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-1 p-0" v-for="(u, index) in JSON.parse(this.usuario.respuestas.resultado3)">
                                            <span class="respuesta" :class="u ? 'contestada' : ''">
                                                {{u}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="card-body py-1">
                                    ACTIVIDAD 4 - ÁREA 6
                                    <br>
                                    Habilitado: {{this.usuario.respuestas.habilitado4 == 0 ? "NO" : "SÍ"}}
                                    /
                                    Estado: {{this.usuario.respuestas.estado4 == 2 ? "Terminado" : this.usuario.respuestas.estado4 == 1 ? "Empezado" : "Sin hacer"}}
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-1 p-0" v-for="(u, index) in JSON.parse(this.usuario.respuestas.resultado4)">
                                            <span class="respuesta" :class="u ? 'contestada' : ''">
                                                {{u}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="card-body py-1">
                                    ACTIVIDAD 5 - ÁREA 8
                                    <br>
                                    Habilitado: {{this.usuario.respuestas.habilitado5 == 0 ? "NO" : "SÍ"}}
                                    /
                                    Estado: {{this.usuario.respuestas.estado5 == 2 ? "Terminado" : this.usuario.respuestas.estado5 == 1 ? "Empezado" : "Sin hacer"}}
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-1 p-0" v-for="(u, index) in JSON.parse(this.usuario.respuestas.resultado5)">
                                            <span class="respuesta" :class="u ? 'contestada' : ''">
                                                {{u}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="card-body py-1">
                                    ACTIVIDAD 6 - ÁREA 9
                                    <br>
                                    Habilitado: {{this.usuario.respuestas.habilitado6 == 0 ? "NO" : "SÍ"}}
                                    /
                                    Estado: {{this.usuario.respuestas.estado6 == 2 ? "Terminado" : this.usuario.respuestas.estado6 == 1 ? "Empezado" : "Sin hacer"}}
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-1 p-0" v-for="(u, index) in JSON.parse(this.usuario.respuestas.resultado6)">
                                            <span class="respuesta" :class="u ? 'contestada' : ''">
                                                {{u}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        ACTIVIDAD 3 - ÁREA 3
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    Habilitado: {{this.usuario.respuestas.habilitado3 == 0 ? "NO" : "SÍ"}}
                                    <br>
                                    Estado: {{this.usuario.respuestas.estado3 == 2 ? "Terminado" : this.usuario.respuestas.estado3 == 1 ? "Empezado" : "Sin hacer"}}
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-1 p-0" v-for="(u, index) in JSON.parse(this.usuario.respuestas.resultado3)">
                                            <span class="respuesta" :class="u ? 'contestada' : ''">
                                                {{u}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseActividad4" aria-expanded="false" aria-controls="collapseActividad4">
                                        ACTIVIDAD 4 - ÁREA 4
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseActividad4" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    Habilitado: {{this.usuario.respuestas.habilitado4 == 0 ? "NO" : "SÍ"}}
                                    <br>
                                    Estado: {{this.usuario.respuestas.estado4 == 2 ? "Terminado" : this.usuario.respuestas.estado4 == 1 ? "Empezado" : "Sin hacer"}}
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-1 p-0" v-for="(u, index) in JSON.parse(this.usuario.respuestas.resultado4)">
                                            <span class="respuesta" :class="u ? 'contestada' : ''">
                                                {{u}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseActividad5" aria-expanded="false" aria-controls="collapseActividad5">
                                        ACTIVIDAD 5 - ÁREA 5
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseActividad5" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    Habilitado: {{this.usuario.respuestas.habilitado5 == 0 ? "NO" : "SÍ"}}
                                    <br>
                                    Estado: {{this.usuario.respuestas.estado5 == 2 ? "Terminado" : this.usuario.respuestas.estado5 == 1 ? "Empezado" : "Sin hacer"}}
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-1 p-0" v-for="(u, index) in JSON.parse(this.usuario.respuestas.resultado5)">
                                            <span class="respuesta" :class="u ? 'contestada' : ''">
                                                {{u}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseActividad6" aria-expanded="false" aria-controls="collapseActividad6">
                                        ACTIVIDAD 6 - ÁREA 6
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseActividad6" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    Habilitado: {{this.usuario.respuestas.habilitado6 == 0 ? "NO" : "SÍ"}}
                                    <br>
                                    Estado: {{this.usuario.respuestas.estado6 == 2 ? "Terminado" : this.usuario.respuestas.estado6 == 1 ? "Empezado" : "Sin hacer"}}
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-1 p-0" v-for="(u, index) in JSON.parse(this.usuario.respuestas.resultado6)">
                                            <span class="respuesta" :class="u ? 'contestada' : ''">
                                                {{u}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                  
                </div>
            </div>

             <!-- START MODAL HABILITAR TESTS-->
             <div v-if="modalHabilitarTest">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">HABILITAR TESTS</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalHabilitarTest = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body">
                            <div class="row">  
                                <div class="col-sm-12 d-flex justify-content-center my-1">
                                    <b>¿Habilita al usuario para que realice los test?</b>
                                </div>        
                            </div>           
                            <div class="row">  
                                <div class="col-sm-12 my-1">
                                    NOMBRE:
                                    {{usuario.nombre}}
                                </div>           
                            </div>
                            <div class="row">
                                <div class="col-sm-12 my-1">
                                    DNI:
                                    {{usuario.dni}}
                                </div>   
                            </div>
                            <div class="row">
                                <div class="col-sm-12 my-1">
                                    AÑO:
                                    {{usuario.anio}}
                                </div>   
                            </div>
                            <div class="row">
                                <div class="col-sm-12 my-1">
                                    RAVEN:
                                    {{usuario.raven}}
                                </div>   
                            </div>
                            <div class="row">
                                <div class="col-sm-12 my-1">
                                    CT:
                                    {{usuario.ct}}
                                </div>   
                            </div>
                            <div v-if="!habilitandoTests">
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="botonCancelar" @click="modalHabilitarTest = false" id="" data-dismiss="modal">Cancelar</button>
                                    <button type="button" @click="confirmarHabilitarTests"  class="boton">Habilitar</button>
                                </div>
                            </div>
                            <div v-if="habilitandoTests">
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
            <!-- END MODAL HABILITAR TESTS -->

            <!-- START MODAL CAMBIAR DNI-->
            <div v-if="modalDni">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">HABILITAR TESTS</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalDni = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body">
                            <div class="row">  
                                <div class="col-sm-12 d-flex justify-content-center my-1">
                                    <b>¿Desea modificar el dni?</b>
                                </div>        
                            </div>           
                            <div class="row">  
                                <div class="col-sm-12 my-1">
                                    NOMBRE:
                                    {{usuario.nombre}}
                                </div>           
                            </div>
                            <div class="row">
                                <div class="col-sm-12 my-1">
                                    DNI:
                                    {{usuario.dni}}
                                </div>   
                            </div>
                            <div class="row">
                                <div class="col-sm-12 my-1">
                                    <label for="dni">NUEVO DNI (*)</label>
                                    <input class="form-control" autocomplete="off" maxlength="8" id="dni" v-model="usuario.nuevoDni">
                                </div>
                            </div>
                            <div v-if="!editandoDni">
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="botonCancelar" @click="modalDni = false" id="" data-dismiss="modal">Cancelar</button>
                                    <button type="button" @click="confirmarCambiarDni"  class="boton">Modificar</button>
                                </div>
                            </div>
                            <div v-if="editandoDni">
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

            <!-- START MODAL CAMBIAR DNI-->
            <div v-if="modalEliminacion">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">HABILITAR TESTS</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalDni = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body">
                            <div class="row">  
                                <div class="col-sm-12 d-flex justify-content-center my-1">
                                    <b>¿Desea eliminar el usuario?</b>
                                </div>        
                            </div>           
                            <div class="row">  
                                <div class="col-sm-12 my-1">
                                    NOMBRE:
                                    {{usuario.nombre}}
                                </div>           
                            </div>
                            <div class="row">
                                <div class="col-sm-12 my-1">
                                    DNI:
                                    {{usuario.dni}}
                                </div>   
                            </div>
                            <div v-if="!eliminandoUsuario">
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="botonCancelar" @click="modalDni = false" id="" data-dismiss="modal">Cancelar</button>
                                    <button type="button" @click="confirmarEliminarUsuario"  class="boton">Eliminar</button>
                                </div>
                            </div>
                            <div v-if="eliminandoUsuario">
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


            <div class="contenedorTabla" v-if="usuarios.length == 0">
                <span class="sinResultados">
                    NO SE ENCONTRÓ RESULTADOS PARA MOSTRAR
                </span>
            </div>  
        </div>
    </div>

    <style scoped>
        th {
            text-transform: uppercase;
        }
        th, td{
            text-align:center;
        }
        .row{
            width: 100;
            margin: auto;
        }
        .inputTabla{
            max-width: 150px;
            border: 1px solid lightgrey;
        }
        .exito{
            color: green;
        }
        .error{
            color: red;
        }
        .modal-content{
            width: 650px !important;
        }
    </style>
    <script>
        var app = new Vue({
            el: "#app",
            components: {
            },
            data: {
                usuarios: [],
                rol: "",
                pantalla: null,
                idVoluntario: null,
                dniBusqueda: null,
                busqueda: null,
                tituloToast: null,
                textoToast: null,
                //
                //
                usuario: null,
                //
                modalHabilitarTest: false,
                habilitandoTests: false,
                //
                //
                modalDni: false,
                editandoDni: false,
                //
                modalEliminacion: false,
                eliminandoUsuario: false,
                //
                mostrarResultados: false
            },
            mounted() {
                this.pantalla = localStorage.getItem("pantalla");
                this.idVoluntario = <?php echo json_encode($_SESSION["idUsuario"]); ?>;
            },
            methods:{
                //
                cambiarDni (usuario) {
                    this.usuario = usuario;
                    this.modalDni = true;
                },
                confirmarCambiarDni () {
                    let formdata = new FormData();
                    formdata.append("id", this.usuario.id);
                    formdata.append("dni", this.usuario.nuevoDni);
                    axios.post("funciones/admin.php?accion=cambiarDni", formdata)
                    .then(function(response){ 
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            app.mostrarToast("Éxito", "El dni se modificó correctamente");
                            app.modalDni = false;
                            app.dniBusqueda = app.usuario.nuevoDni;
                            app.usuario = null;
                            app.buscarUsuario()
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo editar el dni");
                    });
                },
                //
                //
                habilitarTest (usuario) {
                    this.usuario = usuario;
                    this.modalHabilitarTest = true;
                },
                confirmarHabilitarTests () {
                    let formdata = new FormData();
                    formdata.append("id", this.usuario.id);
                    let observacion = this.usuario.observacion + "Se habilita la toma de test nuevamente. Resultados anteriores = Año: " + this.usuario.anio + ", A1: " + this.usuario.raven + ", CT: " + this.usuario.ct;
                    if (observacion.length > 500) {
                        this.mostrarToast("Error", "La observación es muy larga");
                        return;
                    }
                    formdata.append("observacion", observacion);
                    axios.post("funciones/admin.php?accion=habilitarTests", formdata)
                    .then(function(response){ 
                        if (response.data.error) {
                            app.mostrarToast("Error", "No se pudo habilitar al usuario");
                        } else {
                            app.mostrarToast("Éxito", "El usuario se habilito correctamente");
                            app.modalHabilitarTest = false;
                            app.usuario = null;
                            app.buscarUsuario()
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo habilitar al usuario");
                    });
                },
                //
                //
                eliminarUsuario (usuario) {
                    this.usuario = usuario;
                    this.modalEliminacion = true;
                },
                confirmarEliminarUsuario () {
                    let formdata = new FormData();
                    formdata.append("id", this.usuario.id);
                    axios.post("funciones/admin.php?accion=eliminarUsuario", formdata)
                    .then(function(response){ 
                        if (response.data.error) {
                            app.mostrarToast("Error", "No se pudo eliminar el usuario");
                        } else {
                            app.mostrarToast("Éxito", "El usuario se eliminó correctamente");
                            app.modalEliminacion = false;
                            app.usuario = null;
                            app.dniBusqueda = null;
                            app.usuarios = [];  
                            app.busqueda = null;
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo eliminar el usuario");
                    });
                },
                //
                //
                //
                verRespuestas (usuario) {
                    this.usuario = usuario;
                    let formdata = new FormData();
                    formdata.append("id", this.usuario.id);
                    axios.post("funciones/admin.php?accion=verRespuestas", formdata)
                    .then(function(response){ 
                        if (response.data.error) {
                            app.mostrarToast("Error", "No se pudo consultar las respuestas");
                        } else {
                            app.usuario.respuestas = response.data.respuestas[0];
                            app.mostrarResultados = true;
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo consultar las respuestas");
                    });
                },
                calcularCT() {
                    let formdata = new FormData();
                    formdata.append("id", this.usuario.id);
                    axios.post("funciones/accionesActividades.php?accion=calcularCT", formdata)
                    .then(function(response){ 
                        if (response.data.mensaje == "OK") {
                            app.mostrarToast("Éxito", "La actividad se actualizó correctamente.");
                            app.buscarUsuario();
                        } else {
                            app.mostrarToast("ERROR", "Hubo un error al actualizar la actividad. Intente nuevamente")
                        }
                    }).catch( error => {
                        app.mostrarToast("ERROR", "Hubo un error al terminar la actividad. Intente nuevamente")
                    });
                },
                
                


                //
                // FUNCIONES BUSCAR USUARIO
                // getUsuarios () {
                //     axios.post("funciones/admin.php?accion=getUsuarios")
                //     .then(function(response){  
                //         this.usuarios = response.data.usuarios;
                //         this.usuarios.forEach(element => {
                //             app.corregir(element);
                //         })
                //     })
                // },
                // corregir (element) {
                    
                //     let formdata = new FormData();
                //     // this.usuarios.forEach(element => {
                //         formdata.append("id", element.id);
                //         formdata.append("usuario", element.resultado1);
                //         axios.post("funciones/admin.php?accion=corregir", formdata)
                //         .then(function(response){ 
                //             console.log(element.id);
                //             console.log(element.raven);
                //             console.log(response.data.correctas);
                //             console.log("<br>"); 
                //         }).catch( error => {
                //             app.mostrarToast("Error", "No se pudo recuperar los usuarios");
                //         });
                //     // });
                // },
                buscarUsuario() {
                    if (this.dniBusqueda != null && this.dniBusqueda != "" && this.dniBusqueda.length > 5) {
                        this.busqueda = false;
                        let formdata = new FormData();
                        formdata.append("dniBusqueda", this.dniBusqueda);
                        axios.post("funciones/admin.php?accion=buscarUsuario", formdata)
                        .then(function(response){  
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                if (response.data.usuarios != false) {
                                    app.busqueda = true;
                                    app.usuarios = response.data.usuarios
                                } else {
                                    app.usuarios = []
                                }
                            }
                        }).catch( error => {
                            app.mostrarToast("Error", "No se pudo recuperar los usuarios");
                        });
                    }
                },
                borrarBusqueda(){
                   this.dniBusqueda = null;
                   this.busqueda = false;
                   this.usuarios = [];
                },
               
              
                irA(param) {
                    switch (param) {
                        case "inicio":
                            window.location.href = 'home.php';        
                            break;
                    
                        case "asignados":
                            window.location.href = 'asignados.php';        
                            break;

                        case "usuarios":
                            window.location.href = 'usuarios.php';        
                            break;
                        default:
                            break;
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