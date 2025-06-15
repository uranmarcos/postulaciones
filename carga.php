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
   
    <link href="css/general.css" rel="stylesheet"> 
    <link href="css/notificacion.css" rel="stylesheet"> 
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
  
  
 
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
                    <span> - </span>
                    <span class="mx-2 grey"> Carga de usuarios </span>
                </div>
            </div>
            <!-- END BREADCRUMB -->

            <div class="row my-3 d-flex justify-content-between">
                <div class="col-12 px-0 col-md-4">
                    <input type="file" class="form-control" @change="cargaArchivo($event)" v-model="archivo" id="excelInput">
                </div>
                <div class="col-md-6 px-0">
                    <div class="row d-flex justify-content-end">

                        <button type="button" @click="scrollAbajo" class="boton mx-3" v-if="mostrarBotonAbajo">Ir abajo</button>
                        
                        <button type="button" :disabled="usuarios.length == 0" @click="descargarExcel" class="boton">Descargar</button>
                        
                        <button type="button" class="boton mx-3" @click="ayuda = true">AYUDA</button>
                       
                        <button type="button" class="boton" @click="volver">Volver</button>
                        
                    </div>
                </div>
                
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Provincia</th>
                            <th scope="col">Nombre (*)</th>
                            <th scope="col">Dni (*)</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">RESULTADO</th>
                            <th scope="col">RAVEN</th>
                            <th scope="col">CT</th>
                            <th scope="col">AÑO</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody v-if="usuarios.length != 0">
                        <tr v-for="(usuario, index) in usuarios">
                            <td><input type="text" class="inputTabla" v-model="usuario[0]"></td>
                            <td>    
                                <input type="text" class="inputTabla inputNombre"  @blur="validarForm" v-model="usuario[1]"><br>
                                <span class="errorValidacion errorNombre"></span>
                            </td>
                            <td>
                                <input type="text" class="inputTabla" @blur="validarForm" v-model="usuario[2]"><br>
                                <span class="errorValidacion errorDni"></span>
                            </td>
                            <td><input type="text" class="inputTabla" v-model="usuario[3]"></td>
                            <td :class="usuario[4] == 'OK' ? 'exito' : 'error'">{{usuario[4]}}</td>
                            <td :class="usuario[4] == 'OK' ? 'exito' : 'error'">{{usuario[5]}}</td>
                            <td :class="usuario[4] == 'OK' ? 'exito' : 'error'">{{usuario[6]}}</td>
                            <td :class="usuario[4] == 'OK' ? 'exito' : 'error'">{{usuario[7]}}</td>
                            <td>
                                <svg 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    width="18" 
                                    height="18" 
                                    fill="currentColor" 
                                    class="bi deleteUsuario bi-x-circle" 
                                    viewBox="0 0 16 16"
                                    @click="deleteUsuario(index)"
                                >
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            <div class="row mt-4 mb-4 d-flex justify-content-end " v-if="usuarios.length != 0">
                <div class="col-12 col-md-8 px-0 d-flex justify-content-start">
                    <button type="button" @click="scrollArriba" class="boton">Ir arriba</button>
                </div>    
                <div class="col-12 col-md-4 px-0 d-flex justify-content-end">
                    <button type="button" @click="limpiar()" class="boton botonLimpiar">Limpiar</button>
                    <button type="button" @click="crear" class="boton">Crear Usuarios</button>
                </div>
            </div>
             <!-- START MODAL CREACION USUARIOS -->
             <div v-if="modalCreacion">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoUsuario">CREANDO USUARIOS</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalCreacion = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                        <div class="modal-body">
                            <div class="row d-flex justify-content-center">
                                Avance: {{usuariosCreados}}
                                <br>
                                Usuario creandose: {{usuarioEnCurso}}
                                <div id="progress-bar-container">
                                    <div class="progress-bar"></div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>   
            </div>   
            <!-- END MODAL CREACION USUARIOS -->

            <!-- START MODAL RESUMEN -->
             <div v-if="modalResumen">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoUsuario">RESUMEN</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalResumen = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                        <div class="modal-body">
                            <div class="row d-flex justify-content-center">
                                <div class="exito">
                                    USUARIOS CREADOS: {{this.usuarios.filter(element => element[4] == "OK").length}} de {{usuarios.length}}
                                </div>    
                                <br>
                                <div class="error">
                                    USUARIOS CON ERROR : {{this.usuarios.filter(element => element[4] != "OK").length}} de {{usuarios.length}}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" @click="modalResumen = false"  class="boton">ACEPTAR</button>
                        </div>
                        
                    </div>
                </div>   
            </div>   
            <!-- END MODAL RESUMEN -->

            <!-- START MODAL AYUDA -->
            <div v-if="ayuda">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoUsuario">AYUDA</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="ayuda = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                        <div class="modal-body">
                            <div class="row d-flex justify-content-center">
                                Para la creacion de usuarios por archivo, debe utilizar un excel con los datos como se ven en la imagen:
                            </div>
                            <img src="img/ayuda.png" class="ayuda">
                            <div class="row d-flex justify-content-center">
                                <ul class="checklist">
                                    <li>No debe haber ninguna fila por encima de los datos</li>
                                    <li>No debe haber ninguna columna a la izquierda de los datos</li>
                                    <li>Los campos provincia y telefono pueden ser nulos</li>
                                    <li>El orden de las columnas debe ser el mismo al que se visualiza en la imagen</li>
                                    <li>Los nombres de las columnas pueden ser diferentes a los de la imagen, o incluso nulos</li>
                                    <li>Una vez cargado el archivo, los datos podrán modicarse</li>
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" @click="ayuda = false"  class="boton">ACEPTAR</button>
                        </div>
                        
                    </div>
                </div>   
            </div>   
            <!-- END MODAL AYUDA -->
        </div>
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
        .inputNombre{
            width: 200px !important;
        }
        .botonLimpiar{
            color: rgb(238, 100, 100);
            border: solid 1px rgb(238, 100, 100);
            margin-right: 20px;
        }
        .botonLimpiar:hover{
            background: rgb(238, 100, 100);
            color: white;
            border: solid 1px rgb(238, 100, 100);
        }
        .errorValidacion{
            background: red;
            width: 150px;
            margin: auto;
            display: flex;
            justify-content: center;
            font-size: 14px;
            color: white;
        }
        .progress-bar {
            width: 0%;
            height: 20px;
            background-color: #42b983;
            border-radius: 10px;
            transition: width 0.5s;
            animation: progress-animation 2s linear infinite;
        }
        .exito{
            color: green;
        }
        .error{
            color: red;
        }
        .deleteUsuario{
            margin: 0 5px;
            color: rgb(238, 100, 100);
        }
        .deleteUsuario:hover{
            cursor: pointer;
        }
        .ayuda{
            width: 600px;
            height: auto;
        }
        .modal-content{
            width: 650px !important;
        }
        .checklist {
            list-style-type: none;
            padding-left: 20px;
        }
        .remarcado{
            background: pink;
        }

        .checklist li:before {
            content: "\2714";
            color: #42b983;
            margin-right: 5px;
        }

        @keyframes progress-animation {
            0% { width: 0%; }
            100% { width: 100%; }
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
                modalCreacion: false,
                modalResumen: false,
                usuariosCreados: "",
                idVoluntario: null,
                ayuda: false,
                tituloToast: null,
                textoToast: null,
                archivo: null,
                mostrarBotonAbajo: false
            },
            mounted() {
                this.pantalla = localStorage.getItem("pantalla");
                this.idVoluntario = <?php echo json_encode($_SESSION["idUsuario"]); ?>;
            },
            methods:{
                async cargaArchivo (event) {
                    const content = await readXlsxFile(event.target.files[0])
                    this.usuarios = content.slice(1, content.length)
                    this.contenidoEsMasAltoQuePantalla();
                },
                limpiar () {
                    this.usuarios = [];
                    this.archivo= null;
                    this.contenidoEsMasAltoQuePantalla();
                },
                volver () {
                    if (this.pantalla == "usuarios") {
                        window.location.href = 'usuarios.php';  
                    } else {
                        window.location.href = 'asignados.php';  
                    }
                },
                
                crear () {
                    let validacion = this.validarForm();
                    if (validacion) {
                        this.crearUsuarios();
                    }
                },
                validarForm () {
                    let validacion = true;
                    let contador = 0;
                    let erroresNombre = document.getElementsByClassName("errorNombre")
                    let erroresApellido = document.getElementsByClassName("errorApellido")
                    let erroresDni = document.getElementsByClassName("errorDni")
                    const regex = /[0-9!@#$%^&*()_+{}\[\]:;<>,.?~\\/]/;
                    this.usuarios.forEach((element, index) => {
                        if(element[1] == null) {
                            element[1] = ''
                        } 
                        element[1] = this.obtenerSoloLetras(element[1]) != null ? this.obtenerSoloLetras(element[1]) : '';
                        element[3] = this.obtenerSoloNumeros(element[3]);

                        if (element[1] == null || element[1].length < 3) {
                            validacion = false;
                            contador++;
                            erroresNombre[index].innerHTML = "Minimo 3 caracteres";
                        } else if (regex.test(element[1])) {
                            validacion = false;
                            contador++;
                            erroresNombre[index].innerHTML = "Caracteres no permitidos";
                        } else if (element[1].length > 100) {
                            validacion = false;
                            contador++;
                            erroresNombre[index].innerHTML = "Máximo 100 caracteres";
                        } else {
                            erroresNombre[index].innerHTML = ""
                        }

                        // if (element[2] == null || element[2].length < 3) {
                        //     validacion = false;
                        //     erroresApellido[index].innerHTML = "Minimo 3 caracteres"
                        // } else if (element[2].length > 20) {
                        //     validacion = false;
                        //     erroresNombre[index].innerHTML = "Máximo 20 caracteres"
                        // } else {
                        //     erroresApellido[index].innerHTML = ""
                        // }
                      
                        if (element[2] == null || element[2].toString().trim().length != 8) {
                            erroresDni[index].innerHTML = "8 caracteres";
                            validacion = false;
                            contador++;
                        } else if (!/^\d+$/.test(element[2])) {
                            erroresDni[index].innerHTML = "Campo numérico";
                            validacion = false;
                            contador++;
                        } else {
                            erroresDni[index].innerHTML = ""
                        }
                        
                        if (!validacion) {
                            this.mostrarToast("Error", "Corrija " + contador + " errores para poder continuar");
                        }
                    });
                    return validacion;
                },
                obtenerSoloLetras(cadena) {
                    // Usamos una expresión regular para eliminar los caracteres que no son letras
                    cadena = String(cadena);
                    const letras = cadena.replace(/[^a-zA-Z\s]/g, '');
                    return letras;
                },
                obtenerSoloNumeros(cadena) {
                    // Usamos una expresión regular para eliminar los caracteres no numéricos
                    const valorComoString = String(cadena);
                    // Usamos una expresión regular para eliminar los caracteres no numéricos
                    const numeros = valorComoString.replace(/\D/g, '');
                    // const numeros = cadena.replace(/\D/g, '');
                    return numeros;
                },
                mostrarToast(titulo, texto) {
                    app.tituloToast = titulo;
                    app.textoToast = texto;
                    var toast = document.getElementById("mitoast");
                    var tituloToast = document.getElementById("tituloToast");
                    toast.classList.remove("toast");
                    toast.classList.add("mostrar");
                    setTimeout(function(){ toast.classList.toggle("mostrar"); }, 5000);
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
                crearUsuarios () {
                   
                    this.modalCreacion = true;
                    
                    this.usuarios.forEach((element, index) => {
                        this.usuariosCreados = (index + 1) + " de " + this.usuarios.length
                        this.usuarioEnCurso = element[1];
                        let formdata = new FormData();

                        formdata.append("provincia", element[0] ? element[0].trim() : null);
                        formdata.append("nombre", element[1].trim());
                        formdata.append("apellido"," ");
                        formdata.append("dni", element[2]);
                        formdata.append("telefono", element[3] ? element[3].toString().trim() : null);
                        formdata.append("asignado", app.idVoluntario);

                        axios.post("funciones/usuarios.php?accion=crearUsuario", formdata)
                        .then(function(response){
                            if (response.data.error) {
                                element[4] = "USUARIO EXISTENTE"
                                element[5] = response.data.mensaje[0].raven;
                                element[6] = response.data.mensaje[0].ct;
                                element[7] = response.data.mensaje[0].anio;
                                if ((index + 1) == app.usuarios.length) {
                                    app.modalCreacion = false;
                                    app.usuariosCreados = null;
                                    app.usuarioEnCurso = null;
                                    app.modalResumen = true;
                                }
                            } else {
                                element[4] = "OK";
                                element[5] = "-";
                                element[6] = "-";
                                element[7] = "-";
                                if ((index + 1) == app.usuarios.length) {
                                    app.modalCreacion = false;
                                    app.usuariosCreados = null;
                                    app.usuarioEnCurso = null;
                                    app.modalResumen = true;
                                }
                            }
                            app.creandoUsuario = false;
                        }).catch( error => {
                            element[4] = "Error al crear el usuario";
                            element[5] = "-";
                            element[6] = "-";
                            element[7] = "-";
                            if ((index + 1) == app.usuarios.length) {
                                app.modalCreacion = false;
                                app.usuariosCreados = null;
                                app.usuarioEnCurso = null;
                                app.modalResumen = true;
                            }
                        })
                    });
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
                deleteUsuario(index) {
                    this.usuarios.splice(index, 1);
                    this.validarForm();
                },
                descargarExcel () {
                    let usuarios = this.usuarios;

                    usuarios.unshift(['Provincia', 'Nombre', 'Dni', 'Telefono', 'Resultado', 'Raven', 'CT', 'Año']);
                    const libro = XLSX.utils.book_new();
                    // const hoja = XLSX.utils.json_to_sheet(usuarios);
                    const hoja = XLSX.utils.json_to_sheet(usuarios, { skipHeader: true });
                    // Agregar la hoja de trabajo al libro
                    XLSX.utils.book_append_sheet(libro, hoja, 'Sheet1');

                    // Guardar el libro como archivo Excel
                    const nombreArchivo = 'postulantes.xlsx';
                    XLSX.writeFile(libro, nombreArchivo);
                    usuarios.shift();
                },
                scrollArriba() {
                    window.scrollTo(0, 0);
                },
                scrollAbajo() {
                    window.scrollTo(0, document.body.scrollHeight);
                },
                contenidoEsMasAltoQuePantalla() {
                    setTimeout(() => {
                        const contenidoAltura = document.body.scrollHeight;
                        const pantallaAltura = window.innerHeight;
    
                        this.mostrarBotonAbajo = contenidoAltura > pantallaAltura;
                    }, 1000);
                }
            }             
        })
    </script>
     <script src="./js/carga.js"></script>
</body>
</html>