<?php include('vistas/vista_head.php') ?>





<div class="jumbotron mt-5">
    <h1 class="display-3">Hola, Bienvenido! <?php echo $user->getNombre();  ?></h1>
    <p class="lead">Este es un pequeño aplicativo.</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="includes/logout.php" role="button">Learn more</a>
    </p>
</div>


<?php include('vistas/vista_footer.php') ?>