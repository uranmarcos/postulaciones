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
                            <button class="boton" type="button" @click="modalCreacion=true, usuario.rol ='voluntario'">
                                Crear
                            </button>
                        </div>
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
                <div>
                    <table class="table" v-if="usuarios.length != 0">
                        <thead>
                            <tr>
                                <th scope="col" >Nombre</th>
                                <th scope="col" >Apellido</th>
                                <th scope="col" >Dni</th>
                                <th scope="col" >Rol</th>
                                <th scope="col" >Habilitado</th>
                                <th scope="col" ></th>
                            </tr>
                        </thead>
                        <tbody>
                            <div  v-if="this.usuarios.length != 0">
                                <tr v-for="usuario in usuarios">
                                    <td >{{usuario.nombre}}</td>
                                    <td >{{usuario.apellido}}</td>
                                    <td >{{usuario.dni}}</td>
                                    <td >{{usuario.rol}}</td>
                                    <td >{{usuario.habilitado == 1 ? "Sí" : "No"}}</td>
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
                                                <li v-if="usuario.habilitado == 0">
                                                    <a class="dropdown-item" @click="habilitarUsuario(usuario)" href="#">
                                                        Habilitar
                                                    </a>
                                                </li>
                                                <li v-if="usuario.habilitado == 1">
                                                    <a class="dropdown-item" @click="bloquearUsuario(usuario)" href="#">
                                                        Bloquear
                                                    </a>
                                                </li>
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
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">ROL (*)</label>
                                    <select class="form-control" v-model="usuario.rol">
                                        <option value="voluntario" selected>Voluntario</option>
                                        <option value="general" v-if="rol == 'admin'">General</option>
                                    </select >
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
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">ROL (*)</label>
                                    <select class="form-control" v-model="usuario.rol">
                                        <option value="voluntario" selected>Voluntario</option>
                                        <option value="general" v-if="rol == 'admin'">General</option>
                                    </select >
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
       
    </style>
    <script>
        var app = new Vue({
            el: "#app",
            components: {
            },
            data: {
                modalCreacion: false,
                modalEdicion: false,
                modalReseteo: false,
                busqueda: "default",
                dniBusqueda: null,
                usuario:{
                    id: null,
                    nombre: null,
                    apellido: null,
                    dni: null
                },
                errorNombre: "",
                errorApellido: "",
                errorDni: "",
                buscandoUsuarios: false,
                page: 1,
                creandoUsuario: false,
                editandoUsuario: false,
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
                usuarios: [],
                idVoluntario: null,
                rol: null
            },
            mounted () {
                this.pantalla = localStorage.getItem("pantalla");
                if (this.pantalla == null) {
                    window.location.href = 'home.php'; 
                }
                this.idVoluntario = <?php echo json_encode($_SESSION["idUsuario"]); ?>;
                this.rol = <?php echo json_encode($_SESSION["rol"]); ?>;
                this.consultarUsuarios();
            },
            methods:{
                changeCantidad () {
                    this.page = 1;
                    this.consultarUsuarios()
                },
                contarUsuarios () {
                    let formdata = new FormData();
                    formdata.append("filtro", this.filtro);

                    axios.post("funciones/accionesVoluntarios.php?accion=contarUsuarios", formdata)
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
                consultarUsuarios() {
                    this.contarUsuarios()
                    this.buscandoUsuarios = true;
                    let formdata = new FormData();
                    formdata.append("cantidad", this.cantidadPorPagina);
                    if (this.page == 1) {
                        formdata.append("inicio", 0);
                    } else {
                        formdata.append("inicio", ((app.page -1) * this.cantidadPorPagina));
                    }
                    axios.post("funciones/accionesVoluntarios.php?accion=getUsuarios", formdata)
                    .then(function(response){    
                        app.buscandoUsuarios = false;
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.usuarios != false) {
                                app.usuarios = response.data.usuarios;
                            } else {
                                app.usuarios = []
                            }
                        }
                    }).catch( error => {
                        app.buscandoUsuarios = false;
                        app.mostrarToast("Error", "No se pudo recuperar los usuarios");
                    });
                },
                prev() {
                    if(this.page > 1) {
                        this.page = this.page - 1;
                        this.consultarUsuarios();
                    }
                },
                next() {
                    if (Math.ceil(this.cantidadUsuarios/this.cantidadPorPagina) > this.page) {
                        this.page = this.page + 1;
                        this.consultarUsuarios();
                    }
                },
                habilitarUsuario (usuario) {
                    this.creandoUsuario = true;
                    let formdata = new FormData();
                    formdata.append("id", usuario.id);
                    axios.post("funciones/accionesVoluntarios.php?accion=habilitarUsuario", formdata)
                    .then(function(response){
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            app.mostrarToast("Éxito", response.data.mensaje);
                            app.consultarUsuarios();
                        }
                    }).catch( error => {
                        app.creandoUsuario = false;
                        app.mostrarToast("Error", "No se pudo habilitar el usuario");
                    })
                },
                bloquearUsuario (usuario) {
                    this.creandoUsuario = true;
                    let formdata = new FormData();
                    formdata.append("id", usuario.id);
                    axios.post("funciones/accionesVoluntarios.php?accion=bloquearUsuario", formdata)
                    .then(function(response){
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            app.mostrarToast("Éxito", response.data.mensaje);
                            app.consultarUsuarios();
                        }
                    }).catch( error => {
                        app.creandoUsuario = false;
                        app.mostrarToast("Error", "No se pudo habilitar el usuario");
                    })
                },
                // FUNCIONES BUSCAR USUARIO
                buscarUsuario() {
                    if (this.dniBusqueda != null && this.dniBusqueda != "") {
                        this.busqueda = false;
                        this.buscandoUsuarios = true;
                        let formdata = new FormData();
                        formdata.append("dniBusqueda", this.dniBusqueda);
                        axios.post("funciones/accionesVoluntarios.php?accion=buscarUsuario", formdata)
                        .then(function(response){    
                            app.buscandoUsuarios = false;
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                if (response.data.usuarios != false) {
                                    app.busqueda = true;
                                    app.usuarios = response.data.usuarios;
                                } else {
                                    app.usuarios = []
                                }
                            }
                        }).catch( error => {
                            app.buscandoUsuarios = false;
                            app.mostrarToast("Error", "No se pudo recuperar los usuarios");
                        });
                    } else {
                        this.consultarUsuarios()
                    }
                },
                borrarBusqueda(){
                   this.dniBusqueda = null;
                   this.busqueda = false;
                   this.consultarUsuarios();
                },
                // FUNCIONES BUSCAR USUARIO
                
            





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
                        formdata.append("rol", app.usuario.rol);
                        axios.post("funciones/accionesVoluntarios.php?accion=crearVoluntario", formdata)
                        .then(function(response){
                            console.log(response);
                            
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                app.pedirConfirmacion = false;
                                app.modalCreacion = false;
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.consultarUsuarios();
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
                    this.usuario.rol = null;
                },

                // FUNCIONES EDITAR USUARIO
                    edit (usuario) {
                        this.modalEdicion = true;
                        this.usuario.id = usuario.id;
                        this.usuario.nombre = usuario.nombre;
                        this.usuario.apellido = usuario.apellido;
                        this.usuario.dni = usuario.dni;
                        this.usuario.rol = usuario.rol;
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
                        formdata.append("rol", app.usuario.rol);

                        axios.post("funciones/accionesVoluntarios.php?accion=editarUsuario", formdata)
                        .then(function(response){
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                app.pedirConfirmacionEditar = false;
                                app.modalEdicion = false;
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.consultarUsuarios();
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
                        formdata.append("dni", app.usuario.dni);
                        formdata.append("nombre", app.usuario.nombre);
                    
                        axios.post("funciones/accionesVoluntarios.php?accion=resetear", formdata)
                        .then(function(response){
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                app.modalReseteo = false;
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.consultarUsuarios();
                                app.resetUsuario();
                            }
                            app.reseteando = false;
                        }).catch( error => {
                            app.reseteando = false;
                            app.mostrarToast("Error", "No se pudo resetar la contraseña");
                        })
                    },
                // FUNCIONES RESETEAR CONTRASEÑA


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