<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Admin</title>
<link href="css/eve.css" type="text/css" rel="stylesheet">
<script src="js/lib/jquery-1.11.0.min.js"></script>
<link href="ui/bootstrap/css/united.bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="ui/purecss/grids-min.css" type="text/css" rel="stylesheet">
<script src="ui/bootstrap/js/bootstrap.min.js"></script>
<script src="ui/bootstrap/js/bootswatch.js"></script>
</head>
<body>
<div class="container">

  <div class="row">
    <div class="col-sm-4 col-md-4 col-xs-10 col-lg-3 form-login">
      <!--
      <p class="text-center logo">
        <img src="http://comuniqueseeconquiste.com.br/img/menu_esquerda.png" alt="Logo">
      </p>
      -->
      <form class="form-horizontal">
        <fieldset>
          <legend>Área Restrita</legend>
          <div class="form-group">
            <label for="inputLogin" class="col-lg-12 control-label">Login</label>
            <div class="col-lg-12">
              <input type="text" class="form-control" id="inputLogin">
            </div>
          </div>
          
          <div class="form-group">
            <label for="inputSenha" class="col-lg-12 control-label">Senha</label>
            <div class="col-lg-12">
              <input class="form-control" type="password" id="inputSenha">
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-12">
              <button type="submit" class="btn btn-success btn-block">Entrar</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-4 col-md-4 col-xs-10 col-lg-3 login-opcoes">
      <p>
        <a href="#" class="text-info">Esqueci minha senha</a>
      </p>
    </div>
  </div>
</div>
</body>
</html>