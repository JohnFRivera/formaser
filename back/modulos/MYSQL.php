<?php
// clase para conexiones
class MYSQL
{
    // Datos de validacion para la conexión
    private $ipServidor = "localhost";
    private $usuarioBase = 'root';
    private $contrasena = '';
    private $basededatos = 'bd_formaser';
    
    private $conexion;

    // Constructor
    public function __construct()
    {
        // Inicialización de la conexión en el constructor
        $this->conexion = new mysqli($this->ipServidor, $this->usuarioBase, $this->contrasena, $this->basededatos);
        
        // Manejo de errores de conexión
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    // Método para desconectar
    public function desconectar()
    {
        $this->conexion->close();
    }

    // Método para ejecutar consultas
    public function efectuarConsulta($consulta)
    {
        // Configuración de la codificación de caracteres y otras opciones de la conexión
        $this->conexion->query("SET lc_time_names = 'es_Es'");
        $this->conexion->query("SET NAMES 'utf8'");

        // Ejecución de la consulta
        $resultadoConsulta = $this->conexion->query($consulta);

        // Manejo de errores de consulta
        if (!$resultadoConsulta) {
            die("Error en la consulta: " . $this->conexion->error);
        }

        return $resultadoConsulta;
    }

    // Método para obtener el número de filas afectadas por la última consulta
    public function filasAfectadas()
    {
        return $this->conexion->affected_rows;
    }
}
?>