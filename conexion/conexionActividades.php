<?php
class ApptivaDB {
    private $host = "localhost";
    private $usuario = "root";
    private $clave = "";
    private $db = "postulaciones";
    public $conexion;

    // private $host = "localhost";
    // private $usuario = "postulaciones";
    // private $clave = 'z$c6D4g07';
    // private $db = "postulaciones";
    // public $conexion;
    
    public function __construct(){
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave, $this->db)
        or die(mysql_error());
        $this->conexion->set_charset("utf8");
    }
    public function close() {
        $this->conexion->close();
    }
    public function consultarRaven($id) {
        try {
            $resultado = $this->conexion->query("SELECT S.estado1, S.habilitado1, S.resultado1, tiempo, nivel 
                FROM seguimiento S WHERE S.idUsuario = '$id'") or die();

            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function actualizarRaven($id, $respuestas, $nivel, $tiempo) {
        try {
            $resultado = $this->conexion->query("UPDATE seguimiento S SET S.resultado1 = '$respuestas', S.estado1 = 1, 
                S.tiempo = '$tiempo', S.nivel = '$nivel' WHERE S.idUsuario = '$id'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function consultarActividad($id, $actividad) {
        try {
            if ($actividad == 2) {
                $resultado = $this->conexion->query("SELECT S.estado2, S.habilitado2, S.resultado2 
                FROM seguimiento S WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 3) {
                $resultado = $this->conexion->query("SELECT S.estado3, S.habilitado3, S.resultado3 
                FROM seguimiento S WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 4) {
                $resultado = $this->conexion->query("SELECT S.estado4, S.habilitado4, S.resultado4 
                FROM seguimiento S WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 5) {
                $resultado = $this->conexion->query("SELECT S.estado5, S.habilitado5, S.resultado5 
                FROM seguimiento S WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 6) {
                $resultado = $this->conexion->query("SELECT S.estado6, S.habilitado6, S.resultado6 
                FROM seguimiento S WHERE S.idUsuario = '$id'") or die();
            }
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function comenzarActividad($id, $actividad) {
        try {
            if ($actividad == 2) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.estado2 = 1 WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 3) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.estado3 = 1 WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 4) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.estado4 = 1 WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 5) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.estado5 = 1 WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 6) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.estado6 = 1 WHERE S.idUsuario = '$id'") or die();
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function actualizarActividad($id, $actividad, $respuestas) {
        try {
            if ($actividad == 1) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.resultado1 = '$respuestas',  S.estado1 = 1 
                WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 2) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.resultado2 = '$respuestas', S.estado2 = 1  
                WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 3) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.resultado3 = '$respuestas', S.estado3 = 1  
                WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 4) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.resultado4 = '$respuestas', S.estado4 = 1 
                WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 5) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.resultado5 = '$respuestas', S.estado5 = 1 
                WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 6) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.resultado6 = '$respuestas', S.estado6 = 1  
                WHERE S.idUsuario = '$id'") or die();
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    // public function estaHabilitado($id, $actividad) {
    //     try {
    //         if ($actividad == 1) {
    //             $resultado = $this->conexion->query("SELECT habilitado1 AS 'habilitado' FROM seguimiento WHERE idUsuario = '$id'") or die();
    //         }
    //         if ($actividad == 2) {
    //             $resultado = $this->conexion->query("SELECT habilitado2 AS 'habilitado' FROM seguimiento WHERE idUsuario = '$id'") or die();
    //         }
    //         if ($actividad == 3) {
    //             $resultado = $this->conexion->query("SELECT habilitado3 AS 'habilitado' FROM seguimiento WHERE idUsuario = '$id'") or die();
    //         }
    //         if ($actividad == 4) {
    //             $resultado = $this->conexion->query("SELECT habilitado4 AS 'habilitado' FROM seguimiento WHERE idUsuario = '$id'") or die();
    //         }
    //         if ($actividad == 5) {
    //             $resultado = $this->conexion->query("SELECT habilitado5 AS 'habilitado' FROM seguimiento WHERE idUsuario = '$id'") or die();
    //         }
    //         if ($actividad == 6) {
    //             $resultado = $this->conexion->query("SELECT habilitado6 AS 'habilitado' FROM seguimiento WHERE idUsuario = '$id'") or die();
    //         }
    //         return $resultado->fetch_all(MYSQLI_ASSOC);
    //     } catch (\Throwable $th) {
    //         return false;
    //     }
    // }
    public function estaHabilitado($id, $actividad) {
        try {
            // Validar que la actividad sea entre 1 y 6
            if ($actividad < 1 || $actividad > 6) {
                return false;
            }

            // Nombre del campo dinámico
            $campo = "habilitado" . $actividad;

            // Armar query
            $query = "
                SELECT S.$campo AS seguimientoHabilitado, U.habilitado AS usuarioHabilitado
                FROM seguimiento S
                JOIN usuarios U ON S.idUsuario = U.id
                WHERE S.idUsuario = ?
            ";

            // Preparar y ejecutar consulta
            $stmt = $this->conexion->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($row = $resultado->fetch_assoc()) {
                // Verificamos si ambas condiciones son verdaderas
                if ($row['seguimientoHabilitado'] == 1 && $row['usuarioHabilitado'] == 2) {
                    return "OK";
                } 
                return "BLOQUEO";
            }

            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function terminarActividad($id, $actividad, $respuestas) {
        try {
            if ($actividad == 2) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.habilitado2 = 0, S.estado2 = 2, S.habilitado3 = 1, S.resultado2 = '$respuestas' 
                WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 3) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.habilitado3 = 0, S.estado3 = 2, S.habilitado4 = 1, S.resultado3 = '$respuestas' 
                WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 4) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.habilitado4 = 0, S.estado4 = 2, S.habilitado5 = 1, S.resultado4 = '$respuestas' 
                WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 5) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.habilitado5 = 0, S.estado5 = 2, S.habilitado6 = 1, S.resultado5 = '$respuestas' 
                WHERE S.idUsuario = '$id'") or die();
            }
            if ($actividad == 6) {
                $resultado = $this->conexion->query("UPDATE seguimiento S SET S.habilitado6 = 0, S.estado6 = 2, S.resultado6 = '$respuestas' 
                WHERE S.idUsuario = '$id'") or die();
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function calcularCT($id) {
        try {
            $resultado = $this->conexion->query("SELECT resultado2, resultado3, resultado4, resultado5, resultado6 FROM seguimiento S WHERE S.idUsuario = '$id'") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function guardarCT($id, $total) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios SET ct = '$total', fechaTerminado = NOW(), habilitado = 0 WHERE id = '$id'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    
























    public function terminarRaven($id, $respuestas, $nivel, $tiempo) {
        try {
            $resultado = $this->conexion->query("UPDATE seguimiento S SET S.resultado1 = '$respuestas', 
                S.tiempo = '$tiempo', S.nivel = '$nivel', S.habilitado1 = 0, S.habilitado2 = 1, S.estado1 = 2 WHERE S.idUsuario = '$id'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function guardarResultadoRaven($id, $correctas) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios U SET U.raven = '$correctas' WHERE U.id = '$id'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
   
}

?>