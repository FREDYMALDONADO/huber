<?php
class crudmotorista
{
    private $db;
    function __construct($conn)
    {
        $this->db = $conn;
    }

    public function update($id, $Nombre,$Fecha_de_nacimiento,$Fecha_de_ingreso)
    {
        try {
            $stmt = $this->db->prepare("update motorista set Nombre= :Nombre,Fecha_de_nacimiento= :Fecha_de_nacimiento,Fecha_de_ingreso= :Fecha_de_ingreso, where id= :id");
            $stmt->bindParam(":Nombre", $Nombre);
            $stmt->bindParam(":Fecha_de_nacimiento", $Fecha_de_nacimiento);
            $stmt->bindParam(":Fecha_de_ingreso", $Fecha_de_ingreso);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // echo $e->getMessage();
            // return false;
            throw $e;
        }
    }
    public function getID($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM motorista WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function delete($Id)
    {
        $stmt = $this->db->prepare("DELETE  FROM motorista WHERE id=:id");
        $stmt->bindparam(":id", $Id);
       $stmt->execute();
        return true;
    }

    //Muestra los datos en la tabla
    public function datamotorista($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute() > 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['Nombre']; ?></td>
                <td><?php echo $row['Fecha_de_nacimiento']; ?></td>
                <td><?php echo $row['Fecha_de_ingreso']; ?></td>
                
                
                <td>
                <a class="btn btn-large btn-success" href="edit_motorista.php?edit_id=<?php echo $row['id'] ?>"> Editar</a>
                </td>
                <td>
                <a class="btn btn-large btn-danger" href="eliminar_motorista.php?delete_id=<?php echo $row['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
                </td>
            </tr>

<?php

        }
    }
}