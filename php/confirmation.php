<?php

require_once 'connection.php';

class Confirmation {

    private $nombre;
    const TABLA = 'confirmaciones';

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function guardar(){

        $conexion = new Conexion();
        $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .' (nombre) VALUES(:nombre)');
        $consulta->bindParam(':nombre', $this->nombre);
        $consulta->execute();

        $conexion = null;
    }
}

?>