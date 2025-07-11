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

        case 'eliminarReunion': 
            $id = $_POST["idReunion"];    
            $u = $user -> eliminarReunion($id);
            if ($u) {
                $res["error"] = false;
                $res["mensaje"] = "La reunión se eliminó correctamente";
                $user -> close();
            } else {
                $res["mensaje"] = "No se pudo eliminar la reunión. Intente nuevamente";
                $res["error"] = true;
                $user -> close();
            } 
        break;

         case 'actualizarTelefono': 
            $idUsuario = $_POST["idUsuario"];
            $telefono = $_POST["telefono"];
               
            $u = $user -> actualizarTelefono($idUsuario, $telefono);
            if ($u) {
                $res["error"] = false;
                $_SESSION["telefono"] = $telefono;
                $res["mensaje"] = "El teléfono se actualizó correctamente";
                $user -> close();
            } else {
                $res["mensaje"] = "No se pudo actualizar el teléfono. Intente nuevamente";
                $res["error"] = true;
                $user -> close();
            } 

        break;


        
    }

    echo json_encode($res);
?>