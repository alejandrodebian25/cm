<?php
include 'db.php';

class Empleado extends DB
{
    private $nombre;
    private $username;


    public function insertarEmpleado($p_nombre, $s_nombre, $p_apellido, $s_apellido, $genero, $celular,$direccion,$fotografia)
    {
        $consulta = $this->connect()->prepare('INSERT INTO empleado ( p_nombre,s_nombre,p_apellido,s_apellido,genero, celular,direccion,fotografia) VALUES( :p_nombre,:s_nombre,:p_apellido,:s_apellido,:genero, :celular,:direccion,:fotografia)');
        $consulta->bindParam(':p_nombre', $p_nombre);
        $consulta->bindParam(':s_nombre', $s_nombre);
        $consulta->bindParam(':p_apellido', $p_apellido);
        $consulta->bindParam(':s_apellido', $s_apellido);
        $consulta->bindParam(':genero', $genero);
        $consulta->bindParam(':celular', $celular);
        $consulta->bindParam(':direccion', $direccion);
        $consulta->bindParam(':fotografia', $fotografia);

        $consulta->execute();
        // p_nombre,s_nombre,p_apellido,s_apellido,usuario,clave

    }
    public function getAllEmpleados()
    {
        $query = $this->connect()->prepare('SELECT * FROM empleado ORDER BY id_empleado DESC');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public function searchEmpleados($cb,$dato)
    {
        $query = $this->connect()->prepare("SELECT * FROM empleado WHERE $cb LIKE :dato");
        $query->execute(['dato' => $dato.'%']);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public function eliminarEmpleado($id)
    {
        $consulta = "DELETE FROM empleado WHERE id_empleado=:id ";
        $sql = $this->connect()->prepare($consulta);
        $sql->bindParam(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $count = $sql->rowCount();
            return $count;
        }
        return -1;
    }





}
