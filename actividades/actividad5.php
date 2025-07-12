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
                    ÁREA 8: JERARQUÍA DEL TEXTO
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
                            Leer la siguiente historia
                        </strong>   
                    </p>    
                    <p>
                        Una mujer blanca de unos 50 años llegó al asiento que le tocaba 
                        en un avión que iba lleno de pasajeros e inmediatamente se negó 
                        a sentarse. Le tocaba sentarse al lado de un hombre de raza negra. 
                        Disgustada, la mujer inmediatamente llamó a la azafata y le pidió 
                        otro asiento. La mujer dijo “yo no puedo sentarme junto a un hombre 
                        negro.”
                    </p>
                    <p>
                        La azafata contestó: “Permítame ver su hay otro asiento disponible”. 
                        Después de chequear, regresó y le dijo a la mujer: “Señora, no hay otro
                        asiento disponible en clase económica, pero revisaré con el capitán para
                        verificar si existe algún asiento disponible en primera clase”.
                    </p>
                    <p>
                        Diez minutos después, la azafata regresó y dijo: “El capitán me ha 
                        confirmado que no hay asientos disponibles en clase económica pero 
                        hay uno en primera clase. No es nuestra costumbre cambiar a una 
                        persona de clase económica a primera clase, pero viendo que podría 
                        resultar en un escándalo forzar a alguien a sentarse junto a una 
                        persona que no le resulte agradable, el capitán estuvo de acuerdo 
                        en hacer el cambio”. 
                    </p>
                    <p>
                        Antes de que la mujer pudiera decir algo, la azafata se dirigió al 
                        hombre de raza negra y le dijo: “Señor, si fuera usted tan amable de 
                        tomar sus artículos personales, queremos moverlo a un asiento más 
                        confortable en primera clase ya que el capitán no quiere que usted 
                        esté sentado junto a una persona desagradable”.
                    </p>
                    <p>
                        Los pasajeros en los asientos cercanos comenzaron a aplaudir 
                        mientras algunos   ovacionaban de pie atinada reacción del 
                        capitán y la azafata. 
                    </p>
                  
                    <br>
                    <p>
                        <strong>
                            Responder las siguientes preguntas seleccionando la opción correcta.
                        </strong>
                    </p>



                    <p>
                        <strong>
                            1. ¿Cuál es el tema central de esta historia?
                        </strong>
                    
                        <br>
                        
                        <button class="opcion" :class="respuestas.uno == '1a' ? 'checked' : ''" @click="respuestas.uno = '1a', actualizarActividad()">
                            A. El problema de la discriminación.
                        </button>
                        <button class="opcion" :class="respuestas.uno == '1b' ? 'checked' : ''" @click="respuestas.uno= '1b', actualizarActividad()">
                            B. El problema de los asientos incómodos de los aviones.
                        </button>
                        <button class="opcion" :class="respuestas.uno == '1c' ? 'checked' : ''" @click="respuestas.uno= '1c', actualizarActividad()">
                            C. El problema de viajar en clase turista. 
                        </button>
                        <button class="opcion" :class="respuestas.uno == '1d' ? 'checked' : ''" @click="respuestas.uno= '1d', actualizarActividad()">
                            D. El problema de las políticas de las compañías aéreas.
                        </button>
                    </p>
                    
                    <br>

                    <p>
                        <strong>
                            2. ¿Por qué los pasajeros comenzaron a aplaudir?
                        </strong>
                        <br>
                        <button class="opcion" :class="respuestas.dos == '2a' ? 'checked' : ''" @click="respuestas.dos = '2a', actualizarActividad()">
                            A. Porque festejaban que se hubiera humillado a la mujer racista.
                        </button>
                        <button class="opcion" :class="respuestas.dos == '2b' ? 'checked' : ''" @click="respuestas.dos= '2b', actualizarActividad()">
                            B. Porque festejaban que a uno de los pasajeros lo pasaran a primera clase.
                        </button>
                        <button class="opcion" :class="respuestas.dos == '2c' ? 'checked' : ''" @click="respuestas.dos= '2c', actualizarActividad()">
                            C. Porque festejaban el chiste que hizo la mujer cuando subió.
                        </button>
                        <button class="opcion" :class="respuestas.dos == '2d' ? 'checked' : ''" @click="respuestas.dos= '2d', actualizarActividad()">
                            D. Porque festejaban que finalmente el avión iba a poder despegar.
                        </button>                    
                    </p>

                    <br>

                    <p>
                        <strong>
                            3. ¿Qué título le pondrías a esta historia?
                        </strong>
                        <br>

                        <button class="opcion" :class="respuestas.tres == '3a' ? 'checked' : ''" @click="respuestas.tres = '3a', actualizarActividad()">
                            A. El origen del racismo.
                        </button>
                        <button class="opcion" :class="respuestas.tres == '3b' ? 'checked' : ''" @click="respuestas.tres = '3b', actualizarActividad()">
                            B. Y se hizo justicia.
                        </button>
                        <button class="opcion" :class="respuestas.tres == '3c' ? 'checked' : ''" @click="respuestas.tres = '3c', actualizarActividad()">
                            C. La mujer que quería viajar en primera clase.
                        </button>
                        <button class="opcion" :class="respuestas.tres == '3d' ? 'checked' : ''" @click="respuestas.tres = '3d', actualizarActividad()">
                            D. Crónica de un aterrizaje forzoso.
                        </button>
                    </p>
                    
                    <br>
                    <hr>
                    <br>
                    <p>        
                        <strong>
                            Responder la siguiente pregunta seleccionando la opción correcta.
                            <br>
                            4. ¿En qué te hace pensar el título de un texto llamado “La muerte selectiva”?
                        </strong>
                        <br>

                        <button class="opcion" :class="respuestas.cuatro == '4a' ? 'checked' : ''" @click="respuestas.cuatro = '4a', actualizarActividad()">
                            A. En la muerte que afecta a un grupo en particular.
                        </button>
                        <button class="opcion" :class="respuestas.cuatro == '4b' ? 'checked' : ''" @click="respuestas.cuatro= '4b', actualizarActividad()">
                            B. En la muerte que afecta a algún órgano en particular.
                        </button>
                        <button class="opcion" :class="respuestas.cuatro == '4c' ? 'checked' : ''" @click="respuestas.cuatro= '4c', actualizarActividad()">
                            C. En una muerte intensa y dolorosa.
                        </button>
                        <button class="opcion" :class="respuestas.cuatro == '4d' ? 'checked' : ''" @click="respuestas.cuatro= '4d', actualizarActividad()">
                            D. En algo que parece una muerte pero que no lo es.
                        </button>                        
                    </p>
                    
                    <br>
                        
                     
                    <hr>
                    <p>
                        <strong>
                            Leer el siguiente fragmento de un texto de Marcelo Rodríguez:
                        </strong>
                    </p>
                    <p>
                        Para el fin del primer milenio, la viruela en Europa se 
                        consideraba una enfermedad que había que “tener de niño para 
                        engrosar la sangre”. Entre un 90 y un 95% de los chicos sobrevivían 
                        a ella y quedaban inmunes de por vida a la variola, que por entonces 
                        mostraba formas relativamente benignas en el Viejo Continente. 
                        O al menos “benignas” frente al cólera, y luego en el siglo XIV frente 
                        a la peste. Recién a finales del siglo XVI la viruela se iba a transformar 
                        en un problema mayor para los europeos, ante la aparición de brotes más 
                        virulentos, como sucedió en 154 en Nápoles o en 1570 en Venecia, donde un 
                        tercio de quienes se contagiaban de viruela morían.
                    </p>
                    <p>
                        Pero la historia de la muerte selectiva comienza antes. En 1519, 
                        una expedición al mando de Pánfilo de Narváez desembarca en Yucatán 
                        para obligar a regresar a la isla de Santo Domingo a Hernán Cortés, refugiado 
                        en el sur mexicano luego de su derrota a manos del ejército del emperador azteca 
                        Moctezuma. Entre los tripulantes no humanos del barco que venía a rescatar a 
                        Cortés estaba el variola virus, completamente desconocido en América.
                    </p>    
                    <p>
                        Los americanos no tenían defensas inmunológicas contra la viruela. 
                        Y en apenas un año, la enfermedad mató a más de la mitad de los habitantes 
                        del Imperio Azteca; así, cuando en 1521 Hernán Cortés regresó a Tenochtitlán, 
                        aniquiló a quienes poco más de un año antes lo habían dejado sólo con la décima 
                        parte de su ejército. Aquel 13 de agosto Cortés tomó la capital azteca, aliada 
                        con los toltecas, enemigos acérrimos de Moctezuma, pero también con la ayuda de 
                        ese aliado “no humano” que no podía ser pensado como otra cosa que no fuera un 
                        arma enviada por propio dios.
                    </p>    
                    <p>
                        En 1531, entre los crímenes de los conquistadores y los virus desconocidos, la 
                        población azteca se redujo veinticinco veces, según calcula Sheldon Watss en 
                        Epidemias y poder. La muerte era selectiva y la raza de los conquistadores gozaba 
                        de inmunidad.
                    </p>
                    <p>
                        <strong>
                            Responder las siguientes preguntas seleccionando la opción correcta.
                            <br>
                            5. De las siguientes frases, ¿cuál es la más importante para comprender el texto?
                        </strong>            

                        <button class="opcion" :class="respuestas.cinco == '5a' ? 'checked' : ''" @click="respuestas.cinco = '5a', actualizarActividad()">
                            A. Los habitantes de América no se encontraban inmunizados contra la viruela y esto ayudó a que Cortés derrotara al imperio azteza.
                        </button>
                        <button class="opcion" :class="respuestas.cinco == '5b' ? 'checked' : ''" @click="respuestas.cinco= '5b', actualizarActividad()">
                            B. La viruela en Europa se consideraba una enfermedad que había que “tener de niño para engrosar la sangre”.
                        </button>
                        <button class="opcion" :class="respuestas.cinco == '5c' ? 'checked' : ''" @click="respuestas.cinco= '5c', actualizarActividad()">
                            C. Entre un 90 y un 95% de los europeos que contrarían viruela de pequeños sobre vivían a ella  quedaban inmunizados de por vida.
                        </button>
                        <button class="opcion" :class="respuestas.cinco == '5d' ? 'checked' : ''" @click="respuestas.cinco= '5d', actualizarActividad()">
                            D. Panfilo de Nárvaez desembarca en América para obligar a Hernán Cortés a regresar a la isla de Santo Domingo.
                        </button>
                    </p>
                    
                    
                    <br>
                    

                    <p>
                         <strong>
                            6. ¿Qué otro título le pondrías al texto que leíste?
                        </strong>

                        <br>

                        <button class="opcion" :class="respuestas.seis == '6a' ? 'checked' : ''" @click="respuestas.seis = '6a', actualizarActividad()">
                            A. Estadio Azteca.
                        </button>
                        <button class="opcion" :class="respuestas.seis == '6b' ? 'checked' : ''" @click="respuestas.seis= '6b', actualizarActividad()">
                            B. El desembarco de Pánfilo de Narváez.
                        </button>
                        <button class="opcion" :class="respuestas.seis == '6c' ? 'checked' : ''" @click="respuestas.seis= '6c', actualizarActividad()">
                            C. El enemigo no humano de los aztecas.
                        </button>
                        <button class="opcion" :class="respuestas.seis == '6d' ? 'checked' : ''" @click="respuestas.seis= '6d', actualizarActividad()">
                            D. La viruela engrosa la sangre de los niños.
                        </button>
                    </p>
                    <br>
                    
                    <p>
                        <strong>
                            7. Según el autor, ¿cómo entró el virus en América?
                        </strong>
                        <br>
                        
                        <br>
                        <button class="opcion" :class="respuestas.siete == '7a' ? 'checked' : ''" @click="respuestas.siete = '7a', actualizarActividad()">
                            A. A través de los habitantes del Imperio Azteca.
                        </button>
                        <button class="opcion" :class="respuestas.siete == '7b' ? 'checked' : ''" @click="respuestas.siete= '7b', actualizarActividad()">
                            B. A través de los esclavos africanos que venían en los barcos de los españoles. 
                        </button>
                        <button class="opcion" :class="respuestas.siete == '7c' ? 'checked' : ''" @click="respuestas.siete= '7c', actualizarActividad()">
                            C. A través de la expedición de Hernán Cortés.
                        </button>
                        <button class="opcion" :class="respuestas.siete == '7d' ? 'checked' : ''" @click="respuestas.siete= '7d', actualizarActividad()">
                            D. A través de la expedición de Pánfilo de Nárvaez.
                        </button>
                    </p>
                    <br>
                    <hr>
                    <br>
                    <p>
                        <strong>
                            Leer los siguientes problemas y responder las preguntas seleccionando la opción correcta. No es necesario resolver los problemas.
                        </strong>
                    </p>
                    <p>
                        La última vez que Marcelo vio su primo Gastón fue en 1982 cuando éste tenía 5 años y 
                        Marcelo dos años más. Gastón se fue a vivir a Barcelona tres años después. Marcelo 
                        regresó a Buenos Aires en 2010 ¿Cuántos años tenía cada uno en ese momento?  
                        <br>
                        
                        <strong>
                            8- De las siguientes afirmaciones, ¿cuál contiene información que NO es necesaria para resolver el problema?
                        </strong>  

                        <br>

                        <button class="opcion" :class="respuestas.ocho == '8a' ? 'checked' : ''" @click="respuestas.ocho = '8a', actualizarActividad()">
                            A. La última vez que Gastón vio a Marcelo fue en 1982.
                        </button>
                        <button class="opcion" :class="respuestas.ocho == '8b' ? 'checked' : ''" @click="respuestas.ocho= '8b', actualizarActividad()">
                            B. Gastón se fue a vivir a Barcelona tres años después.
                        </button>
                        <button class="opcion" :class="respuestas.ocho == '8c' ? 'checked' : ''" @click="respuestas.ocho= '8c', actualizarActividad()">
                            C. Marcelo tenía dos años más que Gastón.
                        </button>
                        <button class="opcion" :class="respuestas.ocho == '8d' ? 'checked' : ''" @click="respuestas.ocho= '8d', actualizarActividad()">
                            D. Marcelo regresó a Buenos Aires en 2010.
                        </button>
                    </p>
                    <br>    
                    <br>
                    <br>
                    <p>
                        Un arquitecto está a cargo de la construcción de un edificio de 48 departamentos 
                        en Pedro Goyena al 3000. A los 3 dormitorios del departamento se les debe colocar 
                        el mismo piso cerámico de fabricación nacional. El living mide 3m x 8m, el balcón 
                        1m x 10m, 2 de los dormitorios son iguales y miden 3m x 3,2 m y el dormitorio 
                        principal 4m x 3,5m. Las cerámicas nacionales miden 0.4m x 0,4m. Si las cerámicas 
                        importadas vienen en cajas de 30 unidades y las nacionales en cajas de 20 unidades 
                        ¿cuántas cajas debe comprar?  
                        <br>
                        <strong>
                            9. ¿Cuál de las siguientes informaciones NO se necesita para resolver el problema?
                        </strong>  

                        <br>
                        <button class="opcion" :class="respuestas.nueve == '9a' ? 'checked' : ''" @click="respuestas.nueve = '9a', actualizarActividad()">
                            A. Las cerámicas miden 0,4m x 0,4m.
                        </button>
                        <button class="opcion" :class="respuestas.nueve == '9b' ? 'checked' : ''" @click="respuestas.nueve= '9b', actualizarActividad()">
                            B. Las cajas importadas traen 30 unidades.
                        </button>
                        <button class="opcion" :class="respuestas.nueve == '9c' ? 'checked' : ''" @click="respuestas.nueve= '9c', actualizarActividad()">
                            C. Dos dormitorios son iguales.
                        </button>
                        <button class="opcion" :class="respuestas.nueve == '9d' ? 'checked' : ''" @click="respuestas.nueve= '9d', actualizarActividad()">
                            D. Las cajas nacionales traen 20 unidades.
                        </button>
                    </p>
                    <br>
                    <br>
                    <p>
                        <strong>
                            10. ¿Cuál de estos copetes aparecido en el diario Página/12 de febrero de 2013 
                            podría tener el título “El día que cayó piedra sin llover”?
                        </strong>    
                        <br>

                        <br>
                        <button class="opcion" :class="respuestas.diez == '10a' ? 'checked' : ''" @click="respuestas.diez = '10a', actualizarActividad()">
                            A. En Cheliabinsk, en la región de los montes Urales, un meteorito que explotó antes de caer se estrelló en medio de la ciudad. Hubo explosiones estallaron los vidrios y varias paredes resultaron derribadas. Hay algunos heridos de gravedad.
                        </button>
                        <button class="opcion" :class="respuestas.diez == '10b' ? 'checked' : ''" @click="respuestas.diez= '10b', actualizarActividad()">
                            B. La pareja ya estaba en el ojo de la tormenta cuando ella anunció su casamiento. Ayer, aprovechando el día de San Valentín se casaron en Pico Truncado. Él, con permiso de la cárcel. Los esperaban manifestantes que arrojaron huevos a su paso.
                        </button>
                        <button class="opcion" :class="respuestas.diez == '10c' ? 'checked' : ''" @click="respuestas.diez= '10c', actualizarActividad()">
                            C. Según los medios estatales, la prueba fue subterránea con un artefacto “miniaturizado, más liviano y con una mayor fuerza explosiva”, y se llevó a cabo de manera segura y perfecta.
                        </button>
                        <button class="opcion" :class="respuestas.diez == '10d' ? 'checked' : ''" @click="respuestas.diez= '10d', actualizarActividad()">
                            D. Un muerto, cuatro heridos, zonas inundadas y graves daños dejó la violenta tormenta de la semana pasada. En Lugano, una familia fue herida cuando se voló el techo de un Jumbo, y muchos automóviles fueron destrozados. 
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
                document.addEventListener('contextmenu', function (e) {
                    e.preventDefault();
                });
            },
            methods:{
                comenzarActividad () {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("actividad", 5);
                    axios.post("../funciones/accionesActividades.php?accion=comenzarActividad", formdata)
                    .then(function(response){ 
                    }).catch( error => {
                    });
                },
                actualizarActividad () {
                    let formdata = new FormData();
                    formdata.append("id", this.idPostulante);
                    formdata.append("actividad", 5);
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
                    formdata.append("actividad", 5);
                    axios.post("../funciones/accionesActividades.php?accion=consultarActividad", formdata)
                    .then(function(response){ 
                        if (response.data.error) {
                            window.location.href = '../menu.php'; 
                            // app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            let habilitado = response.data.resultado[0].habilitado5;
                            if (habilitado == 0) {
                                window.location.href = '../menu.php'; 
                            } else {
                                app.comenzarActividad();
                                if (response.data.resultado[0].resultado5 != "-") {
                                    let respuestas = JSON.parse(response.data.resultado[0].resultado5);
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
                    formdata.append("actividad", 5);
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