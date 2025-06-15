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

    public function consultarVoluntarios() {
        try {
            $resultado = $this->conexion->query("SELECT id, CONCAT(nombre, ' ', apellido) voluntario FROM usuarios WHERE rol != 'postulante' AND habilitado = 1 ORDER BY apellido") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getAvance($id) {
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

}

?>