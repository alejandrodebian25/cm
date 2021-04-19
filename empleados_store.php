<?php
session_start();
include_once 'includes/empleado.php';
$empleado = new Empleado();
// if (!isset($_POST('guardarEmpleado'))) {
//     header('Location: empleados.php');
// }
$pnombre =  $_POST['pnombre'];
$snombre =  $_POST['snombre'];
$appaterno =  $_POST['appaterno'];
$apmaterno =  $_POST['apmaterno'];


$genero =  $_POST['genero'];
$celular =  $_POST['celular'];
$dir =  $_POST['dir'];



// ==========================================Imagenes

$imagen=$_FILES['imagen']['tmp_name'];
if ($imagen==null) {
	$imag='';
}else{
	if ($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/jpeg" || 
		$_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/gif") {
		$ext=explode(".", $_FILES['imagen']['name']);
		$ima=round(microtime(true)).'.'.end($ext);
		move_uploaded_file($_FILES['imagen']['tmp_name'], "imagenes/emp_".$ima);
		$imag="emp_".$ima;
	}
}



// ==========================================Imagenes

$empleado->insertarEmpleado($pnombre, $snombre, $appaterno, $apmaterno, $genero, $celular,$dir,$imag);
header('Location: empleados.php');