<?php 
use Cake\Cache\Cache;
$cakeDescription = 'Boletín | Unisimon';?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon','icon.ico') ?>
    <?php echo $this->Html->css(['font-awesome.min'],['media' => 'screen,projection']) ?>
    <?php echo $this->Html->css('materialize') ?>
    <?php echo $this->Html->css('materialize.min') ?>
    <?php echo $this->Html->script('plugin-min') ?>
    <?php echo $this->Html->script('materialize') ?>
    <?php echo $this->Html->script('materialize.min') ?>
</head>
<body>
  <!--Barra Superior, contiene las opciones de Login, singin and contact -->
  <nav class="green darken-3 ">
    <div class="nav-wrapper">
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
      <?php if(!$this->request->getSession()->check('Auth.User')){?>
        <li><?= $this->Html->link('| INGRESAR',array('controller' => 'BolRegistro', 'action' => 'login'));?></li>
        <li><?= $this->Html->link('| REGISTRATE',array('controller' => 'BolRegistro', 'action' => 'add'));  ?></li>
        <li><?= $this->Html->link('| CONTACTO',array('controller' => 'Home', 'action' => 'contacto'));?></li>
      <?php }else{ ?>
        <li>
          <a href="#!" class="dropdown-button" data-activates='dropdown2'>
          <?= $this->Html->image('perfiles/'.$this->request->getSession()->read('Auth.User.ImgPerfil'), ['class' => 'circle responsive-img dropdown-button white-text', 'width' => '30px']) ?>
            <b class="white-text">
              <?= $this->request->getSession()->read('Auth.User.Nombres','','Auth.User.Apellidos')?> | 
              <?= $this->request->getSession()->read('Auth.User.Rol')?>
            </b>
            <b class=" white-text fa fa-caret-down"></b>
          </a>      
        </li>
        <ul id='dropdown2' class='dropdown-content'>
        <b>
          <div class="container">
            <div class="form-group">
              <?php echo $this->Html->link('<b class="green-text fa fa-inbox"></b> Administrador',array('controller' => 'BolRegistro', 'action' => 'roles'),
                    ['escape'    => false]);  ?>
            </div>
            <li class="divider"></li>
            <div class="form-group">
              <?php echo $this->Html->link('<b class="green-text fa fa-sign-out"></b> Cerrar Sesión',array('controller'=>'BolRegistro','action'=>'logout'),
                    ['escape'    => false]);  ?>
            </div>
          </div>
        </b>
        </ul>
      <?php } ?>
      </ul>
    </div>
  </nav>
  <ul class="sidenav" id="mobile-demo">
    <li><a href="sass.html">Sass</a></li>
    <li><a href="badges.html">Components</a></li>
    <li><a href="collapsible.html">Javascript</a></li>
    <li><a href="mobile.html">Mobile</a></li>
  </ul>
  <!--Barra que contiene las secciones Investigación etc -->
  <nav class="white nav-extended nav-center">
    <div class="white center nav-content">
      <br>
      <?= $this->html->image('usb.png',['url' => array('controller' => 'Home', 'action' => 'index'),'class' => 'responsive-img']); ?>
    </div>
    
    <div class="nav-wrapper container">
      <ul id="nav-mobile">
        <li><?= $this->Html->link('Inicio',array('controller' => 'Home', 'action' => 'index'),['class'=>'black-text text-lighten-2']);  ?></li>
        <li><?= $this->Html->link('Investigación',array('controller' => 'Home', 'action' => 'investigacion'),['class'=>'black-text text-lighten-2']);  ?></li>
        <li><?= $this->Html->link('Docencia',array('controller' => 'Home', 'action' => 'docencia'),['class'=>'black-text text-lighten-2']);  ?></li>
        <li><?= $this->Html->link('Internacionalización',array('controller' => 'Home', 'action' => 'internacionalizacion'),['class'=>'black-text text-lighten-2']);  ?></li>
        <li><?= $this->Html->link('Convocatorias',array('controller' => 'Home', 'action' => 'convocatorias'),['class'=>'black-text text-lighten-2']); ?></li>
        <li><?= $this->Html->link('Eventos',array('controller' => 'Home', 'action' => 'eventos'),['class'=>'black-text text-lighten-2']); ?></li>
        <li><?= $this->Html->link('De Interés',array('controller' => 'Home', 'action' => 'intereses'),['class'=>'black-text text-lighten-2']);  ?></li>
        <li class="black-text text-lighten-2"> | </li>
        <li><a target="_blank" class="black-text text-lighten-2" href="https://www.facebook.com/IngUnisimon"><i class="fa fa-facebook"></i></a></li>
        <li><a target="_blank" class="black-text text-lighten-2" href="https://twitter.com/IngUnisimon"><i class="fa fa-twitter"></i></a></li>
        <li><a target="_blank" class="black-text text-lighten-2" href="https://www.linkedin.com/in/facultad-de-ingenier%C3%ADa-unisim%C3%B3n-901729139/"><i class="fa fa-linkedin"></i></a></li>
        <li><a target="_blank" class="black-text text-lighten-2" href="https://www.instagram.com/ingunisimon/"><i class="fa fa-instagram"></i></a></li>
      </ul>
    </div>
  </nav>
  <!--Añadir contenido al layout -->
  <div>
    <?= $this->fetch('content') ?>
  </div>
  <footer class="page-footer  blue-grey darken-4">
      <div class="container">
      <div class="row">
        <div class="col l3 s12">
        <h5 class="green-text">La Univeridad</h5>
          <ul>
            <b>
            <li><a class="white-text" href="http://www.unisimon.edu.co/launiversidad/">Bienvenida del Rector</a></li>
            <li><a class="white-text" href="http://www.unisimon.edu.co/servicios/multimedia">Historia</a></li>
            <li><a class="white-text" href="">Misión y Visión</a></li>
            <li><a class="white-text" href="">Principios y Valores<br>Institucionales</a></li>
            <li><a class="white-text" href=http://www.unisimon.edu.co/launiversidad/">Sala General</a></li>
            <li><a class="white-text" href="">Organigrama</a></li>
            <li><a class="white-text" href="http://www.unisimon.edu.co/servicios/multimedia">Historia Gráfica</a></li>
            <li><a class="white-text" href="http://www.unisimon.edu.co/launiversidad/">Vicerrectorías</a></li>
            <li><a class="white-text" href="">Normativa General</a></li>
            <li><a class="white-text" target="_blank" href="http://www.unisimon.edu.co/administrador/img/universidad-simon-bolivar-2e152.pdf">Estatuto Corporativo</a></li>
            </b>
          </ul>
        </div>
        <div class="col l3 s12">
        <br><br>
          <ul>
           <b>
            <li><a class="white-text" target="_blank" href="http://www.unisimon.edu.co/administrador/img/universidad-simon-bolivar-9d3cf.pdf">Proyecto Educativo Institucional</a></li>
            <li><a class="white-text" href="" target="_blank">Plan Estratégico</a></li>
            <li><a class="white-text" target="_blank" href="http://www.unisimon.edu.co/administrador/img/universidad-simon-bolivar-31e7a.pdf"> Reglamento Interno de Trabajo</a></li>
            <li><a class="white-text" target="_blank" href="http://www.unisimon.edu.co/reglamento_estudiantil.pdf">Reglamento Estudiantil</a></li>
            <li><a class="white-text" target="_blank" href="http://www.unisimon.edu.co/administrador/img/universidad-simon-bolivar-97552.pdf">Política de privacidad de<br>datos personales</a></li>
           </b>
          </ul>
        </div>
        <div class="col l3 s12">
        <h5 class="green-text">La Comunidad</h5>
          <ul>
           <b>
           <li><a class="white-text" target="_blank" href="http://www.unisimon.edu.co/aspirantes">Aspirantes</a></li>
           <li><a class="white-text" target="_blank" href="http://www.unisimon.edu.co/portales">Estudiantes</a></li>
           <li><a class="white-text" href="http://portaltrabajo.unisimonbolivar.edu.co/ingresarcandidato/" target="_blank">Egresados</a></li>
           <li><a class="white-text" href="http://www.unisimon.edu.co/portales">Profesores y<br>Administrativos</a></li>
           </b>
          </ul>
        </div>
        <div class="col l3 s12">
        <h5 class="green-text">Enlaces de Interés</h5>
          <ul>
           <b>
           <li><a class="white-text" target="_blank" href="http://www.unisimon.edu.co/servicios/lenguasextranjeras">Lenguas Extranjeras</a></li>
           <li><a class="white-text" target="_blank" href="http://www.unisimon.edu.co/servicios/teatro">Teatro Jose Consuegra Higgins</a></li>
           <li><a class="white-text" target="_blank" href="http://www.unisimon.edu.co/servicios/centrodedocumentos">Centro de Documentos</a></li>
           <li><a class="white-text" target="_blank" href="http://www.unisimon.edu.co/servicios/serviciosexternos">Servicios Externos</a></li>
           <li><a class="white-text" target="_blank" href="http://www.unisimon.edu.co/servicios/cesu">CESU</a></li>
           </b>
          </ul>
        </div>
      </div>  
    </div>
    <div class="footer-copyright black">
      <div class="container">
      <a class="white-text text-lighten-3" href="http://www.unisimon.edu.co">Universidad Simón Bolívar</a>. Todos los derechos reservados &copy; Vigilada MINEDUCACION | Diseño: Rafael Cabeza Gordillo, Andy Padilla Manotas.
      </div>
    </div>
  </footer>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-5745747-1']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
</body>
</html>