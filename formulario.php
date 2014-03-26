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
<link href="css/lib/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet">
<script src="ui/bootstrap/js/bootstrap.min.js"></script>
<script src="ui/bootstrap/js/bootswatch.js"></script>
<script src="js/lib/moment-with-langs.min.js"></script>
<script src="js/lib/bootstrap-datetimepicker.min.js"></script>
<script src="js/lib/locales/bootstrap-datetimepicker.pt-BR.js"></script>
<script src="js/tinymce/tinymce.min.js"></script>
<script src="js/script.js"></script>
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
      <li><a href="#">Home</a></li>
      <li class="active">Formulário</li>
    </ul>
    
    <h1>Formulário</h1>
    <hr>
    <form class="form-horizontal">
      <fieldset>
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <div class="form-group">
              <label for="inputTitulo" class="col-lg-12 col-md-12 col-xs-12">Título</label>
              <div class="col-lg-12 col-md-12 col-xs-12">
                <input type="text" name="titulo" id="inputTitulo" class="form-control">
              </div>
              <label for="inputData" class="col-lg-12 col-md-12 col-xs-12">Data</label>
              <div class="col-lg-12 col-md-12 col-xs-12">
                <input type="text" name="data" id="inputData" class="form-control datetime" data-format="dd/MM/yyyy" data-type="date">
              </div>
              
              <label for="inputHora" class="col-lg-12 col-md-12 col-xs-12">Hora</label>
              <div class="col-lg-12 col-md-12 col-xs-12">
                <input type="text" name="data" id="inputHora" class="form-control datetime" data-format="hh:mm" data-type="time">
              </div>
              
              <label class="col-lg-12 col-md-12 col-xs-12">Pré-visualização</label>
              <div class="col-lg-12 col-md-12 col-xs-12">
                <textarea class="form-control richtext-editor"></textarea>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="form-group">
              <label for="inputDataHora" class="col-lg-12 col-md-12 col-xs-12">Data/Hora</label>
              <div class="col-lg-12 col-md-12 col-xs-12">
                <input type="text" name="data" id="inputDataHora" class="form-control datetime" data-format="dd/MM/yyyy hh:mm" data-type="datetime">
                <hr>
              </div>
              
              <label for="inputTags" class="col-lg-12 col-md-12 col-xs-12">Tags</label>
              <div class="col-lg-12 col-md-12 col-xs-12">
                <input type="text" name="tags" id="inputTags" class="form-control">
                <span class="small"><a href="#">Tag 1</a>, <a href="#">Tag 2</a>, <a href="#">Tag 1</a>, <a href="#">Tag 2</a>, <a href="#">Tag 1</a>, <a href="#">Tag 2</a>, <a href="#">Tag 1</a>, <a href="#">Tag 2</a>, <a href="#">Tag 1</a>, <a href="#">Tag 2</a></span>
                <hr>
              </div>
              
              <label for="inputSlug" class="col-lg-12 col-md-12 col-xs-12">Link permanente</label>
              
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">
                      <span class="small">
                        yep.blog.br/posts/
                      </span>
                    </span>
                  <input type="text" name="slug" id="inputSlug" class="form-control small">
                  <span class="input-group-btn">
                    <button class="btn btn-default" title="Link padrão" type="button">
                      <i class="glyphicon glyphicon-link"></i>
                    </button>
                  </span>
                </div>
              </div>
              
            </div>
          </div>
          
        </div>
      </fieldset>
    </form>
  </div>
</div>
</body>
</html>