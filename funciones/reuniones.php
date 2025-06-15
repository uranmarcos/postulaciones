<?php
    require("../conexion/reuniones.php");
    $user = new ApptivaDB();
    
    $accion = "mostrar";
    $res = array("error" => false);
    
    if (isset($_GET["accion"])) {
        $accion = $_GET["accion"];
    }

    switch ($accion) {

        case 'crearReunion': 
            $idUsuario = $_POST["idUsuario"];
            $fecha = $_POST["fecha"];
            $disponible = $_POST["disponible"];
            $capacidad = $_POST['capacidad'];

           
            $validacion = $user -> hayRegistro($idUsuario, $fecha);        
            if ($validacion > 0) {
                $res["mensaje"] = "Ya tiene una reunión programada en esa fecha";
                $res["error"] = true; 
                $user -> close();
                break;
            }
            if ($validacion === false) {
                $res["mensaje"] = "La creación no pudo realizarse";
                $res["error"] = true;
                $user -> close();
                break;
            }
            $data = "'" . $idUsuario . "', '" . $fecha . "', '" . $capacidad . "', '" . $disponible . "'";
            $u = $user -> crearReunion($data);
            if ($u) {
                $res["error"] = false;
                $res["mensaje"] = "La reunión se creó correctamente";
                $user -> close();
            } else {
                $res["mensaje"] = "No se pudo crear la reunión. Intente nuevamente";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'editarReunion': 
            $idUsuario = $_POST["idUsuario"];
            $id = $_POST["idReunion"];
            $fecha = $_POST["fecha"];
            $disponible = $_POST["disponible"];
            $capacidad = $_POST['capacidad'];

           
            $validacion = $user -> hayRegistroEdicion($idUsuario, $fecha, $id);        
            if ($validacion > 0) {
                $res["mensaje"] = "Ya tiene una reunión programada en esa fecha";
                $res["error"] = true; 
                $user -> close();
                break;
            }
            if ($validacion === false) {
                $res["mensaje"] = "La edición no pudo realizarse";
                $res["error"] = true;
                $user -> close();
                break;
            }
            $data = "'" . $idUsuario . "', '" . $fecha . "', '" . $capacidad . "', '" . $disponible . "'";
            $u = $user -> editarReunion($id, $fecha, $disponible, $capacidad);
            if ($u) {
                $res["error"] = false;
                $res["mensaje"] = "La reunión se modificó correctamente";
                $user -> close();
            } else {
                $res["mensaje"] = "No se pudo modificar la reunión. Intente nuevamente";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'getReuniones':          
            $u = $user -> getReuniones();

            if ($u || $u == []) { 
                $res["reuniones"] = $u;
                $user -> close();
            } else {
                $res["usuarios"] = [];
                $res["mensaje"] = "Hubo un error al recuperar la información.";
                $res["error"] = true;
                $user -> close();
            } 

        break;



        // case 'consultarVoluntarios':
        //     $u = $user -> consultarVoluntarios();

        //     if ($u || $u == []) { 
        //         $res["usuarios"] = $u;
        //         $res["mensaje"] = "La consulta se realizó correctamente";
        //         $user -> close();
        //     } else {
        //         $res["usuarios"] = $u;
        //         $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
        //         $res["error"] = true;
        //         $user -> close();
        //     } 

        // break;

        // case 'consultarDescarga':
        //     $estado = $_POST["estado"];
        //     $asignado = $_POST["asignado"];
            
        //     $u = $user -> consultarDescarga($estado, $asignado);

        //     if ($u || $u == []) { 
        //         $res["resultado"] = $u;
        //         $res["mensaje"] = "La consulta se realizó correctamente";
        //         $user -> close();
        //     } else {
        //         $res["mensaje"] = "Hubo un error al recuperar la información.";
        //         $res["error"] = true;
        //         $user -> close();
        //     } 

        // break;

        // case 'getResumen':          
        //     $u = $user -> getResumen();

        //     if ($u || $u == []) { 
        //         $res["resumen"] = $u;
        //         $res["mensaje"] = "La consulta se realizó correctamente";
        //         $user -> close();
        //     } else {
        //         $res["usuarios"] = [];
        //         $res["mensaje"] = "Hubo un error al recuperar la información.";
        //         $res["error"] = true;
        //         $user -> close();
        //     } 

        // break;
    }

    echo json_encode($res);
?>