<?php
class MYSQL
{
    private $ipServidor = "localhost";
    private $usuarioBase = 'root';
    private $contrasena = '';
    private $basededatos = 'bd_formaser';
    
    private $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli($this->ipServidor, $this->usuarioBase, $this->contrasena, $this->basededatos);
        if ($this->conexion->connect_error) {
            throw new Exception("Error de conexión: " . $this->conexion->connect_error);
        }
        $this->conexion->set_charset("utf8");
    }

    public function desconectar()
    {
        $this->conexion->close();
    }

    public function efectuarConsulta($consulta)
    {
        $this->conexion->query("SET lc_time_names = 'es_ES'; SET NAMES 'utf8'");

        $resultadoConsulta = $this->conexion->query($consulta);

        if (!$resultadoConsulta) {
            throw new Exception("Error en la consulta: " . $this->conexion->error);
        }

        return $resultadoConsulta;
    }

    public function filasAfectadas()
    {
        return $this->conexion->affected_rows;
    }

    public function __destruct()
    {
        $this->desconectar();
    }
}
?>
