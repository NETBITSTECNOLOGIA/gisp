<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>GISP v1.1.1</title>
    <link rel="icon" type="dist/image/png" href="icone.png">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="public/style/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/style/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="public/style/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="login-logo">
                <b>ÁREA RESTRITA</b>
            </div>
            <form class="login-form" id="form-login" method="post">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Digite seu e-mail" name="email" required />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Digite sua senha" name="senha" required />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <select type="text" class="form-control" name="tipo" required>
                        <option value="1">Admin</option>
                        <option value="2">Staff</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" id="aguarde">ACESSAR</button>
                    </div>
                    <!-- /.col -->
                </div>
                <br />
                <div class="row">
                    <div class="col-xs-12" id="retorno">

                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <b>
                <center>© GISP v1.1.1 - Sistema de Gestão para seu Provedor e redes corporativas.</center>
            </b>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="public/style/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="public/style/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
    $('#form-login').submit(function() {
        $('#aguarde').show().attr('disabled', true).text('Aguarde, Processando...');
        $.ajax({
            type: 'POST',
            url: 'auth/auth.php',
            data: $('#form-login').serialize(),
            success: function(data) {
                $('#retorno').show().fadeOut(6000).html(data);
                $('#aguarde').show().attr('disabled', false).text('ENTRAR');
            }
        });
        return false;
    });

    document.onmousedown = disableclick; /* Não permite clique com btn Direito do mouse */
    function disableclick(event) {
        if (event.button == 2) {
            return false;
        }
    }
    </script>
</body>

</html>