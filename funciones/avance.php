<?php
    require("../conexion/avance.php");
    $user = new ApptivaDB();
    
    $accion = "mostrar";
    $res = array("error" => false);
    
    if (isset($_GET["accion"])) {
        $accion = $_GET["accion"];
    }

    switch ($accion) {
        case 'consultarVoluntarios':
            $u = $user -> consultarVoluntarios();

            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
                $user -> close();
            } else {
                $res["usuarios"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'consultarDescarga':
            $estado = $_POST["estado"];
            $asignado = $_POST["asignado"];
            
            $u = $user -> consultarDescarga($estado, $asignado);

            if ($u || $u == []) { 
                $res["resultado"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
                $user -> close();
            } else {
                $res["mensaje"] = "Hubo un error al recuperar la información.";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'getResumen':          
            $u = $user -> getResumen();

            if ($u || $u == []) { 
                $res["resumen"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
                $user -> close();
            } else {
                $res["usuarios"] = [];
                $res["mensaje"] = "Hubo un error al recuperar la información.";
                $res["error"] = true;
                $user -> close();
            } 

        break;
    }

    echo json_encode($res);
?>