<?php 
use Cake\Cache\Cache;
$cakeDescription = 'Boletín | Unisimon';?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon','icon.ico') ?>
    <?php echo $this->Html->css('plugin-min') ?>
    <?php echo $this->Html->css('materialize') ?>
    <?php echo $this->Html->script('plugin-min') ?>
</head>
<body id="top" class="scrollspy">
<nav class="green darken-3">
    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
      <ul class="right hide-on-med-and-down">
      <b>
        <li><?= $this->Html->link('Inicio',array('controller' => 'Home', 'action' => 'index'),['escape'=> false, 'class' => 'white-text waves-effect waves-light']);  ?></li>
        <li class="white-text"> | </li>
        <li><?= $this->Html->link('Registrate',array('controller' => 'BolRegistro', 'action' => 'add'),['escape'=> false, 'class' => 'white-text waves-effect waves-light']);  ?></li>
        <li class="white-text"> | </li>
        <li class="tooltipped" data-delay="50" data-tooltip="Contacto y sugerencias"><?= $this->Html->link('Contacto',array('controller' => 'Home', 'action' => 'contacto'),['escape'=> false, 'class' => 'white-text waves-effect waves-light']);  ?></li>
      </b>
      </ul><br>
      <ul id="nav-mobile" class="side-nav" style="transform: translateX(0px);">
        <div class="logo"><?= $this->html->image('usb.png',['url' => array('controller' => 'Home', 'action' => 'index'),'class' => 'responsive-img']); ?></div>
        <b>
        <li><?= $this->Html->link('Inicio',array('controller' => 'Home', 'action' => 'index'),['escape'=> false, 'class' => 'black-text waves-effect waves-light']);  ?></li>
        <li><?= $this->Html->link('Registrate',array('controller' => 'BolRegistro', 'action' => 'add'),['escape'=> false, 'class' => 'black-textwaves-effect waves-light']);  ?></li>
        <li class="tooltipped" data-delay="50" data-tooltip="Contacto y sugerencias"><?= $this->Html->link('Contacto',array('controller' => 'Home', 'action' => 'contacto'),['escape'=> false, 'class' => 'black-text waves-effect waves-light']);  ?></li>
        </b>
      </ul>
      <div class="center nav-content">
        <br>
        <?= $this->html->image('usb.png',['url' => array('controller' => 'Home', 'action' => 'index'),'class' => 'responsive-img']); ?>
        <br>
      </div>
  </nav>
    <div>
        <?= $this->fetch('content') ?>
    </div>
     <!-- Evita dar click derecho -->
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
