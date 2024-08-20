<?php
class MYSQL
{
    private $ipServidor = "localhost";
    private $usuarioBase = 'root';
    private $contrasena = '';
    private $basededatos = 'formaserv2';
    
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

    public function efectuarConsulta($consulta, $types = "", $params = [])
    {
        $stmt = $this->conexion->prepare($consulta);

        if ($stmt === false) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
        }

        // Si hay parámetros, los enlazamos
        if (!empty($types) && !empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }

        $resultado = $stmt->get_result();

        return $resultado;
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

