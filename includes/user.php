<?php
include 'db.php';

class User extends DB
{
    private $nombre;
    private $username;


    public function userExists($user, $pass)
    {

        // $query = $this->connect()->prepare('SELECT * FROM usuario WHERE usuario = :user AND clave = :pass');
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE usuario = :user');
        $query->execute(['user' => $user]);


       

        if ($query->rowCount()) {

            while ($fila = $query->fetch()) {
                
                if (password_verify($pass, $fila["clave"])) {

                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function setUser($user)
    {
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE usuario = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['p_nombre'];
            $this->usename = $currentUser['usuario'];
        }
    }

    public function setAdmin()
    {

        $this->nombre = "administrador";
        $this->usename = "administrador";
    }
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getAllUsuarios()
    {
        $query = $this->connect()->prepare('SELECT * FROM usuario');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertarUsuario($p_nombre, $s_nombre, $p_apellido, $s_apellido, $usuario, $clave)
    {
        $consulta = $this->connect()->prepare('INSERT INTO usuario ( p_nombre,s_nombre,p_apellido,s_apellido,usuario,clave) VALUES( :p_nombre,:s_nombre,:p_apellido,:s_apellido,:usuario,:clave)');
        $consulta->bindParam(':p_nombre', $p_nombre);
        $consulta->bindParam(':s_nombre', $s_nombre);
        $consulta->bindParam(':p_apellido', $p_apellido);
        $consulta->bindParam(':s_apellido', $s_apellido);
        $consulta->bindParam(':usuario', $usuario);
        $consulta->bindParam(':clave', $clave);

        $consulta->execute();
        // p_nombre,s_nombre,p_apellido,s_apellido,usuario,clave

    }

    public function eliminarUsuario($id)
    {
        $consulta = "DELETE FROM usuario WHERE id=:id";
        $sql = $this->connect()->prepare($consulta);
        $sql->bindParam(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $count = $sql->rowCount();
            return $count;
        }
        return -1;
    }
    public function gsetUserById($id)
    {
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE id = :user');
        $query->execute(['user' => $id]);
        $data = [];
        foreach ($query as $currentUser) {
            $data['p_nombre'] = $currentUser['p_nombre'];
            $data['s_nombre'] = $currentUser['s_nombre'];
            $data['p_apellido'] = $currentUser['p_apellido'];
            $data['s_apellido'] = $currentUser['s_apellido'];
            $data['usuario'] = $currentUser['usuario'];
            $data['clave'] = $currentUser['clave'];
        }
        return $data;
        // p_nombre,s_nombre,p_apellido,s_apellido,usuario,clave
    }
    public function updateUsuario($id, $p_nombre, $s_nombre, $p_apellido, $s_apellido, $usuario, $clave = "")
    {

if($clave==""){
    $consulta = "UPDATE usuario
        SET `p_nombre`= :p_nombre, `s_nombre` = :s_nombre, `p_apellido` = :p_apellido, `s_apellido` = :s_apellido, `usuario` = :usuario
        WHERE `id` = :id";
        $sql = $this->connect()->prepare($consulta);
        $sql->bindParam(':p_nombre', $p_nombre);
        $sql->bindParam(':s_nombre', $s_nombre);
        $sql->bindParam(':p_apellido', $p_apellido);
        $sql->bindParam(':s_apellido', $s_apellido);
        $sql->bindParam(':usuario', $usuario);

        $sql->bindParam(':id', $id);
}else{

    $consulta = "UPDATE usuario
        SET `p_nombre`= :p_nombre, `s_nombre` = :s_nombre, `p_apellido` = :p_apellido, `s_apellido` = :s_apellido, `usuario` = :usuario,`clave` = :clave
        WHERE `id` = :id";
        $sql = $this->connect()->prepare($consulta);
        $sql->bindParam(':p_nombre', $p_nombre);
        $sql->bindParam(':s_nombre', $s_nombre);
        $sql->bindParam(':p_apellido', $p_apellido);
        $sql->bindParam(':s_apellido', $s_apellido);
        $sql->bindParam(':usuario', $usuario);
        $sql->bindParam(':clave', $clave);
        $sql->bindParam(':id', $id);

}

    
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql->rowCount();
        } else {
            return -1;
        }
    }
}
