<?php 
use Cake\Cache\Cache;
$cakeDescription = 'Boletín | Coordinador';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>
        <?= $cakeDescription ?>
    </title>
    
    <?= $this->Html->meta('icon','icon.ico') ?>
    <?php echo $this->Html->script('jquery-3.1.1.min') ?>
    <?= $this->Html->meta(['name'=>'viewport'],['content'=>'width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no']) ?>
    <?php echo $this->Html->css(['plugin-min','font-awesome.min'],['media' => 'screen,projection']) ?>
    <?php echo $this->Html->script('plugin-min') ?>
    <?php echo $this->Html->script('custom-min') ?>
    <?php echo $this->Html->css('bootstrap') ?>
    <?php echo $this->Html->script('ckeditor') ?>
</head>
<!--<style type="text/css">
  body {
        height: 80%;
        min-width: 320px;
        background-image: url('../img/cover.jpg');
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
  }
</style>-->
<body>
    <header>
    <div class="navbar-fixed">
    <nav class="green darken" role="navigation" id="nav_f">
        <div class="nav-wrapper">
          <ul class="right hide-on-med-and-down">
            <li>
              <div class="input-field">
                <input id="filtrar" type="text" placeholder="Buscar" class="flow-text">
                <label class="label-icon"><p class="fa fa-search white-text"></p></label>
              </div>
            </li>
            <li>
               <a href="#!" class="dropdown-button" data-activates='dropdown2' title="Opciones de usuario">
                <?= $this->Html->image('perfiles/'.$this->request->session()->read('Auth.User.ImgPerfil'), ['alt' => 'userimage', 'class' => 'circle responsive-img waves-effect waves-light dropdown-button', 'width' => '30px']); ?>  
                <b class="white-text">
                <?= $this->request->session()->read('Auth.User.Username')?> | 
                <?= $this->request->session()->read('Auth.User.Rol')?></b>
                <b class=" white-text fa fa-caret-down"></b>
                </a>
            </li>
          </ul>
          <ul id='dropdown2' class='dropdown-content'>
            <div class="container">
              <div class="form-group">
                <?= $this->Html->link('<b class="green-text fa fa-user"></b> <b>Mi perfil</b> ',['controller' => 'Coordinador', 'action' => 'editar'],['escape'    => false])?>
              </div>
              <li class="divider"></li>
              <div class="form-group">
                <?= $this->Html->link('<b class="green-text fa fa-sign-out"></b> <b>Salir</b>',['controller' => 'BolPublicacion', 'action' => 'logout'],['escape'    => false])?>
              </div>
            </div>
         </ul>
          <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        </div>
    </nav>
    </div>
      <ul class="side-nav fixed" style="transform: translateX(0px);">
        <li class="logo"><?= $this->html->image('unisimon.png',['url' => array('controller' => 'Home', 'action' => 'index'),'class' => 'responsive-img']); ?></li>
        <br><br><br><br>
        <div class="divider"></div>
        <li title="Ir al inicio"><?= $this->Html->link('<i class="fa fa-home nav_icon"></i> Inicio',['controller' => 'Home', 'action' => 'index'],['escape'    => false])?></li><span class="new badge green"><?php echo $nump ?></span>
        <li title="Solicitudes de publicación"><?= $this->Html->link('<i class="fa fa-inbox nav_icon"></i> Recibidos',['controller' => 'Coordinador', 'action' => 'coordinador'],['escape'    => false])?></li><span class="new badge green"><?php echo $num ?></span>
        <li title="Mensajes Recibidos"><?= $this->Html->link('<i class="fa fa-inbox nav_icon"></i> Mensajes',['controller' => 'Coordinador', 'action' => 'contacto'],['escape'    => false])?></li>
        <li title="Crear publicación"><?= $this->Html->link('<i class="fa fa-edit nav_icon"></i> Crear Publicación',['controller' => 'Coordinador', 'action' => 'add'],['escape'    => false])?></li>
        <li title="Publicaciones enviadas"><?= $this->Html->link('<i class="fa fa-external-link nav_icon"></i> Enviadas',['controller' => 'Coordinador', 'action' => 'enviadas'],['escape'    => false])?></li>
        <li title="Usuarios registrados"><?= $this->Html->link('<i class="fa fa-user nav_icon"></i> Usuarios',['controller' => 'Coordinador', 'action' => 'usuarios'],['escape'    => false])?></li>
        <li title="Multimedia"><?= $this->Html->link('<i class="fa fa-picture-o nav_icon"></i> Multimedia',['controller' => 'Coordinador', 'action' => 'multimedia'],['escape'    => false])?></li>
        <div class="divider"></div>
      </ul>
      <ul id="nav-mobile" class="side-nav" style="transform: translateX(0px);">
        <li title="Ir al inicio"><?= $this->Html->link('<i class="fa fa-home nav_icon"></i> Inicio',['controller' => 'Home', 'action' => 'index'],['escape'    => false])?></li>
        <li title="Solicitudes de publicación"><?= $this->Html->link('<i class="fa fa-inbox nav_icon"></i> Recibidos',['controller' => 'Coordinador', 'action' => 'coordinador'],['escape'    => false])?></li><span class="new badge green"><?= $this->Flash->render('num') ?></span>
        <li title="Mensajes Recibidos"><?= $this->Html->link('<i class="fa fa-inbox nav_icon"></i> Mensajes',['controller' => 'Coordinador', 'action' => 'contacto'],['escape'    => false])?></li>
        <li title="Crear nueva publicación"><?= $this->Html->link('<i class="fa fa-edit nav_icon"></i> Crear',['controller' => 'Coordinador', 'action' => 'add'],['escape'    => false])?></li>
        <li title="Publicaciones enviadas"><?= $this->Html->link('<i class="fa fa-external-link nav_icon"></i> Enviadas',['controller' => 'Coordinador', 'action' => 'enviadas'],['escape'    => false])?></li>
        <li title="Usuarios registrados"><?= $this->Html->link('<i class="fa fa-user nav_icon"></i> Usuarios',['controller' => 'Coordinador', 'action' => 'usuarios'],['escape'    => false])?></li>
        <li title="Multimedia"><?= $this->Html->link('<i class="fa fa-picture-o nav_icon"></i> Multimedia',['controller' => 'Coordinador', 'action' => 'multimedia'],['escape'    => false])?></li>
        <li><?= $this->Html->link('<b class="green-text fa fa-sign-out"></b> <b>Salir</b>',['controller' => 'BolPublicacion', 'action' => 'logout'],['escape'    => false])?></li>
      </ul>
    </header>
    <div>
        <?= $this->fetch('content') ?>
    </div>
     <!-- Evita dar click derecho -->
</body>
</html>



