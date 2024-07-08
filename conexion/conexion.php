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

    public function login($usuario, $password) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM usuarios WHERE dni = '$usuario'") or die();
            // $data = $resultado -> fetch_all(MYSQLI_ASSOC);
            // return $data;
            $filas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            return $filas;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function close() {
        $this->conexion->close();
    }

}

?>