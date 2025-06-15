<?php
class ApptivaDB {
    // private $host = "localhost";
    // private $usuario = "root";
    // private $clave = "";
    // private $db = "postulaciones";
    // public $conexion;

    private $host = "localhost";
    private $usuario = "postulaciones";
    private $clave = 'z$c6D4g07';
    private $db = "postulaciones";
    public $conexion;
    
    public function __construct(){
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave, $this->db)
        or die(mysql_error());
        $this->conexion->set_charset("utf8");
    }

    public function close() {
        $this->conexion->close();
    }

    // public function actualizarUsuario($nombre, $dni, $anio, $provincia, $telefono) {
    //     try {
    //         // $resultado = $this->conexion->query("UPDATE usuarios SET dni = '$dni', provincia = '$provincia', 
    //         // telefono = '$telefono' WHERE nombre = '$nombre' AND anio = '$anio'") or die();
    //         echo "UPDATE usuarios SET dni = '$dni', provincia = '$provincia', telefono = '$telefono' WHERE nombre = '$nombre' AND anio = '$anio'";
    //         return true;
    //     } catch (\Throwable $th) {
    //         return false;
    //     }
    // }

    public function buscarUsuario($dni) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM usuarios U
            WHERE U.dni LIKE '$dni%' ORDER BY U.dni") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getUsuarios() {
        try {
            $resultado = $this->conexion->query("SELECT u.id, u.raven, s.resultado1, u.dni FROM `usuarios` u
            INNER JOIN seguimiento s 
            ON u.id = s.idUsuario
            WHERE raven <> '-' AND anio = 2023") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
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

    public function habilitarTests($id, $observacion, $anio) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios U SET 
            U.raven = '-', U.ct = '-', anio = '$anio', asignado = 3180, habilitado = 1, observacion = '$observacion' WHERE U.id = '$id'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }

    }
    
    public function hayRegistro($dni) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM usuarios WHERE dni = '$dni'") or die();
            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            $numero = count($resultado);
            return $numero;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function cambiarDni($id, $dni) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios U SET 
            U.dni = '$dni' WHERE U.id = '$id'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }

    }

    public function eliminarUsuario($id) {
        try {
            $resultado = $this->conexion->query("DELETE FROM usuarios WHERE id = '$id'") or die();
            // echo "DELETE *  FROM usuarios WHERE id = 5000";
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function verRespuestas($id) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM `seguimiento` WHERE idUsuario = '$id'") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

 
}

?>