<?php
include_once '../shared/helpers.php';

//SELECT * FROM citas AS t1 INNER JOIN doctores AS t2 ON t1.doctor_id=t2.id;

class Cita
{
    private $conn;
    private $table_name = 'citas';
    public $id;
    public $nombre;
    public $cedula;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {

        $query = "SELECT * FROM $this->table_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readToday($doctor_id, $date)
    {
      
     
        try {
            $query = "SELECT $this->table_name.id as cita_id 
            , paciente_id, aprobado, fecha, hora 
             FROM $this->table_name  WHERE doctor_id = :doctor_id AND fecha LIKE  :fecha ";
         
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":doctor_id", $doctor_id);
            $stmt->bindValue(":fecha", "".$date."%");
            $stmt->execute();
            return $stmt;
        } catch (\Throwable $th) {

            echo json_encode(["error" => $th->getMessage()]);
        }
    }

    function readOne()
    {
        try {
            $query = "SELECT id, doctor_id, paciente_id, fecha, hora FROM "  . $this->table_name . " WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($row) {

                $this->id = $row['id'];
                $this->doctor_id = $row['doctor_id'];
                $this->paciente_id = $row['paciente_id'];
                $this->fecha = $row['fecha'];
                $this->hora = $row['hora'];
            } else {
                echo json_encode(["error" => "no se pudo encontrar la cita en la base de datos"]);
                die();
            }
        } catch (\Throwable $th) {
            echo json_encode(["error" => "no se pudo realizar la consulta"]);
        }
    }

    function create()
    {
        try {
            $query = "INSERT INTO " . $this->table_name . " SET fecha=:fecha,  
            hora=:hora, paciente_id=:paciente_id,
            doctor_id=:doctor_id
            ";
            $stmt = $this->conn->prepare($query);
            $this->fecha = htmlspecialchars(strip_tags($this->fecha));
            $this->hora = htmlspecialchars(strip_tags($this->hora));
            $stmt->bindParam(":paciente_id", $this->paciente_id);
            $stmt->bindParam(":doctor_id", $this->doctor_id);
            $stmt->bindParam(":fecha", $this->fecha);
            $stmt->bindParam(":hora", $this->hora);
            $tag =   $stmt->execute();
            $id = $this->conn->lastInsertId();

            if ($tag) {
                echo json_encode(["exito" => "cita creada", "id" => $id]);
            }
        } catch (\Throwable $err) {
            
            echo json_encode(["error" => "no se pudo crear la cita"]);
        }
    }


    function update()
    {

        try {
            $query = "UPDATE " . $this->table_name . " SET 
            aprobado=:aprobado, 
            doctor_id=:doctor_id  
            WHERE id=:id ";
            $stmt = $this->conn->prepare($query);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->aprobado = htmlspecialchars(strip_tags($this->aprobado));
            $stmt->bindParam(':doctor_id', $this->doctor_id);
            $stmt->bindParam(':aprobado', $this->aprobado);
            $stmt->bindParam(':id', $this->id);

            $tag =   $stmt->execute();

            if ($stmt->execute()) {
                echo json_encode(["exito" => "paciente actualizado", "id" => $this->id]);
            }
        } catch (\Throwable $th) {
            echo json_encode(["error" => "no se pudo actualizar la cita"]);
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
                echo json_encode(["exito" => "cita  eliminada"]);
            }
        } catch (\Throwable $th) {
            echo json_encode(["error" => "no se pudo eliminar la cita"]);
        }
    }

    function search($keywords)
    {
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = '%' . $keywords . '%';

        $sql = "SELECT  id, doctor_id, paciente_id, fecha, hora FROM " .  $this->table_name .  " WHERE  fecha LIKE :fecha ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':fecha', $keywords);
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
