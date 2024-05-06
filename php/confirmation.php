<?php

require_once 'connection.php';

class Confirmation {

    private $nombre;
    private $numero_asistentes;
    const TABLA = 'confirmaciones';

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function __construct($nombre, $numero_asistentes) {
        $this->nombre = $nombre;
        $this->numero_asistentes = $numero_asistentes;
    }

    public function guardar(){

        $conexion = new Conexion();
        $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .' (nombre, numero_asistentes) VALUES(:nombre, :numero_asistentes)');
        $consulta->bindParam(':nombre', $this->nombre);
        $consulta->bindParam(':numero_asistentes', $this->numero_asistentes);
        $consulta->execute();

        $conexion = null;
    }
}

?>