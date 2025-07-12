<?php
session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
    header("Pragma: no-cache");
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
    <link href="css/general.css" rel="stylesheet"> 
 
</head>
<body>
    <?php require("shared/header.php")?>
    <div id="app">
      
        <div class="contenedor">
             <!-- START BREADCRUMB -->
             <div class="col-12 p-0">
                <div class="breadcrumb">
                    <span class="pointer">Inicio</span>
                </div>
            </div>
            <!-- END BREADCRUMB -->
            <div class="row mt-6">
                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-3 px-0 d-flex justify-content-center">
                    <div class="opciones" @click="irA('usuarios')">
                    
                        POSTULANTES
        
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-3 px-0 d-flex justify-content-center">
                    <div class="opciones" @click="irA('asignados')">
                    
                        ASIGNADOS
        
                    </div>
                </div>
               
                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-3 px-0 d-flex justify-content-center">
                    <div class="opciones"  @click="irA('seguimiento')">
                        SEGUIMIENTO
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-3 px-0 d-flex justify-content-center">
                    <div class="opciones"  @click="irA('reuniones')">
                        REUNIONES
                    </div>
                </div>

                <!-- PARA ADMIN -->
                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-3 px-0 d-flex justify-content-center" v-if="rol == 'admin' || rol == 'general'">
                    <div class="opciones" @click="irA('avance')">
                    
                        AVANCE
        
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-3 px-0 d-flex justify-content-center" v-if="rol == 'admin' || rol == 'general'">
                    <div class="opciones" @click="irA('voluntarios')">
                    
                        VOLUNTARIOS
        
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-sm-12 my-2 my-md-3 px-0 d-flex justify-content-center" v-if="rol == 'admin'">
                    <div class="opciones" @click="irA('admin')">
                    
                        ADMIN
        
                    </div>
                </div>
                <!-- PARA ADMIN -->
            </div>
        </div>
    </div>
    <style scoped>
        

    .opciones{
        flex-direction: column;
        border: solid 1px rgb(124, 69, 153);
        border-radius: 10px;
        color: rgb(124, 69, 153);
        text-transform: uppercase;
        text-align: center;
        width: 95%;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .opciones:hover{
        cursor: pointer;
        background: rgb(124, 69, 153);
        color: white;
    }
            
    </style>

  
    <script>
        var app = new Vue({
            el: "#app",
            components: {
                
            },
            data: {
               rol: null
            },
            mounted () {
                this.rol = <?php echo json_encode($_SESSION["rol"]); ?>;
            },
            methods:{
                irA(param) {
                    switch (param) {
                        case "usuarios":
                            this.setPantalla("usuarios");     
                            window.location.href = 'usuarios.php';   
                            break;

                        case "admin":
                            this.setPantalla("admin");     
                            window.location.href = 'admin.php';   
                            break;
                    
                        case "avance":
                            this.setPantalla("avance");  
                            window.location.href = 'avance.php';        
                            break;

                        case "seguimiento":
                            this.setPantalla("seguimiento");  
                            window.location.href = 'seguimiento.php';        
                            break;
                        
                        case "voluntarios":
                            this.setPantalla("voluntarios");  
                            window.location.href = 'voluntarios.php';        
                            break;

                        case "reuniones":
                            this.setPantalla("reuniones");  
                            window.location.href = 'reuniones.php';        
                            break;

                        case "asignados":
                            this.setPantalla("asignados");  
                            window.location.href = 'asignados.php';         
                            break;
                        default:
                            break;
                    }
                },
                setPantalla (pantalla) {
                    localStorage.setItem("pantalla", pantalla)
                }
            }
        })
    </script>
</body>
</html>