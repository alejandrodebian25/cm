<?php 
 session_start();
include('vistas/vista_head.php');
include_once 'includes/user.php';
 $user = new User();
 $usuarios=$user->getAllUsuarios();

?>



<main class="container p-4">
    <div class="row">
        <div class="col-md-4">
            <?php if (isset($_SESSION['message'])&& !empty($_SESSION['message'])) { ?>
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
                <form action="usuarios_store.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nombre" name="pnombre" placeholder="Primer Nombre">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nombre" name="snombre" placeholder="Segundo Nombre">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="appaterno" name="appaterno" placeholder="Ap. Paterno">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="apmaterno" name="apmaterno" placeholder="Ap. Materno">
                    </div>
                                        
                    <div class="form-group">
                        <input type="text" class="form-control" id="password" name="password" placeholder="***********">
                    </div>
                    <input type="submit" name="save_task" class="btn btn-primary btn-block" value="Agregar Usuario">
                </form>
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
                           

                            <th scope="col">Accion</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="contenedor-lista">
                        <?php foreach ($usuarios as $key => $usuario) { ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                             

                                <td><?= $usuario->p_nombre ?></td>
                                <td><?= $usuario->s_nombre ?></td>
                                <td><?= $usuario->p_apellido ?></td>
                                <td><?= $usuario->s_apellido ?></td>
                                <td><?= $usuario->usuario ?></td>
                               

                                <td>
                                    <a href="usuarios_edit.php?id=<?=$usuario->id ?>" type="button" class="edit_pro btn btn-sm btn-outline-warning">
                                        <img src="public/icons/edit.png" alt="">
                                    </a>
                                    <a href="usuarios_delete.php?id=<?=$usuario->id ?>"  type="button" class="delete_pro btn btn-sm btn-outline-danger">
                                        <img src="public/icons/delete.png" alt="">
                                    </a>

                                </td>


                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</main>

<?php include('vistas/vista_footer.php') ?>