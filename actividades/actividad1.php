<?php
    session_start();
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
    <script src="../js/shared.js"></script>
    <link href="../css/general.css" rel="stylesheet"> 
    <link href="../css/actividades.css" rel="stylesheet"> 
    <link href="../css/notificacion.css" rel="stylesheet"> 
  
 
</head>
<body>
    <div id="app">
        <div class=" contenedor">

            <div class="row inicio" v-if="nivel == 0">
                <div class="col-12 col-md-10 justify-content-center textoInicio">
                    Siguiendo el orden numérico observá el dibujo, elegí la figura que lo completa y seleccioná la opción
                    que consideres correcta. 
                    <br>
                    <br>
                    Son 60 niveles y tendrás 45 minutos para completarlo.
                    <br>
                    <br>
                    Si lo deseas, podrás avanzar al siguiente nivel sin seleccionar ninguna opción y luego volver al nivel que te haya faltado. 
                </div>
                <br>
                <div class="col-12 col-md-10 d-flex justify-content-center">
                    <button class="boton" @click="comenzar()">
                        Comenzar
                    </button>
                </div>
            </div>      

            <div class="row contenedorRaven" v-if="nivel != 0">
                <div class="col-12">
                    <div class="row contenedorOpciones header">
                        <span class="col-6">
                            Nivel: {{nivel}}
                        </span>
                        <span class="col-6 d-flex justify-content-end">
                            Tiempo: {{mostrarMinutos()}}
                        </span>
                    </div>
                </div>    
               
                <div class="col-12 ">
                    <img @load="imagenCargada" class="col-12 my-2 imagenPrincipal" :src="'../img/nivel' + nivel + '.jpg'" >
                </div>

                <div class="col-12">
                    <div class="row contenedorOpciones d-flex justify-content-around">
                        
                        <img @load="imagenCargada" class="col-3 my-2 opcion" :class="remarcarOpcion(nivel, '1')"  @click="seleccionar(1)" :src="'../img/opcionRaven-' + nivel + '.1.jpg'" >
                        <img @load="imagenCargada" class="col-3 my-2 opcion" :class="remarcarOpcion(nivel, '2')" @click="seleccionar(2)" :src="'../img/opcionRaven-' + nivel + '.2.jpg'" >
                        <img @load="imagenCargada" class="col-3 my-2 opcion" :class="remarcarOpcion(nivel, '3')" @click="seleccionar(3)" :src="'../img/opcionRaven-' + nivel + '.3.jpg'" >
                        <img @load="imagenCargada" class="col-3 my-2 opcion" :class="remarcarOpcion(nivel, '4')" @click="seleccionar(4)" :src="'../img/opcionRaven-' + nivel + '.4.jpg'" >
                        <img @load="imagenCargada" class="col-3 my-2 opcion" :class="remarcarOpcion(nivel, '5')" @click="seleccionar(5)" :src="'../img/opcionRaven-' + nivel + '.5.jpg'" >
                        <img @load="imagenCargada" class="col-3 my-2 opcion" :class="remarcarOpcion(nivel, '6')" @click="seleccionar(6)" :src="'../img/opcionRaven-' + nivel + '.6.jpg'" >
                        <img @load="imagenCargada" class="col-3 my-2 opcion" :class="remarcarOpcion(nivel, '7')" @click="seleccionar(7)" :src="'../img/opcionRaven-' + nivel + '.7.jpg'" v-if="nivel > 24">
                        <img @load="imagenCargada" class="col-3 my-2 opcion" :class="remarcarOpcion(nivel, '8')" @click="seleccionar(8)" :src="'../img/opcionRaven-' + nivel + '.8.jpg'" v-if="nivel > 24">
                     
                    </div>
                    <div class="row contenedorOpciones d-flex justify-content-around">
                        <button class="btnTerminar" @click="anterior()" v-if="nivel != 1">ANTERIOR</button>
                        <button class="btnTerminar" @click="siguiente()" v-if="nivel < 60">SIGUIENTE</button>
                        <button class="btnTerminar" @click="terminar()" v-if="nivel == 60">TERMINAR</button>
                    </div>
                </div>

            </div>
          

            <!-- START MODAL CONFIRMACION -->
            <div v-if="modalConfirmacion">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalConfirmacion">TERMINAR ACTIVIDAD</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalConfirmacion = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                ¿Desea finalizar la actividad? Una vez terminada, no podrá modificar sus respuestas.
                            </div>
                        </div>
                        <div v-if="!terminando">
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="botonCancelar" @click="cerrarModal()">Cancelar</button>
                                <button type="button" @click="confirmar"  class="boton">Terminar</button>
                            </div>
                        </div>
                        <div v-if="terminando">
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
            <!-- END MODAL CONFIRMACION -->

            <!-- START MODAL TIEMPO -->
            <div v-if="modalTiempo">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalConfirmacion">TIEMPO TERMINADO</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                Se terminó el tiempo disponible para realizar la actividad
                            </div>
                        </div>
                        <div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" @click="aceptar"  class="boton">ACEPTAR</button>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>   
            <!-- END MODAL TIEMPO -->

            <div v-if="loading" class="modal-container">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0" style="width: 80%; max-width: 600px;">
                        <div class="modal-header d-flex justify-content-center">
                            <h5 class="modal-title" id="modalConfirmacion">CARGANDO</h5>
                        </div>
                        <div class="modal-body">
                            <div class="loading">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>  
        
            <!-- START NOTIFICACION -->
            <div role="alert" id="mitoast" aria-live="assertive"  @mouseover="ocultarToast" aria-atomic="true" class="toast">
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
        
        .inicio{
            width: 800px;
            padding: 20px;
            margin: auto;
            border-radius: 20px;
            border: solid 1px rgb(124, 69, 153);
            height: 300px;
            display: flex;
            text-transform: uppercase;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: rgb(124, 69, 153);
            font-size: 16px;
            margin-top:100px; 
            margin-bottom:100px; 
            font-weight: bolder;
        }
        .contenedorRaven{
            
            min-height:200px;
            margin-top: 10vh;
        }
        .contenedorOpciones{
            max-width: 500px;
            margin: auto;
        }
        .cajaNivel{
            margin-bottom:0;
            height: 300px;
            position:relative;
            background-position:center;
            background-repeat: no-repeat;
            background-size: auto;
        }
        .opcion{
            border: none;
            padding: 0;
        }
        .opcion:hover{
            border: solid 5px grey; 
        }        
        img{
            width: auto;
            object-fit: contain;
        }
        .imagenPrincipal{
            height: auto;
            max-height: 300px;
        }
        .checked{
            border: solid 1px red;
        }
        .imagenRaven{
            width: 100%;
            padding: 0;
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat !important;
            z-index:2;
        }
        .rowOpcion{
            width: 90%;
            height: 100px;
            margin:5px auto !important;
            
            border-radius: 10px;
            padding: 3px;
            display: flex;
            justify-content: space-around !important;
        }
        .hide{
            display: none;
        }
        .btnOpcion{
            padding: 0;
        }
        .remarcado {
            border: solid 5px rgb(124, 69, 153);
        }
        .header{
            height:50px;
            background: rgb(124, 69, 153);
            color: white;
            font-size: 20px;
        }
        .modal-content{
            height:      !important;

        }

    </style>
    <script>
        var app = new Vue({
            el: "#app",
            components: {
            },
            data: {
                loading: false,
                nivel: 0,
                tiempo: null,
                temporizador: null,
                imagenesCargadas: 0,
                descuentoActivo: false,
                modalTiempo: false,
                //
                respuestas: {
                    1: null,
                    2: null,
                    3: null,
                    4: null,
                    5: null,
                    6: null,
                    7: null,
                    8: null,
                    9: null,
                    10: null,
                    11: null,
                    12: null,
                    13: null,
                    14: null,
                    15: null,
                    16: null,
                    17: null,
                    18: null,
                    19: null,
                    20: null,
                    21: null,
                    22: null,
                    23: null,
                    24: null,
                    25: null,
                    26: null,
                    27: null,
                    28: null,
                    29: null,
                    30: null,
                    31: null,
                    32: null,
                    33: null,
                    34: null,
                    35: null,
                    36: null,
                    37: null,
                    38: null,
                    39: null,
                    40: null,
                    41: null,
                    42: null,
                    43: null,
                    44: null,
                    45: null,
                    46: null,
                    47: null,
                    48: null,
                    49: null,
                    50: null,
                    51: null,
                    52: null,
                    53: null,
                    54: null,
                    55: null,
                    56: null,
                    57: null,
                    58: null,
                    59: null,
                    60: null
                },
                idPostulante: null,
                tituloToast: null,
                textoToast: null,
                rol: null,
                nombre: null,
                modalConfirmacion: false,
                terminando: false
            },
            mounted () {
                this.idPostulante = <?php echo json_encode($_SESSION["idUsuario"]); ?>;
                this.loading = true;
                this.consultarActividad();
            },
            beforeUpdate() {
                if (this.tiempo == 0) {
                    this.descuentoActivo = false;
                    this.modalTiempo = true;
                    this.terminarPorTiempo()
                }
            },
            methods:{
                comenzar () {
                    this.loading = true;
                    this.nivel = 1;
                    this.actualizarActividad();
                },
                cerrarModal () {
                    this.modalConfirmacion = false;
                    this.descuentoActivo = true
                    this.descontar();
                },
                consultarActividad () {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    axios.post("../funciones/accionesActividades.php?accion=consultarRaven", formdata)
                    .then(function(response){ 
                        if (response.data.error) {
                            window.location.href = '../menu.php';
                        } else {
                            let habilitado = response.data.resultado[0].habilitado1;
                            let tiempo = response.data.resultado[0].tiempo;
                            if (habilitado == 0 || tiempo == 0 ) {
                                window.location.href = '../menu.php'; 
                            } else {
                                app.nivel = (response.data.resultado[0].nivel);
                                app.tiempo = JSON.parse(response.data.resultado[0].tiempo);
                                if (app.nivel == 0) {
                                    app.loading = false;
                                }
                                if (response.data.resultado[0].resultado1 != "-") {
                                    app.tiempo = JSON.parse(response.data.resultado[0].tiempo);
                                    let respuestas = JSON.parse(response.data.resultado[0].resultado1);
                                    if (respuestas != "-") {
                                        app.respuestas[1] = respuestas[1] ? respuestas[1] : null;
                                        app.respuestas[2] = respuestas[2] ? respuestas[2] : null;
                                        app.respuestas[3] = respuestas[3] ? respuestas[3] : null;
                                        app.respuestas[4] = respuestas[4] ? respuestas[4] : null;
                                        app.respuestas[5] = respuestas[5] ? respuestas[5] : null;
                                        app.respuestas[6] = respuestas[6] ? respuestas[6] : null;
                                        app.respuestas[7] = respuestas[7] ? respuestas[7] : null;
                                        app.respuestas[8] = respuestas[8] ? respuestas[8] : null;
                                        app.respuestas[9] = respuestas[9] ? respuestas[9] : null;
                                        app.respuestas[10] = respuestas[10] ? respuestas[10] : null;
                                        app.respuestas[11] = respuestas[11] ? respuestas[11] : null;
                                        app.respuestas[12] = respuestas[12] ? respuestas[12] : null;
                                        app.respuestas[13] = respuestas[13] ? respuestas[13] : null;
                                        app.respuestas[14] = respuestas[14] ? respuestas[14] : null;
                                        app.respuestas[15] = respuestas[15] ? respuestas[15] : null;
                                        app.respuestas[16] = respuestas[16] ? respuestas[16] : null;
                                        app.respuestas[17] = respuestas[17] ? respuestas[17] : null;
                                        app.respuestas[18] = respuestas[18] ? respuestas[18] : null;
                                        app.respuestas[19] = respuestas[19] ? respuestas[19] : null;
                                        app.respuestas[20] = respuestas[20] ? respuestas[20] : null;
                                        app.respuestas[21] = respuestas[21] ? respuestas[21] : null;
                                        app.respuestas[22] = respuestas[22] ? respuestas[22] : null;
                                        app.respuestas[23] = respuestas[23] ? respuestas[23] : null;
                                        app.respuestas[24] = respuestas[24] ? respuestas[24] : null;
                                        app.respuestas[25] = respuestas[25] ? respuestas[25] : null;
                                        app.respuestas[26] = respuestas[26] ? respuestas[26] : null;
                                        app.respuestas[27] = respuestas[27] ? respuestas[27] : null;
                                        app.respuestas[28] = respuestas[28] ? respuestas[28] : null;
                                        app.respuestas[29] = respuestas[29] ? respuestas[29] : null;
                                        app.respuestas[30] = respuestas[30] ? respuestas[30] : null;
                                        app.respuestas[31] = respuestas[31] ? respuestas[31] : null;
                                        app.respuestas[32] = respuestas[32] ? respuestas[32] : null;
                                        app.respuestas[33] = respuestas[33] ? respuestas[33] : null;
                                        app.respuestas[34] = respuestas[34] ? respuestas[34] : null;
                                        app.respuestas[35] = respuestas[35] ? respuestas[35] : null;
                                        app.respuestas[36] = respuestas[36] ? respuestas[36] : null;
                                        app.respuestas[37] = respuestas[37] ? respuestas[37] : null;
                                        app.respuestas[38] = respuestas[38] ? respuestas[38] : null;
                                        app.respuestas[39] = respuestas[39] ? respuestas[39] : null;
                                        app.respuestas[40] = respuestas[40] ? respuestas[40] : null;
                                        app.respuestas[41] = respuestas[41] ? respuestas[41] : null;
                                        app.respuestas[42] = respuestas[42] ? respuestas[42] : null;
                                        app.respuestas[43] = respuestas[43] ? respuestas[43] : null;
                                        app.respuestas[44] = respuestas[44] ? respuestas[44] : null;
                                        app.respuestas[45] = respuestas[45] ? respuestas[45] : null;
                                        app.respuestas[46] = respuestas[46] ? respuestas[46] : null;
                                        app.respuestas[47] = respuestas[47] ? respuestas[47] : null;
                                        app.respuestas[48] = respuestas[48] ? respuestas[48] : null;
                                        app.respuestas[49] = respuestas[49] ? respuestas[49] : null;
                                        app.respuestas[50] = respuestas[50] ? respuestas[50] : null;
                                        app.respuestas[51] = respuestas[51] ? respuestas[51] : null;
                                        app.respuestas[52] = respuestas[52] ? respuestas[52] : null;
                                        app.respuestas[53] = respuestas[53] ? respuestas[53] : null;
                                        app.respuestas[54] = respuestas[54] ? respuestas[54] : null;
                                        app.respuestas[55] = respuestas[55] ? respuestas[55] : null;
                                        app.respuestas[56] = respuestas[56] ? respuestas[56] : null;
                                        app.respuestas[57] = respuestas[57] ? respuestas[57] : null;
                                        app.respuestas[58] = respuestas[58] ? respuestas[58] : null;
                                        app.respuestas[59] = respuestas[59] ? respuestas[59] : null;
                                        app.respuestas[60] = respuestas[60] ? respuestas[60] : null;
                                    }
                                }
                            }
                        }
                    }).catch( error => {
                        window.location.href = '../menu.php';
                    });
                },
                actualizarActividad () {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("nivel", app.nivel);
                    formdata.append("tiempo", app.tiempo);
                    formdata.append("respuestas", JSON.stringify(this.respuestas));
                    axios.post("../funciones/accionesActividades.php?accion=actualizarRaven", formdata)
                    .then(function(response){ 
                    if (response.data.mensaje== "USUARIO BLOQUEADO") {
                            window.location.href = '../menu.php';
                        }
                    }).catch( error => {
                        console.log("error");
                    });
                },
                mostrarMinutos() {
                    let minutos = Math.floor(this.tiempo / 60);
                    let segundos = this.tiempo % 60;
                    let minutosFormateados = (minutos < 10) ? '0' + minutos : minutos;
                    let segundosFormateados = (segundos < 10) ? '0' + segundos : segundos;
                    return minutosFormateados + ':' + segundosFormateados;
                },

                descontar() {
                    if (this.tiempo == 0) {
                        this.descuentoActivo = false;
                        this.modalTiempo = true;
                        this.terminarPorTiempo()
                    }
                    if (this.descuentoActivo && this.tiempo > 0) {
                        var actual = new Date();
                        let segundosArranque = actual.getHours() * 3600 + actual.getMinutes() * 60 + actual.getSeconds();
                        let tiempoInicial = app.tiempo;

                        // Almacenar el identificador del intervalo en una variable
                        let intervalo = setInterval(function() {
                            var fechaActual = new Date();
                            var segundosTotales = fechaActual.getHours() * 3600 + fechaActual.getMinutes() * 60 + fechaActual.getSeconds();
                            let diferencia = segundosTotales - segundosArranque;
                            app.tiempo = tiempoInicial - diferencia;
                            if (this.tiempo == 0) {
                                this.descuentoActivo = false;
                                this.modalTiempo = true;
                                this.terminarPorTiempo()
                            }
                            // Detener la ejecución repetida si this.descuentoActivo es falso
                            if (!app.descuentoActivo) {
                                clearInterval(intervalo);
                            }
                        }, 1000);
                    }
                },
                imagenCargada() {
                    this.imagenesCargadas++;
                    if (this.imagenesCargadas === 7) {
                        this.loading = false;
                        if (this.tiempo > 0 && !this.descuentoActivo) {
                            this.descuentoActivo = true;
                            this.descontar();
                        }
                    }
                },               
                anterior () {
                    this.descuentoActivo = false;
                    this.loading = true;
                    this.imagenesCargadas = 0;
                    this.nivel--;
                    this.actualizarActividad();
                },
                siguiente () {
                    this.descuentoActivo = false;
                    this.loading = true;
                    this.imagenesCargadas = 0;
                    this.nivel++;
                    this.actualizarActividad();
                },
                remarcarOpcion(nivel, opcion) {
                    if (this.respuestas[nivel] == opcion) {
                        return "remarcado";
                    }
                    return "";
                },
                seleccionar(opcion) {
                    this.descuentoActivo = false;
                    if (this.nivel == 60) {
                        this.respuestas[this.nivel] = opcion;
                        this.terminar();
                    } else {
                        this.loading = true;
                        this.imagenesCargadas = 0;
                        this.respuestas[this.nivel] = opcion;
                        this.nivel++;
                        this.actualizarActividad();
                    }
                },
                
                terminarPorTiempo () {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("nivel", app.nivel);
                    formdata.append("tiempo", 0);
                    formdata.append("respuestas", JSON.stringify(this.respuestas));
                    axios.post("../funciones/accionesActividades.php?accion=terminarRaven", formdata)
                    .then(function(response){ 
                    }).catch( error => {
                        console.log("error");
                    });
                },
                aceptar () {
                    this.terminarPorTiempo();
                    this.modalTiempo = false;
                    window.location.href = '../menu.php';
                },
                terminar () {
                    this.modalConfirmacion = true;
                },
                confirmar () {
                    // let formdata = new FormData();
                    // formdata.append("id", this.idPostulante);
                    // formdata.append("actividad", 3);
                    // formdata.append("respuestas", JSON.stringify(this.respuestas));
                    // axios.post("../funciones/accionesActividades.php?accion=terminarActividad", formdata)
                    // .then(function(response){ 
                    //     if (response.data.mensaje == "OK") {
                    //         window.location.href = 'menu.php';
                    //     }
                    // }).catch( error => {
                    //     this.mostrarToast("ERROR", "Hubo un error al terminar la actividad. Intente nuevamente")
                    //     console.log("error");
                    // });
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("nivel", app.nivel);
                    formdata.append("tiempo", app.tiempo);
                    formdata.append("respuestas", JSON.stringify(this.respuestas));
                    axios.post("../funciones/accionesActividades.php?accion=terminarRaven", formdata)
                    .then(function(response){ 
                        if (response.data.mensaje == "OK") {
                            window.location.href = '../menu.php'; 
                        } else {
                            app.mostrarToast("Error", response.data.mensaje);
                        }
                    }).catch( error => {
                        app.mostrarToast("Error", "Hubo un error al guardar la información. Intente nuevamente");
                    });
                },
                

                

                ocultarToast(titulo, texto) {
                    var toast = document.getElementById("mitoast");
                    toast.classList.add("remove");
                    toast.classList.add("toast");
                    app.tituloToast = "";
                    app.textoToast = "";
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