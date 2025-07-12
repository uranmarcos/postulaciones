<?php
session_start();
    require("../conexion/conexionActividades.php");
    $user = new ApptivaDB();

    $accion = "mostrar";
    $res = array("error" => false);

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
    $actividad2=[
        "uno"=>"1c",
        "dos"=>"2d",
        "tres"=>"3a",
        "cuatro"=>"4d",
        "cinco"=>"5d",
        "seis"=>"6a",
        "siete"=>"7c",
        "ocho"=>"8b"
    ];
    $actividad3=[
        "uno"=>"1a",
        "dos"=>"2b",
        "tres"=>"3a",
        "cuatro"=>"4c",
        "cinco"=>"5a",
        "seis"=>"6b",
        "siete"=>"7d",
        "ocho"=>"8c",
        "nueve"=>"9d",
        "diez"=>"10b"
    ];
    $actividad4=[
        "uno"=>"1b",
        "dos"=>"2d",
        "tres"=>"3c",
        "cuatro"=>"4d",
        "cinco"=>"5d",
        "seis"=>"6d",
        "siete"=>"7c",
        "ocho"=>"8c",
        "nueve"=>"9d",
        "diez"=>"10a"
    ];
    $actividad5=[
        "uno"=>"1a",
        "dos"=>"2a",
        "tres"=>"3b",
        "cuatro"=>"4a",
        "cinco"=>"5a",
        "seis"=>"6c",
        "siete"=>"7d",
        "ocho"=>"8b",
        "nueve"=>"9b",
        "diez"=>"10a"
    ];
    $actividad6=[
        "uno"=>"1a",
        "dos"=>"2a",
        "tres"=>"3d",
        "cuatro"=>"4d",
        "cinco"=>"5b",
        "seis"=>"6d",
        "siete"=>"7a",
        "ocho"=>"8d",
        "nueve"=>"9c",
        "diez"=>"10b"
    ];
    
    if (isset($_GET["accion"])) {
        $accion = $_GET["accion"];
    }


    switch ($accion) {

        case 'consultarRaven':
            $id = $_POST["id"];

            $u = $user -> consultarRaven($id);
            if ($u || $u == []) { 
                $res["resultado"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
                $user -> close();
                // $u = $user->consultarRaven($id);

                // //Verificar si la operación falló
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
        case 'actualizarRaven':
            $id = $_POST["id"];
            $actividad = 1;
            $respuestas = $_POST["respuestas"];
            $nivel = $_POST["nivel"];
            $tiempo = $_POST["tiempo"];

            $u = $user -> estaHabilitado($id, $actividad);
            if ($u) {
                // if ($u[0]["habilitado"] == 1) {
                //     $u = $user -> actualizarRaven($id, $respuestas, $nivel, $tiempo);
                //     if ($u || $u == []) { 
                //         $res["resultado"] = $u;
                //         $res["mensaje"] = "La consulta se realizó correctamente";
                //         $user -> close();
                //     } else {
                //         $res["u"] = $u;
                //         $res["mensaje"] = "Hubo un error al recuperar la información. Actualice la página";
                //         $res["error"] = true;
                //         $user -> close();
                //     } 
                // } else {
                //     $res["mensaje"] = "USUARIO BLOQUEADO";
                //     $res["error"] = false;
                //     $user -> close();
                // }
                if ($u == "OK") {
                    $u = $user -> actualizarRaven($id, $respuestas, $nivel, $tiempo);
                    // $u = $user -> actualizarActividad($id, $actividad, $respuestas);
                    if ($u || $u == []) { 
                        $res["resultado"] = $u;
                        $res["mensaje"] = "OK";
                        $user -> close();
                    } else {
                        $res["u"] = $u;
                        $res["mensaje"] = "Hubo un error al actualizar la información";
                        $res["error"] = true;
                        $user -> close();
                    } 
                } else {
                    $res["mensaje"] = "USUARIO BLOQUEADO";
                    $res["error"] = false;
                    $user -> close();
                }
            }
        break;
        case 'consultarActividad':
            $id = $_POST["id"];
            $actividad = $_POST["actividad"];

            $u = $user -> consultarActividad($id, $actividad);
            if ($u || $u == []) { 
                $res["resultado"] = $u;
                $res["mensaje"] = "OK";
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Actualice la página";
                $res["error"] = true;
                $user -> close();
            } 
        break;
        case 'comenzarActividad':
            $id = $_POST["id"];
            $actividad = $_POST["actividad"];

            $u = $user -> comenzarActividad($id, $actividad);
            if ($u || $u == []) { 
                $res["resultado"] = $u;
                $res["mensaje"] = "OK";
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Actualice la página";
                $res["error"] = true;
                $user -> close();
            } 
        break;
        case 'actualizarActividad':
            $id = $_POST["id"];
            $actividad = $_POST["actividad"];
            $respuestas = $_POST["respuestas"];

            $u = $user -> estaHabilitado($id, $actividad);
            if ($u) {
                // if ($u[0]["habilitado"] == 1) {
                //     $u = $user -> actualizarActividad($id, $actividad, $respuestas);
                //     if ($u || $u == []) { 
                //         $res["resultado"] = $u;
                //         $res["mensaje"] = "OK";
                //         $user -> close();
                //     } else {
                //         $res["u"] = $u;
                //         $res["mensaje"] = "Hubo un error al actualizar la información";
                //         $res["error"] = true;
                //         $user -> close();
                //     } 
                // } else {
                //     $res["mensaje"] = "USUARIO BLOQUEADO";
                //     $res["error"] = false;
                //     $user -> close();
                // }
                if ($u == "OK") {
                    $u = $user -> actualizarActividad($id, $actividad, $respuestas);
                    if ($u || $u == []) { 
                        $res["resultado"] = $u;
                        $res["mensaje"] = "OK";
                        $user -> close();
                    } else {
                        $res["u"] = $u;
                        $res["mensaje"] = "Hubo un error al actualizar la información";
                        $res["error"] = true;
                        $user -> close();
                    } 
                } else {
                    $res["mensaje"] = "USUARIO BLOQUEADO";
                    $res["error"] = false;
                    $user -> close();
                }
            } else {
                $res["mensaje"] = "Hubo un error al actualizar la información";
                $user -> close();
            }
        break;
        case 'terminarActividad':
            $id = $_POST["id"];
            $actividad = $_POST["actividad"];
            $respuestas = $_POST["respuestas"];

            $u = $user -> terminarActividad($id, $actividad, $respuestas);
            if ($u || $u == []) { 
                $res["resultado"] = $u;
                $res["mensaje"] = "OK";
                $user -> close();
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al terminar la actividad. Intente nuevamente";
                $res["error"] = true;
                $user -> close();
            } 
        break;     
        case 'calcularCT':
            $id = $_POST["id"];
            $u = $user -> calcularCT($id);
            if ($u || $u != []) { 
                $area2 = json_decode($u[0]["resultado2"], true);
                $area3 = json_decode($u[0]["resultado3"], true);
                $area4 = json_decode($u[0]["resultado4"], true);
                $area5 = json_decode($u[0]["resultado5"], true);
                $area6 = json_decode($u[0]["resultado6"], true);
             
                $comparacionArea2 = array_intersect_assoc($area2, $actividad2);
                $correctasArea2 = count($comparacionArea2);

                $comparacionArea3 = array_intersect_assoc($area3, $actividad3);
                $correctasArea3 = count($comparacionArea3);

                $comparacionArea4 = array_intersect_assoc($area4, $actividad4);
                $correctasArea4 = count($comparacionArea4);

                $comparacionArea5 = array_intersect_assoc($area5, $actividad5);
                $correctasArea5 = count($comparacionArea5);

                $comparacionArea6 = array_intersect_assoc($area6, $actividad6);
                $correctasArea6 = count($comparacionArea6);

                $total = ($correctasArea2 + $correctasArea3 + $correctasArea4 + $correctasArea5 + $correctasArea6)/4.8;

                $u = $user -> guardarCT($id, $total);
                if ($u) { 
                    $res["resultado"] = $u;
                    $res["mensaje"] = "OK";
                    $user -> close();
                } else {
                    $res["u"] = $u;
                    $res["mensaje"] = "Hubo un error al terminar la actividad. Intente nuevamente";
                    $res["error"] = true;
                    $user -> close();
                }
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al terminar la actividad. Intente nuevamente";
                $res["error"] = true;
                $user -> close();
            } 
        break;

        










        



        //revisar cierre conexion
        case 'terminarRaven':
            $id = $_POST["id"];
            $respuestas = $_POST["respuestas"];
            $nivel = $_POST["nivel"];
            $tiempo = $_POST["tiempo"];

            $array = json_decode($respuestas, true);
            $comparacionTest1 = array_intersect_assoc($ravenCorrectas, $array);
            $correctas = count($comparacionTest1);

            $u = $user -> terminarRaven($id, $respuestas,$nivel, $tiempo, $correctas);
            if ($u || $u == []) { 
                $us = $user -> guardarResultadoRaven($id, $correctas);
                if ($us || $us == []) { 
                    $res["error"] = false;
                    $res["mensaje"] = "OK";
                } else {
                    $res["mensaje"] = "Hubo un error guardar la información. Intente nuevamente.";
                    $res["error"] = true;
                } 
                $user -> close();
            } else {
                $res["mensaje"] = "Hubo un error guardar la información. Intente nuevamente";
                $res["error"] = true;
                $user -> close();
            } 
        break;


        
    
    }

    echo json_encode($res);
?>