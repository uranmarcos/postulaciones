<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
header("Pragma: no-cache");
$nombre = strtoupper($_SESSION["name"]);
$rol = $_SESSION["rol"];

?>
<div class="header">
    <div>
        <img src="img/logohor.jpg" class="imgHeader" alt="logo">
    </div>

    <div class="avatar pointer dropdown">
        <div class="rowAvatar boton dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
            <div class="col-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                </svg>
            </div>
            <div class="col-8">
                <b>
                    <span id="spanNombre" class="nombre-usuario"></span>
                    <?php echo $nombre ?>
                    <br>
                    <?php echo $rol ?>
                </b>
                    
                <br>
                <span id="spanRol"></span>
            </div>
        </div> 
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" onclick="cerrarSesion()" href="#" @click="modalCreacion=true">Cerrar sesión</a></li> 
        </ul>
    </div>
</div>

<script>
    function cerrarSesion() {
        localStorage.removeItem("usuariosSeguimiento");
        window.location.href = 'funciones/cerrarSesion.php';   
    }
    function irA () {
        window.location.href = 'home.php';        
    }

</script>