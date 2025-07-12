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

    public function hayRegistro($idUsuario, $fecha) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM reuniones WHERE idUsuario = '$idUsuario' AND
            fecha = '$fecha'") or die();
            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            $numero = count($resultado);
            return $numero;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function hayRegistroEdicion($idUsuario, $fecha, $id) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM reuniones WHERE idUsuario = '$idUsuario' AND
            fecha = '$fecha' AND id <> '$id'") or die();
            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            $numero = count($resultado);
            return $numero;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function crearReunion($datos) {
        try {
            $resultado = $this->conexion->query("INSERT INTO reuniones VALUES(null, $datos)") or die();
            return true;
        } catch (\Throwable $th) {
            // return $th;
            return false;
        }
    }

    public function getReuniones() {
        try {
            $resultado = $this->conexion->query("SELECT r.fecha,
            r.id,
            r.idUsuario,
            r.disponible,
            u.telefono,
            r.capacidad,
            CONCAT(u.nombre, ' ', u.apellido) AS voluntario
            FROM reuniones r
            INNER JOIN usuarios u ON u.id = r.idUsuario
            WHERE r.fecha > NOW() -- Filtra solo las reuniones con fecha futura
            ORDER BY r.fecha;
            ;") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function editarReunion($id, $fecha, $disponible, $capacidad) {
        try {
            $resultado = $this->conexion->query("UPDATE reuniones SET fecha = '$fecha', disponible = '$disponible', capacidad = '$capacidad'
             WHERE id = '$id'") or die();
            return true;
        } catch (\Throwable $th) {
            // return $th;
            return false;
        }
    } 

    public function eliminarReunion($id) {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM reuniones WHERE id = ?");
            $stmt->bind_param("i", $id); // "i" indica tipo entero
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            error_log("Error al eliminar reunión: " . $th->getMessage());
            return false;
        }
    }

    public function actualizarTelefono($id, $telefono) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios SET telefono = '$telefono' WHERE id = '$id'") or die();
            return true;
        } catch (\Throwable $th) {
            // return $th;
            return false;
        }
    } 
}

?>