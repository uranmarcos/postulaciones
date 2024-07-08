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
            <!-- END BREADCRUMB -->
         
            <!-- START OPCIONES USUARIOS -->
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
                    
                                
                <div class="col-12 col-md-4 px-0">
                    <div class="row d-flex justify-content-end">
                        <div class="col-10  px-0 d-flex justify-content-end">
                            <div class="dropdown mx-3">
                                <button class="boton dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    DESCARGAR EXCEL
                                </button>
                                <ul class="dropdown-menu" >
                                    <li>
                                        <a class="dropdown-item" href="#" @click="exportarPendientes()">
                                            PENDENTES TEST
                                            <span  data-toggle="tooltip" data-placement="bottom" 
                                                title="Descarga los usuarios pendientes de realizar las actividades">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi grey bi-info-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item pointer" @click="exportarTodos()">
                                            TODOS 
                                            <span  data-toggle="tooltip" data-placement="bottom" 
                                                title="Descargar todos mis usuarios asignados">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi grey bi-info-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="boton dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    ACCIONES
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" @click="modalCreacion=true">Crear usuario (Manual)</a></li>
                                    <li><a class="dropdown-item" href="carga.php">Crear usuario (Archivo)</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OPCIONES USUARIOS -->

            <!-- START AVANCE -->
            <div class="row d-flex justify-content-between mb-3 rowAvance" v-if="mostrarAvance">
                <div class="col-12 col-md-2 px-0 resumen total">
                    ASIGNADOS: {{avance.total}}
                </div>
                <div class="col-12 col-md-2 px-0 resumen terminados">
                    {{avance.terminados}} {{avance.terminados == 1 ? 'terminado' : 'terminados'}}
                </div>
                <div 
                    class="col-12 col-md-2 px-0 resumen empezados"
                    :class="avance.empezados != 0 ? 'cursor' : '' "
                    @click="getEmpezados"    
                >
                    {{avance.empezados}} {{avance.empezados == 1 ? 'empezado' : 'empezados'}}
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        width="17" 
                        height="17" 
                        fill="currentColor" 
                        class=" mx-1 bi mb-0 bi-eye-fill grey" 
                        viewBox="0 0 16 16"
                        v-if="avance.empezados != 0"
                    >
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                    </svg>
                  
                </div>
                <div class="col-12 col-md-2 px-0 resumen pendientes">
                    {{parseInt(avance.total) - (parseInt(avance.terminados) + parseInt(avance.empezados))}} sin hacer
                </div>
                <div class="col-12 col-md-1 px-0 resumen cerrar" @click="mostrarAvance = false">
                    x
                </div>
            </div>
            <!-- START AVANCE -->
            
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
                <em style="font-size: 14px">Para iniciar el seguimiento, tilda a la izquierda los usuarios que desees</em>
                <section v-if="usuariosSeguimiento.length != 0" class="row mb-3">
                    <div class="col-10 px-0">
                        <span v-for="(usuario, index) in usuariosSeguimiento" :class="index == 0 ? 'mx-0' : 'mx-1' ">
                            <span class="badge text-bg-success"> 
                                {{usuario.nombre}} {{usuario.apellido}} 
                                <svg 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    width="18" 
                                    height="18" 
                                    fill="currentColor" 
                                    class="bi deleteUsuario bi-x-circle" 
                                    viewBox="0 0 16 16"
                                    @click="deleteUsuario(usuario.id)"
                                >
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </span>
                        </span>
                    </div>
                    <div class="col-2 px-0 d-flex justify-content-end">
                        <button 
                            class="boton botonSeguimiento" 
                            type="button"
                            @click="iniciarSeguimiento"
                        >
                            INICIAR SEGUIMIENTO
                        </button>
                    </div>
                </section>
                <div>
                    <table class="table" v-if="usuarios.length != 0" id="miTabla">
                        <thead>
                            <tr>
                                <th scope="col" ></th>
                                <th scope="col" >Provincia</th>
                                <th scope="col" >Telefono</th>
                                <th scope="col" >Nombre</th>
                                <th scope="col" >Dni</th>
                                <th scope="col" >Contraseña</th>
                                <th scope="col" >A1</th>
                                <th scope="col" >CT</th>
                                <th scope="col" >Habilitado</th>
                                <th scope="col" >Observación</th>
                                <th scope="col" >Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div  v-if="this.usuarios.length != 0">
                                <tr v-for="usuario in usuarios">
                                    <td >
                                        <input 
                                            @change="changeCheck(usuario)" 
                                            :disabled="usuario.habilitado == 0"
                                            type="checkbox"
                                            v-model="usuario.checked"   
                                            v-if="usuario.habilitado == 1" 
                                        >
                                    </td>
                                    <td >{{(usuario.provincia == 'null' || usuario.provincia == '') ? '-' : usuario.provincia }}</td>
                                    <td >{{(usuario.telefono == '0' || usuario.telefono == 0) ? '-' : usuario.telefono }}</td>
                                    <td >{{usuario.nombre}} {{usuario.apellido}}</td>
                                    <td >{{usuario.dni}}</td>
                                    <td >{{usuario.pass}}</td>
                                    <td >{{usuario.raven}}</td>
                                    <td >{{usuario.ct}}</td>
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
                                                    <a class="dropdown-item" @click="resetear(usuario)" href="#">
                                                        Resetear Contraseña
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" @click="edit(usuario)" href="#">
                                                        Editar
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" @click="asignarUsuario(usuario)" href="#">
                                                        Asignar / Observar
                                                    </a>
                                                </li>
                                                <!-- <li>
                                                    <a class="dropdown-item" @click="observar(usuario)" href="#">
                                                        Agregar Observación
                                                    </a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </div>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3 mb-5" v-if="usuarios.length != 0 && !busqueda">
                    <div class="col-3 px-0 selectCantidad">
                        <span class="labelCantidad"> Ver de a...</span>
                        <select class="form-control" @change="changeCantidad" v-model="cantidadPorPagina">
                            <option v-for="opcion in opcionesCantidad" v-bind:value="opcion">{{opcion}}</option>
                        </select>
                    </div>
                    <div class="col-9 px-0 d-flex justify-content-end">
                        <div class="row d-flex align-items-center justify-content-end">
                            <div class="col-1 d-flex justify-content-end">
                                <button @click="prev" class="btnPaginacion pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                {{page * cantidadPorPagina - (cantidadPorPagina - 1)}} a {{page * cantidadPorPagina > cantidadUsuarios ? cantidadUsuarios : page * cantidadPorPagina}} de {{cantidadUsuarios == 1 ? " 1 resultado" : cantidadUsuarios >= 2 ? (cantidadUsuarios + " resultados") : ""}}
                            </div>
                            <div class="col-1 d-flex justify-content-start">
                                <button  class="btnPaginacion pointer" @click="next">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contenedorTabla" v-if="usuarios.length == 0">
                    <span class="sinResultados">
                        NO SE ENCONTRÓ RESULTADOS PARA MOSTRAR
                    </span>
                </div>  
            </div>
            <!-- END TABLA -->


            <!-- EMPIEZAN COMPONENTES MODAL Y NOTIFICACION -->

            <!-- START MODAL CREAR USUARIO -->
            <div v-if="modalCreacion">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoUsuario">NUEVO USUARIO</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalCreacion = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Nombre (*) <span class="errorLabel" v-if="errorNombre">{{errorNombre}}</span></label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuario.nombre">
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Apellido (*) <span class="errorLabel" v-if="errorApellido">{{errorApellido}}</span></label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuario.apellido">
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">DNI (*) <span class="errorLabel" v-if="errorDni">{{errorDni}}</span></label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="8" id="dni" v-model="usuario.dni">
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1">
                                    <label for="ciudad">Telefono</label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuario.telefono">
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1" >
                                    <label for="ciudad">Provincia</label>
                                    <select class="form-control" :disabled="pedirConfirmacion" name="provincia" id="provincia" v-model="usuario.provincia">
                                        <option v-for="provincia in provincias" v-bind:value="provincia" >{{provincia}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div v-if="!creandoUsuario">
                            <div class="modal-footer d-flex justify-content-between" v-if="!pedirConfirmacion">
                                <button type="button" class="botonCancelar" @click="cancelarCrearUsuario()">Cancelar</button>
                                <button type="button" @click="crearUsuario"  class="boton">Crear</button>
                            </div>
                            <div class="modal-footer" v-if="pedirConfirmacion">
                                <div class="row mb-2 d-flex justify-content-center">
                                    ¿Confirma la creación del usuario?
                                </div>
                                <div class="row d-flex justify-content-between">
                                    <button type="button" class="botonCancelar" @click="pedirConfirmacion = false">Cancelar</button>
                                    <button type="button" class="boton" @click="confirmarUsuario()">Confirmar</button>

                                </div>
                            </div>
                        </div>
                        <div v-if="creandoUsuario">
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
            <!-- END MODAL CREAR USUARIO -->

            <!-- START MODAL ASIGNAR USUARIO -->
            <div v-if="modalAcciones">
                <div id="myModal" class="modal">
                    <div class="modal-content modalAsignacion px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">ACCIONES</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="cerrarModalAcciones()" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>

                        <div class="modal-body" v-if="!buscandoVoluntarios">
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    Nombre: {{usuario.nombre + " " + usuario.apellido }}
                                    <br>
                                    DNI: {{usuario.dni}}
                                </div>
                                <br>
                                <br>
                                <hr>
                                <div class="col-sm-12">
                                    <label for="ciudad">ASIGNAR VOLUNTARIO </label>
                                    <select class="form-control" v-model="usuario.asignado">
                                        <option v-for="voluntario in voluntarios" v-bind:value="voluntario.id">{{voluntario.voluntario}}</option>
                                    </select> 
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end my-2">
                                    <button type="button" class="btnNuevo" @click="confirmarAsignacionUsuario()" v-if="!asignandoUsuario">Asignar</button>
                                    <button type="button" disabled class="btnNuevo" v-if="asignandoUsuario">
                                        <div class="loading">
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only"></span>
                                            </div>
                                        </div>
                                    </button>
                                </div>     
                                <br>
                                <hr>
                                <div class="col-sm-12">
                                    <label for="nombre">OBSERVACIÓN</label>
                                    <textarea class="form-control" @keydown="changeContador(usuario.observacion)" maxlength="500" id="mensaje" v-model="usuario.observacion">

                                    </textarea>
                                    <div id="contador">0/100</div>
                                </div>

                                <div class="col-sm-12 d-flex justify-content-end my-2">
                                    <button type="button" class="btnNuevo" @click="confirmarObservar(usuario)" v-if="!observando">Observar</button>
                                    <button type="button" disabled class="btnNuevo" v-if="observando">
                                        <div class="loading">
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only"></span>
                                            </div>
                                        </div>
                                    </button>
                                </div>   
                            </div>
                            <div>
                                <div class="modal-footer d-flex pb-0 justify-content-center">
                                    <button type="button" class="botonCancelar" @click="cerrarModalAcciones()" id="" data-dismiss="modal">CERRAR</button>
                                </div>
                            </div>
                        </div>
                    
                        <!-- <div class="modal-body" v-if="!buscandoVoluntarios">
                            <div class="row">
                                <div class="col-sm-12 mt-3">
                                    <label for="nombre">Nombre</label>
                                    <input disabled class="form-control" v-model="usuario.nombre">
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="apellido">Apellido</label>
                                    <input disabled class="form-control" v-model="usuario.apellido">
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="ciudad">DNI </label>
                                    <input disabled class="form-control" v-model="usuario.dni">
                                </div>     
                                <div class="col-sm-12 mt-3">
                                    <label for="ciudad">VOLUNTARIO </label>
                                    <select class="form-control" v-model="usuario.asignado">
                                        <option v-for="voluntario in voluntarios" v-bind:value="voluntario.id">{{voluntario.voluntario}}</option>
                                    </select> 
                                </div>           
                            </div>
                            <div v-if="!asignandoUsuario">
                                <div class="modal-footer d-flex justify-content-between" v-if="!pedirConfirmacionAsignar">
                                    <button type="button" class="botonCancelar" @click="cancelarAsignarUsuario()" id="" data-dismiss="modal">Cancelar</button>
                                    <button type="button" @click="pedirConfirmacionAsignar= true"  class="boton">Asignar</button>
                                </div>
                                <div class="modal-footer" v-if="pedirConfirmacionAsignar">
                                    <div class="row mb-2 d-flex justify-content-center">
                                        ¿Confirma la asignación del usuario?
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                        <button type="button" class="botonCancelar" @click="pedirConfirmacionAsignar = false">Cancelar</button>
                                        <button type="button" class="boton" @click="confirmarAsignacionUsuario()">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                            <div v-if="asignandoUsuario">
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
                        <div class="modal-body" v-if="buscandoVoluntarios">
                            <div class="loading">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    
                </div>    
            </div>    
            <!-- END MODAL ASIGNAR USUARIO -->

            <!-- START MODAL EDITAR USUARIO -->
            <div v-if="modalEdicion">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoUsuario">EDITAR USUARIO</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalEdicion = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">DNI (*) <span class="errorLabel" v-if="errorDni">{{errorDni}}</span></label>
                                    <input disabled class="form-control" autocomplete="off" maxlength="8" id="dni" v-model="usuario.dni">
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Nombre (*) <span class="errorLabel" v-if="errorNombre">{{errorNombre}}</span></label>
                                    <input :disabled="pedirConfirmacionEditar" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuario.nombre">
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Apellido (*) <span class="errorLabel" v-if="errorApellido">{{errorApellido}}</span></label>
                                    <input :disabled="pedirConfirmacionEditar" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuario.apellido">
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1">
                                    <label for="ciudad">Provincia</label>
                                    <select class="form-control" :disabled="pedirConfirmacionEditar" name="provincia" id="provincia" v-model="usuario.provincia">
                                        <option v-for="provincia in provincias" v-bind:value="provincia" >{{provincia}}</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1">
                                    <label for="ciudad">Telefono</label>
                                    <input :disabled="pedirConfirmacionEditar" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuario.telefono">
                                </div>
                            </div>
                        </div>
                        <div v-if="!editandoUsuario">
                            <div class="modal-footer d-flex justify-content-between" v-if="!pedirConfirmacionEditar">
                                <button type="button" class="botonCancelar" @click="cancelarEditarUsuario()">Cancelar</button>
                                <button type="button" @click="editarUsuario"  class="boton">Editar</button>
                            </div>
                            <div class="modal-footer" v-if="pedirConfirmacionEditar">
                                <div class="row mb-2 d-flex justify-content-center">
                                    ¿Confirma la edición del usuario?
                                </div>
                                <div class="row d-flex justify-content-between">
                                    <button type="button" class="botonCancelar" @click="pedirConfirmacionEditar = false">Cancelar</button>
                                    <button type="button" class="boton" @click="confirmarEditarUsuario()">Confirmar</button>

                                </div>
                            </div>
                        </div>
                        <div v-if="editandoUsuario">
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
            <!-- END MODAL EDITAR USUARIO -->

            <!-- START MODAL EDITAR USUARIO -->
            <div v-if="exportando">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoUsuario">PREPARANDO ARCHIVO</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                Estamos preparando el excel, por favor esperá...
                            </div>
                        </div>
                    </div>
                </div>   
            </div>   
            <!-- END MODAL EDITAR USUARIO -->

            <!-- START MODAL RESETEAR CONTRASEÑA -->
            <div v-if="modalReseteo">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">
                                Resetear contraseña
                            </h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalReseteo = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
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
                                    <input disabled class="form-control" v-model="usuario.nombre">
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="nombre">DNI</label>
                                    <input disabled class="form-control" v-model="usuario.dni">
                                </div>
                            </div>
                        </div>
                        <div v-if="!reseteando">
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="botonCancelar" @click="cancelarResetear()" id="" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="boton" @click="confirmarResetear()">Confirmar</button>
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
            <!-- <div v-if="modalObservar">
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
                                    {{usuario.dni}} - {{usuario.nombre}}
                                    
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="nombre">OBSERVACIÓN</label>
                                    <textarea class="form-control" @keydown="changeContador(usuario.observacion)" maxlength="500" id="mensaje" v-model="usuario.observacion">

                                    </textarea>
                                    <div id="contador">0/100</div>
                                </div>
                            </div>
                        </div>
                        <div v-if="!observando">
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="botonCancelar" @click="cancelarObservar()" id="" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="boton" @click="confirmarObservar(usuario)">Confirmar</button>
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
            </div>     -->
            <!-- END MODAL OBSERVAR USUARIO  --> 

            <!-- START MODAL empezados -->
            <div v-if="modalEmpezados">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">
                                Usuarios Empezados
                            </h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalEmpezados = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body">
                            <div class="contenedorLoading" v-if="buscandoEmpezados">
                                <div class="loading">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-else>
                                <div class="col-sm-12 mt-3">
                                    <div class="row" v-if="empezados.length != 0">
                                        <div class="col-sm-12 mt-3">
                                            <span v-for="empezado in empezados" class="itemEmpezados">
                                                {{empezado.dni}} - {{empezado.nombre}} {{empezado.apellido}} <br>
                                            </span>
                                        </div>
                                    </div>  
                                    <div class="row" v-else>
                                        <div class="col-sm-12 mt-3">
                                            No hay resultados para mostrar
                                            
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div v-if="!buscando">
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="botonCancelar" @click="modalEmpezados = false" id="" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>    
            <!-- END MODAL EMPEZADOS  --> 
        
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

    <style>
        .btnNuevo{
            width: 100px;
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
        .itemEmpezados:before {
            content: "\2714";
            color: grey !important;
            margin-right: 5px;
        }
        .modalAsignacion{
            min-width: 600px;
        }
        .cursor{
            cursor: pointer;
        }
        .grey{
            color: grey;
        }
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
        #mensaje{
            min-height:150px;
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
   
    </style>
    <script>
        var app = new Vue({
            el: "#app",
            components: {
            },
            data: {
                modalCreacion: false,
                modalAcciones: false,
                modalEdicion: false,
                modalReseteo: false,
                modalEmpezados: false,
                buscandoEmpezados: false,
                busqueda: "default",
                dniBusqueda: null,
                usuarios: [],
                usuario:{
                    id: null,
                    provincia: null,
                    nombre: null,
                    apellido: null,
                    dni: null,
                    telefono: null
                },
                errorNombre: "",
                errorApellido: "",
                errorDni: "",
                errorTelefono: "",
                buscandoUsuarios: false,
                buscandoVoluntarios: false,
                page: 1,
                provincias: [
                    "Buenos Aires",
                    "CABA",
                    "Catamarca",
                    "Chaco",
                    "Chubut",
                    "Córdoba",
                    "Corrientes",
                    "Entre Ríos",
                    "Formosa",
                    "Jujuy",
                    "La Pampa",
                    "La Rioja",
                    "Mendoza",
                    "Misiones",
                    "Neuquén",
                    "Río Negro",
                    "Salta",
                    "San Juan",
                    "San Luis",
                    "Santa Cruz",
                    "Santa Fe",
                    "Santiago del Estero",
                    "Tierra del Fuego",
                    "Tucumán"
                ],
                creandoUsuario: false,
                editandoUsuario: false,
                asignandoUsuario: false,
                reseteando: false,
                buscando: false,
                pedirConfirmacion: false,
                pedirConfirmacionAsignar: false,
                pedirConfirmacionEditar: false,
                tituloToast: null,
                textoToast: null,
                rol: null,
                nombre: null,
                page: 1,
                cantidadUsuarios: 0,
                opcionesCantidad: [10, 20, 50],
                cantidadPorPagina: 10,
                busqueda: false,
                //
                //
                //
                pantalla: null,
                voluntarios: [],
                idVoluntario: null,
                usuariosSeguimiento: [],
                seguidos: "",
                exportando: false,
                observando: false,
                avance: null,
                mostrarAvance: false,
                empezados: []
            },
            mounted () {
                this.pantalla = localStorage.getItem("pantalla");
                if (this.pantalla == null) {
                    window.location.href = 'home.php'; 
                }
              
                this.idVoluntario = <?php echo json_encode($_SESSION["idUsuario"]); ?>;
                this.usuariosSeguimiento = localStorage.getItem("usuariosSeguimiento") ? JSON.parse(localStorage.getItem("usuariosSeguimiento")) : [];
                if (this.seguidos != "") {
                    this.cargar
                }

                this.consultarAsignados();
                this.consultarVoluntarios();
                this.getAvanceVoluntario();
            },
            methods:{
                cerrarModalAcciones () {
                    this.modalAcciones = false;
                    this.resetUsuario();
                },
                getEmpezados () {
                    this.modalEmpezados = true;
                    this.buscandoEmpezados = true;
                    let formdata = new FormData();
                    formdata.append("idVoluntario", this.idVoluntario);

                    axios.post("funciones/asignados.php?accion=getEmpezados", formdata)
                    .then(function(response){  
                        console.log(response.data);
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.empezados != false) {
                                app.empezados = response.data.empezados
                            } else {
                                app.empezados = [];
                            }
                        }
                        app.buscandoEmpezados = false;
                    }).catch( error => {
                        app.buscandoEmpezados = false;
                        app.exportando = false;
                        app.mostrarToast("Error", "Hubo en error al recuperar la información");
                    });
                    
                },
                changeCantidad () {
                    this.page = 1;
                    this.consultarAsignados()
                },
                exportToExcel() {
                    let usuariosExcel = [];
                    this.usuarios.forEach(element => {
                        let el = element;
                        delete el.id;
                        delete el.habilitado;
                        // delete el.pass;
                        usuariosExcel.push(el);

                    });
                    const libro = XLSX.utils.book_new();
                    const hoja = XLSX.utils.json_to_sheet(usuariosExcel);

                    // Agregar la hoja de trabajo al libro
                    XLSX.utils.book_append_sheet(libro, hoja, 'Sheet1');

                    // Guardar el libro como archivo Excel
                    const nombreArchivo = 'usuarios.xlsx';
                    XLSX.writeFile(libro, nombreArchivo);
                },
                exportarTodos() {
                    this.exportando = true;
                    let usuarios = [];

                    let formdata = new FormData();
                    formdata.append("id", this.idVoluntario);
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
                exportarPendientes() {
                    this.exportando = true;
                    let usuarios = [];

                    let formdata = new FormData();
                    formdata.append("id", this.idVoluntario);
                    axios.post("funciones/asignados.php?accion=getPendientes", formdata)
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
                changeContador(observacion) {
                    if (observacion) {
                        document.getElementById("contador").innerHTML = observacion.length + "/500";
                    }
                },
                armarExcel(usuarios){
                    let usuariosExcel = [];
                    usuarios.forEach(element => {
                        let el = element;
                        delete el.id;
                        delete el.habilitado;
                        // delete el.pass;
                        usuariosExcel.push(el);

                    });
                    app.exportando = false;
                    const libro = XLSX.utils.book_new();
                    const hoja = XLSX.utils.json_to_sheet(usuariosExcel);

                    // Agregar la hoja de trabajo al libro
                    XLSX.utils.book_append_sheet(libro, hoja, 'Sheet1');

                    // Guardar el libro como archivo Excel
                    const nombreArchivo = 'usuarios.xlsx';
                    XLSX.writeFile(libro, nombreArchivo);
                },
                contarAsignados () {
                    let formdata = new FormData();
                    formdata.append("filtro", this.idVoluntario);

                    axios.post("funciones/asignados.php?accion=contarAsignados", formdata)
                    .then(function(response){  
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.cantidad != false) {
                                app.cantidadUsuarios = response.data.cantidad
                            } else {
                                app.cantidadUsuarios = 0;
                            }
                        }
                    });
                },
                consultarAsignados() {
                    this.busqueda = false;
                    this.dniBusqueda = null;
                    this.contarAsignados()
                    this.buscandoUsuarios = true;
                    let formdata = new FormData();
                    formdata.append("filtro", this.idVoluntario);
                    formdata.append("cantidad", this.cantidadPorPagina);
                    if (this.page == 1) {
                        formdata.append("inicio", 0);
                    } else {
                        formdata.append("inicio", ((app.page -1) * this.cantidadPorPagina));
                    }
                    axios.post("funciones/asignados.php?accion=getAsignados", formdata)
                    .then(function(response){    
                        app.buscandoUsuarios = false;
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.usuarios != false) {
                                response.data.usuarios.forEach(element => {
                                    if (app.usuariosSeguimiento.find(el => el.id == element.id)) {
                                        element.checked = true
                                    }
                                });
                                app.usuarios = response.data.usuarios;
                                app.getAvanceVoluntario();
                            } else {
                                app.usuarios = []
                            }
                        }
                    }).catch( error => {
                        app.buscandoUsuarios = false;
                        app.mostrarToast("Error", "No se pudo recuperar los usuarios");
                    });
                },
                consultarVoluntarios() {
                    axios.post("funciones/asignados.php?accion=getVoluntarios")
                    .then(function(response){    
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.usuarios != false) {
                                app.voluntarios = response.data.usuarios;
                            } else {
                                app.voluntarios = []
                            }
                        }
                    }).catch( error => {
                        console.log(error);
                        app.mostrarToast("Error", "No se pudo recuperar los voluntarios");
                    });
                },
                getAvanceVoluntario () {
                    let formdata = new FormData();
                    formdata.append("idVoluntario", this.idVoluntario);
                    axios.post("funciones/asignados.php?accion=getAvanceVoluntario", formdata)
                    .then(function(response){   
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.avance != false) {
                                app.avance = response.data.avance[0];
                                app.mostrarAvance = true;
                            }
                        }
                    }).catch( error => {
                        console.log(error);
                        app.mostrarToast("Error", "No se pudo recuperar la información");
                    });
                },
                prev() {
                    if(this.page > 1) {
                        this.page = this.page - 1;
                        this.consultarAsignados();
                    }
                },
                next() {
                    if (Math.ceil(this.cantidadUsuarios/this.cantidadPorPagina) > this.page) {
                        this.page = this.page + 1;
                        this.consultarAsignados();
                    }
                },
                iniciarSeguimiento () {
                    localStorage.setItem("usuariosSeguimiento", JSON.stringify(this.usuariosSeguimiento))
                    window.location.href = 'seguimiento.php'; 
                },


                // FUNCIONES BUSCAR USUARIO
                buscarUsuario() {
                    if (this.dniBusqueda != null && this.dniBusqueda != "") {
                        this.busqueda = false;
                        this.buscandoUsuarios = true;
                        let formdata = new FormData();
                        formdata.append("dniBusqueda", this.dniBusqueda);
                        axios.post("funciones/asignados.php?accion=buscarUsuario", formdata)
                        .then(function(response){  
                            app.buscandoUsuarios = false;
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                if (response.data.usuarios != false) {
                                    app.busqueda = true;
                                    app.usuarios = response.data.usuarios.filter(element => element.idAsignado == app.idVoluntario);
                                } else {
                                    app.usuarios = []
                                }
                            }
                        }).catch( error => {
                            app.buscandoUsuarios = false;
                            app.mostrarToast("Error", "No se pudo recuperar los usuarios");
                        });
                    } else {
                        this.consultarAsignados()
                    }
                },
                borrarBusqueda(){
                   this.dniBusqueda = null;
                   this.busqueda = false;
                   this.consultarAsignados();
                },
                // FUNCIONES BUSCAR USUARIO
                
            

                //  FUNCIONES ASIGNAR USUARIO
                    asignarUsuario (usuario) {
                        this.modalAcciones = true;
                        this.usuario.id = usuario.id;
                        this.usuario.nombre = usuario.nombre;
                        this.usuario.apellido = usuario.apellido;
                        this.usuario.dni = usuario.dni;
                        this.usuario.asignado = this.idVoluntario;
                        this.usuario.observacion = usuario.observacion;

                        if (this.voluntarios.length == 0) {
                            this.consultarVoluntarios();
                        }
                    },
                    confirmarAsignacionUsuario () {
                        this.asignandoUsuario = true;
                        let formdata = new FormData();
                        formdata.append("idUsuario", app.usuario.id);
                        formdata.append("idVoluntario", app.usuario.asignado);
                        axios.post("funciones/asignados.php?accion=asignarUsuario", formdata)
                        .then(function(response){
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                app.pedirConfirmacionAsignar = false;
                                app.modalAsignacion = false;
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.consultarAsignados();
                                //app.resetUsuario();
                            }
                            app.asignandoUsuario = false;
                        }).catch( error => {
                            app.asignandoUsuario = false;
                            app.mostrarToast("Error", "No se pudo asignar el usuario");
                        })
                    },
                // FUNCIONES ASIGNAR USUARIO

                // FUNCIONES CREACION USUARIO
                    crearUsuario () {
                        this.pedirConfirmacion = true;
                    },
                    cancelarCrearUsuario () {
                        this.modalCreacion = false;
                        this.resetUsuario();
                    },
                    confirmarUsuario () {
                        this.creandoUsuario = true;
                        let formdata = new FormData();
                    
                        formdata.append("nombre", app.usuario.nombre.trim());
                        formdata.append("apellido", app.usuario.apellido.trim());
                        formdata.append("dni", app.usuario.dni);
                        formdata.append("provincia", app.usuario.provincia);
                        formdata.append("telefono", app.usuario.telefono);
                        formdata.append("asignado", app.idVoluntario);
                        axios.post("funciones/usuarios.php?accion=crearUsuario", formdata)
                        .then(function(response){
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                app.pedirConfirmacion = false;
                                app.modalCreacion = false;
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.consultarAsignados();
                                app.resetUsuario();
                            }
                            app.creandoUsuario = false;
                        }).catch( error => {
                            app.creandoUsuario = false;
                            app.mostrarToast("Error", "No se pudo crear el usuario");
                        })
                    },
                // FUNCIONES CREACION USUARIO

               
                resetUsuario () {
                    this.usuario.id = null;
                    this.usuario.nombre = null;
                    this.usuario.apellido = null;
                    this.usuario.dni = null;
                    this.usuario.provincia = null;
                    this.usuario.telefono = null;
                    this.usuario.asignado = null;
                    this.usuario.observacion = null
                },

                // FUNCIONES EDITAR USUARIO
                    edit (usuario) {
                        this.modalEdicion = true;
                        this.usuario.id = usuario.id;
                        this.usuario.nombre = usuario.nombre;
                        this.usuario.apellido = usuario.apellido;
                        this.usuario.provincia = usuario.provincia ? usuario.provincia : null;
                        this.usuario.dni = usuario.dni;
                        this.usuario.telefono = usuario.telefono ? usuario.telefono : null;
                    },
                    editarUsuario () {
                        // realziar validaciones
                        this.pedirConfirmacionEditar = true;
                    },
                    cancelarEditarUsuario () {
                        this.modalEdicion = false;
                        this.resetUsuario();
                    },
                    confirmarEditarUsuario () {
                        this.editandoUsuario = true;
                        let formdata = new FormData();
                    
                        formdata.append("id", app.usuario.id);
                        formdata.append("nombre", app.usuario.nombre);
                        formdata.append("apellido", app.usuario.apellido);
                        formdata.append("provincia", app.usuario.provincia);
                        formdata.append("telefono", app.usuario.telefono);

                        axios.post("funciones/usuarios.php?accion=editarUsuario", formdata)
                        .then(function(response){
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                app.pedirConfirmacionEditar = false;
                                app.modalEdicion = false;
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.consultarAsignados();
                                app.resetUsuario();
                            }
                            app.editandoUsuario = false;
                        }).catch( error => {
                            app.editandoUsuario = false;
                            app.mostrarToast("Error", "No se pudo editar el usuario");
                        })
                    },
                // FUNCIONES EDITAR USUARIO


                // FUNCIONES RESETEAR CONTRASEÑA
                    resetear (usuario) {
                        this.modalReseteo = true;
                        this.usuario.id = usuario.id;
                        this.usuario.dni = usuario.dni;
                        this.usuario.nombre = usuario.nombre + ' ' + usuario.apellido ;
                        this.usuario.rol = usuario.rol;
                    },
                    cancelarResetear () {
                        this.modalReseteo = false;
                        this.resetUsuario();
                    },
                    confirmarResetear () {
                        this.reseteando = true;
                        let formdata = new FormData();
                    
                        formdata.append("idUsuario", app.usuario.id);
                    
                        axios.post("funciones/usuarios.php?accion=resetear", formdata)
                        .then(function(response){
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                app.modalReseteo = false;
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.consultarAsignados();
                                app.resetUsuario();
                            }
                            app.reseteando = false;
                        }).catch( error => {
                            app.reseteando = false;
                            app.mostrarToast("Error", "No se pudo resetar la contraseña");
                        })
                    },
                // FUNCIONES RESETEAR CONTRASEÑA


                // FUNCIONES SEGUIMIENTO
                    changeCheck (usuario) {
                        if (usuario.habilitado == 0) {
                            this.usuarios.find(element => element.id == usuario.id).checked = false;
                            return this.mostrarToast("Error", "El usuario no está habilitado para realizar los tests.");
                        }
                        if (usuario.checked) {
                            this.usuariosSeguimiento.push(usuario)
                            this.crearSeguimiento(usuario.id);
                        } else {
                            this.deleteUsuario(usuario.id);
                        }
                    },
                    crearSeguimiento(idUsuario) {
                        let formdata = new FormData();
                        formdata.append("idUsuario", idUsuario);
                        axios.post("funciones/asignados.php?accion=crearSeguimiento", formdata)
                        .then(function(response){    
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                                app.deleteUsuario(idUsuario)
                            }
                        }).catch( error => {
                            app.mostrarToast("Error", "No se pudo cargar al usuario para el seguimiento");
                            app.deleteUsuario(idUsuario);
                        });
                    },
                    deleteUsuario (id){
                        this.usuarios.find(element => element.id == id).checked = false;
                        
                        let posicion = this.usuariosSeguimiento.indexOf(this.usuariosSeguimiento.find(element=> element.id == id))
                        this.usuariosSeguimiento.splice(posicion, 1);
                        localStorage.setItem("usuariosSeguimiento", JSON.stringify(this.usuariosSeguimiento))
                    },
                //
                
                // FUNCIONES OBSERVAR USUARIO
               
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
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.consultarAsignados();
                            }
                            app.observando = false;
                        }).catch( error => {
                            app.observando = false;
                            app.mostrarToast("Error", "No se pudo agregar la observacion");
                        })
                    },
                // FUNCIONES OBSERVAR USUARIO



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
            }
        })
    </script>
</body>
</html>