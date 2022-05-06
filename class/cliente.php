<?php
class crudcliente
{
    private $db;
    function __construct($conn)
    {
        $this->db = $conn;
    }

    public function update($id, $Nombre,$Email,$Fecha_de_ingreso, $Tipo)
    {
        try {
            $stmt = $this->db->prepare("update clientes set Nombre= :Nombre,Email= :Email,Fecha_de_ingreso= :Fecha_de_ingreso, Tipo= :Tipo, where id= :id");
            $stmt->bindParam(":Nombre", $Nombre);
            $stmt->bindParam(":Email", $Email);
            $stmt->bindParam(":Fecha_de_ingreso", $Fecha_de_ingreso);
            $stmt->bindParam(":Tipo", $Tipo);
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
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function delete($Id)
    {
        $stmt = $this->db->prepare("DELETE  FROM clientes WHERE id=:id");
        $stmt->bindparam(":id", $Id);
       $stmt->execute();
        return true;
    }

    //Muestra los datos en la tabla
    public function datacliente($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute() > 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['Nombre']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['Fecha_de_ingreso']; ?></td>
                <td><?php echo $row['Tipo']; ?></td>
                
                <td>
                <a class="btn btn-large btn-success" href="edit_cliente.php?edit_id=<?php echo $row['id'] ?>"> Editar</a>
                </td>
                <td>
                <a class="btn btn-large btn-danger" href="eliminar_cliente.php?delete_id=<?php echo $row['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
                </td>
            </tr>

<?php

        }
    }
}