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

            <!-- START BREADCRUMB -->
            <div class="col-12 p-0">
                <div class="breadcrumb">
                    ÁREA 9: MODELOS MENTALES
                    <br>
                    Test Leer para Comprender II (TLC-II)
                    <br>    
                </div>
            </div>
            <!-- END BREADCRUMB -->

            <div class="row justify-content-center">
                <main class="col-12 p-0">
                    <h5>Por favor leé atentamente y luego responde las consignas. Esta actividad es sin tiempo.</h5>
                    <br>
                    <p> 
                        <strong>
                            Leer el siguiente relato:
                        </strong>   
                    </p>    
                    
                    <p>
                        El 31 de julio de 2001, el Nuevo siglo tenía el mismo aspecto de siempre: 
                        fotos, titulares diversos y pies de foto más pequeños. La única diferencia 
                        era que yo no podría leer lo que decía. Me daba cuenta de que eran las 
                        mismas veintisiete letras que había aprendido en la escuela. Solo que ahora, 
                        cuando las enfocaba, en un momento me parecían griego y al siguiente coreano. 
                        ¿Se trataba de una versión serbocroata del Nuevo siglo, destinada a la 
                        exportación? ¿Me estaban haciendo una broma pesada? No tengo ningún amigo 
                        que sea capaz de algo así. Me pregunté qué podría hacerles yo para mejorar 
                        esa gracia. Entonces consideré una posibilidad alternativa. Comprobé las páginas 
                        interiores del Nuevo siglo para ver si tenían un aspecto tan extraño como la 
                        portada. Comprobé los anuncios clasificados y las tiras cómicas. Tampoco podía 
                        leerlos.
                    </p>
                    <p>
                        Una oleada de pánico debería haberse apoderado de mí. En cambio, 
                        me inundó una calma razonable, como si no pasara nada. “Puesto que no se 
                        trata de ninguna broma, entonces deduzco que acabo de sufrir una hemorragia”.
                    </p>
                  
                    <br>
                    <p>
                        <strong>
                            Responder las siguientes preguntas seleccionando la opción correcta.
                        </strong>
                    </p>



                    <p>
                        <strong>
                            1. El Nuevo siglo es:
                        </strong>
                        <br>                        
                        <button class="opcion" :class="respuestas.uno == '1a' ? 'checked' : ''" @click="respuestas.uno = '1a', actualizarActividad()">
                            A. Un diario
                        </button>
                        <button class="opcion" :class="respuestas.uno == '1b' ? 'checked' : ''" @click="respuestas.uno= '1b', actualizarActividad()">
                            B. Un libro.
                        </button>
                        <button class="opcion" :class="respuestas.uno == '1c' ? 'checked' : ''" @click="respuestas.uno= '1c', actualizarActividad()">
                            C. Una agenda.
                        </button>
                        <button class="opcion" :class="respuestas.uno == '1d' ? 'checked' : ''" @click="respuestas.uno= '1d', actualizarActividad()">
                            D. Una revista.
                        </button>
                    </p>
                    
                    <br>

                    <p>
                        <strong>
                            2. ¿Qué piensa el protagonista que le ocurrió?
                        </strong>
                        <br>
                        
                        <button class="opcion" :class="respuestas.dos == '2a' ? 'checked' : ''" @click="respuestas.dos = '2a', actualizarActividad()">
                            A. Sufrió una hemorragia que le impedía leer.
                        </button>
                        <button class="opcion" :class="respuestas.dos == '2b' ? 'checked' : ''" @click="respuestas.dos= '2b', actualizarActividad()">
                            B. El texto estaba escrito un coreano.
                        </button>
                        <button class="opcion" :class="respuestas.dos == '2c' ? 'checked' : ''" @click="respuestas.dos= '2c', actualizarActividad()">
                            C. Sus amigos le habían hecho una broma.
                        </button>
                        <button class="opcion" :class="respuestas.dos == '2d' ? 'checked' : ''" @click="respuestas.dos= '2d', actualizarActividad()">
                            D. Olvidó ponerse los anteojos para leer.
                        </button>                    
                    </p>

                    <br>

                    <p>
                        <strong>
                            3. ¿Cómo se siente el protagonista?
                        </strong>
                        <br>

                        <button class="opcion" :class="respuestas.tres == '3a' ? 'checked' : ''" @click="respuestas.tres = '3a', actualizarActividad()">
                            A. Temeroso.
                        </button>
                        <button class="opcion" :class="respuestas.tres == '3b' ? 'checked' : ''" @click="respuestas.tres = '3b', actualizarActividad()">
                            B. Preocupado.
                        </button>
                        <button class="opcion" :class="respuestas.tres == '3c' ? 'checked' : ''" @click="respuestas.tres = '3c', actualizarActividad()">
                            C. Triste.
                        </button>
                        <button class="opcion" :class="respuestas.tres == '3d' ? 'checked' : ''" @click="respuestas.tres = '3d', actualizarActividad()">
                            D. Tranquilo.
                        </button>
                    </p>
                    
                    <br>
                    <hr>
                    <br>
                            
                    <p>        
                        <strong>
                            Leer a continuación el fragmento anterior y responder la pregunta a continuación seleccionando la opción correcta.
                            <br>
                        </strong>    
                    </p>
                    <p>
                        Pensé que lo mejor sería consultar a un especialista en el tema. 
                        Sin dejar pasar más tiempo, me puse los anteojos de leer y busqué mi agenda. 
                        Busqué el teléfono de mi médico de cabecera y lo llamé. Cuando me atendió su 
                        secretaria, me dí cuenta de todo lo que había ocurrido. Me quedé mudo. Corté la 
                        comunicación y me dirigí nuevamente a mi sillón. Tomé el Nuevo siglo y con mucha 
                        felicidad empecé mi día nuevamente.  
                    </p>
                    <p>
                        <strong>    
                            4. ¿Qué le ocurrió al protagonista realmente?
                        </strong>
                        <br>
                        <button class="opcion" :class="respuestas.cuatro == '4a' ? 'checked' : ''" @click="respuestas.cuatro = '4a', actualizarActividad()">
                            A. Sufrió una hemorragia que le impedía leer.
                        </button>
                        <button class="opcion" :class="respuestas.cuatro == '4b' ? 'checked' : ''" @click="respuestas.cuatro= '4b', actualizarActividad()">
                            B. El texto estaba escrito en coreano.
                        </button>
                        <button class="opcion" :class="respuestas.cuatro == '4c' ? 'checked' : ''" @click="respuestas.cuatro= '4c', actualizarActividad()">
                            C. Sus amigos le habían hecho una broma. 
                        </button>
                        <button class="opcion" :class="respuestas.cuatro == '4d' ? 'checked' : ''" @click="respuestas.cuatro= '4d', actualizarActividad()">
                            D. Olvidó ponerse los anteojos para leer.
                        </button>                        
                    </p>
                    
                    <br>
                        
                     
                    <hr>
                    <br>
                    
                    <p>
                        <strong>
                            Leer el siguiente fragmento y responder la pregunta a continuación seleccionando la opción correcta.
                        </strong>
                    </p>
                    <p>
                        Andrés empezó el secundario en una escuela técnica. Ya tuvo la primera semana 
                        de clases y se encontró con un montón de materias nuevas. Ahora se disponía a 
                        hacer la tarea de dibujo. La consigna decía así: dibujar la inicial de tu 
                        nombre de forma tridimensional. Las caras internas de la figura tienen que 
                        estar pintadas de color gris. Las caras externas deben tener líneas oblicuas, 
                        orientadas en dos direcciones diferentes, superpuestas. Además, la letra tiene 
                        que estar rotada a 45 grados manteniendo su orientación tradicional. 
                    </p>
                    <p>
                        <strong>
                            5. ¿Cuál de estas figuras puede ser el dibujo de Andrés para que la consigna esté bien realizada?
                        </strong>
                        <div class="imagen">
                        </div>
                        <br>           

                        <button class="opcion" :class="respuestas.cinco == '5a' ? 'checked' : ''" @click="respuestas.cinco = '5a', actualizarActividad()">
                            A. 
                        </button>
                        <button class="opcion" :class="respuestas.cinco == '5b' ? 'checked' : ''" @click="respuestas.cinco= '5b', actualizarActividad()">
                            B.
                        </button>
                        <button class="opcion" :class="respuestas.cinco == '5c' ? 'checked' : ''" @click="respuestas.cinco= '5c', actualizarActividad()">
                            C. 
                        </button>
                        <button class="opcion" :class="respuestas.cinco == '5d' ? 'checked' : ''" @click="respuestas.cinco= '5d', actualizarActividad()">
                            D. 
                        </button>
                    </p>
                    
                    
                    <br>
                    <hr>
                    <br>
                    
                    <p>
                        <strong>
                            En el fragmento que sigue hay una palabra inventada. Leerlo y responder 
                            la pregunta que sigue seleccionando la opción correcta.
                        </strong>
                        <br>
                        <br>
                            El pengo medio y ordinario consiste en una contracción general del rostro 
                            y un sonido espasmódico acompañado de lágrimas y mocos estos últimos al 
                            final (…). Llegado el pengo, se tapará con decoro el rostro usando ambas 
                            manos con la palma hacia dentro. Los niños lo harán con la manga del saco 
                            contra la cara, y de preferencia en un rincón del cuarto. Duración media 
                            del pengo, tres minutos.
                    </p>

                    <p>
                        <strong>
                            6. ¿Qué palabra sustituye el término “pengo”?
                        </strong>
                        <br>
                        <br>

                        <button class="opcion" :class="respuestas.seis == '6a' ? 'checked' : ''" @click="respuestas.seis = '6a', actualizarActividad()">
                            A. Estornudo
                        </button>
                        <button class="opcion" :class="respuestas.seis == '6b' ? 'checked' : ''" @click="respuestas.seis= '6b', actualizarActividad()">
                            B. Sueño.
                        </button>
                        <button class="opcion" :class="respuestas.seis == '6c' ? 'checked' : ''" @click="respuestas.seis= '6c', actualizarActividad()">
                            C. Canto.
                        </button>
                        <button class="opcion" :class="respuestas.seis == '6d' ? 'checked' : ''" @click="respuestas.seis= '6d', actualizarActividad()">
                            D. Llanto.
                        </button>
                    </p>

                    <br>
                    <hr>
                    <br>
                    
                    <p>
                        <strong>
                            Leer la siguiente definición y adivinar de qué se trata. Responder en cada caso 
                            seleccionando la opción correcta.
                        </strong>
                        <br>
                        <br>        
                            Toda mi vida en un mes, mi caudal son cuatro cuartos, y aunque me vez pobrecita 
                            ando siempre en lo más alto.
                    </p>
                    
                    <p>
                        <strong>    
                            7. ¿De qué se trata?
                        </strong>
                        <br>                        
                        <br>
                        <button class="opcion" :class="respuestas.siete == '7a' ? 'checked' : ''" @click="respuestas.siete = '7a', actualizarActividad()">
                            A. La luna.
                        </button>
                        <button class="opcion" :class="respuestas.siete == '7b' ? 'checked' : ''" @click="respuestas.siete= '7b', actualizarActividad()">
                            B. La chimenea. 
                        </button>
                        <button class="opcion" :class="respuestas.siete == '7c' ? 'checked' : ''" @click="respuestas.siete= '7c', actualizarActividad()">
                            C. La araña.
                        </button>
                        <button class="opcion" :class="respuestas.siete == '7d' ? 'checked' : ''" @click="respuestas.siete= '7d', actualizarActividad()">
                            D. La lluvia.
                        </button>
                    </p>
                    <br>
                    <hr>
                    <br>
                    <p>
                        <strong>
                            José y Claudia están de vacaciones. Querían llegar a la plaza 
                            principal de la ciudad en la que estaban pero se encontraban perdidos, 
                            por lo que tuvieron que pedir indicaciones. Leer las indicaciones que 
                            recibieron y responder las preguntas a continuación seleccionando 
                            la opción correcta.
                        </strong>
                    </p>
                    <p>
                        Sigan por esta calle hasta llegar a una farmacia que está en una esquina, 
                        allí deben doblar a la derecha. Deben seguir en esa dirección tres cuadras 
                        más hasta encontrarse con un puente. Tienen que cruzar el puente y seguir 
                        otras dos cuadras hasta llegar a una avenida muy importante que en la división 
                        de ambas manos de la calle tienen enormes rosales de color rojo. Toman esa 
                        avenida hacia la derecha. Continúan seis cuadras, van a pasar la casa de 
                        gobierno de la ciudad y el correo. Se darán cuenta dónde terminan esas seis 
                        cuadras, porque la última cuadra está ocupada por una escuela muy grande que 
                        está pintada de color gris y abarca toda la manzana. Cuando lleguen a la 
                        escuela doblen nuevamente a la derecha y sin hacer más que esa cuadra se 
                        encontrarán con la plaza que están buscando. Tengan mucho cuidado porque 
                        tanto la avenida como las demás calles por las que circularán son doble mano. 
                    </p>

                    <p>
                        <strong>
                            8. ¿Dónde está ubicada la plaza respecto de la escuela?
                        </strong>       

                        <br>

                        <button class="opcion" :class="respuestas.ocho == '8a' ? 'checked' : ''" @click="respuestas.ocho = '8a', actualizarActividad()">
                            A. A dos cuadras de la escuela.
                        </button>
                        <button class="opcion" :class="respuestas.ocho == '8b' ? 'checked' : ''" @click="respuestas.ocho= '8b', actualizarActividad()">
                            B. Adentro de la escuela.
                        </button>
                        <button class="opcion" :class="respuestas.ocho == '8c' ? 'checked' : ''" @click="respuestas.ocho= '8c', actualizarActividad()">
                            C. Enfrente de la avenida que pasa por el frente de la escuela.
                        </button>
                        <button class="opcion" :class="respuestas.ocho == '8d' ? 'checked' : ''" @click="respuestas.ocho= '8d', actualizarActividad()">
                            D. Enfrente de la escuela. 
                        </button>
                    </p>
                    <br>    
                    <br>
                    <p>
                        <strong>
                            9. Para regresar al punto de partida deberán: 
                        </strong>    
                        <br>

                        <br>
                        <button class="opcion" :class="respuestas.nueve == '9a' ? 'checked' : ''" @click="respuestas.nueve = '9a', actualizarActividad()">
                            A. Doblar dos veces a la izquierda y una a la derecha.
                        </button>
                        <button class="opcion" :class="respuestas.nueve == '9b' ? 'checked' : ''" @click="respuestas.nueve= '9b', actualizarActividad()">
                            B. No doblar en ningún momento.
                        </button>
                        <button class="opcion" :class="respuestas.nueve == '9c' ? 'checked' : ''" @click="respuestas.nueve= '9c', actualizarActividad()">
                            C. Doblar siempre a la izquierda.
                        </button>
                        <button class="opcion" :class="respuestas.nueve == '9d' ? 'checked' : ''" @click="respuestas.nueve= '9d', actualizarActividad()">
                            D. Doblar cuando vean un puente.
                        </button>
                    </p>
                    <br>
                    <br>
                    <p>
                        <strong>
                            10. Para responder estas preguntas:
                        </strong>    
                        <br>

                        <br>
                        <button class="opcion" :class="respuestas.diez == '10a' ? 'checked' : ''" @click="respuestas.diez = '10a', actualizarActividad()">
                            A. Te imaginaste un mapa de tu ciudad.
                        </button>
                        <button class="opcion" :class="respuestas.diez == '10b' ? 'checked' : ''" @click="respuestas.diez= '10b', actualizarActividad()">
                            B. Formaste una imagen mental del recorrido descripto.
                        </button>
                        <button class="opcion" :class="respuestas.diez == '10c' ? 'checked' : ''" @click="respuestas.diez= '10c', actualizarActividad()">
                            C. Contaste la cantidad de cuadras de todo el recorrido.
                        </button>
                        <button class="opcion" :class="respuestas.diez == '10d' ? 'checked' : ''" @click="respuestas.diez= '10d', actualizarActividad()">
                            D. Tuviste que memorizar todas las palabras del texto.
                        </button>

                    </p>
                        
                    <p>
                        <div class="d-flex justify-content-center mt-5">
                            <button class="btnTerminar" @click="terminar">TERMINAR</button>
                        </div>
                    </p>                
            
                
                </main>
            </div>

             <!-- START MODAL CREAR CONFIRMACION -->
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
                                <button type="button" class="botonCancelar" @click="modalConfirmacion = false">Cancelar</button>
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
            <!-- END MODAL CREAR USUARIO -->

        
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
        .opcion{
            width: 900px;
        }
        article{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .imagen{
            background-image: url("../img/imgArea9.png");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 100%;
            height: 200px;
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
                respuestas: {
                    uno: null,
                    dos: null,
                    tres: null,
                    cuatro: null,
                    cinco: null,
                    seis: null,
                    siete: null,
                    ocho: null,
                    nueve: null,
                    diez: null
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
                this.consultarActividad();
                // this.comenzarActividad();
            },
            methods:{
                comenzarActividad () {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("actividad", 6);
                    axios.post("../funciones/accionesActividades.php?accion=comenzarActividad", formdata)
                    .then(function(response){ 
                    }).catch( error => {
                    });
                },
                actualizarActividad () {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("actividad", 6);
                    formdata.append("respuestas", JSON.stringify(this.respuestas));
                    axios.post("../funciones/accionesActividades.php?accion=actualizarActividad", formdata)
                    .then(function(response){ 
                        if (response.data.mensaje== "USUARIO BLOQUEADO") {
                            window.location.href = '../menu.php';
                        }
                    }).catch( error => {
                        console.log("error");
                    });
                },
                consultarActividad () {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("actividad", 6);
                    axios.post("../funciones/accionesActividades.php?accion=consultarActividad", formdata)
                    .then(function(response){ 
                        if (response.data.error) {
                            window.location.href = '../menu.php'; 
                            // app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            let habilitado = response.data.resultado[0].habilitado6;
                            if (habilitado == 0) {
                                window.location.href = '../menu.php'; 
                            } else {
                                app.comenzarActividad();
                                if (response.data.resultado[0].resultado6 != "-") {
                                    let respuestas = JSON.parse(response.data.resultado[0].resultado6);
                                    if (respuestas != "-") {
                                        app.respuestas.uno = respuestas.uno;
                                        app.respuestas.dos = respuestas.dos;
                                        app.respuestas.tres = respuestas.tres;
                                        app.respuestas.cuatro = respuestas.cuatro;
                                        app.respuestas.cinco = respuestas.cinco;
                                        app.respuestas.seis = respuestas.seis;
                                        app.respuestas.siete = respuestas.siete;
                                        app.respuestas.ocho = respuestas.ocho;
                                        app.respuestas.nueve = respuestas.nueve;
                                        app.respuestas.diez = respuestas.diez;
                                    }
                                }
                            }
                        }
                    }).catch( error => {
                        window.location.href = '../menu.php'; 
                        // app.buscandoUsuarios = false;
                        app.mostrarToast("Error", "Hubo un error al recuperar la información. Actualice la página");
                    });
                },
                terminar() {
                    if (
                        this.respuestas.uno == null ||
                        this.respuestas.dos == null ||
                        this.respuestas.tres== null ||
                        this.respuestas.cuatro == null ||
                        this.respuestas.cinco == null ||
                        this.respuestas.seis == null ||
                        this.respuestas.siete == null ||
                        this.respuestas.ocho == null ||
                        this.respuestas.nueve == null ||
                        this.respuestas.diez == null
                    ) {
                        this.mostrarToast("Error", "Debe responder todas las preguntas para terminar la actividad")
                    } else {
                        this.modalConfirmacion = true;
                    }
                },
                confirmar () {
                    this.terminando = true;
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("actividad", 6);
                    formdata.append("respuestas", JSON.stringify(this.respuestas));
                    axios.post("../funciones/accionesActividades.php?accion=terminarActividad", formdata)
                    .then(function(response){ 
                        if (response.data.mensaje == "OK") {
                            app.calcularCT();
                        } else {
                            app.terminando = false;
                            app.mostrarToast("ERROR", "Hubo un error al terminar la actividad. Intente nuevamente")
                        }
                    }).catch( error => {
                        app.terminando = true;
                        app.mostrarToast("ERROR", "Hubo un error al terminar la actividad. Intente nuevamente")
                    });
                },
                calcularCT() {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    axios.post("../funciones/accionesActividades.php?accion=calcularCT", formdata)
                    .then(function(response){ 
                        console.log(response.data);
                        if (response.data.mensaje == "OK") {
                            app.terminando = false
                            window.location.href = '../menu.php';
                        } else {
                            app.terminando = false;
                            app.mostrarToast("ERROR", "Hubo un error al terminar la actividad. Intente nuevamente")
                        }
                    }).catch( error => {
                        app.terminando = false
                        app.mostrarToast("ERROR", "Hubo un error al terminar la actividad. Intente nuevamente")
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