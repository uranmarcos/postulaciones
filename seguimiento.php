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
                    <div class="row d-flex justify-content-between align-items-center">

                        <div class="col-12 col-md-4 my-2 px-0">
                            <button 
                                type="button" 
                                class="boton botonTerminar" 
                                @click="modalAgregar = true" 
                            >
                                AGREGAR AL SEGUIMIENTO
                            </button>
                        </div>


                        <div v-if="usuarios.length != 0" class="col-12 col-sm-6 col-md-4 d-flex justify-content-center">
                            <div class="selectBuscar">
                                <span class="labelBuscar"> Ordenar por nombre/apellido</span>
                                <input class="form-control" autocomplete="off" v-model="filtro" @keyUp="ordenarPorNombreApellido(filtro)">
                            </div>
                        </div>


                        
                        <div 
                            class="col-12 col-sm-6 col-md-4 px-0 d-flex justify-content-end" 
                            v-if="usuarios.length != 0"
                        >
                            <!-- CONTENEDOR DEL BOTÓN Y EL MENÚ -->
                            <div style="position: relative; display: inline-block;">
                                <button 
                                    type="button" 
                                    class="boton botonTerminar" 
                                    @click="mostrarOpciones = !mostrarOpciones"
                                >
                                    SEGUIMIENTO
                                </button>

                                <!-- MENÚ DESPLEGABLE -->
                                <div 
                                    v-if="mostrarOpciones" 
                                    style="position: absolute; top: 100%; right: 0; z-index: 10;"
                                >
                                    <button class="boton botonTerminar mt-1 w-100" @click="actualizarHabilitadoGrupo(2)">Habilitar todos</button>
                                    <button class="boton botonTerminar mt-1 w-100" @click="actualizarHabilitadoGrupo(1)">Bloquear todos</button>
                                    <!-- <button class="boton botonTerminar mt-1 w-100" @click="modalTerminar = true, mostrarOpciones = false">
                                        Terminar seguimiento
                                    </button> -->
                                </div>
                            </div>
                        </div>
                        

                        <div v-if="usuarios.length != 0" class="row px-0">
                            <div class="col-6 px-0 d-flex actualizacion">
                                Última actualizacion: {{ultimaActualizacion }} 
                                <div class="refresh" @click="actualizar">
                                    <svg 
                                        xmlns="http://www.w3.org/2000/svg" 
                                        width="20" height="20" fill="currentColor" 
                                        class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                    </svg>
                                </div>  
                            </div>
                            <div class="col-12 col-sm-6 px-0 d-flex justify-content-end">
                                <span 
                                    class="btnDespliegue" 
                                    data-toggle="collapse"
                                    data-target=".multi-collapse" 
                                    aria-expanded="false" 
                                    aria-controls="multiCollapseExample1 multiCollapseExample2"
                                    @click="desplegadas = !desplegadas"
                                >
                                    <span 
                                        v-if="desplegadas"                                    
                                    >
                                        Colapsar todas
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V3.707l3.147 3.147a.5.5 0 0 0 .708-.708l-4-4-.007-.007a.5.5 0 0 0-.7.007l-4 4a.5.5 0 0 0 .708.708L7.5 3.707V14.5A.5.5 0 0 0 8 15z"/>
                                        </svg>
                                    </span>
                                    <span 
                                        v-if="!desplegadas"                                    
                                    >
                                        Desplegar todas
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v10.793l3.147-3.147a.5.5 0 0 1 .708.708l-4 4-.007.007a.5.5 0 0 1-.7-.007l-4-4a.5.5 0 0 1 .708-.708L7.5 12.293V1.5A.5.5 0 0 1 8 1z"/>
                                        </svg>
                                    </span>
                                </span>
                                
                            </div>
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
                <div v-if="usuarios.length != 0">                    
                    <p>
                        <span class="accordion-header">
                           
                            <div class="accordion-item" v-for="usuario in usuarios">
                                <div  
                                    class="headerAcordeon"
                                    
                                >
                                    <nav class="headerAcordion"
                                        data-toggle="collapse" 
                                        :href="'#multiCollapse' + usuario.dni" 
                                        role="button" 
                                        aria-expanded="false" 
                                        :aria-controls="'multiCollapse' + usuario.dni"
                                    >
                                        <span 
                                            class=" col-8 px-3" 
                                            :class="filtro != null && filtro.trim() != '' && (usuario.nombre.toLowerCase().includes(filtro.toLowerCase()) || usuario.apellido.toLowerCase().includes(filtro.toLowerCase())) ? 'resaltado' : ''"
                                        >
                                            <span 
                                               
                                                :class="usuario.habilitado == 2 ? 'green' : 'red'"
                                            >
                                                <b>
                                                    {{usuario.nombre}}
                                                </b>
                                                    {{ usuario.habilitado == 1 ? ' - No Habilitado (puede loguearse pero no realizar act)' : ' - Habilitado'}}
                                            </span>
                                        </span>
                                        <span class="col-4 d-flex align-items-center px-3 justify-content-end">
                                            <b
                                                
                                            >
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
                                            <b  v-if="usuario.estado1 == 0" class="mx-2 red">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stop-fill" viewBox="0 0 16 16">
                                                   <path d="M5 3.5h6A1.5 1.5 0 0 1 12.5 5v6a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 11V5A1.5 1.5 0 0 1 5 3.5"/>
                                                </svg>
                                            </b>
                                            <b v-else-if="usuario.estado6 == 2" class="mx-2 green">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                </svg>
                                            </b>
                                            <b v-else class="mx-2 orange">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                                </svg>
                                            </b>
                                        </span>
                                    </nav>
                                    <div class="col-12 pt-0">
                                        <div class="collapse multi-collapse" :id="'multiCollapse' + usuario.dni">
                                            <div class="card card-body pt-0">
                                                <nav class="my-2 row">
                                                    <div class="col-4 px-0 d-flex align-items-center">
                                                        <span class="">
                                                            DNI:
                                                        </span>
                                                        <b class="mx-2">{{usuario.dni}}</b>
                                                    </div>
                                                    <div class="col-6 px-0 d-flex align-items-center">
                                                        <b>
                                                            A1: 
                                                                {{usuario.raven}}
                                                            CT: 
                                                                {{usuario.ct}}
                                                        </b>
                                                    </div>
                                                    <div class="col-12 col-sm-2 d-flex px-0 justify-content-end">
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
                                                                    <a class="dropdown-item" @click="terminarSeguimientoIndividual(usuario.id)" href="#">
                                                                        Terminar seguimiento
                                                                    </a>
                                                                </li>
                                                                <li v-if="usuario.habilitado > 0">
                                                                    <a class="dropdown-item" @click="resetear(usuario)" href="#">
                                                                        {{usuario.habilitado == 1 ? 'Habilitar' : 'Bloquear'}}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" @click="observar(usuario)" href="#">
                                                                        Agregar Observación
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>    
                                                    </div>
                                                </nav>
                                                <div class="contenedorTest row">       
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
                                                                usuario.habilitado1 == 0 ? "NO PERMITIDA" : "PERMITIDA"
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
                                                                usuario.habilitado2 == 0 ? "NO PERMITIDA" : "PERMITIDA"
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
                                                                usuario.habilitado3 == 0 ? "NO PERMITIDA" : "PERMITIDA"
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
                                                                usuario.habilitado4 == 0 ? "NO PERMITIDA" : "PERMITIDA"
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
                                                                usuario.habilitado5 == 0 ? "NO PERMITIDA" : "PERMITIDA"
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
                                                                usuario.habilitado6 == 0 ? "NO PERMITIDA" : "PERMITIDA"
                                                            }}
                                                        </span>
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </p>
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
                        
                        <div class="contenedorLoadingModal" v-if="limpiando">
                            <div class="loading">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="modal-body modalBodyEliminar" v-if="!limpiando">
                            ¿Desea terminar el seguimiento de todos los usuarios?
                            
                        </div>
                        <div v-if="!limpiando">
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="botonCancelar" @click="modalTerminar = false" id="" data-dismiss="modal">Cancelar</button>
                                <button type="button" @click="limpiarSeguimiento()"  class="boton">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>    
            <!-- END MODAL TERMINAR SEGUIMIENTO -->

              <!-- START MODAL TERMINAR SEGUIMIENTO -->
            <div v-if="modalAgregar">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">AGREGAR USUARIOS</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalAgregar = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="row">
                            <!-- <button class="col-6 btnOpcion" @click="opcionSeleccionada = 'asignados'">ASIGNADOS</button> -->
                            <button class="col-12 btnOpcion" @click="opcionSeleccionada = 'dni'">POR DNI</button>
                        </div>

                            <!-- Selección por asignados -->
                            <div v-if="opcionSeleccionada === 'asignados'" class="mt-2">
                                <select class="form-control selectAgregar" @change="agregarUsuario(usuarioSelect)" v-model="usuarioSelect">
                                <option value="default" disabled>Seleccionar de mis asignados</option>
                                <option
                                    v-for="opcion in asignados"
                                    :key="opcion.id"
                                    :disabled="desabilitarOpcion(opcion.id)"
                                    :value="opcion"
                                >
                                    {{ opcion.dni + ' - ' + opcion.nombre + ' ' + opcion.apellido }}
                                </option>
                                </select>
                            </div>

                            <!-- Búsqueda por DNI -->
                            <div v-if="opcionSeleccionada === 'dni'" class="mt-2 position-relative">
                                <input
                                class="form-control inputBuscar"
                                autocomplete="off"
                                @keyup="buscarUsuario"
                                v-model="dniBusqueda"
                                ref="inputField"
                                placeholder="Buscar por DNI"
                                />
                                <ul class="list-group listadoDnis position-absolute w-100 z-index-10 mt-1" ref="listadoDnis">
                                <li
                                    class="list-group-item"
                                    v-for="(usuario, index) in usuariosBuscados"
                                    :key="usuario.id"
                                    :style="{ pointerEvents: permitirUsuarioBuscado(usuario) ? 'none' : 'auto' }"
                                    :class="permitirUsuarioBuscado(usuario) ? 'itemListadoDniBloqueado' : 'itemListadoDni'"
                                    @click="agregarUsuario(usuario)"
                                >
                                    {{ usuario.nombre }} {{ usuario.apellido }}
                                    <span class="textoRojo" v-if="permitirUsuarioBuscado(usuario)">(agregado)</span>
                                </li>
                                </ul>
                            </div>

                       
                        <div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="botonCancelar" @click="modalAgregar = false" id="" data-dismiss="modal">Cerrar</button>
                                <!-- <button type="button" @click="limpiarSeguimiento()"  class="boton">Confirmar</button> -->
                            </div>
                        </div>
                    </div>
                </div>    
            </div>    
            <!-- END MODAL TERMINAR SEGUIMIENTO -->

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
                                        {{usuarioModal.habilitado == 0 ? "ACTIVIDAD NO PERMITIDA" : "ACTIVIDAD PERMITIDA" }}
                                    </b>
                                </div>

                                <div class="col-sm-12 mt-3" v-if="actividadModal == 'ACTIVIDAD 1'">
                                    Tiempo disponible: {{convertirTiempo(usuarioModal.tiempo)}} minutos
                                    <br>                                    
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

            <!-- START MODAL HABILITAR / BLOQUEAR -->
            <div v-if="modalResetear">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">
                                 {{usuarioModal.habilitado == 1 ? 'Habilitar Usuario' : 'Bloquear Usuario'}}
                            </h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="cancelarResetear()" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mt-3 d-flex justify-content-center" >
                                    ¿Desea {{usuarioModal.habilitado == 1 ? 'HABILITAR' : 'BLOQUEAR'}} al usuario?
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
                                <button type="button" class="boton" @click="confirmarResetear(usuarioModal.habilitado)">Confirmar</button>
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
            <!-- START MODAL HABILITAR / BLOQUEAR -->      
            
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
            <!-- END MODAL OBSERVAR USUARIO CONTRASEÑA --> 
        
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
        .btnOpcion {
            height: 40px;
            border: solid 1px #7C4599;
            background: white;
            color: #7C4599;
        }
        .refresh {
            width: 40px;
            color: green;
            border-radius: 10px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .refresh:hover{
            cursor: pointer;
        }
        .red {
            color: red;
        }
        .orange{
            color: orange;
        }
        .green{
            color: green;
        }
        .headerAcordion{
            display: flex;
            align-items: center;
            width: 100%;
            height: 50px;
            border: solid 1px grey;
        }
        .selectBuscar{
            width: 250px;
        }
        .selectActualizacion{
            width: 210px;
        }
        .textoRojo{
            color: red;
            font-size: 10px;
        }
        .itemListadoDniBloqueado{
            background: lightgrey;
        }
        .itemListadoDni:hover{
            background: lightgrey;
            cursor: pointer;
        }
        .contenedorDni{
            position: relative;
        }
        .listadoDnis{
            position: absolute;
            top: 37px;
            z-index: 10;
        }
        .resaltado {
            background: yellow;
        }
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
        .headerAcordeon {
            border: solid 1px grey;
            color: black;
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
        .botonTerminar{
            min-width: 250px;
            height: 37px;
        }
        .botonTerminar:hover{
            background: white;
            color: rgb(124, 69, 153); 
            font-weight: bolder;
        }
        .btnDespliegue{
            color: green;
            height: 15px;
        }
        .btnDespliegue:hover{
            /* background: green;
            color: white;
            border: solid 1px ; */
            background: white;
            color: green;
            cursor: pointer;
        }
        .pointer{
            cursor: pointer;
        }
        textarea{
            min-height: 250px !important;
            width: 300px;
            font-size: 10px;
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
        .actualizacion{
            border-bottom: black;
            font-size: 12px;
            color: black;
            padding-left: 0;
            margin-bottom: 0;
            text-align: left;
        }
        
            
    </style>
    <script>
        Vue.directive('click-outside', {
            bind(el, binding, vnode) {
                el.__clickOutsideHandler__ = function (event) {
                    const elementsToAvoid = [
                        vnode.context.$refs.inputField,
                        vnode.context.$refs.listadoDnis
                    ];
                    if (elementsToAvoid.every(el => !el.contains(event.target))) {
                        binding.value(event);
                    }
                };
                document.addEventListener('click', el.__clickOutsideHandler__);
            },
            unbind(el) {
                document.removeEventListener('click', el.__clickOutsideHandler__);
                delete el.__clickOutsideHandler__;
            }
        });
        var app = new Vue({
            el: "#app",
            components: {
            },
            data: {
                mostrarOpciones: false,
                opcionSeleccionada: 'dni',
                usuarioSelect: 'default',
                buscandoUsuarios: false,
                modalDetalle: false,
                modalAgregar: false,
                usuarioModal: {},
                actividadModal: "",
                idVoluntario: null,
                asignados: [],
                usuarioSelect: "default",
                seguidos: [],
                modalTerminar: false,
                modalEliminar: false,
                usuarios: [],       
                tiempoAsignable: null,   
                usuariosBuscados: [],
                dniBusqueda: null,    
                modalObservar: false,
                observando: false,
                ultimaActualizacion: null,
                filtro: null,
                ///
                modalResetear: false,
                reseteando: false,
                buscando: false,
                tituloToast: null,
                textoToast: null,
                desplegadas: false,
                limpiando: false
            },
            mounted () {
                this.seguidos = localStorage.getItem("usuariosSeguimiento") ? JSON.parse(localStorage.getItem("usuariosSeguimiento")) : [];
                this.idVoluntario = <?php echo json_encode($_SESSION["idUsuario"]); ?>;
                console.log(this.idVoluntario);
                
                this.consultarAsignados();
                if (this.seguidos.length > 0) {
                    this.getUsuariosSeguimiento();
                }
            },
            methods:{
                handleClickOutside() {
                    if (this.dniBusqueda != null) {
                        this.limpiarBusqueda()
                    }
                },
                toggle(dni) {
                    const usuario = this.usuarios.find(u => u.dni === dni);
                    if (usuario) {
                        usuario.isOpen = !usuario.isOpen;
                    }
                    console.log(usuario);
                },
                ordenarPorNombreApellido(valor) {
                    if (valor === null || valor === '') {
                        this.usuarios.sort(app.ordenarUsuarios);
                    } else {
                        return this.usuarios.sort((a, b) => {
                            const aNombreCompleto = `${a.nombre} ${a.apellido}`.toLowerCase();
                            const bNombreCompleto = `${b.nombre} ${b.apellido}`.toLowerCase();
                            const valorLower = valor.toLowerCase();
    
                            const aContiene = aNombreCompleto.includes(valorLower);
                            const bContiene = bNombreCompleto.includes(valorLower);
    
                            if (aContiene && !bContiene) return -1;
                            if (!aContiene && bContiene) return 1;
                            return 0;
                        });
                    }
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
                actualizarHabilitadoGrupo (estado) {
                    const idsSeleccionados = this.seguidos.map(u => u.id); 
                    let formdata = new FormData();
                    formdata.append("ids", idsSeleccionados);
                    formdata.append("estado", estado);
                    axios.post("funciones/seguimiento.php?accion=actualizarHabilitadoGrupo", formdata)
                    .then(function(response){
                        app.actualizar();
                        if (!response.data.error && response.data.mensaje != "OK") {
                            app.mostrarToast("Error", response.data.mensaje);
                        }
                        app.mostrarOpciones = false;
                    }).catch( error => {
                        app.mostrarToast("Error", "Error al habilitar. Verifique los usuarios o reintente");
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
                        console.log(response);
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            app.agregarAlSeguimiento(usuario);
                            app.limpiarBusqueda();
                        }   
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo cargar al usuario para el seguimiento");
                    });
                },
                limpiarBusqueda () {
                    this.dniBusqueda = null;
                    this.usuariosBuscados = [];
                },
                agregarAlSeguimiento(usuario){
                    this.seguidos.push(usuario)
                    localStorage.setItem("usuariosSeguimiento", JSON.stringify(this.seguidos))
                    this.getUsuariosSeguimiento();
                    this.usuarioSelect = "default";
                },
                async limpiarSeguimiento () {
                    this.limpiando = true;                 
                    // const promesas = this.seguidos.map(element => this.terminarSeguimientoIndividual(element.id));
                    // await Promise.all(promesas);
                    for (const element of this.seguidos) {
                        await this.terminarSeguimientoIndividual(element.id);
                    }

                    this.limpiando = false;
                   
                },
                async terminarSeguimientoIndividual (id) {
                    let formdata = new FormData();
                    formdata.append("id", id);
                    axios.post("funciones/seguimiento.php?accion=terminarSeguimiento", formdata)
                    .then(function(response){
                        console.log(response);
                        
                        if (response.data.error) {
                            app.mostrarToast("Error", "No se pudo terminar el seguimiento del usuario");
                        } else {
                            app.eliminarUsuarioSeguimiento(id)
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo terminar el seguimiento del usuario");
                    })  
                },
                consultarAsignados (id) {
                    let formdata = new FormData();
                    if (typeof this.idVoluntario == 'string') {
                        formdata.append("id", Number(this.idVoluntario.trim()));
                    } else {
                        formdata.append("id", this.idVoluntario);
                    }
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
                    let ids = "";
                    this.seguidos.forEach((element, index) => {
                        ids = ids + element.id + ", ";
                    });
                    ids = ids.slice(0, -2);
                    this.buscandoUsuarios = true;
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
                getSeguimiento(ids) {
                    // this.buscandoUsuarios = true;
                    let formdata = new FormData();
                    formdata.append("ids", ids);
                    axios.post("funciones/seguimiento.php?accion=getSeguimiento", formdata)
                    .then(function(response){    
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.usuarios != false) {
                                app.usuarios = response.data.usuario
                                if (app.filtro) {
                                    app.ordenarPorNombreApellido(app.filtro)
                                } else {
                                    app.usuarios.sort(app.ordenarUsuarios);
                                }
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
                        app.ultimaActualizacion = hora + ":" + minuto + ":" + segundo + "hs" + " (" + app.usuarios.length + " en curso)";
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
                    this.getSeguimiento(ids);
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

                // FUNCIONES RESETEAR USUARIO
                    resetear (usuario) {
                        this.modalResetear = true;
                        this.usuarioModal.id = usuario.id;
                        this.usuarioModal.dni = usuario.dni;
                        this.usuarioModal.habilitado = usuario.habilitado;
                        this.usuarioModal.nombre = usuario.nombre + ' ' + usuario.apellido ;
                    },
                    cancelarResetear () {
                        this.modalResetear = false;
                        this.usuarioModal = {};
                    },
                    confirmarResetear (habilitado) {
                        this.reseteando = true;
                        let formdata = new FormData();
                    
                        if (habilitado == 0) {
                            return app.mostrarToast("Error", "No tiene permisos para modificar el estado del usuario");
                        }
                        formdata.append("idUsuario", app.usuarioModal.id);
                        if (habilitado == 1) {
                            formdata.append("habilitado", 2);
                        }
                        if (habilitado == 2) {
                            formdata.append("habilitado", 1);
                        }
                        axios.post("funciones/asignados.php?accion=actualizarHabilitado", formdata)
                        .then(function(response){
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                app.modalResetear = false;
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.actualizar();
                                app.usuarioModal = {};
                            }
                            app.reseteando = false;
                        }).catch( error => {
                            app.reseteando = false;
                            app.mostrarToast("Error", "No se modificar el usuario");
                        })
                    },
                // FUNCIONES RESETEAR USUARIO

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