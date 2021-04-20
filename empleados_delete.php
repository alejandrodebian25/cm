<?php
session_start();



if(isset($_GET['id'])) {
    include_once 'includes/empleado.php';
    $id = $_GET['id'];
    $emp = new Empleado();
    if($emp->eliminarEmpleado($id)==-1){
        echo "Error BD";
    }
    
 
  
    $_SESSION['message'] = 'Usuario Eliminado Exitosamente';
    $_SESSION['message_type'] = 'info';
    header('Location: empleados.php');
  }
  