<?php
    require("../conexion/usuarios.php");
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

        case 'buscarUsuarioPorNombre':
            $nombre = $_POST["nombre"];
                    
            $u = $user -> buscarUsuarioPorNombre($nombre);

            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["usuarios"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información";
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
            //$anio= 2024;
            $provincia = $_POST["provincia"];
            $telefono = $_POST["telefono"];
            $asignado = $_POST['asignado'];
            $habilitado = 1;
            $null = null;
            $test = "-";

            // VALIDO QUE EL DNI NO ESTE CARGADO YA EN SISTEMA
            $dataValidar = " dni LIKE '$dni'"; 
            $validacion = $user -> hayRegistro($dataValidar);        
            if ($validacion != []) {
                $res["mensaje"] = $validacion;
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

            $data["nombre"]     =   $nombre;
            $data["apellido"]   =   $apellido;
            $data["dni"]        =   $dni;
            $data["contrasenia"]        =   $contrasenia;
            $data["rol"]        =   $rol;
            $data["anio"]        =   $anio;
            $data["provincia"]        =   $provincia;
            $data["telefono"]        =   $telefono;
            $data["asignado"]        =   $asignado;
            $data["test"]        =   $test;
            $data["habilitado"]        =   $habilitado;

            // $data = "'" . $nombre . "', '" . $apellido . "', '" . $dni . "', '" . $contrasenia . "', '" . $null . "', '" . $rol .
            //  "', '" . $anio . "', '" . $provincia . "', '" . $telefono . "', '" . $asignado . "', '" . $null . "', '" . $test .
            //  "', '" . $test . "', '" . $habilitado . "', '" . $null . "'";
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

        case 'contarAsignables':
            $u = $user -> contarAsignables();
          
            if ($u || $u == []) { 
                $res["cantidad"] = $u[0]["cantidad"];
                $res["mensaje"] = "La consulta se realizó correctamente";
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Actualice la página";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        case 'asignarGrupo':
            //echo "entro";
            $cantidad = $_POST["cantidad"];
            $idVoluntario = $_POST["idVoluntario"];
            $anio = date("Y");

            $u = $user -> asignarGrupo($cantidad, $idVoluntario, $anio);
            //echo $u;
            if ($u) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "El grupo se asignó correctamente";
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo asignar el grupo";
                $res["error"] = true;
                $user -> close();
            } 

        break;



    }

    echo json_encode($res);
?>