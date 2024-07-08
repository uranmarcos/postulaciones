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
    <script src="js/shared.js"></script>
    <link href="css/general.css" rel="stylesheet"> 
    <link href="css/notificacion.css" rel="stylesheet"> 
  
 
</head>
<body>
    <?php require("shared/header.php")?>
    <div id="app">
        <div class=" contenedor">
            <!-- START BREADCRUMB -->
            <div class="col-12 p-0">
                <div class="breadcrumb">
                    <span class="pointer" @click="irA('inicio')">Inicio</span>
                    <span class="mx-2 grey"> - Seguimiento </span>
                </div>
            </div>
            <!-- END BREADCRUMB -->
         
            <!-- START OPCIONES USUARIOS -->
            <div class="row d-flex justify-content-between mb-3">
                
                <div class="col-12 px-0">
                    <div class="row d-flex justify-content-between">
                        
                        <div class="selectBuscar">
                            <span class="labelBuscar"> Agregar al seguimiento...</span>
                                
                            <select class="form-control selectAgregar"  @change="agregarUsuario(usuarioSelect)" v-model="usuarioSelect">
                                <option value="default" disabled>Seleccionar de mis asignados</option>
                                <option v-for="opcion in asignados" :disabled="desabilitarOpcion(opcion.id)" v-bind:value="opcion">{{opcion.dni + " - " + opcion.nombre + " " + opcion.apellido}}</option>
                            </select>
                        </div>
                        
                        <!-- <button type="button" class="boton botonActualizar" @click="getUsuariosSeguimiento()">
                            ACTUALIZAR
                        </button> -->
                        <button type="button" class="boton" @click="modalDni = true">
                            <span  data-toggle="tooltip" data-placement="bottom" 
                            title="Permite agregar por dni, sin importar a quien esté asignado. Si el usuario que busca no aparece con el dni, puede que no exista o n esté habilitado para realizar los test">
                            AGREGAR POR DNI
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>                                    </svg>
                            </span>
                        </button>

                        <button type="button" class="boton" @click="modalTerminar = true" v-if="usuarios.length != 0">
                            TERMINAR SEGUIMIENTO
                        </button>

                    </div>
                </div>
            </div>
         
            <!-- END OPCIONES USUARIOS -->

            <!-- START COMPONENTE LOADING BUSCANDO USUARIOS -->
            <div class="contenedorLoading" v-if="buscandoUsuarios">
                <div class="loading">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
            <!-- END COMPONENTE LOADING BUSCANDO USUARIOS -->
   
            <!-- START TABLA -->
            <div v-else>
                <div v-if="usuarios.length != 0">
                    <div class="row d-flex justify-content-between mt-0 mb-3">
                    
                        <div class="col-12 col-sm-6 px-0 actualizacion">
                            Información actualizada a las: {{ultimaActualizacion}}  
                        </div>  
                        <div class="col-12 col-sm-6 px-0 d-flex justify-content-end">
                            <button type="button" class="boton botonActualizar" @click="getUsuariosSeguimiento()">
                                ACTUALIZAR
                            </button>
                        </div>
                    </div>
                    <div>
                        <section class="row my-2" v-for="usuario in usuarios">
                            <nav class="my-2 row">
                                <div class="col-12 px-0  col-sm-4">
                                    <span class="campoUsuario">
                                        Nombre:
                                    </span> 
                                    <b>{{usuario.nombre}} {{usuario.apellido}}</b>
                                    <br>
                                    <span class="campoUsuario">
                                        DNI:
                                    </span>
                                    <b>{{usuario.dni}}</b>
                                    <br>
                                    <span class="campoUsuario">
                                        Contraseña:
                                    </span>
                                    <b>{{usuario.pass}}</b>
                                </div>
                                <div class="col-12 col-sm-2 d-flex align-items-center justify-content-center">
                                    
                                    <b>
                                        {{
                                            usuario.estado1 == 0 ? 'No empezó' :
                                            usuario.estado1 == 1 ? 'Empezó Actividad 1' :
                                            usuario.estado1 == 2 && usuario.estado2 == 0  ? 'Terminó Actividad 1' :
                                            usuario.estado2 == 1 ? 'Empezó Actividad 2' :
                                            usuario.estado2 == 2 && usuario.estado3 == 0  ? 'Terminó Actividad 2' :
                                            usuario.estado3 == 1 ? 'Empezó Actividad 3' :
                                            usuario.estado3 == 2 && usuario.estado4 == 0  ? 'Terminó Actividad 3' :
                                            usuario.estado4 == 1 ? 'Empezó Actividad 4' :
                                            usuario.estado4 == 2 && usuario.estado5 == 0  ? 'Termino Actividad 4' :
                                            usuario.estado5 == 1 ? 'Empezó Actividad 5' :
                                            usuario.estado5 == 2 && usuario.estado6 == 0  ? 'Terminó Actividad 5' :
                                            usuario.estado6 == 1 ? 'Empezó Actividad 6' :
                                            'Terminó Actividad 6'

                                        }}
                                    </b>
                                </div>
                                <div class="col-12 col-sm-2 d-flex align-items-center justify-content-center">
                                    <b>
                                        A1: 
                                    
                                        {{usuario.raven}}
                                        <br>
                                        
                                        CT: 
                                        {{usuario.ct}}
                                    </b>
                                </div>
                                <div class="col-12 col-sm-4 d-flex px-0 justify-content-end">
                                    <div class="text-center mx-1 " v-if="usuario.observacion">
                                        <button type="button" class="btnObservacion btn-danger" data-toggle="tooltip" data-placement="bottom" :title="usuario.observacion">    
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btnNuevo dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                            </svg>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" @click="eliminarUsuario(usuario)" href="#">
                                                    Terminar seguimiento
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" @click="resetear(usuario)" href="#">
                                                    Resetear Contraseña
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" @click="observar(usuario)" href="#">
                                                    Agregar Observación
                                                </a>
                                            </li>
                                        </ul>
                                    </div>    
                                    <!-- <button type="button" @click="cambiarDetalle(usuario.id)" class="btnNuevo mx-1  btn-danger">    
                                        VER
                                    </button>         -->
                                </div>
                            </nav>
                            <article class="col-12">     
                                <div class="contenedorTest py-2 row">       
                                    <div class="col-6 col-sm-4 col-md-2 cajaTest" :class="usuario.estado1 == 2 ? 'terminado' : ''" @click="verDetalle(usuario, 'actividad1')">
                                        <b>ACTIVIDAD 1</b>
                                        <br>
                                        {{
                                            usuario.estado1 == 0 ? "Sin Hacer" :
                                            usuario.estado1 == 1 ? "Empezado" :
                                            "Terminado" 
                                        }}
                                        <br>
                                        <span>
                                            Nivel actual: {{ usuario.nivel != 0 ? usuario.nivel : '-' }}
                                        </span><br>
                                        <span>
                                            Tiempo: {{ convertirTiempo(usuario.tiempo) }}
                                        </span><br>
                                        <span :class="usuario.habilitado1 == 0 ? 'bloqueo' : 'exito'">
                                            {{
                                                usuario.habilitado1 == 0 ? "Bloqueado" : "Habilitado"
                                            }}
                                        </span>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-2 cajaTest" :class="usuario.estado2 == 2 ? 'terminado' : ''" @click="verDetalle(usuario, 'actividad2')">
                                        <b>ACTIVIDAD 2</b>
                                        <br>
                                        {{
                                            usuario.estado2 == 0 ? "Sin Hacer" :
                                            usuario.estado2 == 1 ? "Empezado" :
                                            "Terminado" 
                                        }}
                                        <br>
                                        <span :class="usuario.habilitado2 == 0 ? 'bloqueo' : 'exito'">
                                            {{
                                                usuario.habilitado2 == 0 ? "Bloqueado" : "Habilitado"
                                            }}
                                        </span>
                                    </div>
                                    
                                    <div class="col-6 col-sm-4 col-md-2 cajaTest" :class="usuario.estado3 == 2 ? 'terminado' : ''" @click="verDetalle(usuario, 'actividad3')">
                                        <b>ACTIVIDAD 3</b>
                                        <br>
                                        {{
                                            usuario.estado3 == 0 ? "Sin Hacer" :
                                            usuario.estado3 == 1 ? "Empezado" :
                                            "Terminado" 
                                        }}
                                        <br>
                                        <span :class="usuario.habilitado3 == 0 ? 'bloqueo' : 'exito'">
                                            {{
                                                usuario.habilitado3 == 0 ? "Bloqueado" : "Habilitado"
                                            }}
                                        </span>
                                    </div>
                                                
                                    <div class="col-6 col-sm-4 col-md-2 cajaTest" :class="usuario.estado4 == 2 ? 'terminado' : ''" @click="verDetalle(usuario, 'actividad4')">
                                        <b>ACTIVIDAD 4</b>
                                        <br>
                                        {{
                                            usuario.estado4 == 0 ? "Sin Hacer" :
                                            usuario.estado4 == 1 ? "Empezado" :
                                            "Terminado" 
                                        }}
                                        <br>
                                        <span :class="usuario.habilitado4 == 0 ? 'bloqueo' : 'exito'">
                                            {{
                                                usuario.habilitado4 == 0 ? "Bloqueado" : "Habilitado"
                                            }}
                                        </span>
                                    </div>
                                            
                                    <div class="col-6 col-sm-4 col-md-2 cajaTest" :class="usuario.estado5 == 2 ? 'terminado' : ''" @click="verDetalle(usuario, 'actividad5')">
                                        <b>ACTIVIDAD 5</b>
                                        <br>
                                        {{
                                            usuario.estado5 == 0 ? "Sin Hacer" :
                                            usuario.estado5 == 1 ? "Empezado" :
                                            "Terminado" 
                                        }}
                                        <br>
                                        <span :class="usuario.habilitado5 == 0 ? 'bloqueo' : 'exito'">
                                            {{
                                                usuario.habilitado5 == 0 ? "Bloqueado" : "Habilitado"
                                            }}
                                        </span>
                                    </div>
                                        
                                    <div class="col-6 col-sm-4 col-md-2 cajaTest" :class="usuario.estado6 == 2 ? 'terminado' : ''" @click="verDetalle(usuario, 'actividad6')">
                                        <b>ACTIVIDAD 6</b>
                                        <br>
                                        {{
                                            usuario.estado6 == 0 ? "Sin Hacer" :
                                            usuario.estado6 == 1 ? "Empezado" :
                                            "Terminado" 
                                        }}
                                        <br>
                                        <span :class="usuario.habilitado6 == 0 ? 'bloqueo' : 'exito'">
                                            {{
                                                usuario.habilitado6 == 0 ? "Bloqueado" : "Habilitado"
                                            }}
                                        </span>
                                    </div>
                                </div>           
                            </article>
                        </section>
                    </div>
                  
                </div>
             
                <div class="contenedorTabla" v-else>
                    <span class="sinResultados">
                        PARA COMENZAR AGREGUE USUARIOS AL SEGUIMIENTO
                    </span>
                </div>  
            </div>
            <!-- END TABLA -->


            <!-- EMPIEZAN COMPONENTES MODAL Y NOTIFICACION -->

            <!-- START MODAL ELIMINAR USUARIO -->
            <div v-if="modalEliminar">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">TERMINAR SEGUIMIENTO</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalEliminar = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body modalBodyEliminar">
                            ¿Desea eliminar a 
                            <br>
                            <b>{{usuarioModal.nombre}}</b>
                            <br>
                            del seguimiento?
                            
                        </div>
                        <div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="botonCancelar" @click="modalEliminar = false" id="" data-dismiss="modal">Cancelar</button>
                                <button type="button" @click="eliminarUsuarioSeguimiento(usuarioModal.id)"  class="boton">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>    
            <!-- END MODAL ELIMINAR USUARIO -->

            <!-- START MODAL TERMINAR SEGUIMIENTO -->
            <div v-if="modalTerminar">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">TERMINAR SEGUIMIENTO</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalTerminar = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body modalBodyEliminar">
                            ¿Desea terminar el seguimiento?
                            
                        </div>
                        <div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="botonCancelar" @click="modalTerminar = false" id="" data-dismiss="modal">Cancelar</button>
                                <button type="button" @click="limpiarSeguimiento()"  class="boton">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>    
            <!-- END MODAL TERMINAR SEGUIMIENTO -->

            <!-- START MODAL BUSCAR POR DNI -->
            <div v-if="modalDni">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">BUSCAR POR DNI</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="cerrarModalDni()" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                        
                        <div class="modal-body modalBodyEliminar">
                            <span class="ayudaModal">
                                Permite agregar por dni, sin importar a quien esté asignado. 
                                Si el usuario que busca no aparece con el dni, puede que no exista o no esté habilitado para realizar los test
                            </span>
                            <input 
                                class="form-control inputBuscar" 
                                autocomplete="off" 
                                @keyUp="buscarUsuario"
                                v-model="dniBusqueda"
                            >
                        </div>
                        <div class="row">
                            <div class="col-10 px-0">
                                <span v-for="(usuario, index) in usuariosBuscados" :class="index == 0 ? 'mx-0' : 'mx-1' ">
                                    <button class="badge text-bg-success pointer m-2" :disabled="permitirUsuarioBuscado(usuario)" @click="agregarUsuario(usuario)"> 
                                        {{usuario.nombre}} {{usuario.apellido}} 
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="botonCancelar" @click="cerrarModalDni()" id="" data-dismiss="modal">CERRAR</button>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>    
            <!-- END MODAL BUSCAR POR DNI-->

            <!-- START MODAL DETALLE -->
            <div v-if="modalDetalle">
                <div id="myModal" class="modal">
                    <div class="modal-content modalContentDetalle px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">DETALLE {{actividadModal}}</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="ocultarDetalle" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body">
                            <div class="actualizacionModal">
                                Información actualizada a las: {{ultimaActualizacion}}  
                            </div> 
                            <div class="row">
                                <div class="col-sm-12 mt-3">
                                    {{usuarioModal.id}} - Nombre: <b>{{usuarioModal.nombre}}</b>
                                </div>
                                <div class="col-sm-12 mt-3">
                                    DNI: <b>{{usuarioModal.dni}}</b>
                                    <hr>
                                </div>
                                <div class="col-sm-12 mt-3">
                                    Estado: 
                                    <b>{{usuarioModal.estado == 0 ? "SIN HACER" : usuarioModal.estado == 1 ? "EMPEZADO" : "TERMINADO" }}
                                        / 
                                        {{usuarioModal.habilitado == 0 ? "BLOQUEADO" : "HABILITADO" }}
                                        <button 
                                            @click="actualizarTest(actividadModal, usuarioModal.id, '0')" 
                                            class="botonBloqueo" 
                                            v-if="usuarioModal.habilitado == 1"
                                            :disabled="usuarioModal.estado == 2"
                                        >
                                            BLOQUEAR
                                        </button>
                                        <button 
                                            @click="actualizarTest(actividadModal, usuarioModal.id, '1')" 
                                            class="botonHabilitado" 
                                            v-if="usuarioModal.habilitado == 0 && usuarioModal.estado != 2"
                                            :disabled="usuarioModal.estado == 2"
                                        >
                                            HABILITAR
                                        </button>
                                    </b>
                                </div>

                                <div class="col-sm-12 mt-3" v-if="actividadModal == 'ACTIVIDAD 1'">
                                    Tiempo disponible: {{convertirTiempo(usuarioModal.tiempo)}} minutos
                                    <br>
                                    Modificar Tiempo:
                                    <input type="number" max="45" min="1" v-model="tiempoAsignable"> 
                                    <button 
                                        @click="asignarTiempo(usuarioModal.id, tiempoAsignable)" 
                                        class="botonHabilitado" 
                                        :disabled="usuarioModal.estado == 2"
                                        >
                                        MODIFICAR
                                    </button>
                                    
                                </div>

                                <div class="col-sm-12 mt-3" v-if="actividadModal == 'ACTIVIDAD 1'">
                                    Nivel actual: {{usuarioModal.nivel}}                   
                                </div>
                                <div class="col-sm-12 mt-3">
                                    Respuestas (en gris las respondidas): 
                                    <div class="row">
                                        <div class="col-sm-1 p-0" v-for="(u, index) in usuarioModal.respuestas">
                                            <span class="respuesta" :class="u ? 'contestada' : ''">
                                                {{index}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <button type="button" class="boton" @click="ocultarDetalle">CERRAR</button>
                            </div>
                        </div>
                    </div>
                    
                </div>    
            </div>    
            <!-- END MODAL DETALLE -->

            <!-- START MODAL RESETEAR CONTRASEÑA -->
            <div v-if="modalResetear">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">
                                Resetear contraseña
                            </h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="cancelarResetear()" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mt-3 d-flex justify-content-center" >
                                    ¿Desea resetear la contraseña al usuario?
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="nombre">Usuario</label>
                                    <input disabled class="form-control" v-model="usuarioModal.nombre">
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="nombre">DNI</label>
                                    <input disabled class="form-control" v-model="usuarioModal.dni">
                                </div>
                            </div>
                        </div>
                        <div v-if="!reseteando">
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="botonCancelar" @click="cancelarResetear()" id="" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="boton" @click="confirmarResetear(usuarioModal)">Confirmar</button>
                            </div>
                        </div>
                        <div v-if="reseteando">
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
            <!-- END MODAL RESETEAR CONTRASEÑA -->      
            
            <!-- START MODAL OBSERVAR USUARIO -->
            <div v-if="modalObservar">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">
                                Agregar Observacion
                            </h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="cancelarObservar()" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mt-3">
                                    {{usuarioModal.dni}} - {{usuarioModal.nombre}}
                                    
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="nombre">OBSERVACIÓN</label>
                                    <textarea class="form-control" @keydown="changeContador(usuarioModal.observacion)" maxlength="500" id="mensaje" v-model="usuarioModal.observacion">

                                    </textarea>
                                    <div id="contador">0/100</div>
                                </div>
                            </div>
                        </div>
                        <div v-if="!observando">
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="botonCancelar" @click="cancelarObservar()" id="" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="boton" @click="confirmarObservar(usuarioModal)">Confirmar</button>
                            </div>
                        </div>
                        <div v-if="observando">
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
            <!-- END MODAL RESETEAR CONTRASEÑA --> 
        
            <!-- START NOTIFICACION -->
            <div role="alert" id="mitoast" @mouseover="ocultarToast" aria-live="assertive" aria-atomic="true" class="toast">
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
        .btnObservacion{
            width: 80px;
            color: #E52008;
            font-size: 18px;
            height: 40px;
            background: none;
            border: solid 1px #E52008;
        }
        .btnObservacion:hover{
            background: #E52008;
            color: white;
        }
        .btnNuevo{
            width: 80px;
            color: rgb(124, 69, 153);
            font-size: 18px;
            height: 40px;
            background: none;
            border: solid 1px rgb(124, 69, 153);
        }
        .btnNuevo:hover{
            background: rgb(124, 69, 153);
            color: white;
        }
        .campoUsuario{
            display:inline;   
            margin:0;
            width: 150px !important;
            text-align:right;
        }
        section{
            border: solid 1px grey !important;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .ayudaModal{
            font-size: 12px;
            justify-content: center; 
        }
        .respuesta{
            text-align: center;
            display: flex;
            border: solid 1px grey;
            justify-content: center;
            width: 100%;
        }
        .contestada{
            background: lightgrey;
        }
        .actualizacion{
            font-size: 18px ;
            color: green;
            margin: 5px 0;
        }
        .actualizacionModal{
            font-size: 18px ;
            color: green;
            text-align: center;
            margin: 0;
        }
        .botonActualizar{
            color: green;
            height: 37px;
            border: solid 1px green;
        }
        .botonActualizar:hover{
            background: green;
            color: white;
            border: solid 1px green;
        }
        .pointer{
            cursor: pointer;
        }
        textarea{
            min-height: 250px !important;
            width: 300px;
            font-size: 10   px;
        }
        .selectAgregar{
            position: relative:
            top: 0;
        }
        .modalBodyEliminar{
            width: 100%;
            text-align: center;
        }
        .botonBloqueo{
            background:white;
            color: red;
            border: solid 1px red; 
        }
        .botonBloqueo:hover{
            background:red;
            color: white;
            border: solid 1px red; 
        }
        .botonHabilitado{
            background:white;
            color: green;
            border: solid 1px green; 
        }
        .botonHabilitado:hover{
            background:green;
            color: white;
            border: solid 1px green; 
        }
        .deleteUsuario{
            margin: 0 5px;
        }
        .deleteUsuario:hover{
            cursor: pointer;
        }
        .botonSeguimiento{
            height: 36px;
            font-size: 12px !important;
        }
        .badge{
            height: 36px !important;
            padding: 10px 5px;
            font-size: 16px;
            color: rgb(124, 69, 153) !important;
            background-color: lightgrey !important;
        }
        .cajaUsuario{
            width: 120px;
            display: flex;
            align-items: center;
            flex-direction: column;
        }
        .cajaTest{
            margin: 5px 0;
            border: solid 1px grey;
            border-radius: 5px;
            min-height:100px;
            
            /* width: 150px; */
        }
        .contenedorTest{
            display: flex;
            justify-content: space-around;
        }
        .cajaTest:hover{
            cursor: pointer;
            background: lightgrey;
        }
        .exito{
            color: green;
        }
        .bloqueo{
            color:red;
        }
        .terminado {
            background: #75B956;
            color: white;
        }
        .modalContentDetalle{
            width: 600px;
        }
            
    </style>
    <script>
        var app = new Vue({
            el: "#app",
            components: {
            },
            data: {
                buscandoUsuarios: false,
                modalDetalle: false,
                usuarioModal: {},
                actividadModal: "",
                idVoluntario: null,
                asignados: [],
                usuarioSelect: "default",
                seguidos: [],
                modalTerminar: false,
                modalDni: false,
                modalEliminar: false,
                usuarios: [],       
                tiempoAsignable: null,   
                usuariosBuscados: [],
                dniBusqueda: null,    
                modalObservar: false,
                observando: false,
                ultimaActualizacion: null,
                
                
                
                ///
                modalResetear: false,
                reseteando: false,
                buscando: false,
                tituloToast: null,
                textoToast: null
            },
            mounted () {
                this.seguidos = localStorage.getItem("usuariosSeguimiento") ? JSON.parse(localStorage.getItem("usuariosSeguimiento")) : [];
                this.idVoluntario = <?php echo json_encode($_SESSION["idUsuario"]); ?>;
                this.consultarAsignados();
                if (this.seguidos.length > 0) {
                    this.getUsuariosSeguimiento();
                }
            },
            methods:{
                cambiarDetalle (id) {
                    console.log(id);
                },
                changeContador(observacion) {
                    if (observacion) {
                        document.getElementById("contador").innerHTML = observacion.length + "/500";
                    }
                },
                convertirTiempo(segundos) {
                    const minutos = Math.floor(segundos / 60);
                    const segundosRestantes = segundos % 60;

                    const tiempoFormateado = `${minutos}:${segundosRestantes.toString().padStart(2, '0')}`;

                    return tiempoFormateado;
                },
                cerrarModalDni() {
                    this.modalDni = false;
                    this.usuariosBuscados = [];
                    this.dniBusqueda = null;
                },
                permitirUsuarioBuscado(usuario) {
                    if (this.usuarios.find(element => element.id == usuario.id)) {
                        return true;
                    }
                    return false;
                },
                // FUNCIONES BUSCAR USUARIO
                buscarUsuario() {
                    if (this.dniBusqueda != null && this.dniBusqueda.length > 4) {
                        let formdata = new FormData();
                        formdata.append("dniBusqueda", this.dniBusqueda);
                        axios.post("funciones/seguimiento.php?accion=buscarUsuarioParaSeguimiento", formdata)
                        .then(function(response){
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                if (response.data.usuarios != false) {
                                    app.usuariosBuscados = response.data.usuarios;
                                } else {
                                    app.usuariosBuscados = []
                                }
                            }
                        }).catch( error => {
                            app.mostrarToast("Error", "No se pudo recuperar los usuarios");
                        });
                    } else {
                        this.usuariosBuscados = []
                    }
                },
                asignarTiempo(id, tiempo) {
                    let formdata = new FormData();
                    formdata.append("id", id.trim());
                    if (tiempo > 45) {
                        tiempo = 45 * 60
                    } else {
                        tiempo = tiempo * 60
                    }
                    formdata.append("tiempo", tiempo);
                    axios.post("funciones/seguimiento.php?accion=asignarTiempo", formdata)
                    .then(function(response){  
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.mensaje == "OK") {
                                app.modalDetalle = false
                                app.mostrarToast("Éxito", "Se asignó el tiempo correctamente. El usuario debe actualizar la página para que le tome el nevo tiempo");
                                app.getUsuariosSeguimiento();
                            } else {
                                app.mostrarToast("Error", "Hubo un error. Intente nuevamente");
                            }
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "Hubo un error. Intente nuevamente");
                    });
                },
                desabilitarOpcion (id) {
                    id = id.trim();
                    let usuarios = localStorage.getItem("usuariosSeguimiento") ? JSON.parse(localStorage.getItem("usuariosSeguimiento")) : [];
                    if (usuarios.find(element => element.id.trim() == id)) {
                        return true;
                    }
                    return false;
                },
                agregarUsuario (usuario) {
                    this.crearSeguimiento(usuario);
                },
                crearSeguimiento(usuario) {
                    let formdata = new FormData();
                    formdata.append("idUsuario", usuario.id);
                    axios.post("funciones/asignados.php?accion=crearSeguimiento", formdata)
                    .then(function(response){    
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            app.agregarAlSeguimiento(usuario)
                        }   
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo cargar al usuario para el seguimiento");
                    });
                },
                agregarAlSeguimiento(usuario){
                    this.seguidos.push(usuario)
                    localStorage.setItem("usuariosSeguimiento", JSON.stringify(this.seguidos))
                    // this.getUsuariosSeguimiento();
                    this.getUsuariosSeguimiento();
                    this.usuarioSelect = "default";
                },
                limpiarSeguimiento () {
                    this.seguidos = [];
                    this.usuarios = [];
                    this.ultimaActualizacion = "-";
                    localStorage.removeItem("usuariosSeguimiento");
                    this.modalTerminar = false;
                },
                consultarAsignados (id) {
                    let formdata = new FormData();
                    formdata.append("id", this.idVoluntario.trim());
                    axios.post("funciones/seguimiento.php?accion=getAsignadosSeguimiento", formdata)
                    .then(function(response){  
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.usuarios != false) {
                                app.asignados = response.data.usuarios;
                            } else {
                                app.asignados = []
                            }
                        }
                    }).catch( error => {
                        app.buscandoUsuarios = false;
                        app.mostrarToast("Error", "Hubo un error al recuperar la información. Actualice la página");
                    });
                },
                getUsuariosSeguimiento() {
                    this.usuarios = [];
                    // let u = this.seguidos.split(",");
                    // this.buscandoUsuarios = true;
                    // u.forEach((element, index) => {
                    //     let ultimo = (index == (u.length -1)) ? true : false;
                    //     this.consultarUsuarioSeguimiento(element.trim(), ultimo);
                    // });
                    let ids = "";
                    this.seguidos.forEach((element, index) => {
                        ids = ids + element.id + ", ";
                    });
                    ids = ids.slice(0, -2);
                    this.getSeguimiento(ids);
                },
                eliminarUsuarioSeguimiento (id) {
                    let formdata = new FormData();
                    if (this.seguidos.length > 1) {
                        this.seguidos = this.seguidos.filter(element => element.id != id.trim());
                        localStorage.setItem("usuariosSeguimiento", JSON.stringify(this.seguidos))
                        this.getUsuariosSeguimiento();
                    } else {
                        this.seguidos = [];
                        this.usuarios = [];
                        localStorage.removeItem("usuariosSeguimiento");
                    }
                    app.modalEliminar = false;
                },
                consultarUsuarioSeguimiento(id, ultimo) {
                    let formdata = new FormData();
                    formdata.append("idUsuario", id);
                    axios.post("funciones/seguimiento.php?accion=getUsuarioSeguimiento", formdata)
                    .then(function(response){    
                       
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.usuarios != false) {
                                app.validarEstado(response.data.usuario[0])
                                app.usuarios.push(response.data.usuario[0]);
                                app.usuarios.sort(app.ordenarUsuarios);
                            } else {
                                app.mostrarToast("Error", "No se pudo recuperar todos los usuarios");
                            }
                        }
                        if (ultimo) {
                            var fechaActual = new Date();
                            var hora = app.formatearNumero(fechaActual.getHours());
                            var minuto = app.formatearNumero(fechaActual.getMinutes());
                            var segundo = app.formatearNumero(fechaActual.getSeconds());

                            app.buscandoUsuarios = false;
                            app.ultimaActualizacion = hora + ":" + minuto + ":" + segundo + "hs";
                            app.usuarios.sort(app.ordenarUsuarios);
                        }
                    }).catch( error => {
                        if (ultimo) {
                            app.buscandoUsuarios = false;
                        }
                        app.mostrarToast("Error", "No se pudo recuperar todos los usuarios");
                    });
                },
                getSeguimiento(ids) {
                    this.buscandoUsuarios = true;
                    let formdata = new FormData();
                    formdata.append("ids", ids);
                    axios.post("funciones/seguimiento.php?accion=getSeguimiento", formdata)
                    .then(function(response){    
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.usuarios != false) {
                                app.usuarios = response.data.usuario
                                app.validarEstado()
                            } else {
                                app.mostrarToast("Error", "No se pudo recuperar todos los usuarios");
                            }
                        }
                        
                        var fechaActual = new Date();
                        var hora = app.formatearNumero(fechaActual.getHours());
                        var minuto = app.formatearNumero(fechaActual.getMinutes());
                        var segundo = app.formatearNumero(fechaActual.getSeconds());

                        app.buscandoUsuarios = false;
                        app.ultimaActualizacion = hora + ":" + minuto + ":" + segundo + "hs";
                        setTimeout(() => {
                            app.actualizar()
                        }, 60000);
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo recuperar todos la información");
                    });
                },
                actualizar() {
                    let ids = "";
                    this.seguidos.forEach((element, index) => {
                        ids = ids + element.id + ", ";
                    });
                    ids = ids.slice(0, -2);
                    let formdata = new FormData();
                    formdata.append("ids", ids);
                    axios.post("funciones/seguimiento.php?accion=getSeguimiento", formdata)
                    .then(function(response){    
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.usuarios != false) {
                                app.usuarios = [];
                                app.usuarios = response.data.usuario
                                app.validarEstado()
                            } else {
                                app.mostrarToast("Error", "No se pudo recuperar todos los usuarios");
                            }
                        }
                        
                        var fechaActual = new Date();
                        var hora = app.formatearNumero(fechaActual.getHours());
                        var minuto = app.formatearNumero(fechaActual.getMinutes());
                        var segundo = app.formatearNumero(fechaActual.getSeconds());

                        app.ultimaActualizacion = hora + ":" + minuto + ":" + segundo + "hs";
                        setTimeout(() => {
                            app.actualizar()
                        }, 60000);
                    }).catch( error => {
                        // if (ultimo) {
                        //     app.buscandoUsuarios = false;
                        // }
                        app.mostrarToast("Error", "No se pudo recuperar todos los usuarios");
                    });
                },
                validarEstado() {
                    this.usuarios.forEach(element => {
                        if (
                            element.estado1 == 2 &&
                            element.estado2 == 2 &&
                            element.estado3 == 2 &&
                            element.estado4 == 2 &&
                            element.estado5 == 2 &&
                            element.estado6 == 2
                        ) {
                            this.mostrarToast("Éxito", "El usuario " + element.nombre + " " + element.apellido + " terminó sus actividades");
                        }
                    });
                    // console.log(usuario);
                },
                formatearNumero(valor) {
                    return valor < 10 ? "0" + valor : valor;
                },
                ordenarUsuarios (a,b) {
                    if (a.apellido === b.apellido) {
                        // Si los apellidos son iguales, compara por nombre
                        if (a.nombre < b.nombre) {
                        return -1;
                        }
                        if (a.nombre > b.nombre) {
                        return 1;
                        }
                        return 0;
                    } else {
                        // Compara por apellido
                        if (a.apellido < b.apellido) {
                        return -1;
                        }
                        if (a.apellido > b.apellido) {
                        return 1;
                        }
                        return 0;
                    }
                },
                ocultarDetalle () {
                    this.modalDetalle = false;
                    this.usuarioModal = {};
                    this.actividadModal = null;
                },
                eliminarUsuario (usuario) {
                    this.usuarioModal.nombre = usuario.nombre + " " + usuario.apellido;
                    this.usuarioModal.dni = usuario.dni;
                    this.usuarioModal.id = usuario.id;
                    this.modalEliminar = true;
                },
                verDetalle (usuario, actividad) {
                    this.usuarioModal.nombre = usuario.nombre + " " + usuario.apellido;
                    this.usuarioModal.dni = usuario.dni;
                    this.usuarioModal.id = usuario.id;
                    this.tiempoAsignable = null;
                    if (actividad == "actividad1") {
                        this.usuarioModal.estado = usuario.estado1;
                        this.usuarioModal.habilitado = usuario.habilitado1;
                        this.usuarioModal.respuestas = usuario.resultado1 != '-' ? JSON.parse(usuario.resultado1) : [];
                        this.usuarioModal.tiempo = usuario.tiempo;
                        this.usuarioModal.nivel = usuario.nivel;
                        this.actividadModal = "ACTIVIDAD 1";
                    }
                    if (actividad == "actividad2") {
                        this.usuarioModal.estado = usuario.estado2;
                        this.usuarioModal.habilitado = usuario.habilitado2;
                        this.usuarioModal.respuestas = usuario.resultado2 != '-' ? JSON.parse(usuario.resultado2) : [];
                        this.actividadModal = "ACTIVIDAD 2";
                    }
                    if (actividad == "actividad3") {
                        this.usuarioModal.estado = usuario.estado3;
                        this.usuarioModal.habilitado = usuario.habilitado3;
                        this.usuarioModal.respuestas = usuario.resultado3 != '-' ? JSON.parse(usuario.resultado3) : [];
                        this.actividadModal = "ACTIVIDAD 3";
                    }
                    if (actividad == "actividad4") {
                        this.usuarioModal.estado = usuario.estado4;
                        this.usuarioModal.habilitado = usuario.habilitado4;
                        this.usuarioModal.respuestas = usuario.resultado4 != '-' ? JSON.parse(usuario.resultado4) : [];
                        this.actividadModal = "ACTIVIDAD 4";
                    }
                    if (actividad == "actividad5") {
                        this.usuarioModal.estado = usuario.estado5;
                        this.usuarioModal.habilitado = usuario.habilitado5;
                        this.usuarioModal.respuestas = usuario.resultado5 != '-' ? JSON.parse(usuario.resultado5) : [];
                        this.actividadModal = "ACTIVIDAD 5";
                    }
                    if (actividad == "actividad6") {
                        this.usuarioModal.estado = usuario.estado6;
                        this.usuarioModal.habilitado = usuario.habilitado6;
                        this.usuarioModal.respuestas = usuario.resultado6 != '-' ? JSON.parse(usuario.resultado6) : [];
                        this.actividadModal = "ACTIVIDAD 6";
                    }
                    this.modalDetalle = true;
                },
                actualizarTest(actividad, id, estado) {
                    let formdata = new FormData();
                    formdata.append("id", id);
                    if (actividad == "ACTIVIDAD 1") {
                        formdata.append("actividad", "habilitado1");
                    }
                    if (actividad == "ACTIVIDAD 2") {
                        let usuario = this.usuarios.filter(element => element.id == id)[0];
                        if (estado == 1 && usuario.estado1 != 2) {
                            this.mostrarToast("ERROR", "Debe terminar la actividad 1 para que se le pueda habilitar la 2")
                            return;
                        }
                        formdata.append("actividad", "habilitado2");
                    }
                    if (actividad == "ACTIVIDAD 3") {
                        let usuario = this.usuarios.filter(element => element.id == id)[0];
                        if (estado == 1 && usuario.estado2 != 2) {
                            this.mostrarToast("ERROR", "Debe terminar la actividad 2 para que se le pueda habilitar la 3")
                            return;
                        }
                        formdata.append("actividad", "habilitado3");
                    }
                    if (actividad == "ACTIVIDAD 4") {
                        let usuario = this.usuarios.filter(element => element.id == id)[0];
                        if (estado == 1 && usuario.estado3 != 2) {
                            this.mostrarToast("ERROR", "Debe terminar la actividad 3 para que se le pueda habilitar la 4")
                            return;
                        }
                        formdata.append("actividad", "habilitado4");
                    }
                    if (actividad == "ACTIVIDAD 5") {
                        let usuario = this.usuarios.filter(element => element.id == id)[0];
                        if (estado == 1 && usuario.estado4 != 2) {
                            this.mostrarToast("ERROR", "Debe terminar la actividad 4 para que se le pueda habilitar la 5")
                            return;
                        }
                        formdata.append("actividad", "habilitado5");
                    }
                    if (actividad == "ACTIVIDAD 6") {
                        let usuario = this.usuarios.filter(element => element.id == id)[0];
                        if (estado == 1 && usuario.estado5 != 2) {
                            this.mostrarToast("ERROR", "Debe terminar la actividad 5 para que se le pueda habilitar la 6")
                            return;
                        }
                        formdata.append("actividad", "habilitado6");
                    }
                    
                    formdata.append("estado", estado);
                    axios.post("funciones/seguimiento.php?accion=actualizarTest", formdata)
                    .then(function(response){    
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            app.mostrarToast("Éxito", response.data.mensaje);
                            app.getUsuariosSeguimiento();
                            app.modalDetalle = false;
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo recuperar todos los usuarios");
                    });
                },

                // FUNCIONES RESETEAR CONTRASEÑA
                    resetear (usuario) {
                        this.modalResetear = true;
                        this.usuarioModal.id = usuario.id;
                        this.usuarioModal.dni = usuario.dni;
                        this.usuarioModal.nombre = usuario.nombre + ' ' + usuario.apellido ;
                    },
                    cancelarResetear () {
                        this.modalResetear = false;
                        this.usuarioModal = {};
                    },
                    confirmarResetear (usuario) {
                        this.reseteando = true;
                        let formdata = new FormData();
                        formdata.append("idUsuario", usuario.id);                    
                        axios.post("funciones/usuarios.php?accion=resetear", formdata)
                        .then(function(response){
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                app.modalResetear = false;
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.getUsuariosSeguimiento();
                                app.usuarioModal = {};
                            }
                            app.reseteando = false;
                        }).catch( error => {
                            app.reseteando = false;
                            app.mostrarToast("Error", "No se pudo resetar la contraseña");
                        })
                    },
                // FUNCIONES RESETEAR CONTRASEÑA

                // FUNCIONES OBSERVAR USUARIO
                    observar (usuario) {
                        this.modalObservar = true;
                        this.usuarioModal.id = usuario.id;
                        this.usuarioModal.dni = usuario.dni;
                        this.usuarioModal.observacion = usuario.observacion;
                        this.usuarioModal.nombre = usuario.nombre + ' ' + usuario.apellido ;
                    },
                    cancelarObservar () {
                        this.modalObservar = false;
                        this.usuarioModal = {};
                    },
                    confirmarObservar (usuario) {
                        this.observando = true;
                        let formdata = new FormData();
                    
                        formdata.append("idUsuario", usuario.id);    
                        formdata.append("observacion", usuario.observacion);                    
                        axios.post("funciones/seguimiento.php?accion=observar", formdata)
                        .then(function(response){
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                app.modalObservar = false;
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.getUsuariosSeguimiento();
                                app.usuarioModal = {};
                            }
                            app.observando = false;
                        }).catch( error => {
                            app.observando = false;
                            app.mostrarToast("Error", "No se pudo agregar la observacion");
                        })
                    },
                // FUNCIONES OBSERVAR USUARIO

              

                mostrarToast(titulo, texto) {
                    this.tituloToast = titulo;
                    this.textoToast = texto;
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
            }
        })
    </script>
</body>
</html>