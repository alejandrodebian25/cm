<?php
session_start();



if(isset($_GET['id'])) {
    include_once 'includes/user.php';
    $id = $_GET['id'];
    $user = new User();
    if($user->eliminarUsuario($id)==-1){
        echo "Error BD";
    }
    
 
  
    $_SESSION['message'] = 'Usuario Eliminado Exitosamente';
    $_SESSION['message_type'] = 'info';
    header('Location: usuarios.php');
  }
  