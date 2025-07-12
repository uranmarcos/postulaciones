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

    public function getTotalAsignados($id) {
        $anio = date("Y");
        try {
            $resultado = $this->conexion->query("SELECT U.id,U.provincia, U.telefono, U.nombre, U.apellido, U.pass, U.dni, 
                U.pass, U.observacion, U.raven, U.ct, U.habilitado 
                FROM usuarios U
                WHERE U.anio = '$anio' AND U.asignado = '$id'
                ORDER BY U.apellido") or die();
            // return $resultado->fetch_all(MYSQLI_ASSOC);
            $filas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            return $filas;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getPendientes($id) {
        $anio = date("Y");
        try {
            $resultado = $this->conexion->query("SELECT U.id,U.provincia, U.telefono, U.nombre, U.apellido, U.pass, U.dni, 
                U.pass, U.observacion, U.raven, U.ct, U.habilitado 
                FROM usuarios U
                WHERE U.anio = '$anio' AND U.asignado = '$id' AND (U.raven = '-' OR U.ct = '-')
                ORDER BY U.nombre") or die();
            // return $resultado->fetch_all(MYSQLI_ASSOC);
            $filas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            return $filas;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function contarAsignados($filtro) {
        $anio = date("Y");
        try {
            $resultado = $this->conexion->query("SELECT COUNT(*) total FROM usuarios WHERE rol = 'postulante' AND anio LIKE '$anio' AND asignado = '$filtro'");
            // return $resultado->fetch_all(MYSQLI_ASSOC);
            $filas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            return $filas;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function consultarAsignados($filtro, $inicio, $cantidad) {
        $anio = date("Y");
        try {
            $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.provincia, U.telefono,
                U.pass, U.observacion, U.raven, U.ct, U.habilitado 
                FROM usuarios U
                WHERE U.anio = '$anio' AND U.asignado = '$filtro'
                ORDER BY CASE WHEN U.ct = '-' THEN 0 ELSE 1 END, U.ct, U.nombre
                LIMIT $cantidad OFFSET $inicio") or die();
            // return $resultado->fetch_all(MYSQLI_ASSOC);
            $filas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            return $filas;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function consultarVoluntarios() {
        try {
            $resultado = $this->conexion->query("SELECT id, CONCAT(apellido, ', ', nombre) voluntario FROM usuarios 
            WHERE rol != 'postulante' AND habilitado = 1 ORDER BY apellido, nombre") or die();
            // return $resultado->fetch_all(MYSQLI_ASSOC);
            $filas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            return $filas;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function buscarUsuario($dni) {
        try {
            $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.provincia, U.observacion, U.telefono, U.anio, U.pass, U.raven, U.ct, U.habilitado, U.asignado idAsignado FROM usuarios U
            WHERE U.dni LIKE '$dni%' AND rol = 'postulante' ORDER BY U.dni") or die();
            // return $resultado->fetch_all(MYSQLI_ASSOC);
            $filas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            return $filas;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function asignarUsuario($idUsuario, $idVoluntario) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios SET asignado = '$idVoluntario' WHERE id = '$idUsuario'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function crearSeguimiento($datos) {
        try {
            $resultado = $this->conexion->query("INSERT INTO seguimiento VALUES($datos)") or die();
            return true;
        } catch (\Throwable $th) {
            // return $th;
            return false;
        }
    }

    public function haySeguimiento($condicion) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM seguimiento WHERE $condicion") or die();
            // $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            $filas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            // return $filas;
            $numero = count($filas);
            return $numero;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getAvanceVoluntario($id) {
        try {
            $resultado = $this->conexion->query("SELECT
            (SELECT COUNT(*) FROM usuarios u
            INNER JOIN seguimiento s ON u.id = s.idUsuario
            WHERE u.anio = YEAR(CURDATE())
            AND u.asignado = '$id'
            AND s.estado1 = 2
            AND s.estado2 = 2
            AND s.estado3 = 2
            AND s.estado4 = 2
            AND s.estado5 = 2
            AND s.estado6 = 2) AS terminados,
            (SELECT COUNT(*) FROM usuarios u
            INNER JOIN seguimiento s ON u.id = s.idUsuario
            WHERE u.anio = YEAR(CURDATE())
            AND u.asignado = '$id'
            AND (s.estado1 <> 0 AND s.estado1 <> 2 OR s.estado2 <> 0 AND s.estado2 <> 2
            OR s.estado3 <> 0 AND s.estado3 <> 2 OR s.estado4 <> 0 AND s.estado4 <> 2
            OR s.estado5 <> 0 AND s.estado5 <> 2 OR s.estado6 <> 0 AND s.estado6 <> 2)) 
            AS empezados,
            (SELECT COUNT(*) FROM usuarios u
            WHERE u.anio = YEAR(CURDATE())
            AND u.asignado = '$id')
            AS total;") or die();

            // $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            $filas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            return $filas;
            // return $resultado;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getEmpezados($id) {
        try {
            $resultado = $this->conexion->query("SELECT
            u.dni, u.nombre, u.apellido FROM usuarios u
            INNER JOIN seguimiento s ON u.id = s.idUsuario
            WHERE u.anio = YEAR(CURDATE()) AND u.asignado = '$id'
            AND ((s.estado1 <> 0 AND s.estado1 <> 2) OR (s.estado2 <> 0 AND s.estado2 <> 2)
            OR (s.estado3 <> 0 AND s.estado3 <> 2) OR (s.estado4 <> 0 AND s.estado4 <> 2)
            OR (s.estado5 <> 0 AND s.estado5 <> 2) OR (s.estado6 <> 0 AND s.estado6 <> 2));") or die();

            // $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            
            // return $resultado;
            $filas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            return $filas;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getSinHacer($id) {
        try {
            $sql = "SELECT u.dni, u.nombre, u.apellido
                    FROM usuarios u
                    LEFT JOIN seguimiento s ON u.id = s.idUsuario
                    WHERE u.asignado = ?
                    AND (s.idUsuario IS NULL OR s.estado1 = 0)
                    AND u.anio = YEAR(CURDATE())";
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $filas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            $stmt->close();
            return $filas;
            
        } catch (\Throwable $th) {
            // Manejo de errores
            error_log('Error: ' . $th->getMessage());
            return false;
        }
    }   

    public function actualizarHabilitado($idUsuario, $habilitado) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios SET habilitado = '$habilitado' WHERE id = '$idUsuario'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

}

?>