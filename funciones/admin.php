<?php
    require("../conexion/admin.php");
    $user = new ApptivaDB();

    $accion = "mostrar";
    $res = array("error" => false);
    
    if (isset($_GET["accion"])) {
        $accion = $_GET["accion"];
    }

    $ravenCorrectas=[
        "1" => 4, 
        "2" => 5, 
        "3" => 1,
        "4" => 2,
        "5" => 6,
        "6" => 3,
        "7" => 6,
        "8" => 2,
        "9" => 1,
        "10" => 3,
        "11" => 5, 
        "12" => 4,    
        "13" => 2, 
        "14" => 6, 
        "15" => 1, 
        "16" => 2, 
        "17" => 1, 
        "18" => 3, 
        "19" => 5, 
        "20" => 6, 
        "21" => 4, 
        "22" => 3,     
        "23" => 4, 
        "24" => 5, 
        "25" => 8,
        "26" => 2,
        "27" => 3,
        "28" => 8,
        "29" => 7, 
        "30" => 4, 
        "31" => 5,
        "32" => 1,  
        "33" => 7,
        "34" => 6,
        "35" => 1,
        "36" => 2,
        "37" => 3,
        "38" => 4,
        "39" => 3,
        "40" => 7,
        "41" => 8,
        "42" => 6,    
        "43" => 5,
        "44" => 4,
        "45" => 1,
        "46" => 2,
        "47" => 5,
        "48" => 6,
        "49" => 7,
        "50" => 6,
        "51" => 8,
        "52" => 2,    
        "53" => 1,
        "54" => 5,
        "55" => 2,
        "56" => 4,
        "57" => 1,
        "58" => 6,
        "59" => 3,
        "60" => 5
    ];


    switch ($accion) {
        // case 'actualizarUsuario': 
        //     $nombre = $_POST["nombre"];
        //     $dni = $_POST['dni'];
        //     $anio = date("Y");
        //     $provincia = $_POST["provincia"];
        //     $telefono = $_POST["telefono"];

        //     echo $nombre;
        //     // echo "'update usuarios SET dni = ' . $dni . ', provincia = ' . $provincia . ', telefono = ' . $telefono . ' WHERE nombre = ' . $nombre . ' AND anio = ' . $anio .'";

        // break;

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

        case 'getUsuarios': 
            $u = $user -> getUsuarios();

            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["usuarios"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
                $res["error"] = true;
            } 

        break;

        case 'corregir': 
            $id = $_POST["id"];
            $usuarios = $_POST["usuario"];

            $array = json_decode($usuarios, true);
            $comparacionTest1 = array_intersect_assoc($ravenCorrectas, $array);
            $correctas = count($comparacionTest1);
            

            $us = $user -> guardarResultadoRaven($id, $correctas);
            if ($us || $us == []) { 
                $res["error"] = false;
                $res["correctas"] = $correctas;
            } else {
                $res["mensaje"] = "Hubo un error guardar la información. Intente nuevamente.";
                $res["error"] = true;
            } 
            $user -> close();

        break;

        case 'habilitarTests': 
            $id = $_POST["id"];
            $observacion = $_POST["observacion"];
            $anio = date("Y");

            $us = $user -> habilitarTests($id, $observacion, $anio);
            if ($us) { 
                $res["error"] = false;
                $res["mensaje"] = "OK";
            } else {
                $res["mensaje"] = "Hubo un error al habilitar el usuario";
                $res["error"] = true;
            } 
            $user -> close();

        break;

        case 'cambiarDni': 
            $id = $_POST["id"];
            $dni = $_POST["dni"];
           
            $validacion = $user -> hayRegistro($dni);  
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

            $us = $user -> cambiarDni($id, $dni);
            if ($us) { 
                $res["error"] = false;
                $res["mensaje"] = "OK";
            } else {
                $res["mensaje"] = "Hubo un error al cambiar el dni";
                $res["error"] = true;
            } 
            $user -> close();

        break;

        case 'eliminarUsuario': 
            $id = $_POST["id"];

            $us = $user -> eliminarUsuario($id);
            if ($us) { 
                $res["error"] = false;
                $res["mensaje"] = "OK";
            } else {
                $res["mensaje"] = "Hubo un error al habilitar el usuario";
                $res["error"] = true;
            } 
            $user -> close();

        break;

        case 'verRespuestas': 
            $id = $_POST["id"];

            $us = $user -> verRespuestas($id);
            if ($us) { 
                $res["respuestas"] = $us;
                $res["error"] = false;
                $res["mensaje"] = "OK";
            } else {
                $res["mensaje"] = "Hubo un error al consultar las respuestas";
                $res["error"] = true;
            } 
            $user -> close();

        break;
        
    }
    

    echo json_encode($res);
?>