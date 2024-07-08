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

    public function getEstadoPostulante($id) {
        try {
            $resultado = $this->conexion->query("SELECT S.estado1, S.habilitado1, S.estado2, S.habilitado2,
            S.estado3, S.habilitado3, S.estado4, S.habilitado4, S.estado5, S.habilitado5, S.estado6, S.habilitado6
             FROM seguimiento S WHERE S.idUsuario = '$id'") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function buscarUsuarioParaSeguimiento($dni) {
        try {
            $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.provincia, U.observacion, U.telefono, U.anio, U.pass, U.raven, U.ct, U.habilitado, U.asignado idAsignado FROM usuarios U
            WHERE U.dni LIKE '$dni%' AND rol = 'postulante' AND habilitado = 1 ORDER BY U.dni") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

























    public function getUsuarioSeguimiento($id) {
        try {
            // $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.provincia, U.telefono,
            //  U.rol, U.contra, U.raven, U.ct, U.habilitado, U.asignado idAsignado, 
            //  CONCAT(B.nombre, ' ',  B.apellido) asignado FROM usuarios U INNER JOIN 
            //  usuarios B ON U.asignado = B.id  WHERE U.anio = '$filtro' AND U.rol = 'postulante'
            //   ORDER BY apellido limit $cantidad offset $inicio") or die();
            $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.pass, U.observacion,
            U.raven, U.ct, S.estado1, S.habilitado1, S.tiempo, S.nivel, S.resultado1, S.estado2, S.habilitado2, S.resultado2, 
            S.estado3, S.habilitado3, S.resultado3, S.estado4, S.habilitado4, S.resultado4,
            S.estado5, S.habilitado5, S.resultado5, S.estado6, S.habilitado6, S.resultado6
             FROM usuarios U INNER JOIN seguimiento S ON 
             U.id = S.idUsuario WHERE U.id = '$id'") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function actualizarTest($id, $actividad, $estado) {
        try {
            $resultado = $this->conexion->query("UPDATE seguimiento SET $actividad = $estado WHERE idUsuario = '$id'") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function asignarTiempo($id, $tiempo) {
        try {
            $resultado = $this->conexion->query("UPDATE seguimiento SET tiempo = '$tiempo', habilitado1 = 0 WHERE idUsuario = '$id'") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function observar($id, $observacion) {
        try {
            $resultado = $this->conexion->query("UPDATE usuarios SET observacion = '$observacion' WHERE id = '$id'") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getAsignados($id) {
        $anio = date("Y");
        try {
            $resultado = $this->conexion->query("SELECT U.id, U.dni, U.nombre, U.apellido
                FROM usuarios U
                WHERE U.anio = '$anio' AND U.asignado = '$id' AND U.habilitado = 1
                ORDER BY U.apellido"
            ) or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

   



   
}

?>