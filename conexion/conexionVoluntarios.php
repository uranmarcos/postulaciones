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

    public function contarUsuarios() {
        try {
            $resultado = $this->conexion->query("SELECT COUNT(*) total FROM usuarios WHERE rol <> 'postulante'");
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function consultarUsuarios($inicio, $cantidad) {
        try {
            $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.mail, U.rol, U.habilitado 
                FROM usuarios U
                WHERE U.rol <> 'postulante'
                ORDER BY U.habilitado DESC, U.apellido
                LIMIT $cantidad OFFSET $inicio") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function habilitarUsuario($id) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios SET habilitado = 1 WHERE id = '$id'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function bloquearUsuario($id) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios SET habilitado = 0 WHERE id = '$id'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function buscarUsuario($dni) {
        try {
            $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.habilitado FROM usuarios U
            WHERE U.dni LIKE '$dni%' AND rol <> 'postulante' ORDER BY U.dni") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function hayRegistro($condicion) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM usuarios WHERE $condicion") or die();
            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            $numero = count($resultado);
            return $numero;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function insertarUsuario($datos) {
        try {
            $resultado = $this->conexion->query("INSERT INTO usuarios VALUES(null, $datos)") or die();
            return true;
        } catch (\Throwable $th) {
            // return $th;
            return $th;
        }
    }

    public function resetear($idUsuario, $contrasenia) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios SET pass = '$contrasenia' WHERE id = '$idUsuario'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function editarUsuario($data, $idUsuario) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios SET $data WHERE id = '$idUsuario'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

}

?>