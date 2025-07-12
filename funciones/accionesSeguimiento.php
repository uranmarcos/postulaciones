<?php
session_start();
    require("../conexion/conexionSeguimiento.php");
    $user = new ApptivaDB();

    $accion = "mostrar";
    $res = array("error" => false);
    
    if (isset($_GET["accion"])) {
        $accion = $_GET["accion"];
    }


    switch ($accion) {

        case 'getEstadoPostulante':
            $id = $_POST["idUsuario"];
           
            $u = $user -> getEstadoPostulante($id);
            if ($u || $u == []) { 
                $res["estado"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";

                $user -> close();
                $u = $user->getEstadoPostulante($id);

                // Verificar si la operación falló
                // if ($u === false) {
                //     echo "La conexión se cerró correctamente.";
                // } else {
                //     echo "La conexión sigue abierta.";
                // }
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Actualice la página";
                $res["error"] = true;
                $user -> close();
            } 
        break;

        case 'buscarUsuarioParaSeguimiento':
            $dniBusqueda = $_POST["dniBusqueda"];
                    
            $u = $user -> buscarUsuarioParaSeguimiento($dniBusqueda);

            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["usuarios"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
                $res["error"] = true;
            } 

        break;











        // NO REVISADAS
        case 'getUsuarioSeguimiento':
            $id = $_POST["idUsuario"];

            $u = $user -> getUsuarioSeguimiento($id);
            if ($u || $u == []) { 
                $res["usuario"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Actualice la página";
                $res["error"] = true;
                $user -> close();
            } 
        break;

        case 'actualizarTest':
            $id = $_POST["id"];
            $actividad = $_POST["actividad"];
            $estado = $_POST["estado"];

            $u = $user -> actualizarTest($id, $actividad, $estado);
            if ($u || $u == []) { 
                $res["error"] = false;
                if ($estado == '0') {
                    $res["mensaje"] = "La actividad se bloqueó correctamente";
                } 
                if ($estado == '1') {
                    $res["mensaje"] = "La actividad se habilitó correctamente";
                } 
                $user -> close();
            } else {
                if ($estado == '0') {
                    $res["mensaje"] = "La actividad no se pudo bloquear";
                } 
                if ($estado == '1') {
                    $res["mensaje"] = "La actividad no se pudo habilitar";
                } 
                $res["error"] = true;
                $user -> close();
            } 
        break;
        case 'asignarTiempo':
            $id = $_POST["id"];
            $tiempo = $_POST["tiempo"];

            $u = $user -> asignarTiempo($id, $tiempo);
            if ($u || $u == []) { 
                $res["error"] = false;
                $res["mensaje"] = "OK";
                $user -> close();
               
            } else {
                $res["mensaje"] = "No se pudo asignar tiempo. Intente nuevamente";
                $res["error"] = true;
                $user -> close();
            } 
        break;
        case 'getAsignadosSeguimiento':
            $id = $_POST["id"];          
         
            $u = $user -> getAsignados($id);

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
        case 'observar':
            $id = $_POST["idUsuario"];
            $observacion = $_POST["observacion"];

            $u = $user -> observar($id, $observacion);
            if ($u || $u == []) { 
                $res["error"] = false;
                $res["mensaje"] = "Se agregó la observación";
                $user -> close();
            } else {
                $res["mensaje"] = "No se agregar la observación";
                $res["error"] = true;
                $user -> close();
            } 
        break;
    }

    echo json_encode($res);
?>