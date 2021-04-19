<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- css boostrap -->
    <link rel="stylesheet" href='public/css/bootstrap.min.css'>

    <!-- css mis estilos -->
    <link rel="stylesheet" href="public/css/styles.css">

</head>

<body onload="createCaptcha()">


    <!-- CONTENIDO -->
    <div class="login-box">
        <div class="container">

            <div class="row justify-content-md-center">
                <div class="col-md-4 ">

                    <div class="card">

                        <div class="imagen-box">
                            <div class="card-imagen">
                                <img class="card-img-top" src="public/icons/avatar.png" alt="Card image cap">

                            </div>
                        </div>

                        <div class="card-body mt-5">
                            <form id="form_nuevo_usuario">
                                <div class="form-group">
                                    <label for="inp_usuario">Usuario</label>
                                    <input type="text" class="form-control" id="inp_usuario" name="username" aria-describedby="emailHelp" placeholder="Ingrese nombre de usuario">

                                </div>
                                <div class="form-group">
                                    <label for="inp_password">Clave</label>
                                    <input type="password" class="form-control" id="inp_password" name="password" placeholder="************">
                                </div>
                                <!-- captcha -->
                                <div id="captcha">
                                </div>
                                <input type="text" placeholder="Ingrese Captcha" id="cpatchaTextBox" />
                                <!--  -->
                                <button type="submit" class="btn btn-primary btn-block mt-5">Ingresar</button>
                            </form>
                        </div>
                        <div id="errorcito" class="card-footer">
                            <!-- mensaje -->
                            
                            <!-- mensaje fin -->
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <!-- CONTENIDO -->

    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/app.js"></script>


</body>

</html>