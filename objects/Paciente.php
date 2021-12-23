<?php


class Paciente
{
    private $conn;
    private $table_name = 'pacientes';
    public $id;
    public $nombre;
    public $cedula;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT id, nombre, cedula FROM " . $this->table_name . " ORDER BY nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readOne()
    {
        try {
            $query = "SELECT id, nombre, cedula FROM "  . $this->table_name . " WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $this->id = $row['id'];
                $this->nombre = $row['nombre'];
                $this->cedula = $row['cedula'];
            } else {
                echo json_encode(["error" => "no se pudo encontrar el doctor en la base de datos"]);
                die();
            }
        } catch (\Throwable $th) {
            echo json_encode(["error" => "no se pudo realizar la consulta"]);
        }
    }

    function create()
    {

        try {
            $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, cedula=:cedula";
            $stmt = $this->conn->prepare($query);

            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->cedula = htmlspecialchars(strip_tags($this->cedula));

            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":cedula", $this->cedula);
            $tag =   $stmt->execute();
            $id = $this->conn->lastInsertId();

            if ($tag) {
                echo json_encode(["exito" => "paciente creado", "id" => $id]);
            }
        } catch (\Throwable $err) {
            $code =  $err->getCode();
            if ($code == 23000) echo json_encode(["error" => "cedula duplicada"]);
            else  echo json_encode(["error" => "no se pudo crear el paciente"]);
        }
    }





    function update()
    {

        try {


            $query = "UPDATE " . $this->table_name . " SET nombre=:nombre, cedula=:cedula WHERE id=:id ";
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->cedula = htmlspecialchars(strip_tags($this->cedula));
            $stmt->bindValue(':id', (int) $this->id);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':cedula', $this->cedula);

            $tag =   $stmt->execute();
            $id = $this->conn->lastInsertId();

            if ($tag) {
                echo json_encode(["exito" => "paciente actualizado", "id" => $this->id]);
            }
        } catch (\Throwable $err) {
            $code =  $err->getCode();
            if ($code == 23000) echo json_encode(["error" => "cedula duplicada"]);
            else  echo json_encode(["error" => "no se pudo actualizar el paciente"]);
        }
    }

    function delete()
    {

        try {
            $query = " DELETE FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(1, $this->id);
            $tag =   $stmt->execute();

            if ($tag) {
                echo json_encode(["exito" => "paciente eliminado"]);
            }
        } catch (\Throwable $th) {
            echo json_encode(["error" => "no se pudo eliminar el paciente"]);
        }
    }

    function search($keywords)
    {
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = '%' . $keywords . '%';

        $sql = "SELECT id, nombre, cedula FROM " .  $this->table_name .  " WHERE  nombre LIKE :nombre";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':nombre', $keywords);
        $stmt->execute();
        return $stmt;
    }



    public function count()
    {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_rows'];
    }
}
