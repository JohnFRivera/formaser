<?php

require_once __DIR__ . '/../MYSQL.php';


class Usuario {
    private $db;

    // Constructor para establecer la conexión a la base de datos
    public function __construct() {
        $this->db = new MYSQL();
    }

    // Método para agregar un nuevo usuario
    public function crear($identificacion, $nombre, $apellido, $correo, $contrasena) {
        $contrasenaEncriptada = password_hash($contrasena, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (identidad, Nombre, Apellido, Correo, password) VALUES ('$identificacion', '$nombre', '$apellido', '$correo', '$contrasenaEncriptada')";
        
        try {
            $this->db->efectuarConsulta($sql);
            return "Usuario creado exitosamente.";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    

    // Método para obtener todos los usuarios
    public function obtenerTodos() {
        $sql = "SELECT identidad, nombre, apellido, correo FROM usuarios";
        
        try {
            $result = $this->db->efectuarConsulta($sql);
            $usuarios = [];

            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
            return $usuarios;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Método para obtener un usuario por ID
    public function obtenerPorId($identificacion) {
        $sql = "SELECT identidad, nombre, apellido, correo FROM usuarios WHERE identidad = '$identificacion'";
        
        try {
            $result = $this->db->efectuarConsulta($sql);
            return $result->fetch_assoc();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Método para actualizar un usuario
    public function actualizar($identificacion, $nombre, $apellido, $correo) {
        $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', correo = '$correo' WHERE identidad = '$identificacion'";
        
        try {
            $this->db->efectuarConsulta($sql);
            return "Usuario actualizado exitosamente.";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Método para eliminar un usuario
    public function eliminar($identificacion) {
        $sql = "DELETE FROM usuarios WHERE Identificacion = '$identificacion'";
        
        try {
            $this->db->efectuarConsulta($sql);
            return "Usuario eliminado exitosamente.";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
?>
