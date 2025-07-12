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

    public function login($usuario) {
        try {
        $anio_actual = date('Y');

        $stmt = $this->conexion->prepare("SELECT * FROM usuarios WHERE dni = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if (!$resultado || $resultado->num_rows === 0) {
            return [];  // array vacío si no hay resultados
        }

        $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

        // Buscar registro que no sea postulante
        foreach ($usuarios as $registro) {
            if ($registro['rol'] !== 'postulante') {
                return [$registro];  // lo devuelvo dentro de un array
            }
        }

        // Si todos son postulantes, buscar del año actual
        foreach ($usuarios as $registro) {
            if ($registro['rol'] === 'postulante' && $registro['anio'] == $anio_actual) {
                return [$registro];  // también dentro de un array
            }
        }

        return [];  // si no encontró nada, devuelvo array vacío

    } catch (\Throwable $th) {
        return [];  // en caso de error devuelvo array vacío también
    }
    }

    public function close() {
        $this->conexion->close();
    }

}

?>