<?php
include 'db.php';

class User extends DB{
    private $nombre;
    private $username;


    public function userExists($user, $pass){
     
        // $query = $this->connect()->prepare('SELECT * FROM usuario WHERE usuario = :user AND clave = :pass');
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE usuario = :user');
        $query->execute(['user' => $user]);

        if($query->rowCount()){

            while ($fila = $query->fetch()){

                if (password_verify($pass, $fila["clave"])) {
                   
                    return true;
                } else {
                    return false;
                }


            }






        }else{
            return false;
        }
  

    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE usuario = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['p_nombre'];
            $this->usename = $currentUser['usuario'];
        }
    }

    public function setAdmin(){
         
            $this->nombre = "administrador";
            $this->usename = "administrador";
        
    }
    public function getNombre(){
        return $this->nombre;
    }
}
