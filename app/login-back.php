<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>GISP v1.1.1</title>
    <link rel="icon" type="image/png" href="icone.png">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
.login-block{
    background: rgb(2,0,36);
background: -moz-linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);
background: -webkit-linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);
background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#020024",endColorstr="#00d4ff",GradientType=1);
float:left;
width:100%;
padding : 50px 0;
}
.banner-sec{background:url(logo.png)  no-repeat center bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}

@media screen and (max-width: 850px) {
    .banner-sec {
        /*display: none;*/
        background:url(icone.png)  no-repeat center bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;
    }
}


.container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
.carousel-inner{border-radius:0 10px 10px 0;}
.carousel-caption{text-align:left; left:5%;}
.login-sec{padding: 50px 30px; position:relative;}
.login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
.login-sec .copy-text i{color:#FEB58A;}
.login-sec .copy-text a{color:#E36262;}
.login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #020024;}
.login-sec h2:after{content:" "; width:100px; height:5px; background:#020024; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
.btn-login{background: #DE6262; color:#fff; font-weight:600;}
.banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
.banner-text h2{color:#fff; font-weight:600;}
.banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
.banner-text p{color:#fff;}
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body class="login-block">
<section >
    <div class="container">
	<div class="row">
        <div class="col-md-4 login-sec">
            <h2 class="text-center">ÁREA RESTRITA</h2>
            <form class="login-form" id="form-login" method="post">

            <div class="form-group">
            <input type="text" class="form-control" placeholder="Digite seu usuário" name="usuario" required/>
            </div>
            <div class="form-group">
            <input type="password" class="form-control" placeholder="Digite sua senha" name="senha" required/>
            </div>

            <div class="form-group">
                <select type="text" class="form-control" name="tipo" required>
                <option value="1">Admin</option>
                <option value="2">Staff</option>
                </select>
            </div>


            <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block float-right"><b>Acessar</b></button>
            </div>

            <div class="row"></div><br />
            <div class="form-group" id="retorno"></div>

            </form>
            <div class="copy-text">&copy; GISP v1.1.1 - Sistema de Gestão para seu Provedor e redes corporativas.</div>
		</div>
		<div class="col-md-8 banner-sec"></div>
</div>
</section>
<script>
    $('#form-login').submit(function(){
        $('#aguarde').show().attr('disabled',true).text('Aguarde, Processando...');
        $.ajax({
          type:'POST',
          url:'proc_login.php',
          data:$('#form-login').serialize(),
          success:function(data){
            $('#retorno').show().fadeOut(6000).html(data);
            $('#aguarde').show().attr('disabled',false).text('ENTRAR');
          }
        });
        return false;
      });
    
      document.onmousedown=disableclick; /* Não permite clique com btn Direito do mouse */
    function disableclick(event)
    {
      if(event.button==2)
       {
         return false;    
       }
    }
    
    </script>
</body>
</html>




