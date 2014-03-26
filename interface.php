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
<div class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a href="#" class="navbar-brand">Cliente YEP</a>
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse" id="navbar-main">
      <ul class="nav navbar-nav">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Nova publicação</a></li>
            <li><a href="#">Ver publicações</a></li>
            <li><a href="#">Relatórios</a></li>
            <li class="divider"></li>
            <li><a href="#">Painel</a></li>
          </ul>
        </li>
        
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Mailing <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Baixar lista</a></li>
            <li><a href="#">Registrar e-mail</a></li>
            <li><a href="#">Relatórios</a></li>
            <li class="divider"></li>
            <li><a href="#">Painel</a></li>
          </ul>
        </li>
        
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Financeiro <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">A receber</a></li>
            <li><a href="#">A pagar</a></li>
            <li><a href="#">Relatório</a></li>
            <li class="divider"></li>
            <li><a href="#">Gerar link de pagamento</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="navbar-responsive-collapse nav navbar-nav navbar-right">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Usuário <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Minha conta</a></li>
            <li><a href="#">Configurações</a></li>
            <li><a href="#">Ajuda</a></li>
            <li class="divider"></li>
            <li><a href="#">Sobre</a></li>
            <li><a href="#"><i class="glyphicon glyphicon-off right"></i> Sair</a></li>
          </ul>
        </li>
      </ul>
      
    </div>
  </div>
</div>



<div id="content">
  <div class="container container-fluid">
    <br>
    <ul class="breadcrumb">
      <li class="active">Home</li>
    </ul>
    
    <h1>Bem-vindo, fulano</h1>
    <hr>
    <div class="row">
      <div class="col-sm-6 col-xs-6 col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">Mensagens <i class="glyphicon glyphicon-envelope right"></i></div>
          <div class="panel-body">
            <p>Você tem <strong>7</strong> mensagens não lidas.
              <br>
              <a href="#">Clique para ler</a>
            </p>
          </div>
        </div>
      </div>
      
      <div class="col-sm-6 col-xs-6 col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">Comentários <i class="glyphicon glyphicon-comment right"></i></div>
          <div class="panel-body">
            <p>Fulano comentou em <a href="#">Publicação de teste 1</a>:</p>
            <i>"Teste"</i>
          </div>
        </div>
      </div>
      
      <div class="col-sm-12 col-xs-12 col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Postagens <i class="glyphicon glyphicon-list right"></i></div>
        
          <div class="panel-body">
            <ul class="list-group">
              <li class="list-group-item"><a href="#">Título da publicação de teste nº1</a><span class="badge hidden-xs">50 visualizações</span></li>
              <li class="list-group-item"><a href="#">Título da publicação de teste nº2</a> <span class="badge hidden-xs">1 visualização</span></li>
            </ul>
          </div>
        </div>
      </div>
      
      <div class="col-sm-12 col-xs-12 col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Visitas <i class="glyphicon glyphicon-stats right"></i></div>
        </div>
      </div>
      
    </div>
  </div>
</div>
</body>
</html>