<?php
session_start();
    require("../conexion/conexion.php");
    $user = new ApptivaDB();

    $accion = "mostrar";
    $res = array("error" => false);
    $archivoPdf = null;
    
    if (isset($_GET["accion"])) {
        $accion = $_GET["accion"];
    }


    switch ($accion) {
        case 'login':
            $usuario    = $_POST["usuario"];
            $password   = $_POST["password"];       

            $u = $user -> login($usuario, $password); 
           
            if ($u || $u == []) { 
                if ( empty($u)) {
                    $res["u"] = $u;
                    $res["mensaje"] = "El usuario no se encuentra registrado.";
                    $res["error"] = true;
                } else {    
                    if ($u[0]["habilitado"] == 0) {
                        $res["u"] = $u;
                        $res["mensaje"] = "El usuario no se encuentra habilitado.";
                        $res["error"] = true;
                    } else {

                        if ($u[0]["rol"] == 'postulante' && $password != $u[0]["pass"]) {
                            
                            $res["mensaje"] = "Contraseña incorrecta";
                            $res["error"] = true;
                           
                        } else if ($u[0]["rol"] != 'postulante' && !password_verify($password, $u[0]["pass"])) {
                            $res["mensaje"] = "Contraseña incorrecta";
                            $res["error"] = true;
                        } else {
                            $res["u"] = $u[0]["rol"];
                            $res["mensaje"] = "OK";
                            $res["error"] = false;
                            $_SESSION["autenticado"] = "si";
                            $_SESSION["name"] = $u[0]["nombre"];
                            $_SESSION["rol"] = $u[0]["rol"];
                            $_SESSION["dni"] = $u[0]["dni"];
                            $_SESSION["idUsuario"] = $u[0]["id"];
                            $_SESSION["telefono"] = $u[0]["telefono"];
                        }
                    }
                }  
                $user -> close();
                //$u = $user->login($usuario, $password);

                // Verificar si la operación falló
                // if ($u === false) {
                //     echo "La conexión se cerró correctamente.";
                // } else {
                //     echo "La conexión sigue abierta.";
                // }
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error, intente nuevamente.";
                $res["error"] = true;
                $user -> close();
            } 

        break;

        default:
            # code...
            break;
    }


    echo json_encode($res);
?>