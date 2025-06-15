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
                    ÁREA 6: INFERENCIAS
                    <br>
                    Test Leer para Comprender II (TLC-II)
                </div>
            </div>
            <!-- END BREADCRUMB -->

            <div class="row justify-content-center">
                <main class="col-12 p-0">
                    <h5>Por favor leé atentamente y luego responde las consignas. Esta actividad es sin tiempo.</h5>
                    <br>
                    <p> 
                        <strong>
                            Leer la siguiente noticia. Las palabras en mayúsculas no existen.
                        </strong>    
                    </p>    
                    <h5>Mensaje de texto sin mirar el celular</h5>

                    <p>
                        <em>Expertos de Georgia presentarán una tecnología de fácil uso para aparatos de telefonía móvil,
                        basada en el sistema de escritura Braille, utilizado por los ciegos.</em>
                    </p>
                    <p>
                        Una nueva aplicación para enviar y recibir mensajes con dispositivos móviles de pantalla táctil
                        podría ser TAMIGADA tanto por personas no videntes como también por individuos sin problemas
                        de visión que quieran escribir textos sin necesidad de mirar la pantalla.
                    </p>
                    <p>
                        La moderna herramienta, diseñada e instrumentada por el Instituto de Tecnología de Gerogia,
                        estará disponible en las próximas semanas. Se espera que con ella, los invidentes sean capaces de
                        escribir textos seis veces más rápido que con los actuales métodos que existen a su disposición.
                        Los expertos HOFIDIERON que instrumentos actualmente utilizados por individuos que padecen
                        ceguera, como la tecnología de voz, son funcionales pero demasiado lentos para se efectivos. Los
                        mensajes convertidos en audio muchas veces no se entienden, y además preservan poco la
                        intimidad.
                    </p>   

                    <br>
                    <p>
                        <strong>
                            Responder las siguientes preguntas seleccionando la opción correcta.
                        </strong>
                    </p>



                    <p>
                        <strong>
                            1. “TAMIGADA” se puede reemplazar por:
                        </strong>
                        <br>
                        
                            <button class="opcion" :class="respuestas.uno == '1a' ? 'checked' : ''" @click="respuestas.uno = '1a', actualizarActividad()">
                                A. Protegida
                            </button>
                            <button class="opcion" :class="respuestas.uno == '1b' ? 'checked' : ''" @click="respuestas.uno= '1b', actualizarActividad()">
                                B. Adoptada
                            </button>
                            <button class="opcion" :class="respuestas.uno == '1c' ? 'checked' : ''" @click="respuestas.uno= '1c', actualizarActividad()">
                                C. Descartada
                            </button>
                            <button class="opcion" :class="respuestas.uno == '1d' ? 'checked' : ''" @click="respuestas.uno= '1d', actualizarActividad()">
                                D. Enviada
                            </button>
                    </p>
                    
                    <br>

                    <p>
                        <strong>
                            2. “HOFIDIERON” se puede reemplazar por:
                        </strong>
                        
                        <br>
                        <button class="opcion" :class="respuestas.dos == '2a' ? 'checked' : ''" @click="respuestas.dos = '2a', actualizarActividad()">
                            A. Negaron
                        </button>
                        <button class="opcion" :class="respuestas.dos == '2b' ? 'checked' : ''" @click="respuestas.dos= '2b', actualizarActividad()">
                            B. Impidieron
                        </button>
                        <button class="opcion" :class="respuestas.dos == '2c' ? 'checked' : ''" @click="respuestas.dos= '2c', actualizarActividad()">
                            C. Necesitaron
                        </button>
                        <button class="opcion" :class="respuestas.dos == '2d' ? 'checked' : ''" @click="respuestas.dos= '2d', actualizarActividad()">
                            D. Afirmaron
                        </button>                    
                    </p>

                    <br>
                    <hr>
                    <br>
                    <p>         
                        <strong>
                            Leer el siguiente fragmento del cuento “Los argentinos son todos iguales” de Sergio Olguín.
                        </strong>
                        <p>        
                            Él no era barrabrava. Se había pagado cada peso del viaje a Japón con el sudor de su frente.
                            Había seis meses que venía preparándose para acompañar a Boca a la Copa Mundial de Clubes.
                            Desde que Riquelme la había clavado en el arco del Gremio en Porto Alegre, se prometió que iba a 
                            ir a Tokio, a alentar a su equipo. Y en esos seis meses había ahorrado plata, y hasta había
                            retomado las clases de inglés abandonadas quince años antes.
                        </p>
                        <p>
                            En Tokio había descubierto algo maravilloso: había negocios de comida rápida como en Buenos
                            Aires. Pero caminó durante media hora sin encontrar un mísero McDonald´s. Cuando se dio
                            cuenta, estaba en una esquina de Tokio rodeado de carteles incomprensibles y de gente que
                            pasaba velozmente. No tenía idea de cómo volver hasta su hotel desde ahí. Estaba totalmente
                            perdido.
                        </p>
                        <p>
                            Empezó a sentirse mareado entre tantos japoneses. En realidad, era un solo japonés que se
                            repetía en todos los tamaños. Eran como clones idénticos más grandes o más chicos. Los
                            japoneses eran todos iguales, pero las japonesas no.
                        </p>
                        <p>
                            Estaba transpirado. Antes de ponerse a gritar, sintió que una chica japonese lo miraba fuerte. Él
                            se quedó como una estatua. No estaba acostumbrado a que una mujer lo mirase así, ni en Tokio ni
                            en Buenos Aires. Ella se acercó y le empezó a hablar en japonés. Se la veía alterada, sorprendida,
                            incluso feliz. La chica nipona repetía algo así como “yuar, yuar”. Hasta que él se dio cuenta: “you
                            are”.
                        </p>
                        <p>
                            -Vos sos… (le dijo ella en inglés) Diego Armando.
                            <br>
                            No dijo “Maradona”, dijo “Diego Armando”.
                            <br>
                            -Diego Armando Maradona -insistió ella y agregó-. Soy yo Diego, Harukichi, ¿te acordás de mí?
                            <br>    
                            Y ella lo abrazó tan fuerte que decidió ser el Diego de Harukichi.
                            <br>
                            Con el correr de las horas entendió la confusión. Al llegar a la casa de Harukichi corrió hacia él un
                            niño de seis años:  
                            <br>
                            -Es tu hijo- le dijo Harukichi en un inglés clarísimo-. Le puse como vos: Diego Armando.
                            <br>
                            Recién ahí descubrió que en las paredes había fotos de Harukichi con un tipo de rulos que no era
                            Maradona, y que tampoco era él. “Pobre Diego”, pensó imaginando los problemas del Diez cuando
                            Harukichi hiciera pública la paternidad de su hijo.
                        </p>

                        <p>
                            <strong>
                                Responder las siguientes preguntas seleccionando la opción correcta.
                            </strong>
                        </p>  

                        <br>
                        
                        <strong>
                            3. ¿Por qué el protagonista dice “era un solo japonés que se repetía en todos los tamaños”?
                        </strong>

                        <button class="opcion" :class="respuestas.tres == '3a' ? 'checked' : ''" @click="respuestas.tres = '3a', actualizarActividad()">
                            A. Porque no entendía el idioma que se hablaba.
                        </button>
                        <button class="opcion" :class="respuestas.tres == '3b' ? 'checked' : ''" @click="respuestas.tres = '3b', actualizarActividad()">
                            B. Porque estaba un poco mareado y hambriento.
                        </button>
                        <button class="opcion" :class="respuestas.tres == '3c' ? 'checked' : ''" @click="respuestas.tres = '3c', actualizarActividad()">
                            C. Porque piensa que todos los japoneses son iguales.
                        </button>
                        <button class="opcion" :class="respuestas.tres == '3d' ? 'checked' : ''" @click="respuestas.tres = '3d', actualizarActividad()">
                            D. Porque estaba viendo clones idénticos, más grandes o más chicos.
                        </button>
                        
                    </p>
                    
                    <br>
                   
                    <p>        
                        <strong>
                            4. Según el narrador, el protagonista no es barrabrava porque…
                        </strong>
                    </p>
                
                    <p>
                        <button class="opcion" :class="respuestas.cuatro == '4a' ? 'checked' : ''" @click="respuestas.cuatro = '4a', actualizarActividad()">
                            A. estudió inglés para poder viajar a Japón.
                        </button>
                        <button class="opcion" :class="respuestas.cuatro == '4b' ? 'checked' : ''" @click="respuestas.cuatro= '4b', actualizarActividad()">
                            B. decidió viajar a Japón a ver su equipo.
                        </button>
                        <button class="opcion" :class="respuestas.cuatro == '4c' ? 'checked' : ''" @click="respuestas.cuatro= '4c', actualizarActividad()">
                            C. no iba con el resto de la hinchada de Boca.
                        </button>
                        <button class="opcion" :class="respuestas.cuatro == '4d' ? 'checked' : ''" @click="respuestas.cuatro= '4d', actualizarActividad()">
                            D. viajó pagándose su pasaje con lo que ahorró.
                        </button>                        
                    </p>
                    
                    <br>
                        
                    <p>
                        <strong>
                            5. ¿Quién es el protagonista de este relato?
                        </strong>
                    </p>
                    <br>

    
                    <p>
                        <button class="opcion" :class="respuestas.cinco == '5a' ? 'checked' : ''" @click="respuestas.cinco = '5a', actualizarActividad()">
                            A. Diego Armando Maradona.
                        </button>
                        <button class="opcion" :class="respuestas.cinco == '5b' ? 'checked' : ''" @click="respuestas.cinco= '5b', actualizarActividad()">
                            B. Un jugador de fútbol.
                        </button>
                        <button class="opcion" :class="respuestas.cinco == '5c' ? 'checked' : ''" @click="respuestas.cinco= '5c', actualizarActividad()">
                            C. Un hincha de un club japonés.
                        </button>
                        <button class="opcion" :class="respuestas.cinco == '5d' ? 'checked' : ''" @click="respuestas.cinco= '5d', actualizarActividad()">
                            D. Un hincha de un club argentino.
                        </button>
                    </p>
                    
                    
                    <br>
                    
                    <p>
                        <strong>
                            6. ¿Por qué se confunde Harukichi?
                        </strong>

                        <br>
                        <button class="opcion" :class="respuestas.seis == '6a' ? 'checked' : ''" @click="respuestas.seis = '6a', actualizarActividad()">
                            A. Porque el protagonista también se llamada Diego Armando.
                        </button>
                        <button class="opcion" :class="respuestas.seis == '6b' ? 'checked' : ''" @click="respuestas.seis= '6b', actualizarActividad()">
                            B. Porque vio que el protagonista era un hombre cariñoso.
                        </button>
                        <button class="opcion" :class="respuestas.seis == '6c' ? 'checked' : ''" @click="respuestas.seis= '6c', actualizarActividad()">
                            C. Porque lo vio perdido por las calles de la ciudad.
                        </button>
                        <button class="opcion" :class="respuestas.seis == '6d' ? 'checked' : ''" @click="respuestas.seis= '6d', actualizarActividad()">
                            D. Porque para los japoneses todos los argentinos nos parecemos.
                        </button>
                    </p>
                    <br>
                    <hr>
                    <br>
                    <p>  
                        <strong>
                            Leer los siguientes mensajes de Twitter y responder las preguntas que les siguen seleccionando la
                            opción correcta.
                        </strong>
                    </p>
                    <p>
                        “Me ataca un tipo que se llama “Elio Izquierdo”. No lo ajusticio porque de eso ya se encargaron los
                        padres cuando le pusieron el nombre”.
                    </p>
                    <p>
                        <strong>
                            7. ¿Qué quiere decir el que escribe este tweet?
                        </strong>              

                        <br>
                        <button class="opcion" :class="respuestas.siete == '7a' ? 'checked' : ''" @click="respuestas.siete = '7a', actualizarActividad()">
                            A. Quiere denunciar a Elio Izquierdo por malos tratos.
                        </button>
                        <button class="opcion" :class="respuestas.siete == '7b' ? 'checked' : ''" @click="respuestas.siete= '7b', actualizarActividad()">
                            B. Quiere decir que los padres eligieron un buen nombre.
                        </button>
                        <button class="opcion" :class="respuestas.siete == '7c' ? 'checked' : ''" @click="respuestas.siete= '7c', actualizarActividad()">
                            C. Quiere decir que los padres eligieron un mal nombre.
                        </button>
                        <button class="opcion" :class="respuestas.siete == '7d' ? 'checked' : ''" @click="respuestas.siete= '7d', actualizarActividad()">
                            D. Quiere decir que Elio Izquierdo no debería atacar más.
                        </button>
                    </p>
                    <br>
                    <br>
                    <p>
                        “Yo no sé por qué el director de cámaras del partido en el que juega Ronaldinho a veces enfoca a
                        alguien que no es Ronaldinho.”
                    </p>
                    <p>
                        <strong>
                            8. ¿Qué quiere decir el que escribe este tweet?
                        </strong>
                        
                        <br>

                        <button class="opcion" :class="respuestas.ocho == '8a' ? 'checked' : ''" @click="respuestas.ocho = '8a', actualizarActividad()">
                            A. Que el director de cámaras marea enfocando a varios jugadores.
                        </button>
                        <button class="opcion" :class="respuestas.ocho == '8b' ? 'checked' : ''" @click="respuestas.ocho= '8b', actualizarActividad()">
                            B. Que Ronaldinho debería ser enfocado menos que el resto.
                        </button>
                        <button class="opcion" :class="respuestas.ocho == '8c' ? 'checked' : ''" @click="respuestas.ocho= '8c', actualizarActividad()">
                            C. Que Ronaldinho es el único buen jugador del partido.
                        </button>
                        <button class="opcion" :class="respuestas.ocho == '8d' ? 'checked' : ''" @click="respuestas.ocho= '8d', actualizarActividad()">
                            D. Que el director debería ser más justo y enfocar a todos por igual.
                        </button>
                    </p>
                    <br>    
                    <br>
                    <p>
                        “El Tribunal de Disciplina dispuso que Vélez-Peñarol se juegue sin público. Esto es ventaja
                        deportiva para Vélez que ya está acostumbrado.”
                    </p>
                    <p>
                        <strong>
                            9. ¿Qué quiere decir el que escribe este tweet?
                        </strong>

                        <br>
                        <button class="opcion" :class="respuestas.nueve == '9a' ? 'checked' : ''" @click="respuestas.nueve = '9a', actualizarActividad()">
                            A. Que el Tribunal de Disciplina castigará a Vélez.
                        </button>
                        <button class="opcion" :class="respuestas.nueve == '9b' ? 'checked' : ''" @click="respuestas.nueve= '9b', actualizarActividad()">
                            B. Que el Tribunal de Disciplina castigará a Peñarol.
                        </button>
                        <button class="opcion" :class="respuestas.nueve == '9c' ? 'checked' : ''" @click="respuestas.nueve= '9c', actualizarActividad()">
                            C. Que es difícil encontrar entradas para ver jugar a Vélez.
                        </button>
                        <button class="opcion" :class="respuestas.nueve == '9d' ? 'checked' : ''" @click="respuestas.nueve= '9d', actualizarActividad()">
                            D. Que a Vélez no lo va a ver nadie cuando juega.
                        </button>
                    </p>
                    <br>
                    <br>
                    <p>
                        “Boca aprovechó la expulsión de su propio defensor y se llevó la victoria.”
                    </p>
                    <p>
                        <strong>
                            10. ¿Qué quiere decir el que escribe este tweet?
                        </strong>

                        <br>
                        <button class="opcion" :class="respuestas.diez == '10a' ? 'checked' : ''" @click="respuestas.diez = '10a', actualizarActividad()">
                            A. Que el defensor estaba jugando muy mal.
                        </button>
                        <button class="opcion" :class="respuestas.diez == '10b' ? 'checked' : ''" @click="respuestas.diez= '10b', actualizarActividad()">
                            B. Que el defensor estaba jugando muy bien.
                        </button>
                        <button class="opcion" :class="respuestas.diez == '10c' ? 'checked' : ''" @click="respuestas.diez= '10c', actualizarActividad()">
                            C. Que gracias al defensor, Boca se llevó la victoria.
                        </button>
                        <button class="opcion" :class="respuestas.diez == '10d' ? 'checked' : ''" @click="respuestas.diez= '10d', actualizarActividad()">
                            D. Que el defensor convirtió el gol de la victoria.
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
                    formdata.append("actividad", 4);
                    axios.post("../funciones/accionesActividades.php?accion=comenzarActividad", formdata)
                    .then(function(response){ 
                    }).catch( error => {
                    });
                },
                consultarActividad () {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("actividad", 4);
                    axios.post("../funciones/accionesActividades.php?accion=consultarActividad", formdata)
                    .then(function(response){ 
                        if (response.data.error) {
                            window.location.href = '../menu.php'; 
                            // app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            let habilitado = response.data.resultado[0].habilitado4;
                            if (habilitado == 0) {
                                window.location.href = '../menu.php'; 
                            } else {
                                app.comenzarActividad();
                                if (response.data.resultado[0].resultado4 != "-") {
                                    let respuestas = JSON.parse(response.data.resultado[0].resultado4);
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
                        // app.mostrarToast("Error", "Hubo un error al recuperar la información. Actualice la página");
                    });
                },
                actualizarActividad () {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("actividad", 4);
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
                    this.terminando = false;
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("actividad", 4);
                    formdata.append("respuestas", JSON.stringify(this.respuestas));
                    axios.post("../funciones/accionesActividades.php?accion=terminarActividad", formdata)
                    .then(function(response){ 
                        app.terminando = false;
                        if (response.data.mensaje == "OK") {
                            window.location.href = '../menu.php';
                        } else {
                            app.mostrarToast("ERROR", "Hubo un error al terminar la actividad. Intente nuevamente")
                        }
                    }).catch( error => {
                        this.mostrarToast("ERROR", "Hubo un error al terminar la actividad. Intente nuevamente")
                        app.terminando = false;
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