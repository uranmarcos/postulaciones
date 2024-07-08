<?php
    require("../conexion/asignados.php");
    $user = new ApptivaDB();

    $accion = "mostrar";
    $res = array("error" => false);
    
    if (isset($_GET["accion"])) {
        $accion = $_GET["accion"];
    }


    switch ($accion) {
        case 'getTotalAsignados':
            $id = $_POST["id"];          
         
            $u = $user -> getTotalAsignados($id);

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

        case 'getPendientes':
            $id = $_POST["id"];          
         
            $u = $user -> getPendientes($id);

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

        case 'getAsignados':
            $filtro = $_POST["filtro"];
            $inicio = $_POST["inicio"];
            $cantidad = $_POST["cantidad"];
           
         
            $u = $user -> consultarAsignados($filtro, $inicio, $cantidad);

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

        case 'getVoluntarios':
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

        case 'buscarUsuario':
            $dniBusqueda = $_POST["dniBusqueda"];
                    
            $u = $user -> buscarUsuario($dniBusqueda);

            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["usuarios"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
                $res["error"] = true;
            } 

        break;

        case 'contarAsignados':
            $filtro = $_POST["filtro"];

            $u = $user -> contarAsignados($filtro);
            if ($u || $u == []) { 
                $res["cantidad"] = $u[0]["total"];
                $res["mensaje"] = "La consulta se realizó correctamente";
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Actualice la página";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'asignarUsuario':
            $idUsuario = $_POST["idUsuario"];
            $idVoluntario = $_POST["idVoluntario"];

            $u = $user -> asignarUsuario($idUsuario, $idVoluntario);
            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "El usuario se asignó correctamente";
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo asignar el usuario";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'crearSeguimiento':

            $idUsuario = $_POST["idUsuario"];

            // VALIDO QUE EL DNI NO ESTE CARGADO YA EN SISTEMA
            $dataValidar = " idUsuario LIKE '$idUsuario'"; 
            $estado = 0;
            // estado 0 -> "sin hacer"
            $habilitado = 1;
            $bloqueado = 0;
            $resultado = "-";
            $validacion = $user -> haySeguimiento($dataValidar);  
                    
            
            if ($validacion > 0) {
                $user -> close();
                break;
            }
            if ($validacion === false) {
                $res["mensaje"] = "El usuario no puedo cargarse al seguimiento. Intente nuevamente.";
                $res["error"] = true;
                $user -> close();
                break;
            }

            $data = "'" . $idUsuario . "', '" . $estado . "', '" . $habilitado . "', '" . $resultado . "', '" . 0 . "', '" . 2700 .
             "', '" . $estado . "', '" . $bloqueado . "', '" . $resultado . 
             "', '" . $estado . "', '" . $bloqueado . "', '" . $resultado . 
             "', '" . $estado . "', '" . $bloqueado . "', '" . $resultado . 
             "', '" . $estado . "', '" . $bloqueado . "', '" . $resultado . 
             "', '" . $estado . "', '" . $bloqueado . "', '" . $resultado . "'";
            $u = $user -> crearSeguimiento($data);
        
            if ($u) {
                $res["error"] = false;
                $user -> close();
            } else {
                $res["mensaje"] = "No se pudo cargar al usuario en el seguimiento. Intente nuevamente";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'getAvanceVoluntario':

            $idVoluntario = $_POST["idVoluntario"];
            $u = $user -> getAvanceVoluntario($idVoluntario);
        
            if ($u) {
                $res["error"] = false;
                $res["avance"] = $u;
                $user -> close();
            } else {
                $res["mensaje"] = "No se pudo recuperar la información";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'getEmpezados':
            $idVoluntario = $_POST["idVoluntario"];

            $u = $user -> getEmpezados($idVoluntario);
            if ($u || $u == []) { 
                $res["empezados"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información";
                $res["error"] = true;
                $user -> close();
            } 

        break;
    }

    echo json_encode($res);
?>