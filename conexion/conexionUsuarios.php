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

    public function contarUsuarios($filtro) {
        try {
            $resultado = $this->conexion->query("SELECT COUNT(*) total FROM usuarios WHERE rol = 'postulante' AND anio LIKE '$filtro'");
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function consultarUsuarios($filtro, $inicio, $cantidad) {
        try {
            $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.observacion, U.apellido, U.dni, U.anio, U.provincia, U.telefono,
                U.pass, U.raven, U.ct, U.habilitado, U.asignado, 
                CASE WHEN U.asignado = 0 THEN '-' ELSE CONCAT(UU.nombre, ' ', UU.apellido) END AS nombreAsignado
                FROM usuarios U
                LEFT JOIN usuarios UU ON U.asignado = UU.id
                WHERE U.anio = '$filtro' AND U.rol = 'postulante'
                ORDER BY U.apellido
                LIMIT $cantidad OFFSET $inicio") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    

    public function buscarUsuario($dni) {
        try {
            $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.provincia, U.observacion, U.telefono, U.anio, U.pass, U.raven, U.ct, U.habilitado, U.asignado idAsignado FROM usuarios U
            WHERE U.dni LIKE '$dni%' AND rol = 'postulante' ORDER BY U.dni") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function consultarVoluntarios() {
        try {
            $resultado = $this->conexion->query("SELECT id, CONCAT(nombre, ' ', apellido) voluntario FROM usuarios WHERE rol != 'postulante' AND habilitado = 1 ORDER BY apellido") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
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

    public function insertarUsuario($datos) {
        try {
            $resultado = $this->conexion->query("INSERT INTO usuarios VALUES(null, $datos)") or die();
            return true;
        } catch (\Throwable $th) {
            // return $th;
            return $th;
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

    public function consultarAsignados($filtro, $inicio, $cantidad) {
        $anio = date("Y");
        try {
            $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.provincia, U.telefono,
                U.pass, U.observacion, U.raven, U.ct, U.habilitado 
                FROM usuarios U
                WHERE U.anio = '$anio' AND U.asignado = '$filtro'
                ORDER BY U.apellido
                LIMIT $cantidad OFFSET $inicio") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function contarAsignados($filtro) {
        $anio = date("Y");
        try {
            $resultado = $this->conexion->query("SELECT COUNT(*) total FROM usuarios WHERE rol = 'postulante' AND anio LIKE '$anio' AND asignado = '$filtro'");
            return $resultado->fetch_all(MYSQLI_ASSOC);
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
            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            $numero = count($resultado);
            return $numero;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getAvance($id,) {
        try {
            // $resultado = $this->conexion->query("SELECT COUNT(*) AS cantidad
            // FROM usuarios u
            // INNER JOIN seguimiento s ON u.id = s.idUsuario
            // WHERE YEAR(u.anio) = YEAR(CURDATE()) -- Filtra por el año en curso
            // AND u.asignado = '$id' -- Reemplaza tu_parametro_id con el valor del parámetro
            // AND s.estado1 = 2
            // AND s.estado2 = 2
            // AND s.estado3 = 2
            // AND s.estado4 = 2
            // AND s.estado5 = 2
            // AND s.estado6 = 2") or die();


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
            AND (s.estado1 = 1 OR s.estado2 = 1 OR s.estado3 = 1 OR s.estado4 = 1 OR s.estado5 = 1 OR s.estado6 = 1)) AS pendientes,
            (SELECT COUNT(*) FROM usuarios u
            WHERE u.anio = YEAR(CURDATE())
            AND u.asignado = '$id')
            AS total;") or die();



            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            
            return $resultado;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getTotalAsignados($id) {
        $anio = date("Y");
        try {
            $resultado = $this->conexion->query("SELECT U.id,U.provincia, U.telefono, U.nombre, U.apellido, U.dni, 
                U.pass, U.observacion, U.raven, U.ct, U.habilitado 
                FROM usuarios U
                WHERE U.anio = '$anio' AND U.asignado = '$id'
                ORDER BY U.apellido") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    



}

?>