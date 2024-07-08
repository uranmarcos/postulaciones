<?php
    require("../conexion/conexionUsuarios.php");
    $user = new ApptivaDB();

    $accion = "mostrar";
    $res = array("error" => false);
    
    if (isset($_GET["accion"])) {
        $accion = $_GET["accion"];
    }


    switch ($accion) {
        case 'contarUsuarios':
            $filtro = $_POST["filtro"];

            $u = $user -> contarUsuarios($filtro);
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

        case 'getUsuarios':
            $filtro = $_POST["filtro"];
            $inicio = $_POST["inicio"];
            $cantidad = $_POST["cantidad"];
           
         
            $u = $user -> consultarUsuarios($filtro, $inicio, $cantidad);

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

        case 'crearUsuario':

            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $dni = $_POST['dni'];
            $contrasenia = rand(10000000, 99999999);
            $rol = "postulante";
            $anio = date("Y");
            $provincia = $_POST["provincia"];
            $telefono = $_POST["telefono"];
            $asignado = $_POST['asignado'];
            $habilitado = 1;
            $null = null;
            $test = "-";

            // VALIDO QUE EL DNI NO ESTE CARGADO YA EN SISTEMA
            $dataValidar = " dni LIKE '$dni'"; 
            $validacion = $user -> hayRegistro($dataValidar);  
                    
            if ($validacion > 0) {
                $res["mensaje"] = "El dni ya se encuentra registrado";
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

            $data = "'" . $nombre . "', '" . $apellido . "', '" . $dni . "', '" . $contrasenia . "', '" . $null . "', '" . $rol .
             "', '" . $anio . "', '" . $provincia . "', '" . $telefono . "', '" . $asignado . "', '" . $null . "', '" . $test .
             "', '" . $test . "', '" . $habilitado . "'";
            
            $u = $user -> insertarUsuario($data);
        
            if ($u) {
                $res["error"] = false;
                $res["mensaje"] = "El usuario se creó correctamente. Se le asignó la contraseña " . $contrasenia;
                $user -> close();
            } else {
                $res["mensaje"] = "No se pudo crear el usuario. Intente nuevamente";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'editarUsuario':
            $null = null;
            $id = $_POST['id'];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $provincia = $_POST["provincia"];
            $telefono = $_POST["telefono"];

            $data = "nombre = '" . $nombre . "', apellido = '" . $apellido . "', telefono = '" . $telefono . "', provincia = '" . $provincia . "'";
            $u = $user -> editarUsuario($data, $id);  
        
            if ($u) {
                $res["error"] = false;
                $res["mensaje"] = "El usuario se editó correctamente.";
                $user -> close();
               
            } else {
                $res["mensaje"] = "No se pudo editar el usuario. Intente nuevamente";
                $res["error"] = true;
                $user -> close();
            } 

        break;


        case 'resetear':
            $id = $_POST["idUsuario"];

            $contrasenia = rand(10000000, 99999999);

            $u = $user -> resetear($id, $contrasenia);
            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "Se le asignó la contraseña " . $contrasenia;
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo resetear la contraseña";
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


        case 'getVoluntariosActivos':          
            
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

        case 'getAvance':          
            $id = $_POST["id"];
            $u = $user -> getAvance($id);

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

    }

    echo json_encode($res);
?>