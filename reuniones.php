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
                    <span class="pointer" @click="irA('inicio')">Inicio</span>
                    <span class="pointer mx-1" @click="irA(pantalla)">- {{pantalla}}</span>
                </div>
            </div>
            <!-- END BREADCRUMB -->

            <div class="row d-flex justify-content-between mb-3">
                <button 
                    type="button" 
                    @click="modalReunion = true"  
                    class="btn"                               
                >
                    NUEVA REUNIÓN
                </button>
                <button 
                    type="button" 
                    @click="modalTelefono = true"  
                    class="btn mi-boton"                               
                >
                    Tel: {{telefono}}
                </button>
            </div>
            <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <div v-for="opcion in meses" :key="opcion" 
                            :class="mes === opcion ? 'remarcado' : ''" 
                            class="col-3 opcionMes" 
                            @click="mes = opcion">
                        {{ opcion.toUpperCase() }}
                        </div>
                    </tr>
                    <tr>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sábado</th>
                        <th>Domingo</th>
                    </tr>
                </thead>

                <tbody>
                <tr v-for="(semana, index) in semanasMes" :key="index">
                    <td v-for="dia in semana" :key="dia?.fecha" class="celdaDia" :id="dia?.fecha">
                    <div v-if="dia">
                        {{ dia.numero }}
                        <div v-for="reunion in reuniones[dia.fecha]" :key="reunion.id">
                        <button class="btnReunion"
                                :class="reunion.disponible == 1 ? 'disponible' : 'noDisponible'"
                                @click="clickReunion(reunion)">
                            {{ reunion.fecha.split(' ')[1].slice(0,5) }} hs<br>
                            {{ reunion.voluntario }}
                        </button>
                        </div>
                    </div>
                    </td>
                </tr>
                </tbody>

                
            </table>
            </div>

            <!-- START MODAL REUNION-->
            <div v-if="modalReunion">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">{{edicion ? 'EDITAR REUNION' : 'NUEVA REUNIÓN'}}</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="cerrarModalReunion()" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body pb-0">
                            <div class="row mb-3 d-flex justify-content-around"> 
                                <div class="col-5 pl-0">
                                    Fecha 
                                    <input class="form-control" type="datetime-local" v-model="reunion.fecha" />  
                                </div>  
                                <div class="col-3">
                                    Disponible
                                    <select class="form-control" v-model="reunion.disponible">
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-3 pr-0">
                                    Capacidad
                                    <input class="form-control" type="number" min="1" v-model="reunion.capacidad">
                                </div>
                            </div> 
                           
                            <div >
                                <div class="modal-footer d-flex justify-content-between">
                                    <div class="d-flex justify-start col-6 mx-0">
                                        <button type="button" class="btnModal btnCancelar" @click="cerrarModalReunion()">Cancelar</button>
                                    </div>
                                    <div class="d-flex justify-content-end col-6 mx-0">
                                        <button type="button" @click="confirmarReunion" class="btnModal" v-if="!edicion">Crear</button>
                                        <button type="button" @click="confirmarDelete" class="btnModal btnEliminar" v-if="edicion">Eliminar</button>
                                        <button type="button" @click="confirmarEdicion" class="btnModal" v-if="edicion">Editar</button>
                                    </div>
                                </div>
                            </div>
                            <!-- <div v-if="habilitandoTests">
                                <div class="modal-footer d-flex justify-content-between">
                                    <div class="contenedorLoadingModal">
                                        <div class="loading">
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    
                </div>    
            </div>    
            <!-- END MODAL REUNION -->

            <!-- START MODAL TELEFONO-->
            <div v-if="modalTelefono">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">ACTUALIZAR TELÉFONO</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalTelefono = false, telefonoActualizado = null" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body pb-0">
                            <div class="form-group">
                                <label for="telefono">Teléfono celular (Ingrese característica sin 0 y teléfono sin 15)</label>
                                <input
                                    id="telefono"
                                    class="form-control"
                                    type="tel"
                                    v-model="telefonoActualizado"
                                    placeholder="Ej: 11 12345678"
                                    pattern="[0-9 ]{10,15}"
                                    @input="formatearTelefono"
                                />
                            </div>
                           
                            <div >
                                <div class="modal-footer d-flex justify-content-between px-0">
                                    <div class="d-flex justify-start col-6 mx-0">
                                        <button type="button" class="btnModal btnCancelar" @click="modalTelefono = false, telefonoActualizado = null">Cancelar</button>
                                    </div>
                                    <div class="d-flex justify-content-end col-6 mx-0">
                                        <button 
                                            type="button" 
                                            @click="actualizarTelefono" 
                                            class="btnModal"
                                            :disabled="!telefonoActualizado || telefonoActualizado && telefonoActualizado.length < 10"                                        
                                        >
                                            Actualizar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>    
            </div>    
            <!-- END MODAL TELEFONO -->

         

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
        .disponible{
            background: lightgreen !important;
        }
        .noDisponible {
            background: #FF8A8A !important;
        }
        .remarcado{
            background: grey;
            color: white;
        }
        .opcionMes {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 5px 0 0;
            height: 30px;
            border: solid 1px grey;
        }
        .opcionMes:hover{
            cursor: pointer;
        }
        .btnReunion{
            width: 100%;
            height: auto;
            background: none;
            border: solid 1px grey;
            margin: 2px;
        }
        .btnReunion:hover{
            background: lightgrey;
        }
        .btn{
            width: 200px;
            color: rgb(124, 69, 153);
            border-radius: 0;
            font-size: 18px;
            height: 40px;
            background: none;
            border: solid 1px rgb(124, 69, 153);
        }
        .btn:hover{
            /* background: rgb(124, 69, 153);
            color: white; */
            border: solid 1px rgb(124, 69, 153);
            color: rgb(124, 69, 153);
            box-shadow:  2px 2px 2px 1px rgba(0, 0, 0, 0.2);
        }
        .btnModal{
            width: 100px;
            color: rgb(124, 69, 153);
            border-radius: 0;
            font-size: 14px;
            height: 30px;
            text-transform: uppercase;
            background: none;
            border: solid 1px rgb(124, 69, 153);
        }
        .btnCancelar{  
            color: rgb(238, 100, 100);
            border: solid 1px rgb(238, 100, 100); 
        }
        .btnEliminar {
            color: rgb(238, 100, 100);
            border: solid 1px rgb(238, 100, 100); 
            margin-right: 10px;            
        }
        th {
            text-transform: uppercase;
        }
        th, td{
            text-align:center;
        }
        .celdaDia{
            width: 140px;
            height: 100px !important;
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
        .mwidth100 {
            width: 100px !important;
            margin-right: 10px;
        }
        .mwidth400{
            width: 400px !important;
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
                tituloToast: null,
                textoToast: null,
                //
                modalReunion: false,
                horarios: [
                    "7hs",
                    "8hs",
                    "9hs",
                    "10hs",
                    "11hs",
                    "12hs",
                    "13hs",
                    "14hs",
                    "15hs",
                    "16hs",
                    "17hs",
                    "18hs",
                    "19hs"
                ],
                reunion: {
                    fecha: null,
                    capacidad: 1,
                    disponible: 1
                },
                creandoReunion: false,
                reuniones: null,
                whatsappLink: null,
                edicion: false,
                mes: null,
                anio: null,
                meses: ['junio', 'julio', 'agosto', 'septiembre'],
                telefono: null,
                modalTelefono: false,
                telefonoActualizado: null
            },
            mounted() {
                this.pantalla = localStorage.getItem("pantalla");

                this.idVoluntario = <?php echo json_encode($_SESSION["idUsuario"]); ?>;
                this.telefono = <?php echo json_encode($_SESSION["telefono"]); ?>;
                let mes = new Date().getMonth();
                this.year = new Date().getFullYear();
                if (mes + 1 == 6) {
                    this.mes = "junio"
                }
                if (mes + 1 == 7) {
                    this.mes = "julio"
                }
                if (mes + 1 == 8) {
                    this.mes = "agosto"
                }
                if (mes + 1 == 9) {
                    this.mes = "septiembre"
                }
                this.getReuniones();
            },
            computed: {
                semanasMes() {
                    const mesesMap = { enero: 0, febrero: 1, marzo: 2, abril: 3, mayo: 4, junio: 5, julio: 6, agosto: 7, septiembre: 8, octubre: 9, noviembre: 10, diciembre: 11 };
                    const mesIndex = mesesMap[this.mes];
                    const primerDia = new Date(new Date().getFullYear(), mesIndex, 1);
                    const diasEnMes = new Date(new Date().getFullYear(), mesIndex + 1, 0).getDate();

                    let semanas = [];
                    let semana = new Array(7).fill(null);
                    let diaSemana = (primerDia.getDay() + 6) % 7; // convertir Domingo=0 a 6, Lunes=1 a 0, etc.

                    for (let dia = 1; dia <= diasEnMes; dia++) {
                        const fechaStr = `${new Date().getFullYear()}-${String(mesIndex + 1).padStart(2, '0')}-${String(dia).padStart(2, '0')}`;
                        semana[diaSemana] = { numero: dia, fecha: fechaStr };

                        diaSemana++;
                        if (diaSemana === 7) {
                            semanas.push(semana);
                            semana = new Array(7).fill(null);
                            diaSemana = 0;
                        }
                    }

                    if (semana.some(d => d !== null)) semanas.push(semana); // agregar última semana incompleta

                    return semanas;
                }
            },
            methods:{
                clickReunion (reunion) {
                    if (reunion.idUsuario == this.idVoluntario) {
                        this.editarReunion(reunion);
                    } else {
                        if (reunion.disponible == 1) {
                            const phoneNumber = reunion.telefono; // Número de teléfono en formato internacional sin símbolos ni espacios
                            const message = "Hola, Puedo pasarte un postulante para la reunión que agendaste el " +
                            reunion.fecha.split(' ')[0].split('-')[2] +
                            "/" + reunion.fecha.split(' ')[0].split('-')[1] +
                             " a las " + reunion.fecha.split(' ')[1].split(":")[0] + ":" + reunion.fecha.split(' ')[1].split(":")[1] + "hs?" ; // Mensaje opcional
        
                            const whatsappLink = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
                            window.open(whatsappLink, "_blank");
                        }
                    }
                },
                editarReunion (reunion) {
                    this.reunion.id = reunion.id;
                    this.reunion.fecha = reunion.fecha;
                    this.reunion.idUsuario = reunion.idUsuario;
                    this.reunion.disponible = reunion.disponible;
                    //this.reunion = reunion;
                    this.edicion = true;
                    this.modalReunion = true;
                },
                obtenerFechaActual () {
                    var fechaActual = new Date();
                    var year = fechaActual.getFullYear();
                    var month = ("0" + (fechaActual.getMonth() + 1)).slice(-2);
                    var day = ("0" + fechaActual.getDate()).slice(-2);
                    var fechaEnFormatoYYYYMMDD = year + "-" + month + "-" + day;
                    this.reunion.dia = fechaEnFormatoYYYYMMDD;
                },
                cerrarModalReunion(){
                    this.modalReunion = false;
                    this.edicion = false;
                    this.reunion = {
                        fecha: new Date(),
                        capacidad: 1
                    }
                },
                confirmarReunion (){
                    let ahora = new Date();
                    if (app.reunion.fecha == null) {
                        app.mostrarToast("ERROR", "Seleccione una fecha");
                        return;
                    }
                    
                    if (new Date(app.reunion.fecha) < new Date(ahora)) {
                        app.mostrarToast("ERROR", "Seleccione una fecha posterior a la actual");
                        return;
                    }
                
                    this.creandoReunion = true;
                    let formdata = new FormData();
                    
                    formdata.append("idUsuario", app.idVoluntario);
                    formdata.append("fecha", app.reunion.fecha);
                    formdata.append("disponible", app.reunion.disponible);
                    formdata.append("capacidad", app.reunion.capacidad);
                    axios.post("funciones/reuniones.php?accion=crearReunion", formdata)
                    .then(function(response){
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            // app.pedirConfirmacion = false;
                            app.modalReunion = false;
                            app.mostrarToast("Éxito", response.data.mensaje);
                            app.getReuniones();
                            // app.consultarUsuarios();
                            app.resetReunion();
                        }
                        app.creandoReunion = false;
                    }).catch( error => {
                        app.creandoReunion = false;
                        app.mostrarToast("Error", "No se pudo crear el usuario");
                    })
                },
                confirmarDelete () {                
                    let formdata = new FormData();
                    formdata.append("idReunion", app.reunion.id);
                    axios.post("funciones/reuniones.php?accion=eliminarReunion", formdata)
                    .then(function(response){
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            // app.pedirConfirmacion = false;
                            app.modalReunion = false;
                            app.edicion = false;
                            app.mostrarToast("Éxito", response.data.mensaje);
                            app.getReuniones();
                            app.resetReunion();
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo eliminar la reunión");
                    })              
                },
                confirmarEdicion (){
                    let ahora = new Date();
                    if (app.reunion.fecha == null) {
                        app.mostrarToast("ERROR", "Seleccione una fecha");
                        return;
                    }
                    
                    if (new Date(app.reunion.fecha) < new Date(ahora)) {
                        app.mostrarToast("ERROR", "Seleccione una fecha posterior a la actual");
                        return;
                    }

                    let formdata = new FormData();
                    formdata.append("idUsuario", app.idVoluntario);
                    formdata.append("fecha", app.reunion.fecha);
                    formdata.append("disponible", app.reunion.disponible);
                    formdata.append("idReunion", app.reunion.id);
                    formdata.append("capacidad", app.reunion.capacidad);
                    axios.post("funciones/reuniones.php?accion=editarReunion", formdata)
                    .then(function(response){
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            // app.pedirConfirmacion = false;
                            app.modalReunion = false;
                            app.edicion = false;
                            app.mostrarToast("Éxito", response.data.mensaje);
                            app.getReuniones();
                            app.resetReunion();
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo editar la reunión");
                    })
                },
                formatearTelefono(e) {
                    let soloNumeros = e.target.value.replace(/\D/g, '');

                    // Limitar a 10 dígitos
                    this.telefonoActualizado = soloNumeros.slice(0, 10);
                },
                actualizarTelefono (){                         
                    let formdata = new FormData();
                    formdata.append("idUsuario", app.idVoluntario);
                    formdata.append("telefono", app.telefonoActualizado);
                    // axios.post("funciones/reuniones.php?accion=actualizarTelefono", formdata)
                    // .then(function(response){
                    //     if (response.data.error) {
                    //         app.mostrarToast("Error", response.data.mensaje);
                    //     } else {
                    //         app.telefono = app.telefonoActualizado;
                    //         app.modalTelefono = false;
                    //         app.telefonoActualizado = null;
                    //         app.mostrarToast("Éxito", response.data.mensaje);
                    //     }
                    // }).catch( error => {
                    //     app.mostrarToast("Error", "No se pudo editar la reunión");
                    // })
                    axios.post("funciones/reuniones.php?accion=actualizarTelefono", formdata)
                    .then((response) => {
                        if (response.data.error) {
                        this.mostrarToast("Error", response.data.mensaje);
                        } else {
                        this.telefono = this.telefonoActualizado;
                        this.modalTelefono = false;
                        this.telefonoActualizado = null;
                        this.mostrarToast("Éxito", response.data.mensaje);
                        }
                    })
                    .catch(() => {
                        this.mostrarToast("Error", "No se pudo editar la reunión");
                    });
                },
                resetReunion () {
                    this.reunion = {
                        fecha: null,
                        disponible: 1,
                        capacidad: 1
                    }
                    this.obtenerFechaActual();
                },
                getReuniones (){
                    axios.post("funciones/reuniones.php?accion=getReuniones")
                    .then(function(response){
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            response.data.reuniones
                            app.cargarReuniones(response.data.reuniones);
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "No se pudo recuperar la información");
                    })
                },
                cargarReuniones (reuniones) {
                    const groupedMeetings = {};

                    reuniones.forEach(meeting => {
                        const date = meeting.fecha.split(' ')[0];
                        if (!groupedMeetings[date]) {
                            groupedMeetings[date] = [];
                        }
                        groupedMeetings[date].push({
                            id: meeting.id,
                            idUsuario: meeting.idUsuario,
                            fecha: meeting.fecha,
                            capacidad: meeting.capacidad,
                            voluntario: meeting.voluntario,
                            telefono: meeting.telefono,
                            disponible: meeting.disponible
                        });
                    });
                    this.reuniones = groupedMeetings;
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