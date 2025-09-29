<?php
class conexion extends PDO
{
    private $host = "localhost";
    private $dbname = "mi_negocio";
    private $user = "root";
    private $pass = "";

    public function __construct()
    {
        try {
            parent::__construct(
                "mysql:host=$this->host;dbname=$this->dbname;charset=utf8",
                $this->user,
                $this->pass
            );
            // Activar errores como excepciones
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Mostrar error si falla la conexión
            echo json_encode([
                "error" => "Error de conexión a la base de datos",
                "detalle" => $e->getMessage()
            ]);
            exit;
        }
    }
}
