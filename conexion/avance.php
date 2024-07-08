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
            $resultado = $this->conexion->query("SELECT
            CONCAT(u_vol.nombre, ' ', u_vol.apellido) AS voluntario,
            COUNT(DISTINCT CASE WHEN s_ter.estado1 = 2 AND s_ter.estado2 = 2 AND s_ter.estado3 = 2 AND s_ter.estado4 = 2 AND s_ter.estado5 = 2 AND s_ter.estado6 = 2 AND u_asig.anio = YEAR(CURDATE()) THEN u_asig.id END) AS terminados,
            COUNT(DISTINCT CASE WHEN (s_emp.estado1 = 1 OR s_emp.estado2 = 1 OR s_emp.estado3 = 1 OR s_emp.estado4 = 1 OR s_emp.estado5 = 1 OR s_emp.estado6 = 1) AND u_asig.anio = YEAR(CURDATE()) THEN u_asig.id END) AS empezados,
            COUNT(DISTINCT CASE WHEN u_asig.anio = YEAR(CURDATE()) THEN u_asig.id END) AS asignados
        FROM usuarios u_vol
        LEFT JOIN usuarios u_asig ON u_vol.id = u_asig.asignado
        LEFT JOIN seguimiento s_ter ON u_asig.id = s_ter.idUsuario AND s_ter.estado1 = 2
        LEFT JOIN seguimiento s_emp ON u_asig.id = s_emp.idUsuario AND (s_emp.estado1 = 1 OR s_emp.estado2 = 1 OR s_emp.estado3 = 1 OR s_emp.estado4 = 1 OR s_emp.estado5 = 1 OR s_emp.estado6 = 1)
        WHERE u_vol.rol != 'postulante' AND u_vol.habilitado = 1
        GROUP BY u_vol.id, voluntario
        ORDER BY u_vol.apellido;") or die();
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

    public function consultarDescarga($estado, $asignado) {
        try {
            $resultado = $this->conexion->query("SELECT provincia,
                CONCAT(nombre, ' ', apellido) AS nombre,
                dni,
                telefono,
                raven,
                ct,
                observacion
                FROM usuarios
                WHERE rol = 'postulante' AND anio = YEAR(CURDATE())
                AND (
                    ('$estado' = 'terminados' AND ct != '-' AND raven != '-') OR
                    '$estado' != 'terminados'
                )
                AND (
                    ('$asignado' <> 'todos' AND asignado = '$asignado') OR
                    '$asignado' = 'todos'
                );") or die();
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

    public function getResumen() {
        try {
            $resultado = $this->conexion->query("SELECT
            COUNT(DISTINCT CASE WHEN s_ter.estado1 = 2 AND s_ter.estado2 = 2 AND s_ter.estado3 = 2 AND s_ter.estado4 = 2 AND s_ter.estado5 = 2 AND s_ter.estado6 = 2 THEN u_asig.id END) AS terminados,
            COUNT(DISTINCT CASE WHEN s_emp.estado1 = 1 OR s_emp.estado2 = 1 OR s_emp.estado3 = 1 OR s_emp.estado4 = 1 OR s_emp.estado5 = 1 OR s_emp.estado6 = 1 THEN u_asig.id END) AS empezados,
            COUNT(DISTINCT u_asig.id) AS total
        FROM usuarios u_asig
        LEFT JOIN seguimiento s_ter ON u_asig.id = s_ter.idUsuario AND s_ter.estado1 = 2
        LEFT JOIN seguimiento s_emp ON u_asig.id = s_emp.idUsuario AND (s_emp.estado1 = 1 OR s_emp.estado2 = 1 OR s_emp.estado3 = 1 OR s_emp.estado4 = 1 OR s_emp.estado5 = 1 OR s_emp.estado6 = 1)
        WHERE u_asig.rol = 'postulante' AND u_asig.anio = YEAR(CURDATE());") or die();
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

}

?>

