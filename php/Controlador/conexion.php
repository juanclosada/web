<?php
class Conexion
{

    private $handleDB;

    public function __construct($include = 'S')
    {
        if ($include == 'S') {
            require_once '../config/config.php';
        } else {
            require_once '../../config/config.php';
        }
    }

    public function conectar()
    {
        try {
            $connection = "mysql:host=" . DB_HOST . ";dbname=" . DB_TABLE;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ];
            $this->handleDB = new PDO($connection, DB_USER, DB_PASSWORD, $options);
            return $this->handleDB;
        } catch (PDOException $e) {
            print_r('Error connection: ' . $e->getMessage());
            die();
        }
    }

    public function consultarRegistros($query, $campos = [])
    {
        $resdb = self::conectar()->prepare($query);
        $resdb->execute($campos);
        $respuesta = [];
        if ($resdb->rowCount() > 0) {
            foreach ($resdb->fetchAll(PDO::FETCH_OBJ) as $key => $value) {
                $respuesta[$key] = $value;
            }
            return $respuesta;
        } else {
            return false;
        }
    }
    public function consultarRegistros2($query, $campos = [])
    {
        $resdb = self::conectar()->prepare($query);
        $resdb->execute($campos);
        $respuesta = $salida = [];
        if ($resdb->rowCount() > 0) {
            foreach ($resdb->fetchAll(PDO::FETCH_OBJ) as $key => $value) {
                $respuesta[$key] = $value;
            }
            foreach ($respuesta as $key => $value) {
                $data = [];
                foreach ($value as $keyd => $valued) {
                    $data[$keyd] = $valued;
                }
                $salida[] = $data;
            }
            return $salida;
        } else {
            return false;
        }
    }

    public function consultarRegistro($query, $campos = [], $filtro = "")
    {
        try {
            //code...
            $resdb = self::conectar()->prepare($query);
            $resdb->execute($campos);
        } catch (\Throwable $th) {
            mostrar([$query, $campos, $filtro, $th]);
        }
        $respuesta = [];
        if ($resdb->rowCount() > 0) {
            foreach ($resdb->fetch(PDO::FETCH_OBJ) as $key => $value) {
                $respuesta[$key] = $value;
            }
            if ($filtro != '') {
                return $respuesta[$filtro];
            } else {
                return $respuesta;
            }
        } else {
            return [];
        }
    }

    public function consultar($query, $campos)
    {
        $resdb = self::conectar()->prepare($query);
        $resdb->execute($campos);
        if ($resdb->rowCount() > 0) {
            return $resdb;
        } else {
            return false;
        }
    }

    public function crudRegistro($query, $campos)
    {
        $resdb = self::conectar()->prepare($query);
        return $resdb->execute($campos);
    }

    public function lastInsertId()
    {
        return $this->handleDB->lastInsertId();
    }
    public function insertarRegistro($tabla, $datos)
    {
        //
        $i = 0;
        $campos = $valores =  $valores2 = '';
        foreach ($datos as $key => $value) {
            $campos .= ($i == 0 ? $key : ", " . $key);
            $valores2 .= ($i == 0 ? "" . $value : ", " . $value);
            $valores .= ($i == 0 ? ":" . $key : ", :" . $key);
            $i++;
        }
        $query = "INSERT INTO $tabla ($campos) VALUES ($valores)";
        // mostrar($query);
        $resdb = self::conectar()->prepare($query);
        return $resdb->execute($datos);
    }
    public function actualizarRegistro($tabla, $datos, $datosCondicion)
    {
        //
        $i = 0;
        $campos = $camposCondicion = '';
        foreach ($datos as $key => $value) {
            $campos .= ($i == 0 ? "$key = :$key" : ", $key = :$key");
            $i++;
        }
        $i = 0;
        foreach ($datosCondicion as $key => $value) {
            $camposCondicion .= ($i == 0 ? "$key = :$key" : " AND $key = :$key");
            $i++;
        }
        $query = "UPDATE $tabla SET $campos";
        $query .= " WHERE $camposCondicion";
        $resdb = self::conectar()->prepare($query);
        return $resdb->execute(array_merge($datos, $datosCondicion));
    }
    public function eliminarRegistro($tabla, $datos)
    {
        $i = 0;
        $campos = '';
        foreach ($datos as $key => $value) {
            $campos .= ($i == 0 ? "$key = :$key" : " AND $key = :$key");
            $i++;
        }
        $query = "DELETE FROM $tabla WHERE $campos";
        $resdb = self::conectar()->prepare($query);
        return $resdb->execute($datos);
    }

    public function contarRegistros($query)
    {
        $nRows = self::conectar()->query("SELECT COUNT(*) FROM $query")->fetchColumn();
        return $nRows;
    }
}
function mostrar($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die();
}
function redirecion()
{
    switch ($_SESSION['usuario']['id_rol']) {
        case '1':
            header("location: ../vista/dashboardadmin.php");
            break;
        case '2':
            header("location: ../roles/dashboardjefe.php");
            break;
        case '3':
            header("location: ../vista/cart.php");
            break;
        default:
            echo "Rol no definido<a href='../vista/login.php'>Ingresar Nuevamente</a>";
            break;
    }
}
function sumarDescuento($precio)
{
    $descuento = $precio * 0.10; // 10% del precio
    return $precio - $descuento;
}
function formaPago($id)
{
    switch ($id) {
        case '1':
            $txt = 'Tarjeta de Crédito';
            break;
        case '2':
            $txt = 'Tarjeta Débito';
            break;
        case '3':
            $txt = 'Nequi';
            break;

        default:
            $txt = 'N/A';
            break;
    }
    return $txt;
}
