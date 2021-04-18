<?php
session_start();
include_once 'includes/user.php';
$user = new User();

$pnombre =  $_POST['pnombre'];
$snombre =  $_POST['snombre'];
$appaterno =  $_POST['appaterno'];
$apmaterno =  $_POST['apmaterno'];

// ususario
$usuario = $pnombre[0] . strtolower($appaterno);
$clave =  $_POST['password'];

/* 
=====================================================REGLAS DE VALIDACION
*/
if (strlen($clave) < 8) {
    $_SESSION['message'] = "La clave debe tener al menos 8 caracteres";
    $_SESSION['message_type'] = 'danger';
    header('Location: usuarios.php');
    exit;
}
if (!preg_match('/[a-z]/', $clave)) {
    $_SESSION['message'] =  "La clave debe tener al menos una letra minúscula";
    $_SESSION['message_type'] = 'danger';
    header('Location: usuarios.php');
    exit;
}
if (!preg_match('/[A-Z]/', $clave)) {
    $_SESSION['message'] =  "La clave debe tener al menos una letra mayúscula";
    $_SESSION['message_type'] = 'danger';
    header('Location: usuarios.php');
    exit;
}
if (!preg_match('/[0-9]/', $clave)) {
    $_SESSION['message'] =  "La clave debe tener al menos un caracter numérico";
    $_SESSION['message_type'] = 'danger';
    header('Location: usuarios.php');
    exit;
}
// caracteres especiales
$ALLOW_CHARS = "! # $ % & ' ( ) * + , - . / : ; < = > ? @ [ \ ] ^ _` { | } ~";

$len = strlen($clave);
for ($i = 0; $i < $len; $i++) {
    // $arr[] = mb_substr($clave, $i, $i + 1, "UTF-8");
    $arr[] = $clave[$i];
}
$sw = false;
for ($i = 0; $i < $len; $i++) {
    if (strpbrk($arr[$i], $ALLOW_CHARS)) {
        $sw = true;
        break;
    }
}
if (!$sw) {
    $_SESSION['message'] =  "La clave debe tener al menos un caracter especial";
    $_SESSION['message_type'] = 'danger';
    header('Location: usuarios.php');
    exit;
}
// caracteres especiales

$_SESSION['message'] =  "Se guardo exitosamente.";
$_SESSION['message_type'] = 'success';

/* 
=====================================================REGLAS DE VALIDACION
*/
// validar password


$user->insertarUsuario($pnombre, $snombre, $appaterno, $apmaterno, $usuario, password_hash($clave, PASSWORD_DEFAULT));
header('Location: usuarios.php');
