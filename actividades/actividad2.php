<?php
    session_start();
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Pragma: no-cache");
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
                    ÁREA 2
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
                            Leer la siguiente historia contada por Adrían Paenza.<br>
                            Sobre monos y bananas
                        </strong>   
                    </p>    
                    <p>
                        Supongamos que tenemos seis monos en una pieza. Del cielo raso cuelga un racimo 
                        de bananas. Justo debajo de él hay una escalera (como la de un pintor o un 
                        carpintero). No hace falta mucho tiempo para que uno de los monos suba la escalera 
                        hacia las bananas. 
                    </p>
                    <p>
                        Y ahí comienza el experimento: en el mismo momento en que toca la escalera, 
                        todos los monos son rociados con agua helada. Naturalmente, eso detiene al mono.
                        Luego de un rato, el mismo mono o alguno de los otros hace otro intento con el 
                        mismo resultado: todos los monos son rociados con el agua helada a poco que uno 
                        de ellos toque la escalera. Cuando este proceso se repite un par de veces más, 
                        los monos ya están advertidos. Ni bien alguno de ellos quiere intentarlo, los 
                        otros tratan de evitarlo y terminan a los golpes si es necesario. 
                    </p>
                    <p>
                        Una vez que llegamos a este estadio, retiramos uno de los monos de la pieza y lo 
                        sustituimos por uno nuevo (que obviamente no participó del experimento hasta aquí). 
                        El nuevo mono ve las bananas e inmediatamente trata de subir por las escaleras. Para 
                        su horror, todos los otros monos lo atacan. Y obviamente se lo impiden. Luego de un 
                        par de intentos más, el nuevo mono ya aprendió: si intenta subir por las escaleras
                        lo van a golpear sin piedad.
                    </p>
                    <p>
                        Luego, se repite el procedimiento: se retira un segundo mono y se incluye uno 
                        nuevo otra vez. El recién llegado va hacia las escaleras y el proceso se repite: 
                        ni bien la toca (la escalera) es atacado masivamente. No solo eso: el mono que había 
                        entrado justo antes que él (¡que nunca había experimentado el agua helada!) 
                        participaba del episodio de violencia con gran entusiasmo.
                    </p>
                    <p>
                        Un tercer mono es reemplazado y ni bien intenta subir las escaleras, los otros cinco 
                        lo golpean. Con todo, dos de los monos no tienen ni idea de por qué uno no puede 
                        subir las escaleras. Se reemplaza un cuarto mono, luego un quinto y por último, 
                        el sexto que a esta altura es el único que quedaba del grupo original. Al sacar 
                        a este ya no queda ninguno que haya experimentado el episodio del agua helada. 
                        Sin embargo, una vez que el último lo intenta un par de veces y es golpeado 
                        furiosamente por los otros cinco, queda establecida la regla: no se puede subir 
                        las escaleras. Quien lo hace se expone a una represión brutal. Solo que ahora 
                        ninguno de los seis monos tiene argumentos para sostener esta barbarie.
                    </p> 

                    <br>
                    <p>
                        <strong>
                            Responder las siguientes preguntas seleccionando la opción correcta.
                        </strong>
                    </p>
                    <p>
                        <strong>
                            1. ¿Por qué al principio los investigadores mojan a todos los monos con agua helada y no solo el que sube?
                        </strong>
                        
                        <br>
                        <button class="opcion" :class="respuestas.uno == '1a' ? 'checked' : ''" @click="respuestas.uno = '1a', actualizarActividad()">
                            A. Porque los investigadores no identifican al que subió la escalera.
                        </button>
                        <button class="opcion" :class="respuestas.uno == '1b' ? 'checked' : ''" @click="respuestas.uno= '1b', actualizarActividad()">
                            B. Porque los investigadores quieren crear odio entre los monos.
                        </button>
                        <button class="opcion" :class="respuestas.uno == '1c' ? 'checked' : ''" @click="respuestas.uno= '1c', actualizarActividad()">
                            C. Porque los investigadores quieren estudiar una conducta colectiva.
                        </button>
                        <button class="opcion" :class="respuestas.uno == '1d' ? 'checked' : ''" @click="respuestas.uno= '1d', actualizarActividad()">
                            D. Porque todos los monos quieren subir al mismo tiempo la escalera.
                        </button>                    
                    </p>
                    
                    <br>

                    <p>
                        <strong>
                            2- ¿En qué orden ocurren los hechos del experimento inicial? Elegir una de las cuatro opciones posibles.
                        </strong>
                        <br>
                        <br>
                        <button class="opcion" :class="respuestas.dos == '2a' ? 'checked' : ''" @click="respuestas.dos = '2a', actualizarActividad()">
                            A. Los investigadores colocan un racimo de bananas en el techo - Los monos tocan la escalera -   Los monos se detienen - Los monos son rociados con agua helada.
                        </button>
                        <button class="opcion" :class="respuestas.dos == '2b' ? 'checked' : ''" @click="respuestas.dos= '2b', actualizarActividad()">
                            B. Los investigadores colocan un racimo de bananas en el techo- Los monos se detienen- Los monos tocan la escalera- Los monos son rociados con agua helada.
                        </button>
                        <button class="opcion" :class="respuestas.dos == '2c' ? 'checked' : ''" @click="respuestas.dos= '2c', actualizarActividad()">
                            C. Los monos son rociados con agua helada - Los investigadores colocan un racimo de bananas en el techo - Los monos tocan la escalera - Los monos se detienen.
                        </button>
                        <button class="opcion" :class="respuestas.dos == '2d' ? 'checked' : ''" @click="respuestas.dos= '2d', actualizarActividad()">
                            D. Los investigadores colocan un racimo de bananas en el techo - Los monos tocan la escalera - Los monos son rociados con agua helada - Los monos se detienen.
                        </button>            
                    </p>
                    <br>
                    <p>         
                        <strong>
                            3. ¿Por qué los monos comienzan a golpear a los que suben?  
                        </strong>                

                        <br>
                        
                        <button class="opcion" :class="respuestas.tres == '3a' ? 'checked' : ''" @click="respuestas.tres = '3a', actualizarActividad()">
                            A. Porque no quieren que los investigadores los mojen con agua helada.
                        </button>
                        <button class="opcion" :class="respuestas.tres == '3b' ? 'checked' : ''" @click="respuestas.tres = '3b', actualizarActividad()">
                            B. Porque no quieren perderse el juego.
                        </button>
                        <button class="opcion" :class="respuestas.tres == '3c' ? 'checked' : ''" @click="respuestas.tres = '3c', actualizarActividad()">
                            C. Porque creen que el que intenta subir les va a tirar agua helada.
                        </button>
                        <button class="opcion" :class="respuestas.tres == '3d' ? 'checked' : ''" @click="respuestas.tres = '3d', actualizarActividad()">
                            D. Porque el instinto hace que golpeen a los que están cerca.
                        </button>            
                    </p>
                    
                    <br>
                    
                    <p>        
                        <strong>
                            4. ¿Por qué los que no fueron mojados con agua helada golpean furiosamente igual?
                        </strong>
                        <br>
                        <br>
                        
                        <button class="opcion" :class="respuestas.cuatro == '4a' ? 'checked' : ''" @click="respuestas.cuatro = '4a', actualizarActividad()">
                            A. Porque quieren ser también mojados por los investigadores.
                        </button>
                        <button class="opcion" :class="respuestas.cuatro == '4b' ? 'checked' : ''" @click="respuestas.cuatro= '4b', actualizarActividad()">
                            B. Porque se dan cuenta de que si no pegan, no podrán subir las escaleras.
                        </button>
                        <button class="opcion" :class="respuestas.cuatro == '4c' ? 'checked' : ''" @click="respuestas.cuatro= '4c', actualizarActividad()">
                            C. Porque actúan por venganza, recordando situaciones previas.
                        </button>
                        <button class="opcion" :class="respuestas.cuatro == '4d' ? 'checked' : ''" @click="respuestas.cuatro= '4d', actualizarActividad()">
                            D. Porque actúan copiando la conducta de los otros.
                        </button>                    
                    </p>
                    
                    <br>
                    <hr>
                    <br>
                    <p>
                    <strong>
                        Leer las estrofas de la siguiente canción
                    </strong>
                    </p>
                    <p>
                        <article>
                            Amanece en la ruta, no me importa dónde estoy<br>
                            me he dormido viajando y he soñado tan intenso<br>
                            y en ese sueño yo me veía en ese auto, pero no <br>
                            no era el mismo porque estaba todo roto en su interior.<br>
                            <span>Amanece en la ruta, Suéter</span>
                        </article>
                    </p>
                        
                    <br>
                    <p>
                        <strong>
                            5- Indicar cuál de las siguientes secuencias presenta el orden cronológico en el que sucedieron los hechos.
                        </strong>
                        <br>
                        <br>
                        <button class="opcion" :class="respuestas.cinco == '5a' ? 'checked' : ''" @click="respuestas.cinco = '5a', actualizarActividad()">
                            A. Amaneció- el protagonista soñó- el protagonista se quedó dormido- el protagonista se puede ver en su sueño.
                        </button>
                        <button class="opcion" :class="respuestas.cinco == '5b' ? 'checked' : ''" @click="respuestas.cinco= '5b', actualizarActividad()">
                            B. El protagonista soñó- amaneció- el protagonista se quedó dormido- el protagonista se puede ver en su sueño.
                        </button>
                        <button class="opcion" :class="respuestas.cinco == '5c' ? 'checked' : ''" @click="respuestas.cinco= '5c', actualizarActividad()">
                            C. El protagonista se puede ver en su sueño- amaneció- el protagonista se quedó dormido- el protagonista soñó.
                        </button>
                        <button class="opcion" :class="respuestas.cinco == '5d' ? 'checked' : ''" @click="respuestas.cinco= '5d', actualizarActividad()">
                            D. El protagonista se quedó dormido- el protagonista soñó- el protagonista se puede ver en su sueño- amaneció.
                        </button>
                    </p>
                    
                    
                    <br>
                        
                    <hr>
                    <br>
                    <p>
                        <strong>
                            Leer atentamente el siguiente texto breve de Enrique Anderson Imbert.
                        </strong>
                        <br>
                        <br>
                            Un día de noviembre Armando iba al cementerio -precisamente para depositar 
                            unas flores en la tumba de Laura que se había muerto en julio- cuando el 
                            ómnibus en que viajaba, chocó contra otro. Uno de estos accidentes que ocurren
                            todos los días. Al bajar del ómnibus vio a Laura entre las personas que se 
                            aglomeraban atraídas por la sangre. Armando se acercó para hablarle pero ella
                            le hizo señas de que no lo hiciera y desapareció.
                        <br>
                            -¡Cómo es esto! ¡He visto viva a mi querida muerta! -empezó a pensar y entonces
                            fue cuando, en seco, Armando se dio cuenta. 
                    </p>
                    <p>
                        <br>
                        <strong>
                            Responder las siguientes preguntas seleccionando la opción correcta.
                            <br>
                            <br>
                            6. ¿Qué hizo Armando después de que chocaran los ómnibus?
                        </strong>
                        <br>
                    </p>
                    <p>
                        <button class="opcion" :class="respuestas.seis == '6a' ? 'checked' : ''" @click="respuestas.seis = '6a', actualizarActividad()">
                            A. Bajó e intentó hablarle a Laura.
                        </button>
                        <button class="opcion" :class="respuestas.seis == '6b' ? 'checked' : ''" @click="respuestas.seis= '6b', actualizarActividad()">
                            B. Bajó y siguió camino hacia el cementerio.
                        </button>
                        <button class="opcion" :class="respuestas.seis == '6c' ? 'checked' : ''" @click="respuestas.seis= '6c', actualizarActividad()">
                            C. Bajó y ayudó a quienes estaban ensangrentados.
                        </button>
                        <button class="opcion" :class="respuestas.seis == '6d' ? 'checked' : ''" @click="respuestas.seis= '6d', actualizarActividad()">
                            D. Bajó y depositó las flores en la tumba de Laura.
                        </button>
                    </p>
                    <br>
                    <p>
                        <strong>
                            7. ¿De qué se dio cuenta Armando cuando vio a su “querida muerta”?
                        </strong>
                        <br>
                        <br>
                        <button class="opcion" :class="respuestas.siete == '7a' ? 'checked' : ''" @click="respuestas.siete = '7a', actualizarActividad()">
                            A. Se asustó al ver a su fantasma.
                        </button>
                        <button class="opcion" :class="respuestas.siete == '7b' ? 'checked' : ''" @click="respuestas.siete= '7b', actualizarActividad()">
                            B. Se quedó aturdido mirando la gente del accidente.
                        </button>
                        <button class="opcion" :class="respuestas.siete == '7c' ? 'checked' : ''" @click="respuestas.siete= '7c', actualizarActividad()">
                            C. Se dio cuenta de que él estaba muerto.
                        </button>
                        <button class="opcion" :class="respuestas.siete == '7d' ? 'checked' : ''" @click="respuestas.siete= '7d', actualizarActividad()">
                            D. Se quedó pensando en su amada.
                        </button>
                    </p>
                    <br>
                    <p>
                        <strong>
                            8- ¿Por qué Laura habrá huido sin hablar con Armando?
                        </strong>
                        <br>
                        <br>
                        <button class="opcion" :class="respuestas.ocho == '8a' ? 'checked' : ''" @click="respuestas.ocho = '8a', actualizarActividad()">
                            A. Porque estaba enojada con él y no quería perdonarlo.
                        </button>
                        <button class="opcion" :class="respuestas.ocho == '8b' ? 'checked' : ''" @click="respuestas.ocho= '8b', actualizarActividad()">
                            B. Porque no quería que Armando estuviera muerto.
                        </button>
                        <button class="opcion" :class="respuestas.ocho == '8c' ? 'checked' : ''" @click="respuestas.ocho= '8c', actualizarActividad()">
                            C. Porque no lo pudo reconocer entre tanta gente.
                        </button>
                        <button class="opcion" :class="respuestas.ocho == '8d' ? 'checked' : ''" @click="respuestas.ocho= '8d', actualizarActividad()">
                            D. Porque iban a provocar otro accidente.
                        </button>
                    </p>
                    <br>    
                    
                
                        
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
        body {
            user-select: none;           /* Estándar */
            -webkit-user-select: none;   /* Safari */
            -moz-user-select: none;      /* Firefox */
            -ms-user-select: none;       /* IE/Edge */
        }
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
                    ocho: null
                },
                idPostulante: null,
                tituloToast: null,
                textoToast: null,
                rol: null,
                nombre: null,
                modalConfirmacion: false,
                terminando: false,
                habilitado: false,
            },
            mounted () {
                this.idPostulante = <?php echo json_encode($_SESSION["idUsuario"]); ?>;                
                this.consultarActividad();
                document.addEventListener('contextmenu', function (e) {
                    e.preventDefault();
                });
            },
            methods:{
                comenzarActividad () {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("actividad", 2);
                    axios.post("../funciones/accionesActividades.php?accion=comenzarActividad", formdata)
                    .then(function(response){ 
                    }).catch( error => {
                    });
                },
                consultarActividad () {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("actividad", 2);
                    axios.post("../funciones/accionesActividades.php?accion=consultarActividad", formdata)
                    .then(function(response){                     
                        if (response.data.error) {
                            // app.mostrarToast("Error", response.data.mensaje);
                            window.location.href = '../menu.php'; 
                        } else {
                            app.habilitado = response.data.resultado[0].habilitado2; 
                            if (app.habilitado == 0) {
                                window.location.href = '../menu.php'; 
                            } else {
                                app.comenzarActividad();
                                if (response.data.resultado[0].resultado2 != "-") {
                                    let respuestas = JSON.parse(response.data.resultado[0].resultado2);
                                    if (respuestas != "-") {
                                        app.respuestas.uno = respuestas.uno;
                                        app.respuestas.dos = respuestas.dos;
                                        app.respuestas.tres = respuestas.tres;
                                        app.respuestas.cuatro = respuestas.cuatro;
                                        app.respuestas.cinco = respuestas.cinco;
                                        app.respuestas.seis = respuestas.seis;
                                        app.respuestas.siete = respuestas.siete;
                                        app.respuestas.ocho = respuestas.ocho;
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
                    formdata.append("actividad", 2);
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
                        this.respuestas.ocho == null 
                    ) {
                        this.mostrarToast("Error", "Debe responder todas las preguntas para terminar la actividad")
                    } else {
                        this.modalConfirmacion = true;
                    }
                },
                confirmar () {
                    app.terminando = true;
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("actividad", 2);
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