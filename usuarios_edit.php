<?php 
session_start();
include('vistas/vista_head.php');
include_once 'includes/user.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = new User();
    $usuarios = $user->getAllUsuarios();
    $usuario = $user->gsetUserById($id);
    
}
if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $pnombre =  $_POST['pnombre'];
    $snombre =  $_POST['snombre'];
    $appaterno =  $_POST['appaterno'];
    $apmaterno =  $_POST['apmaterno'];

    // ususario
    $usuario = $pnombre[0] . strtolower($appaterno);
    $clave =  $_POST['password'];
    /* 
    =====================================================Verificamos si el usuario existe
    */
    // if ($user->existeUsuario($usuario)) {
    //     $usuario = $usuario . $apmaterno[0] . $apmaterno[1];
    // }

    if ($clave == "") {


        $user->updateUsuario($id, $pnombre, $snombre, $appaterno, $apmaterno, $usuario);
        header('Location: usuarios.php');
        exit;
    } else {

        /* 
        =====================================================REGLAS DE VALIDACION
        */
        if (strlen($clave) < 8) {
            $_SESSION['message'] = "La clave debe tener al menos 8 caracteres";
            $_SESSION['message_type'] = 'danger';
            header('Location: usuarios_edit.php?id=' . $id);
            exit;
        }
        if (!preg_match('/[a-z]/', $clave)) {
            $_SESSION['message'] =  "La clave debe tener al menos una letra minúscula";
            $_SESSION['message_type'] = 'danger';
            header('Location: usuarios_edit.php?id=' . $id);
            exit;
        }
        if (!preg_match('/[A-Z]/', $clave)) {
            $_SESSION['message'] =  "La clave debe tener al menos una letra mayúscula";
            $_SESSION['message_type'] = 'danger';
            header('Location: usuarios_edit.php?id=' . $id);
            exit;
        }
        if (!preg_match('/[0-9]/', $clave)) {
            $_SESSION['message'] =  "La clave debe tener al menos un caracter numérico";
            $_SESSION['message_type'] = 'danger';
            header('Location: usuarios_edit.php?id=' . $id);
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
        $user->updateUsuario($id, $pnombre, $snombre, $appaterno, $apmaterno, $usuario, password_hash($clave, PASSWORD_DEFAULT));
        header('Location: usuarios.php');
        exit;
    }
}

?>



<main class="container p-4">
    <h3 class="bg-info text-light text-center">Modificando Usuario</h3>
    <div class="row">
        <div class="col-md-4">
            <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php $_SESSION['message'] = "";
            } ?>

            <!-- ADD TASK FORM -->
            <div class="card card-body">
                <form action="usuarios_edit.php?id=<?= $id ?>" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nombre" name="pnombre" value="<?= $usuario['p_nombre'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nombre" name="snombre" placeholder="Segundo Nombre" value="<?= $usuario['s_nombre'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="appaterno" name="appaterno" placeholder="Ap. Paterno" value="<?= $usuario['p_apellido'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="apmaterno" name="apmaterno" placeholder="Ap. Materno" value="<?= $usuario['s_apellido'] ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="password" name="password" placeholder="nueva contraseña">
                    </div>
                    <input type="submit" name="update" class="btn btn-primary btn-block" value="Actualizar">
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="usuarios.php" class="btn btn-outline-danger">Cancelar</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mt-2">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Primer Nombre</th>
                                <th scope="col">Segundo Nombre</th>
                                <th scope="col">Ap. Paterno</th>
                                <th scope="col">Ap. Materno</th>
                                <th scope="col">Usuario</th>
                            </tr>
                        </thead>
                        <tbody id="contenedor-lista">
                            <?php foreach ($usuarios as $key => $usuario) { ?>
                                <?php if ($id == $usuario->id) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>


                                        <td><?= $usuario->p_nombre ?></td>
                                        <td><?= $usuario->s_nombre ?></td>
                                        <td><?= $usuario->p_apellido ?></td>
                                        <td><?= $usuario->s_apellido ?></td>
                                        <td><?= $usuario->usuario ?></td>





                                    </tr>
                                <?php endif; ?>



                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('vistas/vista_footer.php') ?>