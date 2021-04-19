<?php
session_start();
include('vistas/vista_head.php');
include_once 'includes/empleado.php';
$emp = new Empleado();
$usuarios = $emp->getAllEmpleados();

?>



<main class="container-fluid mt-5">
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

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Empleado</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Buscar</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <form action="empleados_store.php" method="POST" enctype="multipart/form-data" class="p-2">
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

                            <p>Genero</p>

                            <div>
                                <input type="radio" id="huey" name="genero" value="masculino" checked>
                                <label for="huey">Masculino</label>
                            </div>

                            <div>
                                <input type="radio" id="dewey" name="genero" value="femenino">
                                <label for="dewey">Femenino</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="dir" name="dir" placeholder="Direccion">
                            </div>
                            <div class="form-group">
                                <label>Fotografia</label>
                                <input type="file" name="imagen" class="form-control">
                            </div>
                            <input type="submit" name="guardarEmpleado" class="btn btn-primary btn-block" value="Agregar Empleado">
                        </form>

                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- busqueda -->
                        <form action="empleados_search.php" method="POST" enctype="multipart/form-data" class="p-2">


                            <p>Criterio de Busqueda</p>

                            <div>
                                <input type="radio" id="pn" name="cb" value="p_nombre" checked>
                                <label for="pn">1er. Nombre</label>
                            </div>

                            <div>
                                <input type="radio" id="pa" name="cb" value="p_apellido">
                                <label for="pa">1er. Apellido</label>
                            </div>

                            <div>
                                <input type="radio" id="sa" name="cb" value="s_apellido">
                                <label for="sa">2do. Apellido</label>
                            </div>
                            <div>
                                <input type="radio" id="ge" name="cb" value="genero">
                                <label for="ge">Genero</label>
                            </div>
                            <div>
                                <input type="radio" id="cel" name="cb" value="celular">
                                <label for="cel">Nro. Celular</label>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="dato" name="dato" placeholder="">
                            </div>


                            <input type="submit" name="buscarEmpleado" class="btn btn-primary btn-block" value="Buscar">
                        </form>

                        <!-- busqueda -->

                    </div>
                </div>





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
                                <th scope="col">Ap. Paterno</th>
                                <th scope="col">Ap. Materno</th>
                                <th scope="col">Genero</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Accion</th>

                            </tr>
                        </thead>
                        <tbody id="contenedor-lista">
                            <?php foreach ($usuarios as $key => $usuario) { ?>
                                <tr>
                                    <!-- <td><?= $key + 1 ?></td> -->
                                    <td>
                                        <img class="img-thumbnail" src="imagenes/<?= $usuario->fotografia ?>" alt="" width="50px">
                                    </td>


                                    <td><?= $usuario->p_nombre ?></td>

                                    <td><?= $usuario->p_apellido ?></td>
                                    <td><?= $usuario->s_apellido ?></td>
                                    <td><?= $usuario->genero ?></td>
                                    <td><?= $usuario->celular ?></td>
                                    <td><?= $usuario->direccion ?></td>


                                    <td>
                                        <a href="usuarios_edit.php?id=<?= $usuario->id ?>" type="button" class="edit_pro btn btn-sm btn-outline-warning">
                                            <img src="public/icons/edit.png" alt="">
                                        </a>
                                        <a href="usuarios_delete.php?id=<?= $usuario->id ?>" type="button" class="delete_pro btn btn-sm btn-outline-danger">
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