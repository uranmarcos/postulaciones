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
                ORDER BY CASE WHEN U.asignado = 3180 THEN 0 ELSE 1 END, U.apellido
                LIMIT $cantidad OFFSET $inicio") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function buscarUsuario($dni) {
        try {
            $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.provincia, U.observacion, U.telefono, U.anio, U.pass, 
            U.raven, U.ct, U.habilitado, U.asignado,
            CASE WHEN U.asignado = 0 THEN '-' ELSE CONCAT(UU.nombre, ' ', UU.apellido) END AS nombreAsignado 
            FROM usuarios U
            LEFT JOIN usuarios UU ON U.asignado = UU.id
            WHERE U.dni LIKE '$dni%' AND U.rol = 'postulante' ORDER BY U.dni") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function buscarUsuarioPorNombre($nombre) {
        try {
            $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.provincia, U.observacion, U.telefono, U.anio, U.pass, 
            U.raven, U.ct, U.habilitado, U.asignado,
            CASE WHEN U.asignado = 0 THEN '-' ELSE CONCAT(UU.nombre, ' ', UU.apellido) END AS nombreAsignado 
            FROM usuarios U
            LEFT JOIN usuarios UU ON U.asignado = UU.id
            WHERE (U.nombre LIKE '%$nombre%' OR U.apellido LIKE '%$nombre%') AND U.rol = 'postulante' ORDER BY U.dni") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function insertarUsuario($datos) {
        try {
            // $resultado = $this->conexion->query("INSERT INTO usuarios VALUES(null, $datos)") or die();
            // return true;
            
            $sql = "INSERT INTO usuarios (nombre, apellido, dni, pass, mail, rol, anio, provincia, telefono, asignado, observacion, raven, ct, habilitado, fechaTerminado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Preparar la sentencia
            $stmt = $this->conexion->prepare($sql);

            if ($stmt === false) {
                throw new Exception($this->conexion->error);
            }
            $null = null;
            // Vincular los parámetros a la sentencia preparada
            $stmt->bind_param(
                'sssssssssssssss', 
                $datos['nombre'], 
                $datos['apellido'], 
                $datos['dni'], 
                $datos['contrasenia'], 
                $null, 
                $datos['rol'], 
                $datos['anio'], 
                $datos['provincia'], 
                $datos['telefono'], 
                $datos['asignado'], 
                $null, 
                $datos['test'], 
                $datos['test'], 
                $datos['habilitado'], 
                $null
            );
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
                // throw new Exception($stmt->error);
            }
        } catch (\Throwable $th) {
            // return $th;
            return false;
        }
    }

    // public function hayRegistro($condicion) {
    //     try {
    //         $resultado = $this->conexion->query("SELECT * FROM usuarios WHERE $condicion") or die();
    //         $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
    //         $numero = count($resultado);
    //         return $numero;
    //     } catch (\Throwable $th) {
    //         return false;
    //     }
    // }

    public function hayRegistro($condicion) {
        try {
            // $resultado = $this->conexion->query("SELECT * FROM usuarios WHERE $condicion") or die();
            $resultado = $this->conexion->query("SELECT ct, raven, anio FROM usuarios WHERE $condicion") or die();
            // $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            // // $numero = count($resultado);
            // return $resultado;
            return $resultado->fetch_all(MYSQLI_ASSOC);
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

    public function consultarVoluntarios() {
        try {
            $resultado = $this->conexion->query("SELECT id, CONCAT(apellido, ', ', nombre) voluntario FROM usuarios WHERE rol != 'postulante'
             AND habilitado = 1 ORDER BY apellido, nombre") or die();
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

    public function editarUsuario($data, $idUsuario) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios SET $data WHERE id = '$idUsuario'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function contarAsignables() {
        try {
            $anio = date("Y");
            $resultado = $this->conexion->query("SELECT COUNT(*) cantidad FROM usuarios WHERE asignado = 3180 AND anio = '$anio' AND raven = '-' AND ct = '-'");
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function asignarGrupo($cantidad, $idVoluntario, $anio) {
        try {
            // $anio = date("Y");
            $resultado = $this->conexion->query("UPDATE usuarios SET asignado = $idVoluntario
            WHERE asignado = 3180 AND anio = $anio AND raven = '-' AND ct = '-' LIMIT $cantidad;") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


}

?>