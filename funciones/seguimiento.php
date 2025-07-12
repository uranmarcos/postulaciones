<?php
    require("../conexion/seguimiento.php");
    $user = new ApptivaDB();

    $accion = "mostrar";
    $res = array("error" => false);
    
    if (isset($_GET["accion"])) {
        $accion = $_GET["accion"];
    }


    switch ($accion) {
        case 'buscarUsuarioParaSeguimiento':
            $dniBusqueda = $_POST["dniBusqueda"];
                    
            $u = $user -> buscarUsuarioParaSeguimiento($dniBusqueda);

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

        case 'getSeguimiento':
            $ids = $_POST["ids"];
            $u = $user -> getSeguimiento($ids);
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

        case 'getEstadoPostulante':
            $id = $_POST["idUsuario"];
           
            $u = $user -> getEstadoPostulante($id);
            if ($u || $u == []) { 
                $res["estado"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";

                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Actualice la página";
                $res["error"] = true;
                $user -> close();
            } 
        break;

        case 'estaHabilitado':
            $id = $_POST["idUsuario"];
            $u = $user -> estaHabilitado($id);
            if ($u || $u == []) { 
                $res["estado"] = $u[0]["habilitado"];
                $res["mensaje"] = "La consulta se realizó correctamente";

                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Actualice la página";
                $res["error"] = true;
                $user -> close();
            } 
        break;

        case 'actualizarHabilitadoGrupo':
            $ids = $_POST["ids"];
            $estado = $_POST["estado"];
        
           
            $u = $user -> actualizarHabilitadoGrupo($ids, $estado);

            if ($u) { 
                $res["error"] = false;
                $res["mensaje"] = $u;
                $user -> close();
            } else {                
                $res["mensaje"] = "Error al actualizar. Verifique los usuarios";
                $res["error"] = true;
                $user -> close();
            } 
        break;

        case 'terminarSeguimiento':
            $id = $_POST["id"];
            $u = $user -> terminarSeguimiento($id);

            if ($u) { 
                $res["error"] = false;
                $res["mensaje"] = "OK";
                $user -> close();
            } else {                
                $res["mensaje"] = "Error al terminar el seguimiento";
                $res["error"] = true;
                $user -> close();
            } 
        break;
    
    }


    echo json_encode($res);
?>