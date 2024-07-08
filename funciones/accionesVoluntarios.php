<?php
    require("../conexion/conexionVoluntarios.php");
    $user = new ApptivaDB();

    $accion = "mostrar";
    $res = array("error" => false);
    
    if (isset($_GET["accion"])) {
        $accion = $_GET["accion"];
    }


    switch ($accion) {
        case 'contarUsuarios':
            $u = $user -> contarUsuarios();
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
            $inicio = $_POST["inicio"];
            $cantidad = $_POST["cantidad"];
           
         
            $u = $user -> consultarUsuarios($inicio, $cantidad);

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

        case 'habilitarUsuario':
            $id = $_POST["id"];

            $u = $user -> habilitarUsuario($id);
            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "El usuario se habilitó correctamente";
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo habilitar el usuario";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'bloquearUsuario':
            $id = $_POST["id"];

            $u = $user -> bloquearUsuario($id);
            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "El usuario se bloqueó correctamente";
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo bloquear el usuario";
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
                $user -> close();
            } else {
                $res["usuarios"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'crearVoluntario':

            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $dni = $_POST['dni'];
            $mail = $_POST['mail'];
            $contrasenia =  password_hash($dni, PASSWORD_DEFAULT);
            $rol = $_POST["apellido"];
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

            $dataValidar = " mail LIKE '$mail'"; 
            $validacion = $user -> hayRegistro($dataValidar);  
                
            if ($validacion > 0) {
                $res["mensaje"] = "El mail ya se encuentra registrado";
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

            $data = "'" . $nombre . "', '" . $apellido . "', '" . $dni . "', '" . $contrasenia . "', '" . $mail . "', '" . $rol .
             "', '" . $null . "', '" . $null . "', '" . $null . "', '" . $null . "', '" . $null . "', '" . $null .
             "', '" . $null . "', '" . $habilitado . "', '" . $null . "'";
            
            $u = $user -> insertarUsuario($data);
        
            if ($u) {
                $res["error"] = false;
                $res["mensaje"] = "El usuario se creó correctamente. Se le asignó su dni como contraseña";
                $user -> close();
            } else {
                $res["mensaje"] = "No se pudo crear el usuario. Intente nuevamente";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'resetear':
            $id = $_POST["idUsuario"];
            $dni = $_POST["dni"];

            $contrasenia =  password_hash($dni, PASSWORD_DEFAULT);

            $u = $user -> resetear($id, $contrasenia);
            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "Se le asignó la contraseña " . $dni;
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo resetear la contraseña";
                $res["error"] = true;
                $user -> close();
            } 
        break;

        case 'editarUsuario':
            $null = null;
            $id = $_POST['id'];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $mail = $_POST["mail"];
            $rol = $_POST["rol"];

            $data = "nombre = '" . $nombre . "', apellido = '" . $apellido . "', mail = '" . $mail . "', rol = '" . $rol . "'";
            $u = $user -> editarUsuario($data, $id);  
        
            if ($u) {
                $res["error"] = false;
                $res["mensaje"] = "El usuario se editó correctamente.";
               
            } else {
                $res["mensaje"] = "No se pudo editar el usuario. Intente nuevamente";
                $res["error"] = true;
            } 

        break;
    }

    echo json_encode($res);
?>