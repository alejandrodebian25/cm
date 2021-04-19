<?php
include_once 'includes/user.php';
include_once 'includes/user_session.php';


$userSession = new UserSession();
$user = new User();

if (isset($_SESSION['user'])) {
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    include_once 'home.php';
} else if (isset($_POST['username']) && isset($_POST['password'])) {

    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    if ($userForm == "admin") {
        $userSession->setCurrentUser($userForm);
        $user->setAdmin();
        include_once 'home.php';
        exit;
    }


    $user = new User();
    if ($user->userExists($userForm, $passForm)) {
        //echo "Existe el usuario";
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

        include_once 'home.php';
    } else {
        //echo "No existe el usuario";
        echo "0";
        // include_once 'login.php';
    }
} else {
    //echo "login";
    include_once 'login.php';
}
